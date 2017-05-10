<?php

use yii\db\Schema;
use yii\db\Migration;
use nterms\mailqueue\MailQueue;

class m170510_063111_alter_text_fields extends Migration {

    public function safeUp() {
        $table = Yii::$app->get(MailQueue::NAME)->table;
        $this->alterColumn($table, 'html_body', 'LONGTEXT');
        $this->alterColumn($table, 'html_text', 'LONGTEXT');
        $this->alterColumn($table, 'swift_message', 'LONGTEXT');
    }

    public function safeDown() {
        $table = Yii::$app->get(MailQueue::NAME)->table;
        $this->alterColumn($table, 'html_body', Schema::TYPE_TEXT);
        $this->alterColumn($table, 'html_text', Schema::TYPE_TEXT);
        $this->alterColumn($table, 'swift_message', Schema::TYPE_TEXT);
    }

}
