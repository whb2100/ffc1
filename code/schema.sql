/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     2017/2/20 9:58:01                            */
/*==============================================================*/


drop   view   if   exists   v_sys_user;

drop   view   if   exists   v_sys_roleresource;

drop   view   if   exists   v_his_project_code;

drop   view   if   exists   v_biz_project_main_code;

drop   view   if   exists   v_biz_project_info;

drop   view   if   exists   v_biz_project_currency;

drop   view   if   exists   v_biz_project_code;

drop   view   if   exists   v_biz_po_region_main_code;

drop   view   if   exists   v_biz_po_main_sub_code;

drop   view   if   exists   v_biz_po_info;

drop   view   if   exists   v_biz_po_check_transaction_detial;

drop   view   if   exists   v_biz_po_check_transaction_code;

drop   view   if   exists   v_biz_batch_region_main_code;

drop   view   if   exists   v_biz_batch_main_sub_code;

drop   view   if   exists   v_biz_batch_info;

drop   view   if   exists   v_biz_batch_check_transaction_detial;

drop   view   if   exists   v_biz_batch_check_transaction_code;

drop table if exists t_biz_batch_info;

drop table if exists t_biz_currency_code;

drop table if exists t_biz_currency_type;

drop table if exists t_biz_po_info;

drop table if exists t_biz_po_transaction_detail;

drop table if exists t_biz_po_transaction_info;

drop table if exists t_biz_project_code;

drop table if exists t_biz_project_company;

drop table if exists t_biz_project_currency;

drop table if exists t_biz_project_director;

drop table if exists t_biz_project_ect_code;

drop table if exists t_biz_project_free;

drop table if exists t_biz_project_info;

drop table if exists t_biz_project_main_actor;

drop table if exists t_biz_project_region;

drop table if exists t_biz_project_scene;

drop table if exists t_biz_project_status;

drop table if exists t_biz_report_view_detail;

drop table if exists t_biz_report_view_info;

drop table if exists t_biz_statistics_level;

drop table if exists t_biz_transaction_detail;

drop table if exists t_biz_transaction_info;

drop table if exists t_biz_vouchers_info;

drop table if exists t_his_project_code;

drop table if exists t_sys_resource;

drop table if exists t_sys_role;

drop table if exists t_sys_roleresource;

drop table if exists t_sys_user;

drop table if exists t_sys_user_log;

drop table if exists t_sys_user_position;

drop table if exists t_sys_user_status;

/*==============================================================*/
/* Table: t_biz_batch_info                                      */
/*==============================================================*/
create table t_biz_batch_info
(
   batch_id             int not null auto_increment comment '系统ID',
   batch_code           varchar(50) comment '批处理编号 同一项目下的编号唯一 需要检测重复',
   project_id           int comment '项目编号 对应 t_biz_project_info',
   currency_id          int comment '货币ID 对应 t_biz_project_currency',
   status               int comment '状态 1-初建 2-已提交',
   create_date          datetime comment '创建日期',
   create_by            int comment '创建人 关联表 t_sys_user',
   last_update_date     datetime comment '最后修改时间',
   last_update_by       int comment '最后修改人 关联表 t_sys_user',
   primary key (batch_id)
);

alter table t_biz_batch_info comment '批处理信息表';

/*==============================================================*/
/* Table: t_biz_currency_code                                   */
/*==============================================================*/
create table t_biz_currency_code
(
   currency_code_id     int not null comment '货币ID',
   currency_code        varchar(30) comment '货币代码',
   currency_desc        varchar(100) comment '货币代码的描述',
   primary key (currency_code_id)
);

alter table t_biz_currency_code comment '货币代码表';

/*==============================================================*/
/* Table: t_biz_currency_type                                   */
/*==============================================================*/
create table t_biz_currency_type
(
   currency_type_id     int not null auto_increment comment '货币种类ID',
   currency_type        varchar(30) comment '货币种类',
   currency_desc        varchar(100) comment '货币种类的描述',
   primary key (currency_type_id)
);

alter table t_biz_currency_type comment '货币种类';

