<?php

namespace Mall\Controller\Goods;

use Mall\Controller\BaseController;
use Free\Libs\FreeException;
use Mall\Service\ServiceUtil;

class IndexController extends BaseController 
{
	/**
	 * 单个商品信息页
	 */
	public function initAction () {
		$goods_id = intval($this->getRequest()->getGet('goods_id'));
	
		// 商品详细信息
		$model_goods = $this->getService('Mall:Goods.GoodsService');
		$goods_info = $model_goods->getGoodsDetail($goods_id, '*');
		if (empty($goods_info)) {
			$this->createMessageResponse(ServiceUtil::lang('goods:index_no_goods'),'',0);
		}
	
		
		if ($_cache = $this->getService('Mall:System.CacheService')->call('Mall:Sns.SnsGoodsService::getSnsGoodsInfo',array($goods_info['goods_id']))) {
			foreach ($_cache as $k => $v) {
				$goods_info[$k] = $v;
			}
		} 
	/* 
		// 检查是否为店主本人
		$store_self = false;
		if (!empty($_SESSION['store_id'])) {
			if ($goods_info['store_id'] == $_SESSION['store_id']) {
				$store_self = true;
			}
		}
		Tpl::output('store_self',$store_self ); */
	
		// 如果使用运费模板
		if ($goods_info['transport_id'] > 0) {
			// 取得三种运送方式默认运费
			$model_transport = Model('transport');
			$transport = $model_transport->getExtendList(array('transport_id' => $goods_info['transport_id'], 'is_default' => 1));
			if (!empty($transport) && is_array($transport)) {
				foreach ($transport as $v) {
					$goods_info[$v['type'] . "_price"] = $v['sprice'];
				}
			}
		}
		Tpl::output('goods', $goods_info);
	
		// 关联版式
		$plateid_array = array();
		if (!empty($goods_info['plateid_top'])) {
			$plateid_array[] = $goods_info['plateid_top'];
		}
		if (!empty($goods_info['plateid_bottom'])) {
			$plateid_array[] = $goods_info['plateid_bottom'];
		}
		if (!empty($plateid_array)) {
			$plate_array = Model('store_plate')->getPlateList(array('plate_id' => array('in', $plateid_array), 'store_id' => $goods_info['store_id']));
			$plate_array = array_under_reset($plate_array, 'plate_position', 2);
			Tpl::output('plate_array', $plate_array);
		}
	
		Tpl::output('store_id', $goods_info ['store_id']);
	
		// 输出一级地区
		$area_list = array(1 => '北京', 2 => '天津', 3 => '河北', 4 => '山西', 5 => '内蒙古', 6 => '辽宁', 7 => '吉林', 8 => '黑龙江', 9 => '上海',
				10 => '江苏', 11 => '浙江', 12 => '安徽', 13 => '福建', 14 => '江西', 15 => '山东', 16 => '河南', 17 => '湖北', 18 => '湖南',
				19 => '广东', 20 => '广西', 21 => '海南', 22 => '重庆', 23 => '四川', 24 => '贵州', 25 => '云南', 26 => '西藏', 27 => '陕西',
				28 => '甘肃', 29 => '青海', 30 => '宁夏', 31 => '新疆', 32 => '台湾', 33 => '香港', 34 => '澳门', 35 => '海外'
		);
		if (strtoupper(CHARSET) == 'GBK') {
			$area_list = Language::getGBK($area_list);
		}
		Tpl::output('area_list', $area_list);
	
		// 生成浏览过产品
		$cookievalue = $goods_id . '-' . $goods_info ['store_id'];
		if (cookie('viewed_goods')) {
			$string_viewed_goods = decrypt(cookie('viewed_goods'), MD5_KEY);
			if (get_magic_quotes_gpc()) {
				$string_viewed_goods = stripslashes($string_viewed_goods); // 去除斜杠
			}
			$vg_ca = @unserialize($string_viewed_goods);
			$sign = true;
			if ( !empty($vg_ca) && is_array($vg_ca)) {
				foreach ($vg_ca as $vk => $vv) {
					if ($vv == $cookievalue) {
						$sign = false;
					}
				}
			} else {
				$vg_ca = array();
			}
	
			if ($sign) {
				if (count($vg_ca) >= 6) {
					$vg_ca[] = $cookievalue;
					array_shift($vg_ca);
				} else {
					$vg_ca[] = $cookievalue;
				}
			}
		} else {
			$vg_ca[] = $cookievalue;
		}
		$vg_ca = encrypt(serialize($vg_ca), MD5_KEY);
		setNcCookie('viewed_goods', $vg_ca);
	
		//优先得到推荐商品
		$goods_commend_list = $model_goods->getGoodsOnlineList(array('store_id' => $goods_info['store_id'], 'goods_commend' => 1), 'goods_id,goods_name,goods_jingle,goods_image,store_id,goods_price', 0, 'rand()', 5, 'goods_commonid');
		Tpl::output('goods_commend',$goods_commend_list);
	
	
		// 当前位置导航
		$nav_link_list = Model('goods_class')->getGoodsClassNav($goods_info['gc_id'], 0);
		$nav_link_list[] = array('title' => $goods_info['goods_name']);
		Tpl::output('nav_link_list', $nav_link_list );
	
		//评价信息
		$goods_evaluate_info = Model('evaluate_goods')->getEvaluateGoodsInfoByGoodsID($goods_id);
		Tpl::output('goods_evaluate_info', $goods_evaluate_info);
	
		$seo_param = array ();
		$seo_param['name'] = $goods_info['goods_name'];
		$seo_param['key'] = $goods_info['goods_keywords'];
		$seo_param['description'] = $goods_info['goods_description'];
		Model('seo')->type('product')->param($seo_param)->show();
		Tpl::showpage('goods');
	}
}

?>