<?php
	
	// 页头	
	define('LOGIN_TIME', 'LOGIN TIME:');
	define('RESET_PASSWORD', 'RESET PASSWORD');
	define('LOGIN_OFF', 'LOGIN OFF');
	define('PROJECT_MANAGEMENT', 'PROJECT');
	define('BASIC_SETTING', 'SETTING');
	define('PROJECT_BUDGET', 'BUDGET');
	define('BATCH_PROCESSING', 'BATCH');
	define('REPORT_QUERY', 'REPORT');
	define('HEADER_PO', '');
	define('HEADER_VOUCHERS', 'VOUCHERS');
	
	//基础设置
	define('TITLE_BASIC', 'BASIC SETTING');
	define('CURRENCY', 'CURRENCY');
	define('REGION', 'REGION');
	define('MAIN_CODE', 'MAIN');
	define('SUB_CODE', 'SUB');
	define('OPERATION', 'OPERATION');
	define('ASSET', 'SET');
	define('CREATE_BUDGET', 'BUDGET');
	// define('PROJECT_BUDGET', 'PROJECT BUDGET');
	define('CODE', 'CODE');
	define('SCENE', 'SET');
	define('ADD_DATAGRIDROW', 'ADD');
	
	//批处理
	define('PRINT_ITEM', 'PRINT');
	define('SUBMIT_BATCH', 'Submit batch');
	define('TITLE_BATCH', 'CREATE BATCH');
	define('BATCH_NUMBER', 'BATCH NAME:');
	define('BATCHNUMBER_INPUT', 'Please fill in the batch name.');
	define('BATCH_CURRENCY', 'CURRENCY:');
	define('CREATE_BATCH', 'CREATE BATCH');
	define('ADD_TRANSACTION', 'TRANSACTION');
	define('TRANSACTION_NUMBER', 'TRANSACTION NUMBER:');
	define('TRANSACTIONNUMBER_INPUT', 'Please fill in the transaction number.');
	define('TRANSACTION_TOTAL', 'TOTAL:');
	define('TRANSACTION_CONFIRM', 'CONFIRM');
	define('TRANSACTION_CANCLE', 'CANCLE');
	define('TRANSACTION_DELETE', 'DELETE');
	define('EXAMINATION_SUBJECTS', 'DISTRIBUTION');
	define('CHECK_NUMBER', 'TRANSACTION');
	define('UPDATE_CURRENCY', 'MODIFY TRANSACTION');
	define('CHECK_PWD', 'CHECK PASSWORD');
	define('ADD_BATCH', 'BATCH');
	define('BATCH_PWD', 'PASSWORD:');
	define('BATCH_PWD_INPUT', 'Please input a password!');
	
	//PO录入
	define('TITLE_PO', 'PO');
	define('PO_HISTORY', 'HISTORY ');
	define('PO_LOCATION', 'LOCATION：');
	define('PO_TITLE', ' PO INPUT> HISTORY PO');
	define('ADD_PO', 'ADD PO');
	
	//ETC
	define('ETC_DELETE', 'CLEAR');
	
	// 项目搜索
	define('USER_REALNAME', 'USER INFO');
	define('CREATE_DATE', 'DATE');
	define('CREATE_DATE_TO', 'TO');
	define('SEARCH', 'SEARCH');
	define('CREATE_PRJ', 'CREATE');
	define('UPDATE_PRJ', 'UPDATE');
	define('PRJ_PRINT', 'PRINT');
	define('CURRENT_LOCATION', 'CURRENT LOCATION:');
	define('DOWNLOAD', 'DOWNLOAD');
	
	// 项目
	// define('PROJECT_MANAGEMENT', 'PROJECT  MANAGEMENT');
	define('PROJECT', 'PROJECT');
	define('PRJ_SN', 'PRJ  SN');
	define('PRJ_NAME', 'PRJ  NAME');
	define('PRJ_STATUS', 'STATUS');
	define('PRJ_STATUS_ALL', 'ALL');
	define('PRJ_STATUS_READYING', 'PERP');
	define('PRJ_STATUS_ONGOING', 'SHOOTING');
	define('PRJ_STATUS_POST', 'POST');
	define('PRJ_STATUS_FINISH', 'COMPLETE');
	define('PRJ_STATUS_DISABLE', 'ON HOLD');
	define('DIRECTOR', 'DIRECTOR');
	define('LEADING_STAR_1', 'LEADING  STAR  #1');
	define('LEADING_STAR_2', 'LEADING  STAR  #2');
	define('LEADING_STAR_3', 'LEADING  STAR  #3');
	define('LEADING_STAR_4', 'LEADING  STAR  #4');
	define('INVESTMENT_COMPANY_1', 'INVESTMENT  COMPANY  #1');
	define('INVESTMENT_COMPANY_2', 'INVESTMENT  COMPANY  #2');
	define('INVESTMENT_COMPANY_3', 'INVESTMENT  COMPANY  #3');
	define('MISS_PRJ_SN', 'Please Write The PRJ  SN.');
	define('MISS_PRJ_NAME', 'Please Write The PRJ  NAME.');
	// 项目预算
	define('DEL_BUDGET', 'DELETE');
	define('HIS_BUDGET', 'HISTORY RECORD');
	define('RECOVERY_BUDGET', 'RECOVERY RECORD');
	define('EXPLAIN', 'DOWNLOAD INSTRUCTIONS');

	// 账户
	define('CREATE_ACCOUNT', 'ACCOUNT');
	define('SET_ACCOUNT', ' ACCOUNT SET');
	define('USER_EMPCODE', 'USER NAME');
	define('POSITION_NAME', 'USER LEVEL');
	define('USER_PASSWORD', 'PASSWORD RESET');
	define('USER_PASSWORD_OLD', 'INITIAL PASSWORD');
	define('NO_USER_PASSWORD', 'This is empty without modifying the password');
	define('USER_STATUS_NAME', 'USER STATUS');
		define('USER_STATUS_ONGOING', 'ONGOING');
		define('USER_STATUS_DISABLE', 'DISABLE');
	// define('USER_REALNAME', 'USER INFO');
	define('MISS_USER_EMPCODE', 'Please Write The USER NAME.');
	define('MISS_USER_REALNAME', 'Please Write The USER INFO.');
	
	// 用户权限
	define('LOGIN_TIME_OUT', 'Login time out!');
	define('USER_DISABLE', 'Account is disabled!');
	define('USER_NO_PERMISSION', 'Account has no permission!');

	define('PASS_OLD', 'OLD PASSWORD：');
	define('MISS_PASS_OLD', 'Please fill in the OLD PASSWORD.');
	define('PASS_NEW', 'NEW PASSWORD：');
	define('MISS_PASS_NEW', 'Please fill in the NEW PASSWORD.');
	define('PASS_NEW_SURE', 'CONFIRM PASSWORD：');
	define('MISS_PASS_NEW_SURE', 'Please fill in the confirmation of the new password.');
	define('UPDATE_PASS', 'UPDATE THE PASSWORD');
	define('SAVE', 'SAVE');
	define('CANCLE', 'CANCLE');
	define('CONFIRM', 'CONFIRM');

	// 报表
	define('CURRENT_START_TIME', 'CURRENT START TIME');
	define('SEARCH_REPORT', 'RUN REPORT');
	define('CURRENT_TYPE', 'CURRENCY SETTING');
	define('CURRENT_TYPE_VIEW', 'TAG');
	define('CURRENT_TYPE_VIEW_SAVE', 'SAVE TAG');
	define('CURRENT_TYPE_VIEW_DEL', 'DEL TAG');
	define('CURRENT_TYPE_MIX', 'MIX');
	define('CURRENT_TYPE_NO', 'NO MIX');
	define('REPORT_MAIN_SUB', 'MAIN  SUB');
	define('REPORT_MAIN', 'MAIN');
	define('REPORT_TOP', 'TOP');
	define('BATCH_RECORDS', 'BATCH  RECORDS');
	define('PO_RECORDS', 'PO   RECORDS');
	define('BALANCE', 'BALANCE');
	define('BALANCE_MAIN', 'BALANCE  MAIN');
	define('ALL_DETAIL', 'ALL DETAILS');
	define('CURRENT_TIME', 'CURRENT TIME');
	define('TRANSACTION_CODE_REPORT', 'TRANSACTION CODE');
	define('BATCH_CODE_REPORT', 'BATCH CODE');
	define('DESC_REPORT', 'DESCRIPTION');
	define('TRIAL_BALANCE', 'TRIAL BALANCE');
	define('TOTAL_COST', 'TOTAL COST');
	define('TOTAL_CAPITAL', 'TOTAL BALANCE');
	define('TOTAL_BALANCE', 'GRAND TOTAL');
	define('REPORT_CLEAR','CLEAR');
	define('REPORT_ASSETS','ASSETS');
	define('REPORT_NOT_ASSETS','NON ASSETS');
	
	//凭证
	define('VOUCHERS','VOUCHERS');
	define('VOUCHERS_ADD','ADD VOUCHERS');
	define('CONTRACT_ADD','ADD CONTRACT');
	define('VOUCHERS_NAME','VOUCHERS NAME:');
	define('VOUCHERS_PIC','VOUCHERS PICTURE:');
	define('VOUCHERS_MESSAGE1','Please fill in the name of the vouchers');
	define('VOUCHERS_MESSAGE2','choose file');
	define('REPORT_SEARCH_DATE', 'DATE');
	define('REPORT_CHOOSE', 'BROWSER');
	
?>