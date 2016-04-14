<?php
/**
 * Created by PhpStorm.
 * User: dai
 * Date: 14-8-28
 * Time: 下午3:48
 */
define('IN_FREE', true);

define('TIMESTAMP',time());
//error_reporting(0);
class FreeKernel
{
    private static $_loader = NULL;
    private static $_container = NULL;

    public static function run()
    {
        self::_init_();
        $container = self::container();
        $param = $container->getComponent('route',array('arguments'=> $container));
        $appName = $param->getApp();
        self::container()->setAppName($appName);
        $app = new Free\Libs\FreeApplication(self::container());
        self::container()->setApp($app);

        $response = $app->run();
        if($response instanceof Component\Http\IFreeResponse)
        {
            $response->sendResponse();
        }else{
            throw new Free\Libs\FreeException('Controller must return response.',500);
        }
    }

    public static function _init_()
    {
        //自动注册类
        self::loader()->autoLoad();
        if(FREE_RUNTIME)
        {
            if(!file_exists(FREE_PATH . 'caches/~runtime.php'))
            {
                include FREE_PATH . 'free/_compile.php';
                _free_compile();
            }
            include FREE_PATH . 'caches/~runtime.php';
        }
        self::container()->getComponent('session');
    }

    public static function getConfig($file, $key = '', $default = '', $reload = false)
    {
        return self::container()->loadConfig($file,$key,$default,$reload);
    }

    public static function setConfig($configs)
    {
        return self::container()->setConfig($configs);
    }

    public static function container()
    {
        if(self::$_container == NULL)
        {
            self::$_container = new FreeContainer();
        }
        return self::$_container;
    }
    public static function loader()
    {
        if(self::$_loader == NULL)
        {
            self::$_loader = new FreeLoader();
        }
        return self::$_loader;
    }
}

class FreeContainer
{
    private $_configs = array();
    private $_classes = array();
    private $_model = array();
    private $_app = '';

    private $_appName = '';

    private $_components = array(
        'route'              =>  'Component\Route\FreeDefaultRoute',
        'template'           =>  'Component\Template\FreeTwigTemplate',
        'cache'              =>  'Component\Cache\FreeFileCache',
        'db'                 =>  'Component\Model\Db\FreeOracleDb',
        'request'            =>  'Component\Http\FreeHttpRequest',
        'response'           =>  'Component\Http\FreeHttpResponse',
        'session'           =>  'Component\Session\FreeFileSession',
        //'token'              =>  'Component\Token\FreeSecurityToken',
        'mongo_db'           =>  'Component\Model\Db\FreeMongoDb',
        'log_container'      =>  'Component\Log\FreeLogContainer',
        //'debug'				 =>	 'free/libs/log/FreeDebug',
    );

    public function setApp($app)
    {
        $this->_app = $app;
    }

    public function getApp()
    {
        return $this->_app;
    }

    public function setAppName($appName)
    {
        $this->_appName = $appName;
    }
    public function getAppName()
    {
        return $this->_appName;
    }

    /**
     * 加载配置文件
     * @param string $file 配置文件
     * @param string $key  要获取的配置荐
     * @param string $default  默认配置。当获取配置项目失败时该值发生作用。
     * @param boolean $reload 强制重新加载。
     */
    public  function loadConfig($file='', $key = '', $default = '', $reload = false) {
        if(empty($file))
        {
            return $this->_configs;
        }
        if (!$reload && isset($this->_configs[$file])) {
            if (empty($key)) {
                return $this->_configs[$file];
            } elseif (isset($this->_configs[$file][$key])) {
                return $this->_configs[$file][$key];
            } else {
                return $default;
            }
        }
        $path = FREE_PATH.'configs'.DIRECTORY_SEPARATOR.$file.'.php';
        if (file_exists($path)) {
            $this->_configs[$file] = include $path;
        }else{
            return false;
        }
        if (empty($key)) {
            return $this->_configs[$file];
        } elseif (isset($this->_configs[$file][$key])) {
            return $this->_configs[$file][$key];
        } else {
            return $default;
        }
    }

    public function setConfig($configs)
    {
        $this->_configs = $configs;
    }

    public function loadComponents()
    {
        $paths = $this->_components;
        $upaths = $this->loadConfig('component');
        is_array($upaths) && $paths = array_merge($paths,$upaths);
        return $paths;
    }
    /**
     *	获取组件
     **/
    public function getComponent($componentName,$option = array())
    {
        $paths = $this->loadComponents();
        if(!array_key_exists($componentName,$paths))
        {
            return false;
        }
        $classname = $paths[$componentName];
        if(!isset($this->_classes[$classname]))
        {
            if(isset($option['arguments']))
            {
                $this->_classes[$classname] = new $classname($option['arguments']);
            }else{
                $this->_classes[$classname] = new $classname();
            }
            if(isset($option['method']))
            {
                $this->_classes[$classname]->$option['method']();
            }
        }
        return $this->_classes[$classname];
    }

