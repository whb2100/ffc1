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
            	  <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">角色管理</strong> / <small>角色列表</small></div>
              </div>
              <div class="am-g">
                	<div class="col-md-6 am-cf" id="_query" style="width: 100%">
        				<div>
        					角色名：<input class="easyui-textbox" type="text" style="width: 180px;height:28px" name="role_name" id="roleName">
        					<div style="float:right;margin-top:-10px;margin-right:3px">
								<div style="cursor:pointer;float:left;"><img src="../img/tys_icon_search.png" onclick="reloadgrid();" /></div>
								<div style="cursor:pointer;float:left;margin-left:2px;"><img src="../img/tys_icon_add.png" onclick="addSysRole();" /></div>
								<div style="cursor:pointer;float:left;margin-left:2px;"><img src="../img/tys_icon_change.png" onclick="editSysRole();" /></div>
								<div style="cursor:pointer;float:left;margin-left:2px;"><img src="../img/tys_icon_export.png" onclick="exportExccel();" /></div>
							</div>
    					</div>
            		</div>
              </div>
              <div id="sysRoleList"></div>
            </div>
		</div>
		
		<!--新增，修改dialog-->
		<div id="sysRoleDialog" class="easyui-dialog" style="width: 430px; height: 550px; padding: 10px 20px;"
       closed="true" buttons="#sysRole-buttons">
       <form id="sysRoleForm" method="post">
       <input id="dialogRoleId" type="hidden" name="role_id">
       <input id="resourceIds" type="hidden" name="resource_ids">
        <div style="margin-bottom:15px">
             <span>角色名称：</span>
             <input style="height:20px;width:150px;" class="easyui-validatebox textbox" type="text" id="dialogRoleName" name="role_name" data-options="required:true,validType:'repeat'" missingMessage="请填写角色名称"></input>
        </div>
         <div style="margin-bottom:15px">
             <span>角色状态：&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</span>
             <input type="radio" id="dialogRoleStatus-enable" name="role_status" value="1">&nbsp 正常&nbsp &nbsp 
             <input type="radio" id="dialogRoleStatus-disable" name="role_status" value="0">&nbsp 不可用
        </div>
         <div style="margin-bottom:15px">
             <span>角色说明：</span>
             <textarea name="role_desc" id="dialogRoleDesc" style="width: 200px;height: 100px;resize: none;"></textarea>
        </div>
        <div style="margin-bottom:15px;" class="role">
            <span>角色权限：</span>
        	<div id="allocatedResource" style="width: 70%;"></div>
        </div>
       </form>
   </div>

   <div id="sysRole-buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton" onclick="saveSysRole()" iconcls="icon-save">保存</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" onclick="javascript:$('#sysRoleDialog').dialog('close')"
            iconcls="icon-cancel">取消</a>
    </div>
    	<input value="<?php echo $_SESSION[common\Constants::LOGINED_USER_ID_IN_SESSION];?>" name="user_id" id="userId" type="hidden">
		<input id="resource_url" type="hidden" value="sys/data/role.export.php">
		<?php include '../common/include_js.php';?>
        <script type="text/javascript" src="js/role-list.js"></script>
    </body>
</html>