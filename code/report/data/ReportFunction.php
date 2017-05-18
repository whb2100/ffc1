<?php
namespace report\data;
use utils\ObjectUtils;
use utils\ReturnResult;
use dao\Db;
use common\Constants;
use utils\ExcelUtils;

class ReportFunction {
	
	// 批处理和po转数组（汇算）
	/* $type  1-BATCH,2-PO;
	 $project_id  项目
	 $date   开始时间
	$key = 2  与时间无关
	 */
	public static function exchange($type,$project_id,$date,$key){
		$item = array();
		if ($type == 1) {
			$table_t ='V_BIZ_BATCH_INFO';
			$table_v ='V_BIZ_BATCH_CHECK_TRANSACTION_DETIAL';
		}else{
			$table_t ='V_BIZ_PO_INFO';
			$table_v ='V_BIZ_PO_CHECK_TRANSACTION_DETIAL';
		}
		$arr = array();
		$itemMapper = new ReportMapper();
		// 汇率
		// 当前项目所有批处理号
		if ($key == 2) {
			$batch_sql = "SELECT a.batch_id,b.exchange_rate,b.currency_type_id,b.currency_type FROM $table_t a
				LEFT JOIN V_BIZ_PROJECT_CURRENCY b ON a.currency_id=b.record_id
				WHERE a.status=2 AND  b.project_id= $project_id";
		}else{
			$batch_sql = "SELECT a.batch_id,b.exchange_rate,b.currency_type_id,b.currency_type FROM $table_t a
				LEFT JOIN V_BIZ_PROJECT_CURRENCY b ON a.currency_id=b.record_id
				WHERE a.status=2 AND  b.project_id= $project_id AND a.last_update_date $date  ";
		}

		$batch = $itemMapper->conn->getAll($batch_sql);
		$batch_ids = ObjectUtils::array_column($batch, 'batch_id');
		$batch_ids = implode(',',$batch_ids);

		if ($batch_ids==null||$batch_ids=='') {
			return $item;
		}

		$detial_sql = "SELECT detail_id,batch_id,main_code,sub_code,amount FROM $table_v WHERE batch_id in  ($batch_ids)";
		$detial = $itemMapper->conn->getAll($detial_sql);
		for ($i=0; $i <count($detial) ; $i++) { 
			$batch_id = $detial[$i]['batch_id'];
			$amount = $detial[$i]['amount'];
			$ke = 0;
			for ($k=0; $k <count($batch) ; $k++) { 
				if ($batch_id == $batch[$k]['batch_id']) {
					$ke = 1;
					$exchange_rate = $batch[$k]['exchange_rate'];
					$detial[$i]['exchange_amount'] = number_format($amount*$exchange_rate,2) ;
					$detial[$i]['currency_type_id'] = $batch[$k]['currency_type_id'];
					$detial[$i]['currency_type'] = $batch[$k]['currency_type'];
				};
			}
			if($ke == 0){
				$detial[$i]['exchange_amount'] ='0.00';
			}
			$detial[$i]['main_sub'] = $detial[$i]['main_code'].$detial[$i]['sub_code'];
		}
			// var_dump($detial);die;
		foreach($detial as $m=>$v){
	    		if(!isset($item[$v['main_sub']])){
	        			$item[$v['main_sub']]=$v;
	    		}else{
	        			$item[$v['main_sub']]['exchange_amount'] = number_format(str_replace(',','',$item[$v['main_sub']]['exchange_amount'])+str_replace(',','',$v['exchange_amount']),2);
	        			// $item[$v['main_sub']]['exchange_amount'] = number_format($item[$v['main_sub']]['exchange_amount']+$v['exchange_amount'],2);
	   	 	}
		}
// var_dump($item);die;
		return $item;

	}
	
// 批处理和po转数组（不计算汇率）
	/* $type  1-BATCH,2-PO;
	 $project_id  项目
	 $date   开始时间
	$key = 2  与时间无关
	$mak =0  批处理用到的货币统计
	$mak =参数  货币id
	 */
	public static function exchange2($type,$project_id,$date,$key,$mak){
		$item = array();
		if ($type == 1) {
			$table_t ='V_BIZ_BATCH_INFO';
			$table_v ='V_BIZ_BATCH_CHECK_TRANSACTION_DETIAL';
		}else{
			$table_t ='V_BIZ_PO_INFO';
			$table_v ='V_BIZ_PO_CHECK_TRANSACTION_DETIAL';
		}
		$arr = array();
		$itemMapper = new ReportMapper();
		// 汇率
		// 当前项目所有批处理号
		if ($key == 2) {
			$batch_sql = "SELECT a.batch_id,b.exchange_rate,b.currency_type_id,b.currency_type FROM $table_t a
				LEFT JOIN V_BIZ_PROJECT_CURRENCY b ON a.currency_id=b.record_id
				WHERE a.status=2 AND  b.project_id= $project_id";
		}else{
			$batch_sql = "SELECT a.batch_id,b.exchange_rate,b.currency_type_id,b.currency_type FROM $table_t a
				LEFT JOIN V_BIZ_PROJECT_CURRENCY b ON a.currency_id=b.record_id
				WHERE a.status=2 AND  b.project_id= $project_id AND a.last_update_date $date  ";
		}

		$batch = $itemMapper->conn->getAll($batch_sql);
		$batch_ids = ObjectUtils::array_column($batch, 'batch_id');
		$batch_ids = implode(',',$batch_ids);

		if ($batch_ids==null||$batch_ids=='') {
			return $item;
		}
		// var_dump()
		if ($mak === 0) {
			return $batch;
		}

		$detial_sql = "SELECT detail_id,batch_id,main_code,sub_code,amount FROM $table_v WHERE batch_id in  ($batch_ids)";
		$detial = $itemMapper->conn->getAll($detial_sql);
		for ($i=0; $i <count($detial) ; $i++) { 
			$batch_id = $detial[$i]['batch_id'];
			$amount = $detial[$i]['amount'];
			$ke = 0;
			for ($k=0; $k <count($batch) ; $k++) { 
				if ($batch_id == $batch[$k]['batch_id']) {
					$ke = 1;
					$exchange_rate = $batch[$k]['exchange_rate'];
					$detial[$i]['exchange_amount'] = number_format($amount,2) ;
					$detial[$i]['currency_type_id'] = $batch[$k]['currency_type_id'];
					$detial[$i]['currency_type'] = $batch[$k]['currency_type'];
					$detial[$i]['exchange_rate'] = $batch[$k]['exchange_rate'];
				};
			}
			if($ke == 0){
				$detial[$i]['exchange_amount'] ='0.00';
			}
			$detial[$i]['main_sub'] = $detial[$i]['main_code'].$detial[$i]['sub_code'];
		}

			// var_dump($detial);die;
		foreach ($detial as $keys => $value) {
			if ($value['currency_type_id'] ==$mak) {
				$del[]  = $value;
			}
		}

		foreach($del as $m=>$v){
			// $v['exchange_amount'] = number_format(str_replace(',','',$v['exchange_amount'])/$v['exchange_rate'],2);
	    		if(!isset($item[$v['main_sub']])){
	        			$item[$v['main_sub']]=$v;
	    		}else{
	        			$item[$v['main_sub']]['exchange_amount'] = number_format(str_replace(',','',$item[$v['main_sub']]['exchange_amount'])+str_replace(',','',$v['exchange_amount']),2);
	   	 	}
		}

		return $item;

	}
// 批处理和po所用到的货币列表
	public static function retrieveCurrency(){
		$item = array();
		$itemMapper = new ReportMapper();
		// $project_id = $paramArr['project_id'];
		$project_id = $_SESSION['hqinfo_qm_current_user_project_id_session'];
		if ($project_id==null||$project_id=='') {
			return $item;
		}
		$start_date = $paramArr['start_date'];
		if ($start_date==null||$start_date=='') {
			$start_date = date('Y-m-d',time()); 
		}
		// $start_date = '2017-01-25';
		$start_date_old = "<='".$start_date."'";
		$start_date_new = ">='".$start_date."'";
		// 批处理在本期总计ACTUAL TO DATE
		$batch = ReportFunction::exchange2(1,$project_id,$start_date_old,2,0);
		// PO在本期总计PO COMMITS TO DATE
		$po = ReportFunction::exchange2(2,$project_id,$start_date_old,2,0);
		$arr = array_merge($batch,$po);
		// var_dump($arr);die;
		if ($arr==null||$arr=='') {
			return $item;
		}
		foreach ($arr as $key => $value) {
			if(!isset($Arr[$value['currency_type_id']])){
        				$Arr[$value['currency_type_id']]=$value;
    			}
		}
		// var_dump($Arr);die;
		return array_values($Arr);
	}

// 所有123级数据详情（非混合
	public static function retrieveCodeNO($paramArr){
		$itemMapper = new ReportMapper();
		// $project_id = $paramArr['project_id'];
		$currency_type_id = $paramArr['currency_type_id'];
		// $currency_type_id = 8;
		$project_id = $_SESSION['hqinfo_qm_current_user_project_id_session'];
		if ($project_id==null||$project_id=='') {
			return $item;
		}
		$start_date = $paramArr['start_date'];
		if ($start_date==null||$start_date=='') {
			$start_date = date('Y-m-d',time()); 
		}
		// $start_date = '2017-01-25';
		$start_date_old = "<='".$start_date."'";
		$start_date_new = ">='".$start_date."'";
		// 批处理在本期总计ACTUAL TO DATE
		$batch_old = ReportFunction::exchange2(1,$project_id,$start_date_old,2,$currency_type_id);
		// 批处理在本期之后ACTUAL THIS PERIOD
		$batch_new = ReportFunction::exchange2(1,$project_id,$start_date_new,'',$currency_type_id);
		// PO在本期总计PO COMMITS TO DATE
		$po_old = ReportFunction::exchange2(2,$project_id,$start_date_old,2,$currency_type_id);

		$code_sql = "SELECT main_code,sub_code,concat(main_code,sub_code) as main_sub,code_desc_zh,code_desc_en,amount AS budget,last_amount AS etc ,statistics_level_id FROM T_BIZ_PROJECT_CODE  
		 WHERE PROJECT_ID= $project_id  ORDER BY main_code,sub_code";
		 // WHERE PROJECT_ID= $project_id AND code_type=2 ORDER BY main_code,sub_code";
		$code = $itemMapper->conn->getAll($code_sql);
		for ($i=0; $i <count($code) ; $i++) { 
			$main_sub = $code[$i]['main_sub'];
			// 批处理在本期前合并到数组
			if (count($batch_old)>0) {
				foreach ($batch_old as $key => $value) {
					if ($value['main_sub'] == $main_sub) {
						$code[$i]['b_old'] =$value['exchange_amount'];
					}
				}
			}
			if(!isset($code[$i]['b_old'])){
	        			$code[$i]['b_old'] = '0.00';
	        		}
	        		// 批处理在本期后合并到数组
			if (count($batch_new)>0) {
				foreach ($batch_new as $keys => $values) {
					if ($values['main_sub'] == $main_sub) {
						$code[$i]['b_new'] =$values['exchange_amount'];
					}
				}
		        	}
			if(!isset($code[$i]['b_new'])){
	        			$code[$i]['b_new'] = '0.00';
	        		}
	        		// 批处理在本期后合并到数组
			if (count($po_old)>0) {
				foreach ($po_old as $keysa => $valuesa) {
					if ($valuesa['main_sub'] == $main_sub) {
						$code[$i]['p_old'] =$valuesa['exchange_amount'];
					}
				}
		        	}
			if(!isset($code[$i]['p_old'])){
	        			$code[$i]['p_old'] = '0.00';
	        		}
	        		// 计算current和total
	        		// $code[$i]['current'] = number_format($code[$i]['b_old']+$code[$i]['p_old']+$code[$i]['etc'],2);
	        		$code[$i]['current'] = number_format(str_replace(',','',$code[$i]['b_old'])+str_replace(',','',$code[$i]['p_old'])+str_replace(',','',$code[$i]['etc']),2);
	        		// $code[$i]['total'] = number_format($code[$i]['current']-$code[$i]['budget'],2);
	        		
	        		// 计算预算换算成当前货币值
	        		$rate = ReportFunction::retrieveCurrency();
	        		// var_dump($rate);die;
	        		foreach ($rate as $kk => $vv) {
	        			if ($vv['currency_type_id'] ==$currency_type_id ) {
	        				$Rate = $vv['exchange_rate'];
	        			}
	        		}
	        		$code[$i]['budget'] = number_format($code[$i]['budget']/$Rate,2);
	        		$code[$i]['etc'] = number_format($code[$i]['etc'],2);
	        		$code[$i]['total'] = number_format(str_replace(',','',$code[$i]['budget'])-str_replace(',','',$code[$i]['current']),2);
	        		// main截取main_sub前兩位
	        		if ($code[$i]['statistics_level_id']>1) {
	        			$code[$i]['main'] = substr($code[$i]['main_sub'],0,2)."00";
	        		}else{
	        			$code[$i]['main'] = $code[$i]['main_code'];
	        		}

		}
		// var_dump($code);die;
		return $code;

	}

// 所有123级数据详情(混合)
	public static function retrieveCode($paramArr){
		$itemMapper = new ReportMapper();
		// $project_id = $paramArr['project_id'];
		$project_id = $_SESSION['hqinfo_qm_current_user_project_id_session'];
		if ($project_id==null||$project_id=='') {
			return $item;
		}
		$start_date = $paramArr['start_date'];
		if ($start_date==null||$start_date=='') {
			$start_date = date('Y-m-d',time()); 
		}
		// $start_date = '2017-01-25';
		$start_date_old = "<='".$start_date."'";
		$start_date_new = ">='".$start_date."'";
		// 批处理在本期总计ACTUAL TO DATE
		$batch_old = ReportFunction::exchange(1,$project_id,$start_date_old,2);
		// 批处理在本期之后ACTUAL THIS PERIOD
		$batch_new = ReportFunction::exchange(1,$project_id,$start_date_new);
		// PO在本期总计PO COMMITS TO DATE
		$po_old = ReportFunction::exchange(2,$project_id,$start_date_old,2);

		$code_sql = "SELECT main_code,sub_code,concat(main_code,sub_code) as main_sub,code_desc_zh,code_desc_en,amount AS budget,last_amount AS etc ,statistics_level_id FROM T_BIZ_PROJECT_CODE  
		 WHERE PROJECT_ID= $project_id  ORDER BY main_code,sub_code";
		 // WHERE PROJECT_ID= $project_id AND code_type=2 ORDER BY main_code,sub_code";
		$code = $itemMapper->conn->getAll($code_sql);
		for ($i=0; $i <count($code) ; $i++) { 
			$main_sub = $code[$i]['main_sub'];
			// 批处理在本期前合并到数组
			if (count($batch_old)>0) {
				foreach ($batch_old as $key => $value) {
					if ($value['main_sub'] == $main_sub) {
						$code[$i]['b_old'] =$value['exchange_amount'];
					}
				}
			}
			if(!isset($code[$i]['b_old'])){
	        			$code[$i]['b_old'] = '0.00';
	        		}
	        		// 批处理在本期后合并到数组
			if (count($batch_new)>0) {
				foreach ($batch_new as $keys => $values) {
					if ($values['main_sub'] == $main_sub) {
						$code[$i]['b_new'] =$values['exchange_amount'];
					}
				}
		        	}
			if(!isset($code[$i]['b_new'])){
	        			$code[$i]['b_new'] = '0.00';
	        		}
	        		// 批处理在本期后合并到数组
			if (count($po_old)>0) {
				foreach ($po_old as $keysa => $valuesa) {
					if ($valuesa['main_sub'] == $main_sub) {
						$code[$i]['p_old'] =$valuesa['exchange_amount'];
					}
				}
		        	}
			if(!isset($code[$i]['p_old'])){
	        			$code[$i]['p_old'] = '0.00';
	        		}
	        		// 计算current和total
	        		// $code[$i]['current'] = number_format($code[$i]['b_old']+$code[$i]['p_old']+$code[$i]['etc'],2);
	        		$code[$i]['current'] = number_format(str_replace(',','',$code[$i]['b_old'])+str_replace(',','',$code[$i]['p_old'])+str_replace(',','',$code[$i]['etc']),2);
	        		// $code[$i]['total'] = number_format($code[$i]['current']-$code[$i]['budget'],2);
	        		$code[$i]['total'] = number_format(str_replace(',','',$code[$i]['budget'])-str_replace(',','',$code[$i]['current']),2);
	        		$code[$i]['budget'] = number_format($code[$i]['budget'],2);
	        		$code[$i]['etc'] = number_format($code[$i]['etc'],2);
	        		// main截取main_sub前兩位
	        		if ($code[$i]['statistics_level_id']>1) {
	        			$code[$i]['main'] = substr($code[$i]['main_sub'],0,2)."00";
	        		}else{
	        			$code[$i]['main'] = $code[$i]['main_code'];
	        		}

		}
		// var_dump( $code);die;
		return $code;

	}
// 所有12级数据详情
	public static function retrieveCode2($code,$type){
		$arr = array();
		foreach($code as $k=>$v){
			 if(!isset($arr[$v['main']])){
				        $arr[$v['main']]=$v;
				        if ($type==1) {
				        		// if ($_SESSION['language'] == "zh") {
				        		// 	$arr[$v['main']]['main_sub']=$v['code_desc_zh']."总计";
				        		// }else{
					       		// $arr[$v['main']]['main_sub']=$v['code_desc_en']."    TOTAL";
				        		// }
				        				$arr[$v['main']]['main_sub'] = $v['main_sub'];
								$arr[$v['main']]['code_desc_zh'] = $v['code_desc_zh']."总计";
								$arr[$v['main']]['code_desc_en'] = $v['code_desc_en']."    TOTAL";
					        // $arr[$v['main']]['code_desc_en']='';
					        // $arr[$v['main']]['code_desc_zh']='';
				        }
			}else{
				           $arr[$v['main']]['budget']=  number_format(str_replace(',','',$arr[$v['main']]['budget']) +str_replace(',','',$v['budget'] ),2);
				           $arr[$v['main']]['etc']=  number_format(str_replace(',','',$arr[$v['main']]['etc']) +str_replace(',','',$v['etc'] ),2);
				           $arr[$v['main']]['b_old']=  number_format(str_replace(',','',$arr[$v['main']]['b_old']) +str_replace(',','',$v['b_old']) ,2);
				           $arr[$v['main']]['b_new']=  number_format(str_replace(',','',$arr[$v['main']]['b_new']) +str_replace(',','',$v['b_new'] ),2);
				           $arr[$v['main']]['p_old']=  number_format(str_replace(',','',$arr[$v['main']]['p_old']) +str_replace(',','',$v['p_old']) ,2);
				           $arr[$v['main']]['current']=  number_format(str_replace(',','',$arr[$v['main']]['current']) +str_replace(',','',$v['current']) ,2);
				           $arr[$v['main']]['total']=  number_format(str_replace(',','',$arr[$v['main']]['total']) +str_replace(',','',$v['total']) ,2);
			}
		}
		return $arr;

	}



// $type=1    MAIN_SUB报表数据处理
// $type=3    balance报表数据处理
// $id （1,4）   对应报表的二级数据
// $mix   =2   非混合
	public static function retrieveMainSub($paramArr,$type,$id,$mix){
		$item = array();
		$array = array();
		$itemMapper = new ReportMapper();
		if ($mix ==2) {
			$code = ReportFunction::retrieveCodeNO($paramArr);
		}else{
			$code = ReportFunction::retrieveCode($paramArr);
		}	
		$arr = ReportFunction::retrieveCode2($code,1);
		// var_dump($code);die;
		$keys = array_keys($arr);
		// var_dump($keys);die;
		foreach ($keys as $key=> $va) {
			if ($type == 1) {
				foreach ($code as $m => $kk) {
					if ($va == $kk['main']&&$kk['sub_code']=='000'&&$kk['statistics_level_id']>1&&$kk['main']<9000) {
						// $title['main_sub'] = substr($kk['main_sub'],0,2)."00";
				        		if ($_SESSION['language'] == "zh") {
				        			$title['code_desc_zh'] = $kk['code_desc_zh'];
				        		}else{
					       		$title['code_desc_en'] = $kk['code_desc_en'];
				        		}
						$title['code'] = $kk['main_sub'];
						$title['statistics_level_id'] = 1;
						$array[] = $title;
					}
					if ($va == $kk['main']&&$kk['sub_code']!='000'&&$kk['statistics_level_id']>1&&$kk['main']<9000) {
						$array[] = $kk;
					}
				}
				if ($arr[$va]['statistics_level_id']>1&&$va<9000) {
					$array[] = $arr[$va];
				}
			}else if($type == 3){
				foreach ($code as $m => $kk) {
					if ($va == $kk['main']&&$kk['sub_code']=='000'&&$kk['statistics_level_id']>1&&$kk['main']>=9000) {
						// $title['main_sub'] = substr($kk['main_sub'],0,2)."00";
				        		if ($_SESSION['language'] == "zh") {
				        			$title['code_desc_zh'] = $kk['code_desc_zh'];
				        		}else{
					       		$title['code_desc_en'] = $kk['code_desc_en'];
				        		}
						$title['code'] = $kk['main_sub'];
						$title['statistics_level_id'] = 1;
						$array[] = $title;
					}
					if ($va == $kk['main']&&$kk['sub_code']!='000'&&$kk['statistics_level_id']>1&&$kk['main']>=9000) {
						$array[] = $kk;
					}
				}
				if ($arr[$va]['statistics_level_id']>1&&$va>=9000) {
					$array[] = $arr[$va];
				}

			}
			
		}

		// var_dump($array);die;
		

		// 对应2级报表数据
		$main = ReportFunction::retrieveMain($paramArr,$id,$mix);
		$main = $main['rows'];
		foreach ($main as $ke => $val) {
			if (strlen($val['main_sub']) == 1 ) {
				$kesa = $main[$ke-1]['main_sub'];
				$Arr[$kesa] = $val;
			}
		}
		$keY = array_keys($Arr);
		// var_dump($array);die;
		foreach ($array as $k => $vas) {
			$ARR[] = $vas;
			for ($i=0; $i <count($keY) ; $i++) { 
				$main_sub = $keY[$i];
				if ($vas['main_sub'] == $main_sub."000" ) {
					$ARR[] = $Arr[$main_sub];
				}
			}
		}
		if ($type != 3) {
			$ARR[] = ReportFunction::retrieveTotal($paramArr,$mix);
		}else{
			// $arrys = ReportFunction::retrieveMain($paramArr,4,$mix);
			// $ARR[] = $arrys['rows'][$arrys['total']-1];var_dump($ARR);die;
		}
		// 过滤本期总计为0的数据(保留3级开头)
		// if ($mix ==2) {
		// 	foreach( $ARR as $KEY => $VALUE ) {
		// 		if ($VALUE['current']!='0.00') {
		// 		// if ($VALUE['current']!='0.00'&&$VALUE['current']!=null) {
		// 		// if ($VALUE['current']==''||$VALUE['current']==null||$VALUE['current'] !='0.00') {
		// 			$code = $VALUE['code'];
		// 			if ($code!=''&&$code!=null) {
		// 				foreach ($ARR as $keya => $valuea) {
		// 					if ($valuea['main_sub'] == $code&&$valuea['current']!='0.00') {
		// 						$arry[] = $VALUE;
		// 					}
		// 				}
		// 			}else{
		// 				$arry[] = $VALUE;

		// 			}
					
		// 		}
		// 	}
		// 	$ARR = $arry;
		// }

		$ARR = ReportFunction::mainSubTop($ARR);
		//标签列表
		$id = $paramArr['id'];
		if ($id) {
			$sql  = "SELECT project_code FROM  t_biz_report_view_detail WHERE view_id= $id";
			$view = $itemMapper->conn->getAll($sql);
			foreach ($view as $keya => $valuea) {
				$project_code =$valuea['project_code'];
				foreach( $ARR as $KEY => $VALUE ) {
					if ($VALUE['main_sub']  ==$project_code ) {
						$arry[] = $VALUE;
					}
				}
			}
			$k = count($arry);
			foreach ($arry as $key => $value) {
				$arry[$k]['budget'] = number_format(str_replace(',','',$value['budget'])+str_replace(',','',$arry[$k]['budget']),2);
				$arry[$k]['etc'] = number_format(str_replace(',','',$value['etc'])+str_replace(',','',$arry[$k]['etc']),2);
				$arry[$k]['b_old'] = number_format(str_replace(',','',$value['b_old'])+str_replace(',','',$arry[$k]['b_old']),2);
				$arry[$k]['b_new'] = number_format(str_replace(',','',$value['b_new'])+str_replace(',','',$arry[$k]['b_new']),2);
				$arry[$k]['p_old'] = number_format(str_replace(',','',$value['p_old'])+str_replace(',','',$arry[$k]['p_old']),2);
				$arry[$k]['current'] = number_format(str_replace(',','',$value['current'])+str_replace(',','',$arry[$k]['current']),2);
				$arry[$k]['total'] = number_format(str_replace(',','',$value['total'])+str_replace(',','',$arry[$k]['total']),2);
			}
			if ($_SESSION['language'] == "zh") {
				$arry[$k]['code_desc_zh'] = '报表总计';
			}else{
				$arry[$k]['code_desc_en'] = 'GRAND TOTAL';

			}
			$ARR = $arry;
		}
		// var_dump($ARR);die;
		foreach ($ARR as $KEY => $VALUE) {
			if ($VALUE['code']) {
				$ARR[$KEY]['main_sub'] = substr($VALUE['code'],0,2)."00";
			}
		}
		// var_dump($ARR);die;
		$item['total'] = count($ARR);
		$item['rows'] = $ARR;
		return $item;
	}

