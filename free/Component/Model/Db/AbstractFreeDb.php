<?php
namespace Component\Model\Db;
use Free\Libs\FreeException;
use Component\Log\FreeDebug;

/**
 * 数据库基础类
 * 
 * 该基类继承了框架的基类FreeBase,用以提供实现组件的一些特性.同时该类作为数据库策略的基类定义了通用的对方访问接口,及子类需要实现的抽象接口.
 *
 * @author
 * @copyright
 * @license
 * @version $Id: AbstractFreeDb.php 1 2012-07-13 11:00:00Z $ 
 * @package cache
 */

abstract class AbstractFreeDb {

    protected $_container;
    protected $charset = 'utf8';
    protected $debug = false;
	/**
	 * 数据库配置信息
	 */
    protected $config = null;

    protected $options = array();

    protected $linkID = array();
	
	/**
	 * 数据库连接资源句柄
	 */
	public $link = null;
	
	/**
	 * 最近一次sql
	 */
	public $lastSql = null;
    /**
     * 是否为多机模式
     */
    protected $deploy = false;
	/**
	 *  统计数据库查询次数
	 */
	public $queryCount = 0;

    protected $numRows = 0;//影响行数
	
    protected $dbName = NULL;

    protected $binds = array();//参数绑定

    protected $lastInsID = NULL;//上一次插入ID

    protected $PDOStatement = NULL;

    protected $transTimes = 0;//事物次数
    protected $startTrans = 0;

    protected $bind = array();
    /**
     * 连接数据库方法
     * @access public
     */
    public function connect($config,$key=0)
    {
        if ( !isset($this->linkID[$key]) )
        {
            try{
                if(empty($config['dsn']))
                {
                    $config['dsn']  =   $this->parseDsn($config);
                }
                if(version_compare(PHP_VERSION,'5.3.6','<='))
                {
                    // 禁用模拟预处理语句
                    $this->options[\PDO::ATTR_EMULATE_PREPARES]  =   false;
                }
                $this->linkID[$key] = new \PDO( $config['dsn'], $config['username'], $config['password'],$this->options);
            }catch (\PDOException $e) {
                throw new FreeException($e->getMessage());
            }
        }
        $this->link = $this->linkID[$key];
        return $this->link ;
    }

    public function getCurrentLink()
    {
        if(!$this->link)
        {
            $configs = $this->config;
            $key =  'DB:';
            $config = $configs[$key];
            $config['database'] = $this->getDbName();
            $this->connect($config,$key);
        }
        return $this->link;
    }
    public function query($sql)
    {
        var_dump($sql);
        $dbName = $this->getDbName();
        $configs = $this->config;
        //如果是select查询，则查从库
        if ($this->deploy){
            $slave = true;
            $key = 'DB_R:' . $dbName;
        }else{
            $slave = false;
            $key = 'DB:' . $dbName;
        }
        if(array_key_exists($key,$configs))
        {
            $config = $configs[$key];
        }else{
            $key = $slave ? 'DB_R:' : 'DB:';
            $config = $configs[$key];
        }
        $config['database'] = $dbName;
        $link = $this->connect($config,$key);

        if ( !$link )
        {
            return false;
        }

        //释放前次的查询结果
        if ( !empty($this->PDOStatement) )
        {
            $this->free();
        }
        $this->queryCount++;
        // 记录开始执行时间
        //$this->debug(true);
        $this->lastSql = $sql;
        $this->PDOStatement =   $this->link->prepare($sql);
        if(false === $this->PDOStatement)
        {
            throw new FreeException($this->error());
        }
        foreach ($this->bind as $key => $val)
        {
            if(is_array($val))
            {
                $this->PDOStatement->bindValue($key, $val[0], $val[1]);
            }else{
                $this->PDOStatement->bindValue($key, $val);
            }
        }
        $this->bind =   array();
        $result =   $this->PDOStatement->execute();
        // $this->debug(false);
        if ( false === $result) {
            $this->error();
            return false;
        } else {
            return $this->getResult();
        }
    }

