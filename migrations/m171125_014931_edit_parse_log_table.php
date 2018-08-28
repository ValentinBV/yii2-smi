<?php

use yii\db\Migration;

/**
 * Class m171125_014931_edit_parse_log_table
 */
class m171125_014931_edit_parse_log_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('parse_log', 'count', $this->integer());
    }


    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('parse_log', 'count');

        return false;
    }
}
