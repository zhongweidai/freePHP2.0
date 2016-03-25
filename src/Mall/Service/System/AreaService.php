<?php
namespace Mall\Service\System;
use Mall\Service\ServiceBase;

class AreaService extends ServiceBase
{
    protected $areaModel;
    
    public function __construct(){
        $this->areaModel = $this->getModle('Mall:Area');
    }
    public function getAllArea()
    {
        return $this->areaModel->select();
    }
}

?>