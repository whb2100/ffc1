<?php

namespace utils;

class ExcelUtils {
	
	public static function createExcel($obj,$dataArray,$excelHeader) {
		set_time_limit(0);
		$cacheMethod = \PHPExcel_CachedObjectStorageFactory::cache_to_discISAM;
		\PHPExcel_Settings::setCacheStorageMethod($cacheMethod);
		$objExcel = new \PHPExcel();
		$objWriter = new \PHPExcel_Writer_Excel5($objExcel);
		$excelRow = 1;
		//$objWriter->setOffice2003Compatibility(true);
		$objExcel->setActiveSheetIndex(0);
		$objActSheet = $objExcel->getActiveSheet();
		
		
		//设置表头
		$headerArray = empty($excelHeader) ? $obj::$excelHeader : $excelHeader;
		
		$startColumn = 'A';
		$startNum = ord($startColumn);
		foreach ($headerArray as $value){
			$objActSheet->setCellValue(chr($startNum).$excelRow, $value);
			$startNum++;
		}
		$excelRow += 1;
		
// 		//输出数据
		for($i=0; $i<count($dataArray); $i++){
			
			$excelRowArrary = array_values($dataArray[$i]);
			
			$j = 0;
			
			$startColumn = 'A';
			$startNum = ord($startColumn);
			foreach ($headerArray as $value){
				$objActSheet->setCellValueExplicit(chr($startNum).$excelRow, $excelRowArrary[$j],\PHPExcel_Cell_DataType::TYPE_STRING);
				$startNum++;
				$j++;
			}
			$excelRow++;
		}
		
		$file_name = get_class($obj).'_'.time().".xls";
		$file_name = "excel/". substr($file_name,strripos($file_name,'\\')+1);
		$objWriter->save(BASE_DIR.$file_name);
		
		return $file_name;
	}
	
	public static function readExcel($excelFile,$obj){
	
		$isExcel = UploadUtils::isExcel($excelFile);
		if(!$isExcel){
			return;
		}
		// 		//将文件移动到指定文件夹
		$real_name = UploadUtils::uploadFile($excelFile, 'uploads/excel');
		if(!$real_name){
			return;
		}
		$objExcel = new \PHPExcel();
		$objReader = new \PHPExcel_Reader_Excel5($objExcel);
		$PHPExcel = $objReader->load($real_name);
		$sheet = $PHPExcel->getSheet(0); // 读取第一個工作表
		$highestRow = $sheet->getHighestRow(); // 取得总行数
		$highestColumm = $sheet->getHighestColumn(); // 取得总列数
		$excelData = array();
		
	
		/** 循环读取每个单元格的数据 */
		for ($row = 2; $row <= $highestRow; $row++){//行数是以第1行开始
			$rowArray = array();
			$index=0;
			if($sheet->getCell('B'.$row)->getValue() === null){
				continue;
			}
			for ($column = 'A'; $column <= $highestColumm; $column++) {//列数是以A列开始
				$cellValue = $sheet->getCell($column.$row)->getValue();
				if($cellValue instanceof \PHPExcel_RichText){ //富文本转换字符串
					$cellValue = $cellValue->__toString();
				}
				$rowArray += array($obj::$excelModelFields[$index] => addcslashes(stripcslashes($cellValue),'\''));
				$index++;
			}
			$excelData[] = $rowArray;
		}
		// var_dump($excelData);die;
		return $excelData;
	}
	
