<?php
/**
 * Created by PhpStorm.
 * User: dai
 * Date: 14-9-8
 * Time: 上午10:26
 */

namespace Mall\Service;

class ServiceKernel
{
    private static $_instance;
    protected $environment;
    protected $debug;
    protected $booted;
    protected $container;
    //protected $parameterBag;
    //protected $doctrine;

    protected $currentUser;

    protected $pool=array();

    public static function create($environment='prod',$debug=false)
    {
        if(self::$_instance)
        {
            return self::$_instance;
        }
        $instance = new self();
        $instance->environment = $environment;
        $instance->debug = $debug;
        self::$_instance = $instance;
        self::$_instance->setContainer(\FreeKernel::container());
        return $instance;
    }

    public static function instance()
    {
        if(empty(self::$_instance))
        {
            self::create();
        }
        self::$_instance->boot();
        return self::$_instance;
    }

    public function boot()
    {
        if(true === $this->booted)
        {
            return ;
        }
    }

    public function setContainer($container)
    {
        $this->container = $container;
    }
    public function getContainer()
    {
        return $this->container;
    }
    /**
    public function setParameterBag($parameter)
    {
    $this->parameterBag = $parameter;
    }
     **/

    public function loadConfig($file,$key)
    {
        if(is_null($this->container))
        {
            throw new \RuntimeException('getParameter未初始化container');
        }
        return $this->container->loadConfig($file,$key);
    }
    public function getModel($modelName)
    {
        if(is_null($this->container))
        {
            throw new \RuntimeException('getModle未初始化container');
        }
        return $this->container->loadModel($modelName);
    }

    public function setCurrentUser($currentUser)
    {
        $this->currentUser = $currentUser;
        return $this;
    }

    public function getCurrentUser()
    {
        if (is_null($this->currentUser)) {
            $this->currentUser = $this->container->get('security.context')->getToken()->getUser();
            if(!is_object($this->currentUser))
            {
                $user = array(
                    'id' => 0,
                    'nickname' => '游客',
                    'currentIp' =>  $this->container->get('request')->getClientIp(),
                    'roles' => array(),
                );
                $this->currentUser = new EduUser($user['id'],'','','',$user['nickname'],array(),$user);
                return $this->currentUser;
            }
        }
        return $this->currentUser;
    }

    public function createService($name)
    {
        if (empty($this->pool[$name]))
        {
            $class = $this->getClassName($name);
            $service = new $class();
            //$dao->setConnection($this->getConnection());
            $this->pool[$name] = $service;
        }
        return $this->pool[$name];
    }

    protected function getClassName($name)
    {
        if (strpos($name, ':') > 0) {
            list($namespace, $name) = explode(':', $name, 2);

            $namespace .= '\\Service';
        } else {
            $namespace = substr(__NAMESPACE__, 0, -strlen('Common')-1);
        }
        list($module, $className) = explode('.', $name);

        // $type = strtolower($type);
        /**if ($type == 'dao') {
        return $namespace . '\\' . $module. '\\Dao\\Impl\\' . $className . 'Impl';
        }
         **/
        return $namespace . '\\' . $module. '\\' . $className ;
    }

} 