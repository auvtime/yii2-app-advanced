<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Experience;

/**
 * ExperienceSearch represents the model behind the search form about `app\models\Experience`.
 */
class ExperienceSearch extends Experience
{
    public function rules()
    {
        return [
            [['id', 'user_id'], 'integer'],
            [['content', 'time_unit', 'exp_time', 'create_time', 'update_time'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Experience::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'exp_time' => $this->exp_time,
            'user_id' => $this->user_id,
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
        ]);

        $query->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'time_unit', $this->time_unit]);

        return $dataProvider;
    }
}
