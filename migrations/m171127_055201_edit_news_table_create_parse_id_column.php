<?php

use yii\db\Migration;
use app\models\NewsCategory;

/**
 * Class m171127_055201_edit_news_table_create_parse_id_column
 */
class m171127_055201_edit_news_table_create_parse_id_column extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $newsTables = NewsCategory::find()->asArray()->all();
        if (count($newsTables)) {
            foreach ($newsTables as $table) {
                $this->addColumn($table['table_name'], 'parse_id', $this->integer());
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $newsTables = NewsCategory::find()->asArray()->all();
        if (count($newsTables)) {
            foreach ($newsTables as $table) {
                $this->dropColumn($table['table_name'], 'parse_id', $this->integer());
            }
        }
    }
}
