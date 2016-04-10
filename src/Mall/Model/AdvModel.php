<?php
namespace Mall\Model;

class AdvModel extends MallModel
{
    protected $tableName = 'adv';
    protected $pkId = 'adv_id';
    
    public function getAttach($path)
    {
       return $this->_container->loadConfig('system','upload_url')."/shop/ads/" . $path;
    }
}

?>