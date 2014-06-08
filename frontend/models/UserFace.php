<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "user_face".
 *
 * @property integer $id
 * @property string $face_name
 * @property string $face_url
 * @property string $face_type
 * @property string $face_file
 * @property integer $user_id
 * @property string $file_type
 * @property integer $file_size
 * @property integer $upload_ip
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
            [['face_name', 'face_url', 'user_id'], 'required'],
            [['user_id', 'file_size', 'upload_ip'], 'integer'],
            [['face_name'], 'string', 'max' => 500],
            [['face_url', 'face_file'], 'string', 'max' => 1000],
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
            'face_name' => Yii::t('auvtime-myprofile', 'Face Name'),
            'face_url' => Yii::t('auvtime-myprofile', 'Face Url'),
            'face_type' => Yii::t('auvtime-myprofile', 'Face Type'),
            'face_file' => Yii::t('auvtime-myprofile', 'Face File'),
            'user_id' => Yii::t('auvtime-myprofile', 'User ID'),
            'file_type' => Yii::t('auvtime-myprofile', 'File Type'),
            'file_size' => Yii::t('auvtime-myprofile', 'File Size'),
            'upload_ip' => Yii::t('auvtime-myprofile', 'Upload Ip'),
        ];
    }
}
