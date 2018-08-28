<?php

namespace app\helpers;

/**
 * TitleParserHelper provides the possibility of parsing page element title
 *
 * @author ValentinBV <svix88@mail.ru>
 * @since 2.0
 */
class TitleParserHelper 
{

    private static $protocol = 'http://';
    private static $timeout = 20;

    public static function getTitle($url) 
    {
        $ctx = stream_context_create(['http'=>
            [
                'timeout' => self::$timeout,
            ]
        ]);
        try {
            $content = file_get_contents(self::$protocol.$url, false, $ctx);
            if ($content === false) {
                return null;
            }

            $matches = array();
            if (preg_match('/<title>(.*?)<\/title>/', $content, $matches)) {
                return $matches[1];
            } else {
                return null;
            }
        } catch (\Exception $e) {
            throw new \Exception("Load smi resource failed");
        }
    }
    
    public static function setTimeout($timeout) 
    {
        self::$timeout = $timeout;
    }
    
    public static function setProtocol($protocol) 
    {
        self::$protocol = $protocol;
    }

}
