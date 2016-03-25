<?php
/**
 * Created by PhpStorm.
 * User: dai
 * Date: 14-8-29
 * Time: 上午10:45
 */

return array(
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
	
	'default_route' => 'web/defaults/index/init',
	
	'platform_weixin' => array(
		'token'	 => 'zhongweidai',
		'appid'  => 'wx80a57ba3269753b8',
		'secret' => '219bb765d35cb6b63aa57d8c45e19888',
	),
);