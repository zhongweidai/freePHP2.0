<?php
/**
 * User: dai
 * Date: 14-8-29
 * Time: 下午4:55
 */

namespace Mall\Model;

use Component\Model\FreeModel;


class MemberModel  extends FreeModel
{
    /**
     * @var $table_name 数据库表名
     */
    protected  $tableName = 'member';
    protected $pkId  = 'member_id';
}