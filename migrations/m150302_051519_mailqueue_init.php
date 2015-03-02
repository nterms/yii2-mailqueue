<?php

use yii\db\Schema;
use yii\db\Migration;
use nterms\mailqueue\MailQueue;

/**
 * Initializes the db table for MailQueue
 *
 * @author Saranga Abeykoon <amisaranga@gmail.com>
 */
class m150302_051519_mailqueue_init extends Migration
{
    public function up()
    {
		$this->createTable(Yii::$pp->get(MailQueue::NAME)->table, [
			'from' => Schema::TYPE_STRING,
			'to' => Schema::TYPE_TEXT,
			'cc' => Schema::TYPE_TEXT,
			'bcc' => Schema::TYPE_TEXT,
			'subject' => Schema::TYPE_STRING,
			'html_body' => Schema::TYPE_TEXT,
			'text_body' => Schema::TYPE_TEXT,
			'reply_to' => Schema::TYPE_STRING,
			'charset' => Schema::TYPE_STRING,
			'queued_time' => Schema::TYPE_TIMESTAMP,
			'attempts' => Schema::TYPE_INTEGER,
			'last_attempt_time' => Schema::TYPE_TIMESTAMP,
			'sent_time' => Schema::TYPE_TIMESTAMP,
		], 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB');
    }

    public function down()
    {
        $this->dropTable(Yii::$pp->get(MailQueue::NAME)->table);

        return false;
    }
}
