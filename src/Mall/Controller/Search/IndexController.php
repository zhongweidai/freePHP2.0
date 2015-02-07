<?php
namespace Mall\Controller\Search;

use Mall\Controller\BaseController;
use Mall\Ext\Language;

class IndexController extends BaseController
{
    //每页显示商品数
    const PAGESIZE = 24;
    
    //模型对象
    private $_model_search;
    protected $get = array(
    		'b_id' => 0,
    		'keyword'=>'',
    		'area_id'=>0,
    		'key'=>0,
    		'a_id' => 0,
    		'cate_id'=>0,
    		'type'=>0,
    		'nav_id' => 0,
    );
    
    public function _init_(){
    	
        $get = $this->getRequest()->getGet();
        $get && is_array($get) && $this->get = array_merge($this->get,$get);
        
        $this->assign('get',$this->get);
    }
    
    public function initAction() {
    
        //优先从全文索引库里查找
        list($indexer_ids,$indexer_count) = $this->indexerSearch();
        $data_attr = $this->getAttrList();
        //处理排序
        $order = 'goods_id desc';
        $this->get['key'] = isset($this->get['key']) ? $this->get['key'] : 0;
        if (in_array($this->get['key'],array('1','2','3'))) {
            $sequence = $this->get['order'] == '1' ? 'asc' : 'desc';
            $order = str_replace(array('1','2','3'), array('goods_salenum','goods_click','goods_price'), $this->key['key']);
            $order .= ' '.$sequence;
        }
       
        if (!isset($data_attr['sign']) || $data_attr['sign'] === true) {
            // 字段
            $fields = "goods_id,goods_commonid,goods_name,goods_jingle,gc_id,store_id,store_name,goods_price,goods_marketprice,goods_storage,goods_image,goods_freight,goods_salenum,color_id,evaluation_good_star,evaluation_count";
    
            $condition = array();
            if (is_array($indexer_ids)) {
    
                //商品主键搜索
                $condition['goods_id'] = array('in',$indexer_ids);
                $goods_list = $this->getService('Mall:Goods.GoodsService')->getGoodsOnlineList($condition, $fields, 0, $order, self::PAGESIZE, null, false);
                //pagecmd('setEachNum',self::PAGESIZE);
                //pagecmd('setTotalNum',$indexer_count);
    
            } else {
    
                //执行正常搜索
                if (isset($data_attr['gcid_array'])) {
                    $condition['gc_id'] = array('in', $data_attr['gcid_array']);
                }
                if (intval($this->get['b_id']) > 0) {
                    $condition['brand_id'] = intval($this->get['b_id']);
                }
                if ($this->get['keyword'] != '') {
                    $condition['goods_name|goods_jingle'] = array('like', '%' . $this->get['keyword'] . '%');
                }
                if (intval($this->get['area_id']) > 0) {
                    $condition['areaid_1'] = intval($this->get['area_id']);
                }
                if (in_array($this->get['type'], array(1,2))) {
                    if ($this->get['type'] == 1) {
                        $condition['store_id'] = $this->getContainer()->loadConfig('system','default_store_id');
                    } else if ($this->get['type'] == 2) {
                        $condition['store_id'] = array('neq', $this->getContainer()->loadConfig('system','default_store_id'));
                    }
                }
                if (isset($data_attr['goodsid_array'])){
                    $condition['goods_id'] = array('in', $data_attr['goodsid_array']);
                }
                $goods_list = $this->getService('Mall:Goods.GoodsService')->getGoodsListByColorDistinct($condition, $fields, $order, self::PAGESIZE);
            }
            // $this->assign('show_page1', $this->getService('Mall:Goods.Goods')->showpage(4));
           //$this->assign('show_page', $this->getService('Mall:Goods.Goods')->showpage(5));
    
            // 商品多图
            if (!empty($goods_list)) {
                $goodsid_array = array();       // 商品id数组
                $commonid_array = array(); // 商品公共id数组
                $storeid_array = array();       // 店铺id数组
                foreach ($goods_list as $value) {
                    $goodsid_array[] = $value['goods_id'];
                    $commonid_array[] = $value['goods_commonid'];
                    $storeid_array[] = $value['store_id'];
                }
                $goodsid_array = array_unique($goodsid_array);
                $commonid_array = array_unique($commonid_array);
                $storeid_array = array_unique($storeid_array);
    
                // 商品多图
                $goodsimage_more = $this->getService('Mall:Goods.GoodsService')->getGoodsImageList(array('goods_commonid' => array('in', $commonid_array)));
                // 店铺
                $store_list = $this->getService('Mall:Store.StoreService')->getStoreMemberIDList($storeid_array);
    
                // 团购
                if ($this->getContainer()->loadConfig('system','groupbuy_allow')) {
                    $groupbuy_list = $this->getService('Mall:Groupbuy.GroupbuyService')->getGroupbuyListByGoodsCommonIDString(implode(',', $commonid_array));
                }
    
                if ($this->getContainer()->loadConfig('system','promotion_allow')) {
                    // 限时折扣
                    $xianshi_list = $this->getService('Mall:P.XianshiGoodsService')->getXianshiGoodsListByGoodsString(implode(',', $goodsid_array));
                }
    
                foreach ($goods_list as $key => $value) {
                    // 商品多图
                    foreach ($goodsimage_more as $v) {
                        if ($value['goods_commonid'] == $v['goods_commonid'] && $value['store_id'] == $v['store_id'] && $value['color_id'] == $v['color_id']) {
                            $goods_list[$key]['image'][] = $v;
                        }
                    }
                    // 店铺的开店会员编号
                    $store_id = $value['store_id'];
                    $goods_list[$key]['member_id'] = $store_list[$store_id]['member_id'];
                    $goods_list[$key]['store_domain'] = $store_list[$store_id]['store_domain'];
                    // 团购
                    if (isset($groupbuy_list[$value['goods_commonid']])) {
                        $goods_list[$key]['goods_price'] = $groupbuy_list[$value['goods_commonid']]['groupbuy_price'];
                        $goods_list[$key]['group_flag'] = true;
                    }
                    if (isset($xianshi_list[$value['goods_id']]) && !$goods_list[$key]['group_flag']) {
                        $goods_list[$key]['goods_price'] = $xianshi_list[$value['goods_id']]['xianshi_price'];
                        $goods_list[$key]['xianshi_flag'] = true;
                    }
                }
            }
            $this->assign('goods_list', $goods_list);
        }
        $this->assign('class_name',  @$data_attr['gc_name']);
    
        //显示左侧分类
        if (intval($this->get['cate_id']) > 0) {
            $goods_class_array = $this->getSearchService()->getLeftCategory(array($this->get['cate_id']));
        } elseif ($this->get['keyword'] != '') {
            $goods_class_array = $this->getSearchService()->getTagCategory($this->get['keyword']);
        }
        $this->assign('goods_class_array', $goods_class_array);
        if ($this->get['keyword'] == ''){
            //不显示无商品的搜索项
            if ($this->getContainer()->loadConfig('system','fullindexer_open')) {
                $data_attr['brand_array'] = $this->getSearchService()->delInvalidBrand($data_attr['brand_array']);
                $data_attr['attr_array'] = $this->getSearchService()->delInvalidAttr($data_attr['attr_array']);
            }
        }
    
        //抛出搜索属性
       isset($data_attr['brand_array']) && $this->assign('brand_array',$data_attr['brand_array']);
       isset($data_attr['attr_array']) && $this->assign('attr_array',$data_attr['attr_array']);
        //         Tpl::output('cate_array',$data_attr['cate_array']);
       isset($data_attr['checked_brand']) && $this->assign('checked_brand', $data_attr['checked_brand']);
       isset($data_attr['checked_attr'])&& $this->assign('checked_attr', $data_attr['checked_attr']);

    
        // SEO
/*         if ($this->get['keyword'] == '') {
            $seo_class_name = @$data_attr['gc_name'];
            $cate_id = $this->get['cate_id'];
            if (is_numeric($cate_id) && empty($cate_id)) {
                $seo_info = $this->getService('Mall:Goods.GoodsClassService')->getKeyWords(intval($this->get['cate_id']));
                if (empty($seo_info[1])) {
                    $seo_info[1] = Language::read('site_name') . ' - ' . $seo_class_name;
                }
                //Model('seo')->type($seo_info)->param(array('name' => $seo_class_name))->show();
            } elseif ($this->get['keyword'] != '') {
                $this->assign('html_title', (empty($this->get['keyword']) ? '' : $this->get['keyword'] . ' - ') . C('site_name') . L('nc_common_search'));
            }
        } */
    
        // 当前位置导航
        $nav_link_list = $this->getService('Mall:Goods.GoodsClassService')->getGoodsClassNav(intval($this->get['cate_id']));
        $this->assign('nav_link_list', $nav_link_list );
    
        // 得到自定义导航信息
        $nav_id = intval($this->get['nav_id']) ? intval($this->get['nav_id']) : 0;
        $this->assign('index_sign', $nav_id);
    
        // 地区
        $area_array = $this->getCacheService()->call('Mall:System.AreaService::getAllArea');
       $this->assign('area_array', $area_array);
    
      //  loadfunc('search');
    
        // 浏览过的商品
        $viewed_goods = $this->getService('Mall:Goods.GoodsService')->getViewedGoodsList();
        $this->assign('viewed_goods',$viewed_goods);
    
        return $this->template('Search/index_init.html');
    
    }
    
