<?php
ob_start();
//框架路径
    define('FREE_PATH', dirname(__FILE__).DIRECTORY_SEPARATOR);
	define('FREE_DEBUG',true);
	define('FREE_RUNTIME',true);//是否开启运行缓存 默认开启
	include FREE_PATH . '/free/Free.php';
    $loader = new FreeKernel();
    $loader->run('Mall');

?>