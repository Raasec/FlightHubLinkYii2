<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\UserProfile;

/**
 * UserProfileSearch represents the model behind the search form of `common\models\UserProfile`.
 */
class UserProfileSearch extends UserProfile
{
    public $username;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['full_name', 'gender', 'role_type', 'username'], 'safe'],
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
     * @param string|null $formName Form name to be used into `->load()` method.
     *
     * @return ActiveDataProvider
     */
    public function search($params, $formName = null)
    {
        $query = UserProfile::find()
                ->joinWith(['user']); // necessário para fazer search no username

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, $formName);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'user_profile.id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'user_profile.full_name', $this->full_name])
            ->andFilterWhere(['user_profile.gender' => $this->gender])
            ->andFilterWhere(['user_profile.role_type' => $this->role_type])
            ->andFilterWhere(['like', 'user.username', $this->username]);

        return $dataProvider;
    }
}
