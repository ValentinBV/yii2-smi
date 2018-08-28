<?php

namespace app\helpers;
use app\models\ErrorLog;


/**
 * Logger for errors using DataBase
 * 
 * @author ValentinBV <svix88@mail.ru>
 * @since 2.0
 */

class ErrorLogHelper
{
    
    public function createLog($parseId, $source, $error, $status = 0) 
    {
        $errorModel = new ErrorLog();
        $errorModel->parse_id = $parseId;
        $errorModel->source = $source;
        $errorModel->error = $error;
        $errorModel->status = $status;
        if ($errorModel->save()) {
            return true;
        }
    }
    
}
