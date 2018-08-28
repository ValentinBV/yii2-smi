<?php

namespace app\commands;

use yii\console\Controller;
use app\models\YaSmi;
use app\models\NewsCategory;
use app\models\News;
use app\models\ParseLog;
use app\models\SourceSmi;
use app\helpers\TitleParserHelper;
use app\helpers\MetaParserHelper;
use Yii;
use app\helpers\ParseLogHelper;
use app\helpers\ErrorLogHelper;

class YaController extends Controller 
{

    private $xmlSource;
    private $dateInterval = 14400; //сдвиг по времени для корректной даты по UTC
    private $newsCount = 0; //количество полученных новостей
    private $parseType = 'Yandex'; //источник для парсинга
    private $parseId;
    private $sourceCount = 0;
    
    public function actionParse() 
    {
        $yaSmi = YaSmi::find()->asArray()->all();
        $parseLogHelper = new ParseLogHelper();
        if(!($this->parseId = $parseLogHelper->beginParse($this->parseType))) {
            return null;
        }
        if ($yaSmi) {
            foreach ($yaSmi as $key => $value) {
                try {
                    $this->loadXml($value['link']);
                    $tableName = NewsCategory::find()->where(['id' =>
                                $value['news_category_id']])->one()->table_name;
                    News::setTableName($tableName);
                    $this->parseYaXml($value['news_category_id']);
                } catch (\FeedException $e) {
                    $error = new ErrorLogHelper();
                    $error->createLog($this->parseId, $value['link'], $e->getMessage());
                    unset($error);
                }
            }
            
            $parseLogHelper->endParse($this->newsCount,
                    Yii::getLogger()->getElapsedTime(),
                    $this->sourceCount
            );
        }
    }

    public function loadXml($url) 
    {
        $this->xmlSource = \Feed::loadRss($url);
    }

    public function parseYaXml($categoryId) 
    {
        foreach ($this->xmlSource->item as $item) {
            $baseLink = urldecode($item->link);
            $start = strpos($baseLink, '=');
            $end = strpos($baseLink, '&from=rss');
            $link = substr($baseLink, $start + 1, $end - $start - 1);
            if (!News::find()->where(['link' => $link])->count()) {
                $start = strpos($item->link, '=');
                $end = stripos($item->link, '%');
                $source = substr($item->link, $start + 1, $end - $start - 1);
                $pd = strtotime($item->pubDate);
                $smiId = SourceSmi::find()->where(['url' => $source])->one()['id'];

                //Add new smi source if not exist
                if (!$smiId) {
                    if(!($smiId = $this->addSource($source))) {
                        continue;
                    }
                }
                
                //Add new news
                $modelNews = new News();
                if ($metaImg = $this->getImage($link)) {
                    $modelNews->image_url = $metaImg;
                }
                $date = date('Y-m-d H:i:s', $pd + $this->dateInterval);
                $modelNews->pub_date = $date;
                $modelNews->title = trim($item->title);
                $modelNews->description = trim($item->description);
                $modelNews->link = $link;
                $modelNews->news_category_id = $categoryId;
                $modelNews->smi_id = $smiId;
                $modelNews->parse_id = $this->parseId;
                if($modelNews->save()){
                    $this->newsCount++;
                }
            }
        }
    }
    
    private function addSource($url) 
    {
        $name = null;
        try {
            $name = TitleParserHelper::getTitle($url);
        }
        catch (\Exception $e) {
            $error = new ErrorLogHelper();
            $error->createLog($this->parseId, $url, $e->getMessage());
        }
        $modelSourceSmi = new SourceSmi();
        if($name) {
            $modelSourceSmi->name = $name;
        }
        $modelSourceSmi->url = $url;
        $modelSourceSmi->status = 1;
        $modelSourceSmi->parse_id = $this->parseId;
        if ($modelSourceSmi->save()){
            $this->sourceCount++;
            return $modelSourceSmi->id;
        }
        return null;
    }
    
    private function getImage($url) 
    {
        $metaImg = null;
        try {
            $metaImg = MetaParserHelper::getMetaTagsByUrl($url, 'og:image');
        }
        catch (\Exception $e) {
            $error = new ErrorLogHelper();
            $error->createLog($this->parseId, $url, $e->getMessage());
        }
        return $metaImg;
    }

}
