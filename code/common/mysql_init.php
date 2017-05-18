<?php
//database configure
include 'mysql_conn.php';

//判断请求方式
$requestParamArr = array_merge($_POST,$_GET);

//Views in database
$View_PRE = 'v_';

//Tables in database
$Table_PRE = 't_';

$MemberTable = $Table_PRE . 'member';
$MemberRechargeTable = $Table_PRE . 'member_recharge';
$MemberConsumeTable = $Table_PRE . 'member_consume';
$MemberLeveTable = $Table_PRE.'member_level';
$MemberLoginRecordTable = $Table_PRE.'member_login_record';

$StoreTable = $Table_PRE.'store';
$StoreDiscountTable = $Table_PRE.'store_discount';

$SysDiscountTable = $Table_PRE.'discount';

$PointsRuleTable = $Table_PRE.'rule_points';
$ActivityRuleTable = $Table_PRE.'rule_activity';
$ActivityDetailTable = $Table_PRE.'rule_activity_detail';

$UserTable = $Table_PRE . 'sys_user';
$RoleTable = $Table_PRE.'sys_role';
$UserRoleTable = $Table_PRE.'sys_userrole';
$ResourceTable = $Table_PRE.'sys_resource';
$ResourceParentTable = $Table_PRE.'sys_resourceparent';
$RoleResourceTable = $Table_PRE.'sys_roleresource';

$ReportTable = $Table_PRE."report_record";
$ConsumeReportTable = $Table_PRE."report_consume";
$RechargeReportTable = $Table_PRE."report_recharge";
$ReportDetailTable = $Table_PRE."report_detail";


//test
mysql_pconnect($db_host, $db_user, $db_password);
mysql_select_db($db_database);

mysql_query("SET NAMES 'utf8'");
mysql_query("SET CHARACTER_SET_CLIENT=utf8");
mysql_query("SET CHARACTER_SET_RESULTS=utf8");

mysql_query("SET NAMES 'utf8'");
mysql_query("SET CHARACTER_SET_CLIENT=utf8");
mysql_query("SET CHARACTER_SET_RESULTS=utf8");

//定义时区
date_default_timezone_set('Asia/Shanghai'); 

/*============================用户表操作=================================*/
$saveUser = "insert into $UserTable (user_username,user_password,user_realname,user_certificateNO,user_mobile,user_status,user_img,user_desc,create_date,create_by,store_id) values ('%s','%s','%s','%s','%s',%s,'%s','%s','%s',%s,%s)";
$queryUser = "select user_id,store_id,user_status,user_empcode,user_realname,user_certificateNO,user_mobile,user_img,user_desc from $UserTable ";
$updateUser = "update $UserTable set user_mobile = '%s', user_status = %s, user_img = '%s', user_desc = '%s' where user_id = %s ";
$queryTotalUserNum = "select count(user_id) from $UserTable u1 ";
$relatedQueryUser = "select u1.user_id,u1.user_username,u1.user_realname,u1.user_certificateNO,u1.user_mobile,u1.user_status,u1.user_img,u1.user_desc,u1.create_date,u1.create_by,u2.user_username as created_username,u2.user_realname as created_realname,s.store_name from $UserTable u1 left join($UserTable u2, $StoreTable s) on (u1.create_by = u2.user_id and u1.store_id = s.store_id) ";

/*===========================用户角色==============================*/
$saveUserRole = "insert into $UserRoleTable (user_id,role_id) values (%s,%s) ";
$deleteUserRole = "delete from $UserRoleTable where user_id = %s ";
$queryUserRole = "select ur.role_id from $UserRoleTable ur left join $RoleTable r on(ur.role_id = r.role_id ) where ur.user_id = %s and r.role_status=1 ";

/*============================角色管理==================================*/
$saveRole = "insert into $RoleTable(role_name,role_code,create_date,role_status,create_by,store_id,role_desc)values('%s','%s','%s',%s,%s,%s,'%s') ";
$queryRole = "select role_id,role_name,role_code,create_date,role_status,create_by,store_id from $RoleTable ";
$updateRole = "update $RoleTable set role_name = '%s', role_code = '%s', role_status = %s,role_desc = '%s' where role_id = %s ";
$queryTotalRoleNum = "select count(role_id) from $RoleTable r ";
$relateQueryRole = "select role_id,role_name,role_code,r.create_date,role_status,role_desc,u.user_username,u.user_realname,s.store_name from $RoleTable r left join($UserTable u, $StoreTable s) on(r.create_by = u.user_id and r.store_id=s.store_id) ";

