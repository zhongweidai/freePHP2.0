<?php
namespace Mall\Model;
class AttributeModel extends MallModel
{
    protected $tableName = 'attribute';
    protected $pkId = 'attr_id';
    
    const SHOW0 = 0;    // 不显示
    const SHOW1 = 1;    // 显示
}

?>