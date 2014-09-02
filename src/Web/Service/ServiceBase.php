<?php
/**
 * Created by PhpStorm.
 * User: dai
 * Date: 14-9-1
 * Time: 下午5:09
 */

namespace Web\Service;


class ServiceBase
{

    public function getModle($modelName)
    {
        return \FreeKernel::container()->getModel($modelName);
    }
}