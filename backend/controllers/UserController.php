<?php

namespace backend\controllers;

use Yii;
use common\models\User;
use common\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Funcionario;
use common\models\Passageiro;
use common\models\Administrador;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::class,
                'only' => ['index', 'view', 'create', 'update', 'delete'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['administrador'], // só administrador pode entrar na gestão de utilizadores
                    ],
                ],
                'denyCallback' => function () {
                    throw new \yii\web\ForbiddenHttpException('Apenas administradores podem aceder à gestão de utilizadores.');
                },
            ],

            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param int $id
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new User();

        /*
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);

        */


        $model ->scenario ='create';

        if ($model->load(Yii::$app->request->post())){

            // Aqui estas a converter password normal para -> password_hash
            if (!empty ($model -> password)){
                $model ->setPassword($model->password);
                $model->generateAuthKey();
            }

            if($model -> save ()) {

                //atribuir role escolhido no formulário
                
                $auth = Yii::$app->authManager;  // instanciar o RBAC

                if (!empty($model->role))
                {
                    $role = $auth->getRole($model->role);  // Carrega a role real definida no sistema RBAC
                    if ($role)                                  // Garante que a role existe no RBAC
                    {
                        $auth->assign($role, $model->id);  // Atribui a role ao utilizador atualizado
                    }

                    $this ->createProfileForRole($model->role, $model-> id); // Cria registo na tabela funcionario, passageiro, administrador
                }

                return $this ->redirect(['view','id' => $model-> id]);
            }

        }
        
        return $this -> render ('create', ['model' => $model,]);


    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        /*

        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);

        */



        $model = $this -> findModel ($id);  // Carregar o modelo

        
        $auth = Yii::$app->authManager;        // 1º carregamos o componente RBAC

        // Role atual do utilizador
        $currentRole = $auth->getRolesByUser($model->id);
        $RoleAntiga = !empty($currentRole) ? array_key_first($currentRole) : null;   //Guarda a role atual do user como a role antiga para a futura comparação

        if ($RoleAntiga !== null) {
            $model->role = $RoleAntiga;    //Supostamente isto preenche o dropdown com a role atual
        }


        if($model -> load(Yii::$app -> request -> post())){    // recebe Post


            if ($model -> save()) {     // Guarda User

                // Vamos agora atualizar a role: 

                // 2º depois revokamos (retirar) as roles do User para
                // 3º Atualizar essa role atraves da role escolhida no _form
                // 4º Por fim redirecionamos para a pagina de visualização do user atualizado 'id' => $model -> id

                $auth -> revokeAll($model -> id);
 
                $NovaRole = $model->role;    // Atribui nova role

                if ($NovaRole !== null) 
                {
                    $role = $auth->getRole($NovaRole);
                    if ($role) 
                    {
                        $auth->assign($role, $model->id);
                    }
                }

                // sincronizar com as restantes tabelas de perfis
                $this ->syncProfilesOnRoleChange($RoleAntiga, $NovaRole, $model->id);

                return $this->redirect(['view', 'id' => $model->id]);
            }
            
        }

        return $this -> render ('update', ['model' => $model ]);

    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }






    
        
     // Criar o perfil na tabela correta consoante a role atribuida no form. 
     
    protected function createProfileForRole(string $roleName, int $id): void
    {
        switch ($roleName) {
            case 'funcionario':
                if (!Funcionario::find()->where(['id_utilizador' => $id])->exists()) {
                    $funcionario = new Funcionario();
                    $funcionario->id_utilizador = $id;
                    $funcionario->save();
                }
                break;

            case 'passageiro':
                if (!Passageiro::find()->where(['id_utilizador' => $id])->exists()) {
                    $passageiro = new Passageiro();
                    $passageiro->id_utilizador = $id;
                    $passageiro->save();
                }
                break;

            case 'administrador':
                if (!Administrador::find()->where(['id_utilizador' => $id])->exists()) {
                    $administrador = new Administrador();
                    $administrador->id_utilizador = $id;
                    $administrador->save();
                }
                break;
        }
    }

    
     // Sincronizar as tabelas de perfil quando a role for updated.
     
    protected function syncProfilesOnRoleChange(?string $RoleAntiga, ?string $NovaRole, int $id): void
    {
        // se a role não mudou, não faz nada
        if ($RoleAntiga === $NovaRole) {
            return;
        }

        // remover perfil antigo para conseguir criar o novo user na table funcionario, passageiro ou administrador com a role nova.
        switch ($RoleAntiga) {
            case 'funcionario':
                Funcionario::deleteAll(['id_utilizador' => $id]);
                break;
            case 'passageiro':
                Passageiro::deleteAll(['id_utilizador' => $id]);
                break;
            case 'administrador':
                Administrador::deleteAll(['id_utilizador' => $id]);
                break;
        }

        // criar perfil novo
        if ($NovaRole !== null) {
            $this->createProfileForRole($NovaRole, $id);
        }
    }

}
