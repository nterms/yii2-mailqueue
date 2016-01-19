<?php

use yii\db\Migration;

class m160118_081152_add_timetosend_column extends Migration
{
    public function up()
    {
        $this->addColumn('mail_queue', 'time_to_send', $this->dateTime()->notNull());
        $this->createIndex('IX_time_to_send', 'mail_queue', 'time_to_send');
    }

    public function down()
    {
        $this->dropIndex('IX_time_to_send', 'mail_queue');
        $this->dropColumn('mail_queue', 'time_to_send');
    }
}
