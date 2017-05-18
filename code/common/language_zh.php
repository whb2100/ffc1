<?php
	
	// 页头
	define('LOGIN_TIME', '登录时间:');
	define('RESET_PASSWORD', '修改密码');
	define('LOGIN_OFF', '注销');
	define('PROJECT_MANAGEMENT', '项目管理');
	define('BASIC_SETTING', '基础设置');
	define('PROJECT_BUDGET', '项目预算');
	define('BATCH_PROCESSING', '批处理');
	define('REPORT_QUERY', '报表查询');
	define('HEADER_PO', '');
	define('HEADER_VOUCHERS', '凭证扫描');
	
	//基础设置
	define('TITLE_BASIC', '基础设置');
	define('CURRENCY', '货币');
	define('REGION', '地区');
	define('MAIN_CODE', '主码');
	define('SUB_CODE', '子码');
	define('OPERATION', '场景');
	define('ASSET', '资产');
	define('CREATE_BUDGET', '创建预算');
	// define('PROJECT_BUDGET', '项目预算');
	define('CODE', '编码');
	define('SCENE', '场景');
	define('ADD_DATAGRIDROW', '增加');
	
	//批处理
	define('PRINT_ITEM', '打印');
	define('SUBMIT_BATCH', '提交批处理');
	define('TITLE_BATCH', '创建批处理');
	define('BATCH_NUMBER', '批处理名：');
	define('BATCHNUMBER_INPUT', '请填写批处理名');
	define('BATCH_CURRENCY', '货币：');
	define('CREATE_BATCH', '创建批处理');
	define('ADD_TRANSACTION', '新增交易');
	define('TRANSACTION_NUMBER', '交易号：');
	define('TRANSACTIONNUMBER_INPUT', '请填写交易号');
	define('TRANSACTION_TOTAL', '合计：');
	define('TRANSACTION_CONFIRM', '确   定');
	define('TRANSACTION_CANCLE', '取   消');
	define('TRANSACTION_DELETE', '删	除');
	define('EXAMINATION_SUBJECTS', '检查科目');
	define('CHECK_NUMBER', '检查单号');
	define('UPDATE_CURRENCY', '修改货币');
	define('CHECK_PWD', '验证密码');
	define('ADD_BATCH', '新增批处理');
	define('BATCH_PWD', '密码：');
	define('BATCH_PWD_INPUT', '请输入密码！');
	
	//PO录入
	define('TITLE_PO', 'PO');
	define('PO_HISTORY', '历史');
	define('PO_LOCATION', '当前位置：');
	define('PO_TITLE', 'PO 录入> 历史 PO');
	define('ADD_PO', '新增 PO');
	
	//ETC
	define('ETC_DELETE', '一键清零');
	
	// 项目搜索
	define('USER_REALNAME', '用户信息');
	define('CREATE_DATE', '创建时间');
	define('CREATE_DATE_TO', '至');
	define('SEARCH', '搜索');
	define('CREATE_PRJ', '创建项目');
	define('UPDATE_PRJ', '编辑项目');
	define('PRJ_PRINT', '打 印');
	define('CURRENT_LOCATION', '当前位置：');
	define('DOWNLOAD', '下载模板');
	
	// 项目
	// define('PROJECT_MANAGEMENT', '项目管理');
	define('PROJECT', '项目');
	define('PRJ_SN', '项目编号');
	define('PRJ_NAME', '项目名称');
	define('PRJ_STATUS', '项目进度');
	define('PRJ_STATUS_ALL', '全部');
	define('PRJ_STATUS_READYING', '筹备');
	define('PRJ_STATUS_ONGOING', '拍摄');
	define('PRJ_STATUS_POST', '后期');
	define('PRJ_STATUS_FINISH', '完片');
	define('PRJ_STATUS_DISABLE', '搁置');
	define('DIRECTOR', '导演');
	define('LEADING_STAR_1', '1#主演');
	define('LEADING_STAR_2', '2#主演');
	define('LEADING_STAR_3', '3#主演');
	define('LEADING_STAR_4', '4#主演');
	define('INVESTMENT_COMPANY_1', '1#投资公司');
	define('INVESTMENT_COMPANY_2', '2#投资公司');
	define('INVESTMENT_COMPANY_3', '3#投资公司');
	define('MISS_PRJ_SN', '请填写项目编号！');
	define('MISS_PRJ_NAME', '请填写项目名称！');
	// 项目预算
	define('DEL_BUDGET', '删除');
	define('HIS_BUDGET', '历史记录');
	define('RECOVERY_BUDGET', '恢复记录');
	define('EXPLAIN', '下载说明');

	// 账户
	define('CREATE_ACCOUNT', '创建账号');
	define('SET_ACCOUNT', ' 账号设置');
	define('USER_EMPCODE', '用户名');
	define('POSITION_NAME', '用户等级');
	define('USER_PASSWORD', '密码重置');
	define('USER_PASSWORD_OLD', '初始密码');
	define('NO_USER_PASSWORD', '此处为空则不修改密码');
	define('USER_STATUS_NAME', '用户状态');
		define('USER_STATUS_ONGOING', '使用中');
		define('USER_STATUS_DISABLE', '已停用');
	// define('USER_REALNAME', '用户信息');
	define('MISS_USER_EMPCODE', '请填写用户名！');
	define('MISS_USER_REALNAME', '请填写用户信息！');

	// 用户权限
	define('LOGIN_TIME_OUT', '用户已失效，请重新登录系统！');
	define('USER_DISABLE', '账号已被停用！');
	define('USER_NO_PERMISSION', '该账号没有相应的操作权限！');

	define('PASS_OLD', '原密码：');
	define('MISS_PASS_OLD', '原密码不可为空！');
	define('PASS_NEW', '新密码：');
	define('MISS_PASS_NEW', '新密码不可为空！');
	define('PASS_NEW_SURE', '确认新密码：');
	define('MISS_PASS_NEW_SURE', '确认新密码不可为空！');
	define('UPDATE_PASS', '修改密码');
	define('SAVE', '保存');
	define('CANCLE', '取消');
	define('CONFIRM', '确定');

	// 报表
	define('CURRENT_START_TIME', '本期开始时间');
	define('SEARCH_REPORT', '运行报表');
	define('CURRENT_TYPE', '货币设定');
	define('CURRENT_TYPE_VIEW', '标签');
	define('CURRENT_TYPE_VIEW_SAVE', '保存标签');
	define('CURRENT_TYPE_VIEW_DEL', '删除标签');
	define('CURRENT_TYPE_MIX', '混合');
	define('CURRENT_TYPE_NO', '非混合');
	define('REPORT_MAIN_SUB', '成本预算(3级)');
	define('REPORT_MAIN', '成本预算(2级)');
	define('REPORT_TOP', '成本预算(1级)');
	define('BATCH_RECORDS', '批处理');
	define('PO_RECORDS', 'PO处理');
	define('BALANCE', '资产报告(2级)');
	define('BALANCE_MAIN', '资产报告(1级)');
	define('ALL_DETAIL', '全部明细');
	define('CURRENT_TIME', '本期时间');
	define('TRANSACTION_CODE_REPORT', '单号');
	define('BATCH_CODE_REPORT', '批处理名');
	define('DESC_REPORT', '描述');
	define('TRIAL_BALANCE', '试算平衡');
	define('TOTAL_COST', '成本总额');
	define('TOTAL_CAPITAL', '资金总额');
	define('TOTAL_BALANCE', '合计');
	define('REPORT_CLEAR','重置');
	define('REPORT_ASSETS','资产');
	define('REPORT_NOT_ASSETS','非资产');
	
	//凭证
	define('VOUCHERS','凭证扫描');
	define('VOUCHERS_ADD','新增凭证');
	define('CONTRACT_ADD','新增合同');
	define('VOUCHERS_NAME','凭证名称：');
	define('VOUCHERS_PIC','凭证图片：');
	define('VOUCHERS_MESSAGE1','请填写凭证名称');
	define('VOUCHERS_MESSAGE2','选择文件');
	define('REPORT_SEARCH_DATE', '日期');
	define('REPORT_CHOOSE', '选择文件');
?>