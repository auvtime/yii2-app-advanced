<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\MyCare;

/**
 * MyCareSearch represents the model behind the search form about `frontend\models\MyCare`.
 */
class MyCareSearch extends MyCare
{
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'nick_name', 'solar_birthday', 'lunar_birthday', 'remark', 'create_time', 'update_time'], 'safe'],
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
    	
        $query = MyCare::find ();
		
		$query->orderBy ( [ 
				'order_num' => SORT_ASC 
		] );
		
		$query->andFilterWhere([
		    'user_id' => $this->user_id,
		    'name' => $this->name,
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
