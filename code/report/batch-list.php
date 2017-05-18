<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <?php include '../common/include_css.php';?>
		<?php include '../common/session_init.php';?>
		<?php include '../common/change_language.php';?>
    </head>
    
    <body>
    	<div class="pcl_left_nav" id="batchCodeDiv">
			  <div class="pcl_left_nav_title">
		  	  </div>
			  <br>
			  <div id="transactionList" ></div>
		</div>
		<div class="pcl_right_all">
			<div class="pcl_title" id="pcl_title_header"> <span style="margin-right:5px;padding-left:5px;" id="batch_title"></span><span id="showBatchCode" style="display: none;"></span>
				<a id="subA" href="javascript:void(0)" onclick="examSubject()" style=" font-family:'宋体'; font-size:12px; color:#1e59a8; text-decoration:underline;display:none;"><?php echo EXAMINATION_SUBJECTS?></a>
				<a id="numA" href="javascript:void(0)" onclick="examNumber()" style=" font-family:'宋体'; font-size:12px; color:#1e59a8; text-decoration:underline;display:none;"><?php echo CHECK_NUMBER?></a>
				<div class="pcl_title_right">
					<ul>
						<li> <span style="padding-left:5px;"><?php echo BATCH_NUMBER?></span>
				        	<span id="batchSpan"></span>
				        </li>
				        <li id="currencySpanLi" style="display: block;"> <span><?php echo BATCH_CURRENCY?></span>
							<span id="currencySpan"></span>
				        </li>
					</ul>
				</div>
			</div>
			<div class="pcl_text_nav" id="detailListDiv">
	    		<div class="pcl_nav_left"><?php echo TRANSACTION_NUMBER?>
				    <span id="transactionCode"></span>
				    <input id="transactionId" type="hidden">
		    	</div>
		    	<div class="pcl_nav_right"><?php echo TRANSACTION_TOTAL?>
		        	<span id="totalAmount"></span>
		    	</div>
			    <br>
			    <br>
			    <div id="transactionDetailList"></div>
		    </div>
  		    <div class="pcl_button_all">
			    <div class="pcl_button_qd" id="confirmDetailDiv" style="display: none;">
			    	<ul>
			        	<li><a href="javascript:void(0)" onclick="confirmDetail()"><img src="../images/icon_qd.png"/><span><?php echo TRANSACTION_CONFIRM?></span></a></li>
			        </ul>
			  	</div>
			</div>
		  	<div class="pcl_text_nav" id="examSubjectDiv" style="display: none;"><div id="subDiv"></div></div>
		  	<div class="pcl_text_nav" id="examNumberDiv" style="display: none;"><div id="numDiv"></div></div>
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
		<input value="<?php echo $_SESSION['language'];?>" id="language" type="hidden">
		<?php include '../common/include_js.php';?>
        <script type="text/javascript" src="js/batch-list.js?v=<?php echo $JS_VERSION;?>"></script>
    </body>
</html>