    /**
     * 全文搜索
     * @return array 商品主键，搜索结果总数
     */
    private function indexerSearch() {
        if (!$this->_container->loadConfig('system','fullindexer_open')) 
        {
            return array(null,0);
        }
    
        $condition = array();
    
        //拼接条件
        if (intval($this->get['cate_id']) > 0) {
            
            $cate_id = intval($this->get['cate_id']);
            $goods_class = $this->getCacheService()->call('Mall:Goods.GoodsClassService::getGoodsClass');
            $depth = $goods_class[$cate_id]['depth'];
            $cate_field = 'cate_'.$depth;
            $condition['cate']['key'] = $cate_field;
            $condition['cate']['value'] = $cate_id;
        }
        if ($this->get['keyword'] != '') {
            $condition['keyword'] = $this->get['keyword'];
        }
        if (intval($this->get['b_id']) > 0) {
            $condition['brand_id'] = intval($this->get['b_id']);
        }
        if (preg_match('/^[\d_]+$/',$this->get['a_id'])) {
            $attr_ids = explode('_',$this->get['a_id']);
            if (is_array($attr_ids)){
                foreach ($attr_ids as $v) {
                    if (intval($v) > 0) {
                        $condition['attr_id'][] = intval($v);
                    }
                }
            }
        }
        if (in_array($this->get['type'],array('1','2'))) {
            $condition['store_id'] = $this->get['type'];
        }
        if (intval($this->get['area_id']) > 0) {
            $condition['area_id'] = intval($this->get['area_id']);
        }
    
        //拼接排序(销量,浏览量,价格)
        $order = array();
        $order['key'] = 'goods_id';
        $order['value'] = false;
        if (in_array($this->get['key'],array('1','2','3'))) {
            $order['value'] = $this->get['order'] == '1' ? true : false;
            $order['key'] = str_replace(array('1','2','3'), array('goods_salenum','goods_click','goods_price'), $this->get['key']);
        }
    
        //取得商品主键等信息
        $result = $this->getSearchService()->getIndexerList($condition,$order,self::PAGESIZE);
        if ($result !== false) {
            list($indexer_ids,$indexer_count) = $result;
            //如果全文搜索发生错误，后面会再执行数据库搜索
        } else {
            $indexer_ids = null;
            $indexer_count = 0;
        }
    
        return array($indexer_ids,$indexer_count);
    }
    