    /**
     * 数据库查询执行方法
     *
     * @param $sql 要执行的sql语句
     *
     * @return 查询资源句柄
     */
    protected function execute($sql)
    {
        $dbName = $this->getDbName();
        $configs = $this->config;

        $slave = false;
        $key = 'DB:' . $dbName;

        if(array_key_exists($key,$configs))
        {
            $config = $configs[$key];
        }else{
            $key = $slave ? 'DB_R:' : 'DB:';
            $config = $configs[$key];
        }
        $config['database'] = $dbName;
        $this->connect($config,$key);
        if ( !$this->link )
        {
            return false;
        }
        if($this->startTrans)
        {
            //数据rollback 支持
            if ($this->transTimes == 0)
            {
                $this->link->beginTransaction();
            }
            $this->transTimes++;
        }

        //释放前次的查询结果
        if ( !empty($this->PDOStatement) )
        {
            $this->free();
        }
        // 记录开始执行时间
        //$this->debug(true);
        $this->lastSql = $sql;
        $this->PDOStatement =   $this->link->prepare($sql);
        if(false === $this->PDOStatement)
        {
            throw new FreeException($this->error());
        }
        foreach ($this->bind as $key => $val)
        {
            if(is_array($val))
            {
                $this->PDOStatement->bindValue($key, $val[0], $val[1]);
            }else{
                $this->PDOStatement->bindValue($key, $val);
            }
        }
        $this->bind =   array();
        $result =   $this->PDOStatement->execute();

       // $this->debug(false);
        if ( false === $result)
        {
            $this->error();
            return false;
        } else {
            $this->numRows = $this->PDOStatement->rowCount();
            if(preg_match("/^\s*(INSERT\s+INTO|REPLACE\s+INTO)\s+/i", $sql))
            {
                $this->lastInsID = $this->link->lastInsertId();
            }
            return $this->numRows;
        }

    }

    /**
     * 启动事务
     * @access public
     * @return void
     */
    public function startTrans() {
        $this->startTrans = true;
    }
    /**
     * 用于非自动提交状态下面的查询提交
     * @access public
     * @return boolean
     */
    public function commit() {
        if ($this->transTimes > 0) {
            $result = $this->link->commit();
            $this->transTimes = 0;
            $this->startTrans = false;
            if(!$result){
                $this->error();
                return false;
            }
        }
        return true;
    }

    /**
     * 事务回滚
     * @access public
     * @return boolean
     */
    public function rollback() {
        if ($this->transTimes > 0) {
            $result = $this->link->rollback();
            $this->transTimes = 0;
            $this->startTrans = false;
            if(!$result){
                $this->error();
                return false;
            }
        }
        return true;
    }
    /**
     * 释放查询结果
     * @access public
     */
    public function free()
    {
        $this->PDOStatement = null;
    }


    abstract protected function parseDsn($config);

    /**
     * 执行sql查询
     * @param $data 		需要查询的字段值[例`name`,`gender`,`birthday`]
     * @param $table 		数据表
     * @param $where 		查询条件[例`name`='$name']
     * @param $limit 		返回结果范围[例：10或10,10 默认为空]
     * @param $order 		排序方式	[默认按数据库默认方式排序]
     * @param $group 		分组方式	[默认为空]
     * @param $key 			返回数组按键名排序
     * @return array		查询结果集数组
     */
    public function select($data, $table, $where = '', $limit = '', $order = '', $group = '', $key = '') {
        $dbName = $this->getDbName();
        $where = $this->parseWhere($where);
        $where && $where = ' WHERE ' . $where . ' ';
        $order = $this->parseOrder($order);
        $order && $order = ' ORDER BY ' . $order;
        $group = $group == '' ? '' : ' GROUP BY '.$group;
        if(empty($data))
        {
            $data = '*';
        }
        if (is_array($data))
        {
            array_walk($data, array($this, 'addSpecialChar'));
            $data = implode(',', $data);
        }
        $limit && $limit = ' limit ' . $limit;
        $sql = 'SELECT '.$data.' FROM `'.$dbName.'`.`'.$table.'`'.$where.$group.$order.$limit;
        if($key)
        {
            $data= $this->query($sql);
            if(!$data)
            {
                return $data;
            }
            $return = array();
            foreach($data as $d)
            {
                $return[$d[$key]] = $d;
            }
            return $return;
        }else{
            return $this->query($sql);
        }

    }

