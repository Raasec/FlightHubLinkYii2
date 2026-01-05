<?php

namespace backend\modules\api\controllers;

use Yii;
use yii\rest\Controller;
use yii\web\NotFoundHttpException;
use common\models\ServicoAeroporto;
use common\models\ServicoAeroportoSearch;

class ServicoAeroportoController extends Controller
{
    // GET /api/servico-aeroporto
    public function actionIndex()
    {
        $searchModel = new ServicoAeroportoSearch();
        $params = Yii::$app->request->queryParams;
        
        $query = ServicoAeroporto::find();

        // filtro por tipo shop restaurant service
        if (!empty($params['type'])) {
            $query->andWhere(['type' => $params['type']]);
        }

        return $query->all();
    }

    // GET /api/servico-aeroporto/{id}
    public function actionView($id)
    {
        return $this->findModel($id);
    }

    // GET /api/servico-aeroporto/tipo/{tipo}
    public function actionPorTipo($tipo)
    {
        return ServicoAeroporto::find()
            ->where(['type' => $tipo])
            ->all();
    }

    protected function findModel($id)
    {
        if (($model = ServicoAeroporto::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('Serviço não encontrado.');
    }
}