    /**
     * 取得商品属性
     */
    private function getAttrList() {
        if (intval($this->get['cate_id']) > 0) {
            $data = $this->getSearchService()->getAttrList($this->get);
        } else {
            $data = array();
        }
        return $data;
    }
    
    /**
     * 获得推荐商品
     */
    public function getBoothGoodsAction() {
        $gc_id = $this->get['cate_id'];
        if ($gc_id <= 0) {
            return $this->createStringResponse();
        }
        // 获取分类id及其所有子集分类id
        $goods_class =  $this->getCacheService()->call('Mall:Goods.GoodsClassService::getGoodsClass');
        if (empty($goods_class[$gc_id])) {
            return $this->createStringResponse();
        }
        $child = (!empty($goods_class[$gc_id]['child'])) ? explode(',', $goods_class[$gc_id]['child']) : array();
        $childchild = (!empty($goods_class[$gc_id]['childchild'])) ? explode(',', $goods_class[$gc_id]['childchild']) : array();
        $gcid_array = array_merge(array($gc_id), $child, $childchild);
        // 查询添加到推荐展位中的商品id
        $boothgoods_list = $this->getService('Mall:P.BoothGoodsService')->getBoothGoodsList(array('gc_id' => array('in', $gcid_array)), 'goods_id', 0, 4, 'rand()');
        if (empty($boothgoods_list)) {
            return $this->createStringResponse();
        }
    
        $goodsid_array = array();
        foreach ($boothgoods_list as $val) {
            $goodsid_array[] = $val['goods_id'];
        }
    
        $fieldstr = "goods_id,goods_commonid,goods_name,goods_jingle,store_id,store_name,goods_price,goods_marketprice,goods_storage,goods_image,goods_freight,goods_salenum,color_id,evaluation_count";
        $goods_list = $this->getServie('Mall:Goods.GoodsService')->getGoodsOnlineList(array('goods_id' => array('in', $goodsid_array)), $fieldstr);
        if (empty($goods_list)) {
            return $this->createStringResponse();
        }
        $commonid_array = array();
        foreach ($goods_list as $val) {
            $commonid_array[] = $val['goods_commonid'];
        }
        $groupbuy_list = $this->getService('Mall.GroupBuy.GroupbuyService')->getGroupbuyListByGoodsCommonIDString(implode(',', $commonid_array));
        $xianshi_list = $this->getService('Mall.P.XianshiService')->getXianshiGoodsListByGoodsString(implode(',', $goodsid_array));
        foreach ($goods_list as $key => $value) {
            // 团购
            if (isset($groupbuy_list[$value['goods_commonid']])) {
                $goods_list[$key]['goods_price'] = $groupbuy_list[$value['goods_commonid']]['groupbuy_price'];
                $goods_list[$key]['group_flag'] = true;
            }
            if (isset($xianshi_list[$value['goods_id']]) && !$goods_list[$key]['group_flag']) {
                $goods_list[$key]['goods_price'] = $xianshi_list[$value['goods_id']]['xianshi_price'];
                $goods_list[$key]['xianshi_flag'] = true;
            }
        }
        $this->assign('goods_list', $goods_list);
        $this->assign('groupbuy_list', $groupbuy_list);
        $this->assign('xianshi_list', $xianshi_list);
        return $this->template('goods/goods_booth.html');
    }
    
    public function auto_completeOp() {
        require(BASE_DATA_PATH.'/xs/lib/XS.php');
        $obj_doc = new XSDocument();
        $obj_xs = new XS('2014');
        $obj_index = $obj_xs->index;
        $obj_search = $obj_xs->search;
        $obj_search->setCharset(CHARSET);
        try {
            $corrected = $obj_search->getExpandedQuery($this->getRequest()->getGet('term'));
            if (count($corrected) !== 0) {
                $data = array();
                foreach ($corrected as $word)
                {
                    $row['id'] = $word;
                    $row['label'] = $word;
                    $row['value'] = $word;
                    $data[] = $row;
                }
                exit(json_encode($data));
            }
        } catch (\XSException $e) {
            print_R($e->getMessage());exit;
        }
    }
    
    protected function getSearchService()
    {
        return $this->getService('Mall:Goods.SearchService');
    }
    
}
