<?php
	namespace utils;
	
	class ObjectUtils{
		/**
		 * 将对象转换成数组
		 */
		public static function objToArray($obj, $objArr=null) {
			$arr = array();
			if (empty($objArr)) {
				$objArr = $obj::$tablefields;
			}
			foreach ($objArr as $field) {
				$getMethod  = 'get'.ucwords($field);
				$value = $obj->$getMethod();
				if ($value !== null) {
					$arr[$field] = $value;
				}
			}
			return $arr;
		}
		
		/**
		 * 将数组转换成对象
		 */
		public static function arrToObj($arr, $obj, $objArr) {
			foreach ($arr as $key => $value) {
				$arr[$key] = addcslashes(stripcslashes($value), '\'');
			}
			if (empty($objArr)) {
				$objArr = $obj::$tablefields;
			}
			if (!empty($arr['page']) && !empty($arr['rows'])) {
				$obj->page = $arr['page'];
				$obj->rows = $arr['rows'];
			} else {
				$obj->page = 0;
				$obj->rows = 0;
			}

			if (!empty($arr['sort'])) {
				$obj->sort = $arr['sort'];
			} else {
				$obj->sort = $obj->primaryKey;
			}
			
			if (!empty($arr['order'])) {
				$obj->order = $arr['order'];
			} else {
				$obj->order = 'ASC';
			}

			if (!$arr) {
				return $obj;
			}
			foreach ($objArr as $field) {
				//echo $field.'='.$arr[$field].'<br>';
				$setMethod  = 'set'.ucwords($field);
				$obj->$setMethod($arr[$field]);
			}
			
			return $obj;
		}
		
		/**
		 * 将对象所有字段拼接成查询字符串
		 */
		public static function objTablefields($obj, $fieldArr=null) {
			$fieldsStr = '';
			if (empty($fieldArr)) {
				$fieldArr = $obj::$tablefields;
			}
			foreach ($fieldArr as $field) {
				if($fieldsStr){
					$fieldsStr .= ',';
				}
				$fieldsStr.= $field;
			}
			return $fieldsStr;
		}
		
		/**
		 * 将数组转换成搜索条件对象
		 */
		public static function arrToSearchObj($arr, $obj) {
			$obj->page = null;
			$obj->rows = null;
			$objArr = $obj::$searchfields;
			if (!$arr) {
				return $obj;
			}
			foreach ($arr as $key => $value) {
				$arr[$key] = addcslashes(stripcslashes($value), '\'');
			}
			foreach ($objArr as $key=>$field) {
				$setMethod  = 'set'.ucwords($key);
				$obj->$setMethod($arr[$key]);
			}
			return $obj;
		}

		// PHP5.5中函数array_column
	public static function array_column($input, $columnKey, $indexKey = NULL){
		    $columnKeyIsNumber = (is_numeric($columnKey)) ? TRUE : FALSE;
		    $indexKeyIsNull = (is_null($indexKey)) ? TRUE : FALSE;
		    $indexKeyIsNumber = (is_numeric($indexKey)) ? TRUE : FALSE;
		    $result = array();
		 
		    foreach ((array)$input AS $key => $row)
		    { 
		      if ($columnKeyIsNumber)
		      {
		        $tmp = array_slice($row, $columnKey, 1);
		        $tmp = (is_array($tmp) && !empty($tmp)) ? current($tmp) : NULL;
		      }
		      else
		      {
		        $tmp = isset($row[$columnKey]) ? $row[$columnKey] : NULL;
		      }
		      if ( ! $indexKeyIsNull)
		      {
		        if ($indexKeyIsNumber)
		        {
		          $key = array_slice($row, $indexKey, 1);
		          $key = (is_array($key) && ! empty($key)) ? current($key) : NULL;
		          $key = is_null($key) ? 0 : $key;
		        }
		        else
		        {
		          $key = isset($row[$indexKey]) ? $row[$indexKey] : 0;
		        }
		      }
		 
		      $result[$key] = $tmp;
		    }
		 
		    return $result;
		  }
	}

?>