<?php
/**
 * Created by PhpStorm.
 * User: dai
 * Date: 14-8-29
 * Time: 上午10:45
 */

return array(
    'web_domain' =>'http://192.168.60.187/portal/edu/',
    'web_path' => '/portal/edu/',
    'session_ttl' => 7200,
    'session_n' => 0,
    'cookie_domain' => '',
    'cookie_path' => '/edu/',
    'cookie_pre' => 'pGClX_',
    'cookie_ttl' => 0,
    'charset' => 'utf-8',
    'timezone' => 'Etc/GMT-8',
    'upload_path' => FREE_PATH.'upload/',
    'upload_url' => '/freePHP/upload',
    'common_attache_path'=> 'shop/common',
    'attach_goods'   => 'shop/store/goods',
    'fullindexer_open' =>false,

    'twig_extends' =>array(
        'html'      =>  'Web\Tags\Twig\WebHtmlExtension',
        'data'        =>  'Web\Tags\Twig\WebDataExtension',
        'mall_html'      =>  'Mall\Tags\Twig\WebHtmlExtension',
        'mall_data'        =>  'Mall\Tags\Twig\WebDataExtension',
    ),
);