	//读取录音文件EXCEL
	public static function readRecordExcel($excelFile,$obj){
		$isExcel = UploadUtils::isExcel($excelFile);
		if(!$isExcel){
			return;
		}
				//将文件移动到指定文件夹
		$real_name = UploadUtils::uploadFile($excelFile, 'uploads/excel');
		if(!$real_name){
			return;
		}
		$objExcel = new \PHPExcel();
		$objReader = new \PHPExcel_Reader_Excel2007($objExcel);
		if(!$objReader->canRead($real_name)){
			$objReader = new \PHPExcel_Reader_Excel5();
			if(!$objReader->canRead($real_name)){
				echo 'no Excel';
				return ;
			}
		}
		$PHPExcel = $objReader->load($real_name);
		$sheet = $PHPExcel->getSheet(0); // 读取第一個工作表
		$highestRow = $sheet->getHighestRow(); // 取得总行数
		$highestColumm = $sheet->getHighestColumn(); // 取得总列数
		$excelData = array();
	
		/** 循环读取sheet1每个单元格的数据 */
		for ($row = 2; $row <= $highestRow; $row++){//行数是以第1行开始
			$rowArray = array();
			$index=0;
			if($sheet->getCell('B'.$row)->getValue() === null){
				continue;
			}
		    for ($column = 'A'; $column <= $highestColumm; $column++) {//列数是以A列开始
// 		    	if($column=='C'||$column=='D'){
// 		    		$cellValue = excelTime($sheet->getCell($column.$row)->getValue());
// 		    	}else{
			    	$cellValue = $sheet->getCell($column.$row)->getValue();
// 		    	}
// 		    	$cellValue = $sheet->getCell($column.$row)->getFormattedValue();
		    	if($cellValue instanceof \PHPExcel_RichText){ //富文本转换字符串
		    		$cellValue = $cellValue->__toString();
		    	}
		        $rowArray += array($obj::$excelModelFields[$index] => addcslashes(stripcslashes($cellValue),'\''));
		        $index++;
		    }
		    $excelData[] = $rowArray;
		}
		return $excelData;
	}
	
	/** 读取座席信息EXCEL */
	public static function readAgentExcel($excelFile,$obj){
		
		$isExcel = UploadUtils::isExcel($excelFile);
		if(!$isExcel){
			return;
		}
		//将文件移动到指定文件夹
		$real_name = UploadUtils::uploadFile($excelFile, 'uploads/excel');
		if(!$real_name){
			return;
		}
		$objExcel = new \PHPExcel();
		$objReader = new \PHPExcel_Reader_Excel2007($objExcel);
		if(!$objReader->canRead($real_name)){
			$objReader = new \PHPExcel_Reader_Excel5();
			if(!$objReader->canRead($real_name)){
				echo 'no Excel';
				return ;
			}
		}
		
		$PHPExcel = $objReader->load($real_name);
		$sheetCount = $PHPExcel->getSheetCount();
		$sheet1 = $PHPExcel->getSheet(0); // 读取第一個工作表
		$sheet2 = $PHPExcel->getSheet(1); // 读取第二個工作表
		$highestRow1 = $sheet1->getHighestRow(); // 取得总行数
		$highestRow2 = $sheet2->getHighestRow(); // 取得总行数
		$highestColumm1 = $sheet1->getHighestColumn(); // 取得总列数
		$highestColumm2 = $sheet2->getHighestColumn(); // 取得总列数
		$excelDataAgent = array();
		$excelDataDept = array();
		
		/** 循环读取sheet1每个单元格的数据 */
		for ($row = 2; $row <= $highestRow1; $row++){//行数是以第1行开始
			$rowArray1 = array();
			$index=0;
			if($sheet1->getCell('B'.$row)->getValue() === null){
				continue;
			}
		    for ($column = 'A'; $column <= $highestColumm1; $column++) {//列数是以A列开始
		    	$cellValue = $sheet1->getCell($column.$row)->getValue();
// 		    	$cellValue = $sheet->getCell($column.$row)->getFormattedValue();
		    	if($cellValue instanceof \PHPExcel_RichText){ //富文本转换字符串
		    		$cellValue = $cellValue->__toString();
		    	}
		        $rowArray1 += array($obj::$excelModelFields[$index] => addcslashes(stripcslashes($cellValue),'\''));
		        $index++;
		    }
		    $excelDataAgent[] = $rowArray1;
		}
		
		/** 循环读取sheet2每个单元格的数据 */
		for ($row = 2; $row <= $highestRow2; $row++){//行数是以第1行开始
			$rowArray2 = array();
			$index=0;
			if($sheet2->getCell('A'.$row)->getValue() === null){
				continue;
			}
			for ($column = 'A'; $column <= $highestColumm2; $column++) {//列数是以A列开始
				$cellValue = $sheet2->getCell($column.$row)->getValue();
				// 		    	$cellValue = $sheet->getCell($column.$row)->getFormattedValue();
				if($cellValue instanceof \PHPExcel_RichText){ //富文本转换字符串
					$cellValue = $cellValue->__toString();
				}
				$rowArray2 += array($obj::$excelModelFieldsDept[$index] => addcslashes(stripcslashes($cellValue),'\''));
				$index++;
			}
			$excelDataDept[] = $rowArray2;
		}
		$arr['agent'] = $excelDataAgent;
		$arr['dept'] = $excelDataDept;
		return $arr;
	}
	
