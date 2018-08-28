<?php

use yii\db\Migration;

/**
 * Handles the creation of table `error_log`.
 */
class m171128_225837_create_error_log_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('error_log', [
            'id' => $this->primaryKey(),
            'parse_id' => $this->integer(),
            'created_at' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP',
            'source' => $this->string(),
            'error' => $this->string(),
            'status' => $this->integer(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('error_log');
    }
}
