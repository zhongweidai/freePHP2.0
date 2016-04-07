<?php
namespace Component\Model;
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class FreeMongoModel extends FreeModel{ //extends AbstractFreeModel {

   protected $validate = array();//
	public function __construct($tableName='') {
		$this->dbTablepre = Free::loadConfig('system','tablepre');
		$this->tableName = strtolower($this->dbTablepre .$this->tableName);
		$this->db = $this->getComponent('mongo_db');
	}

	/**
	 * 计算记录数
	 * @param string/array $where 查询条件
	 */
	public function count($where = array()) {
		$r = $this->db->count($this->tableName,$where);
		return $r;
	}
	
	/**
	 * 获取数据表主键
	 * @return array
	 */
	public function getPrimary() {
		return $this->pkId;
	}
	
}
?>