	/*
	 * 将对象转换成数组
	 */
	public static function objTolArrayOnExcel($obj,$objArray){
		if(empty($objArray)){
			$objArray = $obj::$excelHeaderFields;
		}
		$arr = array();
		foreach ($objArray as $field) {
			$getMethod  = 'get' .ucwords($field);
			$value = $obj->$getMethod();
			if ($value !== null) {
				$arr[$field] = $value;
			}
		}
		return $arr;
	}
	
	/*
	 * 将数组转换成对象
	 */
	public static function arrToObjOnExcel($arr,$obj){

		if (!$arr) {
			return $obj;
		}
		foreach ($obj::$excelHeaderFields as $field) {
			$setMethod  = 'set' .ucwords($field);
			$obj->$setMethod($arr[$field]);
		}
	
		return $obj;
	}
	
	/*
	 * 将对象所有字段拼接成Excel查询字符串
	 */
	public static function objTableFieldsOnExcel($obj,$tableName,$fieldArr){
		$fieldsStr = '';
		if(empty($fieldArr)){
			$fieldArr = $obj::$excelHeaderFields;
		}
		if(empty($tableName)){
			$tableName = $obj->tableName;
		}
		foreach ($fieldArr as $field){
			if($fieldsStr){
				$fieldsStr .= ',';
			}
			$fieldsStr.= $tableName.'.'.$field;
		}
		return $fieldsStr;
	}
	
	// 根据查询结果数组创建excel
	public static function createExcelByArray($resArray, $filename, $excelHeader) {
		set_time_limit(0);
		$cacheMethod = \PHPExcel_CachedObjectStorageFactory::cache_to_discISAM;
		\PHPExcel_Settings::setCacheStorageMethod($cacheMethod);
		$objExcel = new \PHPExcel();
		$objWriter = new \PHPExcel_Writer_Excel5($objExcel);
		$excelRow = 1;
		//$objWriter->setOffice2003Compatibility(true);
		$objExcel->setActiveSheetIndex(0);
		$objActSheet = $objExcel->getActiveSheet();
		
		// 设置表头
		$headerArray = $excelHeader;
		$startColumn = 'A';
		$startNum = ord($startColumn);
		foreach ($headerArray as $value){
			$objActSheet->setCellValue(chr($startNum).$excelRow, $value);
			$startNum++;
		}
		$excelRow += 1;
		// 输出数据
		for($i = 0; $i < count($resArray); $i++){
			$excelRowArrary = array_values($resArray[$i]);
			$j = 0;
			$startColumn = 'A';
			$startNum = ord($startColumn);
			foreach ($headerArray as $value){
				//$objActSheet->setCellValue(chr($startNum).$excelRow, '' . $excelRowArrary[$j]);
				$objActSheet->setCellValueExplicit(chr($startNum).$excelRow, $excelRowArrary[$j], \PHPExcel_Cell_DataType::TYPE_STRING);
				$startNum++;
				$j++;
			}
			$excelRow++;
		}
		$file_name = $filename . '_' . time() . ".xls";
		$file_name = "excel/". substr($file_name, strripos($file_name,'\\') + 1);
		$objWriter->save(BASE_DIR.$file_name);
		return $file_name;
	}
	
