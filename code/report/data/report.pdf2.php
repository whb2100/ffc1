<?php 
	namespace report\data;
	require_once '../../utils/Autoloader.php';
	require_once '../../classes/mpdf60/mpdf.php';

	use common\Constants;
	use utils\PDFUtils2;
	use project\data\ProjectFunction;
	//use batch\data\TransactionDetailFunction;
	//use batch\data\TransactionCodeFunction;
	//use poInut\data\TransactionDetailFunction;
	//use poInut\data\TransactionCodeFunction;
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
	$content = '';
	if ($report_type == 1) {// Budget Cost Main Sub
		$records = ReportFunction::retrieveMainSub($requestParamArr, 1, 1);
		while (count($records['rows']) > 116) {
			array_splice($records['rows'], 0, 1); 
		}
		$content = ReportContentFunction::getBudgetCostContent($project, $records['rows']);
	} else if ($report_type == 2) {// Budget Cost Main
		$records = ReportFunction::retrieveMain($requestParamArr, 1);
		$content = ReportContentFunction::getBudgetCostContent($project, $records['rows']);
	} else if ($report_type == 3) {// Budget Cost Top
		$records = ReportFunction::retrieveMain($requestParamArr, 2);
		$content = ReportContentFunction::getBudgetCostContent($project, $records['rows']);
	} else if ($report_type == 4) {// All Detailsv
		$records = \batch\data\TransactionDetailFunction::retrieveRecords($requestParamArr);
		$content = ReportContentFunction::getRecordsContent($project, $records['rows']);
		$params['PDF_ORIENTATION'] = 'P';
	} else if ($report_type == 5) {// BALANCE Main Sub
		$records = ReportFunction::retrieveMainSub($requestParamArr, 3, 4);
		$content = ReportContentFunction::getBudgetCostContent($project, $records['rows'], null, true);
		$params['PDF_ORIENTATION'] = 'P';
	} else if ($report_type == 6) {// BALANCE Main
		$records = ReportFunction::retrieveMain($requestParamArr, 4);
		$content = ReportContentFunction::getBudgetCostContent($project, $records['rows'], null, true);
		$params['PDF_ORIENTATION'] = 'P';
	} else if ($report_type == 7) {// Batch Check Subjects
		$records = \batch\data\TransactionDetailFunction::retrieveAllItem($requestParamArr);
		$content = ReportContentFunction::getBatchSubjectContent($project, $records);
		$params['PDF_ORIENTATION'] = 'P';
	} else if ($report_type == 8) {// Batch Check Code
		$records = \batch\data\TransactionCodeFunction::retrieveAllItem($requestParamArr);
		$content = ReportContentFunction::getBatchCodeContent($project, $records);
		$params['PDF_ORIENTATION'] = 'P';
	} else if ($report_type == 9) {// PO Check Subjects
		$records = \poInput\data\TransactionDetailFunction::retrieveAllItem($requestParamArr);
		$content = ReportContentFunction::getBatchSubjectContent($project, $records);
		$params['PDF_ORIENTATION'] = 'P';
	} else if ($report_type == 10) {// PO Check Code
		$records = \poInput\data\TransactionCodeFunction::retrieveAllItem($requestParamArr);
		$content = ReportContentFunction::getBatchSubjectContent($project, $records);
		$params['PDF_ORIENTATION'] = 'P';
	} else if ($report_type == 11) {// Budget Cost Main Sub 分币
		$currencys = ReportFunction::retrieveCurrency();
		//var_dump($currencys);die;
		$content = '';
		foreach ($currencys as $currency) {
			$requestParamArr['currency_type_id'] = $currency['currency_type_id'];
			$records = ReportFunction::retrieveMainSub($requestParamArr, 1, 1, 2);
			$content .= ReportContentFunction::getBudgetCostContent($project, $records['rows'], $currency['currency_type']);
		}
	} else if ($report_type == 12) {// Budget Cost 分币
		$currencys = ReportFunction::retrieveCurrency();
		$content = '';
		foreach ($currencys as $currency) {
			$requestParamArr['currency_type_id'] = $currency['currency_type_id'];
			$records = ReportFunction::retrieveMain($requestParamArr, 1, 2);
			$content .= ReportContentFunction::getBudgetCostContent($project, $records['rows'], $currency['currency_type']);
		}
	} else if ($report_type == 13) {// Budget Cost Top 分币
		$currencys = ReportFunction::retrieveCurrency();
		$content = '';
		foreach ($currencys as $currency) {
			$requestParamArr['currency_type_id'] = $currency['currency_type_id'];
			$records = ReportFunction::retrieveMain($requestParamArr, 2, 2);
			$content .= ReportContentFunction::getBudgetCostContent($project, $records['rows'], $currency['currency_type']);
		}
	} else if ($report_type == 14) {// BALANCE Main Sub 分币
		$currencys = ReportFunction::retrieveCurrency();
		$content = '';
		foreach ($currencys as $currency) {
			$requestParamArr['currency_type_id'] = $currency['currency_type_id'];
			$records = ReportFunction::retrieveMainSub($requestParamArr, 3, 4, 2);
			$content .= ReportContentFunction::getBudgetCostContent($project, $records['rows'], $currency['currency_type'], true);
		}
		$params['PDF_ORIENTATION'] = 'P';
	} else if ($report_type == 15) {// BALANCE Main 分币
		$currencys = ReportFunction::retrieveCurrency();
		$content = '';
		foreach ($currencys as $currency) {
			$requestParamArr['currency_type_id'] = $currency['currency_type_id'];
			$records = ReportFunction::retrieveMain($requestParamArr, 4, 2);
			$content .= ReportContentFunction::getBudgetCostContent($project, $records['rows'], $currency['currency_type'], true);
		}
		$params['PDF_ORIENTATION'] = 'P';
	} else if ($report_type == 16) {// 试算平衡
		$records1 = ReportFunction::retrieveMain($requestParamArr, 2);
		$records2 = ReportFunction::retrieveMainSub($requestParamArr, 3, 4);
		//var_dump($records1);die;
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
			if($record['main_sub'] == '90'){
				$capital = $record['b_old'];
				break;
			}
		}
		$total = str_replace(',', '', $cost) + str_replace(',', '', $capital);
		//var_dump($total);die;
		$params['PDF_ORIENTATION'] = 'P';
		//$params['CONTENT_FONT_SIZE'] = 10;
		$content = ReportContentFunction::getTrialalanceContent($project, $cost, $capital, $total);
	}
	
	/*$content = '<table>';
	for ($i = 0; $i < 1200; $i++) {
		$content .= '<tr>';
		for ($j = 0; $j < 5; $j++) {
			$content .= '<td>td'.$j.'</td>';
		}
		$content .= '</tr>';
	}
	$content .= '</table>';*/
	$params['PDF_TITLE'] = $project['project_name'];
	//var_dump($content);die;
	/*$params['CONTENT'] = <<<EOD
		$content
EOD;*/
	$params['CONTENT'] = $content;
	//echo $content;
	$date = date('YmdHis', time());
	PDFUtils2::createPDF('report'.$date.'.pdf', $_SESSION['language'], $params);
?>