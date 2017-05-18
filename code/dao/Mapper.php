<?php
namespace dao;

use utils\ObjectUtils;
use utils\ExcelUtils;

class Mapper{  
      
    public $conn = null;

    /** 
     * 插入 
     * 不想对某一列插入，把对应的属性设置成null就ok 
     * 
     */  
    function save($obj){  
        $arr  =  ObjectUtils::objToArray($obj);  
        $set = '';  
        if ($arr) {  
            foreach ($arr as $field=> $v) {  
            	if($v !== null && $v !== ''){
	                if ($set) $set .=',';  
	                $set .= $field . "='" . $v ."'";  
            	}
            }  
        }  
        if ($set) {  
            $this->conn->exec( 'insert into ' . $obj->tableName . ' SET ' . $set);  
//             var_dump('insert into ' . $obj->tableName . ' SET ' . $set);
            return $this->conn->getLastId();  
        }  
          
          
    }  
    
    /**
     * 删除
     */
    function delete($obj){
    	$arr  =  ObjectUtils::objToArray($obj);
    	$where = " where 1=1 ";
    	if ($arr) {
    		foreach ($arr as $field => $value) {
    			if($value){
    				$where .= " and $field = $value ";
    			}
    		}
    	}
    	if($where){
    		return $this->conn->exec( 'delete from ' . $obj->tableName . $where );
    	}
    }
      
    /** 
     * 更新 
     * 不想对某一列更新，把对应的属性设置成null就ok 
     * 
     */  
    function update($obj){  
        $arr  =  ObjectUtils::objToArray($obj);  
        $set = '';  
        if ($arr) {  
            foreach ($arr as $field=> $v) {  
                if ($set) $set .=',';  
                $set .= $field . "='" . $v ."'";  
            }
        }  
        $primayGet = 'get'.ucwords($obj->primaryKey);  
        if ($set) {  
            $this->conn->exec( 'update ' . $obj->tableName . ' SET ' . $set . ' where ' . $obj->primaryKey ."='" . $obj->$primayGet() . "'" );  
            // var_dump('update ' . $obj->tableName . ' SET ' . $set . ' where ' . $obj->primaryKey ."='" . $obj->$primayGet() . "'" );
            return true;
        }  
    }  
  	
    /**
     *分页查询 
     */
    function find($obj,$where,$table,$fieldArr,$orderByColumn,$orderByType){
    	$result = array();
    	$page = $obj->page;
    	$rows = $obj->rows;
    	if(empty($table)){
    		$table = $obj->tableView;
    	}
    	if(!empty($page) && !empty($rows)){
	    	$start = ($page - 1) * $rows;
	    	$limit = " limit $start, $rows ";
    	}
    	$arr  =  ObjectUtils::objToArray($obj,$fieldArr);
    	if(empty($where)){
	    	$where = " where 1=1 ";
    	}
    	if ($arr) {
    		foreach ($arr as $field => $value) {
    			if($value){
    				$where .= " and $field like :$field ";
    			}
    		}
    	}
    	if(empty($orderByColumn)){
    		$orderByColumn = $obj->primaryKey;
    	}
    	if(empty($orderByType)){
    		$orderByType = 'asc';
    	}
    	$orderBy = " order by $orderByColumn $orderByType ";
    	
    	if(empty($fieldArr)){
	    	$filedStr = ObjectUtils::objTablefields($obj);
    	}else{
    		$filedStr = ObjectUtils::objTablefields($obj, $fieldArr);
    	}
    	$sql = "select $filedStr from $table ".$where.$orderBy.$limit;
    	//var_dump($sql);die;
    	$countSql = "select count(1) from $table ".$where;
    	$total = $this->conn->getTotal($countSql,$arr);
    	$rs = $this->conn->executeAsoc($sql,$arr);
    	$index = 0;
    	foreach ($rs as $rows){
    		$rs[$index] = $obj->formatterObj($rows);
    		$index++;
    	}
    	$result['total'] = $total;
    	$result['rows'] = $rs;
    	return $result;
    }
    
    /**
     * 查询所有
     */
    function  findAll($obj , $orderBy){
    	$arr  =  ObjectUtils::objToArray($obj);
    	$where = " where 1=1 ";
    	if ($arr) {
    		foreach ($arr as $field => $value) {
    			if($value){
    				$where .= " and $field = :$field ";
    			}
    		}
    	}
    	 
    	$filedStr = ObjectUtils::objTablefields($obj);
    	$sql = "select $filedStr from ".$obj->tableView.$where;
    	if($orderBy != "" && $orderBy != null){
    		$sql = "select $filedStr from ".$obj->tableView.$where.$orderBy;
    	}
    	//var_dump();
    	//echo $sql;die;
    	$rs = $this->conn->executeAsoc($sql, $arr);
    	return $rs;
    }
    
    /**
     * 重复查询
     */
    function  findOnly($obj){
    	$arr  =  ObjectUtils::objToArray($obj);
    	$where = " where 1=1 ";
    	if ($arr) {
    		foreach ($arr as $field => $value) {
    			if($value){
    				$where .= " and $field = :$field ";
    			}
    		}
    	}
    
    	$filedStr = ObjectUtils::objTablefields($obj);
    	$sql = "select $filedStr from ".$obj->tableName.$where;
    
    	$rs = $this->conn->executeAsoc($sql, $arr);
    	return $rs;
    }
    
    /**
     * Excel导出时的查询
     */
    function findByExcel($obj,$where,$table,$fieldArr,$orderByColumn,$orderByType){
    	$arr = ExcelUtils::objTolArrayOnExcel($obj,$fieldArr);
    	if(empty($table)){
    		$table = $obj->tableName;
    	}
    	if(empty($where)){
	    	$where = " where 1=1 ";
    	}
    	if ($arr) {
    		foreach ($arr as $field => $value) {
    			if($value){
    				$where .= " and $field like :$field ";
    			}
    		}
    	}
    	
    	if(empty($fieldArr)){
    		$filedStr = ExcelUtils::objTableFieldsOnExcel($obj);
    	}else{
    		$filedStr = ExcelUtils::objTableFieldsOnExcel($obj, $table, $fieldArr);
    	}
    	
    	if(empty($orderByColumn)){
    		$orderByColumn = $obj->primaryKey;
    	}
    	if(empty($orderByType)){
    		$orderByType = 'desc';
    	}
    	$orderBy = " order by $orderByColumn $orderByType ";
    	
    	$sql = "select $filedStr from ".$table.$where.$orderBy;
//     	var_dump($sql);
    	$rs = $this->conn->executeAsoc($sql, $arr);
    	$index = 0;
    	foreach ($rs as $rows){
    		$rs[$index] = $obj->formatterObjByExcel($rows);
    		$index++;
    	}
    	return $rs;
    }
 
    // 获取上次查询的记录总数
    function getQueryCount() {
    	$sql = 'SELECT FOUND_ROWS() as c';
			$rs = $this->conn->executeAsoc2($sql);
			$totals = $rs[0]['c'];
			return $totals;
    }
    
		/**
		 * 获取数据库字段类型
		 */
		function getColType($table, $fields) {
			$db = BACKEND_DBNAME;
			$sql = "SELECT COLUMN_NAME,DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='$table' AND TABLE_NAME='$table'";
			//echo $sql.'<br>';
			$rs = $this->conn->getAll($sql);
			$arr = array();
			foreach($fields as $value1) {
				foreach($rs as $value2) {
					if (strtoupper($value1) === $value2['column_name']) {
						array_push($arr, $value2['data_type']);
					}
				}
			}
			return $arr;
		}
}  
?>