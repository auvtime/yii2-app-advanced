<?php

namespace frontend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "achievement".
 *
 * @property integer $id
 * @property integer $exp_id
 * @property string $content
 * @property string $time_unit
 * @property integer $user_id
 * @property string $achieve_time
 * @property string $create_time
 * @property string $update_time
 *
 * @property User $user
 * @property Experience $exp
 */
class Achievement extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'achievement';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content', 'time_unit', 'achieve_time'], 'required'],
            [['exp_id', 'user_id'], 'integer'],
            [['achieve_time', 'create_time', 'update_time'], 'safe'],
            [['content'], 'string', 'max' => 500],
            [['time_unit'], 'string', 'max' => 20]
        ];
    }
    /**
     * (non-PHPdoc)
     * @see \yii\base\Component::behaviors()
     * @return multitype:multitype:multitype:string  \frontend\models\Expression NULL  
     * @author WangXianfeng<wangxianfeng@auvtime.com> 2014-6-5 下午9:22:04
     */
	public function behaviors() {
		return [ 
				'timestamp' => [ 
						'class' => TimestampBehavior::className (),
						'attributes' => [ 
								ActiveRecord::EVENT_BEFORE_INSERT => 'create_time',
								ActiveRecord::EVENT_BEFORE_UPDATE => 'update_time' 
						],
						'value' => new Expression ( 'NOW()' ) 
				] 
		];
	}

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('achievement', 'ID'),
            'exp_id' => Yii::t('achievement', 'Exp ID'),
            'content' => Yii::t('achievement', 'Content'),
            'time_unit' => Yii::t('achievement', 'Time Unit'),
            'user_id' => Yii::t('achievement', 'User ID'),
            'achieve_time' => Yii::t('achievement', 'Achieve Time'),
            'create_time' => Yii::t('achievement', 'Create Time'),
            'update_time' => Yii::t('achievement', 'Update Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExp()
    {
        return $this->hasOne(Experience::className(), ['id' => 'exp_id']);
    }
    
    
    /**
     * 获取创建时间的页面展示
     * 
     * @author WangXianfeng<wangxianfeng@auvtime.com> 2014-6-7 下午2:09:32
     */
    public function getCreatTimeDisplay(){
    	if($this->time_unit == 'SECOND'){
    		return substr($this->create_time,0,19);
    	}else if($this->time_unit == 'MINUTE'){
    		return substr($this->create_time,0,16);
    	}else if($this->time_unit == 'HOUR'){
    		return substr($this->create_time,0,13);
    	}else if($this->time_unit == 'DAY'){
    		return substr($this->create_time,0,10);
    	}else if($this->time_unit == 'MONTH'){
    		return substr($this->create_time,0,7);
    	}else if($this->time_unit == 'YEAR'){
    		return substr($this->create_time,0,4);
    	}
    	 
    }
    /**
     * 获取成就时间的的页面展示
     * 
     * @author WangXianfeng<wangxianfeng@auvtime.com> 2014-6-7 下午2:09:48
     */
    public function getAchieveTimeDisplay(){
    	if($this->time_unit == 'SECOND'){
    		return substr($this->achieve_time,0,19);
    	}else if($this->time_unit == 'MINUTE'){
    		return substr($this->achieve_time,0,16);
    	}else if($this->time_unit == 'HOUR'){
    		return substr($this->achieve_time,0,13);
    	}else if($this->time_unit == 'DAY'){
    		return substr($this->achieve_time,0,10);
    	}else if($this->time_unit == 'MONTH'){
    		return substr($this->achieve_time,0,7);
    	}else if($this->time_unit == 'YEAR'){
    		return substr($this->achieve_time,0,4);
    	}
    }
}