	// 根据查询结果数组创建excel
	public static function createExcelByDetail($resArray1, $resArray2, $filename, $excelHeader1, $excelHeader2, $resImages) {
		set_time_limit(0);
		$cacheMethod = \PHPExcel_CachedObjectStorageFactory::cache_to_discISAM;
		\PHPExcel_Settings::setCacheStorageMethod($cacheMethod);
		$objExcel = new \PHPExcel();
		$objWriter = new \PHPExcel_Writer_Excel5($objExcel);
		$excelRow = 1;
		//$objWriter->setOffice2003Compatibility(true);
		$objExcel->setActiveSheetIndex(0);
		$objActSheet = $objExcel->getActiveSheet();
		
		// 设置表头
		$headerArray = $excelHeader1;
		$startColumn = 'A';
		$startNum = ord($startColumn);
		foreach ($headerArray as $value) {
			$objActSheet->setCellValue(chr($startNum).$excelRow, $value);
			$startNum++;
		}
		$excelRow += 1;
		// 输出数据
		for($i = 0; $i < count($resArray1); $i++) {
			$excelRowArrary = array_values($resArray1[$i]);
			$j = 0;
			$startColumn = 'A';
			$startNum = ord($startColumn);
			foreach ($headerArray as $value) {
				//$objActSheet->setCellValue(chr($startNum).$excelRow, '' . $excelRowArrary[$j]);
				$objActSheet->setCellValueExplicit(chr($startNum).$excelRow, $excelRowArrary[$j], \PHPExcel_Cell_DataType::TYPE_STRING);
				$startNum++;
				$j++;
			}
			$excelRow++;
		}
		$excelRow++;// 空一行
		// 设置表头
		$headerArray = $excelHeader2;
		$startColumn = 'A';
		$startNum = ord($startColumn);
		foreach ($headerArray as $value) {
			$objActSheet->setCellValue(chr($startNum).$excelRow, $value);
			$startNum++;
		}
		$excelRow += 1;
		// 输出数据
		for($i = 0; $i < count($resArray2); $i++) {
			$excelRowArrary = array_values($resArray2[$i]);
			$j = 0;
			$startColumn = 'A';
			$startNum = ord($startColumn);
			foreach ($headerArray as $value) {
				//$objActSheet->setCellValue(chr($startNum).$excelRow, ' ' . $excelRowArrary[$j]);
				$objActSheet->setCellValueExplicit(chr($startNum).$excelRow, $excelRowArrary[$j], \PHPExcel_Cell_DataType::TYPE_STRING);
				$startNum++;
				$j++;
			}
			$excelRow++;
		}
		if (count($resImages) > 0) {
			$excelRow += 1;
			// 设置图片表头
			$startColumn = 'A';
			$startNum = ord($startColumn);
			$objActSheet->setCellValue(chr($startNum).$excelRow, '图片');
			$excelRow += 1;
		}
		// 输出图片
		for($i = 0; $i < count($resImages); $i++) {
			$excelRowArrary = array_values($resImages[$i]);
			list($width,$height,$type,$attr) = getimagesize($excelRowArrary[0]);
			$objDrawing = new \PHPExcel_Worksheet_Drawing();// 实例化插入图片类
			$objDrawing->setHeight();// 设置图片高度
			$objExcel->getActiveSheet()->getRowDimension($excelRow)->setRowHeight($height);
			$objDrawing->setPath($excelRowArrary[0]);// 设置路径
			$objDrawing->setCoordinates(chr($startNum).$excelRow);// 设置图片要插入的单元格
			$objDrawing->setOffsetX(80);// 设置图片所在单元格的格式
			//$objDrawing->setRotation(20);
			$objDrawing->getShadow()->setVisible(true);
			//$objDrawing->getShadow()->setDirection(50);
			$objDrawing->setWorksheet($objExcel->getActiveSheet());
			$excelRow++;
			/*$excelRowArrary = array_values($resImages[$i]);
			$startColumn = 'A';
			$startNum = ord($startColumn);
			$objActSheet->setCellValue(chr($startNum).$excelRow, ' ' . $excelRowArrary[0]);
			$excelRow++;*/
		}
		$file_name = $filename . '_' . time() . ".xls";
		$file_name = "excel/". substr($file_name, strripos($file_name,'\\') + 1);
		$objWriter->save(BASE_DIR.$file_name);
		return $file_name;
	}
	