	public static function mainSubTop($ARR){
		// 过滤二级编码为4位，一级编码为2位
		foreach ($ARR as $key => $value) {
				if (strlen($value['main_sub']) == 4) {
					$value['main_sub'] = substr($value['main_sub'],0,1);
					// $value['main_sub'] = substr($value['main_sub'],0,2);
					$ARR[$key] = $value;
				}else if (strlen($value['main_sub']) == 7&&$value['sub_code'] =='000') {
					$value['main_sub'] = $value['main_code'];
					$ARR[$key] = $value;
				}
			
		}
		return $ARR;
	}


// 计算top报表总和

	public static function retrieveTotal($paramArr,$mix){
		$arr = ReportFunction::retrieveMain($paramArr,2,$mix,2);
		$k = count($arr);
		foreach ($arr as $key => $value) {
			$arr[$k]['budget'] = number_format(str_replace(',','',$value['budget'])+str_replace(',','',$arr[$k]['budget']),2);
			$arr[$k]['etc'] = number_format(str_replace(',','',$value['etc'])+str_replace(',','',$arr[$k]['etc']),2);
			$arr[$k]['b_old'] = number_format(str_replace(',','',$value['b_old'])+str_replace(',','',$arr[$k]['b_old']),2);
			$arr[$k]['b_new'] = number_format(str_replace(',','',$value['b_new'])+str_replace(',','',$arr[$k]['b_new']),2);
			$arr[$k]['p_old'] = number_format(str_replace(',','',$value['p_old'])+str_replace(',','',$arr[$k]['p_old']),2);
			$arr[$k]['current'] = number_format(str_replace(',','',$value['current'])+str_replace(',','',$arr[$k]['current']),2);
			$arr[$k]['total'] = number_format(str_replace(',','',$value['total'])+str_replace(',','',$arr[$k]['total']),2);
		}
		if ($_SESSION['language'] == "zh") {
			$arr[$k]['code_desc_zh'] = '报表总计';
		}else{
			$arr[$k]['code_desc_en'] = 'GRAND TOTAL';

		}
		// var_dump($arr );die;
		return $arr[$k];

	}

