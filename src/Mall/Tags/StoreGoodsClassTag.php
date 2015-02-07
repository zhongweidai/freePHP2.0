<?php

namespace Mall\Tags;

use Mall\Service\ServiceBase;

class StoreGoodsClassTag extends ServiceBase
{
	public function __construct(){
	}
	
	public function getData($data)
	{
		//店铺分类
		$goodsclass_model = Model('my_goods_class');
		$goods_class_list = $goodsclass_model->getShowTreeList($store_info['store_id']);
		Tpl::output('goods_class_list', $goods_class_list);
	}
}

?>