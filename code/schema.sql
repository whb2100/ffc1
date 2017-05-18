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
   batch_id             int not null auto_increment comment 'ϵͳID',
   batch_code           varchar(50) comment '�������� ͬһ��Ŀ�µı��Ψһ ��Ҫ����ظ�',
   project_id           int comment '��Ŀ��� ��Ӧ t_biz_project_info',
   currency_id          int comment '����ID ��Ӧ t_biz_project_currency',
   status               int comment '״̬ 1-���� 2-���ύ',
   create_date          datetime comment '��������',
   create_by            int comment '������ ������ t_sys_user',
   last_update_date     datetime comment '����޸�ʱ��',
   last_update_by       int comment '����޸��� ������ t_sys_user',
   primary key (batch_id)
);

alter table t_biz_batch_info comment '��������Ϣ��';

/*==============================================================*/
/* Table: t_biz_currency_code                                   */
/*==============================================================*/
create table t_biz_currency_code
(
   currency_code_id     int not null comment '����ID',
   currency_code        varchar(30) comment '���Ҵ���',
   currency_desc        varchar(100) comment '���Ҵ��������',
   primary key (currency_code_id)
);

alter table t_biz_currency_code comment '���Ҵ����';

/*==============================================================*/
/* Table: t_biz_currency_type                                   */
/*==============================================================*/
create table t_biz_currency_type
(
   currency_type_id     int not null auto_increment comment '��������ID',
   currency_type        varchar(30) comment '��������',
   currency_desc        varchar(100) comment '�������������',
   primary key (currency_type_id)
);

alter table t_biz_currency_type comment '��������';

/*==============================================================*/
/* Table: t_biz_po_info                                         */
/*==============================================================*/
create table t_biz_po_info
(
   batch_id             int not null auto_increment comment 'ϵͳID',
   batch_code           varchar(50) comment '�������� ͬһ��Ŀ�µı��Ψһ ��Ҫ����ظ�',
   project_id           int comment '��Ŀ��� ��Ӧ t_biz_project_info',
   currency_id          int comment '����ID ��Ӧ t_biz_project_currency',
   status               int comment '״̬ 1-���� 2-���ύ',
   create_date          datetime comment '��������',
   create_by            int comment '������ ������ t_sys_user',
   last_update_date     datetime comment '����޸�ʱ��',
   last_update_by       int comment '����޸��� ������ t_sys_user',
   primary key (batch_id)
);

alter table t_biz_po_info comment 'PO��Ϣ��';

/*==============================================================*/
/* Table: t_biz_po_transaction_detail                           */
/*==============================================================*/
create table t_biz_po_transaction_detail
(
   detail_id            int not null auto_increment comment 'ϵͳID',
   transaction_id       int comment '����ID ��Ӧ t_biz_transaction_info',
   project_region_id    int comment '��Ŀ����ID ��Ӧ t_biz_project_region',
   project_code_id      int comment '��Ŀ���ID ��Ӧ t_biz_budget_info����',
   project_scene_id     int comment '��Ŀ����ID ��Ӧ t_biz_project_scene',
   project_free1_id     int comment '��ĿF1 ��Ӧ t_biz_project_free',
   project_free2_id     int comment '��ĿF2 ��Ӧ t_biz_project_free',
   project_free3_id     int comment '��ĿF3 ��Ӧ t_biz_project_free',
   amount               decimal(13,2) comment '���',
   detail_desc          varchar(250) comment '����',
   create_date          datetime comment '��������',
   create_by            int comment '������ ������ t_sys_user',
   last_update_date     datetime comment '����޸�ʱ��',
   last_update_by       int comment '����޸��� ������ t_sys_user',
   is_asset             int default 0 comment '�ʲ����� 0-���� 1-��',
   primary key (detail_id)
);

alter table t_biz_po_transaction_detail comment 'PO������ϸ�� �����׿�Ŀ';

