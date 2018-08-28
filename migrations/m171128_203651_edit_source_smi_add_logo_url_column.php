<?php

use yii\db\Migration;

/**
 * Class m171128_203651_edit_source_smi_add_logo_url_column
 */
class m171128_203651_edit_source_smi_add_logo_url_column extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn('source_smi', 'logo_url', $this->string());
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn('source_smi', 'logo_url', $this->string());
    }

}
