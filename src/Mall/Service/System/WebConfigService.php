<?php
/**
 * Created by PhpStorm.
 * User: dai
 * Date: 14-9-8
 * Time: 下午7:38
 */

namespace Mall\Service\System;


use Mall\Service\ServiceBase;

class WebConfigService extends ServiceBase{

    protected $webModel;

    public function __construct()
    {
        $this->webModel = $this->getModle('Mall:Web');
    }

    /**
     * 模块html信息
     *
     */
    public function getWebHtml($web_page = 'index',$update_all = 0){
        $web_array = array();
        $web_list = $this->getWebList(array('web_show'=>1,'web_page'=> array('like',$web_page.'%')));
        if(!empty($web_list) && is_array($web_list)) {
            foreach($web_list as $k => $v){
                $key = $v['web_page'];
                isset($web_array[$key]) || $web_array[$key] = '';
                if ($update_all == 1 || empty($v['web_html'])) {//强制更新或内容为空时查询数据库
                    $web_array[$key] .= $this->updateWebHtml($v['web_id'],$v['style_name']);
                } else {
                    $web_array[$key] .= $v['web_html'];
                }
            }
        }
        return $web_array;
    }

    /**
     * 更新模块html信息
     *
     */
    public function updateWebHtml($web_id = 1,$style_name = 'orange'){
        $web_html = '';
        $code_list = $this->getCodeList(array('web_id'=>"$web_id"));
        if(!empty($code_list) && is_array($code_list)) {
            Language::read('web_config,home_index_index');
            $lang = Language::getLangContent();
            $output = array();
            $output['style_name'] = $style_name;
            foreach ($code_list as $key => $val) {
                $var_name = $val['var_name'];
                $code_info = $val['code_info'];
                $code_type = $val['code_type'];
                $val['code_info'] = $this->get_array($code_info,$code_type);
                $output['code_'.$var_name] = $val;
            }
            switch ($web_id) {
                case 101:
                    $style_file = BASE_DATA_PATH.DS.'resource'.DS.'web_config'.DS.'focus.php';
                    break;
                case 121:
                    $style_file = BASE_DATA_PATH.DS.'resource'.DS.'web_config'.DS.'sale_goods.php';
                    break;
                default:
                    $style_file = BASE_DATA_PATH.DS.'resource'.DS.'web_config'.DS.'default.php';
                    break;
            }
            if (file_exists($style_file)) {
                ob_start();
                include $style_file;
                $web_html = ob_get_contents();
                ob_end_clean();
            }
            $web_array = array();
            $web_array['web_html'] = addslashes($web_html);
            $web_array['update_time'] = time();
            $this->updateWeb(array('web_id'=>$web_id),$web_array);
        }
        return $web_html;
    }
    /**
     * 更新模块信息
     *
     * @param
     * @return bool 布尔类型的返回结果
     */
    public function updateWeb($condition,$data){
        $web_id = $condition['web_id'];
        if (intval($web_id) < 1){
            return false;
        }
        if (is_array($data)){
            $result = $this->webModel->update($data,$condition);
            return $result;
        } else {
            return false;
        }
    }
    /**
     * 读取记录列表
     *
     * @param
     * @return array 数组格式的返回结果
     */
    public function getWebList($condition = array('web_page' => 'index'),$page = ''){
        $result =  $this->webModel->listInfo($condition,array(),'web_sort',$page);
        return $result;
    }
} 