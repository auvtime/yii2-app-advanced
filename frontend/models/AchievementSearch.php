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
        $query->orderBy(['create_time'=>SORT_DESC]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

    	if(null !== $params){
	        if (!($this->load($params) && $this->validate())) {
	            return $dataProvider;
	        }
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
    
    /**
     * 根据经历查询是否已经存在
     * 
     * @param number $expId
     * @return number 数量，为0表示不存在，大于0表示存在
     * @author WangXianfeng<wangxianfeng@auvtime.com> 2014-6-7 上午9:29:43
     */
    public function searchCountByExpId($expId)
    {
    	$query = Achievement::find();

    	$dataProvider = new ActiveDataProvider([
    			'query' => $query,
    	]);
    	
    	$query->andFilterWhere([
    			'exp_id' => $expId,
    	]);
    
    	return $dataProvider->getCount();
    }
	
	/**
	 * 根据成就时间和成就内容判断是否存在相同内容
	 *
	 * @param array $params        	
	 * @return \yii\data\ActiveDataProvider
	 * @author WangXianfeng<wangxianfeng@auvtime.com> 2014-6-7 下午2:43:21
	 */
	public function searchAchByTimeAndContent($params) {
		$query = Achievement::find ();
		
		$dataProvider = new ActiveDataProvider ( [ 
				'query' => $query 
		] );
		
		if (null !== $params) {
			if (! ($this->load ( $params ) && $this->validate ())) {
				return $dataProvider;
			}
		}
		
		$query->andFilterWhere ( [ 
				'id' => $this->id,
				'user_id' => $this->user_id 
		] );
		
		$query->andFilterWhere ( [ 
				'content' => $this->content,
				'DATE_FORMAT(achieve_time,"%Y-%m-%d %H:%i:%s")' => $this->achieve_time
    	] );
    
    	return $dataProvider;
    }
}
