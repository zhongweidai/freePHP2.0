<?php
/**
 * Created by PhpStorm.
 * User: dai
 * Date: 14-8-29
 * Time: 下午12:36
 */
namespace Web\Controller\Index;

use Utility\FreeDate;

use Free\Libs\FreeController;
use Free\Libs\FreeException;

class IndexController extends FreeController
{
    public function initAction()
    {
       // echo 'action';
        $model = $this->getModel('user');
        //var_dump($model);
        $this->assign('b',2);
        $this->getComponent('cache',array('arguments'=>$this->_container))->set('test',array('a'=>1),'index');
       // var_dump($this->getCache()->get('test','index'));

        var_dump(FreeDate::getTimeZone());
        return $this->template('Index/index_init.html',array('a'=>1));
    }
} 