    public function loadModel($modelName)
    {
        if(!isset($this->_model[$modelName]))
        {
            if (strpos($modelName, ':') > 0) {
                list($appName, $name) = explode(':', $modelName, 2);
            } else {
                $appName = $this->_appName;
                $name = $modelName;
            }
            $name = ucfirst($name);
            $className = $appName . "\\Model\\{$name}Model";
            try{
                $this->_model[$modelName] = new  $className($this);
            }catch ( \Exception $e){
                throw new Free\Libs\FreeException("class [$className] not found.");
            }
        }
        return $this->_model[$modelName];

    }

}

class FreeLoader
{
    private $_classes = array();

    public function autoLoad()
    {
        spl_autoload_register(array('FreeLoader', 'loadClass'), true, true);
    }

    public function getPreNamespaces()
    {
        $app_configs =  FreeKernel::container()->loadConfig('application');
        $namespaces = array(
            'Free'          =>  FREE_PATH . 'free' . DIRECTORY_SEPARATOR ,
            'Component'    => FREE_PATH . 'free' . DIRECTORY_SEPARATOR . 'Component' . DIRECTORY_SEPARATOR ,
            'Utility'      => FREE_PATH . 'free' . DIRECTORY_SEPARATOR . 'Utility' . DIRECTORY_SEPARATOR ,
            '/'             =>  '',
        );
        foreach($app_configs as $key => $val)
        {
            $namespaces [$key] = FREE_PATH . 'src' . DIRECTORY_SEPARATOR . $key . DIRECTORY_SEPARATOR;
        }
        return $namespaces;
    }

    public function setClasses($class,$path)
    {
        $this->_classes[$class] = $path;
    }

    /**
     * 加载系统类方法
     * @param string $classname 类名
     */
    private function loadClass($class)
    {
        if(isset($this->_classes[$class]))
        {
            return true;
        }
        $path = $this->findFile($class) .  '.php';
        if(file_exists($path))
        {
            $this->_classes[$class] = $path;
            include $path;
            return true;
        }else{
            $this->_classes[$class] = false;
            return false;
        }
    }

    public function findFile($class)
    {
        $pre = $this->getPreNamespaces();
        if(strrpos($class,"\\") === false)
        {
            $classname = "\\" . $class;
        }else{
            $classname = $class;
        }
        $tmp = explode("\\",$classname);
        if(!empty($tmp[0]) && isset($pre[$tmp[0]]))
        {
            $dir = $pre[$tmp[0]];
        }else{
            $dir = $pre['/'];
        }
        unset($tmp[0]);
        return $path = $dir . implode(DIRECTORY_SEPARATOR, $tmp);
    }
}

function myErrorHandler($errno, $errstr, $errfile, $errline)
{
/*    if ($errno == 8)
    {
        return '';
    }*/
    $errfile = str_replace(FREE_PATH, '', $errfile);
    if (FreeKernel::getConfig('system', 'errorlog'))
    {
        //写入日志，目录结构为log/年/月/log_日.txt
        $y = date('Y');
        $m = date('m');
        $d = date('d');
        $ldir = FREE_PATH . 'caches/error_log/';
        $ydir = FREE_PATH . 'caches/error_log/'.$y;
        $mdir = FREE_PATH . 'caches/error_log/'.$y.'/'.$m;
        if(!file_exists($ldir))
        {
            mkdir($ldir, 0777,true);
        }
        if(!file_exists($ydir))
        {
            mkdir($ydir, 0777,true);
        }
        if(!file_exists($mdir))
        {
            mkdir($mdir, 0777,true);
        }
        error_log(date('m-d H:i:s', SYS_TIME) . ' | ' . $errno . ' | ' . str_pad($errstr, 30) . ' | ' . $errfile . ' | ' . $errline . "\r\n", 3, $mdir . "/$d.php");
    } else {
        throw new Free\Libs\FreeException('errorno:' . $errno . ',str:' . $errstr . 'in file:' . $errfile . ' in line ' . $errline,500);
    }
}

function shutdown()
{
    var_dump(debug_backtrace());
    // This is our shutdown function, in
    // here we can do any last operations
    // before the script is complete.
    $e = error_get_last();
    print_r($e);
    echo 'Script executed with success', PHP_EOL;
}

function C($file, $key = '', $default = '', $reload = false)
{
       return \FreeKernel::container()->loadConfig($file,$key,$default,$reload);
}