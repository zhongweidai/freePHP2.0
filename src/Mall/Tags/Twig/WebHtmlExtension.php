<?php
/**
 * Created by PhpStorm.
 * User: dai
 * Date: 14-8-30
 * Time: 5:30
 */
namespace Mall\Tags\Twig;
use Utility\FreeString;
use Mall\Service\ServiceUtil;

class WebHtmlExtension extends \Twig_Extension
{
    protected $_container;

    public function __construct ($container)
    {
        $this->_container = $container;
    }

    public function getFilters ()
    {
        return array(
              'cut_str' => new \Twig_Filter_Method($this, 'filterCutStr') ,
               'ncPriceFormatForList' => new \Twig_Filter_Method($this, 'filterNcPriceFormatForList') 
        );
    }

    public function getFunctions ()
    {
        return array(
                'path' => new \Twig_Function_Method($this, 'getPath'),
        		'replaceParam' => NEW \Twig_Function_Method($this, 'getReplaceParam'),
        		'dropParam' => new \Twig_Function_Method($this, 'getDropParam'),
                'file_path' => new \Twig_Function_Method($this, 'getFilePath'),
                'setting' => new \Twig_Function_Method($this, 'getSetting'),
                'csrf_token' => new \Twig_Function_Method($this, 'getCsrfToken'),
                'assets' => new \Twig_Function_Method($this, 'getAssets'),
                'thumb' => new \Twig_Function_Method($this, 'getThumb'),
                'gthumb' => new \Twig_Function_Method($this, 'getGthumb'),
        		'cAttache' => new \Twig_Function_Method($this, 'getCAttache'),
                'lang'  => new \Twig_Function_Method($this, 'getLang'),
                'defaultGoodsImage' => new \Twig_Function_Method($this, 'getDefaultGoodsImage'),
        );
    }
     /**
      * url拼接
      * @param string $action
      * @param unknown $args
      * @param string $anchor
      * @param string $script
      * @return string
      */
    public function getPath ($action='', $args = array(), $anchor = '', $script = '')
    {
        return ServiceUtil::path($action,$args,$anchor,$script);
    }
    
    /**
     * 删除地址参数
     *
     * @param array $param
     */
    public function getDropParam($param) {
    	return ServiceUtil::dropParam($param);
    }
    
    public function getReplaceParam($param)
    {
    	return '#';
    }
    

    /**
     * 
     * @param
     *            $uri
     * @param string $default            
     * @param bool $absolute            
     * @return string
     */
    public function getFilePath ($uri, $default = '', $absolute = false)
    {
        
    }
    /**
     * 网站设置
     * @param string $name
     * @param string $default
     * @return string
     */
    public function getSetting ($name, $default = '')
    {
        return "[$name]" . $default;
    }

    public function getCsrfToken ($name)
    {
        return $name;
    }
    /**
     * assert 地址标签
     * @param string $path
     * @return Ambigous <string, unknown>
     */
    public function getAssets($path='')
    {
       return ServiceUtil::assets($path);
    }
    /**
     * 团购图片标签
     * @param string $image_name
     * @param string $type
     * @return Ambigous <string, unknown>|string
     */
    function getGthumb($image_name = '', $type = ''){
        if (!in_array($type, array('small','mid','max'))) 
        {
            $type = 'small';
        }

        if (empty($image_name))
        {
            return ServiceUtil::assets('style/default/images/default.jpg');
        }
        $upload_url = $this->_container->loadConfig('system','upload_url');
        list($base_name, $ext) = explode('.', $image_name);
        list($store_id) = explode('_', $base_name);
        $file_path = 'shop/groupbuy/'.$store_id.'/'.$base_name.'_'.$type.'.'.$ext;
        return $upload_url.'/'.$file_path;
    }
    
    public function getDefaultGoodsImage($type=240)
    {
        return ServiceUtil::defaultGoodsImage($type);
    }
    /**
     * 商品图片地址 标签
     * @param array $goods
     * @param string $type
     * @return string
     */
    public function getThumb($goods = array(), $type = '')
    {
        return ServiceUtil::thumb($goods,$type);
    }
    
    public function getCAttache($path)
    {
    	return ServiceUtil::cAttache($path);
    }
    /**
     * 字符截取过滤
     * @param String $string
     * @param int $len
     * @param String $dot
     * @return Ambigous <string, string>
     */
    public function filterCutStr( $string, $len, $dot='...')
    {
        return FreeString::substr($string, 0, $len,'utf-8',$dot);
    }
    
    public function filterNcPriceFormatForList($price)
    {
        if ($price >= 10000) {
            return number_format(floor($price/100)/100,2,'.',''). ' ' . ServiceUtil::lang('ten_thousand');
        } else {
            return ServiceUtil::lang('common:currency') . $price;
        }
    }
    
    public function getLang($path)
    {
        return ServiceUtil::lang($path);
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName ()
    {
        return 'Web_html_twig';
    }
} 