/*==============================================================*/
/* Table: t_biz_po_info                                         */
/*==============================================================*/
create table t_biz_po_info
(
   batch_id             int not null auto_increment comment '系统ID',
   batch_code           varchar(50) comment '批处理编号 同一项目下的编号唯一 需要检测重复',
   project_id           int comment '项目编号 对应 t_biz_project_info',
   currency_id          int comment '货币ID 对应 t_biz_project_currency',
   status               int comment '状态 1-初建 2-已提交',
   create_date          datetime comment '创建日期',
   create_by            int comment '创建人 关联表 t_sys_user',
   last_update_date     datetime comment '最后修改时间',
   last_update_by       int comment '最后修改人 关联表 t_sys_user',
   primary key (batch_id)
);

alter table t_biz_po_info comment 'PO信息表';

/*==============================================================*/
/* Table: t_biz_po_transaction_detail                           */
/*==============================================================*/
create table t_biz_po_transaction_detail
(
   detail_id            int not null auto_increment comment '系统ID',
   transaction_id       int comment '交易ID 对应 t_biz_transaction_info',
   project_region_id    int comment '项目地区ID 对应 t_biz_project_region',
   project_code_id      int comment '项目编号ID 对应 t_biz_budget_info主键',
   project_scene_id     int comment '项目场景ID 对应 t_biz_project_scene',
   project_free1_id     int comment '项目F1 对应 t_biz_project_free',
   project_free2_id     int comment '项目F2 对应 t_biz_project_free',
   project_free3_id     int comment '项目F3 对应 t_biz_project_free',
   amount               decimal(13,2) comment '金额',
   detail_desc          varchar(250) comment '描述',
   create_date          datetime comment '创建日期',
   create_by            int comment '创建人 关联表 t_sys_user',
   last_update_date     datetime comment '最后修改时间',
   last_update_by       int comment '最后修改人 关联表 t_sys_user',
   is_asset             int default 0 comment '资产类型 0-不是 1-是',
   primary key (detail_id)
);

alter table t_biz_po_transaction_detail comment 'PO交易明细表 即交易科目';

/*==============================================================*/
/* Table: t_biz_po_transaction_info                             */
/*==============================================================*/
create table t_biz_po_transaction_info
(
   transaction_id       int not null auto_increment comment '系统ID',
   batch_id             int comment '批处理ID 对应 t_biz_batch_info',
   transaction_code     varchar(50) comment '交易号 同一批处理交易号唯一 需要检测重复',
   total_amount         decimal(13,2) comment '合计金额 交易明细即交易科目的金额总和 当金额不为0的时候要有提示信息',
   create_date          datetime comment '创建日期',
   create_by            int comment '创建人 关联表 t_sys_user',
   last_update_date     datetime comment '最后修改时间',
   last_update_by       int comment '最后修改人 关联表 t_sys_user',
   primary key (transaction_id)
);

alter table t_biz_po_transaction_info comment '批处理交易表';

/*==============================================================*/
/* Table: t_biz_project_code                                    */
/*==============================================================*/
create table t_biz_project_code
(
   record_id            int not null auto_increment comment '系统ID',
   project_id           int comment '项目ID',
   main_code            varchar(30) comment '主码 根据统计水平有不同格式 1级是1位数字 2，3级是4位数字',
   sub_code             varchar(30) comment '子码 3位数字',
   code_desc_zh         varchar(200) comment '描述',
   code_desc_en         varchar(200),
   code_type            int comment '编码类型 1-基础 2-预算',
   amount               decimal(13,2) comment '货币汇率',
   statistics_level_id  int,
   create_by            int comment '创建人',
   create_date          datetime comment '创建时间',
   last_update_by       int comment '最后更新人',
   last_update_date     datetime comment '最后更新时间',
   last_amount          decimal(13,2) comment '最近一次修改的金额 用于etc',
   primary key (record_id)
);

alter table t_biz_project_code comment '项目编码';

/*==============================================================*/
/* Table: t_biz_project_company                                 */
/*==============================================================*/
create table t_biz_project_company
(
   company_id           int not null auto_increment comment '系统ID',
   project_id           int comment '项目ID',
   company_name         varchar(200) comment '投资公司名',
   primary key (company_id)
);

alter table t_biz_project_company comment '项目投资公司表';

/*==============================================================*/
/* Table: t_biz_project_currency                                */
/*==============================================================*/
create table t_biz_project_currency
(
   record_id            int not null auto_increment,
   project_id           int comment '项目ID',
   currency_code_id     int comment '货币代码ID',
   currency_type_id     int comment '货币种类ID',
   currency_desc        varchar(200),
   exchange_rate        decimal(12,6) comment '货币汇率',
   create_by            int comment '创建人',
   create_date          datetime comment '创建时间',
   last_update_by       int comment '最后更新人',
   last_update_date     datetime comment '最后更新时间',
   primary key (record_id)
);

