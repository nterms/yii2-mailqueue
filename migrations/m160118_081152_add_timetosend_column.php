<?php

use yii\db\Migration;
use nterms\mailqueue\MailQueue;

class m160118_081152_add_timetosend_column extends Migration
{
    public function up()
    {
        $this->addColumn(Yii::$app->get(MailQueue::NAME)->table, 'time_to_send', $this->dateTime()->notNull());
        $this->createIndex('IX_time_to_send', Yii::$app->get(MailQueue::NAME)->table, 'time_to_send');
    }

    public function down()
    {
        $this->dropIndex('IX_time_to_send', Yii::$app->get(MailQueue::NAME)->table);
        $this->dropColumn(Yii::$app->get(MailQueue::NAME)->table, 'time_to_send');
    }
}
