<?php
/**
 * Created by PhpStorm.
 * User: dai
 * Date: 14-9-8
 * Time: 下午7:16
 */

namespace Mall\Model;

class PXianshiGoodsModel extends MallModel {
    protected $tableName = 'p_xianshi_goods';
    protected $pkId = 'xianshi_goods_id';

    const XIANSHI_GOODS_STATE_CANCEL = 0;
    const XIANSHI_GOODS_STATE_NORMAL = 1;

} 