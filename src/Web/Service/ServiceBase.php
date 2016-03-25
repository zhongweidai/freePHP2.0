<?php
/**
 * Created by PhpStorm.
 * User: dai
 * Date: 14-9-1
 * Time: 下午5:09
 */

namespace Web\Service;


use Mall\Service\ServiceKernel;

class ServiceBase
{

    public function getModle($modelName)
    {
        return ServiceKernel::instance()->getModel($modelName);
    }
}