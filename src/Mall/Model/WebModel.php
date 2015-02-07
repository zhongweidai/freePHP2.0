<?php
/**
 * Created by PhpStorm.
 * User: dai
 * Date: 14-9-8
 * Time: 下午7:59
 */

namespace Mall\Model;


use Component\Model\FreeModel;

class WebModel extends FreeModel {
    protected $tableName = 'web';
    protected $pkId = 'web_id';
} 