<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "error_log".
 *
 * @property integer $id
 * @property integer $parse_id
 * @property string $created_at
 * @property string $source
 * @property string $error
 * @property integer $status
 */
class ErrorLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'error_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parse_id', 'status'], 'integer'],
            [['created_at'], 'safe'],
            [['source', 'error'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parse_id' => 'Parse ID',
            'created_at' => 'Created At',
            'source' => 'Source',
            'error' => 'Error',
            'status' => 'Status',
        ];
    }
}
