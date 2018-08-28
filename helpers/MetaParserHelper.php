<?php

namespace app\helpers;

/**
 * MetaParserHelper provides the possibility of parsing page meta elements
 *
 * @author ValentinBV <svix88@mail.ru>
 * @since 2.0
 */
class MetaParserHelper 
{

    private static $protocol = 'http://';
    private static $timeout = 10;

    public static function getMetaTagsByUrl($url, $tag) 
    {
        $ctx = stream_context_create(['http' =>
                [
                'timeout' => self::$timeout,
            ]
        ]);
        try {
            $content = file_get_contents(self::$protocol . $url, false, $ctx);
            if ($content === false) {
                return null;
            }
            $html = new \DOMDocument();
            // Disable html document validate
            libxml_use_internal_errors(true);
            if ($html->loadHTML($content)) {
                $metaTag = [];
                foreach ($html->getElementsByTagName('meta') as $meta) {
                    if ($meta->getAttribute('property') == $tag) {
                        $metaTag[$tag] = $meta->getAttribute('content');
                    }
                }
                if (array_key_exists($tag, $metaTag)) {
                    return $metaTag[$tag];
                }
                return null;
            }
            libxml_clear_errors();
        } catch (\Exception $e) {
            throw new \Exception("Load news page resource failed");
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
