<?php
namespace Component\Route;
/**
 * 路由组件类
 * @author Dai Zhongwei <daizhongw@gmail.com> 2011-7-10
 * @copyright ©2006-2103 
 * @version $$Id$$
 * @package base
 */
class FreeDefaultRoute extends AbstractFreeRoute{

	//路由配置
	private $route_config = array('app'=>'Web','m'=>'index','c'=>'index','a'=>'init');
    private $_container;

	
	public function __construct($container) {
        $this->_container = $container;
        if(isset($_GET['__s']))
        {
            $this->route_config = $this->query($_GET['__s']) ;
        }

	}

    public function query($str)
    {
        $routes = $this->route_config;
        if(empty($str))
        {
            return $routes;
        }
        if(strpos($str,'/') === false)
        {
            $query = array($str);
        }else{
            $query = explode('/',$str);
        }
        $apps = C('application');

        if(array_key_exists(ucfirst($query[0]),$apps))
        {
            $routes['app'] = ucfirst($query[0]);
            !empty($query[1]) && $routes['m'] = $query[1];
            !empty($query[2]) && $routes['c'] = $query[2];
            !empty($query[3]) && $routes['a'] = $query[3];
        }else{
            !empty($query[0]) && $routes['m'] = $query[0];
            !empty($query[1]) && $routes['c'] = $query[1];
            !empty($query[2]) && $routes['a'] = $query[2];
        }
        return $routes;
    }
    public function getApp()
    {
        return $this->route_config['app'];
    }

	/**
	 * 获取模型
	 */
	public function getM() {
        return $this->route_config['m'];
	}

	/**
	 * 获取控制器
	 */
	public function getC() {
        return $this->route_config['c'];
	}

	/**
	 * 获取事件
	 */
	public function getA() {
        return $this->route_config['a'];
	}
	
	/* (non-PHPdoc)
	 * @see AbstractWindRouter::assemble()
	 */
	public function assemble($action='', $args = '',$script='') {
		if(!empty($action))
		{
			$r = explode('/',$action);
		}
		$route = array();
		isset($r[0]) && !empty($r[0]) && $route['m'] = $r[0] ;
		isset($r[1]) && !empty($r[1]) && $route['c'] = $r[1] ;
		isset($r[2]) && !empty($r[2]) && $route['a'] = $r[2] ;
		$script == '' && $script = $this->_container->getComponent('request')->getScript();
		$p =  (is_array($args) ? self::argsToUrl(array_merge($route, $args)) : (self::argsToUrl($route).$args));
		return $p ?  $script . '?' .  $p : $script;
	}
	
	public static function argsToUrl($args, $encode = true, $separator = '&=') {
		if (strlen($separator) !== 2) return;
		$_tmp = '';
		foreach ((array) $args as $key => $value) {
			$value = $encode ? rawurlencode($value) : $value;
			if (is_int($key)) {
				$value && $_tmp .= $value . $separator[0];
				continue;
			}
			$key = ($encode ? rawurlencode($key) : $key);
			$_tmp .= $key . $separator[1] . $value . $separator[0];
		}
		return trim($_tmp, $separator[0]);
	}
}
?>