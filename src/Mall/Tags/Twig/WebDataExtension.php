<?php
/**
 * Created by PhpStorm.
 * User: dai
 * Date: 14-8-30
 * Time: 下午5:30
 */

namespace Mall\Tags\Twig;


use Mall\Service\ServiceKernel;
class WebDataExtension extends \Twig_Extension {
    protected $_container;

    public function __construct($container)
    {
        $this->_container = $container;
    }

    public function getFunctions()
    {
        $options = array('is_safe' => array('html'));
        return array(
            new \Twig_SimpleFunction('data', array($this, 'getData'), $options),
            new \Twig_SimpleFunction('datas', array($this, 'getDatas'), $options),
            //new \Twig_SimpleFunction('datas_count', array($this, 'getDatasCount'), $options),
            //new \Twig_SimpleFunction('service', array($this, 'callService'), $options),
        );
    }

    public function getData($name, $arguments)
    {
        $class = 'Mall\\Tags\\' . $name . 'DataTag';

        if (!class_exists($class)) {
            throw new \RuntimeException("尚未定义'{$name}'数据标签");
        }

        $obj = new $class();
        return $obj->getData($arguments);
    }

    public function getDatas($name, $conditions, $sort = null, $start = null, $limit = null)
    {
        $method = 'get' . ucfirst($name) . 'Datas';
        if (!method_exists($this, $method)) {
            throw new \RuntimeException("尚未定义批量获取'{$name}'数据");
        }
        return $this->{$method}($conditions, $sort, $start, $limit);
    }
    
    public function getStoreInfo($store_id) {
    	$model_store = ServiceKernel::instance()->createService('Mall:Store.StoreService');
    	$store_info = $model_store->getStoreOnlineInfoByID($store_id);
    	
  		return $store_info;
    }
    
    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'Web_data_twig';
    }
} 