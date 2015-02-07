<?php

namespace Mall\Service\Store;

use Mall\Service\ServiceBase;

class TransportService extends ServiceBase 
{
	protected $model;
	protected $extendModel;
	public function __construct()
	{
		$this->model = $this->getModle('Mall:Transport');
		$this->model = $this->getModel('Mall:TransportExtend');
	}
}

?>