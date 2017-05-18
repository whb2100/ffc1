INSERT INTO `t_biz_project_status` (`project_status_id`, `project_status_name`, `project_status_name_en`) VALUES
('1', '筹备', 'PREP'),
('2', '拍摄', 'SHOOTING'),
('3', '后期', 'POST'),
('4', '完片', 'COMPLETE');
('5', '搁置', 'ON HOLD');

INSERT INTO `t_sys_user_position` (`position_id`, `position_name`) VALUES
(1, 'admin'),
(2, 'LEVEL00'),
(3, 'LEVEL01'),
(4, 'LEVEL02');

INSERT INTO `t_sys_user_status` (`user_status_id`, `user_status_name`) VALUES
(1, '使用中'),
(2, '已停用');

INSERT INTO `t_biz_currency_code` (`currency_code_id`, `currency_code`, `currency_desc`) VALUES
(1, '00（主货币）', '主货币'),
(2, '01', ''),
(3, '02', ''),
(4, '03', ''),
(5, '04', ''),
(6, '05', ''),
(7, '06', ''),
(8, '07', ''),
(9, '08', ''),
(10, '09', '');

INSERT INTO `t_biz_currency_type` (`currency_type_id`, `currency_type`, `currency_desc`) VALUES
(1, 'CNY(人民币)', ''),
(2, 'USD(美金)', ''),
(3, 'EUR(欧元)', ''),
(4, 'GBP(英镑)', ''),
(5, 'HDK(港币)', ''),
(6, 'JPY(日元)', ''),
(7, 'TWD(台币)', ''),
(8, 'AUD(澳元)', ''),
(9, 'KRW(韩元)', ''),
(10, 'RUR(卢布)', '');

INSERT INTO `t_sys_user` (`user_id`, `project_id`, `user_empcode`, `user_password`, `user_realname`, `user_status`, `position_id`, `create_date`, `create_by`, `last_update_date`, `last_update_by`) VALUES
(1, 0, 'admin', '202cb962ac59075b964b07152d234b70', '系统管理员', 1, 1, '2016-11-22 00:00:00', 1, NULL, NULL);

INSERT INTO `t_sys_user` (`user_id`, `project_id`, `user_empcode`, `user_password`, `user_realname`, `user_status`, `position_id`, `create_date`, `create_by`, `last_update_date`, `last_update_by`) VALUES
(2, 0, 'hqinfo', '202cb962ac59075b964b07152d234b70', '系统管理员', 1, 1, '2016-11-22 00:00:00', 1, NULL, NULL);

INSERT INTO `t_sys_user` (`user_id`, `project_id`, `user_empcode`, `user_password`, `user_realname`, `user_status`, `position_id`, `create_date`, `create_by`, `last_update_date`, `last_update_by`) VALUES
(4, 0, 'liuchen', '202cb962ac59075b964b07152d234b70', '系统管理员', 1, 1, '2016-11-22 00:00:00', 1, NULL, NULL);

INSERT INTO `t_sys_user` (`user_id`, `project_id`, `user_empcode`, `user_password`, `user_realname`, `user_status`, `position_id`, `create_date`, `create_by`, `last_update_date`, `last_update_by`) VALUES
(5, 0, 'xuyongfengfeng', '202cb962ac59075b964b07152d234b70', '系统管理员', 1, 1, '2016-11-22 00:00:00', 1, NULL, NULL);

INSERT INTO `t_sys_user` (`user_id`, `project_id`, `user_empcode`, `user_password`, `user_realname`, `user_status`, `position_id`, `create_date`, `create_by`, `last_update_date`, `last_update_by`) VALUES
(6, 0, 'fubotao', '202cb962ac59075b964b07152d234b70', '系统管理员', 1, 1, '2016-11-22 00:00:00', 1, NULL, NULL);

INSERT INTO `t_sys_user` (`user_id`, `project_id`, `user_empcode`, `user_password`, `user_realname`, `user_status`, `position_id`, `create_date`, `create_by`, `last_update_date`, `last_update_by`) VALUES
(7, 0, 'linmeng', '202cb962ac59075b964b07152d234b70', '系统管理员', 1, 1, '2016-11-22 00:00:00', 1, NULL, NULL);

INSERT INTO `t_sys_user` (`user_id`, `project_id`, `user_empcode`, `user_password`, `user_realname`, `user_status`, `position_id`, `create_date`, `create_by`, `last_update_date`, `last_update_by`) VALUES
(8, 0, 'weibingbing', '202cb962ac59075b964b07152d234b70', '系统管理员', 1, 1, '2016-11-22 00:00:00', 1, NULL, NULL);


