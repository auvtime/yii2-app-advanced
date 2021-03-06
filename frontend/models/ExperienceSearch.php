<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Experience;
use yii\db\Query;
use yii\helpers\Json;

/**
 * ExperienceSearch represents the model behind the search form about `frontend\models\Experience`.
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

    public function search($page)
    {
    	if(null===$page){
    		$page = 0;
    	}
        $query = Experience::find();
        $query->orderBy(['create_time'=>SORT_DESC]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        	'pagination' => [
        		'pageSize' => 10,
        		'page' => $page,
        	],
        ]);
        
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
	
	/**
	 * 根据时间和内容查询
	 *
	 * @param array $params        	
	 * @return \yii\data\ActiveDataProvider
	 * @author WangXianfeng<wangxianfeng@auvtime.com> 2014-6-2 下午4:28:11
	 */
	public function searchExpByTimeAndContent($params) {
		$query = Experience::find ();
		
		$dataProvider = new ActiveDataProvider ( [ 
				'query' => $query 
		] );
		
		if (null !== $params) {
			if (! ($this->load ( $params ) && $this->validate ())) {
				return $dataProvider;
			}
		}
		Yii::info('exp_time:'.$this->exp_time,'auvtime');
		Yii::info('content:'.$this->content,'auvtime');
		
		$query->andFilterWhere ( [ 
				'id' => $this->id,
				'user_id' => $this->user_id 
		] );
		
		$query->andFilterWhere ( [ 
				'content' => $this->content,
				'DATE_FORMAT(exp_time,"%Y-%m-%d %H:%i:%s")' => $this->exp_time 
		] );
		
		return $dataProvider;
	}
	
	/**
	 * 查询页面导航
	 * 
	 * @param 当前页数 $page 从0开始
	 * @return \yii\data\ActiveDataProvider
	 * @author WangXianfeng<wangxianfeng@auvtime.com> 2014-7-27 下午4:59:18
	 */
	public function searchNav($page)
    {
    	if(null===$page){
    		$page = 0;
    	}
        $query = (new Query())
        	->select(['DATE_FORMAT(exp_time,"%Y") as navYear'])
        	->distinct()
        	->from('experience')
        	->orderBy(['create_time'=>SORT_DESC])
        	->andFilterWhere([
        			'user_id' => $this->user_id,
        	]);
        //$query->orderBy(['create_time'=>SORT_DESC]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        	'pagination' => [
        		'pageSize' => 10,
        		'page' => $page,
        	],
        ]);
        
        $yearList = $dataProvider->getModels();
        
        $navList = [];
        
        foreach ($yearList as $year){
        	
        }

        return $navList;
    }
}
