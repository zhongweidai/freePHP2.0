<?php
namespace Mall\Model;
use Component\Model\FreeModel;

class GoodsAttrIndexModel extends FreeModel
{
    protected $tableName = 'goods_attr_index';
    
    /**
     * 对应列表
     * 
     * @param array $condition
     * @param string $field
     * @return array
     */
    public function getGoodsAttrIndexList($condition, $field = array()) {
        return $this->select($condition,$field);
    }
}
