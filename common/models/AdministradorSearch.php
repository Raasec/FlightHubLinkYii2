<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Administrador;

/**
 * AdministradorSearch represents the model behind the search form of `common\models\Administrador`.
 */
class AdministradorSearch extends Administrador
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_admin', 'id_utilizador'], 'integer'],
            [['nivel_acesso', 'responsavel_area'], 'safe'],
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
        $query = Administrador::find();

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
            'id_admin' => $this->id_admin,
            'id_utilizador' => $this->id_utilizador,
        ]);

        $query->andFilterWhere(['like', 'nivel_acesso', $this->nivel_acesso])
            ->andFilterWhere(['like', 'responsavel_area', $this->responsavel_area]);

        return $dataProvider;
    }
}
