<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Incidente;

/**
 * IncidenteSearch represents the model behind the search form of `common\models\Incidente`.
 */
class IncidenteSearch extends Incidente
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_incidente', 'id_notificacao', 'id_funcionario'], 'integer'],
            [['tipo', 'descricao', 'data_registo'], 'safe'],
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
        $query = Incidente::find();

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
            'id_incidente' => $this->id_incidente,
            'id_notificacao' => $this->id_notificacao,
            'id_funcionario' => $this->id_funcionario,
            'data_registo' => $this->data_registo,
        ]);

        $query->andFilterWhere(['like', 'tipo', $this->tipo])
            ->andFilterWhere(['like', 'descricao', $this->descricao]);

        return $dataProvider;
    }
}