	// $type参数=1   main报表
	// $type参数=2   top报表
	// 
	// $type参数=4   tbalance_main报表
// $mix   =2   非混合
// $total   =2   一级结果数组返回

	public static function retrieveMain($paramArr,$type,$mix,$total){
		$item = array();
		$arr = array();
		$array = array();
		$itemMapper = new ReportMapper();	
		if ($mix ==2) {
			$code = ReportFunction::retrieveCodeNO($paramArr);
		}else{
			$code = ReportFunction::retrieveCode($paramArr);
		}
		$arr_code = ReportFunction::retrieveCode2($code,2);
		// var_dump($arr_code);die;
		// $arr为二级所有结果
		foreach($arr_code as $k=>$v){
			 if(!isset($arr[substr($v['main'],0,1)])){
				      $arr[substr($v['main'],0,1)]=$v;
			}else{
				          	$arr[substr($v['main'],0,1)]['budget']=  number_format(str_replace(',','',$arr[substr($v['main'],0,1)]['budget']) +str_replace(',','',$v['budget'] ),2);
				        	$arr[substr($v['main'],0,1)]['etc']=  number_format(str_replace(',','',$arr[substr($v['main'],0,1)]['etc']) +str_replace(',','',$v['etc'] ),2);
				         	$arr[substr($v['main'],0,1)]['b_old']=  number_format(str_replace(',','',$arr[substr($v['main'],0,1)]['b_old']) +str_replace(',','',$v['b_old']) ,2);
				          	$arr[substr($v['main'],0,1)]['b_new']=  number_format(str_replace(',','',$arr[substr($v['main'],0,1)]['b_new']) +str_replace(',','',$v['b_new'] ),2);
				         	$arr[substr($v['main'],0,1)]['p_old']=  number_format(str_replace(',','', $arr[substr($v['main'],0,1)]['p_old']) +str_replace(',','',$v['p_old']) ,2);
				         	$arr[substr($v['main'],0,1)]['current']=  number_format(str_replace(',','',$arr[substr($v['main'],0,1)]['current']) +str_replace(',','',$v['current']) ,2);
				       	$arr[substr($v['main'],0,1)]['total']=  number_format(str_replace(',','',$arr[substr($v['main'],0,1)]['total']) +str_replace(',','',$v['total']) ,2);
			}
			if ($v['statistics_level_id'] == 1) {
				$array[] =$v;
			}
		}
		// var_dump($arr);die;
		// var_dump($array);die;
		// key为一级分类，value为总计
		foreach ($array as $key => $value) {
			$m = $value['main_code'];
			if($m == 0){
				$Arr[0] = $arr[0];
			}else if($m==1){
				$Arr[1] = $arr[1];
				foreach ($arr as $y => $e) {
					if ($y>=2&&$y<=4) {
						$Arr[1]['budget']=  number_format(str_replace(',','',$Arr[1]['budget']) +str_replace(',','',$e['budget'] ),2);
						$Arr[1]['etc']=  number_format(str_replace(',','',$Arr[1]['etc']) +str_replace(',','',$e['etc'] ),2);
						$Arr[1]['b_old']=  number_format(str_replace(',','',$Arr[1]['b_old']) +str_replace(',','',$e['b_old'] ),2);
						$Arr[1]['b_new']=  number_format(str_replace(',','',$Arr[1]['b_new']) +str_replace(',','',$e['b_new'] ),2);
						$Arr[1]['p_old']=  number_format(str_replace(',','',$Arr[1]['p_old']) +str_replace(',','',$e['p_old'] ),2);
						$Arr[1]['current']=  number_format(str_replace(',','',$Arr[1]['current']) +str_replace(',','',$e['current'] ),2);
						$Arr[1]['total']=  number_format(str_replace(',','',$Arr[1]['total']) +str_replace(',','',$e['total'] ),2);
					}
				}
			}else if($m == 5){
				$Arr[5] = $arr[5];
				foreach ($arr as $y => $e) {
					if ($y==6) {
						$Arr[5]['budget']=  number_format(str_replace(',','',$Arr[5]['budget']) +str_replace(',','',$e['budget'] ),2);
						$Arr[5]['etc']=  number_format(str_replace(',','',$Arr[5]['etc']) +str_replace(',','',$e['etc'] ),2);
						$Arr[5]['b_old']=  number_format(str_replace(',','',$Arr[5]['b_old']) +str_replace(',','',$e['b_old'] ),2);
						$$Arr[5]['b_new']=  number_format(str_replace(',','',$Arr[5]['b_new']) +str_replace(',','',$e['b_new'] ),2);
						$Arr[5]['p_old']=  number_format(str_replace(',','',$Arr[5]['p_old']) +str_replace(',','',$e['p_old'] ),2);
						$Arr[5]['current']=  number_format(str_replace(',','',$Arr[5]['current']) +str_replace(',','',$e['current'] ),2);
						$Arr[5]['total']=  number_format(str_replace(',','',$Arr[5]['total']) +str_replace(',','',$e['total'] ),2);
					}
				}
			}else if($m == 7){
				$Arr[7] = $arr[7];
				foreach ($arr as $y => $e) {
					if ($y==8) {
						$Arr[7]['budget']=  number_format(str_replace(',','',$Arr[7]['budget']) +str_replace(',','',$e['budget'] ),2);
						$Arr[7]['etc']=  number_format(str_replace(',','',$Arr[7]['etc']) +str_replace(',','',$e['etc'] ),2);
						$Arr[7]['b_old']=  number_format(str_replace(',','',$Arr[7]['b_old']) +str_replace(',','',$e['b_old'] ),2);
						$$Arr[7]['b_new']=  number_format(str_replace(',','',$Arr[7]['b_new']) +str_replace(',','',$e['b_new'] ),2);
						$Arr[7]['p_old']=  number_format(str_replace(',','',$Arr[7]['p_old']) +str_replace(',','',$e['p_old'] ),2);
						$Arr[7]['current']=  number_format(str_replace(',','',$Arr[7]['current']) +str_replace(',','',$e['current'] ),2);
						$Arr[7]['total']=  number_format(str_replace(',','',$Arr[7]['total']) +str_replace(',','',$e['total'] ),2);
					}
				}
			}else  if($m == 9){
				$Arr[9] = $arr[9];
			}
		}
		// var_dump($Arr);die;
		if ($type==2) {
			$Arr = array_values($Arr);
			foreach ($Arr as $j => $km) {
				if ($km['main_sub']<9000) {
					$km['statistics_level_id'] = $km['statistics_level_id']+2;
					$title[] = $km;
				}
			}
			// 计算所有列的总和
			if ($total == 2) {
				return $title;
			}




		}else if($type == 1){
		// 拼凑数组
			// var_dump($arr_code);die;
			foreach ($Arr as $p => $q) {
				$mm = 0;
					if ($p ==0) {
						foreach ($arr_code as $b => $c) {
							if ($c['main_sub'] =='0000') {
								$sh['main_sub'] = '0';
						        		if ($_SESSION['language'] == "zh") {
						        			$sh['code_desc_zh'] = $c['code_desc_zh'];
						        		}else{
							       		$sh['code_desc_en'] = $c['code_desc_en'];
						        		}
								$sh['code'] = $c['main_sub'];
								// $sh['code_desc_zh'] = $c['code_desc_zh'];
								// $sh['code_desc_en'] = $c['code_desc_en'];
								$sh['statistics_level_id'] = 1;
								$title[] = $sh;
							}else if($b>=10&&$b<=999){
								$c['statistics_level_id'] =$c['statistics_level_id']+1;
								$title[] = $c;
							}
						}
						$mm = 1;
					}else if ($p ==1) {
						foreach ($arr_code as $b => $c) {
							if ($c['main_sub'] =='1000') {
								$sh['main_sub'] = '1';
						        		if ($_SESSION['language'] == "zh") {
						        			$sh['code_desc_zh'] = $c['code_desc_zh'];
						        		}else{
							       		$sh['code_desc_en'] = $c['code_desc_en'];
						        		}
								$sh['code'] = $c['main_sub'];
								// $sh['code_desc_zh'] = $c['code_desc_zh'];
								// $sh['code_desc_en'] = $c['code_desc_en'];
								$sh['statistics_level_id'] = 1;
								$title[] = $sh;
							}else if($b>=1000&&$b<=4999){
								$c['statistics_level_id'] =$c['statistics_level_id']+1;
								$title[] = $c;
							}
						}
						$mm = 1;
					}else if ($p ==5) {
						foreach ($arr_code as $b => $c) {
							if ($c['main_sub'] =='5000') {
								$sh['main_sub'] = '5';
						        		if ($_SESSION['language'] == "zh") {
						        			$sh['code_desc_zh'] = $c['code_desc_zh'];
						        		}else{
							       		$sh['code_desc_en'] = $c['code_desc_en'];
						        		}
								$sh['code'] = $c['main_sub'];
								// $sh['code_desc_zh'] = $c['code_desc_zh'];
								// $sh['code_desc_en'] = $c['code_desc_en'];
								$sh['statistics_level_id'] = 1;
								$title[] = $sh;
							}else if($b>=5000&&$b<=6999){
								$c['statistics_level_id'] =$c['statistics_level_id']+1;
								$title[] = $c;
							}
						}
						$mm = 1;
					}else if ($p ==7) {
						foreach ($arr_code as $b => $c) {
							if ($c['main_sub'] =='7000') {
								$sh['main_sub'] = '7';
						        		if ($_SESSION['language'] == "zh") {
						        			$sh['code_desc_zh'] = $c['code_desc_zh'];
						        		}else{
							       		$sh['code_desc_en'] = $c['code_desc_en'];
						        		}
								$sh['code'] = $c['main_sub'];
								// $sh['code_desc_zh'] = $c['code_desc_zh'];
								// $sh['code_desc_en'] = $c['code_desc_en'];
								$sh['statistics_level_id'] = 1;
								$title[] = $sh;
							}else if($b>=7000&&$b<=8999){
								$c['statistics_level_id'] =$c['statistics_level_id']+1;
								$title[] = $c;
							}
						}
						$mm = 1;
					}
					if ($mm == 1) {
						$q['statistics_level_id'] =$q['statistics_level_id']+1;
						$qm = $q;
						        		// if ($_SESSION['language'] == "zh") {
						        		// 	$qm['main_sub']=$q['code_desc_zh']."总计";
						        		// }else{
					       				// $qm['main_sub']=$q['code_desc_en']."    TOTAL";
						        		// }

								$qm['main_sub'] = $q['main_sub'];
								$qm['code_desc_zh'] = $q['code_desc_zh']."总计";
								$qm['code_desc_en'] = $q['code_desc_en']."    TOTAL";
					       	// $qm['code_desc_en']='';
					       	// $qm['code_desc_zh']='';
						$title[] = $qm;
					}
			}	
		}else if($type == 4){	
			foreach ($Arr as $p => $q) {
					if ($p ==9) {
						foreach ($arr_code as $b => $c) {
							if ($c['main_sub'] =='9000') {
								$sh['main_sub'] = '9';
						        		if ($_SESSION['language'] == "zh") {
						        			$sh['code_desc_zh'] = $c['code_desc_zh'];
						        		}else{
							       		$sh['code_desc_en'] = $c['code_desc_en'];
						        		}
								$sh['code'] = $c['main_sub'];
								// $sh['code_desc_zh'] = $c['code_desc_zh'];
								// $sh['code_desc_en'] = $c['code_desc_en'];
								$sh['statistics_level_id'] = 1;
								$title[] = $sh;
							}else if($b>=9000&&$b<=9999){
								$c['statistics_level_id'] =$c['statistics_level_id']+1;
								$title[] = $c;
							}
						}
						$mm = 1;
					}
					if ($mm == 1) {
						$q['statistics_level_id'] =$q['statistics_level_id']+1;
						$qm = $q;
					       			// if ($_SESSION['language'] == "zh") {
						        	// 		$qm['main_sub']=$q['code_desc_zh']."总计";
						        	// 	}else{
					       			// 	$qm['main_sub']=$q['code_desc_en']."    TOTAL";
						        	// 	}
								$qm['main_sub'] = $q['main_sub'];
								$qm['code_desc_zh'] = $q['code_desc_zh']."总计";
								$qm['code_desc_en'] = $q['code_desc_en']."    TOTAL";
					       	// $qm['code_desc_en']='';
					       	// $qm['code_desc_zh']='';
						$title[] = $qm;
					}
				
			}
			// var_dump($title);die;
		}	

		if ($type != 4) {
			$title[] = ReportFunction::retrieveTotal($paramArr,$mix);
		}

		// 过滤本期总计为0的数据
		// if ($mix ==2) {
		// 	foreach( $title as $KEY => $VALUE ) {
		// 		if ($VALUE['current']!='0.00') {
		// 			$code = $VALUE['code'];
		// 			if ($code!=''&&$code!=null) {
		// 				foreach ($title as $keya => $valuea) {
		// 					if ($valuea['main_sub'] == $code&&$valuea['current']!='0.00') {
		// 						$arry[] = $VALUE;
		// 					}
		// 				}
		// 			}else{
		// 				$arry[] = $VALUE;
		// 			}
		// 		}
		// 	}
		// 	$title = $arry;
		// }

		$title = ReportFunction::mainSubTop($title);
		$it['total'] = count($title);
		$it['rows'] = $title;
		return $it;
	}

