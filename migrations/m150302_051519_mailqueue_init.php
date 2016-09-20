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
		$tableOptions = null;
		if ($this->db->driverName === 'mysql') {
			$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		}
		
		$this->createTable(Yii::$app->get(MailQueue::NAME)->table, [
			'id' => Schema::TYPE_PK,
			'from' => Schema::TYPE_TEXT,
			'to' => Schema::TYPE_TEXT,
			'cc' => Schema::TYPE_TEXT,
			'bcc' => Schema::TYPE_TEXT,
			'subject' => Schema::TYPE_STRING,
			'html_body' => Schema::TYPE_TEXT,
			'text_body' => Schema::TYPE_TEXT,
			'reply_to' => Schema::TYPE_TEXT,
			'charset' => Schema::TYPE_STRING,
			'created_at' => Schema::TYPE_DATETIME . ' NOT NULL',
			'attempts' => Schema::TYPE_INTEGER,
			'last_attempt_time' => Schema::TYPE_DATETIME . ' DEFAULT NULL',
			'sent_time' => Schema::TYPE_DATETIME . ' DEFAULT NULL',
		], $tableOptions);
    }

    public function down()
    {
        $this->dropTable(Yii::$app->get(MailQueue::NAME)->table);
    }
}
