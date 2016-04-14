<?php
/**
 * Created by PhpStorm.
 * User: dai
 * Date: 14-8-29
 * Time: 下午9:51
 */

namespace Component\Template;
use Free\Libs\FreeException;
require_once FREE_PATH .'free/Component/Template/Twig/Autoloader.php';

class FreeTwigTemplate
{
    protected $_container;
    protected $_twig;

    private $data = array();
    public function __construct($container,$config=array())
    {
        $this->_container = $container;
        $config = $this->_container->loadConfig('application',$this->_container->getAppName());
        if(isset($config['template-path']))
        {
            $path = FREE_PATH . $config['template-path'];
        }else{
            $path = FREE_PATH . 'src' . DIRECTORY_SEPARATOR . $this->_container->getAppName() . DIRECTORY_SEPARATOR .'templates' . DIRECTORY_SEPARATOR;
        }
        \Twig_Autoloader::register();

        $loader = new \Twig_Loader_Filesystem($path);
        $this->_twig = new \Twig_Environment($loader, array(
            'cache' => FREE_PATH . '/caches/templates/compilation_cache/' . $this->_container->getAppName() . DIRECTORY_SEPARATOR,
            'debug' => !defined('FREE_RUNTIME') || !FREE_RUNTIME,
        ));
        $this->setSysFunction();
        $twig_extends = $this->_container->loadConfig('system','twig_extends');

        if($twig_extends)
        {
            $this->setExtends($twig_extends);
        }
        $this->setGlobals();
    }
    public function render($template,$data = array())
    {
        $template = $this->_twig->loadTemplate($template);
        is_array($data) && $this->data = array_merge($this->data,$data);
        return $template->render($this->data);
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function setExtends($extend)
    {
        if(is_array($extend))
        {
            foreach($extend as $e)
            {
                $this->_twig->addExtension(new $e($this->_container));
            }
        }else{
            $this->setExtends(array($extend));
        }
    }
    
    public function setSysFunction()
    {

        $options = array('is_safe' => array('html'));
        
        $function = new \Twig_SimpleFunction('freeRender', array($this, 'freeRender'), $options);
        $this->_twig->addFunction($function);
    }

    public function  setGlobals()
    {
        $this->_twig->addGlobal('app', $this->_container->getApp());
    }
    
    public function freeRender($forward,$option=NULL)
    {
        list($m,$c,$a) = explode('/',$forward );
        $classname = $this->_container->getAppName(). "\\" . 'Controller'. "\\" .ucfirst($m) . "\\" . ucfirst($c) . 'Controller';
        $a = $a . 'Action';
        if($controller = new $classname($this->_container))
        {
            if (method_exists($controller, $a))
            {
                $controller->setIsMajor(false);
                if($option !== NULL)
                {
                    $response = call_user_func(array($controller, $a),$option);
                }else{
                    $response = call_user_func(array($controller, $a));
                }
                echo $response;
            }else{
                throw new FreeException($a.' does not exist.','500');
            }
        }else{
            throw new FreeException($c.'	controller does not exist.','500');
        }
    }
}