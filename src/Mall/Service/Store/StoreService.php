<?php
namespace Mall\Service\Store;
use Mall\Service\ServiceBase;

class StoreService extends ServiceBase
{
    protected $storeModel;
    
    public function __construct(){
        $this->storeModel = $this->getModle('Mall:Store');
        
    }
    
    /**
	 * 按店铺编号查询店铺的开店信息
     *
	 * @param array $storeid_array 店铺编号
     * @return array
	 */
    public function getStoreMemberIDList($storeid_array) {
        $store_list = $this->storeModel->select(array('store_id'=> array('in', $storeid_array)),'store_id,member_id,store_domain');
        return $store_list;
    }
}

?>