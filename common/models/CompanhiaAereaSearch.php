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
            [['name', 'iata_code', 'country_origin', 'image'], 'safe'],
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

        $query->andFilterWhere(['id_companhia' => $this->id_companhia])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'iata_code', $this->iata_code])
            ->andFilterWhere(['like', 'country_origin', $this->country_origin])
            ->andFilterWhere(['like', 'image', $this->image]);

        return $dataProvider;
    }
}
