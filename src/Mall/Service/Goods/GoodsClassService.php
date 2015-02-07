<?php
namespace Mall\Service\Goods;
use Mall\Service\ServiceBase;
use Mall\Service\ServiceUtil;
class GoodsClassService extends ServiceBase
{
    protected $goodsClassModel;
    protected $goodsClassTagModel;
    public function __construct(){
        $this->goodsClassModel = $this->getModle('Mall:goodsClass');
        $this->goodsClassTagModel = $this->getModle('Mall:goodsClassTag');
    }
    /**
     * 前台头部的商品分类
     *
     * @param   number  $update_all   更新
     * @return  array   数组
     */
    public function getAllCategory() 
    {
        $class_list = $this->goodsClassModel->select(array(),array(),'','gc_parent_id asc,gc_sort asc,gc_id asc');
        $gc_list = array();
        $class1_deep = array();//第1级关联第3级数组
        $class2_ids = array();//第2级关联第1级ID数组
        $type_ids = array();//第2级分类关联类型
        if (is_array($class_list) && !empty($class_list)) 
        {
            foreach ($class_list as $key => $value) {
                $p_id = $value['gc_parent_id'];//父级ID
                $gc_id = $value['gc_id'];
                $sort = $value['gc_sort'];
                if ($p_id == 0) {//第1级分类
                    $gc_list[$gc_id] = $value;
                } elseif (array_key_exists($p_id,$gc_list)) {//第2级
                    $class2_ids[$gc_id] = $p_id;
                    $type_ids[] = $value['type_id'];
                    $gc_list[$p_id]['class2'][$gc_id] = $value;
                } elseif (array_key_exists($p_id,$class2_ids)) {//第3级
                    $parent_id = $class2_ids[$p_id];//取第1级ID
                    $gc_list[$parent_id]['class2'][$p_id]['class3'][$gc_id] = $value;
                    $class1_deep[$parent_id][$sort][] = $value;
                }
            }
            $type_brands = $this->getTypeBrands($type_ids);//类型关联品牌
            foreach ($gc_list as $key => $value) {
                $gc_id = $value['gc_id'];
                $gc_list[$gc_id]['pic'] = ServiceUtil::cAttache('category-pic-'.$gc_id.'.jpg');
    
                $class3s = $class1_deep[$gc_id];
                	
                if (is_array($class3s) && !empty($class3s)) {//取关联的第3级
                    $class3_n = 0;//已经找到的第3级分类个数
                    ksort($class3s);//排序取到分类
                    foreach ($class3s as $k3 => $v3) {
                        if ($class3_n >= 5) {//最多取5个
                            break;
                        }
                        foreach ($v3 as $k => $v) {
                            if ($class3_n >= 5) {
                                break;
                            }
                            if (is_array($v) && !empty($v)) {
                                $p_id = $v['gc_parent_id'];
                                $gc_id = $v['gc_id'];
                                $parent_id = $class2_ids[$p_id];//取第1级ID
                                $gc_list[$parent_id]['class3'][$gc_id] = $v;
                                $class3_n += 1;
                            }
                        }
                    }
                }
                $class2s = $value['class2'];
                if (is_array($class2s) && !empty($class2s)) {//第2级关联品牌
                    foreach ($class2s as $k2 => $v2) {
                        $p_id = $v2['gc_parent_id'];
                        $gc_id = $v2['gc_id'];
                        $type_id = $v2['type_id'];
                        $gc_list[$p_id]['class2'][$gc_id]['brands'] = isset($type_brands[$type_id]) ? $type_brands[$type_id] : '';
                    }
                }
            }
        }
        return $gc_list;
    }

            
    
