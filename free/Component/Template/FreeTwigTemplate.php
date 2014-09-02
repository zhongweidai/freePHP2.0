<?php
/**
 * Created by PhpStorm.
 * User: dai
 * Date: 14-8-29
 * Time: 下午9:51
 */

namespace Component\Template;
require_once FREE_PATH .'free/Component/Template/Twig/Autoloader.php';

class FreeTwigTemplate
{
    protected $_container;
    protected $_twig;

    private $data = array();
    public function __construct($container)
    {
        $this->_container = $container;
        $config = $this->_container->loadConfig('application',APP);
        if(isset($config['template-path']))
        {
            $path = FREE_PATH . $config['template-path'];
        }else{
            $path = FREE_PATH . 'src' . DIRECTORY_SEPARATOR . APP . 'templates';
        }
        \Twig_Autoloader::register();

        $loader = new \Twig_Loader_Filesystem($path);
        $this->_twig = new \Twig_Environment($loader, array(
            'cache' => FREE_PATH . '/caches/templates/compilation_cache',
            'debug' => !defined('FREE_RUNTIME') || !FREE_RUNTIME,
        ));
        if(isset($config['Twig_extends']))
        {
            $this->setExtends($config['Twig_extends']);
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

    public function  setGlobals()
    {
        $this->_twig->addGlobal('app', $this->_container->loadApp());
    }
}