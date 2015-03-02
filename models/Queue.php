<?php

namespace app\models;

use Yii;
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
 * @property integer $queued_time
 * @property integer $attempts
 * @property integer $last_attempt_time
 * @property integer $sent_time
 */
class Course extends \yii\db\ActiveRecord
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
    public function rules()
    {
        return [
            [['queued_time', 'attempts', 'last_attempt_time', 'sent_time'], 'integer'],
            [['to', 'cc', 'bcc', 'subject', 'html_body', 'text_body', 'charset'], 'safe'],
            [['from', 'reply_to'], 'string', 'max' => 255],
        ];
    }
	
	public function toMessage()
	{
		$to = unserialize($this->to);
		
		if(isset($this->from) && !empty($to)) {
			$message = new Message();
			$cc = serialize($this->cc);
			$bcc = serialize($this->bcc);
			
			$message->setFrom($this->from)->setTo($to);
			
			if(!empty($cc)) {
				$message->setCc($cc);
			}
			
			if(!empty($bcc)) {
				$message->setBcc($bcc);
			}
			
			$message->setSubject($this->subject);
			
			if(!empty($this->html_body)) {
				$message->setHtmlBody($this->html_body);
			}
			
			if(!empty($this->text_body)) {
				$message->setTextBody($this->text_body);
			}
			
			if(!empty($this->reply_to)) {
				$message->setReplyTo($this->reply_to);
			}
			
			if(!empty($this->charset)) {
				$message->setCharset($this->charset);
			}
			
			return $message;
		}
		
		return null;
	}
}