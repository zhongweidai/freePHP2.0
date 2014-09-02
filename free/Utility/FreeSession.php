<?php
namespace Utility;
/**
 * cookie操作类
 * 
 * 使用的时候全部采用静态的方式使用该类中的所有方法:
 * <code>
 * Free::import('WIND:http.cookie.FreeCookie');
 * FreeCookie::set('name', 'test');
 * </code>
 * 
 * @package http
 * @subpackage cookie
 */
class FreeCookie
{
	private static $_pre = 'Free_';
	/**
	 * 设置cookie
	 * 
	 * @param string $name cookie名称
	 * @param string $value cookie值,默认为null
	 * @param boolean $encode 是否使用 MIME base64 对数据进行编码,默认是false即不进行编码
	 * @param string|int $expires 过期时间,默认为null即会话cookie,随着会话结束将会销毁
	 * @param string $path cookie保存的路径,默认为null即采用默认
	 * @param string $domain cookie所属域,默认为null即不设置
	 * @param boolean $secure 是否安全连接,默认为false即不采用安全链接
	 * @param boolean $httponly 是否可通过客户端脚本访问,默认为false即客户端脚本可以访问cookie
	 * @return boolean 设置成功返回true,失败返回false
	 */
	public static function set($name, $value = null, $encode = true, $expires = null, $path = null, $domain = null, $secure = false, $httponly = false) {
		if (empty($name)) return false;
		$encode && $value && $value = base64_encode(serialize($value));
		$path = $path ? $path : '/';
		setcookie(self::$_pre . $name, $value, $expires, $path, $domain, $secure, $httponly);
		return true;
	}

	/**
	 * 根据cookie的名字删除cookie
	 * 
	 * @param string $name cookie名称
	 * @return boolean 删除成功返回true
	 */
	public static function delete($name) {
		if (self::exist($name)) {
			self::set(self::$_pre . $name, '',true,SYS_TIME-3600);
		}
		return true;
	}

	/**
	 * 取得指定名称的cookie值
	 * 
	 * @param string $name cookie名称
	 * @param boolean $dencode 是否对cookie值进行过解码,默认为false即不用解码
	 * @return mixed 获取成功将返回保存的cookie值,获取失败将返回false
	 */
	public static function get($name, $dencode = true) {
		if (self::exist($name)) {
			$value = $_COOKIE[self::$_pre . $name];
			$value && $dencode && $value = unserialize(base64_decode($value));
			return $value ? $value : $value;
		}
		return false;
	}

	/**
	 * 移除全部cookie
	 * 
	 * @return boolean 移除成功将返回true
	 */
	public static function deleteAll() {
		$_COOKIE = array();
		return true;
	}

	/**
	 * 判断cookie是否存在
	 * 
	 * @param string $name cookie名称
	 * @return boolean 如果不存在则返回false,否则返回true
	 */
	public static function exist($name) {
		return isset($_COOKIE[self::$_pre . $name]);
	}
}

/**
 * 
 **/
class FreeSession
{
	static public function set($key,$value)
	{
		if(is_array($_SESSION[$key]))
		{
			$_SESSION[$key] = array_merge($_SESSION[$key],$value); 
		}else{
			$_SESSION[$key] = $value;
		}
	}
	
	static public function get($key)
	{
		return isset($_SESSION[$key]) ? $_SESSION[$key] : NULL;
	}
	
	static public function delete($key)
	{
		if(isset($_SESSION[$key]) )
		{
			unset($_SESSION[$key]);
		}
	}
}
?>