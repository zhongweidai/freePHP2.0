<?php
/**
 * Created by PhpStorm.
 * User: dai
 * Date: 14-9-8
 * Time: 上午9:45
 */

namespace Mall\Model;

class GroupbuyModel extends MallModel
{
    protected $tableName = 'groupbuy';
    protected $pkId = 'groupbuy_id';
    const GROUPBUY_STATE_REVIEW = 10;
    const GROUPBUY_STATE_NORMAL = 20;
    const GROUPBUY_STATE_REVIEW_FAIL = 30;
    const GROUPBUY_STATE_CANCEL = 31;
    const GROUPBUY_STATE_CLOSE = 32;
    private $groupbuyStateArray = array(
        0 => '全部',
        self::GROUPBUY_STATE_REVIEW => '审核中',
        self::GROUPBUY_STATE_NORMAL => '正常',
        self::GROUPBUY_STATE_CLOSE => '已结束',
        self::GROUPBUY_STATE_REVIEW_FAIL => '审核失败',
        self::GROUPBUY_STATE_CANCEL => '管理员关闭',
    );

    public function getStatusArray()
    {
        return $this->groupbuyStateArray;
    }

} 