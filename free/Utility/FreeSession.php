<?php
namespace Utility;
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