/*===========================角色资源权限=============================*/
$saveRoleResource = "insert into $RoleResourceTable (role_id,resource_id) values(%s,%s) ";
$delecteRoleResource = "delete from $RoleResourceTable where role_id=%s ";
$queryRoleResource = "select distinct rr.resource_id from $RoleResourceTable rr left join $ResourceTable r on (rr.resource_id = r.resource_id ) where r.resource_status=1 and rr.role_id in ('%s') ";

/*===========================资源父目录==================================*/
$saveResourceParent = "insert into $ResourceParentTable(resourceparent_name) values('%s') ";
$queryResourceParent = "select resourceparent_id,resourceparent_name,resourceparent_status,resourceparent_desc,create_by,create_date from $ResourceParentTable ";

/*============================资源管理==================================*/
$saveResource = "insert into $ResourceTable(resource_name,resource_url,resource_status,resource_desc,create_date,create_by,resource_type,resourceparent_id)values('%s', '%s', %s, '%s', '%s',%s, %s, %s) ";
$queryResource = "select resource_id,resource_name,resource_url,resource_status,resource_desc,create_date,create_by,resource_type,resourceparent_id from $ResourceTable ";
$updateResource = "update $ResourceTable set resource_name = '%s', resource_url = '%s', resource_status = %s, resource_desc = '%s', resource_type = %s, resourceparent_id = %s where resource_id = %s ";
$queryTotalResourceNum = "select count(resource_id) from $ResourceTable r ";
$relateQueryResource = "select resource_id,resource_name,resource_url,resource_status,resource_desc,resource_type,r.create_date,u.user_username,u.user_realname,r.resourceparent_id,p.resourceparent_name from $ResourceTable r left join ($UserTable u, $ResourceParentTable p ) on (r.create_by = u.user_id and r.resourceparent_id = p.resourceparent_id) ";

/*============================商家表操作================================*/
$saveStore = "insert into $StoreTable(store_name,store_code,store_bizType,store_tel,store_picture,store_charge_name,store_charge_mobile,store_charge_picture,store_charge_certificateNO,store_address,store_desc,create_date,create_by)values('%s','%s',%s,'%s','%s','%s','%s','%s','%s','%s','%s','%s',%s)";
$queryTotalStoreNum = "select count(s.store_id) from $StoreTable s ";
$relatedQueryStore = "select s.store_id,store_name,store_code,store_bizType,store_tel,store_picture,store_charge_name,store_charge_mobile,store_charge_picture,store_charge_certificateNO,store_address,store_desc,s.create_date,u.user_username,u.user_realname from $StoreTable s left join $UserTable u on s.create_by = u.user_id ";
$excelExportStore = "select store_name,store_code,store_tel,store_charge_name,store_charge_mobile,store_charge_certificateNO,store_address,s.create_date,u.user_realname,store_desc from $StoreTable s left join $UserTable u on s.create_by = u.user_id ";
$queryStore = "select store_id,store_name,store_code,store_bizType,store_tel,store_picture,store_charge_name,store_charge_mobile,store_charge_picture,store_charge_certificateNO,store_address,store_desc,create_date,create_by from $StoreTable ";
$queryStoreCode = "select store_code from $StoreTable where store_id = %s ";
$deleteStore = "delete from $StoreTable where store_id = %s ";
$updateStore = "update $StoreTable set store_bizType=%s,store_tel='%s',store_picture='%s',store_charge_name='%s',store_charge_mobile='%s',store_charge_picture='%s',store_charge_certificateNO='%s',store_address='%s',store_desc='%s' where store_id=%s";

/*============================平台折扣==================================*/
$saveSysDiscount = "insert into $SysDiscountTable(discount_rate,store_id,discount_desc,create_date,create_by)values(%s,%s,'%s','%s',%s) ";
$updateSysDiscount = "update $SysDiscountTable set discount_rate=%s,discount_desc='%s' where discount_id=%s ";
$queryTotalSysDiscountNum = "select count(discount_id) from $SysDiscountTable d left join $StoreTable s on d.store_id = s.store_id ";
$relateQuerySysDiscount = "select discount_id,d.store_id,discount_rate,discount_desc,d.create_date,u.user_username,u.user_realname,s.store_name,s.store_code from $SysDiscountTable d left join ($UserTable u, $StoreTable s) on (d.create_by = u.user_id and d.store_id = s.store_id) ";
$querySysDiscountByCondition = "select discount_rate from $SysDiscountTable ";