/*==============================================================*/
/* Table: t_biz_po_transaction_info                             */
/*==============================================================*/
create table t_biz_po_transaction_info
(
   transaction_id       int not null auto_increment comment 'ϵͳID',
   batch_id             int comment '������ID ��Ӧ t_biz_batch_info',
   transaction_code     varchar(50) comment '���׺� ͬһ�������׺�Ψһ ��Ҫ����ظ�',
   total_amount         decimal(13,2) comment '�ϼƽ�� ������ϸ�����׿�Ŀ�Ľ���ܺ� ����Ϊ0��ʱ��Ҫ����ʾ��Ϣ',
   create_date          datetime comment '��������',
   create_by            int comment '������ ������ t_sys_user',
   last_update_date     datetime comment '����޸�ʱ��',
   last_update_by       int comment '����޸��� ������ t_sys_user',
   primary key (transaction_id)
);

alter table t_biz_po_transaction_info comment '�������ױ�';

/*==============================================================*/
/* Table: t_biz_project_code                                    */
/*==============================================================*/
create table t_biz_project_code
(
   record_id            int not null auto_increment comment 'ϵͳID',
   project_id           int comment '��ĿID',
   main_code            varchar(30) comment '���� ����ͳ��ˮƽ�в�ͬ��ʽ 1����1λ���� 2��3����4λ����',
   sub_code             varchar(30) comment '���� 3λ����',
   code_desc_zh         varchar(200) comment '����',
   code_desc_en         varchar(200),
   code_type            int comment '�������� 1-���� 2-Ԥ��',
   amount               decimal(13,2) comment '���һ���',
   statistics_level_id  int,
   create_by            int comment '������',
   create_date          datetime comment '����ʱ��',
   last_update_by       int comment '��������',
   last_update_date     datetime comment '������ʱ��',
   last_amount          decimal(13,2) comment '���һ���޸ĵĽ�� ����etc',
   primary key (record_id)
);

alter table t_biz_project_code comment '��Ŀ����';

/*==============================================================*/
/* Table: t_biz_project_company                                 */
/*==============================================================*/
create table t_biz_project_company
(
   company_id           int not null auto_increment comment 'ϵͳID',
   project_id           int comment '��ĿID',
   company_name         varchar(200) comment 'Ͷ�ʹ�˾��',
   primary key (company_id)
);

alter table t_biz_project_company comment '��ĿͶ�ʹ�˾��';

/*==============================================================*/
/* Table: t_biz_project_currency                                */
/*==============================================================*/
create table t_biz_project_currency
(
   record_id            int not null auto_increment,
   project_id           int comment '��ĿID',
   currency_code_id     int comment '���Ҵ���ID',
   currency_type_id     int comment '��������ID',
   currency_desc        varchar(200),
   exchange_rate        decimal(12,6) comment '���һ���',
   create_by            int comment '������',
   create_date          datetime comment '����ʱ��',
   last_update_by       int comment '��������',
   last_update_date     datetime comment '������ʱ��',
   primary key (record_id)
);

alter table t_biz_project_currency comment '��Ŀ���ұ�';

/*==============================================================*/
/* Table: t_biz_project_director                                */
/*==============================================================*/
create table t_biz_project_director
(
   director_id          int not null auto_increment comment 'ϵͳ��ʶ',
   project_id           int comment '��ĿID',
   director_name        varchar(100) comment '��������',
   primary key (director_id)
);

alter table t_biz_project_director comment '��Ŀ���ݱ�';

/*==============================================================*/
/* Table: t_biz_project_ect_code                                */
/*==============================================================*/
create table t_biz_project_ect_code
(
   record_id            int not null auto_increment comment 'ϵͳID',
   project_id           int comment '��ĿID',
   main_code            varchar(30) comment '���� ����ͳ��ˮƽ�в�ͬ��ʽ 1����1λ���� 2��3����4λ����',
   sub_code             varchar(30) comment '���� 3λ����',
   code_desc_zh         varchar(200) comment '����',
   code_desc_en         varchar(200),
   amount               decimal(13,2) comment '���һ���',
   statistics_level_id  int,
   create_by            int comment '������',
   create_date          datetime comment '����ʱ��',
   last_update_by       int comment '��������',
   last_update_date     datetime comment '������ʱ��',
   primary key (record_id)
);

