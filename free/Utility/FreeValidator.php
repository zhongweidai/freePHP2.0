<?php
namespace Utility;
/**
 * 通用验证类
 *
 */
class FreeValidator {

	/**
	 * 验证是否是电话号码
	 * 
	 * 国际区号-地区号-电话号码的格式（在国际区号前可以有前导0和前导+号），
	 * 
	 * 地区号支持3-4位
	 * 电话号码支持7到8位
	 * 
	 * @param string $phone 被验证的电话号码
	 * @return boolean 如果验证通过则返回true，否则返回false
	 */
	public static function isTelPhone($phone) {
		return preg_match('/(^[0-9]{3,4}[0-9]{5,8}$)|(^[0-9]{7,8}$)|(^\([0-9]{3,4}\)[0-9]{5,8}$)|(^0{0,1}13[0-9]{9}$)/',$phone);
		//return 0 < preg_match('/^\+?[0\s]*[\d]{0,4}[\-\s]?\d{0,6}[\-\s]?\d{4,12}$/', $phone);
	}

	/**
	 * 验证是否是手机号码
	 * 
	 * 国际区号-手机号码
	 *
	 * @param string $number 待验证的号码
	 * @return boolean 如果验证失败返回false,验证成功返回true
	 */
	public static function isTelNumber($number) {
		//return 0 < preg_match('/^\+?[0\s]*[\d]{0,4}[\-\s]?\d{4,12}$/', $number);
		return strlen($number) == 11 && preg_match('/^13[0-9]\d{8}$|15[0-9]\d{8}$|14[0-9]\d{8}$|18[0-9]\d{8}$/', $number);
	}

	/**
	 * 验证是否是QQ号码
	 * 
	 * QQ号码必须是以1-9的数字开头，并且长度5-15为的数字串
	 *
	 * @param string $qq 待验证的qq号码
	 * @return boolean 如果验证成功返回true，否则返回false
	 */
	public static function isQQ($qq) {
		return 0 < preg_match('/^[1-9]\d{4,14}$/', $qq);
	}

	/**
	 * 验证是否是邮政编码
	 * 
	 * 邮政编码是4-8个长度的数字串
	 *
	 * @param string $zipcode 待验证的邮编
	 * @return boolean 如果验证成功返回true，否则返回false
	 */
	public static function isZipcode($zipcode) {
		return 0 < preg_match('/^\d{4,8}$/', $zipcode);
	}

	/**
	 * 验证是否是有合法的email
	 * 
	 * @param string $string  被搜索的 字符串
	 * @param array $matches  会被搜索的结果,默认为array()
	 * @param boolean $ifAll  是否进行全局正则表达式匹配，默认为false即仅进行一次匹配
	 * @return boolean 如果匹配成功返回true，否则返回false
	 */
	public static function hasEmail($string, &$matches = array(), $ifAll = false) {
		return 0 < self::validateByRegExp("/\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/", $string);
	}

	/**
	 * 验证是否是合法的email
	 * 
	 * @param string $string 待验证的字串
	 * @return boolean 如果是email则返回true，否则返回false
	 */
	public static function isEmail($string) {
		return 0 < preg_match("/^\w+(?:[-+.']\w+)*@\w+(?:[-.]\w+)*\.\w+(?:[-.]\w+)*$/", $string);
	}

	/**
	 * 验证是否有合法的身份证号
	 * 
	 * @param string $string  被搜索的 字符串
	 * @param array $matches  会被搜索的结果,默认为array()
	 * @param boolean $ifAll  是否进行全局正则表达式匹配，默认为false即仅进行一次匹配
	 * @return boolean 如果匹配成功返回true，否则返回false
	 */
	public static function hasIdCard($string, &$matches = array(), $ifAll = false) {
		return 0 < self::validateByRegExp("/\d{17}[\d|X]|\d{15}/", $string, $matches, $ifAll);
	}

	/**
	 * 验证是否是合法的身份证号
	 * 
	 * @param string $string 待验证的字串
	 * @return boolean 如果是合法的身份证号则返回true，否则返回false
	 */
 	public static function isIdCard($string) {
		return 0 < preg_match("/^(?:\d{17}[\d|X]|\d{15})$/", $string);
	}

