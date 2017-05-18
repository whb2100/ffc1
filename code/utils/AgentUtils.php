<?php
	namespace utils;
	
	class AgentUtils {
		
		/**
		 * 转换工号成条件.
		 * @param ids 工号字符串.
		 * @param name 字段名称.
		 */
		public static function agentArr($ids, $name) {
			if (empty($ids)) {
				return '';
			}
			$result = '';
			$arr1 = explode(',', $ids);
			foreach($arr1 as $value) {
				$arr2 = explode('-', $value);
				if (count($arr2) == 2) {
					for($i = $arr2[0]; $i <= $arr2[1]; $i++) {
						if ($result == '') {
							$result .=" $name like '%$i%'";
						} else {
							$result .=" OR $name like '%$i%'";
						}
					}
				} else {
					if ($result == '') {
						$result .=" $name like '%$value%'";
					} else {
						$result .=" OR $name like '%$value%'";
					}
				}
			}
			if ($result != '') {
				$result = ' AND ('.$result.')';
			}
			return $result;
		}
	}
?>