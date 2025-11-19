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

    public $username;
    public $email;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // pesquisa com inteiro
            [['id_passageiro', 'id_utilizador'], 'integer'],

            // pesquisa com string
            [['nif', 'telefone', 'nacionalidade', 'data_nascimento', 'preferencias'], 'safe'],

            // pesquisa com atributos vindos dio User
            [['username', 'email'], 'safe'],
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
        $query->joinWith(['user']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        // Agora fazer a Ordenacao dos campos de User
        $dataProvider->sort->attributes['username'] = [
            'asc' => ['user.username' => SORT_ASC],
            'desc' => ['user.username' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['email'] = [
            'asc' => ['user.email' => SORT_ASC],
            'desc' => ['user.email' => SORT_DESC],
        ];


        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        // Filtros da tabela passageiro
        $query->andFilterWhere([
            'id_passageiro' => $this->id_passageiro,
            'id_utilizador' => $this->id_utilizador,
            'data_nascimento' => $this->data_nascimento,
        ]);

        $query->andFilterWhere(['like', 'nif', $this->nif])
            ->andFilterWhere(['like', 'telefone', $this->telefone])
            ->andFilterWhere(['like', 'nacionalidade', $this->nacionalidade])
            ->andFilterWhere(['like', 'preferencias', $this->preferencias]);


        // Filtros da tabela user
        $query->andFilterWhere(['like', 'user.username', $this->username])
                ->andFilterWhere(['like', 'user.email', $this->email]);
                
        return $dataProvider;
    }
}