	/**
	 * 根据模板和查询结果数组创建excel
	 * @param filename 创建的文件名（函数自动拼接时间戳和扩展名）
	 * @param filemodel excel模版文件
	 * @param resArray1 数据1
	 * @param resArray2 数据2
	 * @param header1 数据头1
	 * @param header2 数据头2
	 * @@param footer 汇总
	 * @@param types 字段类型
	 */
	public static function createExcelByModel($filename, $filemodel, $resArray1, $resArray2, $header1, $header2, $searchObj, $footer, $types) {
		$time = time();
		$file_name = $filename . '_' . time() . ".xls";
		$file_name = 'excel/'.substr($file_name, strripos($file_name,'\\'));
		copy($filemodel, BASE_DIR.$file_name);
		
		set_time_limit(0);
		$cacheMethod = \PHPExcel_CachedObjectStorageFactory::cache_to_discISAM;
		\PHPExcel_Settings::setCacheStorageMethod($cacheMethod);
		$objExcel = new \PHPExcel();
		$phpReader = new \PHPExcel_Reader_Excel5($objExcel);
		$phpExcel = $phpReader->load(BASE_DIR.$file_name);
		$objWriter = new \PHPExcel_Writer_Excel5($phpExcel);
		$sheet = $phpExcel->getActiveSheet();
		$rows = $sheet->getHighestRow();
		$cols = $sheet->getHighestColumn();
		$match = '/([0-9\.]+\%)/';
		
		if ($searchObj != null) {
			$objArr = $searchObj::$searchfields;
			$startColumn = 'B';
			$startNum = ord($startColumn);
			foreach ($objArr as $key => $field) {
				$getMethod  = 'get'.ucwords($key);
				$value = $searchObj->$getMethod();
				if ($value !== null && $value !== '') {
					$col = chr($startNum).'2';
					$sheet->setCellValueExplicit($col, $field.':'.$value, \PHPExcel_Cell_DataType::TYPE_STRING);
					$sheet->getStyle($col)->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$startNum++;
				}
			}
		}

		// 缓存数据头2
		$excelRow = 3;
		if ($resArray2 != null && $header2 == null) {
			$header2 = array();
			for ($column = 'A'; $column <= $cols; $column++) {
				$col = $column.$excelRow;
				array_push($header2, $sheet->getCell($col)->getValue($col));
			}
		}
		$sheet->removeRow(4, 1);
		//var_dump($header2);
		
		// 设置数据头1
		$excelRow = 2;
		if ($header1 != null) {
			for ($column = 'A'; $column <= $cols; $column++) {
				$sheet->setCellValueExplicit($column.$excelRow, '', \PHPExcel_Cell_DataType::TYPE_STRING);
			}
			$startColumn = 'A';
			$startNum = ord($startColumn);
			foreach ($header1 as $value) {
				$sheet->setCellValueExplicit(chr($startNum++).$excelRow, $value, \PHPExcel_Cell_DataType::TYPE_STRING);
			}
		}

		// 设置数据1
		$excelRow = 3;
		for ($i = 0; $i < count($resArray1); $i++) {
			$excelRowArrary = $resArray1[$i];
			$startColumn = 'A';
			$startNum = ord($startColumn);
			$j = 0;
			foreach ($excelRowArrary as $value) {
				$col = chr($startNum).$excelRow;
				if (preg_match($match, $value)) {
					$value = str_replace('%', '', $value);
					$value = $value / 100;
					$sheet->getStyle($col)->getNumberFormat()->setFormatCode(\PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);//设置百分比
				}
				$type = $types[$j++];
				//if (is_numeric($value)) {
				if (is_numeric($value) && $type != null && ($type === 'NUMBER' || $type === 'DECIMAL' || $type === 'INTEGER')) {
					$sheet->setCellValueExplicit($col, $value, \PHPExcel_Cell_DataType::TYPE_NUMERIC);
				} else {
					$sheet->setCellValueExplicit($col, $value, \PHPExcel_Cell_DataType::TYPE_STRING);
				}
				$sheet->getStyle($col)->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$startNum++;
			}
			$excelRow++;
		}
		$endColumn = chr($startNum - 1);
		
		// 设置数据头2
		$excelRow++;
		if ($resArray2 != null) {
			$startColumn = 'A';
			$startNum = ord($startColumn);
			foreach ($header2 as $value) {
				$col = chr($startNum).$excelRow;
				$sheet->setCellValueExplicit($col, $value, \PHPExcel_Cell_DataType::TYPE_STRING);
				$sheet->getStyle($col)->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$startNum++;
			}
			
			// 设置数据2
			$excelRow++;
			for ($i = 0; $i < count($resArray2); $i++) {
				$excelRowArrary = $resArray2[$i];
				$startColumn = 'A';
				$startNum = ord($startColumn);
				foreach ($excelRowArrary as $value) {
					$col = chr($startNum).$excelRow;
					//$sheet->setCellValueExplicit($col, $value, \PHPExcel_Cell_DataType::TYPE_STRING);
					if (preg_match($match, $value)) {
						$value = str_replace('%', '', $value);
						$value = $value / 100;
						$sheet->getStyle($col)->getNumberFormat()->setFormatCode(\PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);//设置百分比
					}
					if (is_numeric($value)) {
						$sheet->setCellValueExplicit($col, $value, \PHPExcel_Cell_DataType::TYPE_NUMERIC);
					} else {
						$sheet->setCellValueExplicit($col, $value, \PHPExcel_Cell_DataType::TYPE_STRING);
					}
					$sheet->getStyle($col)->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$startNum++;
				}
				$excelRow++;
			}
		}
		
		// 设置汇总
		if ($footer != null) {
			for ($i = 0; $i < count($footer); $i++) {
				$excelRowArrary = $footer[$i];
				$startColumn = 'A';
				$startNum = ord($startColumn);
				foreach ($excelRowArrary as $value) {
					$col = chr($startNum).$excelRow;
					if (preg_match($match, $value)) {
						$value = str_replace('%', '', $value);
						$value = $value / 100;
						$sheet->getStyle($col)->getNumberFormat()->setFormatCode(\PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);//设置百分比
					}
					if (is_numeric($value)) {
						$sheet->setCellValueExplicit($col, $value, \PHPExcel_Cell_DataType::TYPE_NUMERIC);
					} else {
						$sheet->setCellValueExplicit($col, $value, \PHPExcel_Cell_DataType::TYPE_STRING);
					}
					//$sheet->setCellValueExplicit($col, $value, \PHPExcel_Cell_DataType::TYPE_STRING);
					$sheet->getStyle($col)->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$startNum++;
				}
				$excelRow++;
			}
		}
		
		$styleArray = array(
			'borders' => array(
				'allborders' => array(
					//'style' => PHPExcel_Style_Border::BORDER_THICK,// 边框是粗的
					'style' => \PHPExcel_Style_Border::BORDER_THIN,// 细边框
					//'color' => array('argb' => 'FFFF0000')
				),
			),  
    );
 
		//$sheet->getStyle("A4:".$endColumn.($excelRow -2))->applyFromArray($styleArray);
		$sheet->getStyle("A1:".$endColumn.($excelRow -2))->applyFromArray($styleArray);
		$objWriter->save(BASE_DIR.$file_name);
		return $file_name;
	}
	
