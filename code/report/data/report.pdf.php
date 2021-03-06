<?php 
	namespace report\data;
	require_once '../../utils/Autoloader.php';
	require_once '../../classes/mpdf60/mpdf.php';

	use common\Constants;
	use utils\PDFUtils2;
	use project\data\ProjectFunction;
	use basic\data\CurrencyFunction;
	//use batch\data\TransactionDetailFunction;
	//use batch\data\TransactionCodeFunction;
	//use poInut\data\TransactionDetailFunction;
	//use poInut\data\TransactionCodeFunction;
	
	function parseRecordSearch($label, $start_value, $end_value, $search) {
		$r = '';
		@$language = $_SESSION['language'];
		if ($start_value != null && $end_value != null) {
			if (@$language == 'en') {
				$r .= $label.$start_value.'~'.$end_value;
			} else {
				$r .= $label.$start_value.'至'.$end_value;
			}
		} elseif ($start_value != null) {
			$r .= $label.$start_value;
		} else if ($end_value != null) {
			$r .= $label.$end_value;
		}
		if ($r != '') {
			$search = $search.$r.'<br>';
		}
		return $search;
	}
	
	set_time_limit(0);
	$arr = array();
	$project_id = $_SESSION[Constants::LOGINEN_USER_PROJECT_ID_IN_SESSION];
	$report_type = $requestParamArr['report_type'];
	if ($project_id == null || $report_type == null) {// 项目ID不存在或报表类型不存在
		return $arr;
	}

	$proiects = ProjectFunction::retrieveProject(array('project_id'=>$project_id));
	if ($proiects['total'] != 1) {// 没找到项目
		return $arr;
	}

	$project = $proiects['rows'][0];// 获得项目
	$params = PDFUtils2::getDefaultParams();
	@$language = $_SESSION['language'];
	
	$content = '';
	$search = '';
	if ($report_type == 1 || $report_type == 2 || $report_type == 3 || $report_type == 5 || $report_type == 6) {
		if ($requestParamArr['start_date'] == null) {
			$requestParamArr['start_date'] = date('Y-m-d', time());
		}
		if ($language == 'en') {
			$search .= 'CURRENCY SETTING:MIX'.'<br>';
		} else {
			$search .= '货币设定:混合'.'<br>';
		}
		if ($requestParamArr['start_date'] != null) {
			if ($language == 'en') {
				$search .= 'REPORT PERIOD:'.$requestParamArr['start_date'];
			} else {
				$search .= '报表周期:'.$requestParamArr['start_date'];
			}
		}
	} else if ($report_type == 11 || $report_type == 12 || $report_type == 13 || $report_type == 14 || $report_type == 15) {
		if ($requestParamArr['start_date'] == null) {
			$requestParamArr['start_date'] = date('Y-m-d', time());
		}
		if ($language == 'en') {
			$search .= 'CURRENCY SETTING:NO MIX<br>';
		} else {
			$search .= '货币设定:非混合<br>';
		}
		if ($requestParamArr['start_date'] != null) {
			if ($language == 'en') {
				$search .= 'REPORT PERIOD:'.$requestParamArr['start_date'].'<br>';
			} else {
				$search .= '报表周期:'.$requestParamArr['start_date'].'<br>';
			}
		}
	} else if ($report_type == 4) {
		//$report_type = $requestParamArr['report_type'];
		$start_date = $requestParamArr['start_date'];
		$end_date = $requestParamArr['end_date'];
		$currency_start = $requestParamArr['currency_start'];
		$currency_end = $requestParamArr['currency_end'];
		$region_start = $requestParamArr['region_start'];
		$region_end = $requestParamArr['region_end'];
		$main_start = $requestParamArr['main_start'];
		$main_end = $requestParamArr['main_end'];
		$sub_start = $requestParamArr['sub_start'];
		$sub_end = $requestParamArr['sub_end'];
		$scene_start = $requestParamArr['scene_start'];
		$scene_end = $requestParamArr['scene_end'];
		$f1_start = $requestParamArr['f1_start'];
		$f1_end = $requestParamArr['f1_end'];
		$f2_start = $requestParamArr['f2_start'];
		$f2_end = $requestParamArr['f2_end'];
		$f3_start = $requestParamArr['f3_start'];
		$f3_end = $requestParamArr['f3_end'];
		$transaction_start = $requestParamArr['transaction_start'];
		$transaction_end = $requestParamArr['transaction_end'];
		$batch_code = $requestParamArr['batch_code'];
		$detail_desc = $requestParamArr['detail_desc'];
		$is_asset = $requestParamArr['is_asset'];
		$view_id = $requestParamArr['view_id'];
		if ($language == 'en') {
			//$search .= '<div style="border:0px solid #000000;">';
			//$search .= 'SEARCH CONDITION:<br>';
			//$search .= '<div>CURRENCY:</div><br>';
			$search = parseRecordSearch('CURRENCY:', $currency_start, $currency_end, $search);
			$search = parseRecordSearch('REGION:', $region_start, $region_end, $search);
			$search = parseRecordSearch('MAIN:', $main_start, $main_end, $search);
			$search = parseRecordSearch('SUB:', $sub_start, $sub_end, $search);
			$search = parseRecordSearch('SET:', $scene_start, $scene_end, $search);
			$search = parseRecordSearch('F1:', $f1_start, $f1_end, $search);
			$search = parseRecordSearch('F2:', $f2_start, $f2_end, $search);
			$search = parseRecordSearch('F3:', $f3_start, $f3_end, $search);
			$search = parseRecordSearch('TRANSACTION CODE:', $transaction_start, $transaction_end, $search);
			$search = parseRecordSearch('DATE:', $start_date, $end_date, $search);
			$search = parseRecordSearch('BATCH CODE:', $batch_code, null, $search);
			$search = parseRecordSearch('DESCRIPTION:', $detail_desc, null, $search);
			$asset = null;
			if ($is_asset != null) {
				if ($is_asset == 0) {
					$asset = 'NON ASSETS';
				} else if ($is_asset == 1) {
					$asset = 'ASSETS';
				}
			}
			$search = parseRecordSearch('ASSETS:', $asset, null, $search);
			$views = ReportFunction::retrieveViewById($view_id);
			if ($views) {
				$search = parseRecordSearch('TAG:', $views['view_name'], null, $search);
			}
			//$search .= '</div>';
			if ($search != '') {
				$search = '<div style="border:0px solid #000000;">SEARCH CONDITION:<br>'.$search;
			}
		} else {
			//$search .= '<div style="border:0px solid #000000;">';
			//$search .= '搜索条件:<br>';
			$search = parseRecordSearch('货币:', $currency_start, $currency_end, $search);
			$search = parseRecordSearch('地区:', $region_start, $region_end, $search);
			$search = parseRecordSearch('主码:', $main_start, $main_end, $search);
			$search = parseRecordSearch('子码:', $sub_start, $sub_end, $search);
			$search = parseRecordSearch('场景:', $scene_start, $scene_end, $search);
			$search = parseRecordSearch('F1:', $f1_start, $f1_end, $search);
			$search = parseRecordSearch('F2:', $f2_start, $f2_end, $search);
			$search = parseRecordSearch('F3:', $f3_start, $f3_end, $search);
			$search = parseRecordSearch('单号:', $transaction_start, $transaction_end, $search);
			$search = parseRecordSearch('日期:', $start_date, $end_date, $search);
			$search = parseRecordSearch('批处理名:', $batch_code, null, $search);
			$search = parseRecordSearch('描述:', $detail_desc, null, $search);
			$asset = null;
			if ($is_asset != null) {
				if ($is_asset == 0) {
					$asset = '非资产';
				} else if ($is_asset == 1) {
					$asset = '资产';
				}
			}
			$search = parseRecordSearch('资产:', $asset, null, $search);
			$views = ReportFunction::retrieveViewById($view_id);
			if ($views) {
				$search = parseRecordSearch('标签:', $views['view_name'], null, $search);
			}
			if ($search != '') {
				$search = '<div style="border:0px solid #000000;">查询条件:<br>'.$search;
			}
		}
	}
	
	$report_name = '';
	if ($language == 'en') {
		if ($report_type == 1 || $report_type == 11) {
			$report_name = 'MAIN SUB';
		} else if ($report_type == 2 || $report_type == 12) {
			$report_name = 'MAIN';
		} else if ($report_type == 3 || $report_type == 13) {
			$report_name = 'TOP';
		} else if ($report_type == 7) {
			$report_name = 'BATCH RECORDS {report_name} DISTRIBUTION';
		} else if ($report_type == 8) {
			$report_name = 'BATCH RECORDS {report_name} TRANSACTION';
		} else if ($report_type == 9) {
			$report_name = 'PO {report_name} DISTRIBUTION';
		} else if ($report_type == 10) {
			$report_name = 'PO {report_name} TRANSACTION';
		} else if ($report_type == 5 || $report_type == 14) {
			$report_name = 'BALANCE';
		} else if ($report_type == 6 || $report_type == 15) {
			$report_name = 'BALANCE MAIN';
		} else if ($report_type == 4)  {
			/*if ($search != '') {
				$report_name = 'SEARCH';
			} else {
				$report_name = 'ALL DETAILS';
			}*/
			$report_name = $requestParamArr['pname'];
		} else if ($report_type == 16)  {
			$report_name = 'TRIAL BALANCE';
		}
		$report_name .= ' REPORT';
	} else {
		if ($report_type == 1 || $report_type == 11) {
			$report_name = '成本预算(3级)';
		} else if ($report_type == 2 || $report_type == 12) {
			$report_name = '成本预算(2级)';
		} else if ($report_type == 3 || $report_type == 13) {
			$report_name = '成本预算(1级)';
		} else if ($report_type == 7) {
			$report_name = '批处理 {report_name}检查科目';
		} else if ($report_type == 8) {
			$report_name = '批处理 {report_name}检查单号';
		} else if ($report_type == 9) {
			$report_name = 'PO {report_name}检查科目';
		} else if ($report_type == 10) {
			$report_name = 'PO {report_name}检查单号';
		} else if ($report_type == 5 || $report_type == 14) {
			$report_name = '资产报告(2级)';
		} else if ($report_type == 6 || $report_type == 15) {
			$report_name = '资产报告(1级)';
		} else if ($report_type == 4)  {
			/*if ($search != '') {
				$report_name = '查询';
			} else {
				$report_name = '全部明细';
			}*/
			$report_name = $requestParamArr['pname'];
		} else if ($report_type == 16)  {
			$report_name = '试算平衡';
		}
		$report_name .= '报表';
	}

	if ($language == 'en') {
		//$project['project_name'] = 'FENG HE FILMING ACCOUNTING SYSTEM<br>'.$project['project_name'].'<br><br>'.$report_name;
		$project['project_name'] = $project['project_name'].'<br><br>'.$report_name;
	} else {
		//$project['project_name'] = '丰禾电影财务系统<br>'.$project['project_name'].'<br><br>'.$report_name;
		$project['project_name'] = $project['project_name'].'<br><br>'.$report_name;
	}
	$project['search'] = $search;
	
	if ($report_type == 1) {// Budget Cost Main Sub
		$records = ReportFunction::retrieveMainSub($requestParamArr, 1, 1);
		$content = ReportContentFunction::getBudgetCostContent($project, $records['rows'], null, false, $report_type);
	} else if ($report_type == 2) {// Budget Cost Main
		$records = ReportFunction::retrieveMain($requestParamArr, 1);
		$content = ReportContentFunction::getBudgetCostContent($project, $records['rows'], null, false, $report_type);
	} else if ($report_type == 3) {// Budget Cost Top
		$records = ReportFunction::retrieveMain($requestParamArr, 2);
		$content = ReportContentFunction::getBudgetCostContent($project, $records['rows'], null, false, $report_type);
	} else if ($report_type == 4) {// All Detailsv
		$records = \batch\data\TransactionDetailFunction::retrieveRecords($requestParamArr);
		$content = ReportContentFunction::getRecordsContent($project, $records['rows']);
		$params['PDF_ORIENTATION'] = 'P';
	} else if ($report_type == 5) {// BALANCE Main Sub
		$records = ReportFunction::retrieveMainSub($requestParamArr, 3, 4);
		$content = ReportContentFunction::getBudgetCostContent($project, $records['rows'], null, true, $report_type);
		$params['PDF_ORIENTATION'] = 'P';
	} else if ($report_type == 6) {// BALANCE Main
		$records = ReportFunction::retrieveMain($requestParamArr, 4);
		$content = ReportContentFunction::getBudgetCostContent($project, $records['rows'], null, true, $report_type);
		$params['PDF_ORIENTATION'] = 'P';
	} else if ($report_type == 7) {// Batch Check Subjects
		$batch = \batch\data\BatchFunction::retrieveitem($requestParamArr);
		if (count($batch['rows']) > 0) {
			$project['project_name'] = str_replace('{report_name}', $batch['rows'][0]['batch_code'], $project['project_name']);
		} else {
			$project['project_name'] = str_replace('{report_name}', '', $project['project_name']);
		}
		$records = \batch\data\TransactionDetailFunction::retrieveAllItem($requestParamArr);
		$content = ReportContentFunction::getBatchSubjectContent($project, $records);
		$params['PDF_ORIENTATION'] = 'P';
	} else if ($report_type == 8) {// Batch Check Code
		$batch = \batch\data\BatchFunction::retrieveitem($requestParamArr);
		if (count($batch['rows']) > 0) {
			$project['project_name'] = str_replace('{report_name}', $batch['rows'][0]['batch_code'], $project['project_name']);
		} else {
			$project['project_name'] = str_replace('{report_name}', '', $project['project_name']);
		}
		$records = \batch\data\TransactionCodeFunction::retrieveAllItem($requestParamArr);
		$content = ReportContentFunction::getBatchCodeContent($project, $records);
		$params['PDF_ORIENTATION'] = 'P';
	} else if ($report_type == 9) {// PO Check Subjects
		//$requestParamArr['project_id'] = $project_id;
		$batch = \poInput\data\BatchFunction::retrieveitem($requestParamArr);
		if (count($batch['rows']) > 0) {
			$project['project_name'] = str_replace('{report_name}', $batch['rows'][0]['batch_code'], $project['project_name']);
		} else {
			$project['project_name'] = str_replace('{report_name}', '', $project['project_name']);
		}
		$records = \poInput\data\TransactionDetailFunction::retrieveAllItem($requestParamArr);
		$content = ReportContentFunction::getBatchSubjectContent($project, $records);
		$params['PDF_ORIENTATION'] = 'P';
	} else if ($report_type == 10) {// PO Check Code
		$batch = \poInput\data\BatchFunction::retrieveitem($requestParamArr);
		if (count($batch['rows']) > 0) {
			$project['project_name'] = str_replace('{report_name}', $batch['rows'][0]['batch_code'], $project['project_name']);
		} else {
			$project['project_name'] = str_replace('{report_name}', '', $project['project_name']);
		}
		$records = \poInput\data\TransactionCodeFunction::retrieveAllItem($requestParamArr);
		$content = ReportContentFunction::getBatchCodeContent($project, $records);
		$params['PDF_ORIENTATION'] = 'P';
	} else if ($report_type == 11) {// Budget Cost Main Sub 分币
		$currencys = ReportFunction::retrieveCurrency();
		//var_dump($currencys);die;
		$content = '';
		$i = 0;
		foreach ($currencys as $currency) {
			$requestParamArr['currency_type_id'] = $currency['currency_type_id'];
			$records = ReportFunction::retrieveMainSub($requestParamArr, 1, 1, 2);
			if ($i > 0) {
				$content .= '<pagebreak />';
			}
			$content .= ReportContentFunction::getBudgetCostContent($project, $records['rows'], $currency['currency_type'], true, $report_type).'<br>';
			$i++;
		}
	} else if ($report_type == 12) {// Budget Cost 分币
		$currencys = ReportFunction::retrieveCurrency();
		$content = '';
		$i = 0;
		foreach ($currencys as $currency) {
			$requestParamArr['currency_type_id'] = $currency['currency_type_id'];
			$records = ReportFunction::retrieveMain($requestParamArr, 1, 2);
			if ($i > 0) {
				$content .= '<pagebreak />';
			}
			$content .= ReportContentFunction::getBudgetCostContent($project, $records['rows'], $currency['currency_type'], true, $report_type).'<br>';
			$i++;
		}
	} else if ($report_type == 13) {// Budget Cost Top 分币
		$currencys = ReportFunction::retrieveCurrency();
		$content = '';
		$i = 0;
		foreach ($currencys as $currency) {
			$requestParamArr['currency_type_id'] = $currency['currency_type_id'];
			$records = ReportFunction::retrieveMain($requestParamArr, 2, 2);
			if ($i > 0) {
				$content .= '<pagebreak />';
			}
			$content .= ReportContentFunction::getBudgetCostContent($project, $records['rows'], $currency['currency_type'], null, true, $report_type).'<br>';
			$i++;
		}
	} else if ($report_type == 14) {// BALANCE Main Sub 分币
		$currencys = ReportFunction::retrieveCurrency();
		$content = '';
		foreach ($currencys as $currency) {
			$requestParamArr['currency_type_id'] = $currency['currency_type_id'];
			$records = ReportFunction::retrieveMainSub($requestParamArr, 3, 4, 2);
			$content .= ReportContentFunction::getBudgetCostContent($project, $records['rows'], $currency['currency_type'], true, $report_type).'<br>';
		}
		$params['PDF_ORIENTATION'] = 'P';
	} else if ($report_type == 15) {// BALANCE Main 分币
		$currencys = ReportFunction::retrieveCurrency();
		$content = '';
		foreach ($currencys as $currency) {
			$requestParamArr['currency_type_id'] = $currency['currency_type_id'];
			$records = ReportFunction::retrieveMain($requestParamArr, 4, 2);
			$content .= ReportContentFunction::getBudgetCostContent($project, $records['rows'], $currency['currency_type'], true, $report_type).'<br>';
		}
		$params['PDF_ORIENTATION'] = 'P';
	} else if ($report_type == 16) {// 试算平衡
		$requestParamArr['project_id'] = $project_id;
		$requestParamArr['project'] = $project_id;
		//$requestParamArr['project_ids'] = $project_id;
		$records1 = ReportFunction::retrieveMain($requestParamArr, 2);
		$records2 = ReportFunction::retrieveMainSub($requestParamArr, 3, 4);
		$records3 = ProjectFunction::retrieveDirector($requestParamArr);// 导演
		$records4 = ProjectFunction::retrieveActor($requestParamArr);// 主演
		$records5 = CurrencyFunction::retrieveitem($requestParamArr);// 汇率
		//$records6 = ProjectFunction::retrieveProject($requestParamArr);// 项目
		//var_dump($records6);die;
		$cost = 0;
		$capital = 0;
		$total = 0;
		$len = count($records1['rows']) - 1;
		for ($i = 0; $i < $len; $i++) {
			$record = $records1['rows'][$i];
			if ($record['b_old'] != null) {
				//echo $record['b_old'].'<br>';
				$val = str_replace(',', '', $record['b_old']);
				$cost += $val;
			}
		}
		$cost = number_format($cost, 2);
		//var_dump($cost);die;
		$len = count($records2['rows']);
		for ($i = 0; $i < $len; $i++) {
			$record = $records2['rows'][$i];
			if($record['main_sub'] == '9'){
				$capital = $record['b_old'];
				break;
			}
		}
		$total = str_replace(',', '', $cost) + str_replace(',', '', $capital);
		$total = number_format($total, 2);

		//var_dump($total);die;
		$params['PDF_ORIENTATION'] = 'P';
		//$params['CONTENT_FONT_SIZE'] = 10;
		$content = ReportContentFunction::getTrialalanceContent($project, $cost, $capital, $total, $records3['rows'], $records4['rows'], $records5['rows']);
	}

	$params['PDF_TITLE'] = $project['project_name'];
	
	//var_dump($records);die;
	/*$params['CONTENT'] = <<<EOD
		$content
EOD;*/
	$logo = "../../images/logo-$language.png";
	//$content = '<div style="position:absolute;top:40px;left:50px;"><img style="vertical-align: top" width="160" src="'.$logo.'"/></div>'.$content;
	$params['CONTENT'] = $content;
	//echo $content;
	$date = date('YmdHis', time());
	PDFUtils2::createPDF('report'.$date.'.pdf', $language, $params);
?>