<?php
namespace Utility;
/**
 * 字符串格式化
 *
 * @author Qian Su <aoxue.1988.su.qian@163.com>
 * @copyright ©2003-2103 phpwind.com
 * @license http://www.windframework.com
 * @version $Id: FreeString.php 3533 2012-05-08 08:24:20Z yishuo $
 * @package utility
 */
class FreeString {
	
	const UTF8 = 'utf-8';
	
	const GBK = 'gbk';

	/**
	 * 截取字符串,支持字符编码,默认为utf-8
	 * 
	 * @param string $string 要截取的字符串编码
	 * @param int $start     开始截取
	 * @param int $length    截取的长度
	 * @param string $charset 原妈编码,默认为UTF8
	 * @param boolean $dot    是否显示省略号,默认为false
	 * @return string 截取后的字串
	 */
	public static function substr($string, $start, $length, $charset = self::UTF8, $dot = false) 
	{
		switch($charset)
        {
            case 'utf-8' :
                $charLen = 3;
                break;
            case 'UTF8':
                $charLen = 3;
                break;
            default:
                $charLen = 2;
        }
        //小于指定长度，直接返回
        if(strlen($string) <= ($length*$charLen))
        {
            return $string;
        }
        if(function_exists("mb_substr"))
        {
            $slice = mb_substr($string, $start, $length, $charset);
        }
        else if(function_exists('iconv_substr'))
        {
            $slice = iconv_substr($string,$start,$length,$charset);
        }
        else
        {
            $re['utf-8']   = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
            $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
            $re['gbk']    = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
            $re['big5']   = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
            $pattern = isset($re[$charset]) ? $re[$charset] : $re['utf-8'];
            preg_match_all($pattern, $string, $match);
            $slice = join("",array_slice($match[0], $start, $length));
        }
        if($dot)
            return $slice."…";

        return $slice;
		/*
		switch (strtolower($charset)) {
			case self::GBK:
				$string = self::substrForGbk($string, $start, $length, $dot);
				break;
			default:
				$string = self::substrForUtf8($string, $start, $length, $dot);
				break;
		}
		return $string;
		*/
	}

	/**
	 * 求取字符串长度
	 * 
	 * @param string $string  要计算的字符串编码
	 * @param string $charset 原始编码,默认为UTF8
	 * @return int
	 */
	public static function strlen($string, $charset = self::UTF8) {
		$len = strlen($string);
		$i = $count = 0;
		$charset = strtolower(substr($charset, 0, 3));
		while ($i < $len) {
			if (ord($string[$i]) <= 129)
				$i++;
			else
				switch ($charset) {
					case 'utf':
						$i += 3;
						break;
					default:
						$i += 2;
						break;
				}
			$count++;
		}
		return $count;
	}

	/**
	 * 将变量的值转换为字符串
	 *
	 * @param mixed $input   变量
	 * @param string $indent 缩进,默认为''
	 * @return string
	 */
	public static function varToString($input, $indent = '') {
		switch (gettype($input)) {
			case 'string':
				return "'" . str_replace(array("\\", "'"), array("\\\\", "\\'"), $input) . "'";
			case 'array':
				$output = "array(\r\n";
				foreach ($input as $key => $value) {
					$output .= $indent . "\t" . self::varToString($key, $indent . "\t") . ' => ' . self::varToString(
						$value, $indent . "\t");
					$output .= ",\r\n";
				}
				$output .= $indent . ')';
				return $output;
			case 'boolean':
				return $input ? 'true' : 'false';
			case 'NULL':
				return 'NULL';
			case 'integer':
			case 'double':
			case 'float':
				return "'" . (string) $input . "'";
		}
		return 'NULL';
	}

	/**
	 * 以utf8格式截取的字符串编码
	 * 
	 * @param string $string  要截取的字符串编码
	 * @param int $start      开始截取
	 * @param int $length     截取的长度，默认为null，取字符串的全长
	 * @param boolean $dot    是否显示省略号，默认为false
	 * @return string
	 */
	public static function substrForUtf8($string, $start, $length = null, $dot = false) {
		if (empty($string)) return '';
		$strlen = strlen($string);
		$length = $length ? (int) $length : $strlen;
		$substr = '';
		$chinese = $word = 0;
		for ($i = 0, $j = 0; $i < (int) $start; $i++) {
			if (0xa0 < ord(substr($string, $j, 1))) {
				$chinese++;
				$j += 2;
			} else {
				$word++;
			}
			$j++;
		}
		$start = $word + 3 * $chinese;
		for ($i = $start, $j = $start; $i < $start + $length; $i++) {
			if (0xa0 < ord(substr($string, $j, 1))) {
				$substr .= substr($string, $j, 3);
				$j += 2;
			} else {
				$substr .= substr($string, $j, 1);
			}
			$j++;
		}
		(strlen($substr) < $strlen) && $dot && $substr .= "...";
		return $substr;
	}

