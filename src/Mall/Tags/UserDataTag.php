<?php
/**
 * Created by PhpStorm.
 * User: dai
 * Date: 14-9-2
 * Time: 上午9:28
 */

namespace Mall\Tags;
use Mall\Service\ServiceBase;

class UserDataTag extends ServiceBase {

    public function getData($arg)
    {
        var_dump($arg);
    }

} 