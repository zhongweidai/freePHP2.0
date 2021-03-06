<?php
/**
 * Created by PhpStorm.
 * User: dai
 * Date: 14-9-8
 * Time: 下午8:08
 */

namespace Mall\Ext;


use Mall\Service\ServiceKernel;
use Utility\FreeCookie;
use Mall\Service\ServiceUtil;
class Page {
    // 起始行数
    public $firstRow	;
    // 列表每页显示行数
    public $listRows	;
    // 页数跳转时要带的参数
    public $parameter  ;
    // 分页总页面数
    protected $totalPages  ;
    // 总行数
    protected $totalRows  ;
    // 当前页数
    protected $nowPage    ;
    // 分页的栏的总页数
    protected $coolPages   ;
    // 分页栏每页显示的页数
    protected $rollPage   ;
    // 分页显示定制
    protected $config  =	array('header'=>'条记录','prev'=>'上一页','next'=>'下一页','first'=>'第一页','last'=>'最后一页','theme'=>' %totalRow% %header% %nowPage%/%totalPage% 页 %listRows% %upPage% %downPage% %first%  %prePage%  %linkPage%  %nextPage% %end%','listrows'=>'');


    const DEFAULT_NUM = 20; //每页默认条数

    //是否显示选择页下拉框

    protected $is_select = 1;

    private $container;

    public function __construct() {
        $this->container = ServiceKernel::instance()->getContainer();
    }

    public function setConfig($name,$value)   {
        if(isset($this->config[$name])) {
            $this->config[$name]    =   $value;
        }
    }

    public function setPageRow($listRows=0)
    {
        if(!empty($listRows))
        {
            $this->listRows = $listRows;
            $this->is_select = 0;
            return ;
        }
        
        $cookie_key = $this->container->getAppName() . '-' . 
           $this->container->loadApp()->getRouteM() . '-' . 
            $this->container->loadApp()->getRouteC(). '-' . 
            $this->container->loadApp()->getRouteA(). '-pageRow';
        if($this->container->loadApp()->getRequest()->getGet('pageRow') >= 1)
        {
            $listRows = intval($this->container->loadApp()->getRequest()->getGet('pageRow') );
            FreeCookie::set($cookie_key,$listRows);
            $this->listRows = $listRows;
        }else{
            $crow = FreeCookie::get($cookie_key);
            $this->listRows = $crow ? $crow : self::DEFAULT_NUM;
        }
    }

    public function getPageRow()
    {
        return $this->listRows;
    }
    public function show($totalRows,$nowPage,$listRows=0,$paget_style='default',$rollPage=5,$parameter='')
    {
        $this->totalRows = intval($totalRows);
        $this->parameter = $parameter;
        $this->rollPage = $rollPage;
        $this->setPageRow($listRows);
        $this->totalPages = ceil($this->totalRows/$this->listRows);     //总页数
        $this->coolPages  = ceil($this->totalPages/$this->rollPage);
        $this->nowPage  = $nowPage;
        if(!empty($this->totalPages) && $this->nowPage>$this->totalPages) {
            $this->nowPage = $this->totalPages;
        }
        $this->firstRow = $this->listRows*($this->nowPage-1);
        return array('total_pages'=>max(1,intval($this->totalPages)),'now_page'=> $this->nowPage,'url'=>$this->getNowUrl(),'total_num'=>$this->totalRows);
        //return $this->styleDefault();
    }

    public function getNowUrl()
    {
        $p = 'page';
        $pR = 'pageRow';
        $url  =  $_SERVER['REQUEST_URI'].(strpos($_SERVER['REQUEST_URI'],'?')?'':"?").$this->parameter;
        $parse = parse_url($url);
        if(isset($parse['query'])) {
            parse_str($parse['query'],$params);
            unset($params[$p]);
            unset($params[$pR]);
            $url   =  ServiceUtil::path('',$params);
        }
        return $url;
    }
    public function styleDefault() {
        if(0 == $this->totalRows) return '';
        $p = 'page';
        $pR = 'pageRow';
        $nowCoolPage      = ceil($this->nowPage/$this->rollPage);
        $url  =  $this->getNowUrl();
        $lrstr = '';
        for($i=5;$i<=30;$i+=5)
        {
            //if($this->listRows == $i)
            $lrstr .= '<option value="' . $i . '"' . (($this->listRows == $i)? 'selected' : '') . '>' . $i . '</option>';
        }

        $this->is_select && $this->setConfig('listrows','每页显示<select onchange="location.href=\'' . $url .'&pageRow=' . '\'+this.value">' . $lrstr . '</select>');
        //上下翻页字符串
        $upRow   = $this->nowPage-1;
        $downRow = $this->nowPage+1;
        if ($upRow>0){
            $upPage="<a class='pages_pre' href='".$url."&".$p."=$upRow'>« ".$this->config['prev']."</a>";
        }else{
            $upPage="";
        }

        if ($downRow <= $this->totalPages){
            $downPage="<a class='pages_next' href='".$url."&".$p."=$downRow'>".$this->config['next']." »</a>";
        }else{
            $downPage="";
        }
        // << < > >>
        if($nowCoolPage == 1){
            $theFirst = "";
            $prePage = "";
        }else{
            $preRow =  $this->nowPage-$this->rollPage;
            $prePage = "<a class='pages_pre' href='".$url."&".$p."=$preRow' >« 上".$this->rollPage."页</a>";
            $theFirst = "<a href='".$url."&".$p."=1' >".$this->config['first']."</a>";
        }
        if($nowCoolPage == $this->coolPages){
            $nextPage = "";
            $theEnd="";
        }else{
            $nextRow = $this->nowPage+$this->rollPage;
            $theEndRow = $this->totalPages;
            $nextPage = "<a class='pages_next'  href='".$url."&".$p."=$nextRow' >下".$this->rollPage."页»</a>";
            $theEnd = "<a href='".$url."&".$p."=$theEndRow' >".$this->config['last']."</a>";
        }
        // 1 2 3 4 5
        $linkPage = "";
        for($i=1;$i<=$this->rollPage;$i++){
            $page=($nowCoolPage-1)*$this->rollPage+$i;
            if($page!=$this->nowPage){
                if($page<=$this->totalPages){
                    $linkPage .= "&nbsp;<a href='".$url."&".$p."=$page'>".$page."</a>";
                }else{
                    break;
                }
            }else{
                if($this->totalPages != 1){
                    $linkPage .= "<strong>".$page."</strong>";
                }
            }
        }
        $pageStr	 =	 str_replace(
            array('%header%','%listRows%','%nowPage%','%totalRow%','%totalPage%','%upPage%','%downPage%','%first%','%prePage%','%linkPage%','%nextPage%','%end%'),
            array($this->config['header'],$this->config['listrows'],$this->nowPage,$this->totalRows,$this->totalPages,$upPage,$downPage,$theFirst,$prePage,$linkPage,$nextPage,$theEnd),$this->config['theme']);
        return $pageStr;
    }

}