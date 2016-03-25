<?php
namespace Mall\Service\Goods;
use Mall\Service\ServiceBase;
use Mall\Model\GoodsModel;
use Utility\FreeCookie;
use Utility\FreeSecurity;

class GoodsService extends ServiceBase
{
    protected $goodsAttrIndexModel;
    protected $goodsModel;
    protected $goodsImageModel;
    
    public function __construct()
    {
        $this->goodsAttrIndexModel = $this->getModle('Mall:GoodsAttrIndex');
        $this->goodsModel = $this->getModle('Mall:Goods');
        $this->goodsImageModel = $this->getModle('Mall:GoodsImage');
    }
    /**
     * 出售中的商品SKU列表（只显示不同颜色的商品，前台商品索引，店铺也商品列表等使用）
     * @param array $condition
     * @param string $field
     * @param string $order
     * @param number $page
     * @return array
     */
    public function getGoodsListByColorDistinct($condition, $field = '*', $order = 'goods_id asc', $page = 0) {
        $condition['goods_state']   = GoodsModel::STATE1;
        $condition['goods_verify']  = GoodsModel::VERIFY1;
        $condition = $this->_getRecursiveClass($condition);
        return $this->goodsModel->getGoodsListByColorDistinct($condition,$field,$order,$page);
    }
    
    /**
     * 获得商品子分类的ID
     * @param array $condition
     * @return array
     */
    private function _getRecursiveClass($condition){
        if (isset($condition['gc_id']) && !is_array($condition['gc_id'])) {
            $gc_list = $this->getService('Mall:System.CacheService')->call('Mall:Goods.GoodsClassService::getSnsGoodsInfo');
            if (!empty($gc_list[$condition['gc_id']])) {
                $gc_id[] = $condition['gc_id'];
                $gcchild_id = empty($gc_list[$condition['gc_id']]['child']) ? array() : explode(',', $gc_list[$condition['gc_id']]['child']);
                $gcchildchild_id = empty($gc_list[$condition['gc_id']]['childchild']) ? array() : explode(',', $gc_list[$condition['gc_id']]['childchild']);
                $gc_id = array_merge($gc_id, $gcchild_id, $gcchildchild_id);
                $condition['gc_id'] = array('in', $gc_id);
            }
        }
        return $condition;
    }
    
    public function getGoodsOnlineList($condition, $field = array(), $page = 0, $order = 'goods_id desc', $limit = 0, $group = '', $lock = false, $count = 0)
    {
        return $this->goodsModel->getGoodsOnlineList($condition, $field, $page, $order, $limit, $group, $lock, $count);
   ;
    }
    
    /**
     * 商品图片列表
     *
     * @param array $condition
     * @param array $order
     * @param string $field
     * @return array
     */
    public function getGoodsImageList($condition, $field = array(), $order = 'is_default desc,goods_image_sort asc') {
        return $this->goodsImageModel->select($condition,$field,'',$order);
    }
    /**
     * 浏览过的商品
     *
     * @return array
     */
    public function getViewedGoodsList() {
        //取浏览过产品的cookie(最大四组)
        $viewed_goods = array();
        $cookie_i = 0;
    
        if(FreeCookie::get('viewed_goods')){
            $string_viewed_goods = FreeSecurity::decrypt(cookie('viewed_goods'),MD5_KEY);
            if (get_magic_quotes_gpc()) $string_viewed_goods = stripslashes($string_viewed_goods);//去除斜杠
            $cookie_array = array_reverse(unserialize($string_viewed_goods));
            $goodsid_array = array();
            foreach ((array)$cookie_array as $k=>$v){
                $info = explode("-", $v);
                if (is_numeric($info[0])){
                    $goodsid_array[] = intval($info[0]);
                }
            }
            $viewed_list    = $this->goodsModel->select(array('goods_id' => array('in', $goodsid_array)), 'goods_id, goods_name, goods_price, goods_image, store_id');
            foreach ((array)$viewed_list as $val){
                $viewed_goods[] = array(
                        "goods_id"      => $val['goods_id'],
                        "goods_name"    => $val['goods_name'],
                        "goods_image"   => $val['goods_image'],
                        "goods_price"   => $val['goods_price'],
                        "store_id"      => $val['store_id']
                );
            }
        }
        return $viewed_goods;
    }
    
    public function getGoodsDetail($goods_id,$filed='*')
    {
    	return $this->goodsModel->getOne(array('goods_id'=>$goods_id),$filed);
    }
}

?>