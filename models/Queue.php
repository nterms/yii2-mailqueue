<?php

namespace nterms\mailqueue\models;

use Yii;
use yii\db\ActiveRecord;
use nterms\mailqueue\MailQueue;
use nterms\mailqueue\Message;

/**
 * This is the model class for table "{{%mail_queue}}".
 *
 * @property string $subject
 * @property integer $created_at
 * @property integer $attempts
 * @property integer $last_attempt_time
 * @property integer $sent_time
 * @property string $time_to_send
 * @property string $swift_message
 */
class Queue extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return Yii::$app->get(MailQueue::NAME)->table;
    }

    /**
     * @inheritdoc
     */
	public function behaviors()
	{
		return [
			'timestamp' => [
				'class' => 'yii\behaviors\TimestampBehavior',
				'attributes' => [
					ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
					ActiveRecord::EVENT_BEFORE_UPDATE => ['last_attempt_time'],
				],
				'value' => new \yii\db\Expression('NOW()'),
			],
		];
	}

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'attempts', 'last_attempt_time', 'sent_time'], 'integer'],
            [['time_to_send', 'swift_message'], 'required'],
            [['subject'], 'safe'],
        ];
    }

	public function toMessage()
	{
		return unserialize(base64_decode($this->swift_message));
	}
}
