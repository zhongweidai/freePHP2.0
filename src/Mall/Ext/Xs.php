<?php
namespace Mall\Ext;

require_once FREE_PATH.'/src/Mall/Ext/xs/lib/XS.php';

class Xs
{
    private  $search;
    private $appname = 'freeMallGoods';
    public function __construct($config=array())
    {
        $obj_doc = new \XSDocument();
   
        isset($config['fullindexer.appname']) && $this->appname = $config['fullindexer.appname'];
        $obj_xs = new \XS($this->appname);
        $this->search = $obj_xs->search;
    }
    
    public function getSearch()
    {
        return $this->search;
    }

}

?>