<?php
/**
 * User: dai
 * Date: 14-8-29
 * Time: 下午4:55
 */

namespace Mall\Model;

class MemberModel extends MallModel
{
    /**
     * @var $table_name 数据库表名
     */
    protected  $tableName = 'member';
    protected $pkId  = 'member_id';
}