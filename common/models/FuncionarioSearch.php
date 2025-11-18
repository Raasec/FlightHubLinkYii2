<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Funcionario;

/**
 * FuncionarioSearch represents the model behind the search form of `common\models\Funcionario`.
 */
class FuncionarioSearch extends Funcionario
{
    
    public $username;
    public $nome;
    public $email;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // pesquisa com inteiro
            [['id_funcionario', 'id_utilizador'], 'integer'],

            // pesquisa com string
            [['departamento', 'cargo', 'turno', 'data_contratacao'], 'safe'],

            // pesquisa com atributos do User
            [['username','nome','email'],'safe'],
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
        $query = Funcionario::find();

        // add conditions that should always apply here
        // Adicionou-se um JOIN com a Table User para permitir fazer a procura do username, nome e email
        $query->joinWith(['user']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);


        // Agora fazer a Ordenacao dos campos de User
        $dataProvider->sort->attributes['username'] = [
            'asc' => ['user.username' => SORT_ASC],
            'desc' => ['user.username' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['nome'] = [
            'asc' => ['user.nome' => SORT_ASC],
            'desc' => ['user.nome' => SORT_DESC],
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
        $query->andFilterWhere([
            'id_funcionario' => $this->id_funcionario,
            'id_utilizador' => $this->id_utilizador,
            'data_contratacao' => $this->data_contratacao,
        ]);

        $query->andFilterWhere(['like', 'departamento', $this->departamento])
            ->andFilterWhere(['like', 'cargo', $this->cargo])
            ->andFilterWhere(['like', 'turno', $this->turno]);


        //Filtros adicionais para username, nome e email
        $query->andFilterWhere(['like', 'user.username', $this->username])
              ->andFilterWhere(['like', 'user.nome', $this->nome])
              ->andFilterWhere(['like', 'user.email', $this->email]);
        
        return $dataProvider;
    }
}
