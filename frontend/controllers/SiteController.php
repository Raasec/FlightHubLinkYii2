<?php

namespace frontend\controllers;

use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use common\models\Voo; 
use common\models\ServicoAeroporto;
use common\models\CompanhiaAerea; 

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
            'captcha' => [
                'class' => \yii\captcha\CaptchaAction::class,
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        // para a table de flights 
        $partidas = Voo::find()->all();
        $chegadas = Voo::find()->all();

        // para o preview dos services
        $servicos = ServicoAeroporto::find()->all();

        return $this->render('index', [
            'partidas' => $partidas,
            'chegadas' => $chegadas,
            'servicos' => $servicos,
        ]);
    }

    public function actionSearchFlight()
    {
        $origin = Yii::$app->request->get('origin');
        $destination = Yii::$app->request->get('destination');
        $date = Yii::$app->request->get('date');

        $query = Voo::find();

        if ($origin) {
            $query->andWhere(['like', 'origem', $origin]);
        }

        if ($destination) {
            $query->andWhere(['like', 'destino', $destination]);
        }

        if ($date) {
            // converte dd/mm/yyyy → yyyy-mm-dd
            $parts = explode('/', $date);
            if (count($parts) === 3) {
                $dateSQL = "{$parts[2]}-{$parts[1]}-{$parts[0]}";
                $query->andWhere(['DATE(data_registo)' => $dateSQL]);
            }
        }

        $flights = $query->all();

        return $this->render('search-results', [
            'flights' => $flights,
            'origin' => $origin,
            'destination' => $destination,
            'date' => $date
        ]);
    }

        /**
     * Logs in a user.
     *
     * @return mixed
     */
    
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack(); // actually deixa tar go home aqui
        }

        $model->password = '';

        return $this->render('login', ['model' => $model]);
    }


    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        }

        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionCheckin()
    {
        return $this->render('checkin');
    }

    public function actionTicketPurchase()
    {
        $request = Yii::$app->request;

        $query = Voo::find()
            ->with('companhia')
            ->where(['status' => 'ativo']);

        // filtros
        if ($origin = $request->get('origin')) {
            $query->andWhere(['like', 'origin', $origin]);
        }

        if ($destination = $request->get('destination')) {
            $query->andWhere(['like', 'destination', $destination]);
        }

        if ($idCompanhia = $request->get('id_companhia')) {
            $query->andWhere(['id_companhia' => $idCompanhia]);
        }

        if ($tipoVoo = $request->get('tipo_voo')) {
            $query->andWhere(['tipo_voo' => $tipoVoo]);
        }

        if ($date = $request->get('departure_date')) {
            $query->andWhere(['departure_date' => $date]);
        }

        $voos = $query->all();

        $companhias = CompanhiaAerea::find()->all();

        return $this->render('ticketPurchase', [
            'voos' => $voos,
            'companhias' => $companhias,
        ]);
    }


    public function actionServicos()
    {     
        $servicos = \common\models\ServicoAeroporto::find()->all();

        return $this->render('servicos', [
            'servicos' => $servicos
        ]);
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            }

            Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($model->verifyEmail()) {
            Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
            return $this->goHome();
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }

}
