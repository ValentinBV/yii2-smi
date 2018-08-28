<?php

use yii\db\Migration;

/**
 * Class m171127_085056_edit_source_smi_table_create_parse_id_column
 */
class m171127_085056_edit_source_smi_table_create_parse_id_column extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn('source_smi', 'parse_id', $this->integer());
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn('source_smi', 'parse_id', $this->integer());
    }

}
