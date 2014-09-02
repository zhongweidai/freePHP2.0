<?php
/**
 * Created by PhpStorm.
 * User: dai
 * Date: 14-8-30
 * Time: 下午5:30
 */

namespace Web\Tags\Twig;


class WebHtmlExtension extends \Twig_Extension {
    protected $_container;

    public function __construct($container)
    {
        $this->_container = $container;
    }
    public function getFilter()
    {
        return array(

        );
    }
    public function getFunctions()
    {
        return array(
            'path'  => new \Twig_Function_Method($this, 'getPath'),
            'file_path'  => new \Twig_Function_Method($this, 'getFilePath'),
        );
    }

    public function getPath($action,$args=array(),$anchor='',$script='')
    {
        $router = $this->_container->getComponent('route');
        $url = $router->assemble($action, $args,$script);
        $url .= $anchor ? '#' . $anchor : '';
        return $url;
    }

    /**
     * 根据附件地址获取url访问路径
     * @param $uri
     * @param string $default
     * @param bool $absolute
     * @return string
     */
    public function getFilePath($uri, $default = '', $absolute = false)
    {
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'Web_html_twig';
    }
} 