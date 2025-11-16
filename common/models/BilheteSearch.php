<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Bilhete;

/**
 * BilheteSearch represents the model behind the search form of `common\models\Bilhete`.
 */
class BilheteSearch extends Bilhete
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_bilhete', 'id_passageiro', 'id_voo'], 'integer'],
            [['porta_embarque', 'data_emissao', 'classe', 'assento', 'estado'], 'safe'],
            [['preco'], 'number'],
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
        $query = Bilhete::find();

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
            'id_bilhete' => $this->id_bilhete,
            'id_passageiro' => $this->id_passageiro,
            'id_voo' => $this->id_voo,
            'data_emissao' => $this->data_emissao,
            'preco' => $this->preco,
        ]);

        $query->andFilterWhere(['like', 'porta_embarque', $this->porta_embarque])
            ->andFilterWhere(['like', 'classe', $this->classe])
            ->andFilterWhere(['like', 'assento', $this->assento])
            ->andFilterWhere(['like', 'estado', $this->estado]);

        return $dataProvider;
    }
}
