<?php
/**
 * Created by PhpStorm.
 * User: dai
 * Date: 14-8-29
 * Time: 下午4:55
 */

namespace Web\Model;

use Component\Model\FreeModel;


class UserModel  extends FreeModel
{
    /**
     * @var $table_name 数据库表名
     */
    public $tableName = 'user';
}