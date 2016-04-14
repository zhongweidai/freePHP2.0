<?php
namespace Component\Route;
/**
 * 路由组件抽象类
 * @author Dai Zhongwei <daizhongw@gmail.com> 2011-7-10
 * @copyright ©2006-2103 
 * @version $$Id$$
 * @package base
 */
abstract class AbstractFreeRoute{
    abstract public function getApp();
	/**
	 * 获取模型
	 */
	abstract public function getM();

	/**
	 * 获取控制器
	 */
	abstract public function getC();

	/**
	 * 获取事件
	 */
	abstract public function getA();
	/**
	 * url拼凑
	 */
	abstract public function assemble($action, $args = '');
}
?>