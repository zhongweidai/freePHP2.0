<?php

namespace Mall\Service\Sns;

use Mall\Service\ServiceBase;

class SnsGoodsService extends ServiceBase 
{
	protected $snsGoodsModel;
	
	public function __construct()
	{
		$this->snsGoodsModel = $this->getModle('Mall:SnsGoods');
	}
	
	public function getSnsGoodsInfo($goods_id)
	{
		// 查询SNS中该商品的信息
		$data = array();
		$snsgoodsinfo = $this->snsGoodsModel->select(array('snsgoods_goodsid' => $goods_id), 'snsgoods_likenum,snsgoods_sharenum');
		$data['likenum'] = $snsgoodsinfo['snsgoods_likenum'];
		$data['sharenum'] = $snsgoodsinfo['snsgoods_sharenum'];
		return $data;
	}
	
}

?>