alter table t_biz_project_currency comment '项目货币表';

/*==============================================================*/
/* Table: t_biz_project_director                                */
/*==============================================================*/
create table t_biz_project_director
(
   director_id          int not null auto_increment comment '系统标识',
   project_id           int comment '项目ID',
   director_name        varchar(100) comment '导演名称',
   primary key (director_id)
);

alter table t_biz_project_director comment '项目导演表';

/*==============================================================*/
/* Table: t_biz_project_ect_code                                */
/*==============================================================*/
create table t_biz_project_ect_code
(
   record_id            int not null auto_increment comment '系统ID',
   project_id           int comment '项目ID',
   main_code            varchar(30) comment '主码 根据统计水平有不同格式 1级是1位数字 2，3级是4位数字',
   sub_code             varchar(30) comment '子码 3位数字',
   code_desc_zh         varchar(200) comment '描述',
   code_desc_en         varchar(200),
   amount               decimal(13,2) comment '货币汇率',
   statistics_level_id  int,
   create_by            int comment '创建人',
   create_date          datetime comment '创建时间',
   last_update_by       int comment '最后更新人',
   last_update_date     datetime comment '最后更新时间',
   primary key (record_id)
);

alter table t_biz_project_ect_code comment '项目ECT编码 最初的粗略预算 基于项目预算';

/*==============================================================*/
/* Table: t_biz_project_free                                    */
/*==============================================================*/
create table t_biz_project_free
(
   record_id            int not null auto_increment comment '系统ID',
   project_id           int comment '项目ID',
   free_code            varchar(30),
   free_desc            varchar(200),
   free_type            int comment '类型 1表示F1, 2表示F2, 3表示F3',
   create_by            int comment '创建人',
   create_date          datetime comment '创建时间',
   last_update_by       int comment '最后更新人',
   last_update_date     datetime comment '最后更新时间',
   primary key (record_id)
);

alter table t_biz_project_free comment 'F1,F2,F3';

/*==============================================================*/
/* Table: t_biz_project_info                                    */
/*==============================================================*/
create table t_biz_project_info
(
   project_id           int not null auto_increment comment '系统标识',
   project_code         varchar(50) comment '项目编号手动输入 唯一不重复',
   project_name         varchar(200) comment '项目名称',
   project_status       int comment '项目状态 关联 t_biz_project_status
            1-初建
            2-进行中
            3-已完成',
   create_date          datetime comment '创建日期',
   create_by            int comment '创建人 关联表 t_sys_user',
   last_update_date     datetime comment '最后修改时间',
   last_update_by       int comment '最后修改人 关联表 t_sys_user',
   primary key (project_id)
);

alter table t_biz_project_info comment '项目信息表';

/*==============================================================*/
/* Table: t_biz_project_main_actor                              */
/*==============================================================*/
create table t_biz_project_main_actor
(
   actor_id             int not null auto_increment comment '系统ID',
   project_id           int comment '项目ID',
   actor_name           varchar(100) comment '主演演员',
   primary key (actor_id)
);

alter table t_biz_project_main_actor comment '项目主演表';

/*==============================================================*/
/* Table: t_biz_project_region                                  */
/*==============================================================*/
create table t_biz_project_region
(
   record_id            int not null auto_increment comment '系统ID',
   project_id           int comment '项目ID',
   region_code          varchar(30) comment '地区码',
   region_name          varchar(30) comment '地区名',
   create_by            int comment '创建人',
   create_date          datetime comment '创建时间',
   last_update_by       int comment '最后更新人',
   last_update_date     datetime comment '最后更新时间',
   primary key (record_id)
);

alter table t_biz_project_region comment '项目地区表';

/*==============================================================*/
/* Table: t_biz_project_scene                                   */
/*==============================================================*/
create table t_biz_project_scene
(
   record_id            int not null auto_increment comment '系统ID',
   project_id           int comment '项目ID',
   scene_code           varchar(30) comment '场景码',
   scene_desc           varchar(200) comment '场景描述',
   create_by            int comment '创建人',
   create_date          datetime comment '创建时间',
   last_update_by       int comment '最后更新人',
   last_update_date     datetime comment '最后更新时间',
   primary key (record_id)
);

