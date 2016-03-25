<?php
namespace Mall\Service;

class ServiceUtil
{
    const GOODS_IMAGES_EXT = '_60,_240,_360,_1280';
    
    public static function path($action='', $args = array(), $anchor = '', $script = '')
    {
        $host = ServiceKernel::instance()->getContainer()->getComponent('request')->getBaseUrl();
        $router = ServiceKernel::instance()->getContainer()->getComponent('route');
        $url = $router->assemble($action, $args, $script);
        $url .= $anchor ? '#' . $anchor : '';
        return $host . '/' . $url;
    }
    
    public static function lang($name)
    {
    	static $_lang = array();
    	if (strpos($name, ':') > 0) {
    		list($namespace, $name) = explode(':', $name, 2);
    	}else{
    		$namespace = 'common';
    	}
    	if(!isset($_lang[$namespace]))
    	{
    		$filename = FREE_PATH . 'src' . DIRECTORY_SEPARATOR . 'Mall' . DIRECTORY_SEPARATOR . 'Lang' . DIRECTORY_SEPARATOR . 'zh-cn' . DIRECTORY_SEPARATOR . $namespace . '.php';
			if(file_exists($filename))
			{
    			$_lang[$namespace] = include $filename;
			}else{
				return "error lang [$name]";
			}
    	}
    	return isset($_lang[$namespace][$name]) ? $_lang[$namespace][$name] : "error lang [$name]";
    }
    
    public static function dropParam($param)
    {
    	$purl = self::getParam();
    	if (!empty($param)) {
    		foreach ($param as $val) {
    			$purl['param'][$val]= 0;
    		}
    	}
    	return self::path($purl['m'].'/'.$purl['c'].'/'.$purl['a'], $purl['param']);
    }
    
    public static function getParam()
    {
    	$param = $_GET;
    	$purl = array();
    	
    	$purl['m'] = ServiceKernel::instance()->getContainer()->getApp()->getRouteM();
    	$purl['c'] = ServiceKernel::instance()->getContainer()->getApp()->getRouteC();
    	$purl['a'] = ServiceKernel::instance()->getContainer()->getApp()->getRouteA();
    	if(isset($param['m']))
    	{
    		unset($param['m']);
    	}
    	if(isset($param['c']))
    	{
    		unset($param['c']);
    	}
    	if(isset($param['a']))
    	{
    		unset($param['a']);
    	}
    	if(isset($param['page']))
    	{
    		unset($param['page']);
    	}
    	$purl['param'] = $param;
    	return $purl;
    }
    
    public static function assets($path)
    {
        $app_configs = ServiceKernel::instance()->getContainer()->loadConfig('application',ServiceKernel::instance()->getContainer()->getAppName());
        $host = ServiceKernel::instance()->getContainer()->getComponent('request')->getBaseUrl();
        
        return $path ? $host . '/' . (isset($app_configs['assets_path'])?$app_configs['assets_path']:'assets'). '/' . $path : $host;
    }
    
    /**
     * 取得商品缩略图的完整URL路径，接收图片名称与店铺ID
     *
     * @param string $file 图片名称
     * @param string $type 缩略图尺寸类型，值为60,160,240,310,1280
     * @param mixed $store_id 店铺ID 如果传入，则返回图片完整URL,如果为假，返回系统默认图
     * @return string
     */
    public static function cthumb($file, $type = '', $store_id = false) {
        $type_array = explode(',_', ltrim(self::GOODS_IMAGES_EXT, '_'));
        if (!in_array($type, $type_array)) {
            $type = '240';
        }
        if (empty($file)) {
            return ServiceUtil::assets('style/default/images/default.jpg');
        }
        $search_array = explode(',', self::GOODS_IMAGES_EXT);
        $file = str_ireplace($search_array,'',$file);
        $fname = basename($file);
        // 取店铺ID
        if ($store_id === false || !is_numeric($store_id)) {
            $store_id = substr ( $fname, 0, strpos ( $fname, '_' ) );
        }
        $thumb_host = ServiceKernel::instance()->getContainer()->loadConfig('system','upload_url') . '/' . ServiceKernel::instance()->getContainer()->loadConfig('system','attach_goods');
        return $thumb_host . '/' . $store_id . '/' . ($type == '' ? $file : str_ireplace('.', '_' . $type . '.', $file));
    }
    
    /**
     *
     * @param array $goods
     * @param string $type
     * @return string
     */
    public static function thumb($goods = array(), $type = '')
    {
        $type_array = explode(',_', ltrim(self::GOODS_IMAGES_EXT, '_'));
        if (!in_array($type, $type_array)) 
        {
            $type = '240';
        }
        if (empty($goods))
        {
            return self::assets('style/default/images/default.jpg');
        }
        if (array_key_exists('apic_cover', $goods)) 
        {
            $goods['goods_image'] = $goods['apic_cover'];
        }
        if (empty($goods['goods_image'])) 
        {
            return self::assets('style/default/images/default.jpg');
        }
        $search_array = explode(',', self::GOODS_IMAGES_EXT);
        $file = str_ireplace($search_array,'',$goods['goods_image']);
        $fname = basename($file);
        //取店铺ID
        if (preg_match('/^(\d+_)/',$fname)){
            $store_id = substr($fname,0,strpos($fname,'_'));
        }else{
            $store_id = $goods['store_id'];
        }
        $file = $type == '' ? $file : str_ireplace('.', '_' . $type . '.', $file);
 /*        if (!file_exists(BASE_UPLOAD_PATH.'/'.ATTACH_GOODS.'/'.$store_id.'/'.$file)){
            return self::assets('style/default/images/default.jpg');
        } */
        $thumb_host = ServiceKernel::instance()->getContainer()->loadConfig('system','upload_url') . '/' . ServiceKernel::instance()->getContainer()->loadConfig('system','attach_goods');
        return $thumb_host.'/'.$store_id.'/'.$file;
    }
    
    public static function defaultGoodsImage($key){
        $file = str_ireplace('.', '_' . $key . '.', ServiceKernel::instance()->getContainer()->loadConfig('system','default_goods_image'));
        return self::assets('style/default/images/default.jpg');
    }
    
    /**
     * 获取common_attache_path的完整url
     * @param unknown $path
     * @return string
     */
    public static function cAttache($path)
    {
    	return ServiceKernel::instance()->getContainer()->loadConfig('system','upload_url').'/'.ServiceKernel::instance()->getContainer()->loadConfig('system','common_attache_path') . '/' . $path;
    }
                            

}