/*============================商家折扣==================================*/
$saveStoreDiscount = "insert into $StoreDiscountTable(store_id,member_level_id,store_discount_rate,store_discount_desc,create_date,create_by)values(%s,%s,%s,'%s','%s',%s)";
$updateStoreDiscount = "update $StoreDiscountTable set store_discount_rate=%s,store_discount_desc='%s' where store_discount_id=%s ";
$queryTotalStoreDiscountNum = "select count(store_discount_id) from $StoreDiscountTable ";
$relateQueryStoreDiscount = "select store_discount_id,d.store_id,store_discount_rate,store_discount_desc,d.create_date,u.user_username,u.user_realname,s.store_name,s.store_code,l.member_level_name,d.member_level_id from $StoreDiscountTable d left join ($UserTable u, $StoreTable s, $MemberLeveTable l) on (d.store_id = s.store_id and d.create_by = u.user_id and d.member_level_id = l.member_level_id) ";
$queryStoreDiscountByCondition = "select store_discount_rate from $StoreDiscountTable ";

/*============================积分规则===================================*/
$savePointsRule = "insert into $PointsRuleTable(amount_rate,receive_type,points_desc,create_date,create_by,points_state)values(%s,%s,'%s','%s',%s,%s)";
$updatePointsRule = "update $PointsRuleTable set amount_rate=%s,receive_type=%s,points_desc='%s',points_state=%s where points_id=%s ";
$updatePointsState = "update $PointsRuleTable set points_state=%s where receive_type=%s and points_state=%s ";
$queryTotalPointsRuleNum = "select count(p.points_id) from $PointsRuleTable p ";
$relateQueryPointRule = "select points_id,amount_rate,receive_type,points_desc,points_state,p.create_date,u.user_username,u.user_realname from $PointsRuleTable p left join $UserTable u on p.create_by = u.user_id ";
$queryPointsRuleByCondition = "select amount_rate from $PointsRuleTable ";

/*==================================活动规则==============================*/
$saveActivityRule = "insert into $ActivityRuleTable(activity_name,activity_status,activity_start_datetime,activity_end_datetime,activity_desc,create_date,create_by) values('%s',%s,'%s','%s','%s','%s',%s) ";
$saveActivityDetail = "insert into $ActivityDetailTable(activity_id,min_recharge_amount,max_recharge_amount,activity_reward_type,activity_reward) values(%s, %s, %s, %s, %s) ";
$deleteActivityDetail = "delete from $ActivityDetailTable where activity_id=%s ";
$queryTotalActivityRule = "select count(a.activity_id) from $ActivityRuleTable a ";
$queryActivityRule = "select activity_id,activity_status,activity_name, activity_start_datetime, activity_end_datetime, activity_desc, create_date, create_by from $ActivityRuleTable ";
$relateQueryActivityRule = "select a.activity_id,a.activity_status,a.activity_name, a.activity_start_datetime, a.activity_end_datetime, a.activity_desc, a.create_date, u.user_realname from $ActivityRuleTable a left join $UserTable u on (a.create_by = u.user_id) ";
$queryCurrentActivityRule = "select a.activity_id, a.activity_name, ad.min_recharge_amount, ad.max_recharge_amount, ad.activity_reward_type, ad.activity_reward from $ActivityRuleTable a left join $ActivityDetailTable ad on(a.activity_id = ad.activity_id) where a.activity_status = %s and a.activity_start_datetime <= '%s' and a.activity_end_datetime >= '%s' "; 
$queryActivityDetail = "select activity_detail_id,activity_id,min_recharge_amount,max_recharge_amount,activity_reward_type,activity_reward from $ActivityDetailTable ";
$updateActivityRule = "update $ActivityRuleTable set activity_name='%s', activity_status=%s, activity_start_datetime='%s', activity_end_datetime='%s',activity_desc='%s' where activity_id = %s ";