alter table t_biz_project_scene comment '项目场景表';

/*==============================================================*/
/* Table: t_biz_project_status                                  */
/*==============================================================*/
create table t_biz_project_status
(
   project_status_id    int not null comment '项目状态ID',
   project_status_name  varchar(30) comment '项目状态名称',
   primary key (project_status_id)
);

alter table t_biz_project_status comment '项目状态表';

/*==============================================================*/
/* Table: t_biz_report_view_detail                              */
/*==============================================================*/
create table t_biz_report_view_detail
(
   detail_id            int not null auto_increment,
   project_code         varchar(30),
   view_id              int,
   primary key (detail_id)
);

/*==============================================================*/
/* Table: t_biz_report_view_info                                */
/*==============================================================*/
create table t_biz_report_view_info
(
   view_id              int not null auto_increment,
   view_name            varchar(200),
   project_id           int,
   create_date          datetime,
   create_by            int,
   primary key (view_id)
);

/*==============================================================*/
/* Table: t_biz_statistics_level                                */
/*==============================================================*/
create table t_biz_statistics_level
(
   statistics_level_id  int not null comment '统计ID',
   statistics_level_code varchar(30) comment '统计编号',
   primary key (statistics_level_id)
);

alter table t_biz_statistics_level comment '统计水平表';

/*==============================================================*/
/* Table: t_biz_transaction_detail                              */
/*==============================================================*/
create table t_biz_transaction_detail
(
   detail_id            int not null auto_increment comment '系统ID',
   transaction_id       int comment '交易ID 对应 t_biz_transaction_info',
   project_region_id    int comment '项目地区ID 对应 t_biz_project_region',
   project_code_id      int comment '项目编号ID 对应 t_biz_project_code',
   project_scene_id     int comment '项目场景ID 对应 t_biz_project_scene',
   project_free1_id     int comment '项目F1 对应 t_biz_project_free',
   project_free2_id     int comment '项目F2 对应 t_biz_project_free',
   project_free3_id     int comment '项目F3 对应 t_biz_project_free',
   amount               decimal(13,2) comment '金额',
   detail_desc          varchar(250) comment '描述',
   create_date          datetime comment '创建日期',
   create_by            int comment '创建人 关联表 t_sys_user',
   last_update_date     datetime comment '最后修改时间',
   last_update_by       int comment '最后修改人 关联表 t_sys_user',
   is_asset             int default 0 comment '资产类型 0-不是 1-是',
   primary key (detail_id)
);

alter table t_biz_transaction_detail comment '批处理交易明细表 即交易科目';

/*==============================================================*/
/* Table: t_biz_transaction_info                                */
/*==============================================================*/
create table t_biz_transaction_info
(
   transaction_id       int not null auto_increment comment '系统ID',
   batch_id             int comment '批处理ID 对应 t_biz_batch_info',
   transaction_code     varchar(50) comment '交易号 同一批处理交易号唯一 需要检测重复',
   total_amount         decimal(13,2) comment '合计金额 交易明细即交易科目的金额总和 当金额不为0的时候要有提示信息',
   create_date          datetime comment '创建日期',
   create_by            int comment '创建人 关联表 t_sys_user',
   last_update_date     datetime comment '最后修改时间',
   last_update_by       int comment '最后修改人 关联表 t_sys_user',
   primary key (transaction_id)
);

alter table t_biz_transaction_info comment '批处理交易表';

/*==============================================================*/
/* Table: t_biz_vouchers_info                                   */
/*==============================================================*/
create table t_biz_vouchers_info
(
   vouchers_id          int not null auto_increment,
   vouchers_name        varchar(200),
   project_id           int,
   vouchers_pic         varchar(200),
   vouchers_type        int comment '1-凭证；2-合同',
   create_date          datetime,
   create_by            int,
   primary key (vouchers_id)
);

