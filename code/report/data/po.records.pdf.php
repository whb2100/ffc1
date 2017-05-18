<?php 
	namespace report\data;
	require '../../utils/Autoloader.php';
	require '../../classes/tcpdf/tcpdf.php';

	use common\Constants;
	use utils\PDFUtils;
	use project\data\ProjectFunction;
	use poInput\data\TransactionDetailFunction;

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
	$params = PDFUtils::getDefaultParams();
	$content = '';
	if ($report_type == 5) {//PO Records
		$records = TransactionDetailFunction::retrieveRecords($requestParamArr);
		$content = ReportContentFunction::getRecordsContent($project, $records['rows']);
	}
	
	$params['CONTENT'] = <<<EOD
		$content
EOD;
	//echo $content;
	PDFUtils::createPDF('example_001.pdf', $params);
?>