<?php

namespace app\models;

use Yii;
use app\models\NewsCategory;
use app\models\SourceSmi;

/**
 * This is the model class for table "{{%news}}".
 *
 * @property string $id
 * @property string $link
 * @property string $title
 * @property string $description
 * @property string $pub_date
 * @property string $created
 * @property string $image_url
 * @property string $full_text
 * @property string $news_category_id
 * @property string $smi_id
 * @property integer $parse_id
 *
 * @property NewsCategory $newsCategory
 * @property SourceSmi $smi
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static $table;
    
    public static function tableName()
    {
       // return '{{%news}}';
        return static::$table;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description', 'full_text', 'title'], 'string'],
            [['created'], 'safe'],
            [['news_category_id', 'smi_id', 'parse_id'], 'integer'],
            [['link', 'image_url'], 'string', 'max' => 255],
            //[['pub_date'], 'string', 'max' => 255],
            [['news_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => NewsCategory::className(), 'targetAttribute' => ['news_category_id' => 'id']],
            [['smi_id'], 'exist', 'skipOnError' => true, 'targetClass' => SourceSmi::className(), 'targetAttribute' => ['smi_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'link' => 'Link',
            'title' => 'Title',
            'description' => 'Description',
            'pub_date' => 'Pub Date',
            'created' => 'Created',
            'image_url' => 'Image Url',
            'full_text' => 'Full Text',
            'news_category_id' => 'News Category ID',
            'smi_id' => 'Smi ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNewsCategory()
    {
        return $this->hasOne(NewsCategory::className(), ['id' => 'news_category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSmi()
    {
        return $this->hasOne(SourceSmi::className(), ['id' => 'smi_id']);
    }
    
    public static function setTableName($table)
    {
        static::$table = $table;
    }
}
