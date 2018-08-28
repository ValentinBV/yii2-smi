<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "parse_log".
 *
 * @property integer $id
 * @property string $created_at
 * @property double $time
 * @property string $type
 * @property integer $source_count
 */
class ParseLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'parse_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at'], 'safe'],
            //[['time'], 'required'],
            [['time'], 'number'],
            [['count', 'source_count'], 'integer'],
            [['type'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Created At',
            'time' => 'Time',
            'type' => 'Type',
        ];
    }
}
