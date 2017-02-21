<?php
use yii\db\Migration;
use nterms\mailqueue\MailQueue;
class m170221_090302_add_sent_time_index extends Migration
{
    public function up()
    {
        $this->createIndex('IX_sent_time', Yii::$app->get(MailQueue::NAME)->table, 'sent_time');
    }
    public function down()
    {
        $this->dropIndex('IX_sent_time', Yii::$app->get(MailQueue::NAME)->table);
    }
}