	/**
	 * 以gbk格式截取的字符串编码
	 * 
	 * @param string $string  要截取的字符串编码
	 * @param int $start      开始截取
	 * @param int $length     截取的长度，默认为null，取字符串的全长
	 * @param boolean $dot    是否显示省略号，默认为false
	 * @return string
	 */
	public static function substrForGbk($string, $start, $length = null, $dot = false) {
		if (empty($string) || !is_int($start) || ($length && !is_int($length))) {
			return '';
		}
		$strlen = strlen($string);
		$length = $length ? $length : $strlen;
		$substr = '';
		$chinese = $word = 0;
		for ($i = 0, $j = 0; $i < $start; $i++) {
			if (0xa0 < ord(substr($string, $j, 1))) {
				$chinese++;
				$j++;
			} else {
				$word++;
			}
			$j++;
		}
		$start = $word + 2 * $chinese;
		for ($i = $start, $j = $start; $i < $start + $length; $i++) {
			if (0xa0 < ord(substr($string, $j, 1))) {
				$substr .= substr($string, $j, 2);
				$j++;
			} else {
				$substr .= substr($string, $j, 1);
			}
			$j++;
		}
		(strlen($substr) < $strlen) && $dot && $substr .= "...";
		return $substr;
	}

	/**
	 * 以utf8求取字符串长度
	 * 
	 * @param string $str     要计算的字符串编码
	 * @return int
	 */
	public static function strlenForUtf8($str) {
		$i = $count = 0;
		$len = strlen($str);
		while ($i < $len) {
			$chr = ord($str[$i]);
			$count++;
			$i++;
			if ($i >= $len) break;
			if ($chr & 0x80) {
				$chr <<= 1;
				while ($chr & 0x80) {
					$i++;
					$chr <<= 1;
				}
			}
		}
		return $count;
	}

	/**
	 * 以gbk求取字符串长度
	 * 
	 * @param string $str     要计算的字符串编码
	 * @return int
	 */
	public static function strlenForGbk($string) {
		$len = strlen($string);
		$i = $count = 0;
		while ($i < $len) {
			ord($string[$i]) > 129 ? $i += 2 : $i++;
			$count++;
		}
		return $count;
	}
	
	/**
	*去掉首尾空格
	**/
	public static function trim($string)
	{
		if(is_array($string))
		{
			foreach($string as $key => $val)
			{
				$string[$key] = self::trim($val);
			}
		}else{
			return trim($string);
		}
		return $string;
	}
    /**
     * 生成唯一码
     **/
    public static function genUuid()
    {
        return uniqid();
    }
	
	public static function addslashes($string)
	{
		if(!is_array($string)) 
		{
			return addslashes($string);
		}
		foreach($string as $key => $val) 
		{
			$string[$key] = self::addslashes($val);
		}
		return $string;
	}
	
	public static function stripslashes($string)
	{
		if(!is_array($string)) 
		{
			return stripslashes($string);
		}
		foreach($string as $key => $val) 
		{
			$string[$key] = self::stripslashes($val);
		}
		return $string;
	}
	/**
	*	输出百分数
	*/
	public static function percent($total,$num,$de=2)
	{
		return number_format($num/$total*100,$de);
	}

	/**
	*	阿拉伯数字转中文数字
	*/
	public static function toChinaseNum($num)
	{
	    $char = array("零","一","二","三","四","五","六","七","八","九");
	    $dw = array("","十","百","千","万","亿","兆");
	    $retval = "";
	    $proZero = false;
	    for($i = 0;$i < strlen($num);$i++)
	    {
	        if($i > 0)    $temp = (int)(($num % pow (10,$i+1)) / pow (10,$i));
	        else $temp = (int)($num % pow (10,1));
	        
	        if($proZero == true && $temp == 0) continue;
	        
	        if($temp == 0) $proZero = true;
	        else $proZero = false;
	        
	        if($proZero)
	        {
	            if($retval == "") continue;
	            $retval = $char[$temp].$retval;
	        }
	        else $retval = $char[$temp].$dw[$i].$retval;
	    }
	    if($retval == "一十") $retval = "十";
	    
	    return $retval;
	}

	/**
     * 容量单位计算，支持定义小数保留长度；定义起始和目标单位，或按1024自动进位
     * 
     * @param int $size,容量计数
     * @param type $unit,容量计数单位，默认为字节
     * @param type $decimals,小数点后保留的位数，默认保留一位
     * @param type $targetUnit,转换的目标单位，默认自动进位
     * @return type 返回符合要求的带单位结果
     */
    static function fileSizeConvert($size, $unit = 'B', $decimals = 1, $targetUnit = 'auto') 
    {
        $units = array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB');
        $theUnit = array_search(strtoupper($unit), $units); //初始单位是哪个
        //判断是否自动计算，
        if ($targetUnit != 'auto')
            $targetUnit = array_search(strtoupper($targetUnit), $units);
        //循环计算
        while ($size >= 1024) 
        {
            $size/=1024;
            $theUnit++;
            if ($theUnit == $targetUnit)//已符合给定则退出循环吧！
                break;
        }

        return sprintf("%1\$.{$decimals}f", $size) . $units[$theUnit];
    }
	
	/**
	 * 格式化html
	 * */
	public static function compress_html($string) 
	{ 
		$string = str_replace("\r\n", '', $string); //清除换行符 
		$string = str_replace("\n", '', $string); //清除换行符 
		$string = str_replace("\t", '', $string); //清除制表符 
		$pattern = array ( 
		"/> *([^ ]*) *</", //去掉注释标记 
		"/[\s]+/", 
		"/<!--[^!]*-->/", 
		"/\" /", 
		"/ \"/", 
		"'/\*[^*]*\*/'" 
		); 
		$replace = array ( 
		">\\1<", 
		" ", 
		"", 
		"\"", 
		"\"", 
		"" 
		); 
		return preg_replace($pattern, $replace, $string); 
	}
}