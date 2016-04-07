<?php
/**
 * Created by PhpStorm.
 * User: dai
 * Date: 14-9-8
 * Time: 下午7:21
 */

namespace Mall\Service\P;
use Mall\Model\PXianshiGoodsModel;
use Mall\Service\ServiceBase;

use Utility\FreeArray;
use Mall\Service\ServiceUtil;

class XianshiGoodsService extends ServiceBase {
    protected $pXianshiGoodsModel;
    public function __construct(){
        $this->pXianshiGoodsModel = $this->getModle('Mall:pXianshiGoods');
    }


    /**
     * 获取推荐限时折扣商品
     * @param int $count 推荐数量
     * @return array 推荐限时活动列表
     *
     */
    public function getXianshiGoodsCommendList($count = 4) {
        $condition = array();
        $condition['state'] = PXianshiGoodsModel::XIANSHI_GOODS_STATE_NORMAL;
        $condition['start_time'] = array('lt', TIMESTAMP);
        $condition['end_time'] = array('gt', TIMESTAMP);
        $xianshi_list = $this->pXianshiGoodsModel->select($condition, array(),$count, 'xianshi_recommend desc');
        return $xianshi_list;
    }
    /**
     * 根据商品编号查询是否有可用限时折扣活动，如果有返回限时折扣活动，没有返回null
     * @param string $goods_string 商品编号字符串，例：'1,22,33'
     * @return array $xianshi_goods_list
     *
     */
    public function getXianshiGoodsListByGoodsString($goods_string) {
        $xianshi_goods_list = $this->_getXianshiGoodsListByGoods($goods_string);
        $xianshi_goods_list = FreeArray::arrayUnderReset($xianshi_goods_list, 'goods_id');
        return $xianshi_goods_list;
    }
    

    /**
     * 根据商品编号查询是否有可用限时折扣活动，如果有返回限时折扣活动，没有返回null
     * @param string $goods_id_string
     * @return array $xianshi_info
     *
     */
    private function _getXianshiGoodsListByGoods($goods_id_string) {
        $condition = array();
        $condition['state'] = self::XIANSHI_GOODS_STATE_NORMAL;
        $condition['start_time'] = array('lt', TIMESTAMP);
        $condition['end_time'] = array('gt', TIMESTAMP);
        $condition['goods_id'] = array('in', $goods_id_string);
        $xianshi_goods_list = $this->getXianshiGoodsList($condition, null, 'xianshi_goods_id desc', '*');
        return $xianshi_goods_list;
    }
    /**
     * 读取限时折扣商品列表
     * @param array $condition 查询条件
     * @param int $page 分页数
     * @param string $order 排序
     * @param string $field 所需字段
     * @param int $limit 个数限制
     * @return array 限时折扣商品列表
     *
     */
    public function getXianshiGoodsList($condition, $page=null, $order='', $field='*', $limit = 0) {
        $xianshi_goods_list = $this->pXianshiGoodsModel->listInfo($condition,$field,$order,$page,$limit);
        if(!empty($xianshi_goods_list)) {
            for($i=0, $j=count($xianshi_goods_list); $i < $j; $i++) {
                $xianshi_goods_list[$i] = $this->getXianshiGoodsExtendInfo($xianshi_goods_list[$i]);
            }
        }
        return $xianshi_goods_list;
    }
    
    /**
     * 获取限时折扣商品扩展信息
     * @param array $xianshi_info
     * @return array 扩展限时折扣信息
     *
     */
    public function getXianshiGoodsExtendInfo($xianshi_info) {
        $xianshi_info['goods_url'] = ServiceUtil::path('goods/index/', array('goods_id' => $xianshi_info['goods_id']));
        $xianshi_info['image_url'] = ServiceUtil::cthumb($xianshi_info['goods_image'], 60, $xianshi_info['store_id']);
        $xianshi_info['xianshi_price'] = number_format($xianshi_info['xianshi_price'],2,'.','');
        $xianshi_info['xianshi_discount'] = number_format($xianshi_info['xianshi_price'] / $xianshi_info['goods_price'] * 10, 1).'折';
        return $xianshi_info;
    }

} 