	/**
	 * 验证是否有合法的URL
	 * 
	 * @param string $string  被搜索的 字符串
	 * @param array $matches  会被搜索的结果,默认为array()
	 * @param boolean $ifAll  是否进行全局正则表达式匹配，默认为false即仅进行一次匹配
	 * @return boolean 如果匹配成功返回true，否则返回false
	 */
	public static function hasUrl($string, &$matches = array(), $ifAll = false) {
		return 0 < self::validateByRegExp('/http(s)?:\/\/([\w-]+\.)+[\w-]+(\/[\w- .\/?%&=]*)?/', $string, $matches, $ifAll);
	}

	/**
	 * 验证是否是合法的url
	 * 
	 * @param string $string 待验证的字串
	 * @return boolean 如果是合法的url则返回true，否则返回false
	 */
	public static function isUrl($string) {
		return 0 < preg_match('/^(?:http(?:s)?:\/\/(?:[\w-]+\.)+[\w-]+(?:\:\d+)*+(?:\/[\w- .\/?%&=]*)?)$/', $string);
	}

	/**
	 * 验证是否有中文
	 * 
	 * @param string $string  被搜索的 字符串
	 * @param array $matches  会被搜索的结果,默认为array()
	 * @param boolean $ifAll  是否进行全局正则表达式匹配，默认为false即仅进行一次匹配
	 * @return boolean 如果匹配成功返回true，否则返回false
	 */
	public static function hasChinese($string, &$matches = array(), $ifAll = false) {
		return 0 < self::validateByRegExp('/[\x{4e00}-\x{9fa5}]+/u', $string, $matches, $ifAll);
	}

	/**
	 * 验证是否是中文
	 * 
	 * @param string $string 待验证的字串
	 * @return boolean 如果是中文则返回true，否则返回false
	 */
	public static function isChinese($string) {
		return 0 < preg_match('/^[\x{4e00}-\x{9fa5}]+$/u', $string);
	}

	/**
	 * 验证是否有html标记
	 * 
	 * @param string $string  被搜索的 字符串
	 * @param array $matches  会被搜索的结果,默认为array()
	 * @param boolean $ifAll  是否进行全局正则表达式匹配，默认为false即仅进行一次匹配
	 * @return boolean 如果匹配成功返回true，否则返回false
	 */
	public static function hasHtml($string, &$matches = array(), $ifAll = false) {
		return 0 < self::validateByRegExp('/<(.*)>.*|<(.*)\/>/', $string, $matches, $ifAll);
	}

	/**
	 * 验证是否是合法的html标记
	 * 
	 * @param string $string 待验证的字串
	 * @return boolean 如果是合法的html标记则返回true，否则返回false
	 */
	public static function isHtml($string) {
		return 0 < preg_match('/^<(.*)>.*|<(.*)\/>$/', $string);
	}

	/**
	 * 验证是否有合法的ipv4地址
	 * 
	 * @param string $string   被搜索的 字符串
	 * @param array $matches   会被搜索的结果,默认为array()
	 * @param boolean $ifAll   是否进行全局正则表达式匹配，默认为false即仅进行一次匹配
	 * @return boolean 如果匹配成功返回true，否则返回false
	 */
	public static function hasIpv4($string, &$matches = array(), $ifAll = false) {
		return 0 < self::validateByRegExp('/((25[0-5]|2[0-4]\d|1\d{2}|0?[1-9]\d|0?0?\d)\.){3}(25[0-5]|2[0-4]\d|1\d{2}|0?[1-9]\d|0?0?\d)/', $string, $matches, $ifAll);
	}

	/**
	 * 验证是否是合法的IP
	 * 
	 * @param string $string 待验证的字串
	 * @return boolean 如果是合法的IP则返回true，否则返回false
	 */
	public static function isIpv4($string) {
		return 0 < preg_match('/(?:(?:25[0-5]|2[0-4]\d|1\d{2}|0?[1-9]\d|0?0?\d)\.){3}(?:25[0-5]|2[0-4]\d|1\d{2}|0?[1-9]\d|0?0?\d)/', $string);
	}

