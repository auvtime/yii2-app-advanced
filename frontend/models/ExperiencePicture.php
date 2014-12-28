<?php

namespace frontend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "experience_picture".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $exp_id
 * @property string $url
 * @property string $thumbnail_url
 * @property string $create_time
 * @property string $update_time
 *
 * @property User $user
 * @property Experience $exp
 */
class ExperiencePicture extends \yii\db\ActiveRecord
{
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
    public static function tableName()
    {
        return 'experience_picture';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'url', 'thumbnail_url'], 'required'],
            [['user_id', 'exp_id'], 'integer'],
            [['create_time', 'update_time'], 'safe'],
            [['url', 'thumbnail_url'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('experience', 'ID'),
            'user_id' => Yii::t('experience', 'User ID'),
            'exp_id' => Yii::t('experience', 'Exp ID'),
            'url' => Yii::t('experience', 'Url'),
            'thumbnail_url' => Yii::t('experience', 'Thumbnail Url'),
            'create_time' => Yii::t('experience', 'Create Time'),
            'update_time' => Yii::t('experience', 'Update Time'),
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
     * 根据图片id和user_id更新经历图片表中的exp_id
     * @param number $userId
     * @param number $expId
     * @param string $expPicIds 图片id串，如1,2,3
     * @author WangXianfeng<wangxianfeng@auvtime.com> 2014-12-28 下午10:21:27
     */
    public function updateExpId($userId,$expId,$expPicIds){
        $this->updateAll(["exp_id"=>$expId],
           " user_id = ".$userId." and id in(".$expPicIds.")");
    }
}