	public static function retrieveView($paramArr){
		$arr = array();
		$project_id = $_SESSION['hqinfo_qm_current_user_project_id_session'];
		$itemMapper = new ReportMapper();
		$sql  = "SELECT view_id,view_name FROM  t_biz_report_view_info WHERE project_id= $project_id";
		$view = $itemMapper->conn->getAll($sql);
		// var_dump($view);die;
		return $view;
	}
	
	public static function retrieveViewById($view_id) {
		if ($view_id == null) {
			return false;
		}
		$arr = array();
		$itemMapper = new ReportMapper();
		$sql  = "SELECT view_id,view_name FROM t_biz_report_view_info WHERE view_id= $view_id";
		$view = $itemMapper->conn->getOne($sql);
		// var_dump($view);die;
		return $view;
	}

	public static function saveView($paramArr){
		$arr = array();
		$itemMapper = new ReportMapper();
		$project_id = $_SESSION['hqinfo_qm_current_user_project_id_session'];
		$ids = $paramArr['ids'];
		$name = $paramArr['name'];
		$date  = date('Y-m-d H:i:s', time());
		$create = $_SESSION[Constants::LOGINED_USER_ID_IN_SESSION];		
		$arr1 = explode(',', $ids);
		// 判断是否有同名
		$name_sql = "SELECT view_id FROM t_biz_report_view_info  WHERE view_name =  '$name' AND project_id ='$project_id' ";
		$name_t   =	$itemMapper->conn->getAll($name_sql);
		if ($name_t) {
			$view_id = $name_t[0]['view_id'];
			$name_del = "DELETE FROM t_biz_report_view_detail WHERE view_id =$view_id";
			$itemMapper->conn->exec($name_del);
		}else{
			$sql  = "INSERT INTO t_biz_report_view_info(view_name,project_id,create_date,create_by)VALUES('$name','$project_id','$date','$create')";
			$view_id = $itemMapper->conn->executeAsoc($sql);
		}
		
		if ($view_id) {
			foreach($arr1 as $value) {
				$sql_detail  = "INSERT INTO t_biz_report_view_detail(project_code,view_id)VALUES('$value','$view_id')";
				$itemMapper->conn->exec($sql_detail);
			}
				$arr = ReturnResult::returnMsg($view_id);
		}else{
				$arr = ReturnResult::returnMsg(false);
		}
		
		return $arr;
	}

	public static function delView($paramArr){
		$id = $paramArr['id'];
		$arr = array();
		$itemMapper = new ReportMapper();
		$sql_detail  = "DELETE FROM t_biz_report_view_detail WHERE view_id =$id";
		$sql  = "DELETE FROM t_biz_report_view_info WHERE view_id =$id";
		$m = $itemMapper->conn->exec($sql_detail);
		$n = $itemMapper->conn->exec($sql);
		if ($m&&$n) {
			$arr = ReturnResult::returnMsg(true);
		}else{
			$arr = ReturnResult::returnMsg(false);
		}
		return $arr;
	}

}

?>