/*==============================================================*/
/* Table: t_his_project_code                                    */
/*==============================================================*/
create table t_his_project_code
(
   record_id            int not null auto_increment comment '系统ID',
   project_id           int comment '项目ID',
   main_code            varchar(30) comment '主码 根据统计水平有不同格式 1级是1位数字 2，3级是4位数字',
   sub_code             varchar(30) comment '子码 3位数字',
   code_desc_zh         varchar(200) comment '描述',
   code_desc_en         varchar(200),
   code_type            int comment '编码类型 1-基础 2-预算',
   amount               decimal(13,2) comment '货币汇率',
   statistics_level_id  int,
   create_by            int comment '创建人',
   create_date          datetime comment '创建时间',
   last_update_by       int comment '最后更新人',
   last_update_date     datetime comment '最后更新时间',
   last_amount          decimal(13,2) comment '最近一次修改的金额 用于etc',
   primary key (record_id)
);

/*==============================================================*/
/* Table: t_sys_resource                                        */
/*==============================================================*/
create table t_sys_resource
(
   resource_id          int not null comment '资源ID',
   resource_name        varchar(100) comment '资源名称',
   resource_url         varchar(200) comment '资源URL',
   resource_status      int comment '资源状态 1-启用 0-停用',
   resource_type        int comment '资源类型 1-功能模块入口 2-功能操作按钮 3-其他',
   resource_desc        varchar(200) comment '资源描述',
   create_date          datetime comment '创建时间',
   create_by            int comment '创建人',
   resourceparent_id    int comment '资源父目录ID 备用字段',
   sort_num             int comment '排序 备用字段',
   primary key (resource_id)
);

alter table t_sys_resource comment '系统资源表';

/*==============================================================*/
/* Table: t_sys_role                                            */
/*==============================================================*/
create table t_sys_role
(
   role_id              int not null comment '角色ID',
   role_name            varchar(50) comment '角色名称',
   role_desc            varchar(200) comment '角色描述',
   role_status          int comment '角色状态',
   create_date          datetime comment '创建时间',
   create_by            int comment '创建人',
   primary key (role_id)
);

alter table t_sys_role comment '系统角色信息表';

/*==============================================================*/
/* Table: t_sys_roleresource                                    */
/*==============================================================*/
create table t_sys_roleresource
(
   role_id              int not null comment '角色ID',
   resource_id          int not null comment '资源ID',
   primary key (role_id, resource_id)
);

alter table t_sys_roleresource comment '系统角色资源关系表';

/*==============================================================*/
/* Table: t_sys_user                                            */
/*==============================================================*/
create table t_sys_user
(
   user_id              int not null auto_increment comment '系统ID',
   project_id           int comment '项目ID 一个账号只能对应一个项目',
   user_empcode         varchar(100) comment '登陆账号',
   user_password        varchar(100) comment '登陆密码',
   user_realname        varchar(100) comment '姓名',
   user_status          int comment '状态 对应表 t_sys_user_status',
   position_id          int comment '职位ID 对应表 t_sys_user_position',
   create_date          datetime comment '创建时间',
   create_by            int comment '创建人',
   last_update_date     datetime comment '最后更新时间',
   last_update_by       int comment '最后更新人',
   last_modify_pwd_date datetime comment '最后一次修改密码时间',
   session_id           varchar(30) comment '最后一次登录的session_id',
   primary key (user_id)
);

alter table t_sys_user comment '账号表';

/*==============================================================*/
/* Table: t_sys_user_log                                        */
/*==============================================================*/
create table t_sys_user_log
(
   log_id               int not null auto_increment comment '系统ID',
   user_id              int comment '用户ID 对应表 t_sys_user',
   log_date             datetime comment '日志时间',
   log_type             int comment '日志类型 1-登录',
   remote_adress        varchar(30) comment '员工使用设备的IP地址',
   primary key (log_id)
);

alter table t_sys_user_log comment '员工日志信息表';

/*==============================================================*/
/* Table: t_sys_user_position                                   */
/*==============================================================*/
create table t_sys_user_position
(
   position_id          int not null,
   position_name        varchar(100) comment '职位名称',
   primary key (position_id)
);

alter table t_sys_user_position comment '用户职位表';

/*==============================================================*/
/* Table: t_sys_user_status                                     */
/*==============================================================*/
create table t_sys_user_status
(
   user_status_id       int not null comment '系统ID',
   user_status_name     varchar(100) comment '用户状态',
   primary key (user_status_id)
);

alter table t_sys_user_status comment '用户状态表';

/*==============================================================*/
/* View: v_biz_batch_check_transaction_code                     */
/*==============================================================*/
create   VIEW      v_biz_batch_check_transaction_code 
  as 
