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

    public $username;
    public $email;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // pesquisa com inteiro
            [['id_admin', 'id_utilizador'], 'integer'],

            // pesquisa com string
            [['access_level', 'area_responsible'], 'safe'],

            // pesquisa com atributos vindos dio User
            [['username','email'],'safe'],
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

        // Adicionou-se um JOIN com a Table User para permitir fazer a procura do username, nome e email
        $query->joinWith(['user']);

        // add conditions that should always apply here


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        //permitir ordenar atraves dos atributos/campos do user
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
        // Campos da tabela Administrador
        $query->andFilterWhere([
            'id_admin' => $this->id_admin,
            'id_utilizador' => $this->id_utilizador,
        ]);

        $query->andFilterWhere(['like', 'access_level', $this->access_level])
            ->andFilterWhere(['like', 'area_responsible', $this->area_responsible]);


        //Campos da Tabela user
        $query->andFilterWhere(['like', 'user.username', $this->username])
              ->andFilterWhere(['like', 'user.email', $this->email]);

        return $dataProvider;
    }
}
