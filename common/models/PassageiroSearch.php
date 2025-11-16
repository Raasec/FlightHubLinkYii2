<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Passageiro;

/**
 * PassageiroSearch represents the model behind the search form of `common\models\Passageiro`.
 */
class PassageiroSearch extends Passageiro
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_passageiro', 'id_utilizador'], 'integer'],
            [['nif', 'telefone', 'nacionalidade', 'data_nascimento', 'preferencias'], 'safe'],
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
        $query = Passageiro::find();

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
            'id_passageiro' => $this->id_passageiro,
            'id_utilizador' => $this->id_utilizador,
            'data_nascimento' => $this->data_nascimento,
        ]);

        $query->andFilterWhere(['like', 'nif', $this->nif])
            ->andFilterWhere(['like', 'telefone', $this->telefone])
            ->andFilterWhere(['like', 'nacionalidade', $this->nacionalidade])
            ->andFilterWhere(['like', 'preferencias', $this->preferencias]);

        return $dataProvider;
    }
}
