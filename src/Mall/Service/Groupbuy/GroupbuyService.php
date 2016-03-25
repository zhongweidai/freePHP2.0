<?php
/**
 * Created by PhpStorm.
 * User: dai
 * Date: 14-9-8
 * Time: 上午10:02
 */

namespace Mall\Service\Groupbuy;

use Mall\Service\ServiceBase;
use Mall\Model\GroupbuyModel;
use Utility\FreeArray;

class GroupbuyService extends ServiceBase{

    protected $groupBuyModel;
    public function __construct(){
        $this->groupBuyModel = $this->getModle('Mall:groupbuy');
    }


    /**
     * 读取推荐团购列表
     * @param int $limit 要读取的数量
     */
    public function getGroupbuyCommendedList($limit = 4) {
        $condition = array();
        $condition['state'] = GroupbuyModel::GROUPBUY_STATE_NORMAL;
        $condition['start_time'] = array('lt', TIMESTAMP);
        $condition['end_time'] = array('gt', TIMESTAMP);
        return $this->groupBuyModel->select($condition, array(), $limit, 'recommended desc');
    }
    /**
     * 根据商品编号查询是否有可用团购活动，如果有返回团购活动，没有返回null
     * @param string $goods_string 商品编号字符串，例：'1,22,33'
     * @return array $groupbuy_list
     *
     */
    public function getGroupbuyListByGoodsCommonIDString($goods_commonid_string) {
        $groupbuy_list = $this->_getGroupbuyListByGoodsCommon($goods_commonid_string);
        $groupbuy_list = FreeArray::arrayUnderReset($groupbuy_list, 'goods_commonid');
        return $groupbuy_list;
    }
    

    /**
     * 根据商品编号查询是否有可用团购活动，如果有返回团购活动，没有返回null
     * @param string $goods_id_string
     * @return array $groupbuy_list
     *
     */
    private function _getGroupbuyListByGoodsCommon($goods_commonid_string) {
        $condition = array();
        $condition['state'] = GroupbuyModel::GROUPBUY_STATE_NORMAL;
        $condition['start_time'] = array('lt', TIMESTAMP);
        $condition['end_time'] = array('gt', TIMESTAMP);
        $condition['goods_commonid'] = array('in', $goods_commonid_string);
        $xianshi_goods_list = $this->getGroupbuyList($condition, null, 'groupbuy_id desc', array());
        return $xianshi_goods_list;
    }
    
    /**
     * 读取团购列表
     * @param array $condition 查询条件
     * @param int $page 分页数
     * @param string $order 排序
     * @param string $field 所需字段
     * @return array 团购列表
     *
     */
    public function getGroupbuyList($condition, $page = null, $order = 'state asc', $field = '*', $limit = 0) {
       $groupbuy_list = $this->groupBuyModel->listInfo($condition,$field,$order,$page,$limit);
        if(!empty($groupbuy_list)) {
            for($i =0, $j = count($groupbuy_list); $i < $j; $i++) {
                $groupbuy_list[$i] = $this->getGroupbuyExtendInfo($groupbuy_list[$i]);
            }
        }
        return $groupbuy_list;
    }
    
    /**
     * 根据条件读取团购信息
     * @param array $condition 查询条件
     * @return array 团购信息
     *
     */
    public function getGroupbuyInfo($condition) {
        $groupbuy_info = $this->select($condition);
        $groupbuy_info = $this->getGroupbuyExtendInfo($groupbuy_info);
        return $groupbuy_info;
    }
    
    /**
     * 获取团购扩展信息
     */
    public function getGroupbuyExtendInfo($groupbuy_info) {
        $groupbuy_info['groupbuy_url'] = urlShop('show_groupbuy', 'groupbuy_detail', array('group_id' => $groupbuy_info['groupbuy_id']));
        $groupbuy_info['goods_url'] = urlShop('goods', 'index', array('goods_id' => $groupbuy_info['goods_id']));
        $groupbuy_info['start_time_text'] = date('Y-m-d H:i', $groupbuy_info['start_time']);
        $groupbuy_info['end_time_text'] = date('Y-m-d H:i', $groupbuy_info['end_time']);
        if(empty($groupbuy_info['groupbuy_image1'])) {
            $groupbuy_info['groupbuy_image1'] = $groupbuy_info['groupbuy_image'];
        }
        if($groupbuy_info['start_time'] > TIMESTAMP && $groupbuy_info['state'] == Groupbuy::GROUPBUY_STATE_NORMAL) {
            $groupbuy_info['groupbuy_state_text'] = '正常(未开始)';
        } elseif ($groupbuy_info['end_time'] < TIMESTAMP && $groupbuy_info['state'] == Groupbuy::GROUPBUY_STATE_NORMAL) {
            $groupbuy_info['groupbuy_state_text'] = '已结束';
        } else {
            $groupbuy_info['groupbuy_state_text'] = $this->groupbuy_state_array[$groupbuy_info['state']];
        }
    
        if($groupbuy_info['state'] == Groupbuy::GROUPBUY_STATE_REVIEW) {
            $groupbuy_info['reviewable'] = true;
        } else {
            $groupbuy_info['reviewable'] = false;
        }
    
        if($groupbuy_info['state'] == Groupbuy::GROUPBUY_STATE_NORMAL) {
            $groupbuy_info['cancelable'] = true;
        } else {
            $groupbuy_info['cancelable'] = false;
        }
    
        switch ($groupbuy_info['state']) {
            case Groupbuy::GROUPBUY_STATE_REVIEW:
                $groupbuy_info['state_flag'] = 'not-verify';
                $groupbuy_info['button_text'] = '未审核';
                break;
            case Groupbuy::GROUPBUY_STATE_REVIEW_FAIL:
            case Groupbuy::GROUPBUY_STATE_CANCEL:
            case Groupbuy::GROUPBUY_STATE_CLOSE:
                $groupbuy_info['state_flag'] = 'close';
                $groupbuy_info['button_text'] = '已结束';
                break;
            case Groupbuy::GROUPBUY_STATE_NORMAL:
                if($groupbuy_info['start_time'] > TIMESTAMP) {
                    $groupbuy_info['state_flag'] = 'not-start';
                    $groupbuy_info['button_text'] = '未开始';
                    $groupbuy_info['count_down_text'] = '距团购开始';
                    $groupbuy_info['count_down'] = $groupbuy_info['start_time'] - TIMESTAMP;
                } elseif ($groupbuy_info['end_time'] < TIMESTAMP) {
                    $groupbuy_info['state_flag'] = 'close';
                    $groupbuy_info['button_text'] = '已结束';
                } else {
                    $groupbuy_info['state_flag'] = 'buy-now';
                    $groupbuy_info['button_text'] = '我要团';
                    $groupbuy_info['count_down_text'] = '距团购结束';
                    $groupbuy_info['count_down'] = $groupbuy_info['end_time'] - TIMESTAMP;
                }
                break;
        }
        return $groupbuy_info;
    }

    public function getGroupBuyModel()
    {
        return $this->groupBuyModel;
    }

} 