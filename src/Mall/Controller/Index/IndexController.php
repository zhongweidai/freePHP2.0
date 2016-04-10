<?php
/**
 * Created by PhpStorm.
 * User: dai
 * Date: 14-8-29
 * Time: 下午12:36
 */
namespace Mall\Controller\Index;

use Mall\Controller\BaseController;


class IndexController extends BaseController
{
    public function initAction()
    {

        $model_groupbuy = $this->getGroupbuySevice();

        $group_list = $model_groupbuy->getGroupbuyCommendedList();
        $this->assign('group_list', $group_list);

        //限时折扣
        $model_xianshi_goods = $this->getXianshiGoodsSevice();
        $xianshi_item = $model_xianshi_goods->getXianshiGoodsCommendList(4);
        $this->assign('xianshi_item', $xianshi_item);

        //板块信息
        $model_web_config = $this->getWebConfigService();
        $web_html = $model_web_config->getWebHtml('index');
        $this->assign('web_html',$web_html);

        return $this->template('Index/index_init.html',array('a'=>1));
    }
    
    public function categoryTreeAction($arg=NULL)
    {
        $show_goods_class = $this->getCacheService()->call('Mall:Goods.GoodsClassService::getAllCategory');
        $this->assign('show_goods_class',$show_goods_class);
        //var_dump($category_service);
        return $this->template('Index/left_tree.html',array('a'=>1));
    }

    protected function getXianshiGoodsSevice()
    {
        return $this->getService('Mall:P.XianshiGoodsService');
    }
    protected function getGroupbuySevice()
    {
        return $this->getService('Mall:Groupbuy.GroupbuyService');
    }
    


} 