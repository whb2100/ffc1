<html>
<head>
    <?php include '../common/include_css.php';?>
</head>

<body>
	<fieldset>
	<div class="am-cf admin-main">
		  <div class="admin-content">
			<form id="sysUserRegisterForm" method="post"
				action="data/user.create.php" enctype="multipart/form-data"
				class="easyui-form" style="margin-left: 50px">
				
					<legend>用户注册</legend>
					<br>
					<input id="formUserId" type="hidden" name="user_id"> 
					<input id="roleIds"  name="role_ids" type="hidden"> 
					<div style="margin-bottom: 15px">
						<span>登录账号：</span> <input style="height: 30px; width: 200px;margin-left:8px"
							class="easyui-validatebox textbox" type="text"
							id="formUserEmpcode" name="user_empcode"
							data-options="required:true,validType:'repeat'"
							missingMessage="请填写系统登录名"></input>
					</div>
					<div style="margin-bottom: 15px">
						<span>登录密码：</span> <input
							style="height: 30px; width: 200px; margin-left: 8px"
							class="easyui-validatebox textbox" type="password"
							id="formUserPassword" name="user_password"
							data-options="required:true" missingMessage="请填写登陆密码"></input>
					</div>
					<div style="margin-bottom: 15px">
						<span>确认密码：</span> <input
							style="height: 30px; width: 200px; margin-left: 8px"
							class="easyui-validatebox textbox" type="password"
							id="rePassword" name="re_password"
							data-options="required:true,validType:'equalTo'"
							missingMessage="请填再次输入密码"></input>
					</div>
					<div style="margin-bottom: 15px">
						<span>真实姓名：</span> <input
							style="height: 30px; width: 200px; margin-left: 8px"
							class="easyui-validatebox textbox" type="text"
							id="formUserRealname" name="user_realname"
							data-options="required:true" missingMessage="请填写真实姓名"></input>
					</div>
					<div style="margin-bottom: 15px">
						<span>职级：</span> <input
							style="height: 30px; width: 200px; margin-left: 32px"
							class="easyui-validatebox textbox" type="text"
							id="formUserRank" name="user_rank"
							data-options="required:true" missingMessage="请填写职级"></input>
					</div>
					<div style="margin-bottom: 15px">
						<span>邮箱：</span> <input
							style="height: 30px; width: 200px; margin-left: 32px"
							class="easyui-validatebox textbox" type="text"
							id="formUserEmail" name="user_email"
							data-options="required:true" missingMessage="请填写邮箱" validType="email"></input>
					</div>
					<div style="margin-bottom: 15px">
						<span>手机号码：</span> <input
							style="height: 30px; width: 200px; margin-left: 8px"
							class="easyui-validatebox textbox" type="text"
							id="formUserMobile" validType="mobile" name="user_mobile"
							data-options="required:true" missingMessage="请填写手机号码"></input>
					</div>
					<div style="margin-bottom: 15px">
						<span>证件号码：</span> <input
							style="height: 30px; width: 200px; margin-left: 8px"
							class="easyui-validatebox textbox" type="text"
							id="formUserCertificateNO"  name="user_certificate_no"
							 missingMessage="请填写证件号码"></input><span style="margin-left:5px;color:red">注：此处填写身份证号码（非必填项）</span>
					</div>
					<div style="margin-bottom: 15px">
						<span>用户状态：&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</span> <input
							type="radio" id="formUserStatus" name="user_status" value="1"
							checked>&nbsp 正常</input> <input type="radio" id="formUserStatus"
							name="userStatus" value="0">&nbsp 不可用</input>
					</div>
					<input id="departmentId" type="hidden" name="depart_id">
					<div style="margin-bottom: 15px;">
						<span style="margin-right: 33px;">部门：</span>
						<div style="margin-left:25px"><ul id="departmentTree" class="easyui-tree" animate="true" data-options="lines:true" style="weight:50%;"></ul></div>
					</div>
        			<div style="margin-bottom: 15px;" class="role">
        				<span style="margin-right: 13px">用户角色：</span>
        				<div id="allocatedRole" style="width: 20%;"></div>
        			</div>
					<div style="margin-bottom: 15px">
						<span style="margin-right: 9px">备注信息：</span>
						<textarea name="user_desc" id="formUserDesc"
							style="width: 230px; height: 100px; resize: none;"></textarea>
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
		<script type="text/javascript" src="js/user-create.js"></script>
</body>
</html>