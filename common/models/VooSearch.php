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
            [['id_voo', 'id_companhia', 'id_funcionario_responsavel', 'status'], 'integer'],

            [['numero_voo', 'origin', 'destination', 'tipo_voo', 'gate', 'departure_date', 'arrival_date'], 'safe'],
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
        $query = Voo::find()
            ->alias('voo')
            ->joinWith('companhia');

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
            'voo.id_companhia' => $this->id_companhia,
            'departure_date' => $this->departure_date,
            'arrival_date' => $this->arrival_date,
            'id_funcionario_responsavel' => $this->id_funcionario_responsavel,
            'status' => $this->status,
            'gate' => $this->gate,
        ]);

        $query->andFilterWhere(['like', 'numero_voo', $this->numero_voo])
            ->andFilterWhere(['like', 'origin', $this->origin])
            ->andFilterWhere(['like', 'destination', $this->destination])
            ->andFilterWhere(['like', 'tipo_voo', $this->tipo_voo]);

        return $dataProvider;
    }
}
