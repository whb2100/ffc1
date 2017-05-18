<?php

namespace project\data;

use utils\ObjectUtils;
use utils\ReturnResult;
use dao\Db;
use common\Constants;
use utils\ExcelUtils;

class ProjectFunction {
	public static function searchProject($paramArr,$head){
		$where = ' where 1=1 ';
		$wheres = ' where 1=1 ';
		$pro_name = $paramArr['pro_name'];
		if($pro_name!=null&&$pro_name!=''){
			switch ($paramArr['pro']) {
				case '1':
					$where .= " and project_code like '%" . $pro_name . "%'";
					break;

				case '2':
					$where .= " and project_name like '%" . $pro_name . "%'";
					break;

				case '3':

					$wheres .= " and user_realname like '%" . $pro_name . "%'";
					$res = UserFunction::retrieveUser('',$wheres);
					if ($res['total'] > 0) {
						$ID = $res['rows'][0]['project_id'];
						if ($res['total'] >1) {
							for ($i=1; $i < $res['total']; $i++) { 
								$ID .=  ','.$res['rows'][$i]['project_id'];
							}
						}
						$where .= " and project_id in (".$ID.")";
					}
					break;
			}
		}
		$pro_status = $paramArr['pro_status'];
		if(!empty($pro_status)){
			$where .= "  and project_status= '$pro_status'  ";
		}
		
		$start_date = $paramArr['start_date'];
		if(!empty($start_date)){
			$where .= "  and create_date>= '$start_date'  ";
		}
		$end_date = $paramArr['end_date'];
		if(!empty($end_date)){
			$where .= " and create_date <= '$end_date 59:59:59' ";
		}
		// var_dump($where);die;
		$arr = array();
		$projectMapper = new ProjectMapper();
		$project = new Project();

		$param['rows'] =  $paramArr['rows'];
		$param['page'] =  $paramArr['page'];
		$project = ObjectUtils::arrToObj($param, $project);
		$arr = $projectMapper->find($project,$where,'',$head,$paramArr['sort'],$paramArr['order']);
		return $arr;
	}

	public static function retrieveProject($paramArr){
		// var_dump($paramArr);die;
		$arr = array();
		$projectMapper = new ProjectMapper();
		$project = new Project();
		$where = " where 1=1 ";
		$projectId = $paramArr['project'];
		if($projectId != null && $projectId != ""){
			$where.= " and project_id = $projectId";
		}
		$project = ObjectUtils::arrToObj($paramArr, $project);
		$arr = $projectMapper->find($project,$where);
		return $arr;
	}
	
	public static function retrieveProjectName($paramArr){
		$arr = array();
		$projectMapper = new ProjectMapper();
		$project = new Project();
		$where = " where 1=1 ";
		$projectId = $_SESSION['hqinfo_qm_current_user_project_id_session'];
		if ($projectId==null||$projectId=='') {
			return $item;
		}else{
			$where.= " and project_id = $projectId";
		}
		$project = ObjectUtils::arrToObj($paramArr, $project);
		$arr = $projectMapper->find($project , $where);
		return $arr;
	}

	public static function retrieveActor($paramArr){
		$arr = array();
		$projectMapper = new ProjectMapper();
		$actor = new Actor();
		$where = " where 1=1 ";
		$projectId = $_SESSION['hqinfo_qm_current_user_project_id_session'];
		if ($projectId==null||$projectId=='') {
			return $item;
		}else{
			$where.= " and project_id = $projectId";
		}
		$actor = ObjectUtils::arrToObj($paramArr, $actor);
		$arr = $projectMapper->find($actor,$where,'','','actor_id','ASC');
		return $arr;
	}

	public static function retrieveActor2($paramArr){
		$arr = array();
		$projectMapper = new ProjectMapper();
		$actor = new Actor();
		$where = " where 1=1 ";
		$projectId = $paramArr['project_id'];
		if ($projectId==null||$projectId=='') {
			return $item;
		}else{
			$where.= " and project_id = $projectId";
		}
		$actor = ObjectUtils::arrToObj($paramArr, $actor);
		$arr = $projectMapper->find($actor,$where,'','','actor_id','ASC');
		return $arr;
	}

	public static function retrieveCompany($paramArr){
		$arr = array();
		$projectMapper = new ProjectMapper();
		$company = new Company();
		$company = ObjectUtils::arrToObj($paramArr, $company);
		$arr = $projectMapper->find($company,'','','','company_id','ASC');
		return $arr;
	}

	public static function retrieveDirector($paramArr){
		$arr = array();
		$projectMapper = new ProjectMapper();
		$director = new Director();
		$where = " where 1=1 ";
		$projectId = $_SESSION['hqinfo_qm_current_user_project_id_session'];
		if ($projectId==null||$projectId=='') {
			return $item;
		}else{
			$where.= " and project_id = $projectId";
		}
		$director = ObjectUtils::arrToObj($paramArr, $director);
		$arr = $projectMapper->find($director , $where);
		return $arr;
	}

		public static function retrieveDirector2($paramArr){
		$arr = array();
		$projectMapper = new ProjectMapper();
		$director = new Director();
		$where = " where 1=1 ";
		$projectId = $paramArr['project_id'];
		if ($projectId==null||$projectId=='') {
			return $item;
		}else{
			$where.= " and project_id = $projectId";
		}
		$director = ObjectUtils::arrToObj($paramArr, $director);
		$arr = $projectMapper->find($director , $where);
		return $arr;
	}
	// 获取项目所有信息
	public static function retrieveAll($paramArr){
		$arr['project'] = ProjectFunction::retrieveProject($paramArr);
		$arr['actor'] = ProjectFunction::retrieveActor2($paramArr);
		$arr['company'] = ProjectFunction::retrieveCompany($paramArr);
		$arr['director'] = ProjectFunction::retrieveDirector2($paramArr);
		// var_dump($arr);die;
		return $arr;
	}

