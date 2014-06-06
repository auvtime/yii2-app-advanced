<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Achievement;

/**
 * AchievementSearch represents the model behind the search form about `frontend\models\Achievement`.
 */
class AchievementSearch extends Achievement
{
    public function rules()
    {
        return [
            [['id', 'exp_id', 'user_id'], 'integer'],
            [['content', 'time_unit', 'achieve_time', 'create_time', 'update_time'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Achievement::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'exp_id' => $this->exp_id,
            'user_id' => $this->user_id,
            'achieve_time' => $this->achieve_time,
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
        ]);

        $query->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'time_unit', $this->time_unit]);

        return $dataProvider;
    }
}