	public static function formatSecond($value) {
		$theTime = $value;// 秒
		$theTime1 = 0;// 分
		$theTime2 = 0;// 小时
		if($theTime > 60) {
			$theTime1 = floor($theTime / 60);
			$theTime = $theTime % 60;
			if ($theTime1 > 60) {
				$theTime2 = floor($theTime1 / 60);
				$theTime1 = $theTime1 % 60;
			}
		}
	
		$result = ''.$theTime.'秒';
		if($theTime1 > 0) {
			$result = ''.$theTime1.'分'.$result;
		}
		if($theTime2 > 0) {
			$result = ''.$theTime2.'小时'.$result;
		}
		return $result;
	}
	
	public static function formatSecond2Minute($value) {
		$theTime = $value;// 秒
		$theTime1 = 0;// 分
		if($theTime > 60) {
			$theTime1 = floor($theTime / 60);
			$theTime = $theTime % 60;
		}
	
		$result = $theTime.'秒';
		if($theTime1 > 0) {
			$result = $theTime1.'分'.$result;
		}
		return $result;
	}
	
	// 汇总字段补充
	public static function checkFooter($resArray1, $footer) {
		if (count($resArray1) == 0 || count($footer) == 0) {
			return null;
		}
		$val1 = $resArray1[0];
		$val2 = $footer[0];
		$arr = array();
		foreach ($val1 as $key => $value) {
			if (array_key_exists($key, $val2)) {
				$arr[$key] = $val2[$key];
			} else {
				$arr[$key] = '';
			}
		}
		$footer[0] = $arr;
		return $footer;
	}

	// PHP5.5中函数array_column
	public static function array_column($input, $columnKey, $indexKey = NULL) {
		$columnKeyIsNumber = (is_numeric($columnKey)) ? TRUE : FALSE;
		$indexKeyIsNull = (is_null($indexKey)) ? TRUE : FALSE;
		$indexKeyIsNumber = (is_numeric($indexKey)) ? TRUE : FALSE;
		$result = array();
		foreach ((array)$input AS $key => $row) {
			if ($columnKeyIsNumber) {
				$tmp = array_slice($row, $columnKey, 1);
				$tmp = (is_array($tmp) && !empty($tmp)) ? current($tmp) : NULL;
			} else {
				$tmp = isset($row[$columnKey]) ? $row[$columnKey] : NULL;
			}
			if (!$indexKeyIsNull) {
				if ($indexKeyIsNumber) {
					$key = array_slice($row, $indexKey, 1);
					$key = (is_array($key) && ! empty($key)) ? current($key) : NULL;
					$key = is_null($key) ? 0 : $key;
				} else {
					$key = isset($row[$indexKey]) ? $row[$indexKey] : 0;
				}
			}
			$result[$key] = $tmp;
		}
		return $result;
	}
}

?>