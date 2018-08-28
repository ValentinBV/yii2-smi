<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "source_smi".
 *
 * @property string $id
 * @property string $url
 * @property string $name
 * @property string $created
 * @property integer $status
 * @property integer $parse_id
 *
 * @property News[] $news
 */
class SourceSmi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'source_smi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created'], 'safe'],
            [['status', 'parse_id'], 'integer'],
            [['url', 'name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'url' => 'Url',
            'name' => 'Name',
            'created' => 'Created',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNews()
    {
        return $this->hasMany(News::className(), ['smi_id' => 'id']);
    }
}
