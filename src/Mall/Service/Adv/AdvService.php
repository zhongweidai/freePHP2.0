<?php
namespace Mall\Service\Adv;
use Mall\Service\ServiceBase;

class AdvService extends ServiceBase
{

    protected $advModel;
    
    protected $attributeValueModel;
    
    public function __construct(){
        $this->advModel = $this->getModle('Mall:Adv');
        $this->advPositionModel = $this->getModle('Mall:AdvPosition');
    }
    /**
     * 构造查询条件
     *
     * @param array $condition
     * @return string
     */
    private function getCondition($condition = array()){
        $return	= '';
        $time   = time();
        if($condition['adv_type'] != ''){
            $return	.= " and adv_type='".$condition['adv_type']."'";
        }
        if($condition['adv_code'] != ''){
            $return	.= " and adv_code='".$condition['adv_code']."'";
        }
        if($condition['no_adv_type'] != ''){
            $return	.= " and adv_type!='".$condition['no_adv_type']."'";
        }
        if ($condition['adv_state'] != '') {
            $return .= " and adv_state='".$condition['adv_state']."'";
        }
        if ($condition['ap_id'] != '') {
            $return .= " and ap_id='".$condition['ap_id']."'";
        }
        if ($condition['adv_id'] != '') {
            $return .= " and adv_id='".$condition['adv_id']."'";
        }
        if ($condition['adv_end_date'] == 'over'){
            $return .= " and adv_end_date<'".$time."'";
        }
        if ($condition['adv_end_date'] == 'notover'){
            $return .= " and adv_end_date>'".$time."'";
        }
        if ($condition['ap_name'] != ''){
            $return .= " and ap_name like '%".$condition['ap_name']."%'";
        }
        if ($condition['adv_title'] != ''){
            $return .= " and adv_title like '%".$condition['adv_title']."%'";
        }
        if ($condition['add_time_from'] != ''){
            $return .= " and adv_start_date > '{$condition['add_time_from']}'";
        }
        if ($condition['add_time_to'] != ''){
            $return .= " and adv_end_date < '{$condition['add_time_to']}'";
        }
        if ($condition['member_name'] != ''){
            $return .= " and member_name ='".$condition['member_name']."'";
        }
        if($condition['click_year'] != ''){
            $return .= " and click_year ='".$condition['click_year']."'";
        }
        if($condition['is_allow'] != ''){
            $return .= " and is_allow = '".$condition['is_allow']."' ";
        }
        if($condition['buy_style'] != ''){
            $return .= " and buy_style = '".$condition['buy_style']."' ";
        }
        if($condition['adv_start_date'] == 'nowshow'){
            $return .= " and adv_start_date <'".$time."'";
        }
        if($condition['member_id'] != ''){
            $return .= " and member_id = '".$condition['member_id']."'";
        }
        if($condition['is_use'] != ''){
            $return .= " and is_use = '".$condition['is_use']."' ";
        }
        if ($condition['adv_buy_id'] != '') {
            $return .= " and ap_id not in (".$condition['adv_buy_id'].")";
        }
        return $return;
    }

    public function delapcache($id){
        if (!is_numeric($id)) return ;
        $filename = BASE_DATA_PATH.DS.'cache/adv/'.$id.'.php';
        if(file_exists($filename)) @unlink($filename);
        return true;
    }

    /**
     * 生成广告位缓存
     *
     * @param int $ap_id
     */
    public function getAdsByPosition($ap_id = null){
        if (empty($ap_id)) 
        {
            return '';
        }
        $ap_info = $this->advPositionModel->select(array('ap_id'=>$ap_id));
        $ap_info['adv_list'] = $this->advModel->select(array('ap_id'=>$ap_id),array(),'','slide_sort, adv_id desc');
        return $ap_info;
    }

   
    
}
