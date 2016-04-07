<?php
/**
 * Created by PhpStorm.
 * User: dai
 * Date: 14-9-1
 * Time: 下午5:09
 */

namespace Mall\Service;

class ServiceBase
{

    public function getModle($modelName)
    {
        return ServiceKernel::instance()->getModel($modelName);
    }
    
    public function getCacheCompenont()
    {
        return ServiceKernel::instance()->getContainer()->getComponent('cache',array('arguments'=>ServiceKernel::instance()->getContainer()));
    }
    
    public function getContainer()
    {
        return ServiceKernel::instance()->getContainer();
    }
    
    public function getService($serviceName)
    {
        return ServiceKernel::instance()->createService($serviceName);
    }

}