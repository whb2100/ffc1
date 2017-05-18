<?php include '../common/session_init.php';?>
<?php include '../common/sessionCheck.php';?>
<?php include '../common/resourceCheck.php';?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <?php include '../common/include_css.php';?>
    </head>
    
    <body>
		<div class="am-cf admin-main">
            <div class="admin-content" >
              <div class="am-cf am-padding" id="_title">
            	  <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">用户管理</strong> / <small>用户列表</small></div>
              </div>
              <div class="am-g">
                	<div class="col-md-6 am-cf" id="_query" style="width: 100%">
        				<div>
        					<span style="margin-left: 208px">登录账号：</span><input class="easyui-textbox" type="text" style="width: 180px;height:28px" name="user_empcode" id="userEmpcode">
        					<div style="float:right;margin-top:-10px;margin-right:3px">
								<div style="cursor:pointer;float:left;"><img src="../img/tys_icon_search.png" onclick="reloadgrid();" /></div>
								<div style="cursor:pointer;float:left;margin-left:2px;"><img src="../img/tys_icon_add.png" onclick="addSysUser();" /></div>
								<div style="cursor:pointer;float:left;margin-left:2px;"><img src="../img/tys_icon_change.png" onclick="editSysUser();" /></div>
								<div style="cursor:pointer;float:left;margin-left:2px;"><img src="../img/tys_icon_export.png" onclick="exportExccel();" /></div>
							</div>
    					</div>
            		</div>
              </div>
              <table style="width:100%">
              	<tr>
              		<td valign="top" style="width:220px">
		              <div style="float:left;margin-right:50px;display:inline;"><ul id="departmentTree" class="easyui-tree" animate="true" data-options="lines:true" style="height:70%;weight:50%;"></ul></div>
              		</td>
              		<td>
		              <div id="sysUserList"></div>
              		</td>
              	</tr>
              </table>
            </div>
		</div>
		
		<!--新增dialog-->
		<div id="departDialog" class="easyui-dialog" style="width: 320px; height: 390px; padding: 10px 20px;"
        closed="true" buttons="#depart-buttons">
	       <form id="departForm" method="post">
		       <input id="parentId" type="hidden" name="parent_id">
		       <input id="dialogDepartmentCode" type="hidden" name="dept_code">
		        <div style="margin-bottom:15px;margin-top:30px">
		             <span style="font-size:15px">部门名称：</span>
		             <input style="height:23px;width:150px;margin-left:13px" class="easyui-validatebox textbox" type="text" id="diologDepartmentName" name="dept_name" data-options="required:true,validType:'repeat'" missingMessage="请填写部门名称"></input>
		        </div>
		        <div style="margin-bottom:17px;margin-top:10px">
		             <span style="font-size:15px">上级部门：</span>
			        <ul id="departTree" class="easyui-tree" animate="true" data-options="lines:true" style="height:150px;weight:250px"></ul>
		        </div>
	       </form>
	   </div>
	   
	   <!--修改dialog-->
		<div id="updateDepartDialog" class="easyui-dialog" style="width: 320px; height: 390px; padding: 10px 20px;"
        closed="true" buttons="#updateDepart-buttons">
	       <form id="updateDepartForm" method="post">
		       <input id="updateDepartmentId" type="hidden" name="dept_id">
		       <input id="updateParentId" type="hidden" name="parent_id">
		       <input id="updateDepartmentCode" type="hidden" name="dept_code">
		        <div style="margin-bottom:15px;margin-top:30px">
		             <span style="font-size:15px">部门名称：</span>
		             <input style="height:23px;width:150px;margin-left:13px" class="easyui-validatebox textbox" type="text" id="updateDepartmentName" name="dept_name" data-options="required:true" missingMessage="请填写部门名称"></input>
		        </div>
		        <div style="margin-bottom:17px;margin-top:10px">
		             <span style="font-size:15px">上级部门：</span><span style="font-size:18px" id="updateParentName"></span>
		             <br>
			        <ul id="updateDepartTree" class="easyui-tree" animate="true" data-options="lines:true" style="height:150px;weight:280px"></ul>
		        </div>
	       </form>
	   </div>
	
	 <div id="updateDepart-buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton" onclick="saveUpdateDepart()" iconcls="icon-save">保存</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" onclick="javascript:$('#updateDepartDialog').dialog('close')" iconcls="icon-cancel">取消</a>
    </div>
   <div id="depart-buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton" onclick="saveDepart()" iconcls="icon-save">保存</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" onclick="javascript:$('#departDialog').dialog('close')" iconcls="icon-cancel">取消</a>
    </div>
    
    <div id="menu" class="easyui-menu" style="width:120px;">
		<div onclick="addDepart()" data-options="iconCls:'icon-add'">新增</div>
		<div onclick="updataDepart()" data-options="iconCls:'icon-edit'">修改</div>
		<div onclick="deleteDepart()" data-options="iconCls:'icon-remove'">删除</div>
	</div>
	<form id="menuForm">
		<input type="hidden" id="departMenuId">
		<input type="hidden" id="departMenuName">
		<input type="hidden" id="departMenuParentId">
		<input type="hidden" id="departMenuParentName">
		<input type="hidden" id="departMenuParentCode">
	</form>
		<input value="<?php echo $_SESSION[common\Constants::LOGINED_USER_ID_IN_SESSION];?>" name="user_id" id="userId" type="hidden">
		<input id="resource_url" type="hidden" value="sys/data/user.export.php">
		<?php include '../common/include_js.php';?>
        <script type="text/javascript" src="js/user-list.js"></script>
    </body>
</html>