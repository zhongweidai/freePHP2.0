<?php
namespace Free\Libs;

use Free\Libs\FreeException;

/**
 * 项目（应用）装载
 * @author Dai Zhongwei <daizhongw@gmail.com> 2011-7-10
 * @copyright ©2006-2103 
 * @version $$Id$$
 * @package base
 */

final class FreeApplication{
    private $_container;
    private $routeApp;
	private $rounteM;
	private $rounteC;
	private $rounteA;
	private $controller;
	private $action;
	private $_run_num = 1;
    /**
	 * 构造函数
	 */
	public function __construct($container)
	{
        $this->_container = $container;
		$param = $container->getComponent('route',array('arguments'=> $container));
        $this->routeApp = $param->getApp();
		$this->rounteM = $param->getM();
		$this->rounteC = $param->getC();
		$this->rounteA = $param->getA();
		//$this->init($this->_module,$this->_controller,$this->_action);
	}
	public function __destruct()
	{
	}

	
	/**
	 * 调用件事
	 */
	public function run($m='',$c='',$a='') 
	{
		$this->_run_num ++;
		if($this->_run_num > 10)
		{
			throw new FreeException('run extends the maximum','0');
		}
		!empty($m) &&  $this->rounteM = $m;
		!empty($c) && $this->rounteC = $c;
		!empty($a) && $this->rounteA = $a;
		$this->controller = $this->loadController();
		$this->action = $this->rounteA. 'Action' ;
		if (method_exists($this->controller, $this->action)) 
		{
			if (preg_match('/^[_]/i', $this->action)) 
			{
				throw new FreeException('You are visiting the action is to protect the private action','404');
			} else {
				//call_user_func(array($this->controller, 'init'));
				//处理filter
				$this->doFilter();
				call_user_func(array($this->controller, 'doBefore'));
				$response = call_user_func(array($this->controller, $this->action));
				call_user_func(array($this->controller, 'doAfter'));
                return $response;
			}
		} else {
			throw new FreeException($this->action.'	Action does not exist.','404');
		}
	}
	
	/**
     +----------------------------------------------------------
     * 获取当前app的m a c
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @return array
     +----------------------------------------------------------
     */
	public function getMac()
	{
		return array($this->rounteM,$this->rounteC,$this->rounteA);
	}
	
	/**
	 * 加载控制器
	 * @param string $filename
	 * @param string $m
	 * @return obj
	 */
	private function loadController() 
	{
		$filename = ucfirst($this->rounteC);
		$classname = ucfirst($this->routeApp). "\\"  . 'Controller'. "\\" .ucfirst($this->rounteM) . "\\" . $filename . 'Controller';
        if(class_exists($classname))
        {
            $controller = new $classname($this->_container);
            return $controller;
        }else{
            throw new FreeException($classname.' does not exist.','404');
        }
	}
	/**
     +----------------------------------------------------------
     * 过滤器处理
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @return boolean
     +----------------------------------------------------------
     */
	public function doFilter()
	{
        $filter = new FreeFilter($this->_container);
        $forward = $filter->handle();
		if($forward !== false)
		{
			list($m,$c,$a) = explode('/',$forward );
			$this->controller->forward($m,$c,$a);
		}else{
			return true;
		}
	}
	/**
     +----------------------------------------------------------
     * 获取当前app
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @return boolean
     +----------------------------------------------------------
     */
	public function getController()
	{
		return $this->controller ;
	}
	/**
     +----------------------------------------------------------
     * 设置当前app
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @return boolean
     +----------------------------------------------------------
     */
	public function setController($controller)
	{
		$this->controller = $controller;
	}

    public function getRouteM()
    {
        return $this->rounteM;
    }
    public function getRouteA()
    {
        return $this->rounteA;
    }
    public function getRouteC()
    {
        return $this->rounteC;
    }

    public function getRequest()
    {
        return $this->controller->getRequest();
    }

    public function getResponse()
    {
        return $this->controller->getResponse();
    }

    public function getConfig()
    {
        return $this->_container->loadConfig();
    }


}
?>