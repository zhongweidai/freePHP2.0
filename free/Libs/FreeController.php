<?php
namespace Free\Libs;
/**
 * 前端控制器基类
 * @author Dai Zhongwei <daizhongw@gmail.com> 2011-7-10
 * @copyright ©2006-2103 
 * @version $$Id$$
 * @package base
 */
 
class FreeController{
    protected $_container;
    private $isMajor = true;
    private $_templte = '';
    private $request = '';
    private $response = '';

    private $_out_put = array();//模板输出变量

    final public function __construct($container)
    {
        $this->_container = $container;
        $this->request = $this->_container->getComponent('request');
        $this->response = $this->_container->getComponent('response');
        //设置本地时差
        function_exists('date_default_timezone_set') && date_default_timezone_set($this->_container->loadConfig('system','timezone'));
        //输出页面字符集
        $this->response->setCharset($this->_container->loadConfig('system','charset'));
        $this->_init_();
    }

    public function _init_()
    {
    }

    public function doBefore()
    {

    }
    public function doAfter()
    {

    }

    public function getModel($modelName)
    {
        return $this->_container->loadModel($modelName);
    }

    public function getComponent($componentName,$option=array())
    {

        return $this->_container->getComponent($componentName,$option);
    }

    public function getCache()
    {
        return $this->_container->getComponent('cache',array('arguments'=>$this->_container));
    }

    public function setContainer($container)
    {
        $this->_container = $container;
    }
    public function getContainer()
    {
        return $this->_container;
    }

    /**
     *模板变量分配
    +----------------------------------------------------------
     * @access public
    +----------------------------------------------------------
     * @param string $name 变量名
     * @param string $value 值
    +----------------------------------------------------------
     * @return void
    +----------------------------------------------------------
     */
    final public function assign($name,$value='')
    {
        if(is_array($name)) {
            $this->_out_put   =  array_merge($this->_out_put,$name);
        }elseif(is_object($name)){
            foreach($name as $key =>$val)
                $this->_out_put[$key] = $val;
        }else {
            $this->_out_put[$name] = $value;
        }
    }

    /**
     * 模板调用
    +----------------------------------------------------------
     * @access public
    +----------------------------------------------------------
     * @param string $name 语言名
    +----------------------------------------------------------
     * @return void
    +----------------------------------------------------------
     */
    public function template($template,$data=array())
    {
        if(!$this->_templte)
        {
            $this->_templte = $this->_container->getComponent('template',array('arguments'=>$this->_container));
        }
        $this->assign($data);
        $content = $this->_templte->render($template,$this->_out_put);
        if($this->isMajor){
            $this->getResponse()->setBody($content,'contentBody');
            return $this->getResponse();
        }else{
            return $content;
        }

    }
    
    public function createStringResponse($data = '')
    {
    	$content= '';
        is_array($data) && $data = json_encode($data);
        $this->getResponse()->setBody($data,'contentBody');
        return $this->getResponse();
    }
    
    public function setIsMajor($isMajor)
    {
        $this->isMajor = $isMajor;
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function getResponse()
    {
        return $this->response;
    }
    
    public function forward($m,$c,$a)
    {
        return $this->_container->getApp()->run($m,$c,$a);
    }

}
?>