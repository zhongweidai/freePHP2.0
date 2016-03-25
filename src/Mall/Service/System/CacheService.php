<?php
namespace Mall\Service\System;
use Mall\Service\ServiceBase;

class CacheService extends ServiceBase
{
    
    /**
     * $method 需要缓存的方法数据 className::method (Mall\Service\Goods\GoodsClassService::getGoodsClass())
     * $update_all 0不强制更新 1强制更新
     * @param unknown $name
     */
    public function call($method,$arg=array(),$update_all=0)
    {
        if (strpos($method, '::') > 0) 
        {
            $cache_key = $this->genCacheKey($method,$arg);
            list($serviceName, $function) = explode('::', $method);
            $module = $this->getModuleName($serviceName) ?:'common';
            $data = $this->getCacheCompenont()->get($cache_key,$module);
            if(!$data || $update_all){
                $class = $this->getService($serviceName);
                if(is_array($arg) && $arg)
                {
                    $data = call_user_func_array(array($class, $function), $arg);
                }else{
                    $data = call_user_func(array($class, $function));
                }
        
                $this->getCacheCompenont()->set($cache_key, $data, $module);
            }
            return $data;
            
        }else{
            return false;
        }
    }
    
    private function genCacheKey($method,$arg=array())
    {
        $key = str_replace(array(".",":"), '-', $method);
        foreach($arg as $k =>$v)
        {
            $key .= '-' . $k . '-' . $v;
        }
        return $key;
    }
    
    private function getModuleName($name)
    {
        if (strpos($name, ':') > 0) {
            list($namespace, $name) = explode(':', $name, 2);
        
            $namespace .= '\\Service';
        }
        list($module, $className) = explode('.', $name);
        return $module;
    }
}

?>