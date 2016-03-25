<?php
/**
 * Created by PhpStorm.
 * User: dai
 * Date: 14-9-7
 * Time: 上午11:52
 */

namespace Mall\Ext;


class Language
{
    public static function read($path)
    {
        return $path;
    }

    public static function getLangContent($path='')
    {
        return "[$path]";
    }
} 