/*============================会员等级==================================*/
$saveMemberLevel = "insert into $MemberLeveTable(member_level_name,member_level_code,member_level_desc,minmum_first_charge,minmum_every_charge,create_date,create_by)values('%s','%s','%s',%s,%s,'%s',%s)";
$updateMemberLevel = "update $MemberLeveTable set member_level_name='%s', member_level_code='%s',member_level_desc='%s',minmum_first_charge=%s,minmum_every_charge=%s where member_level_id=%s ";
$queryTotalMemberLevelNum = "select count(member_level_id) from $MemberLeveTable ";
$relateQueryMemberLevel = "select member_level_id,member_level_name,member_level_code,member_level_desc,minmum_first_charge,minmum_every_charge,l.create_date,u.user_username,u.user_realname from $MemberLeveTable l left join $UserTable u on(l.create_by = u.user_id) ";
$queryChargeNumByCondition = "select minmum_first_charge, minmum_every_charge from $MemberLeveTable ";

/*===========================会员表操作=================================*/
$saveMember = "insert into $MemberTable(member_gender,member_name,member_mobile,member_certificateType,member_certificateNO,member_img,member_card,member_loginPassword,member_consumePassword,member_level_id,create_date,create_by) values(%s,'%s','%s',%s,'%s','%s','%s','%s','%s',%s,'%s',%s) ";
$updateMemberCode = "update $MemberTable set member_code='%s' where member_id = %s ";
$updateMemberBaseInfo = " update $MemberTable set member_name='%s',member_level_id=%s,member_gender=%s where member_id = %s ";
$updateMemberLoginPassword = "update $MemberTable set member_loginPassword = '%s' where member_id = %s and member_loginPassword = '%s' ";
$updateMemberConsumePassword = "update $MemberTable set member_consumePassword = '%s' where member_id = %s ";
$updateMembetImg = "update $MemberTable set member_img = '%s' where member_id = %s ";
$queryTotalMember = "select count(m.member_id) from $MemberTable m ";
$relateQueryMember = "select member_id,member_name,member_gender,member_mobile,member_certificateType,member_certificateNO,member_img,member_code,member_card,m.member_level_id,l.member_level_name,m.create_date,u.user_username,u.user_realname,m.member_balance,m.member_points_current,m.member_points_total from $MemberTable m left join ($UserTable u ,$MemberLeveTable l )on(m.create_by = u.user_id and m.member_level_id = l.member_level_id) ";
$excelExportMember = "select member_name,member_card,member_mobile,member_certificateNO,l.member_level_name,m.member_balance,m.member_points_current,m.member_points_total,m.create_date,u.user_realname from $MemberTable m left join ($UserTable u ,$MemberLeveTable l )on(m.create_by = u.user_id and m.member_level_id = l.member_level_id) ";
$queryMember = "select member_id,member_name,member_mobile,member_certificateType,member_certificateNO,member_img,member_code,member_card,member_level_id,create_date,create_by from $MemberTable  ";

/*==========================保存会员登陆记录==============================*/
$saveMemberLoginRecord = "insert into $MemberLoginRecordTable(login_member_id,login_ip,login_datetime,login_address,login_country_id,login_country,login_area_id,login_area,login_region_id,login_region,login_city_id,login_city,login_county_id,login_county,login_isp_id,login_isp) values(%s,'%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s')";

