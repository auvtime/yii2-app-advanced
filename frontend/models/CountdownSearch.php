<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Countdown;

/**
 * CountdownSearch represents the model behind the search form about `frontend\models\Countdown`.
 */
class CountdownSearch extends Countdown
{
    public function rules()
    {
        return [
            [['id', 'user_id'], 'integer'],
            [['event_title', 'event_desc', 'event_time', 'create_time', 'update_time'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($page)
    {
        if(null===$page){
            $page = 0;
        }
        
        $query = Countdown::find();
        
        $query->orderBy ( [
            'order_num' => SORT_ASC
        ] );
        
        $query->andFilterWhere([
            'user_id' => $this->user_id,
            'event_title' => $this->event_title,
        ]);

        $dataProvider = new ActiveDataProvider ( [ 
				'query' => $query,
				'pagination' => [
	        		'pageSize' => 10,
	        		'page' => $page,
        		],
        ]);

        return $dataProvider;
    }
}
