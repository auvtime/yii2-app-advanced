<?php

namespace frontend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
/**
 * This is the model class for table "user_face".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $face_url
 * @property string $face_type
 * @property string $file_type
 * @property integer $file_size
 * @property integer $upload_ip
 * @property string $create_time
 * @property string $update_time
 */
class UserFace extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_face';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'face_url'], 'required'],
            [['user_id', 'file_size', 'upload_ip'], 'integer'],
            [['create_time', 'update_time'], 'safe'],
            [['face_url'], 'string', 'max' => 1000],
            [['face_type', 'file_type'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('auvtime-myprofile', 'ID'),
            'user_id' => Yii::t('auvtime-myprofile', 'User ID'),
            'face_url' => Yii::t('auvtime-myprofile', 'Face Url'),
            'face_type' => Yii::t('auvtime-myprofile', 'Face Type'),
            'file_type' => Yii::t('auvtime-myprofile', 'File Type'),
            'file_size' => Yii::t('auvtime-myprofile', 'File Size'),
            'upload_ip' => Yii::t('auvtime-myprofile', 'Upload Ip'),
            'create_time' => Yii::t('auvtime-myprofile', 'Create Time'),
            'update_time' => Yii::t('auvtime-myprofile', 'Update Time'),
        ];
    }
    
    /**
     * (non-PHPdoc)
     *
     * @see \yii\base\Component::behaviors()
     * @return multitype:multitype:multitype:string \frontend\models\Expression NULL
     * @author WangXianfeng<wangxianfeng@auvtime.com> 2014-6-21 下午10:24:42
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
}
