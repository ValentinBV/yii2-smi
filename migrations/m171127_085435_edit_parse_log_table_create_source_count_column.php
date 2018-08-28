<?php

use yii\db\Migration;

/**
 * Class m171127_085435_edit_parse_log_table_create_source_count_column
 */
class m171127_085435_edit_parse_log_table_create_source_count_column extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn('parse_log', 'source_count', $this->integer());
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn('parse_log', 'source_count', $this->integer());
    }

}
