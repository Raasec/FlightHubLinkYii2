<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Voo;

/**
 * VooSearch represents the model behind the search form of `common\models\Voo`.
 */
class VooSearch extends Voo
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_voo', 'id_companhia', 'id_funcionario_responsavel'], 'integer'],
            [['numero_voo', 'origem', 'destino', 'data_registo', 'porta_embarque', 'data_chegada', 'estado'], 'safe'],
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
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Voo::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_voo' => $this->id_voo,
            'id_companhia' => $this->id_companhia,
            'data_registo' => $this->data_registo,
            'data_chegada' => $this->data_chegada,
            'id_funcionario_responsavel' => $this->id_funcionario_responsavel,
        ]);

        $query->andFilterWhere(['like', 'numero_voo', $this->numero_voo])
            ->andFilterWhere(['like', 'origem', $this->origem])
            ->andFilterWhere(['like', 'destino', $this->destino])
            ->andFilterWhere(['like', 'porta_embarque', $this->porta_embarque])
            ->andFilterWhere(['like', 'estado', $this->estado]);

        return $dataProvider;
    }
}