    /**
     * 获取单条记录查询
     * @param $data 		需要查询的字段值[例`name`,`gender`,`birthday`]
     * @param $table 		数据表
     * @param $where 		查询条件
     * @param $order 		排序方式	[默认按数据库默认方式排序]
     * @param $group 		分组方式	[默认为空]
     * @return array/null	数据查询结果集,如果不存在，则返回空
     */
    public function getOne($data, $table, $where = '', $order = '', $group = '')
    {
        $dbName = $this->getDbName();
        $where = $this->parseWhere($where);
        $where && $where = ' WHERE ' . $where . ' ';
        $order = $this->parseOrder($order);
        $order && $order = ' ORDER BY ' . $order;
        $group = $group == '' ? '' : ' GROUP BY '.$group;
        $limit = ' LIMIT 1';
        if(empty($data))
        {
            $data = '*';
        }
        if (is_array($data))
        {
            array_walk($data, array($this, 'addSpecialChar'));
            $data = implode(',', $data);
        }

        $sql = 'SELECT '.$data.' FROM `'.$dbName.'`.`'.$table.'`'.$where.$group.$order.$limit;
        $re = $this->query($sql);
        return isset($re[0]) ? $re[0] : array();
    }

    /**
     * 释放查询资源
     * @return void
     */
    public function freeResult()
    {
    }

    /**
     * 获取最后数据库操作影响到的条数
     * @return int
     */
    public function affectedRows() {
        return $this->numRows ;
    }



    /**
     * 执行添加记录操作
     * @param $data 		要增加的数据，参数为数组。数组key为字段值，数组值为数据取值
     * @param $table 		数据表
     * @return boolean
     */
    public function insert($data, $table, $return_insertId = false, $replace = false) {
        if(!is_array( $data ) || $table == '' || count($data) == 0) {
            return false;
        }
        $dbName = $this->getDbName();
        $fielddata = array_keys($data);
        $valuedata = array_values($data);
        array_walk($fielddata, array($this, 'addSpecialChar'));
        array_walk($valuedata, array($this, 'escapeString'));

        $field = implode (',', $fielddata);
        $value = implode (',', $valuedata);

        $cmd = $replace ? 'REPLACE INTO' : 'INSERT INTO';
        $sql = $cmd.' `'.$dbName.'`.`'.$table.'`('.$field.') VALUES ('.$value.')';
        $return = $this->execute($sql);
        $this->toLog($sql);
        return $return_insertId ? $this->insertId() : $return;
    }

    /**
     * 获取最后一次添加记录的主键号
     * @return int
     */
    public function insertId()
    {
        return $this->lastInsID;
    }


    /**
     * 执行更新记录操作
     * @param $data 		要更新的数据内容，参数可以为数组也可以为字符串，建议数组。
     * 						为数组时数组key为字段值，数组值为数据取值
     * 						为字符串时[例：`name`='cm',`hits`=`hits`+1]。
     *						为数组时[例: array('name'=>'phpcms','password'=>'123456')]
     *						数组可使用array('name'=>'+=1', 'base'=>'-=1');程序会自动解析为`name` = `name` + 1, `base` = `base` - 1
     * @param $table 		数据表
     * @param $where 		更新数据时的条件
     * @return boolean
     */
    public function update($data, $table, $where = '')
    {
        $where = $this->parseWhere($where);
        if(empty($table) or empty($where) or empty($data)) {
            return false;
        }
        $dbName = $this->getDbName();
        $where = ' WHERE '.$where;
        $field = $this->parseSet($data);
        $sql = 'UPDATE `'.$dbName.'`.`'.$table.'` SET '.$field.$where;
        $this->toLog($sql);
        return $this->execute($sql);
    }


