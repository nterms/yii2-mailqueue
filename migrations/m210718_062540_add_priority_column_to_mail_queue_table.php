<?php

use yii\db\Migration;
use nterms\mailqueue\MailQueue;

/**
 * Handles adding columns to table `{{%mail_queue}}`.
 */
class m210718_062540_add_priority_column_to_mail_queue_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(Yii::$app->get(MailQueue::NAME)->table, 'priority', $this->integer()->notNull()->defaultValue(1000));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn(Yii::$app->get(MailQueue::NAME)->table, 'priority');
    }
}
