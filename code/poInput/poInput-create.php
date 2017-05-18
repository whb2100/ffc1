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
			  <div id="transactionList"></div>
		</div>
		<div class="pcl_right_all">
			<div class="pcl_title" id="pcl_title_header"><a href="javascript:void(0)" onclick="toPO()"><span style="margin-right:5px;padding-left:5px;" id="batch_title"><?php echo CURRENT_LOCATION?><span id="pName" style="font-size: 20px;"></span><?php echo TITLE_PO?></span></a><span id="showBatchCode" style="display: none;"></span>
				<a id="subA" href="javascript:void(0)" onclick="examSubject()" style=" font-family:'宋体'; font-size:12px; color:#1e59a8; text-decoration:underline;display:none;"><?php echo EXAMINATION_SUBJECTS?></a>
				<a id="numA" href="javascript:void(0)" onclick="examNumber()" style=" font-family:'宋体'; font-size:12px; color:#1e59a8; text-decoration:underline;display:none;"><?php echo CHECK_NUMBER?></a>
				<div class="pcl_title_right">
					<ul>
						<li> <span style="padding-left:5px;"><?php echo BATCH_NUMBER?></span>
						<input style="height: 23px; width: 80px;" class="easyui-validatebox textbox" type="text" id="batchInput"
							 data-options="required:true,validType:'repeat'" missingMessage="<?php echo BATCHNUMBER_INPUT?>">
				        	<span id="batchSpan" style="display: none;"></span>
				        </li>
				        <li id="currencyIdLi" style="display: block;"> <span><?php echo BATCH_CURRENCY?></span>
							<select id="currencyId" style="width:110px;height:25px;"></select>
				        </li>
				        <li id="currencySpanLi" style="display: none;"> <span><?php echo BATCH_CURRENCY?></span>
							<span id="currencySpan"></span>
				        </li>
				        <li>
					        <div class="pocl_right_button" id="createBatchButton"> <a href="javascript:void(0)" onclick="createBatch()"><?php echo CREATE_BATCH?></a></div>
					        <div class="pocl_right_button_lishi" id="updateCurrencyButton" style="display: none;"> <a href="javascript:void(0)" onclick="updateCurrency()"><?php echo UPDATE_CURRENCY?></a></div>
					        <div class="pocl_right_button_lishi" id="addBatchButton" style="display: none;"> <a href="javascript:void(0)" onclick="addBatch()"><?php echo ADD_PO?></a></div>
					        <div class="pocl_right_button_lishi" id="poHistoryButton"> <a href="javascript:void(0)" onclick="poHistory()"><?php echo PO_HISTORY?><span>PO</span></a></div>
				        </li>
				        <li id="createTransactionLi" style="display: none;">
					        <div class="pcl_right_button" id="createTransactionButton" style="display: none;"> <a href="javascript:void(0)" onclick="createTransaction()"><?php echo ADD_TRANSACTION?></a></div>
				        </li>
					</ul>
				</div>
			</div>
			<div class="pcl_text_nav" id="detailListDiv">
	    		<div class="pcl_nav_left"><?php echo TRANSACTION_NUMBER?>
	    	    		<input class="easyui-validatebox textbox" type="text" id="transactionCode"
							 data-options="required:true,validType:'repeatCode'" missingMessage="<?php echo TRANSACTIONNUMBER_INPUT?>">
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
		  	    <div class="pcl_button_shanchu" id="deleteDetailDiv" style="display: none;">
			        <ul>
			            <li><a href="javascript:void(0)" onclick="deleteDetail()"><img src="../images/icon_shanchu.png"/><span><?php echo TRANSACTION_DELETE?></span></a></li>
			        </ul>
			    </div>
			</div>
		  	<div class="pcl_text_nav" id="examSubjectDiv" style="display: none;"><div id="subDiv"></div></div>
		  	<div class="pcl_text_nav" id="examNumberDiv" style="display: none;"><div id="numDiv"></div></div>
		</div>
		
		<!-- 修改货币 -->
		<div class="easyui-dialog" id="updateCurrencyDialog" closed="true" title=<?php echo UPDATE_CURRENCY ?> buttons="#updateCurrencyDialog-buttons" style="width: 380px; height: 260px; padding: 10px 20px;"  data-options="resizable:true,modal:true, closable: false"  >
			<form action="data/batch.update.php" id="updateCurrencyForm" method="post">
				<input id="updateBatchId" name="batch_id" type="hidden">
				<div style="margin:35px 0px 15px 0px">
	                 <span style="margin-right: 23px"><?php echo BATCH_CURRENCY ?></span>
	                 <select id="updateCurrencyId" name="currency_id" style="width:120px;height:25px;"></select>
	            </div>
	            <div style="margin:0px 0px 15px 0px">
	                 <span style="margin-right: 23px"><?php echo BATCH_PWD ?></span>
	                 <input class="easyui-validatebox textbox" style="width:160px" type="password" id="userPassword" data-options="required:true" missingMessage="<?php echo BATCH_PWD_INPUT ?>">
	             </div>
			 </form>
		</div>
		<div id="updateCurrencyDialog-buttons">
            <a href="javascript:void(0)" class="easyui-linkbutton" onclick="submitupdateCurrencyForm()" iconcls="icon-save"><?php echo SAVE ?></a>
            <a href="javascript:void(0)" class="easyui-linkbutton" onclick="javascript:$('#updateCurrencyDialog').dialog('close')" iconcls="icon-cancel"   id="cancle" ><?php echo CANCLE ?></a>
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
		
		<input id="poHistoryId" type="hidden" value="<?php echo $_GET['poHistoryId']?>">
		<input id="isHistory" type="hidden" value="<?php echo $_GET['isHistory']?>">
		<input id="poHistoryCode" type="hidden" value="<?php echo $_GET['poHistoryCode']?>">
		<input id="poHistoryCurrencyType" type="hidden" value="<?php echo $_GET['poHistoryCurrencyType']?>">
		<input id="poHistoryCurrencyCode" type="hidden" value="<?php echo $_GET['poHistoryCurrencyCode']?>">
		<input id="showList" type="hidden" value="<?php echo $_GET['showList']?>">
		<input value="<?php echo $_SESSION['hqinfo_qm_current_user_project_id_session'];?>" id="projectId" type="hidden">
		<input value="<?php echo $_SESSION['hqinfo_qm_current_user_id_in_session'];?>" id="userId" type="hidden">
		<input value="<?php echo $_SESSION['language'];?>" id="language" type="hidden">
		<?php include '../common/include_js.php';?>
        <script type="text/javascript" src="js/poInput-create.js?v=<?php echo $JS_VERSION;?>"></script>
    </body>
</html>