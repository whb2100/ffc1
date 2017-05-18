<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <?php include '../common/include_css.php';?>
		<?php include '../common/session_init.php';?>
		<?php include '../common/change_language.php';?>
    </head>
    
    <body>
		<div class="set_subnav"> 
			<div class="set_subnav_all">
				<div class="set_subnav_left">
					<ul>
						<li>
							<p><?php echo CURRENCY?></p>
							<span><input class="easyui-textbox" type="text" style="height:35px;" name="" id=""></span>
						</li>
						<li>
							<p><?php echo REGION?></p>
							<span><input class="easyui-textbox" type="text" style="height:35px;" name="" id=""></span>
						</li>
						<li>
							<p><?php echo MAIN_CODE?></p>
							<span><input class="easyui-textbox" type="text" style="height:35px;" name="" id=""></span>
						</li>
						<li>
							<p><?php echo SUB_CODE?></p>
							<span><input class="easyui-textbox" type="text" style="height:35px;" name="" id=""></span>
						</li>
						<li>
							<p><?php echo SCENE?></p>
							<span><input class="easyui-textbox" type="text" style="height:35px;" name="" id=""></span>
						</li>
						<li>
							<p>F1</p>
							<span><input class="easyui-textbox" type="text" style="height:35px;" name="" id=""></span>
						</li>
						<li>
							<p>F2</p>
							<span><input class="easyui-textbox" type="text" style="height:35px;" name="" id=""></span>
						</li>
						<li>
							<p>F3</p>
							<span><input class="easyui-textbox" type="text" style="height:35px;" name="" id=""></span>
						</li>
						<li>
							<p><?php echo ASSET?></p>
							<span><input class="easyui-textbox" type="text" style="height:35px;" name="" id=""></span>
						</li>
					</ul>
				</div>
				<div class="set_subnav_middle" style="display:none">
					<ul>
						<li><span><?php echo CREATE_DATE?>：</span><input class="easyui-datebox" type="text" style="height:36px;" name="start_date" id="startDate"  editable="false"></li>
						<li><span>--</span><input class="easyui-datebox" type="text" style="height:36px;" name="end_date" id="endDate"  editable="false"></li>
					</ul>
				</div>
				<div class="set_subnav_button" style="display:none">
					<div class="set_search" ><a href="javascript:void(0)" onclick="searchItem()"><?php echo SEARCH?></a></div>
					<span><a  href="javascript:void(0)" onclick="PDFFunction()"><em><img src="../images/icon_type.png"/></em><?php echo PRINT_ITEM?></a></span> 
				</div>
			</div>
		</div>


		<div class="xmys_title"> <span><?php echo CURRENT_LOCATION?><span id="pName" style="font-size: 20px;"></span>ETC</span>
	  		<div class="xmys_right_button">
	    		<ul>
	      			<!-- <li><a href="javascript:void(0)"     onClick="importExcel();"><img src="../images/icon_daoru.png"/></a></li>
					<form id="budgetsFileForm" method="post" enctype="multipart/form-data"  style="display: none">
        				<input id="projectIds" type="hidden" name="project_id">
        				<input type="file" id="budgetsFile" name="budgets_file"  onChange="importBudgets()">
        			</form>
	      			<li class="xmys_button_download"><a href="javascript:void(0)"  onClick="downloadModel();"><em><img src="../images/icon_download.png"/></em><?php //echo DOWNLOAD?></a></li> -->
	      			<li><a href="javascript:void(0)" onClick="importExcel();"><img src="../images/icon_upload_<?php echo $language;?>.png"/></a></li>
	      			<form id="budgetsFileForm" method="post" enctype="multipart/form-data"  style="display: none">
	        				<input type="file" id="budgetsFile" name="budgets_file"  onChange="importBudgets()">
        				</form>
	      			<li class="xmys_button_download"><a href="javascript:void(0)"  onClick="confirmDetail();"><em><img src="../images/icon_shanchu.png"/></em><?php echo ETC_DELETE?></a></li>
	      			<li class="xmys_button_download" style="margin-right: 20px"><a  href="javascript:void(0)" onclick="ExcleFunction()"><em><img src="../images/icon_type.png"/></em>Excel</a></li>
	    		</ul>
	  		</div>
		</div>
		<div style="margin-left: 100px;margin-top:25px">
		<div id="itemList"></div>
		</div>
		
        <!-- 密码验证 -->
		<div class="easyui-dialog" id="checkPwdDialog" closed="true" title=<?php echo CHECK_PWD ?> buttons="#checkPwdDialog-buttons" style="width: 380px; height: 150px; padding: 10px 20px;"  data-options="resizable:true,modal:true, closable: false"  >
            <span id="checkBatchId" style="display: none;"></span>
            <div style="margin:15px 0px 15px 0px">
                 <span style="margin-right: 23px"><?php echo BATCH_PWD ?></span>
                 <input class="easyui-validatebox textbox" style="width:160px" type="password" id="checkPassword" data-options="required:true" missingMessage="<?php echo BATCH_PWD_INPUT ?>">
             </div>
		</div>
		<div id="checkPwdDialog-buttons">
            <a href="javascript:void(0)" class="easyui-linkbutton" onclick="checkPwd()" iconcls="icon-save"><?php echo CONFIRM ?></a>
            <a href="javascript:void(0)" class="easyui-linkbutton" onclick="javascript:$('#checkPwdDialog').dialog('close')" iconcls="icon-cancel"   id="cancle" ><?php echo CANCLE ?></a>
        </div>
		
		<input value="<?php echo $_SESSION['hqinfo_qm_current_user_project_id_session'];?>" id="projectId" type="hidden">
		<input value="<?php echo $_SESSION['hqinfo_qm_current_user_id_in_session'];?>" id="userId" type="hidden">
		<?php include '../common/include_js.php';?>
        <script type="text/javascript" src="js/etc-create.js?v=<?php echo $JS_VERSION;?>"></script>
    </body>
</html>