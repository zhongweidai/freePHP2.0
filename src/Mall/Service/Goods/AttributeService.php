<?php
namespace Mall\Service\Goods;
use Mall\Service\ServiceBase;
use Mall\Model\AttributeModel;

class AttributeService extends ServiceBase
{
    protected $attributeModel;
    
    protected $attributeValueModel;
    
    public function __construct(){
        $this->attributeModel = $this->getModle('Mall:Attribute');
        $this->attributeValueModel = $this->getModle('Mall:AttributeValue');
    }
    
    /**
     * 属性列表
     *
     * @param array $condition
     * @param string $field
     * @return array
     */
    public function getAttributeList($condition, $field = array()) {
        return $this->attributeModel->select($condition,$field,'','attr_sort asc');
    }
    
    /**
     * 属性列表
     *
     * @param array $condition
     * @param string $field
     * @return array
     */
    public function getAttributeShowList($condition, $field = array()) {
        $condition['attr_show'] = AttributeModel::SHOW1;
        return $this->getAttributeList($condition, $field);
    }
    
    /**
     * 属性值列表
     *
     * @param array $condition
     * @param string $field
     * @return array
     */
    public function getAttributeValueList($condition, $field = array()) {
        return $this->attributeValueModel->select($condition,$field,'','attr_value_sort asc,attr_value_id asc');
    }
}

?>