<html>
    <head>
        <?php include '../common/include_css.php';?>
    </head>
    
    <body>
    	<fieldset>
		<div class="am-cf admin-main">
		  <div class="admin-content">
		      <form id="sysUserRegisterForm" method="post" action="data/user.update.php" enctype="multipart/form-data" class="easyui-form" style="margin-left: 50px">
		          
		          <legend>用户编辑</legend>
		          <br>
		          <input id="formUserId" type="hidden" name="user_id" value="<?php echo $_GET['formUserId']?>">
		          <input id="userEmpcode" type="hidden"value="<?php echo $_GET['userEmpcode']?>">
		          <input id="roleIds"  name="role_ids" type="hidden">
		        <div style="margin-bottom:15px">
		             <span>登录账号：</span>
		             <input style="height: 30px;width: 200px;margin-left: 8px" class="easyui-validatebox textbox" type="text" id="formUserEmpcode" name="user_empcode" data-options="required:true,validType:'repeat'" validType="repeat" missingMessage="请填写系统登录名"></input>
		        </div>
		        <div style="margin-bottom: 15px">
						<span>真实姓名：</span>
						<input style="height: 30px; width: 200px; margin-left: 8px" class="easyui-validatebox textbox" type="text" id="formUserRealname" name="user_realname" data-options="required:true" missingMessage="请填写真实姓名"></input>
					</div>
					<div style="margin-bottom: 15px">
						<span>职级：</span>
						<input style="height: 30px; width: 200px; margin-left: 32px" class="easyui-validatebox textbox" type="text" id="formUserRank" name="user_rank" data-options="required:true" missingMessage="请填写职级"></input>
					</div>
					<div style="margin-bottom: 15px">
						<span>邮箱：</span>
						<input style="height: 30px; width: 200px; margin-left: 32px" class="easyui-validatebox textbox" type="text" id="formUserEmail" name="user_email" data-options="required:true" missingMessage="请填写邮箱" validType="email"></input>
					</div>
		        <div style="margin-bottom:15px">
		             <span>手机号码：</span>
		             <input style="height: 30px;width: 200px;margin-left: 8px" class="easyui-validatebox textbox" type="text" id="formUserMobile" validType="mobile" name="user_mobile" data-options="required:true" missingMessage="请填写手机号码"></input>
		        </div>
		         <div style="margin-bottom:15px">
		             <span>用户状态：&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp </span>
		             <input type="radio" id="formUserStatus-enable" name="user_status" value="1">&nbsp 正常</input>
		             <input type="radio" id="formUserStatus-disable" name="user_status" value="0">&nbsp 不可用</input>
		        </div>
		        <input id="departmentId" type="hidden" name="depart_id">
				<div style="margin-bottom: 15px;">
						<span style="margin-right: 33px">部门：</span><span style="font-size:18px" id="departName"></span>
						<div style="margin-left:25px"><ul id="departmentTree" class="easyui-tree" animate="true" data-options="lines:true" style="weight:50%;"></ul></div>
					</div>
		       <!--  <div style="margin-bottom:15px">
		             <span style="margin-right: 9px">用户照片：</span>
		             <input class="easyui-fileBox"  name="user_newImg" id="formUserImg" data-options="buttonText:'选择图片'">
		             <input name="user_oldImg" id="userOldImg" type="hidden">
		        </div> -->
    		      <div style="margin-bottom: 15px;" class="role">
    				<span style="margin-right: 13px">用户角色：</span>
    				<div id="allocatedRole" style="width: 20%;"></div>
    			  </div>
		        <div style="margin-bottom:15px">
		             <span style="margin-right: 9px">备注信息：</span>
		             <textarea id="formUserDesc" name="user_desc" style="width: 230px;height: 100px;resize: none;"></textarea>
		        </div>
		         
		      </form>
	          <div style="margin: 10px 0px 0px 200px">
	              <a class="easyui-linkbutton" style="width: 80px" onclick="submitFunction()">提交</a>
	              <a class="easyui-linkbutton" style="width: 80px" onclick="cancelFunction()">取消</a>
	          </div>
		  </div>
		</div>
		 </fieldset>
		<?php include '../common/include_js.php';?>
		<script type="text/javascript" src="js/user-update.js"></script>
    </body>
</html>