<?php

namespace app\helpers;

use app\models\ParseLog;

/**
 * ParseLogHelper class for work with parse_log table
 *
 * @author ValentinBV <svix88@mail.ru>
 * @since 2.0
 */

class ParseLogHelper 
{
   
    private $parseLog;
    
    public function beginParse($parseType) 
    {
        $this->parseLog = new ParseLog();
        $this->parseLog->type = $parseType;
        if ($this->parseLog->save()) {
            return $this->parseLog->id;
        }
    }
    
    public function endParse($newsCount, $time, $sourceCount) 
    {
        $this->parseLog->time = $time;
        $this->parseLog->count = $newsCount;
        $this->parseLog->source_count = $sourceCount;
        if ($this->parseLog->save()) {
            return true;
        }
    }
}