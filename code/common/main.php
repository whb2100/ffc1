<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>FENG HE</title>
        <?php include 'include_css.php';?>
        <?php include 'include_js.php';?>
        <script type="text/javascript" src="../js/main.js"></script>
    </head>
    
    <style>
		.content { border-radius:8px; border:1px solid #5cb4e8; width:380px;}
		.content h2{  background:url(icon.png) no-repeat; padding-left:50px; font-size:18px; color:#5cb4e8; margin-left:20px; border-bottom:2px solid #5cb4e8; line-height:40px; width:290px;}
		.content ul{ padding-left:2px}
		.content li {font-size: 14px; color: #5cb4e8; display: inline-block; width: 90%; margin-left: 30px; line-height:30px; border-bottom:#eeeeee solid 1px;}
	</style>
	
    <body id="body">
      <div class="am-topbar admin-header">
			<?php include 'header.php';?>
		</div> 
		
		<div class="am-cf admin-main">
			<?php include 'leftmenu.php';?>
			<div class="admin-content">
			
			<iframe id="mainFrame" src="" style="width: 100%;height: 94%;display:none;min-height: 500px;"></iframe>
			
			<!-- 修改密码 -->
			<div class="easyui-dialog" id="resetUserPasswordDialog" closed="true" title="<?php echo UPDATE_PASS ?>" buttons="#resetUserPasswordDialog-buttons" style="width: 400px; height: 300px; padding: 10px 20px;"  data-options="resizable:true,modal:true, closable: false"  >
			     <form action="../sys/data/userPassword.update.php" id="resetUserPasswordForm" method="post">
			         <div style="margin:35px 0px 15px 0px">
                         <span style="margin-right: 23px"><?php echo PASS_OLD ?></span>
                         <input class="easyui-validatebox textbox" style="width:160px" type="password" name="user_oldPassword" data-options="required:true"     missingMessage="<?php echo MISS_PASS_OLD ?>">
                    </div>
                    <div style="margin:0px 0px 15px 0px">
                         <span style="margin-right: 23px"><?php echo PASS_NEW ?></span>
                         <input class="easyui-validatebox textbox" style="width:160px" type="password" name="user_newPassword" id="userNewPassword" data-options="required:true"      missingMessage="<?php echo MISS_PASS_NEW ?>">
                    </div>
                    <div style="margin-bottom:15px">
                         <span><?php echo PASS_NEW_SURE ?></span>
                         <input class="easyui-validatebox textbox" style="width:160px" type="password" data-options="required:true,validType:'equalTo'"     missingMessage="<?php echo MISS_PASS_NEW_SURE ?>">
                    </div>
			     </form>
			</div>
			<div id="resetUserPasswordDialog-buttons">
                <a href="javascript:void(0)" class="easyui-linkbutton" onclick="submitResetUserPasswordForm()" iconcls="icon-save"><?php echo SAVE ?></a>
                <a href="javascript:void(0)" class="easyui-linkbutton" onclick="javascript:$('#resetUserPasswordDialog').dialog('close')" iconcls="icon-cancel"   id="cancle"  style="display:none"><?php echo CANCLE ?></a>
            </div>
			

			<!-- 修改个人信息 -->
			<div class="easyui-dialog" id="resetUserInfoDialog" closed="true" title="修改个人信息" buttons="#resetUserInfoDialog-buttons" style="width: 400px; height: 400px; padding: 10px 20px;">
			     <form action="../sys/data/user.updateInfo.php" id="resetUserInfoForm" method="post">
			         <div style="margin:35px 0px 15px 0px">
			         	 <input id="formUserId" type="hidden" name="user_id" value="<?php  echo $_SESSION[common\Constants::LOGINED_USER_ID_IN_SESSION];?>">
		        <div style="margin-bottom: 15px">
						<span>真实姓名：</span>
						<input style="height: 30px; width: 200px; margin-left: 8px" class="easyui-validatebox textbox" type="text" id="formUserRealname" name="user_realname" data-options="required:true" missingMessage="请填写真实姓名"></input>
					</div>
					<div style="margin-bottom: 15px">
						<span>邮箱：</span>
						<input style="height: 30px; width: 200px; margin-left: 32px" class="easyui-validatebox textbox" type="text" id="formUserEmail" name="user_email" data-options="required:true" missingMessage="请填写邮箱" validType="email"></input>
					</div>
					<div style="margin-bottom: 15px">
						<span  style='margin-right: 10px;'>手机号码：</span>  <input style="height: 30px;width: 200px;" class="easyui-validatebox textbox" type="text" id="formUserMobile" validType="mobile" name="user_mobile" data-options="required:true" missingMessage="请填写手机号码"></input>
					</div>
		        <div style="margin-bottom:15px">
		             <span style="margin-right: 9px">备注信息：</span>
		             <textarea id="formUserDesc" name="user_desc" style="width: 230px;height: 100px;resize: none;"></textarea>
		        </div>
                    </div>
			     </form>
			</div>
			<div id="resetUserInfoDialog-buttons">
                <a href="javascript:void(0)" class="easyui-linkbutton" onclick="submitFunction()" iconcls="icon-save">保存</a>
                <a href="javascript:void(0)" class="easyui-linkbutton" onclick="javascript:$('#resetUserInfoDialog').dialog('close')" iconcls="icon-cancel">取消</a>
            </div>
            
			</div>
		</div>
    </body>
</html>