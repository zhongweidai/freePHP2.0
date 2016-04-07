<?php
namespace Mall\Model;
use Component\Model\FreeModel;

class AttributeModel extends FreeModel
{
    protected $tableName = 'attribute';
    protected $pkId = 'attr_id';
    
    const SHOW0 = 0;    // 不显示
    const SHOW1 = 1;    // 显示
}

?>