	/**
	 * 验证是否有合法的ipV6
	 *
	 * @param string $string 被搜索的 字符串
	 * @param array $matches 会被搜索的结果,默认为array()
	 * @param boolean $ifAll 是否进行全局正则表达式匹配，默认为false即仅进行一次匹配
	 * @return boolean 如果匹配成功返回true，否则返回false
	 */
	public static function hasIpv6($string, &$matches = array(), $ifAll = false) {
		return 0 < self::validateByRegExp('/\A((([a-f0-9]{1,4}:){6}|
										::([a-f0-9]{1,4}:){5}|
										([a-f0-9]{1,4})?::([a-f0-9]{1,4}:){4}|
										(([a-f0-9]{1,4}:){0,1}[a-f0-9]{1,4})?::([a-f0-9]{1,4}:){3}|
										(([a-f0-9]{1,4}:){0,2}[a-f0-9]{1,4})?::([a-f0-9]{1,4}:){2}|
										(([a-f0-9]{1,4}:){0,3}[a-f0-9]{1,4})?::[a-f0-9]{1,4}:|
										(([a-f0-9]{1,4}:){0,4}[a-f0-9]{1,4})?::
									)([a-f0-9]{1,4}:[a-f0-9]{1,4}|
										(([0-9]|[1-9][0-9]|1[0-9][0-9]|2[0-4][0-9]|25[0-5])\.){3}
										([0-9]|[1-9][0-9]|1[0-9][0-9]|2[0-4][0-9]|25[0-5])
									)|((([a-f0-9]{1,4}:){0,5}[a-f0-9]{1,4})?::[a-f0-9]{1,4}|
										(([a-f0-9]{1,4}:){0,6}[a-f0-9]{1,4})?::
									)
								)\Z/ix', $string, $matches, $ifAll);
	}

	/**
	 * 验证是否是合法的ipV6
	 *
	 * @param string $string 待验证的字串
	 * @return boolean 如果是合法的ipV6则返回true，否则返回false
	 */
	public static function isIpv6($string) {
		return 0 < preg_match('/\A(?:(?:(?:[a-f0-9]{1,4}:){6}|
										::(?:[a-f0-9]{1,4}:){5}|
										(?:[a-f0-9]{1,4})?::(?:[a-f0-9]{1,4}:){4}|
										(?:(?:[a-f0-9]{1,4}:){0,1}[a-f0-9]{1,4})?::(?:[a-f0-9]{1,4}:){3}|
										(?:(?:[a-f0-9]{1,4}:){0,2}[a-f0-9]{1,4})?::(?:[a-f0-9]{1,4}:){2}|
										(?:(?:[a-f0-9]{1,4}:){0,3}[a-f0-9]{1,4})?::[a-f0-9]{1,4}:|
										(?:(?:[a-f0-9]{1,4}:){0,4}[a-f0-9]{1,4})?::
									)(?:[a-f0-9]{1,4}:[a-f0-9]{1,4}|
										(?:(?:[0-9]|[1-9][0-9]|1[0-9][0-9]|2[0-4][0-9]|25[0-5])\.){3}
										(?:[0-9]|[1-9][0-9]|1[0-9][0-9]|2[0-4][0-9]|25[0-5])
									)|(?:(?:(?:[a-f0-9]{1,4}:){0,5}[a-f0-9]{1,4})?::[a-f0-9]{1,4}|
										(?:(?:[a-f0-9]{1,4}:){0,6}[a-f0-9]{1,4})?::
									)
								)\Z/ix', $string);
	}

	/**
	 * 验证是否有客户端脚本
	 * 
	 * @param string $string 被搜索的 字符串
	 * @param array $matches 会被搜索的结果,默认为array()
	 * @param boolean $ifAll 是否进行全局正则表达式匹配，默认为false即仅进行一次匹配
	 * @return boolean 如果匹配成功返回true，否则返回false
	 */
	public static function hasScript($string, &$matches = array(), $ifAll = false) {
		return 0 < self::validateByRegExp('/<script(.*?)>([^\x00]*?)<\/script>/', $string, $matches, $ifAll);
	}

	/**
	 * 验证是否是合法的客户端脚本
	 * 
	 * @param string $string 待验证的字串
	 * @return boolean 如果是合法的客户端脚本则返回true，否则返回false
	 */
	public static function isScript($string) {
		return 0 < preg_match('/<script(?:.*?)>(?:[^\x00]*?)<\/script>/', $string);
	}

	/**
	 * 验证是否是非负数
	 * 
	 * @param int $number 需要被验证的数字 
	 * @return boolean 如果大于等于0的整数数字返回true，否则返回false
	 */
	public static function isNonNegative($number) {
		return is_numeric($number) && 0 <= $number;
	}

	/**
	 * 验证是否是正数
	 * 
	 * @param int $number 需要被验证的数字
	 * @return boolean 如果数字大于0则返回true否则返回false
	 */
	public static function isPositive($number) {
		return is_numeric($number) && 0 < $number;
	}

	/**
	 * 验证是否是负数
	 * 
	 * @param int $number  需要被验证的数字
	 * @return boolean 如果数字小于于0则返回true否则返回false
	 */
	public static function isNegative($number) {
		return is_numeric($number) && 0 > $number;
	}

	/**
	 * 验证是否是不能为空
	 *
	 * @param mixed $value 待判断的数据
	 * @return boolean 如果为空则返回false,不为空返回true
	 */
	public static function isRequired($value) {
		return !empty($value);
	}

	/**
	 * 验证字符串的长度
	 * 
	 * @param string $string 要验证的字符串
	 * @param string $length 指定的合法的长度
	 * @param string $charset 字符编码默认为utf-8编码
	 * @return boolean 如果长度大于给定的长度则返回true，否则返回false
	 */
	public static function isLegalLength($string, $length, $charset = 'utf8') {
		Free::import('WIND:utility.FreeString');
		return FreeString::strlen($string, $charset) > (int) $length;
	}

	/**
	 * 在 $string 字符串中搜索与 $regExp 给出的正则表达式相匹配的内容。
	 * 
	 * @param string $regExp  搜索的规则(正则) 
	 * @param string $string  被搜索的 字符串
	 * @param array $matches 会被搜索的结果，默认为array()
	 * @param boolean $ifAll   是否进行全局正则表达式匹配，默认为false不进行完全匹配
	 * @return int 返回匹配的次数
	 */
	private static function validateByRegExp($regExp, $string, &$matches = array(), $ifAll = false) {
		return $ifAll ? preg_match_all($regExp, $string, $matches) : preg_match($regExp, $string, $matches);
	}
	
	/**
	 * 检查密码长度是否符合规定
	 *
	 * @param STRING $password
	 * @return 	TRUE or FALSE
	 */
	public static function isPassWord($password, $min = 6, $max = 20) {
	    $strlen = strlen($password);
	    if ($strlen >= $min && $strlen <= $max)
	        return true;
	    return false;
	}
	
	/**
	 * 检查真实姓名是否符合规定
	 *
	 * @param STRING $username 要检查的姓名
	 * @return 	TRUE or FALSE
	 */
	public static function isRealName($username) {
	    $strlen = strlen($username);
	
	    if (self::isBadWord($username) || !preg_match("/^[" . chr(0x81) . "-" . chr(0xfe) . "]+$/", $username)) {
	
	        return false;
	    } elseif (12 < $strlen || $strlen < 6) {
	        return false;
	    }
		
	    return true;
	}
	
	/**
	 * 检查昵称是否符合规定
	 *
	 * @param STRING $username 要检查的昵称
	 * @return 	TRUE or FALSE
	 */
	public static function isNickName($username) {
	    $strlen = strlen($username);
	    if (self::isBadWord($username) || !preg_match("/^[a-zA-Z0-9_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]+$/", $username)) {
	        return false;
	    } elseif (20 <= $strlen || $strlen < 2) {
	        return false;
	    }
		
		//判断昵称是否包含敏感词
//		$badword = Free::loadModel('badWord');
//		$new_username = $badword->replace_badword($username);
//		if ($new_username != $username) return false;
	    return true;
	}
	
	/**
	 * 检查用户名是否符合规定
	 *
	 * @param STRING $username 要检查的用户名
	 * @return 	TRUE or FALSE
	 */
	public static function isUserName($username,$min=6,$max=20) {
	    $strlen = strlen($username);
	    if (self::isBadWord($username) || !preg_match("/^[a-zA-Z][a-zA-Z0-9_.@]{0,99}$/", $username)) {
	        return false;
	    } elseif ($max < $strlen || $strlen < $min) {
	        return false;
	    }
	    return true;
	}
	
	/**
	 * 检测输入中是否含有错误字符
	 *
	 * @param char $string 要检查的字符串名称
	 * @return TRUE or FALSE
	 */
	public static function isBadWord($string) {
	    $badwords = array("\\", '&', ' ', "'", '"', '/', '*', ',', '<', '>', "\r", "\t", "\n", "#");
	    foreach ($badwords as $value) {
	        if (strpos($string, $value) !== FALSE) {
	            return TRUE;
	        }
	    }
	    return FALSE;
	}
}