/*============================会员充值============================*/
$saveRechargeRecord = "insert into $MemberRechargeTable(member_id,recharge_status,recharge_amount,receive_points,recharge_type,recharge_desc,store_id,create_date,create_by,activity_reward) values(%s, %s, %s, %s, %s,'%s',%s,'%s',%s,%s) ";
$updateRechargeCode = "update $MemberRechargeTable set recharge_code='%s' where recharge_id = %s ";
$updateRechargeStatus = "update $MemberRechargeTable set recharge_status = %s where recharge_code = %s ";
$updateMemberByRecharge = "update $MemberTable set member_balance = member_balance + %s, member_points_total = member_points_total + %s, member_points_current = member_points_current + %s where member_id = %s ";
$queryRechargeRecordByRechargeCode = "select recharge_id,recharge_code, recharge_amount, recharge_type,recharge_status,member_id from $MemberRechargeTable where recharge_code = '%s' ";
$queryTotalRechangeRecord = "select count(recharge_id) from $MemberRechargeTable r LEFT JOIN $MemberTable m on r.member_id = m.member_id ";
$relateQueryRechargeRecord = "select recharge_id,recharge_code, recharge_amount, recharge_type, recharge_status, receive_points, activity_reward,r.create_date, r.create_by,m.member_name,m.member_img, m.member_mobile, m.member_card,l.member_level_id, l.member_level_name, s.store_name, s.store_address,u.user_username,u.user_realname from $MemberRechargeTable r LEFT JOIN ($MemberTable m, $StoreTable s,$MemberLeveTable l,$UserTable u) on (r.member_id = m.member_id and r.store_id = s.store_id and m.member_level_id = l.member_level_id and r.create_by = u.user_id) ";
$excelExportRechargeRecord = "select recharge_code, recharge_amount, activity_reward, receive_points, m.member_name,m.member_mobile, m.member_card,l.member_level_name, s.store_name,r.create_date,u.user_realname from $MemberRechargeTable r LEFT JOIN ($MemberTable m, $StoreTable s,$MemberLeveTable l,$UserTable u) on (r.member_id = m.member_id and r.store_id = s.store_id and m.member_level_id = l.member_level_id and r.create_by = u.user_id) ";
$queryTotalRechargeRecordByCondition = "select count(recharge_id) from $MemberRechargeTable ";

/*=====================会员消费=====================================*/
$saveConsumeRecord = "insert into $MemberConsumeTable(discount_rate_sys,discount_rate_store,discount_rate_real,amount_standard,amount_sys,amount_store,amount_real,receive_points,member_id,store_id,create_by,create_date,consume_desc) values(%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,'%s','%s') ";
$updateConsumeCode = "update $MemberConsumeTable set consume_code = '%s' where consume_id=%s ";
$updateMemberByConsume = "update $MemberTable set member_balance = member_balance - %s, member_points_total = member_points_total + %s, member_points_current = member_points_current + %s where member_id = %s ";
$queryTotalConsumeRecord = "select count(consume_id) from $MemberConsumeTable c left join ($MemberTable m, $StoreTable s,$MemberLeveTable l,$UserTable u) on (c.member_id = m.member_id and c.store_id = s.store_id and m.member_level_id = l.member_level_id and c.create_by = u.user_id) ";
$relateQueryConsumeRecord = "select consume_id, amount_standard, discount_rate_real, amount_real,receive_points,c.create_date, c.create_by, m.member_name,m.member_img, m.member_mobile, m.member_card,l.member_level_id, l.member_level_name, s.store_name, s.store_address,u.user_username,u.user_realname from $MemberConsumeTable c left join ($MemberTable m, $StoreTable s,$MemberLeveTable l,$UserTable u) on (c.member_id = m.member_id and c.store_id = s.store_id and m.member_level_id = l.member_level_id and c.create_by = u.user_id) ";
$excelExportConsumeRecord = "select consume_code, amount_standard, discount_rate_real, amount_real,receive_points, m.member_name, m.member_mobile, m.member_card, l.member_level_name, s.store_name,c.create_date,u.user_realname from $MemberConsumeTable c left join ($MemberTable m, $StoreTable s,$MemberLeveTable l,$UserTable u) on (c.member_id = m.member_id and c.store_id = s.store_id and m.member_level_id = l.member_level_id and c.create_by = u.user_id) ";


/*=======================账单核对====================================*/
$saveConsumeReport = "insert into $ConsumeReportTable (consume_id,consume_code,discount_rate_sys,discount_rate_store,discount_rate_real,amount_standard,amount_sys,amount_store,amount_real,receive_points,member_id,store_id,create_by,create_date,consume_desc)values(%s,'%s',%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,'%s','%s') ";
$saveRechargeReport = "insert into $RechargeReportTable (recharge_id,recharge_code,member_id,recharge_amount,receive_points,recharge_type,recharge_desc,store_id,create_date,create_by,activity_reward) values (%s,'%s',%s, %s, %s, %s,'%s',%s,'%s',%s,%s)";

