<html>
<head>
<?php include '../common/include_css.php';?>
<?php include '../common/session_init.php';?>
<?php include '../common/change_language.php';?>
</head>

<body>


		

<div class="content_title">
	<span><?php echo CURRENT_LOCATION ?>： <a  href="project-list.php"><?php echo PROJECT_MANAGEMENT ?></a> > <a  href="user-list.php?formProjectId=<?php echo $_GET['formProjectId']?>&code=<?php echo $_GET['code']?>"><?php echo $_GET['code']?></a>  > <?php echo SET_ACCOUNT ?></span>
</div>



<input id="code" type="hidden" name="code" value="<?php echo $_GET['code']?>">
<div class="creat_text">
  	<div class="creat_text_left">
 		 <ul>
    			<li><?php echo PRJ_SN ?></li>
    			<li><?php echo PRJ_NAME ?></li>
        			<li><?php echo USER_EMPCODE ?></li>
         			<li> <?php echo USER_STATUS_NAME ?></li>
         			<li> <?php echo USER_PASSWORD ?></li>
	         		<li><?php echo POSITION_NAME ?></li>
	         		<li><?php echo USER_REALNAME ?></li>
  		</ul>
  	</div>
  	
   	<div class="creat_text_right">
   		
  		<ul>
		    	<li><input class="easyui-validatebox textbox" type="text"  name="project_code" id="projectCode"   style="width:288px;height:36px;"  readOnly="true"  data-options="required:true"  missingMessage="<?php echo MISS_PRJ_SN ?>"><span  style="color: red">*</span></li>
		    	<li><input class="easyui-validatebox textbox" type="text"  name="project_name" id="projectName"   style="width:288px;height:36px;"  readOnly="true"   data-options="required:true"  missingMessage="<?php echo MISS_PRJ_NAME ?>"><span  style="color: red">*</span></li>
		    	<li><input class="easyui-validatebox textbox" type="text"  name="user_empcode" id="userEmpcode"   style="width:288px;height:36px;"   readOnly="true"  data-options="required:true"  missingMessage="<?php echo MISS_USER_EMPCODE ?>"><span  style="color: red">*</span></li>
		    	<form id="test" method="post"   action="data/user.update.php" enctype="multipart/form-data"   class="easyui-form" ><input id="projectId" type="hidden" name="project_id" value="<?php echo $_GET['formProjectId']?>"><input id="userId" type="hidden" name="user_id" value="<?php echo $_GET['formUserId']?>">
		    	<li >
		    		<select name="user_status" class="easyui-combobox" style="width:300px;height:40px" id="userStatus"   editable="false">
				<option value="1"><?php echo USER_STATUS_ONGOING ?></option>
				<option value="2"><?php echo USER_STATUS_DISABLE ?></option>
				</select><span  style="color: red">*</span>
		    	</li>
		    	<li><input class="easyui-validatebox textbox" type="password"  name="user_password" id="userPassword"   style="width:288px;height:36px;"  data-options="required:false"  placeholder="<?php echo NO_USER_PASSWORD ?>"></li>
		    	<li >
		    		<select name="position_id" class="easyui-combobox" style="width:300px;height:40px" id="positionId"   editable="false">
				<option value="2">LEVEL00</option>
				<option value="3">LEVEL01</option>
				<option value="4">LEVEL02</option>
				<option value="5">LEVEL03</option>
				</select><span style="color: red">*</span>
		    	</li>
		    	<li><input class="easyui-validatebox textbox" type="text"  name="user_realname" id="userRealname"   style="width:288px;height:36px;"  data-options="required:true"  missingMessage="<?php echo MISS_USER_REALNAME ?>"><span  style="color: red">*</span></li>
  		</ul>
  	</form>
  	</div>
</div>
<div class="button_qd">
  	<ul>
    		<li><a href="javascript:void(0)"   onClick="submitFunction()"><img src="../images/icon_qd.png" width="22" height="22" style="margin-bottom: 0px;"/><span>确   定</span></a></li>
  	</ul>
</div>
<?php include '../common/include_js.php';?>
<script type="text/javascript" src="js/user-update.js?v=<?php echo $JS_VERSION;?>"></script>
</body>
</html>