INSERT INTO `t_sys_resource` (`resource_id`, `resource_name`, `resource_url`, `resource_status`, `resource_type`, `resource_desc`, `create_date`, `create_by`, `resourceparent_id`, `sort_num`) VALUES
(1, '项目管理', NULL, 1, 1, NULL, '2016-11-22 00:00:00', 1, 0, 0),
(2, '项目查询', 'project/data/project.retrieve.php', 1, 2, NULL, '2016-11-22 00:00:00', 1, 1, 0),
(3, '项目创建', 'project/data/project.create.php', 1, 2, NULL, '2016-11-22 00:00:00', 1, 1, 0),
(4, '项目修改', 'project/data/project.update.php', 1, 2, NULL, '2016-11-22 00:00:00', 1, 1, 0),
(5, '项目详情', NULL, 1, 2, NULL, '2016-11-22 00:00:00', 1, 1, 0),
(6, '项目导出PDF', NULL, 1, 2, NULL, '2016-11-22 00:00:00', 1, 1, 0),
(7, '项目导出EXCEL', NULL, 1, 2, NULL, '2016-11-22 00:00:00', 1, 1, 0),
(8, '账号管理', NULL, 1, 1, NULL, '2016-11-22 00:00:00', 1, 0, 0),
(9, '账号查询', 'project/data/user.retrieve.php', 1, 2, NULL, '2016-11-22 00:00:00', 1, 8, 0),
(10, '账号创建', 'project/data/user.create.php', 1, 2, NULL, '2016-11-22 00:00:00', 1, 8, 0),
(11, '账号修改', 'project/data/user.update.php', 1, 2, NULL, '2016-11-22 00:00:00', 1, 8, 0),
(12, '账号详情', NULL, 1, 2, NULL, '2016-11-22 00:00:00', 1, 8, 0),
(13, '账号导出PDF', NULL, 1, 2, NULL, '2016-11-22 00:00:00', 1, 8, 0),
(14, '账号导出EXCEL', NULL, 1, 2, NULL, '2016-11-22 00:00:00', 1, 8, 0),
(15, '基础信息设置', NULL, 1, 1, NULL, '2016-11-22 00:00:00', 1, 0, 0),
(16, '创建货币', 'basic/data/currency.create.php', 1, 2, NULL, '2016-11-22 00:00:00', 1, 15, 0),
(17, '修改货币', 'basic/data/currency.update.php', 1, 2, NULL, '2016-11-22 00:00:00', 1, 15, 0),
(18, '查询货币', 'basic/data/currency.retrieve.php', 1, 2, NULL, '2016-11-22 00:00:00', 1, 15, 0),
(19, '查询所有货币', 'basic/data/currency.retrieve.all.php', 1, 2, NULL, '2016-11-22 00:00:00', 1, 15, 0),
(20, '创建地区', 'basic/data/region.create.php', 1, 2, NULL, '2016-11-22 00:00:00', 1, 15, 0),
(21, '修改地区', 'basic/data/region.update.php', 1, 2, NULL, '2016-11-22 00:00:00', 1, 15, 0),
(22, '查询地区', 'basic/data/region.retrieve.php', 1, 2, NULL, '2016-11-22 00:00:00', 1, 15, 0),
(23, '创建编码', 'basic/data/code.create.php', 1, 2, NULL, '2016-11-22 00:00:00', 1, 15, 0),
(24, '修改编码', 'basic/data/code.update.php', 1, 2, NULL, '2016-11-22 00:00:00', 1, 15, 0),
(25, '查询编码', 'basic/data/code.retrieve.php', 1, 2, NULL, '2016-11-22 00:00:00', 1, 15, 0),
(26, '创建场景', 'basic/data/scene.create.php', 1, 2, NULL, '2016-11-22 00:00:00', 1, 15, 0),
(27, '修改场景', 'basic/data/scene.update.php', 1, 2, NULL, '2016-11-22 00:00:00', 1, 15, 0),
(28, '查询场景', 'basic/data/scene.retrieve.php', 1, 2, NULL, '2016-11-22 00:00:00', 1, 15, 0),
(29, '创建FREE', 'basic/data/free.create.php', 1, 2, NULL, '2016-11-22 00:00:00', 1, 15, 0),
(30, '修改FREE', 'basic/data/free.update.php', 1, 2, NULL, '2016-11-22 00:00:00', 1, 15, 0),
(31, '查询FREE', 'basic/data/free.retrieve.php', 1, 2, NULL, '2016-11-22 00:00:00', 1, 15, 0),
(32, '批处理', NULL, 1, 1, NULL, '2016-11-22 00:00:00', 1, 0, 0),
(33, '创建批处理', 'batch/data/batch.create.php', 1, 2, NULL, '2016-11-22 00:00:00', 1, 32, 0),
(34, '提交批处理', 'batch/data/batch.update.php', 1, 2, NULL, '2016-11-22 00:00:00', 1, 32, 0),
(35, '保存交易', 'batch/data/transaction.create.php', 1, 2, NULL, '2016-11-22 00:00:00', 1, 32, 0),
(36, '修改交易', 'batch/data/transaction.update.php', 1, 2, NULL, '2016-11-22 00:00:00', 1, 32, 0),
(37, '项目预算', NULL, 1, 1, NULL, '2016-11-22 00:00:00', 1, 0, 0),
(38, '创建预算', 'basic/data/code.create.php', 1, 2, NULL, '2016-11-22 00:00:00', 1, 37, 0),
(39, '修改预算', 'basic/data/code.update.php', 1, 2, NULL, '2016-11-22 00:00:00', 1, 37, 0),
(40, '导入预算', 'basic/data/codes.createByExcel.php', 1, 2, NULL, '2016-11-22 00:00:00', 1, 37, 0),
(41, 'PO处理', NULL, 1, 1, NULL, '2016-11-22 00:00:00', 1, 0, 0),
(42, '创建PO处理', 'poInput/data/batch.create.php', 1, 2, NULL, '2016-11-22 00:00:00', 1, 32, 0),
(43, '提交PO处理', 'poInput/data/batch.update.php', 1, 2, NULL, '2016-11-22 00:00:00', 1, 32, 0),
(44, '保存PO交易', 'poInput/data/transaction.create.php', 1, 2, NULL, '2016-11-22 00:00:00', 1, 32, 0),
(45, '修改PO交易', 'poInput/data/transaction.update.php', 1, 2, NULL, '2016-11-22 00:00:00', 1, 32, 0),
(46, 'ETC', NULL, 1, 1, NULL, '2016-11-22 00:00:00', 1, 0, 0),
(47, '创建ETC', 'etc/data/etc.create.php', 1, 2, NULL, '2016-11-22 00:00:00', 1, 46, 0),
(48, '修改ETC', 'etc/data/etc.update.php', 1, 2, NULL, '2016-11-22 00:00:00', 1, 46, 0),
(49, '导入ETC', 'etc/data/etc.createByExcel.php', 1, 2, NULL, '2016-11-22 00:00:00', 1, 46, 0),
(50, 'PO一键清零', 'poInput/data/poInput.clear.php', 1, 2, NULL, '2016-11-22 00:00:00', 1, 32, 0),
(51, 'ETC一键清零', 'etc/data/etc.clear.php', 1, 2, NULL, '2016-11-22 00:00:00', 1, 46, 0),
(52, '还原预算', 'basic/data/code.recovery.php', 1, 2, NULL, '2016-11-22 00:00:00', 1, 37, 0),
(53, '删除预算', 'basic/data/code.delete.php', 1, 2, NULL, '2016-11-22 00:00:00', 1, 37, 0),
(54, '删除批处理', 'batch/data/batch.delete.php', 1, 2, NULL, '2016-11-22 00:00:00', 1, 32, 0),
(55, '删除PO', 'poInput/data/batch.delete.php', 1, 2, NULL, '2016-11-22 00:00:00', 1, 41, 0);