$queryTotalConsumeReportNum = "select count(report_consume_id) from $ConsumeReportTable c left join ($MemberTable m, $StoreTable s,$MemberLeveTable l,$UserTable u1) on (c.member_id = m.member_id and c.store_id = s.store_id and m.member_level_id = l.member_level_id and c.create_by = u1.user_id) left join $UserTable u2 on c.store_confirm_by = u2.user_id left join $UserTable u3 on c.sys_confirm_by = u3.user_id ";
$relateQueryConsumeReport = "select report_consume_id, consume_id, consume_code, discount_rate_sys,discount_rate_store, discount_rate_real, amount_standard,amount_sys,amount_store,amount_real,receive_points,consume_desc,c.create_date,store_confirm, store_confirm_time,store_confirm_desc,sys_confirm,sys_confirm_time,sys_confirm_desc, m.member_name,m.member_img, m.member_mobile, m.member_card,l.member_level_id, l.member_level_name, s.store_name, u1.user_realname as create_by,u2.user_realname as store_confirm_by, u3.user_realname as sys_confirm_by from $ConsumeReportTable c left join ($MemberTable m, $StoreTable s,$MemberLeveTable l,$UserTable u1) on (c.member_id = m.member_id and c.store_id = s.store_id and m.member_level_id = l.member_level_id and c.create_by = u1.user_id) left join $UserTable u2 on c.store_confirm_by = u2.user_id left join $UserTable u3 on c.sys_confirm_by = u3.user_id ";

$queryTotalRechargeReportNum = "select count(report_recharge_id) from $RechargeReportTable r left join ($MemberTable m, $StoreTable s,$MemberLeveTable l,$UserTable u1) on (r.member_id = m.member_id and r.store_id = s.store_id and m.member_level_id = l.member_level_id and r.create_by = u1.user_id) left join $UserTable u2 on r.store_confirm_by = u2.user_id left join $UserTable u3 on r.sys_confirm_by = u3.user_id ";
$relateQueryRechargeReport = "select report_recharge_id,recharge_id,recharge_code, recharge_amount, recharge_type, receive_points,recharge_desc, r.create_date, m.member_name,m.member_img, m.member_mobile, m.member_card,l.member_level_id, l.member_level_name, s.store_name, store_confirm, store_confirm_time,store_confirm_desc,sys_confirm,sys_confirm_time,sys_confirm_desc,u1.user_realname as create_by,u2.user_realname as store_confirm_by, u3.user_realname as sys_confirm_by from $RechargeReportTable r left join ($MemberTable m, $StoreTable s,$MemberLeveTable l,$UserTable u1) on (r.member_id = m.member_id and r.store_id = s.store_id and m.member_level_id = l.member_level_id and r.create_by = u1.user_id) left join $UserTable u2 on r.store_confirm_by = u2.user_id left join $UserTable u3 on r.sys_confirm_by = u3.user_id ";

$updateConsumeReportByStoreConfirm = "update $ConsumeReportTable set store_confirm = %s, store_confirm_by = %s,store_confirm_time = '%s',store_confirm_desc = CONCAT(store_confirm_desc,'%s') where report_consume_id = %s ";
$updateConsumeReportBySysConfirm = "update $ConsumeReportTable set sys_confirm = %s, sys_confirm_by = %s, sys_confirm_time = '%s', sys_confirm_desc=concat(sys_confirm_desc,'%s')  where report_consume_id = %s ";
$updateRechargeReportByStoreConfirm = "update $RechargeReportTable set store_confirm = %s, store_confirm_by = %s, store_confirm_time = '%s',store_confirm_desc = CONCAT(store_confirm_desc,'%s') where report_recharge_id = %s ";
$updateRechargeReportBySysConfirm = "update $RechargeReportTable set sys_confirm = %s,sys_confirm_by = %s,sys_confirm_time = '%s',sys_confirm_desc=concat(sys_confirm_desc,'%s')  where report_recharge_id = %s ";


/*====================================报表===============================*/
$queryTotalConsumeAmount = "select sum(amount_standard) as report_amount from $ConsumeReportTable ";
$queryReportId = "select report_id from $ReportTable ";
$queryReportConsumeId = "select report_consume_id from $ConsumeReportTable "; 
$saveReport = "insert into $ReportTable (report_date,report_date_type,report_type,report_amount,create_date,create_by,store_id) values ('%s',%s,%s,%s,'%s',%s,%s) ";
$saveReportDetail = "insert into $ReportDetailTable (report_id,detail_record_id) values (%s,%s) ";

$queryTotalRechargeAmount = "select sum(recharge_amount) as report_amount from $RechargeReportTable ";
$queryReportRechargeId = "select report_recharge_id from $RechargeReportTable ";