    /**
     * 执行删除记录操作
     * @param $table 		数据表
     * @param $where 		删除数据条件,不充许为空。
     * 						如果要清空表，使用empty方法
     * @return boolean
     */
    public function delete($table, $where) {
        if ($table == '' || $where == '') {
            return false;
        }
        $dbName = $this->getDbName();
        $where = $this->parseWhere($where);
        $where && $where = ' WHERE ' . $where . ' ';
        $sql = 'DELETE FROM `'.$dbName.'`.`'.$table.'`'.$where;
        $this->toLog($sql);
        return $this->execute($sql);
    }


    /**
     * 关闭数据库
     * @access public
     */
    public function close() {
        $this->link = null;
    }

    /**
     * 数据库错误信息
     * 并显示当前的SQL语句
     * @access public
     * @return string
     */
    public function error() {
        $error = array();
        if($this->PDOStatement) {
            $error = $this->PDOStatement->errorInfo();
            $this->error = $error[1].':'.$error[2];
        }else{
            $this->error = '';
        }
        if('' != $this->lastSql){
            $this->error .= "\n [ SQL语句 ] : ".$this->lastSql;
        }
var_dump($this->error);
        // 记录错误日志
        FreeDebug::trace(debug_backtrace());
        if($this->debug) {// 开启数据库调试模式
            throw new FreeException($this->error);
        }else{
            return $this->error;
        }
    }



    /**
	 * 对字段两边加反引号，以保证数据库安全
	 * @param $value 数组值
	 */
	abstract public function addSpecialChar(&$value);
	
	/**
	 * 对字段值两边加引号，以保证数据库安全
	 *
	 * @param $value 数组值
	 * @param $key 数组key
	 * @param $quotation 
	 */
	abstract public function escapeString(&$value, $key='', $quotation = 1);
	