INSERT INTO `t_sys_role` (`role_id`, `role_name`, `role_desc`, `role_status`, `create_date`, `create_by`) VALUES
(1, 'admin', '系统管理员权限', 1, '2016-11-22 00:00:00', 1),
(2, 'LEVEL00', 'LEVEL00权限', 1, '2016-11-22 00:00:00', 1),
(3, 'LEVEL01', 'LEVEL01权限', 1, '2016-11-22 00:00:00', 1),
(4, 'LEVEL02', 'LEVEL02权限', 1, '2016-11-22 00:00:00', 1);

INSERT INTO `t_sys_roleresource` (`role_id`, `resource_id`) VALUES
(1, 1),(1, 2),(1, 3),(1, 4),(1, 5),(1, 6),(1, 7),(1, 8),(1, 9),(1, 10),(1, 11),(1, 12);

INSERT INTO `t_sys_roleresource` (`role_id`, `resource_id`) VALUES
(2, 15),(2, 16),(2, 17),(2, 18),(2, 19),(2, 20),(2, 21),(2, 22),(2, 23),(2, 24),(2, 25),(2, 26),(2, 27),(2, 28),(2, 29),(2, 30),
(2, 31),(2, 32),(2, 33),(2, 34),(2, 35),(2, 36),(2, 37),(2, 38),(2, 39),(2, 40),(2, 41),(2, 42),(2, 43),(2, 44),(2, 45),(2, 46),
(2, 47),(2, 48),(2, 49),(2, 50),(2, 51),(2, 52),(2, 53),(2, 54),(2, 55);

INSERT INTO `t_sys_roleresource` (`role_id`, `resource_id`) VALUES
(3, 32),(3, 33),(3, 34),(3, 35),(3, 36),(3, 41),(3, 42),(3, 43),(3, 44),(3, 45),(3, 46),(3, 47),(3, 48),(3, 49),(3, 50),(3, 51),(3, 54),(3, 55);

INSERT INTO `t_sys_roleresource` (`role_id`, `resource_id`) VALUES
(3, 32),(3, 33),(3, 34),(3, 35),(3, 36),(3, 41),(3, 42),(3, 43),(3, 44),(3, 45),(3, 46),(3, 47),(3, 48),(3, 49),(3, 50),(3, 51),(3, 54),(3, 55);

INSERT INTO `t_sys_roleresource` (`role_id`, `resource_id`) VALUES
(5, 32),(5, 33),(5, 34),(5, 35),(5, 36);