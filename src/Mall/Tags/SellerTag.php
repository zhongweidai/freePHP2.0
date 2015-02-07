<?php

namespace Mall\Tags;

use Mall\Service\ServiceBase;

class SellerTag extends ServiceBase 
{
	
	public function getData()
	{
		//卖家列表
		$seller_list = $model_seller->getSellerList(array('store_id' => $store_info['store_id'], 'is_admin' => '0'), null, 'seller_id asc');
		Tpl::output('seller_list', $seller_list);
	}
}

?>