$queryTotalReportRecordNum = "select count(report_id) from $ReportTable r ";
$relateQueryReportRecord = "select report_id,report_date,report_date_type,report_type,report_amount,r.create_date,u.user_realname from $ReportTable r left join $UserTable u on r.create_by=u.user_id ";
$excelExportReportRecord = "select report_date,report_date_type,report_type,report_amount,r.create_date,u.user_realname from $ReportTable r left join $UserTable u on r.create_by=u.user_id ";

$queryDetailIdByReportId = "select detail_record_id from $ReportDetailTable where report_id = %s ";

$queryConsumeReportDetail = "select report_consume_id, consume_id, consume_code, discount_rate_sys,discount_rate_store, discount_rate_real, amount_standard,amount_sys,amount_store,amount_real,receive_points,consume_desc,c.create_date,store_confirm, store_confirm_time,store_confirm_desc,sys_confirm,sys_confirm_time,sys_confirm_desc, m.member_name,m.member_img, m.member_mobile, m.member_card,l.member_level_id, l.member_level_name, s.store_name, u1.user_realname as create_by,u2.user_realname as store_confirm_by, u3.user_realname as sys_confirm_by from $ConsumeReportTable c left join ($MemberTable m, $StoreTable s,$MemberLeveTable l,$UserTable u1) on (c.member_id = m.member_id and c.store_id = s.store_id and m.member_level_id = l.member_level_id and c.create_by = u1.user_id) left join $UserTable u2 on c.store_confirm_by = u2.user_id left join $UserTable u3 on c.sys_confirm_by = u3.user_id ";
$excelExportConsumeReport = "select consume_code, discount_rate_sys,discount_rate_store, discount_rate_real, amount_standard,amount_sys,amount_store,amount_real,receive_points,consume_desc,c.create_date, u1.user_realname as create_by, m.member_name,l.member_level_name, s.store_name,store_confirm, store_confirm_time,u2.user_realname as store_confirm_by,store_confirm_desc,sys_confirm,sys_confirm_time, u3.user_realname as sys_confirm_by,sys_confirm_desc from $ConsumeReportTable c left join ($MemberTable m, $StoreTable s,$MemberLeveTable l,$UserTable u1) on (c.member_id = m.member_id and c.store_id = s.store_id and m.member_level_id = l.member_level_id and c.create_by = u1.user_id) left join $UserTable u2 on c.store_confirm_by = u2.user_id left join $UserTable u3 on c.sys_confirm_by = u3.user_id where c.report_consume_id in ('%s') ";
$queryRechargeReportDetail = "select report_recharge_id,recharge_id,recharge_code, activity_reward,recharge_amount, recharge_type, receive_points,recharge_desc, r.create_date, m.member_name,m.member_img, m.member_mobile, m.member_card,l.member_level_id, l.member_level_name, s.store_name, store_confirm, store_confirm_time,store_confirm_desc,sys_confirm,sys_confirm_time,sys_confirm_desc,u1.user_realname as create_by,u2.user_realname as store_confirm_by, u3.user_realname as sys_confirm_by from $RechargeReportTable r left join ($MemberTable m, $StoreTable s,$MemberLeveTable l,$UserTable u1) on (r.member_id = m.member_id and r.store_id = s.store_id and m.member_level_id = l.member_level_id and r.create_by = u1.user_id) left join $UserTable u2 on r.store_confirm_by = u2.user_id left join $UserTable u3 on r.sys_confirm_by = u3.user_id ";
$excelExportRechargeReport = "select recharge_code, recharge_amount, activity_reward, receive_points,recharge_desc, r.create_date,u1.user_realname as create_by, m.member_name,l.member_level_name, s.store_name, store_confirm, store_confirm_time,u2.user_realname as store_confirm_by,store_confirm_desc,sys_confirm,sys_confirm_time, u3.user_realname as sys_confirm_by,sys_confirm_desc from $RechargeReportTable r left join ($MemberTable m, $StoreTable s,$MemberLeveTable l,$UserTable u1) on (r.member_id = m.member_id and r.store_id = s.store_id and m.member_level_id = l.member_level_id and r.create_by = u1.user_id) left join $UserTable u2 on r.store_confirm_by = u2.user_id left join $UserTable u3 on r.sys_confirm_by = u3.user_id where r.report_recharge_id in ('%s') ";
?>

