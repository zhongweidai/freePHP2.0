<?php

namespace Component\Model;
/**
 * 数据模型抽象基类
 * @author Dai Zhongwei <daizhongw@gmail.com> 2011-7-10
 * @copyright ©2006-2103 
 * @version $$Id$$
 * @package base
 */
Abstract class AbstractFreeModel{
    protected $_container;
	const MUSTvalidate         =   1;// 必须验证
	const EXISTS_VAILIDATE      =   0;// 表单存在字段则验证
	const VALUE_VAILIDATE       =   2;// 表单值不为空则验证
	const MODEL_INSERT      =   1;      //  插入模型数据
    const MODEL_UPDATE    =   2;      //  更新模型数据
    const MODEL_BOTH      =   3;      //  包含上面两种方式
	//array(field,rule,message,condition,function,type,where)
	protected $validate = array();//
    protected $validate_field = array();//
	protected $deal = array();//
	//数据库配置
	protected $dbConfig = '';
	//数据库连接
	protected $db = '';
	//调用数据库的配置项
	//数据表名
	protected $tableName = '';
	//表前缀
	protected  $dbTablepre = '';
	protected $pkId = '';
	public $error = '';
	
	//是否自动验证 完成 
	protected $isAuto = 1;
	
	//是否开启hash验证 
	protected $isHash = 1;
	    // 数据库表达式
    protected $comparison = array('eq'=>'=','neq'=>'<>','gt'=>'>','egt'=>'>=','lt'=>'<','elt'=>'<=','notlike'=>'NOT LIKE','like'=>'LIKE');
	
	abstract public function select($where = array(), $data = array() , $limit = array(), $order = array(), $group = '', $key='');
	
	public function getTableName()
	{
		return $this->tableName;
	}
	
	public function getDb()
	{
	    return $this->db;
	}
	/**
     +----------------------------------------------------------
     * 使用正则验证数据
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @param string $value  要验证的数据
     * @param string $rule 验证规则
     +----------------------------------------------------------
     * @return boolean
     +----------------------------------------------------------
     */
    public function regex($value,$rule) {
        $validate = array(
            'require'=> '/.+/',
            'email' => '/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/',
            'url' => '/^http:\/\/[A-Za-z0-9]+\.[A-Za-z0-9]+[\/=\?%\-&_~`@[\]\':+!]*([^<>\"\"])*$/',
            'currency' => '/^\d+(\.\d+)?$/',
            'number' => '/\d+$/',
            'zip' => '/^[1-9]\d{5}$/',
            'integer' => '/^[-\+]?\d+$/',
            'double' => '/^[-\+]?\d+(\.\d+)?$/',
            'english' => '/^[A-Za-z]+$/',
        );
        // 检查是否有内置的正则表达式
        if(isset($validate[strtolower($rule)]))
            $rule   =   $validate[strtolower($rule)];
        return preg_match($rule,$value)===1;
    }

   
    /**
     +----------------------------------------------------------
     * 表单验证
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @param array $data 创建数据
     * @param string $type 创建类型
     +----------------------------------------------------------
     * @return boolean
     +----------------------------------------------------------
     */
    public function validation($data,$type=1) 
    {
        // 属性验证
        if(!empty($this->validate) && ($this->isAuto == 1 || $this->validate_field)) {
            // 如果设置了数据自动验证
            // 则进行数据验证
            // 重置验证错误信息
            foreach($this->validate as $key=>$val) {
                if($this->validate_field && !in_array($val[0],$this->validate_field))
                {
                    continue;
                }
                // 验证因子定义格式
				if(0==strpos($val[2],'{%') && strpos($val[2],'}'))
				{			// 支持提示信息的多语言 使用 {%语言定义} 方式
					$val[2]  =  L(substr($val[2],2,-1));   
				} 
                $val[2] = sprintf($val[2],$data[$val[0]]);
				$val[3]  =  isset($val[3])?$val[3]:self::EXISTS_VAILIDATE;
				$val[4]  =  isset($val[4])?$val[4]:'regex';
                    // 判断验证条件
				if(!( empty($val[5]) || $val[5]== self::MODEL_BOTH || $val[5]== $type))
				{
					continue;
				}
				switch($val[3]) {
					case self::MUSTvalidate:   // 必须验证 不管表单是否有设置该字段
						if(false === $this->_validationField($data,$val,$type))
						{
							$this->error    =   $val[2];
								return false;
						}
						break;
					case self::VALUE_VAILIDATE:    // 值不为空的时候才验证
						if('' != trim($data[$val[0]]))
						{
							if(false === $this->_validationField($data,$val,$type))
							{
								$this->error    =   $val[2];
								return false;
							}
						}
						break;
					default:    // 默认表单存在该字段就验证
						if(isset($data[$val[0]]))
						{
							if(false === $this->_validationField($data,$val,$type))
							{
								$this->error    =   $val[2];
								return false;
							}
						}
				}
			}
			if($this->isHash == 1 && !Free::getApp()->checkCsrf())
			{
				$this->error = 'hash error.';
				return false;
			}
		}
        $this->validate_field = array();
		return true;
        //return true;
    }

    /**
     +----------------------------------------------------------
     * 根据验证因子验证字段
     +----------------------------------------------------------
     * @access private
     +----------------------------------------------------------
     * @param array $data 创建数据
     * @param string $val 验证规则
	* @param string $val 操作方式
     +----------------------------------------------------------
     * @return boolean
     +----------------------------------------------------------
     */
    private function _validationField($data,$val,$type)
	{
        switch($val[4]) 
		{
            case 'function':// 使用函数进行验证
            case 'callback':// 调用方法进行验证
                $args = isset($val[6])?$val[6]:array();
                array_unshift($args,$data[$val[0]]);
                if('function'==$val[4]) 
				{
                    return call_user_func_array(array('FreeValidator', $val[1]), $args);
                }else{
                    return call_user_func_array(array(&$this, $val[1]), $args);
                }
            case 'in': // 验证是否在某个数组范围之内
				$range   = is_array($val[1])?$val[1]:explode(',',$val[1]);
                return in_array($data[$val[0]] ,$range);
			case 'between': // 验证是否在某个范围
                list($min,$max)   =  explode(',',$rule);
                return $data[$val[0]]>=$min && $data[$val[0]]<=$max;
            case 'equal': // 验证是否等于某个值
                return $data[$val[0]] == $val[1];
			case 'nequal': // 验证是否等于某个值
                return $data[$val[0]] != $val[1];
			case 'length': // 验证长度
                $length  =  mb_strlen($data[$val[0]],'utf-8'); // 当前数据长度
                if(strpos($val[1],',')) { // 长度区间
                    list($min,$max)   =  explode(',',$val[1]);
                    return $length >= $min && $length <= $max;
                }else{// 指定长度
                    return $length == $val[1];
                }
			case 'expire':
                list($start,$end)   =  explode(',',$val[0]);
                if(!is_numeric($start)) $start   =  strtotime($start);
                if(!is_numeric($end)) $end   =  strtotime($end);
                return $_SERVER['REQUEST_TIME'] >= $start && $_SERVER['REQUEST_TIME'] <= $end;
            case 'ip_allow': // IP 操作许可验证
                return in_array($this->getRequest()->getClientIp(),explode(',',$val[1]));
            case 'ip_deny': // IP 操作禁止验证
                return !in_array($this->getRequest()->getClientIp(),explode(',',$val[1]));
            case 'unique': // 验证某个值是否唯一
				$where = array($val[0] => $data[$val[0]]);
                if(isset($val[6]))
                {  
                    $uns = strpos($val[6],',') ? explode(',',$val[6]) : array($val[6]);
                    foreach($uns as $key => $un)
                    {
                        $where[$un] = $data[$un];
                    }
                }
				if($type == self::MODEL_UPDATE)
				{
					!empty($this->where[$this->pkId]) && $where = array_merge($where,array($this->pkId=>array('neq',$this->where[$this->pkId])));
					is_array($val[6]) && $where = array_merge($where,$val[6]);
				}
				return $this->_unique($where);
				break;
            case 'regex':
			default:    // 默认使用正则验证 可以使用验证类中定义的验证名称
                // 检查附加规则
                return $this->regex($data[$val[0]],$val[1]);
        }
        return true;
    }
	/**
     +----------------------------------------------------------
     * 验证唯一性  业务模型可以根据自有业务重写此方法
     +----------------------------------------------------------
     * @access protected
     +----------------------------------------------------------
     * @param array $where 条件
     +----------------------------------------------------------
     * @return boolean
     +----------------------------------------------------------
     */
	protected function _unique($where)
	{
		return $this->select($where) ? false : true;
	}
	/**
     +----------------------------------------------------------
     * 设置字段有效性
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @param array $where 条件
     +----------------------------------------------------------
     * @return boolean
     +----------------------------------------------------------
     */
	public function setValidate($_v=array())
	{
		$this->validate = array_merge($this->validate,$_v);
	}
	/**
     +----------------------------------------------------------
     * 返回当前模型错误
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     +----------------------------------------------------------
     * @return boolean
     +----------------------------------------------------------
     */
	public function getError()
	{
		return $this->error;
	}
	/**
     +----------------------------------------------------------
     * 设置字段自动处理
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @param array $where 条件
     +----------------------------------------------------------
     * @return boolean
     +----------------------------------------------------------
     */
	public function setDeal($_v=array())
	{
		$this->deal = array_merge($this->deal,$_v);
	}
	/**
     +----------------------------------------------------------
     * 字段自动处理
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @param array $data 数据
	* @param int $type 操作方式
     +----------------------------------------------------------
     * @return boolean
     +----------------------------------------------------------
     */
	public function deal(&$data,$type=1)
	{
        if(isset($data['__hash__']))
        {
            unset($data['__hash__']);
        }
		if(!empty($this->deal) && $this->isAuto == 1 ) {
			// 如果设置了数据自动处理
			// 则进行数据二次处理
			foreach($this->deal as $key=>$val) {
				// 判断验证条件
				if(!( empty($val[3]) || $val[3]== self::MODEL_BOTH || $val[3]== $type))
				{
					continue;
				}
				switch($val[2]) 
				{
					case 'function':// 使用函数进行验证
					case 'callback':// 调用方法进行验证
						$args = isset($val[4])?$val[4]:array();
						if(!isset($data[$val[0]]))
						{//没有此字段的值不处理
							continue;
						}
						array_unshift($args,$data[$val[0]]);
						if('function'==$val[2]) 
						{
							$data[$val[0]] = call_user_func_array($val[1], $args);
						}else{
							$data[$val[0]] = call_user_func_array(array(&$this, $val[1]), $args);
						}
					default:
						break;
				}
			}
		}
	}
	/**
     +----------------------------------------------------------
     * 开启自动操作
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @return boolean
     +----------------------------------------------------------
     */
	public function openAuto()
	{
		$this->isAuto = 1;
		return $this;
	}
	/**
     +----------------------------------------------------------
     * 关闭自动操作
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @return boolean
     +----------------------------------------------------------
     */
	public function closeAuto()
	{
		$this->isAuto = 0;
		return $this;
	}
	/**
     +----------------------------------------------------------
     * 设置自动验证的字段
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @return boolean
     +----------------------------------------------------------
     */
     
    public function setValidateField($field)
    {
        is_array($field) && $this->validate_field = $field;
        return $this;
    }
	
		/**
     +----------------------------------------------------------
     * 开启自动验证hash
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @return boolean
     +----------------------------------------------------------
     */
	public function openHash()
	{
		$this->isHash = 1;
		return $this;
	}
	/**
     +----------------------------------------------------------
     * 关闭自动验证hash
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @return boolean
     +----------------------------------------------------------
     */
	public function closeHash()
	{
		$this->isHash = 0;
		return $this;
	}
}
?>