alter table t_biz_project_ect_code comment '��ĿECT���� ����Ĵ���Ԥ�� ������ĿԤ��';

/*==============================================================*/
/* Table: t_biz_project_free                                    */
/*==============================================================*/
create table t_biz_project_free
(
   record_id            int not null auto_increment comment 'ϵͳID',
   project_id           int comment '��ĿID',
   free_code            varchar(30),
   free_desc            varchar(200),
   free_type            int comment '���� 1��ʾF1, 2��ʾF2, 3��ʾF3',
   create_by            int comment '������',
   create_date          datetime comment '����ʱ��',
   last_update_by       int comment '��������',
   last_update_date     datetime comment '������ʱ��',
   primary key (record_id)
);

alter table t_biz_project_free comment 'F1,F2,F3';

/*==============================================================*/
/* Table: t_biz_project_info                                    */
/*==============================================================*/
create table t_biz_project_info
(
   project_id           int not null auto_increment comment 'ϵͳ��ʶ',
   project_code         varchar(50) comment '��Ŀ����ֶ����� Ψһ���ظ�',
   project_name         varchar(200) comment '��Ŀ����',
   project_status       int comment '��Ŀ״̬ ���� t_biz_project_status
            1-����
            2-������
            3-�����',
   create_date          datetime comment '��������',
   create_by            int comment '������ ������ t_sys_user',
   last_update_date     datetime comment '����޸�ʱ��',
   last_update_by       int comment '����޸��� ������ t_sys_user',
   primary key (project_id)
);

alter table t_biz_project_info comment '��Ŀ��Ϣ��';

/*==============================================================*/
/* Table: t_biz_project_main_actor                              */
/*==============================================================*/
create table t_biz_project_main_actor
(
   actor_id             int not null auto_increment comment 'ϵͳID',
   project_id           int comment '��ĿID',
   actor_name           varchar(100) comment '������Ա',
   primary key (actor_id)
);

alter table t_biz_project_main_actor comment '��Ŀ���ݱ�';

/*==============================================================*/
/* Table: t_biz_project_region                                  */
/*==============================================================*/
create table t_biz_project_region
(
   record_id            int not null auto_increment comment 'ϵͳID',
   project_id           int comment '��ĿID',
   region_code          varchar(30) comment '������',
   region_name          varchar(30) comment '������',
   create_by            int comment '������',
   create_date          datetime comment '����ʱ��',
   last_update_by       int comment '��������',
   last_update_date     datetime comment '������ʱ��',
   primary key (record_id)
);

alter table t_biz_project_region comment '��Ŀ������';

/*==============================================================*/
/* Table: t_biz_project_scene                                   */
/*==============================================================*/
create table t_biz_project_scene
(
   record_id            int not null auto_increment comment 'ϵͳID',
   project_id           int comment '��ĿID',
   scene_code           varchar(30) comment '������',
   scene_desc           varchar(200) comment '��������',
   create_by            int comment '������',
   create_date          datetime comment '����ʱ��',
   last_update_by       int comment '��������',
   last_update_date     datetime comment '������ʱ��',
   primary key (record_id)
);

alter table t_biz_project_scene comment '��Ŀ������';

/*==============================================================*/
/* Table: t_biz_project_status                                  */
/*==============================================================*/
create table t_biz_project_status
(
   project_status_id    int not null comment '��Ŀ״̬ID',
   project_status_name  varchar(30) comment '��Ŀ״̬����',
   primary key (project_status_id)
);

alter table t_biz_project_status comment '��Ŀ״̬��';

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
   statistics_level_id  int not null comment 'ͳ��ID',
   statistics_level_code varchar(30) comment 'ͳ�Ʊ��',
   primary key (statistics_level_id)
);

