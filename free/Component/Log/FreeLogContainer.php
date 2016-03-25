<?php
namespace Component\Log;
/**
 * 日志容器
 * 
 * @author Dai Zhongwei <daizhongw@gmail.com> 2011-7-10
 * @copyright ©2006-2103 
 * @version $$Id$$
 * @package base
 */
class FreeLogContainer
{
	private $key = 'LogContainer';
    private $_instance = NULL;
    private $container = array();
    
    public function __construct()
    {
        
    }
	
	static public function instance()
	{
		if(self::_instance === NULL)
		{
			self::_instance = new self();
		}
		return self::_instance;
	}
	
	public function setContainer($log,$key)
	{
		$this->container[$key][] = $log;
        return true;
	}
	public function getContainer()
	{
		return $this->container;
	}
    public static function put($log,$key='system')
    {
        return self::instance()->setContainer($log,$key);
    }
	
    public static function flush()
    {
		//写入日志，目录结构为log/年/月/log_日_时.txt
		$y = date('Y');
		$m = date('m');
		$d = date('d');
		$ldir = FREE_PATH . '/caches/logs/';
		$ydir = FREE_PATH . '/caches/logs/' .$y;
		$mdir = FREE_PATH . '/caches/logs/'.$m;
		if(!is_dir($ldir))
		{
			mkdir($ldir, 0777,true);
		}
		if(!is_dir($ydir))
		{
			mkdir($ydir, 0777,true);
		}
		if(!is_dir($mdir))
		{
			mkdir($mdir, 0777,true);
		}
		$container = self::getContainer();
		
		foreach($container as $key => $logs)
		{
			$tempstr = date('Y-m-d H:i:s') . ': ';
			foreach($logs as $log)
			{
				$tempstr .= "\r\n		" . $log;
			}
			$tempstr .= "\r\n";
			$filepath = $mdir . '/' . 'log_' . $key . '-' .$d . '-' . date('H'). '.txt';
			if(!file_exists($filepath))
			{
				touch($filepath);
			} 
			chmod($filepath, 0777);
			error_log($tempstr, 3, $filepath);
		}
        return true;
    }
    
    public static function get($key='error')
    {
		$container = self::instance()->getContainer();
        return isset($container[$key]) ? $container[$key] : NULL;
    }
    
}

?>
