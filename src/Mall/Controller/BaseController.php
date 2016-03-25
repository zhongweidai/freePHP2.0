<?php
/**
 * Created by PhpStorm.
 * User: dai
 * Date: 14-9-7
 * Time: 上午11:21
 */

namespace Mall\Controller;
use Free\Libs\FreeController;

use Free\Libs\FreeException;
use Mall\Service\ServiceKernel;
class BaseController extends FreeController
{

    public function getService($serviceName)
    {
        return ServiceKernel::instance()->createService($serviceName);
    }

    protected function getWebConfigService()
    {
        return $this->getService('Mall:System.WebConfigService');
    }
    
    protected function getCacheService()
    {
        return $this->getService('Mall:System.CacheService');
    }

    public function createMessageResponse($message,$redirect_url='',$status=true,$args=array(),$time=1)
    {
    	if($this->getRequest()->getIsAjaxRequest())
    	{
    		$data = array(
    				'message'=>$message,
    				'status' => $status ? 1 : 0,
    				'redirect_url'=> $redirect_url,
    		);
    		$args && $data['args'] = $args;
    		return $this->createStringResponse($data);
    	}else{
    		$this->assign('message',$message);
    		$this->assign('redirect_url',$redirect_url);
    		$this->assign('message',$message);
    		$this->assign('status',$status);
    		$this->assign('args',$args);
    		$this->assign('time',$time);
    		return $this->template('message.html');
    	}
    }
} 