	// 创建项目
	public static function createProject($paramArr){
		// var_dump($paramArr);die;
		$arr = array();
		$projectMapper = new ProjectMapper();
		$actor = new Actor();
		$director = new Director();
		$company = new Company();
		// 保存项目信息
		$project = new Project();
		$project->setProject_code(trim($paramArr['project_code']));
		$project->setProject_name(trim($paramArr['project_name']));
		$project->setProject_status($paramArr['project_status']);
		$project->setCreate_date(date('Y-m-d H:i:s', time()));
		$project->setCreate_by($_SESSION[Constants::LOGINED_USER_ID_IN_SESSION ]);
		$project->setLast_update_date(date('Y-m-d H:i:s', time()));
		$project->setLast_update_by($_SESSION[Constants::LOGINED_USER_ID_IN_SESSION ]);
		$project_id = $projectMapper->save($project);
		if ($project_id) {
			$director_name = $paramArr['director_name'];
			if ($director_name != null) {
				$director->setDirector_name($director_name);
				$director->setProject_id($project_id);
				$projectMapper->save($director);
			}
			for ($k=1; $k <=4 ; $k++) { 
				$actor_0 = $paramArr['actor_'.$k];
				if ($actor_0 != null) {
					$actor->setActor_name($actor_0);
					$actor->setProject_id($project_id);
					$projectMapper->save($actor);
				}
				$actor_0 = '';
			}
			for ($i=1; $i <=3 ; $i++) { 
				$company_0 = $paramArr['company_'.$i];
				if ($company_0 != null) {
					$company->setCompany_name($company_0);
					$company->setProject_id($project_id);
					$projectMapper->save($company);
				}
				$company_0 = '';
			}
		}
		
		$arr = ReturnResult::returnMsg(true);
		return $arr;
	}


	// 更新项目
	public static function updateProject($paramArr){
		// var_dump($paramArr);die;
		$project_id = $paramArr['project_id'];
		$arr = array();
		$projectMapper = new ProjectMapper();
		$actor = new Actor();
		$director = new Director();
		$company = new Company();
		// 保存项目信息
		$project = new Project();
		$project->setProject_id($project_id);
		$project->setProject_name($paramArr['project_name']);
		$project->setProject_status($paramArr['project_status']);
		$project->setLast_update_date(date('Y-m-d H:i:s', time()));
		$project->setLast_update_by($_SESSION[Constants::LOGINED_USER_ID_IN_SESSION ]);
		$projectMapper->update($project);
		if ($project_id) {
			// 删除所有详细数据
			$director->setProject_id($project_id);
			$projectMapper->delete($director);
			$actor->setProject_id($project_id);
			$projectMapper->delete($actor);
			$company->setProject_id($project_id);
			$projectMapper->delete($company);
			
			// 增加修改的内容
			$director_name = $paramArr['director_name'];
			if ($director_name != null) {
				$director->setDirector_name($director_name);
				$director->setProject_id($project_id);
				$projectMapper->save($director);
			}
			for ($k=1; $k <=4 ; $k++) { 
				$actor_0 = $paramArr['actor_'.$k];
				if ($actor_0 != null) {
					$actor->setActor_name($actor_0);
					$actor->setProject_id($project_id);
					$projectMapper->save($actor);
				}
				$actor_0 = '';
			}
			for ($i=1; $i <=3 ; $i++) { 
				$company_0 = $paramArr['company_'.$i];
				if ($company_0 != null) {
					$company->setCompany_name($company_0);
					$company->setProject_id($project_id);
					$projectMapper->save($company);
				}
				$company_0 = '';
			}
		}
		
		$arr = ReturnResult::returnMsg(true);
		return $arr;
	}

// 项目编号重复性检查
	public static function projectRepeatCheck($paramArr){
		$arr = array();
		$projectMapper = new ProjectMapper();
		$project = new Project();
		// $project = ObjectUtils::arrToObj($paramArr, $project);
		$value = trim($paramArr['project_code']);
		$where = "where project_code ='$value'";
		$res = $projectMapper->find($project,$where);
		// var_dump($res['rows']);die;
		if(empty($res['rows'])){
			$arr['result'] = Constants::RESULT_CODE_SUCCESS;
			// $arr['msg'] = Constants::OPERATION_SUCCESS;
		}else{
			$arr['result'] = Constants::RESULT_CODE_FAIL_REPEAT;
			// $arr['msg'] = Constants::EXIST_SAME_NAME;
		}
		return $arr;
	}
	

		//excel导出
	public static function exportExcel($paramArr){
		$arr = array();
		$projectMapper = new ProjectMapper();
		$project = new Project();
		$paramArr['page'] = 1;
		$paramArr['rows'] = PHP_INT_MAX;
		$dataArray = ProjectFunction::searchProject($paramArr,Project::$excelHeaderFields);
		@$language = $_SESSION['language'];
		if ($language == 'en') {
			$excel_name = ExcelUtils::createExcelByModel('project',BASE_DIR.'uploads/excelModel/projectList-en.xls', $dataArray['rows']);
		}else{
			$excel_name = ExcelUtils::createExcelByModel('project',BASE_DIR.'uploads/excelModel/projectList.xls', $dataArray['rows']);
		}
		$arr['result'] = Constants::RESULT_CODE_SUCCESS;
		$arr['msg'] = $excel_name;
		return $arr;
	}

}

?>