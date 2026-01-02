<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\PedidoAssistencia;

/**
 * PedidoAssistenciaSearch represents the model behind the search form of `common\models\PedidoAssistencia`.
 */
class PedidoAssistenciaSearch extends PedidoAssistencia
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_pedido', 'id_passageiro', 'id_funcionario_resolve'], 'integer'],
            [['type', 'request_date', 'resolution_date', 'status', 'description', 'response'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     * @param string|null $formName Form name to be used into `->load()` method.
     *
     * @return ActiveDataProvider
     */
    public function search($params, $formName = null)
    {
        $query = PedidoAssistencia::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, $formName);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_pedido' => $this->id_pedido,
            'id_passageiro' => $this->id_passageiro,
            'id_funcionario_resolve' => $this->id_funcionario_resolve,
            'request_date' => $this->request_date,
            'resolution_date' => $this->resolution_date,
        ]);

        $query->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'response', $this->response]);

        return $dataProvider;
    }
}
