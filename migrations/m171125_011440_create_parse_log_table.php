<?php

use yii\db\Migration;

/**
 * Handles the creation of table `parse_log`.
 */
class m171125_011440_create_parse_log_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('parse_log', [
            'id' => $this->primaryKey(),
            'created_at' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP',
            'time' => $this->float()->notNull(),
            'type' => $this->string(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('parse_log');
    }
}
