<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "countdown".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $event_title
 * @property string $event_desc
 * @property string $event_time
 * @property string $create_time
 * @property string $update_time
 */
class Countdown extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'countdown';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'event_title'], 'required'],
            [['user_id'], 'integer'],
            [['event_time', 'create_time', 'update_time'], 'safe'],
            [['event_title'], 'string', 'max' => 100],
            [['event_desc'], 'string', 'max' => 2000]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('countdown', 'ID'),
            'user_id' => Yii::t('countdown', 'User ID'),
            'event_title' => Yii::t('countdown', 'Event Title'),
            'event_desc' => Yii::t('countdown', 'Event Desc'),
            'event_time' => Yii::t('countdown', 'Event Time'),
            'create_time' => Yii::t('countdown', 'Create Time'),
            'update_time' => Yii::t('countdown', 'Update Time'),
        ];
    }
}
