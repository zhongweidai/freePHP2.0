<?php

namespace Mall\Tags;

use Mall\Service\ServiceBase;

class StoreTag extends ServiceBase 
{
	public function __construct(){
		
	}
	
	public function getData($data)
	{
		//热销排行
		$hot_sales = $model_store->getHotSalesList($store_info['store_id'], 5);
		Tpl::output('hot_sales', $hot_sales);
		
		//收藏排行
		$hot_collect = $model_store->getHotCollectList($store_info['store_id'], 5);
		Tpl::output('hot_collect', $hot_collect);
	}
}

?>