	/**
	 * 数据库连接错误展现
	 */
	public function halt($message = '', $sql = '') {
		$this->errormsg = "<b>SQL Query : </b> $sql <br /><b> SQL Error : </b>".$this->error()." <br /> <b>MySQL Errno : </b>".$this->errno()." <br /><b> Message : </b> $message <br />";
		$msg = $this->errormsg;
		$this->showErrorMessage('003',$msg);
	}
	/**
     +----------------------------------------------------------
     * 字段名分析
     +----------------------------------------------------------
     * @access protected
     +----------------------------------------------------------
     * @param string $key
     +----------------------------------------------------------
     * @return string
     +----------------------------------------------------------
     */
    protected function parseKey(&$key) {
        return '`'.$key.'`';
    }
	/**
     +----------------------------------------------------------
     * value分析
     +----------------------------------------------------------
     * @access protected
     +----------------------------------------------------------
     * @param mixed $value
     +----------------------------------------------------------
     * @return string
     +----------------------------------------------------------
     */
    public function parseValue($value) {
        if(is_string($value)) {
           $value = $this->escapeString($value);
        }elseif(isset($value[0]) && is_string($value[0]) && strtolower($value[0]) == 'exp'){
            $value   =  $this->escapeString($value[1]);
        }elseif(is_array($value)) {
            $value   =  array_map(array($this, 'parseValue'),$value);
        }elseif(is_null($value)){
            $value   =  'null';
        }
        return $value;
    }
	/**
     +----------------------------------------------------------
     * update set分析
     +----------------------------------------------------------
     * @access protected
     +----------------------------------------------------------
     * @param mixed $value
     +----------------------------------------------------------
     * @return string
     +----------------------------------------------------------
     */
	public function parseSet($data) 
	{
		$fields = '';
		foreach($data as $k=>$v) {
			switch (substr($v, 0, 2)) {
				case '+=':
					$v = substr($v,2);
					if (is_numeric($v)) {
						$fields[] = $this->addSpecialChar($k).'='.$this->addSpecialChar($k).'+'.$this->escapeString($v, '', false);
					} else {
						continue;
					}
					break;
				case '-=':
					$v = substr($v,2);
					if (is_numeric($v)) {
						$fields[] = $this->addSpecialChar($k).'='.$this->addSpecialChar($k).'-'.$this->escapeString($v, '', false);
					} else {
						continue;
					}
					break;
				default:
					$fields[] = $this->addSpecialChar($k).'='.$this->escapeString($v);
			}
		}
		$field = implode(',', $fields);
		return $field;
	}
	public function parseOrder($order) {
        if(is_array($order)) {
            $array   =  array();
            foreach ($order as $key=>$val){
                if(is_numeric($key)) {
                    $array[] =  $val;
                }else{
                    $array[] =  $key .' '.$val;
                }
            }
            $order   =  implode(',',$array);
        }
        return !empty($order)?  $order:'';
    }
	/**
     +----------------------------------------------------------
     * where分析
     +----------------------------------------------------------
     * @access protected
     +----------------------------------------------------------
     * @param mixed $where
     +----------------------------------------------------------
     * @return string
     +----------------------------------------------------------
     */
    public function parseWhere($where) {
        $whereStr = '';
        if(is_string($where)) {
            // 直接使用字符串条件
            $whereStr = $where;
        }else{ // 使用数组或者对象条件表达式
            if(isset($where['_logic'])) {
                // 定义逻辑运算规则 例如 OR XOR AND NOT
                $operate    =   ' '.strtoupper($where['_logic']).' ';
                unset($where['_logic']);
            }else{
                // 默认进行 AND 运算
                $operate    =   ' AND ';
            }
            foreach ($where as $key=>$val){
                $whereStr .= '( ';
                if(0===strpos($key,'_')) {
                    // 解析特殊条件表达式
                    $whereStr   .= $this->parseAdsWhere($key,$val);
                }else{
                    // 查询字段的安全过滤
                    if(!preg_match('/^[A-Z_\|\&\-.a-z0-9\(\)\,]+$/',trim($key))){
                         throw new FreeException('_EXPRESS_ERROR_:'.$key);
                    }
                    // 多条件支持
                    $multi = is_array($val) &&  isset($val['_multi']);
                    $key = trim($key);
                    if(strpos($key,'|')) { // 支持 name|title|nickname 方式定义查询字段
                        $array   =  explode('|',$key);
                        $str   = array();
                        foreach ($array as $m=>$k){
                            $v =  $multi?$val[$m]:$val;
                            $str[]   = '('.$this->parseWhereItem($this->parseKey($k),$v).')';
                        }
                        $whereStr .= implode(' OR ',$str);
                    }elseif(strpos($key,'&')){
                        $array   =  explode('&',$key);
                        $str   = array();
                        foreach ($array as $m=>$k){
                            $v =  $multi?$val[$m]:$val;
                            $str[]   = '('.$this->parseWhereItem($this->parseKey($k),$v).')';
                        }
                        $whereStr .= implode(' AND ',$str);
                    }else{
                        $whereStr   .= $this->parseWhereItem($this->parseKey($key),$val);
                    }
                }
                $whereStr .= ' )'.$operate;
            }
            $whereStr = substr($whereStr,0,-strlen($operate));
        }
        return $whereStr;
    }

