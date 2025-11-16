<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CompanhiaAerea;

/**
 * CompanhiaAereaSearch represents the model behind the search form of `common\models\CompanhiaAerea`.
 */
class CompanhiaAereaSearch extends CompanhiaAerea
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_companhia'], 'integer'],
            [['nome', 'codigo_iata', 'pais_origem'], 'safe'],
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
        $query = CompanhiaAerea::find();

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
            'id_companhia' => $this->id_companhia,
        ]);

        $query->andFilterWhere(['like', 'nome', $this->nome])
            ->andFilterWhere(['like', 'codigo_iata', $this->codigo_iata])
            ->andFilterWhere(['like', 'pais_origem', $this->pais_origem]);

        return $dataProvider;
    }
}
