<?php 
	namespace report\data;
	require '../../utils/Autoloader.php';
	require '../../classes/tcpdf/tcpdf.php';

	use common\Constants;
	use utils\PDFUtils;
	use project\data\ProjectFunction;

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
//var_dump($requestParamArr);die;
	$project = $proiects['rows'][0];// 获得项目
	$params = PDFUtils::getDefaultParams();
	$content = '';
	if ($report_type == 1) {// Budget Cost Main Sub
		$records = ReportFunction::retrieveMainSub($requestParamArr, 1, 1);
		$content = ReportContentFunction2::getBudgetCostContent($project, $records['rows']);
	} else if ($report_type == 2) {// Budget Cost Main
		$records = ReportFunction::retrieveMain($requestParamArr, 1);
		$content = ReportContentFunction2::getBudgetCostContent($project, $records['rows']);
	} else if ($report_type == 3) {// Budget Cost Top
		$records = ReportFunction::retrieveMain($requestParamArr, 2);
		$content = ReportContentFunction2::getBudgetCostContent($project, $records['rows']);
	} else if ($report_type == 4) {// All Detailsv
		$records = \batch\data\TransactionDetailFunction::retrieveRecords($requestParamArr);
		$content = ReportContentFunction2::getRecordsContent($project, $records['rows']);
		$params['PDF_ORIENTATION'] = 'P';
	} else if ($report_type == 5) {// BALANCE Main Sub
		$records = ReportFunction::retrieveMainSub($requestParamArr, 3, 4);
		$content = ReportContentFunction2::getBudgetCostContent($project, $records['rows'], null, true);
		$params['PDF_ORIENTATION'] = 'P';
	} else if ($report_type == 6) {// BALANCE Main
		$records = ReportFunction::retrieveMain($requestParamArr, 4);
		$content = ReportContentFunction2::getBudgetCostContent($project, $records['rows'], null, true);
		$params['PDF_ORIENTATION'] = 'P';
	} else if ($report_type == 7) {// Batch Check Subjects
		$records = \batch\data\TransactionDetailFunction::retrieveAllItem($requestParamArr);
		$content = ReportContentFunction2::getBatchSubjectContent($project, $records);
		$params['PDF_ORIENTATION'] = 'P';
	} else if ($report_type == 8) {// Batch Check Code
		$records = \batch\data\TransactionCodeFunction::retrieveAllItem($requestParamArr);
		$content = ReportContentFunction2::getBatchCodeContent($project, $records);
		$params['PDF_ORIENTATION'] = 'P';
	} else if ($report_type == 9) {// PO Check Subjects
		$records = \poInput\data\TransactionDetailFunction::retrieveAllItem($requestParamArr);
		$content = ReportContentFunction2::getBatchSubjectContent($project, $records);
		$params['PDF_ORIENTATION'] = 'P';
	} else if ($report_type == 10) {// PO Check Code
		$records = \poInput\data\TransactionCodeFunction::retrieveAllItem($requestParamArr);
		$content = ReportContentFunction2::getBatchSubjectContent($project, $records);
		$params['PDF_ORIENTATION'] = 'P';
	} else if ($report_type == 11) {// Budget Cost Main Sub 分币
		$currencys = ReportFunction::retrieveCurrency();
		//var_dump($currencys);die;
		$content = '';
		foreach ($currencys as $currency) {
			$requestParamArr['currency_type_id'] = $currency['currency_type_id'];
			$records = ReportFunction::retrieveMainSub($requestParamArr, 1, 1, 2);
			$content .= ReportContentFunction2::getBudgetCostContent($project, $records['rows'], $currency['currency_type']);
		}
	} else if ($report_type == 12) {// Budget Cost 分币
		$currencys = ReportFunction::retrieveCurrency();
		$content = '';
		foreach ($currencys as $currency) {
			$requestParamArr['currency_type_id'] = $currency['currency_type_id'];
			$records = ReportFunction::retrieveMain($requestParamArr, 1, 2);
			$content .= ReportContentFunction2::getBudgetCostContent($project, $records['rows'], $currency['currency_type']);
		}
	} else if ($report_type == 13) {// Budget Cost Top 分币
		$currencys = ReportFunction::retrieveCurrency();
		$content = '';
		foreach ($currencys as $currency) {
			$requestParamArr['currency_type_id'] = $currency['currency_type_id'];
			$records = ReportFunction::retrieveMain($requestParamArr, 2, 2);
			$content .= ReportContentFunction2::getBudgetCostContent($project, $records['rows'], $currency['currency_type']);
		}
	} else if ($report_type == 14) {// BALANCE Main Sub 分币
		$currencys = ReportFunction::retrieveCurrency();
		$content = '';
		foreach ($currencys as $currency) {
			$requestParamArr['currency_type_id'] = $currency['currency_type_id'];
			$records = ReportFunction::retrieveMainSub($requestParamArr, 3, 4, 2);
			$content .= ReportContentFunction2::getBudgetCostContent($project, $records['rows'], $currency['currency_type'], true);
		}
		$params['PDF_ORIENTATION'] = 'P';
	} else if ($report_type == 15) {// BALANCE Main 分币
		$currencys = ReportFunction::retrieveCurrency();
		$content = '';
		foreach ($currencys as $currency) {
			$requestParamArr['currency_type_id'] = $currency['currency_type_id'];
			$records = ReportFunction::retrieveMain($requestParamArr, 4, 2);
			$content .= ReportContentFunction2::getBudgetCostContent($project, $records['rows'], $currency['currency_type'], true);
		}
		$params['PDF_ORIENTATION'] = 'P';
	}

$date = date('YmdHis', time());
header("Content-type:application/vnd.ms-excel");
header("Content-Disposition:filename=report$date.xls");
echo $content;
?>