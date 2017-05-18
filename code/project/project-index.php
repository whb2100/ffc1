<html>
<head>
<?php include '../common/include_css.php';?>
<?php include '../common/session_init.php';?>
<?php include '../common/change_language.php';?>
</head>

<body>

<div class="subnav"> 
	<div class="subnav_all">
		    	 <select name="pro" class="easyui-combobox" style="width:100px; height:36px" id="pro" editable="false">
				<option value="1"><?php echo PRJ_SN ?></option>
				<option value="2"><?php echo PRJ_NAME ?></option>
				<option value="3"><?php echo USER_REALNAME ?></option>
			</select>	
			<span style="margin-left: 5px;"></span>
		     <input class="easyui-textbox" type="text"  name="pro_name" id="proName"   style="width:150px;height:36px;"> 
		     <span style="margin-left: 5px;"><?php echo PRJ_STATUS ?>：</span>
		   	 <select name="project_status" class="easyui-combobox" style="width:100px;height:36px" id="proStatus"  editable="false">
				<option value=""><?php echo PRJ_STATUS_ALL ?></option>
				<option value="1"><?php echo PRJ_STATUS_READYING ?></option>
				<option value="2"><?php echo PRJ_STATUS_ONGOING ?></option>
				<option value="3"><?php echo PRJ_STATUS_POST ?></option>
				<option value="4"><?php echo PRJ_STATUS_FINISH ?></option>
				<option value="5"><?php echo PRJ_STATUS_DISABLE ?></option>
			</select>	
			 <span style="margin-left: 5px;"><?php echo CREATE_DATE ?>：</span><input class="easyui-datebox" type="text"   style="width:145px;height:36px" name="start_date" id="startDate">&nbsp;&nbsp;<?php echo CREATE_DATE_TO ?>&nbsp;&nbsp;<input class="easyui-datebox" type="text" style="width:145px;height:36px" name="end_date" id="endDate"  >
			
			<input id="PRO" type="hidden"  value="">
			<input id="PROSTATUS" type="hidden"  value="">
			<input id="STARTDATE" type="hidden"  value="">
			<input id="ENDDATE" type="hidden"  value="">
			


		<div class="subnav_button">
		<div class="search" ><a href="javascript:void(0)" onclick="reloadgrid()"><?php echo SEARCH ?></a></div>
		<span><a  href="javascript:void(0)" onclick="createProject()"><em><img src="../images/icon_create.png"/></em><?php echo CREATE_PRJ ?></a></span>
		<!-- <span><a  href="javascript:void(0)" onclick="ExcleFunction()"><em><img src="../images/icon_type.png"/></em>Excel</a></span> 
		<span><a  href="javascript:void(0)" onclick="PDFFunction()"><em><img src="../images/icon_type.png"/></em>PDF</a></span>  -->
		</div>
	</div>
</div> 

<iframe id="projectFrame" src="" style="width: 100%;height: 100%;display:none;min-height: 500px;"></iframe>

<?php include '../common/include_js.php';?>
<script type="text/javascript" src="js/project-index.js?v=<?php echo $JS_VERSION;?>"></script>
</body>
</html>
