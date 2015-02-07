<?php
namespace Mall\Model;
use Component\Model\FreeModel;

class AdvModel extends FreeModel
{
    protected $tableName = 'adv';
    protected $pkId = 'adv_id';
    
    public function getAttach($path)
    {
       return $this->_container->loadConfig('system','upload_url')."/shop/ads/" . $path;
    }
}

?>