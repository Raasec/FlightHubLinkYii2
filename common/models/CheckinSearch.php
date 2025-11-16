<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Checkin;

/**
 * CheckinSearch represents the model behind the search form of `common\models\Checkin`.
 */
class CheckinSearch extends Checkin
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_checkin', 'id_bilhete', 'id_funcionario'], 'integer'],
            [['data_checkin', 'metodo'], 'safe'],
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
        $query = Checkin::find();

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
            'id_checkin' => $this->id_checkin,
            'id_bilhete' => $this->id_bilhete,
            'id_funcionario' => $this->id_funcionario,
            'data_checkin' => $this->data_checkin,
        ]);

        $query->andFilterWhere(['like', 'metodo', $this->metodo]);

        return $dataProvider;
    }
}
