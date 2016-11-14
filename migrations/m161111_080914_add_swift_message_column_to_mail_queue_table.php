<?php

use yii\db\Migration;
use nterms\mailqueue\MailQueue;

/**
 * Handles adding swift_message to table `mail_queue`.
 */
class m161111_080914_add_swift_message_column_to_mail_queue_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn(Yii::$app->get(MailQueue::NAME)->table, 'swift_message', 'text');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn(Yii::$app->get(MailQueue::NAME)->table, 'swift_message');
    }
}
