<?php 

/**
 * Message.php
 * @author Saranga Abeykoon http://nterms.com
 */

namespace nterms\mailqueue;

use Yii;
use nterms\models\Queue;

/**
 * Extends `yii\swiftmailer\Message` to enable queuing.
 * 
 * @see http://www.yiiframework.com/doc-2.0/yii-swiftmailer-message.html
 */
class Message extends \yii\swiftmailer\Message
{
	/**
	 * Enqueue the message storing it in database.
	 * 
	 * @return boolean true on success, false otherwise
	 */
	public function queue()
	{
		$item = new Queue();
		
		$item->from = $this->from;
		$item->to = serialize($this->getTo());
		$item->cc = serialize($this->getCc());
		$item->bcc = serialize($this->getBcc());
		$item->subject = $this->getSubject();
		$item->html_body = $this->htmlBody;
		$item->text_body = $this->textBody;
		$item->reply_to = $this->getReplyTo();
		$item->charset = $this->getCharset();
		$item->queued_time = time();
		$item->attempts = 0;
		
		return $item->save();
	}
}