<?php
namespace Component\Model\Db;
/**
 * Mysql数据库操作策略实现类
 *
 * <i>Mysql数据库的使用:</i><br/>
 * 1、像使用普通类库一样使用该组件:
 * @author
 * @copyright
 * @license
 * @version $Id: MysqlDb.php 1 2012-07-13 11:00:00Z $ 
 * @package cache
 */

final class FreeMysqlDb extends AbstractFreeDb {
    protected $charset = 'utf8';
    protected $comparison = array('eq'=>'=','neq'=>'<>','gt'=>'>','egt'=>'>=','lt'=>'<','elt'=>'<=','notlike'=>'NOT LIKE','like'=>'LIKE');
	
	
	public function __construct($container) {
        $this->_container = $container;
        $configs = $this->_container->loadConfig('database');
        $this->deploy = isset($configs['DB_DEPLOY']) ? $configs['DB_DEPLOY'] : false;
		$this->config = $configs['DB_SERVER'];
        $this->debug = isset($configs['debug']) ? $configs['debug'] : false;
        isset($configs['DB_CHARSET']) && $this->charset = $configs['DB_CHARSET'];

        $this->options = isset($configs['DB_PARAMS']) ? $configs['DB_PARAMS'] : array();
        $this->dbName = isset($configs['DB_DEFAULT_NAME']) ? $configs['DB_DEFAULT_NAME'] : NULL;
	}
    /**
     * 解析pdo连接的dsn信息
     * @access public
     * @param array $config 连接信息
     * @return string
     */
    protected function parseDsn($config){
        $dsn  =   'mysql:dbname='.$config['database'].';host='.$config['hostname'];
        if(!empty($config['hostport'])) {
            $dsn  .= ';port='.$config['hostport'];
        }elseif(!empty($config['socket'])){
            $dsn  .= ';unix_socket='.$config['socket'];
        }

        if(!empty($this->charset)){
            if(version_compare(PHP_VERSION,'5.3.6','<')){
                // PHP5.3.6以下不支持charset设置
                $this->options[\PDO::MYSQL_ATTR_INIT_COMMAND]    =   'SET NAMES '.$this->charset ;
            }else{
                $dsn  .= ';charset='.$this->charset ;
            }
        }
        return $dsn;
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
        //如果是select查询，则查从库
        if ($this->deploy && strtolower(substr(ltrim($sql), 0, 6))=='select'){
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
        $link = $this->connect($config,$key);


		$this->queryCount++;
		return $this->lastQueryId;
	}


	
	/**
	 * 遍历查询结果集
	 * @param $type		返回结果集类型	
	 * 					MYSQL_ASSOC，MYSQL_NUM 和 MYSQL_BOTH
	 * @return array
	 */
	public function fetchNext($type=MYSQL_ASSOC) {
		$res = mysql_fetch_array($this->lastQueryId, $type);
		if(!$res) {
			$this->freeResult();
		}
		
		return $res;
	}
	
	/**
	 * 释放查询资源
	 * @return void
	 */
	public function freeResult() {
		if(is_resource($this->lastQueryId)) {
			mysql_free_result($this->lastQueryId);
			$this->lastQueryId = null;
		}
	}
	
	/**
	public function query($sql,$key='') {
		$this->execute($sql);
		if(!is_resource($this->lastQueryId)) {
			return $this->lastQueryId;
		}

		$datalist = array();
		while(($rs = $this->fetchNext()) != false) {
			if($key) {
				$datalist[$rs[$key]] = $rs;
			} else {
				$datalist[] = $rs;
			}
		}
		$this->freeResult();
		return $datalist;
	}
	**/

	


	
	/**
	 * 获取最后数据库操作影响到的条数
	 * @return int
	 */
	public function affectedRows() {
		return mysql_affected_rows($this->link);
	}
	
	/**
	 * 获取数据表主键
	 * @param $table 		数据表
	 * @return array
	 */
	public function getPrimary($table) {
		$this->execute("SHOW COLUMNS FROM $table");
		while($r = $this->fetchNext()) {
			if($r['Key'] == 'PRI') break;
		}
		return $r['Field'];
	}

	/**
	 * 获取表字段
	 * @param $table 		数据表
	 * @return array
	 */
	public function getFields($table) {
		$fields = array();
		$this->execute("SHOW FULL COLUMNS FROM $table");
		while($r = $this->fetchNext()) {
			$fields[$r['Field']] = $r;
		}
		return $fields;
	}

	/**
	 * 检查不存在的字段
	 * @param $table 表名
	 * @return array
	 */
	public function checkFields($table, $array) {
		$fields = $this->getFields($table);
		$nofields = array();
		foreach($array as $v) {
			if(!array_key_exists($v, $fields)) {
				$nofields[] = $v;
			}
		}
		return $nofields;
	}

	/**
	 * 检查表是否存在
	 * @param $table 表名
	 * @return boolean
	 */
	public function tableExists($table) {
		$tables = $this->listTables();
		return in_array($table, $tables) ? 1 : 0;
	}
	
	public function listTables() {
		$tables = array();
		$this->execute("SHOW TABLES");
		while($r = $this->fetchNext()) {
			$tables[] = $r['Tables_in_'.$this->config['database']];
		}
		return $tables;
	}

	/**
	 * 检查字段是否存在
	 * @param $table 表名
	 * @return boolean
	 */
	public function fieldExists($table, $field) {
		$fields = $this->getFields($table);
		return array_key_exists($field, $fields);
	}

	public function numRows($sql) {
		$this->lastQueryId = $this->execute($sql);
		return mysql_num_rows($this->lastQueryId);
	}

	public function numFields($sql) {
		$this->lastQueryId = $this->execute($sql);
		return mysql_num_fields($this->lastQueryId);
	}

	public function result($sql, $row) {
		$this->lastQueryId = $this->execute($sql);
		return @mysql_result($this->lastQueryId, $row);
	}

	public function halt($message = '', $sql = '') {
		$this->errormsg = "<b>MySQL Query : </b> $sql <br /><b> MySQL Error : </b>".$this->error()." <br /> <b>MySQL Errno : </b>".$this->errno()." <br /><b> Message : </b> $message <br />";
		$msg = $this->errormsg;
			echo '<div style="font-size:12px;text-align:left; border:1px solid #9cc9e0; padding:1px 4px;color:#000000;font-family:Arial, Helvetica,sans-serif;"><span>'.$msg.'</span></div>';
			exit;
	}

	/**
	 * 对字段两边加反引号，以保证数据库安全
	 * @param $value 数组值
	 */
	public function addSpecialChar(&$value) {
		if('*' == $value || false !== strpos($value, '(') || false !== strpos($value, '.') || false !== strpos ( $value, '`')) {
			//不处理包含* 或者 使用了sql方法。
		} else {
			$value = '`'.trim($value).'`';
		}
		return $value;
	}
	
	/**
	 * 对字段值两边加引号，以保证数据库安全
	 * @param $value 数组值
	 * @param $key 数组key
	 * @param $quotation 
	 */
	public function escapeString(&$value, $key='', $quotation = 1) {

        $value = mysql_real_escape_string($value);
		if ($quotation) {
			$q = '\'';
		} else {
			$q = '';
		}
		$value = $q.$value.$q;
		return $value;
	}
	public function parseOrder($order) {
		if(is_array($order)) {
			$array   =  array();
			foreach ($order as $key=>$val){
				if(is_numeric($key)) {
					$array[] =  $val;
				}else{
					$array[] =  '`' . $key . '` '.$val;
				}
			}
			$order   =  implode(',',$array);
		}
		return !empty($order)?  $order:'';
	}
	
	public function createFormSql($form_name,$fields)
	{
		$sql = "CREATE TABLE IF NOT EXISTS `t_{$form_name}` \n ( \n   `ID` int(11) NOT NULL AUTO_INCREMENT COMMENT '字段ID',\n";
		
		foreach($fields as $key => $field)
		{
			$sql .= "   `{$field['name']}` {$field['type']} ";
			isset($field['default_value']) && $sql .= " default '{$field['default_value']}' ";
			$sql .= " COMMENT '{$field['tips']}',\n";
		}
		$sql .= "   PRIMARY KEY (`ID`)\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
		
		return $sql;
	}
	
	public function createForm($form_name,$fields)
	{
		$sql = $this->createFormSql($form_name,$fields);
		return $this->execute($sql);
	}
}