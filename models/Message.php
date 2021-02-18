<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "message".
 *
 * @property int $id
 * @property int $user_id
 * @property string $text
 * @property int $status
 * @property int $created_at
 */
class Message extends \yii\db\ActiveRecord
{

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'message';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // [['text'], 'required'],
            [['text'], 'safe'],
            [['user_id', 'status'], 'integer'],
            [['text'], 'string', 'max' => 255],
            // [['created_at'], 'datetime'],
            [['created_at'], 'safe'],
            [['status'], 'default', 'value' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Пользователь',
            'text' => 'Сообщение',
            'status' => 'Статус',
            'created_at' => 'Дата создания',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