    // where子单元分析
    public function parseWhereItem($key,$val) {
        $whereStr = '';
        if(is_array($val)) {
            if(is_string($val[0])) {
                if(preg_match('/^(EQ|NEQ|GT|EGT|LT|ELT|NOTLIKE|LIKE)$/i',$val[0])) { // 比较运算
                    $whereStr .= $key.' '.$this->comparison[strtolower($val[0])].' '.$this->parseValue($val[1]);
                }elseif('exp'==strtolower($val[0])){ // 使用表达式
                    $whereStr .= ' ('.$key.' '.$val[1].') ';
                }elseif(preg_match('/IN/i',$val[0])){ // IN 运算
                    if(isset($val[2]) && 'exp'==$val[2]) {
                        $whereStr .= $key.' '.strtoupper($val[0]).' '.$val[1];
                    }else{
                        if(is_string($val[1])) {
                             $val[1] =  explode(',',$val[1]);
                        }
                        $zone   =   implode(',',$this->parseValue($val[1]));
                        $whereStr .= $key.' '.strtoupper($val[0]).' ('.$zone.')';
                    }
                }elseif(preg_match('/BETWEEN/i',$val[0])){ // BETWEEN运算
                    $data = is_string($val[1])? explode(',',$val[1]):$val[1];
                    $whereStr .=  ' ('.$key.' '.strtoupper($val[0]).' '.$this->parseValue($data[0]).' AND '.$this->parseValue($data[1]).' )';
                }else{
                    throw new FreeException('_EXPRESS_ERROR_:'.$val[0]);
                }
            }else {
                $count = count($val);
                if(in_array(strtoupper(trim($val[$count-1])),array('AND','OR','XOR'))) {
                    $rule = strtoupper(trim($val[$count-1]));
                    $count   =  $count -1;
                }else{
                    $rule = 'AND';
                }
                for($i=0;$i<$count;$i++) {
                    $data = is_array($val[$i])?$val[$i][1]:$val[$i];
                    if('exp'==strtolower($val[$i][0])) {
                        $whereStr .= '('.$key.' '.$data.') '.$rule.' ';
                    }else{
                        $op = is_array($val[$i])?$this->comparison[strtolower($val[$i][0])]:'=';
                        $whereStr .= '('.$key.' '.$op.' '.$this->parseValue($data).') '.$rule.' ';
                    }
                }
                $whereStr = substr($whereStr,0,-4);
            }
        }else {
                $whereStr .= $key.' = '.$this->parseValue($val);
        }
        return $whereStr;
    }

    /**
     +----------------------------------------------------------
     * 特殊条件分析
     +----------------------------------------------------------
     * @access protected
     +----------------------------------------------------------
     * @param string $key
     * @param mixed $val
     +----------------------------------------------------------
     * @return string
     +----------------------------------------------------------
     */
    public function parseAdsWhere($key,$val) {
        $whereStr   = '';
        switch($key) {
            case '_string':
                // 字符串模式查询条件
                $whereStr = $val;
                break;
            case '_complex':
                // 复合查询条件
                $whereStr   = substr($this->parseWhere($val),6);
                break;
            case '_query':
                // 字符串模式查询条件
                parse_str($val,$where);
                if(isset($where['_logic'])) {
                    $op   =  ' '.strtoupper($where['_logic']).' ';
                    unset($where['_logic']);
                }else{
                    $op   =  ' AND ';
                }
                $array   =  array();
                foreach ($where as $field=>$data)
                    $array[] = $this->parseKey($field).' = '.$this->parseValue($data);
                $whereStr   = implode($op,$array);
                break;
        }
        return $whereStr;
    }
    
     /**
     +----------------------------------------------------------
     * sql执行记录
     +----------------------------------------------------------
     * @access protected
     +----------------------------------------------------------
     * @param string $key
     * @param mixed $val
     +----------------------------------------------------------
     * @return string
     +----------------------------------------------------------
     */
	 
     public function toLog($sql)
     {
        if($sql)
        {
            return $this->getComponent('log_container')->put($sql,'db_sql'); 
        } 
     }

    /**
     * 获得所有的查询数据
     * @access private
     * @return array
     */
    private function getResult() {
        //返回数据集
        $result =   $this->PDOStatement->fetchAll(\PDO::FETCH_ASSOC);
        $this->numRows = count( $result );
        return $result;
    }
    /**
     * 遍历查询结果集
     * @param $type		返回结果集类型
     * 					MYSQL_ASSOC，MYSQL_NUM 和 MYSQL_BOTH
     * @return array
     */
    public function fetchNext() {
        $result = $this->PDOStatement->fetch(\PDO::FETCH_ASSOC);
        if(!$result) {
            $this->freeResult();
        }

        return $result;
    }

    public function setDbName($dbName)
    {
        $dbName &&  $this->dbName = $dbName;
    }

    public function getDbName()
    {
        return $this->dbName;
    }
}