select concat(
	ifnull(l.currency_code,'   '),' ',
	ifnull(b.region_code,'   '),' ',
	ifnull(c.main_code,'    '),' ',
	ifnull(c.sub_code,'   '),' ',
	ifnull(d.scene_code,'   '),' ',
	ifnull(e.free_code,'  '),' ',
	ifnull(f.free_code,'  '),' ',
	ifnull(g.free_code,'  ')) as all_code,
	j.code_desc_zh,j.code_desc_en,h.transaction_code,h.total_amount,a.*
	from t_biz_transaction_detail a
	left join t_biz_project_region b on a.project_region_id=b.record_id
	left join t_biz_project_code c on a.project_code_id=c.record_id
	left join t_biz_project_scene d on a.project_scene_id=d.record_id
	left join t_biz_project_free e on a.project_free1_id=e.record_id
	left join t_biz_project_free f on a.project_free2_id=f.record_id
	left join t_biz_project_free g on a.project_free3_id=g.record_id
	left join t_biz_transaction_info h on a.transaction_id=h.transaction_id
	left join t_biz_batch_info i on h.batch_id=i.batch_id
	left join t_biz_project_currency k on i.currency_id=k.record_id
	left join t_biz_currency_code l on k.currency_code_id=l.currency_code_id
	left join v_biz_project_main_code j on i.project_id=j.project_id and c.main_code=j.main_code and c.sub_code=j.sub_code;

/*==============================================================*/
/* View: v_biz_batch_check_transaction_detial                   */
/*==============================================================*/
create   VIEW      v_biz_batch_check_transaction_detial 
  as 
select concat(ifnull(l.currency_code,'   '),' ',
	ifnull(b.region_code,'   '),' ',
	ifnull(c.main_code,'    '),' ',
	ifnull(c.sub_code,'   '),' ',
	ifnull(d.scene_code,'   '),' ',
	ifnull(e.free_code,'  '),' ',
	ifnull(f.free_code,'  '),' ',
	ifnull(g.free_code,'  ')) as all_code,i.batch_id,
	j.code_desc_zh,j.code_desc_en,h.transaction_code,h.total_amount,a.*,l.currency_code,c.main_code,c.sub_code,b.region_code,d.scene_code,
	e.free_code as free_code1,f.free_code as free_code2,g.free_code as free_code3,
	i.last_update_date AS detail_record_date,i.status AS status,i.project_id AS project_id,i.batch_code,
	k.exchange_rate AS exchange_rate,exchange_rate*a.amount AS new_amount,
	concat(c.main_code,c.sub_code) AS main_sub_code
	from t_biz_transaction_detail a
	left join t_biz_project_region b on a.project_region_id=b.record_id
	left join t_biz_project_code c on a.project_code_id=c.record_id
	left join t_biz_project_scene d on a.project_scene_id=d.record_id
	left join t_biz_project_free e on a.project_free1_id=e.record_id
	left join t_biz_project_free f on a.project_free2_id=f.record_id
	left join t_biz_project_free g on a.project_free3_id=g.record_id
	left join t_biz_transaction_info h on a.transaction_id=h.transaction_id
	left join t_biz_batch_info i on h.batch_id=i.batch_id
	left join v_biz_project_main_code j on i.project_id=j.project_id and c.main_code=j.main_code and c.sub_code=j.sub_code
	left join t_biz_project_currency k on i.currency_id=k.record_id
	left join t_biz_currency_code l on k.currency_code_id=l.currency_code_id;

/*==============================================================*/
/* View: v_biz_batch_info                                       */
/*==============================================================*/
create   VIEW      v_biz_batch_info 
  as 
select a.*,c.currency_code,c.currency_desc,d.currency_type from t_biz_batch_info a
	left join t_biz_project_currency b on a.currency_id=b.record_id
	left join t_biz_currency_code c on b.currency_code_id=c.currency_code_id
	left join t_biz_currency_type d on b.currency_type_id=d.currency_type_id;

/*==============================================================*/
/* View: v_biz_batch_main_sub_code                              */
/*==============================================================*/
create   VIEW      v_biz_batch_main_sub_code 
  as 
select h.batch_id,c.main_code,c.sub_code,
	group_concat(distinct code_desc_zh separator '/') as code_desc_zh,
	group_concat(distinct code_desc_en separator '/') as code_desc_en
	from t_biz_transaction_detail a
	left join t_biz_project_code c on a.project_code_id=c.record_id
	left join t_biz_transaction_info h on a.transaction_id=h.transaction_id
	left join t_biz_batch_info i on h.batch_id=i.batch_id
	group by h.batch_id,main_code,sub_code;