    /**
     * 类型关联品牌
     *
     * @param   array  $type_ids   类型
     * @return  array   数组
     */
    public function getTypeBrands($type_ids = array()) {
        $brands = array();//品牌
        $type_brands = array();//类型关联品牌
        if (is_array($type_ids) && !empty($type_ids)) {
            $type_ids = array_unique($type_ids);
            $type_list = $this->getModle('Mall:TypeBrand')->select(array('type_id'=>array('in',$type_ids)),array(),'0,10000');
            if (is_array($type_list) && !empty($type_list)) {
                $brand_list = $this->getModle('Mall:Brand')->select(array('brand_apply'=>1),'brand_id,brand_name,brand_pic','0,10000');
                if (is_array($brand_list) && !empty($brand_list)) {
                    foreach ($brand_list as $key => $value) {
                        $brand_id = $value['brand_id'];
                        $brands[$brand_id] = $value;
                    }
                    foreach ($type_list as $key => $value) {
                        $type_id = $value['type_id'];
                        $brand_id = $value['brand_id'];
                        $brand = $brands[$brand_id];
                        if (is_array($brand) && !empty($brand)) {
                            $type_brands[$type_id][$brand_id] = $brand;
                        }
                    }
                }
            }
    
        }
        return $type_brands;
    }
    /**
     * 取分类列表，最多为三级
     *
     * @param int $show_deep 显示深度
     * @param array $condition 检索条件
     * @return array 数组类型的返回结果
     */
    public function getTreeClassList($show_deep='3',$condition=array()){
        $class_list = $this->goodsClassModel->select($condition,array(),'','gc_parent_id asc,gc_sort asc,gc_id asc');
        $goods_class = array();//分类数组
        if(is_array($class_list) && !empty($class_list)) {
            $show_deep = intval($show_deep);
            if ($show_deep == 1){//只显示第一级时用循环给分类加上深度deep号码
                foreach ($class_list as $val) {
                    if($val['gc_parent_id'] == 0) {
                        $val['deep'] = 1;
                        $goods_class[] = $val;
                    } else {
                        break;//父类编号不为0时退出循环
                    }
                }
            } else {//显示第二和三级时用递归
                $goods_class = $this->_getTreeClassList($show_deep,$class_list);
            }
        }
        return $goods_class;
    }
    
    /**
     * 递归 整理分类
     *
     * @param int $show_deep 显示深度
     * @param array $class_list 类别内容集合
     * @param int $deep 深度
     * @param int $parent_id 父类编号
     * @param int $i 上次循环编号
     * @return array $show_class 返回数组形式的查询结果
     */
    private function _getTreeClassList($show_deep,$class_list,$deep=1,$parent_id=0,$i=0){
        static $show_class = array();//树状的平行数组
        if(is_array($class_list) && !empty($class_list)) {
            $size = count($class_list);
            if($i == 0) $show_class = array();//从0开始时清空数组，防止多次调用后出现重复
            for ($i;$i < $size;$i++) {//$i为上次循环到的分类编号，避免重新从第一条开始
                $val = $class_list[$i];
                $gc_id = $val['gc_id'];
                $gc_parent_id	= $val['gc_parent_id'];
                if($gc_parent_id == $parent_id) {
                    $val['deep'] = $deep;
                    $show_class[] = $val;
                    if($deep < $show_deep && $deep < 3) {//本次深度小于显示深度时执行，避免取出的数据无用
                        $this->_getTreeClassList($show_deep,$class_list,$deep+1,$gc_id,$i+1);
                    }
                }
                if($gc_parent_id > $parent_id) break;//当前分类的父编号大于本次递归的时退出循环
            }
        }
        return $show_class;
    }
    
    public function getGoodsClass()
    {
        $fields = 'gc_id,gc_name,type_id,gc_parent_id,gc_sort';
        $result = $this->goodsClassModel->select(array(),$fields,'','gc_parent_id asc,gc_sort asc,gc_id asc');
        if (!is_array($result)) 
        {
            return null;
        }
        
        $class_level = array();
        $result_copy = $result;
        $result_child = array();
        $result_childchild = array();
        $return_array = array();
        foreach ($result_copy as $k=>$v) {
            $return_array[$v['gc_id']] = $v;
            if (!$v['gc_parent_id']) {
                $class_level[1][$v['gc_id']] = $v;
                unset($result_copy[$k]);
            }
        }
        foreach ($result_copy as $k=>$v) {
            if (array_key_exists($v['gc_parent_id'],$class_level[1])){
                $result_child[$v['gc_parent_id']][] = $v['gc_id'];
                $class_level[2][$v['gc_id']] = $v;
                unset($result_copy[$k]);
            }
        }
        
        foreach ($result_copy as $k=>$v) {
            if (array_key_exists($v['gc_parent_id'],$class_level[2])){
                $result_child[$v['gc_parent_id']][] = $v['gc_id'];
                $parent_parent_gc_id = $class_level[2][$v['gc_parent_id']]['gc_parent_id'];
                $result_childchild[$parent_parent_gc_id][] = $v['gc_id'];
                $class_level[3][$v['gc_id']] = $v;
                unset($result_copy[$k]);
            }
        }
        
        foreach ($return_array as $k=>$v){
            if (array_key_exists($v['gc_id'],$class_level[1])) {
                $return_array[$k]['depth'] = 1;
            } elseif (array_key_exists($v['gc_id'],$class_level[2])) {
                $return_array[$k]['depth'] = 2;
            } elseif (array_key_exists($v['gc_id'],$class_level[3])) {
                $return_array[$k]['depth'] = 3;
            }
            if (array_key_exists($k, $result_child)){
                $return_array[$k]['child'] = implode(',', $result_child[$k]);
            }
            if (array_key_exists($k, $result_childchild)){
                $return_array[$k]['childchild'] = implode(',',$result_childchild[$k]);
            }
        }
        return $return_array;
    }
    