alter table t_biz_statistics_level comment 'ͳ��ˮƽ��';

/*==============================================================*/
/* Table: t_biz_transaction_detail                              */
/*==============================================================*/
create table t_biz_transaction_detail
(
   detail_id            int not null auto_increment comment 'ϵͳID',
   transaction_id       int comment '����ID ��Ӧ t_biz_transaction_info',
   project_region_id    int comment '��Ŀ����ID ��Ӧ t_biz_project_region',
   project_code_id      int comment '��Ŀ���ID ��Ӧ t_biz_project_code',
   project_scene_id     int comment '��Ŀ����ID ��Ӧ t_biz_project_scene',
   project_free1_id     int comment '��ĿF1 ��Ӧ t_biz_project_free',
   project_free2_id     int comment '��ĿF2 ��Ӧ t_biz_project_free',
   project_free3_id     int comment '��ĿF3 ��Ӧ t_biz_project_free',
   amount               decimal(13,2) comment '���',
   detail_desc          varchar(250) comment '����',
   create_date          datetime comment '��������',
   create_by            int comment '������ ������ t_sys_user',
   last_update_date     datetime comment '����޸�ʱ��',
   last_update_by       int comment '����޸��� ������ t_sys_user',
   is_asset             int default 0 comment '�ʲ����� 0-���� 1-��',
   primary key (detail_id)
);

alter table t_biz_transaction_detail comment '����������ϸ�� �����׿�Ŀ';

/*==============================================================*/
/* Table: t_biz_transaction_info                                */
/*==============================================================*/
create table t_biz_transaction_info
(
   transaction_id       int not null auto_increment comment 'ϵͳID',
   batch_id             int comment '������ID ��Ӧ t_biz_batch_info',
   transaction_code     varchar(50) comment '���׺� ͬһ�������׺�Ψһ ��Ҫ����ظ�',
   total_amount         decimal(13,2) comment '�ϼƽ�� ������ϸ�����׿�Ŀ�Ľ���ܺ� ����Ϊ0��ʱ��Ҫ����ʾ��Ϣ',
   create_date          datetime comment '��������',
   create_by            int comment '������ ������ t_sys_user',
   last_update_date     datetime comment '����޸�ʱ��',
   last_update_by       int comment '����޸��� ������ t_sys_user',
   primary key (transaction_id)
);

alter table t_biz_transaction_info comment '�������ױ�';

/*==============================================================*/
/* Table: t_biz_vouchers_info                                   */
/*==============================================================*/
create table t_biz_vouchers_info
(
   vouchers_id          int not null auto_increment,
   vouchers_name        varchar(200),
   project_id           int,
   vouchers_pic         varchar(200),
   vouchers_type        int comment '1-ƾ֤��2-��ͬ',
   create_date          datetime,
   create_by            int,
   primary key (vouchers_id)
);

/*==============================================================*/
/* Table: t_his_project_code                                    */
/*==============================================================*/
create table t_his_project_code
(
   record_id            int not null auto_increment comment 'ϵͳID',
   project_id           int comment '��ĿID',
   main_code            varchar(30) comment '���� ����ͳ��ˮƽ�в�ͬ��ʽ 1����1λ���� 2��3����4λ����',
   sub_code             varchar(30) comment '���� 3λ����',
   code_desc_zh         varchar(200) comment '����',
   code_desc_en         varchar(200),
   code_type            int comment '�������� 1-���� 2-Ԥ��',
   amount               decimal(13,2) comment '���һ���',
   statistics_level_id  int,
   create_by            int comment '������',
   create_date          datetime comment '����ʱ��',
   last_update_by       int comment '��������',
   last_update_date     datetime comment '������ʱ��',
   last_amount          decimal(13,2) comment '���һ���޸ĵĽ�� ����etc',
   primary key (record_id)
);