/*==============================================================*/
/* View: v_biz_batch_region_main_code                           */
/*==============================================================*/
create   VIEW      v_biz_batch_region_main_code 
  as 
select h.batch_id,c.main_code,b.region_code,
	group_concat(code_desc_zh separator '/') as code_desc_zh,
	group_concat(code_desc_en separator '/') as code_desc_en
	from t_biz_transaction_detail a
	left join t_biz_project_region b on a.project_region_id=b.record_id
	left join t_biz_project_code c on a.project_code_id=c.record_id
	left join t_biz_transaction_info h on a.transaction_id=h.transaction_id
	left join t_biz_batch_info i on h.batch_id=i.batch_id
	group by h.batch_id,region_code,main_code;

/*==============================================================*/
/* View: v_biz_po_check_transaction_code                        */
/*==============================================================*/
create   VIEW      v_biz_po_check_transaction_code 
  as 
select concat(
	ifnull(l.currency_code,'   '),' ',
	ifnull(b.region_code,'   '),' ',
	ifnull(c.main_code,'    '),' ',
	ifnull(c.sub_code,'   '),' ',
	ifnull(d.scene_code,'   '),' ',
	ifnull(e.free_code,'  '),' ',
	ifnull(f.free_code,'  '),' ',
	ifnull(g.free_code,'  ')) as all_code,
	j.code_desc_zh,j.code_desc_en,h.transaction_code,h.total_amount,a.*
	from t_biz_po_transaction_detail a
	left join t_biz_project_region b on a.project_region_id=b.record_id
	left join t_biz_project_code c on a.project_code_id=c.record_id
	left join t_biz_project_scene d on a.project_scene_id=d.record_id
	left join t_biz_project_free e on a.project_free1_id=e.record_id
	left join t_biz_project_free f on a.project_free2_id=f.record_id
	left join t_biz_project_free g on a.project_free3_id=g.record_id
	left join t_biz_po_transaction_info h on a.transaction_id=h.transaction_id
	left join t_biz_po_info i on h.batch_id=i.batch_id
	left join t_biz_project_currency k on i.currency_id=k.record_id
	left join t_biz_currency_code l on k.currency_code_id=l.currency_code_id
	left join v_biz_project_main_code j on i.project_id=j.project_id and c.main_code=j.main_code and c.sub_code=j.sub_code;

/*==============================================================*/
/* View: v_biz_po_check_transaction_detial                      */
/*==============================================================*/
create   VIEW      v_biz_po_check_transaction_detial 
  as 
select concat(ifnull(l.currency_code,'   '),' ',
	ifnull(b.region_code,'   '),' ',
	ifnull(c.main_code,'    '),' ',
	ifnull(c.sub_code,'   '),' ',
	ifnull(d.scene_code,'   '),' ',
	ifnull(e.free_code,'  '),' ',
	ifnull(f.free_code,'  '),' ',
	ifnull(g.free_code,'  ')) as all_code,i.batch_id,
	j.code_desc_zh,j.code_desc_en,h.transaction_code,h.total_amount,a.*,l.currency_code,c.main_code,c.sub_code,b.region_code,d.scene_code,
	e.free_code as free_code1,f.free_code as free_code2,g.free_code as free_code3,
	i.last_update_date AS detail_record_date,i.status AS status,i.project_id AS project_id,
	k.exchange_rate AS exchange_rate
	from t_biz_po_transaction_detail a
	left join t_biz_project_region b on a.project_region_id=b.record_id
	left join t_biz_project_code c on a.project_code_id=c.record_id
	left join t_biz_project_scene d on a.project_scene_id=d.record_id
	left join t_biz_project_free e on a.project_free1_id=e.record_id
	left join t_biz_project_free f on a.project_free2_id=f.record_id
	left join t_biz_project_free g on a.project_free3_id=g.record_id
	left join t_biz_po_transaction_info h on a.transaction_id=h.transaction_id
	left join t_biz_po_info i on h.batch_id=i.batch_id
	left join v_biz_project_main_code j on i.project_id=j.project_id and c.main_code=j.main_code and c.sub_code=j.sub_code
	left join t_biz_project_currency k on i.currency_id=k.record_id
	left join t_biz_currency_code l on k.currency_code_id=l.currency_code_id;