    /**
     * 取指定分类ID的导航链接
     *
     * @param int $id 父类ID/子类ID
     * @param int $sign 1、0 1为最后一级不加超链接，0为加超链接
     * @return array $nav_link 返回数组形式类别导航连接
     */
    public function getGoodsClassNav($id = 0, $sign = 1) {
        if (intval ( $id ) > 0) {
            $data = $this->getService('Mall:System.CacheService')->call('Mall:Goods.GoodsClassService::getGoodsClass');
    
    
            // 当前分类不加超链接
            if ($sign == 1) {
                $nav_link [] = array(
                        'title' => $data[$id]['gc_name']
                );
            } else {
                $nav_link [] = array(
                        'title' => $data[$id]['gc_name'],
                        'link' => urlShop('search', 'index', array('cate_id' => $data[$id]['gc_id']))
                );
            }
    
            // 最多循环4层
            for($i = 1; $i < 5; $i ++) {
                if ($data[$id]['gc_parent_id'] == '0') {
                    break;
                }
                $id = $data[$id]['gc_parent_id'];
                $nav_link[] = array(
                        'title' => $data[$id]['gc_name'],
                        'link' => ServiceUtil::path('search/index', array('cate_id' => $data[$id]['gc_id']))
                );
            }
        } else {
            // 加上 首页 商品分类导航
            $nav_link[] = array('title' => ServiceUtil::lang('goods:class_index_search_results'));
        }
        // 首页导航
        $nav_link[] = array('title' => ServiceUtil::lang('common:homepage'), 'link' => ServiceUtil::path());
    
        krsort ( $nav_link );
        return $nav_link;
    }
    /**
     * 取得分类关键词，方便SEO
     *
     */
    public function getKeyWords($gc_id = null){
        if (empty($gc_id)) return false;
        $keywrods = ($seo_info = H('goods_class_seo')) ? $seo_info : H('goods_class_seo',true);
        $seo_title = $keywrods[$gc_id]['title'];
        $seo_key = '';
        $seo_desc = '';
        if ($gc_id > 0){
            if (isset($keywrods[$gc_id])){
                $seo_key .= $keywrods[$gc_id]['key'].',';
                $seo_desc .= $keywrods[$gc_id]['desc'].',';
            }
            $goods_class = H('goods_class') ? H('goods_class') : H('goods_class', true);
            if(($gc_id = $goods_class[$gc_id]['gc_parent_id']) > 0){
                if (isset($keywrods[$gc_id])){
                    $seo_key .= $keywrods[$gc_id]['key'].',';
                    $seo_desc .= $keywrods[$gc_id]['desc'].',';
                }
            }
            if(($gc_id = $goods_class[$gc_id]['gc_parent_id']) > 0){
                if (isset($keywrods[$gc_id])){
                    $seo_key .= $keywrods[$gc_id]['key'].',';
                    $seo_desc .= $keywrods[$gc_id]['desc'].',';
                }
            }
        }
        return array(1=>$seo_title,2=>trim($seo_key,','),3=>trim($seo_desc,','));
    }
    
    public function getGoodsClassTag()
    {
    	$field = 'gc_tag_id,gc_tag_name,gc_tag_value,gc_id,type_id';
    	$list = $this->goodsClassTagModel->select(array(),$field);
    	if (!is_array($list)) 
    	{
    		return null;
    	}
    	return $list;
    }
}




