<?php
/**
 * 主要装载商品品牌和类型逻辑
 * @author dai
 *
 */
namespace Mall\Service\Goods;
use Mall\Service\ServiceBase;

class GoodsTypeService extends ServiceBase
{
    protected $typeBrandModel;
    protected $brandModel;
    
    public function __construct(){
        $this->typeBrandModel = $this->getModle('Mall:TypeBrand');
        $this->brandModel = $this->getModle('Mall:Brand');
    }
    public function getTypeBrandList($condition, $field = array()) {
        return $this->typeBrandModel->select($condition,$field);
    }
    
    /**
     * 通过的品牌列表
     *
     * @param array $condition
     * @param string $field
     * @return array
     */
    public function getBrandPassList($condition, $field = array()) {
        $condition['brand_apply'] = 1;
        return $this->brandModel->select($condition,$field);
    }
    
}

?>