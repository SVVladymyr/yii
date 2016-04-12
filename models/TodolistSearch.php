<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Todolist;

/**
 * TodolistSearch represents the model behind the search form about `app\models\Todolist`.
 */
class TodolistSearch extends Todolist
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'userId', 'status'], 'integer'],
            [['title', 'action', 'updateDate'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Todolist::find()->with('userview');

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
            'id' => $this->id,
            'userId' => $this->userId,
            'status' => $this->status,
            'updateDate' => $this->updateDate,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'action', $this->action]);

        return $dataProvider;
    }
	
	public function searchMyTodo($params)
    {
		$user_id = Yii::$app->user->id;
        //$query = Todolist::find()->where(['userId' => $user_id])->all();
		$query = Todolist::find()->where(['=', 'userId', $user_id]);
			
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
            'id' => $this->id,
            'userId' => $this->userId,
            'status' => $this->status,
            'updateDate' => $this->updateDate,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'action', $this->action]);
		
        return $dataProvider;
    }
	
	public function searchNoMyTodo($params)
    {
		$user_id = Yii::$app->user->id;
        //$query = Todolist::find()->where(['userId' => $user_id])->all();
		$query = Todolist::find()->where(['<>', 'userId', $user_id]);
			
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
            'id' => $this->id,
            'userId' => $this->userId,
            'status' => $this->status,
            'updateDate' => $this->updateDate,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'action', $this->action]);
		
        return $dataProvider;
    }
}
