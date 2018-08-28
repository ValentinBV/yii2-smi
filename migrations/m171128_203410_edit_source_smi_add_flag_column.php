<?php

use yii\db\Migration;

/**
 * Class m171128_203410_edit_source_smi_add_flag_column
 */
class m171128_203410_edit_source_smi_add_flag_column extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn('source_smi', 'flag', $this->integer());
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn('source_smi', 'flag', $this->integer());
    }

}
