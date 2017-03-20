<?php

use yii\db\Migration;
use nterms\mailqueue\MailQueue;

/**
 * Handles adding swift_message to table `mail_queue`.
 */
class m170217_124201_drop_obsolete_columns_from_mail_queue_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->dropColumn(Yii::$app->get(MailQueue::NAME)->table, 'from');
		$this->dropColumn(Yii::$app->get(MailQueue::NAME)->table, 'to');
		$this->dropColumn(Yii::$app->get(MailQueue::NAME)->table, 'cc');
		$this->dropColumn(Yii::$app->get(MailQueue::NAME)->table, 'bcc');
		$this->dropColumn(Yii::$app->get(MailQueue::NAME)->table, 'html_body');
		$this->dropColumn(Yii::$app->get(MailQueue::NAME)->table, 'text_body');
		$this->dropColumn(Yii::$app->get(MailQueue::NAME)->table, 'reply_to');
		$this->dropColumn(Yii::$app->get(MailQueue::NAME)->table, 'charset');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->addColumn(Yii::$app->get(MailQueue::NAME)->table, 'from', 'text');
		$this->addColumn(Yii::$app->get(MailQueue::NAME)->table, 'to', 'text');
		$this->addColumn(Yii::$app->get(MailQueue::NAME)->table, 'cc', 'text');
		$this->addColumn(Yii::$app->get(MailQueue::NAME)->table, 'bcc', 'text');
		$this->addColumn(Yii::$app->get(MailQueue::NAME)->table, 'html_body', 'text');
		$this->addColumn(Yii::$app->get(MailQueue::NAME)->table, 'text_body', 'text');
		$this->addColumn(Yii::$app->get(MailQueue::NAME)->table, 'reply_to', 'text');
		$this->addColumn(Yii::$app->get(MailQueue::NAME)->table, 'charset', 'string');
    }
}
