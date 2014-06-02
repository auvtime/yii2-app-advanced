<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "experience".
 *
 * @property integer $id
 * @property string $content
 * @property string $time_unit
 * @property string $exp_time
 * @property integer $user_id
 * @property string $create_time
 * @property string $update_time
 *
 * @property User $id0
 */
class Experience extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'experience';
    }
    
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
    public function rules()
    {
        return [
            [['content', 'time_unit'], 'required'],
            [['exp_time'], 'safe'],
            [['content'], 'string', 'max' => 500],
            [['time_unit'], 'string', 'max' => 20],
            [['exp_time'],'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'content' => Yii::t('experience', 'What happended to you?'),
            'time_unit' => Yii::t('experience', 'Time Unit?'),
            'exp_time' => Yii::t('experience', 'When?'),
            'create_time' => Yii::t('experience', 'Create Time'),
            'update_time' => Yii::t('experience', 'Update Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getId0()
    {
        return $this->hasOne(User::className(), ['id' => 'id']);
    }
    /**
     * 获取创建时间的页面展示
     * 
     * @author WangXianfeng<wangxianfeng@auvtime.com> 2014-6-2 下午7:08:28
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
     * 获取经历时间的的页面展示
     * 
     * @author WangXianfeng<wangxianfeng@auvtime.com> 2014-6-2 下午7:17:02
     */
    public function getExpTimeDisplay(){
    if($this->time_unit == 'SECOND'){
    		return substr($this->exp_time,0,19);
    	}else if($this->time_unit == 'MINUTE'){
    		return substr($this->exp_time,0,16);
    	}else if($this->time_unit == 'HOUR'){
    		return substr($this->exp_time,0,13);
    	}else if($this->time_unit == 'DAY'){
    		return substr($this->exp_time,0,10);
    	}else if($this->time_unit == 'MONTH'){
    		return substr($this->exp_time,0,7);
    	}else if($this->time_unit == 'YEAR'){
    		return substr($this->exp_time,0,4);
    	}
    }
}
