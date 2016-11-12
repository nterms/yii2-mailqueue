<?php

namespace nterms\mailqueue\models;

use Yii;
use yii\db\ActiveRecord;
use nterms\mailqueue\MailQueue;
use nterms\mailqueue\Message;

/**
 * This is the model class for table "{{%mail_queue}}".
 *
 * @property string $from
 * @property string $to
 * @property string $cc
 * @property string $bcc
 * @property string $subject
 * @property string $html_body
 * @property string $text_body
 * @property string $reply_to
 * @property string $charset
 * @property integer $created_at
 * @property integer $attempts
 * @property integer $last_attempt_time
 * @property integer $sent_time
 * @property string $time_to_send
 * @property string swift_message
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
            [['to', 'cc', 'bcc', 'subject', 'html_body', 'text_body', 'charset'], 'safe'],
        ];
    }

	public function toMessage()
	{
		return unserialize($this->swift_message);
	}
}
