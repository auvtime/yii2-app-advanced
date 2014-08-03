<?php

namespace frontend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "my_care".
 *
 * @property integer $id
 * @property string $name
 * @property string $nick_name
 * @property string $solar_birthday
 * @property string $lunar_birthday
 * @property string $remark
 * @property string $create_time
 * @property string $update_time
 */
class MyCare extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'my_care';
    }
    /**
     * 我关心的人创建时间和更新时间
     * @see \yii\base\Component::behaviors()
     * @return multitype:multitype:multitype:string
     * @author WangXianfeng<wangxianfeng@auvtime.com> 2014-8-3 下午4:50:48
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
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['solar_birthday', 'lunar_birthday', 'create_time', 'update_time'], 'safe'],
            [['name', 'nick_name'], 'string', 'max' => 100],
            [['remark'], 'string', 'max' => 1000]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('my-care', 'ID'),
            'name' => Yii::t('my-care', 'Name'),
            'nick_name' => Yii::t('my-care', 'Nick Name'),
            'solar_birthday' => Yii::t('my-care', 'Solar Birthday'),
            'lunar_birthday' => Yii::t('my-care', 'Lunar Birthday'),
            'remark' => Yii::t('my-care', 'Remark'),
            'create_time' => Yii::t('my-care', 'Create Time'),
            'update_time' => Yii::t('my-care', 'Update Time'),
        ];
    }
}
