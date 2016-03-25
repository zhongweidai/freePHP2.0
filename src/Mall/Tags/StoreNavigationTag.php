<?php

namespace Mall\Tags;

use Mall\Service\ServiceBase;

class StoreNavigationTag extends ServiceBase 
{
	public function __construct()
	{
		
	}
	public function getData($data)
	{
		$model_store_navigation = Model('store_navigation');
		$store_navigation_list = $model_store_navigation->getStoreNavigationList(array('sn_store_id' => $store_id));
	}
}

?>