/*==============================================================*/
/* View: v_biz_po_info                                          */
/*==============================================================*/
create   VIEW      v_biz_po_info 
  as 
select a.*,c.currency_code,c.currency_desc,d.currency_type from t_biz_po_info a
	left join t_biz_project_currency b on a.currency_id=b.record_id
	left join t_biz_currency_code c on b.currency_code_id=c.currency_code_id
	left join t_biz_currency_type d on b.currency_type_id=d.currency_type_id;

/*==============================================================*/
/* View: v_biz_po_main_sub_code                                 */
/*==============================================================*/
create   VIEW      v_biz_po_main_sub_code 
  as 
select h.batch_id,c.main_code,c.sub_code,
	group_concat(distinct code_desc_zh separator '/') as code_desc_zh,
	group_concat(distinct code_desc_en separator '/') as code_desc_en
	from t_biz_po_transaction_detail a
	left join t_biz_project_code c on a.project_code_id=c.record_id
	left join t_biz_po_transaction_info h on a.transaction_id=h.transaction_id
	left join t_biz_po_info i on h.batch_id=i.batch_id
	group by h.batch_id,main_code,sub_code;

/*==============================================================*/
/* View: v_biz_po_region_main_code                              */
/*==============================================================*/
create   VIEW      v_biz_po_region_main_code 
  as 
select h.batch_id,c.main_code,b.region_code,
	group_concat(code_desc_zh separator '/') as code_desc_zh,
	group_concat(code_desc_zh separator '/') as code_desc_en
	from t_biz_po_transaction_detail a
	left join t_biz_project_region b on a.project_region_id=b.record_id
	left join t_biz_project_code c on a.project_code_id=c.record_id
	left join t_biz_po_transaction_info h on a.transaction_id=h.transaction_id
	left join t_biz_po_info i on h.batch_id=i.batch_id
	group by h.batch_id,region_code,main_code;

/*==============================================================*/
/* View: v_biz_project_code                                     */
/*==============================================================*/
create   VIEW      v_biz_project_code 
  as 
select a.*,b.statistics_level_code from t_biz_project_code a
	left join t_biz_statistics_level b on a.statistics_level_id=b.statistics_level_id;

/*==============================================================*/
/* View: v_biz_project_currency                                 */
/*==============================================================*/
create   VIEW      v_biz_project_currency 
  as 
select a.*,b.currency_code,b.currency_desc as currency_code_desc,c.currency_type from t_biz_project_currency a
	left join t_biz_currency_code b on a.currency_code_id=b.currency_code_id
	left join t_biz_currency_type c on a.currency_type_id=c.currency_type_id;

/*==============================================================*/
/* View: v_biz_project_info                                     */
/*==============================================================*/
create   VIEW      v_biz_project_info 
  as 
	select a.*,b.project_status_name from t_biz_project_info a
	left join t_biz_project_status b on a.project_status=b.project_status_id;

/*==============================================================*/
/* View: v_biz_project_main_code                                */
/*==============================================================*/
create   VIEW      v_biz_project_main_code 
  as 
select project_id,main_code,sub_code,group_concat(code_desc_zh separator '/') as code_desc_zh,group_concat(code_desc_en separator '/') as code_desc_en
	from t_biz_project_code group by project_id,main_code,sub_code;

/*==============================================================*/
/* View: v_his_project_code                                     */
/*==============================================================*/
create   VIEW      v_his_project_code 
  as 
select a.*,b.statistics_level_code from t_his_project_code a
	left join t_biz_statistics_level b on a.statistics_level_id=b.statistics_level_id;

/*==============================================================*/
/* View: v_sys_roleresource                                     */
/*==============================================================*/
create   VIEW      v_sys_roleresource 
  as 
select a.*,b.resource_name,b.resource_url,b.resource_type from t_sys_roleresource a
	left join t_sys_resource b on a.resource_id=b.resource_id;

/*==============================================================*/
/* View: v_sys_user                                             */
/*==============================================================*/
create   VIEW      v_sys_user 
  as 
select a.*,b.user_status_name,c.position_name from t_sys_user a
	left join t_sys_user_status b on a.user_status=b.user_status_id
	left join t_sys_user_position c on a.position_id=c.position_id;

