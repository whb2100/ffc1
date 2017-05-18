<?php
namespace common;
/*
 * Created on 2014年7月29日
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
class Constants {

	//系统根路径
  //const APP_ROOT_PATH = 'http://xxx/sunreport';//服务器地址
  const APP_ROOT_PATH = 'http://127.0.0.1/sunreport';//自己本地地址
	
	//系统后台管理的根目录首页
	const ADMIN_ROOT_PATH = '/sys/index.php';
	const ADMIN_MAIN_PATH = '/main.php';

	//定义session中的系统变量名称
	const LOGINED_USER_CODE_IN_SESSION = 'hqinfo_qm_current_user_code_in_session';
	const LOGINED_USER_NAME_IN_SESSION = 'hqinfo_qm_current_user_name_in_session';
	const LOGINED_USER_ID_IN_SESSION = 'hqinfo_qm_current_user_id_in_session';
	const LOGINED_USER_STORE_ID_IN_SESSION = 'hqinfo_qm_current_user_store_id_in_session';
	const LOGINED_USER_STORE_NAME_IN_SESSION = 'hqinfo_qm_current_user_store_name_in_session';
	const LOGINEN_USER_DEPART_ID_IN_SESSION = 'hqinfo_qm_current_user_depart_id_session';
	const LOGINEN_USER_POSITION_ID_IN_SESSION = 'hqinfo_qm_current_user_position_id_session';
	const LOGINEN_USER_LOGIN_DATE_IN_SESSION = 'hqinfo_qm_current_user_login_date_session';
	const TIP_MESSAGE_IN_SESSION = 'hqinfo_qm_tip_message_in_session';
	const LOGINEN_USER_PROJECT_ID_IN_SESSION = 'hqinfo_qm_current_user_project_id_session';// 项目ID
	const LOGINEN_USER_PROJECT_NAME_IN_SESSION = 'hqinfo_qm_current_user_project_name_session';// 项目名称
	const LOGINED_LANGUAGE_IN_SESSION = 'hqinfo_qm_language_in_session';

	// 坐席
	const LOGINEN_AGENT_LOGIN_DATE_IN_SESSION = 'hqinfo_qm_current_agent_login_date_session';
	const LOGINED_AGENT_CODE_IN_SESSION = 'hqinfo_qm_current_agent_code_in_session';
	const LOGINED_AGENT_NAME_IN_SESSION = 'hqinfo_qm_current_agent_name_in_session';
	const LOGINED_AGENT_ID_IN_SESSION = 'hqinfo_qm_current_agent_id_in_session';
	const LOGINED_AGENT_STORE_ID_IN_SESSION = 'hqinfo_qm_current_agent_store_id_in_session';
	const LOGINED_AGENT_STORE_NAME_IN_SESSION = 'hqinfo_qm_current_agent_store_name_in_session';
	const LOGINEN_AGENT_DEPART_ID_IN_SESSION = 'hqinfo_qm_current_agent_depart_id_session';
	const LOGINEN_AGENT_POSITION_ID_IN_SESSION = 'hqinfo_qm_current_agent_position_id_session';


	const UPLOAD_FILE_ERROR = '网络错误，请重新选取后上传';
	const UPLOAD_FILE_INVALID = '非法文件，请检查文件格式及大小';
	
	//错误返回码
	CONST RESULT_CODE_SUCCESS = 10000;
	CONST RESULT_CODE_FAIL_DB = 10001;
	CONST RESULT_CODE_FAIL_LOGIN = 10002;
	CONST RESULT_CODE_FAIL_PRIVILEGE = 10003;
	CONST RESULT_CODE_FAIL_REPEAT = 10004;
	CONST RESULT_CODE_FAIL_PASSWORD = 10006;// 原密码不正确
	CONST RESULT_CODE_LOGIN_TIME_OUT = 10007;// 登录超时
	CONST RESULT_CODE_USER_DISABLE = 10008;// 账户被停用
	CONST RESULT_CODE_USER_NO_PERMISSION = 10009;// 账户没有相应操作权限

	//错误返回信息
	const OPERATION_SUCCESS = '数据操作成功！';
	const OPERATION_SUCCESS_EN = 'Data operation success!';
	const OPERATION_FAILURE = '数据操作失败，请联系系统管理员！';
	const OPERATION_FAILURE_EN = 'Data operation failed, please contact system administrator!';
	const EXIST_SAME_NAME = '数据重复，请重新输入！';
	const REFERRED_DATA_COULD_NOT_BE_REMOVED = '数据已经在其他模块被引用，当前无法删除！';

	const AUTH_CODE_INCORRECT = '验证码不正确，请重新输入！';
	const CHECK_CORRECT = '验证成功！';
	const USER_NAME_NOT_MATCH_PASSWORD = '输入的用户名/密码不匹配，请重新输入！';
	const USER_PASSWORD_INCORRECT = '输入的原密码不正确，请重新输入！';
	const USER_INVALID_NEED_RE_LOGIN = '用户已失效，请重新登录系统！';
	const USER_LOGOUT_AND_RE_LOGIN = '退出成功，请重新登录系统！';
	const USER_DO_NOT_HAVE_PRIVILEGES = '用户没有权限进行此操作！';
}
?>
