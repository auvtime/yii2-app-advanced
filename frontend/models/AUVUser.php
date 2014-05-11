<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $nickname
 * @property string $birthday
 * @property string $public_flag
 * @property string $leave_age
 * @property string $time_unit
 * @property string $mobile
 * @property string $face
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $role
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $create_time
 * @property string $update_time
 */
class AUVUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at'], 'required'],
            [['birthday', 'create_time', 'update_time'], 'safe'],
            [['leave_age', 'role', 'status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'nickname', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['public_flag'], 'string', 'max' => 10],
            [['time_unit'], 'string', 'max' => 20],
            [['mobile'], 'string', 'max' => 120],
            [['face'], 'string', 'max' => 1000],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('auvtime', 'ID'),
            'username' => Yii::t('auvtime', 'Username'),
            'nickname' => Yii::t('auvtime', 'Nickname'),
            'birthday' => Yii::t('auvtime', 'Birthday'),
            'public_flag' => Yii::t('auvtime', 'Public Flag'),
            'leave_age' => Yii::t('auvtime', 'Leave Age'),
            'time_unit' => Yii::t('auvtime', 'Time Unit'),
            'mobile' => Yii::t('auvtime', 'Mobile'),
            'face' => Yii::t('auvtime', 'Face'),
            'auth_key' => Yii::t('auvtime', 'Auth Key'),
            'password_hash' => Yii::t('auvtime', 'Password Hash'),
            'password_reset_token' => Yii::t('auvtime', 'Password Reset Token'),
            'email' => Yii::t('auvtime', 'Email'),
            'role' => Yii::t('auvtime', 'Role'),
            'status' => Yii::t('auvtime', 'Status'),
            'created_at' => Yii::t('auvtime', 'Created At'),
            'updated_at' => Yii::t('auvtime', 'Updated At'),
            'create_time' => Yii::t('auvtime', 'Create Time'),
            'update_time' => Yii::t('auvtime', 'Update Time'),
        ];
    }
}
