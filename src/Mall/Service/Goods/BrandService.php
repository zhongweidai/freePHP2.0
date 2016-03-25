<?php
namespace Mall\Service\Goods;
use Mall\Service\ServiceBase;

class BrandService extends ServiceBase
{
    protected $brandModel;
    
    public function __construct(){
        $this->brandModel = $this->getModle('Mall:Brand');
    }
}

?>