/*==============================================================*/
/* Table: t_sys_resource                                        */
/*==============================================================*/
create table t_sys_resource
(
   resource_id          int not null comment '��ԴID',
   resource_name        varchar(100) comment '��Դ����',
   resource_url         varchar(200) comment '��ԴURL',
   resource_status      int comment '��Դ״̬ 1-���� 0-ͣ��',
   resource_type        int comment '��Դ���� 1-����ģ����� 2-���ܲ�����ť 3-����',
   resource_desc        varchar(200) comment '��Դ����',
   create_date          datetime comment '����ʱ��',
   create_by            int comment '������',
   resourceparent_id    int comment '��Դ��Ŀ¼ID �����ֶ�',
   sort_num             int comment '���� �����ֶ�',
   primary key (resource_id)
);

alter table t_sys_resource comment 'ϵͳ��Դ��';

/*==============================================================*/
/* Table: t_sys_role                                            */
/*==============================================================*/
create table t_sys_role
(
   role_id              int not null comment '��ɫID',
   role_name            varchar(50) comment '��ɫ����',
   role_desc            varchar(200) comment '��ɫ����',
   role_status          int comment '��ɫ״̬',
   create_date          datetime comment '����ʱ��',
   create_by            int comment '������',
   primary key (role_id)
);

alter table t_sys_role comment 'ϵͳ��ɫ��Ϣ��';

/*==============================================================*/
/* Table: t_sys_roleresource                                    */
/*==============================================================*/
create table t_sys_roleresource
(
   role_id              int not null comment '��ɫID',
   resource_id          int not null comment '��ԴID',
   primary key (role_id, resource_id)
);

alter table t_sys_roleresource comment 'ϵͳ��ɫ��Դ��ϵ��';

/*==============================================================*/
/* Table: t_sys_user                                            */
/*==============================================================*/
create table t_sys_user
(
   user_id              int not null auto_increment comment 'ϵͳID',
   project_id           int comment '��ĿID һ���˺�ֻ�ܶ�Ӧһ����Ŀ',
   user_empcode         varchar(100) comment '��½�˺�',
   user_password        varchar(100) comment '��½����',
   user_realname        varchar(100) comment '����',
   user_status          int comment '״̬ ��Ӧ�� t_sys_user_status',
   position_id          int comment 'ְλID ��Ӧ�� t_sys_user_position',
   create_date          datetime comment '����ʱ��',
   create_by            int comment '������',
   last_update_date     datetime comment '������ʱ��',
   last_update_by       int comment '��������',
   last_modify_pwd_date datetime comment '���һ���޸�����ʱ��',
   session_id           varchar(30) comment '���һ�ε�¼��session_id',
   primary key (user_id)
);

alter table t_sys_user comment '�˺ű�';

/*==============================================================*/
/* Table: t_sys_user_log                                        */
/*==============================================================*/
create table t_sys_user_log
(
   log_id               int not null auto_increment comment 'ϵͳID',
   user_id              int comment '�û�ID ��Ӧ�� t_sys_user',
   log_date             datetime comment '��־ʱ��',
   log_type             int comment '��־���� 1-��¼',
   remote_adress        varchar(30) comment 'Ա��ʹ���豸��IP��ַ',
   primary key (log_id)
);

alter table t_sys_user_log comment 'Ա����־��Ϣ��';

/*==============================================================*/
/* Table: t_sys_user_position                                   */
/*==============================================================*/
create table t_sys_user_position
(
   position_id          int not null,
   position_name        varchar(100) comment 'ְλ����',
   primary key (position_id)
);

alter table t_sys_user_position comment '�û�ְλ��';

/*==============================================================*/
/* Table: t_sys_user_status                                     */
/*==============================================================*/
create table t_sys_user_status
(
   user_status_id       int not null comment 'ϵͳID',
   user_status_name     varchar(100) comment '�û�״̬',
   primary key (user_status_id)
);

alter table t_sys_user_status comment '�û�״̬��';

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

