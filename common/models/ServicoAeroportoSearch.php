<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ServicoAeroporto;

/**
 * ServicoAeroportoSearch represents the model behind the search form of `common\models\ServicoAeroporto`.
 */
class ServicoAeroportoSearch extends ServicoAeroporto
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_servico'], 'integer'],
            [['nome', 'tipo', 'localizacao', 'horario_funcionamento'], 'safe'],
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
        $query = ServicoAeroporto::find();

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
            'id_servico' => $this->id_servico,
        ]);

        $query->andFilterWhere(['like', 'nome', $this->nome])
            ->andFilterWhere(['like', 'tipo', $this->tipo])
            ->andFilterWhere(['like', 'localizacao', $this->localizacao])
            ->andFilterWhere(['like', 'horario_funcionamento', $this->horario_funcionamento]);

        return $dataProvider;
    }
}
