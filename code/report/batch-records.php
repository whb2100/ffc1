<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <?php include '../common/include_css.php';?>
		<?php include '../common/session_init.php';?>
		<?php include '../common/change_language.php';?>
    </head>
    
    <body>
			<div class="set_subnav_all">
				<div class="set_subnav_left">
					<form id="recordsForm">
						<ul>
							<li>
								<span style="margin-left: 2px;"><?php echo CURRENCY?></span>
								<input type="text" style="height:30px;width:35px;" id="currencyStart" onkeyup="moveNext(this,0);" onblur="inputBlur(this);">
							</li>
							<li>
								<span style="margin-left: 2px;"><?php echo REGION?></span>
								<input type="text" style="height:30px;width:35px;" id="regionStart" onkeyup="moveNext(this,1);" onblur="inputBlur(this);">
							</li>
							<li>
								<span style="margin-left: 2px;"><?php echo MAIN_CODE?></span>
								<input type="text" style="height:30px;width:35px;" id="mainStart" onkeyup="moveNext(this,2);" onblur="inputBlur(this);">
							</li>
							<li>
								<span style="margin-left: 2px;"><?php echo SUB_CODE?></span>
								<input type="text" style="height:30px;width:35px;" id="subStart" onkeyup="moveNext(this,3);" onblur="inputBlur(this);">
							</li>
							<li>
								<span style="margin-left: 2px;"><?php echo SCENE?></span>
								<input type="text" style="height:30px;width:35px;" id="sceneStart" onkeyup="moveNext(this,4);" onblur="inputBlur(this);">
							</li>
							<li>
								<span style="margin-left: 2px;">F1</span>
								<input type="text" style="height:30px;width:35px;" id="f1Start" onkeyup="moveNext(this,5);" onblur="inputBlur(this);">
							</li>
							<li>
								<span style="margin-left: 2px;">F2</span>
								<input type="text" style="height:30px;width:35px;" id="f2Start" onkeyup="moveNext(this,6);" onblur="inputBlur(this);">
							</li>
							<li>
								<span style="margin-left: 2px;">F3</span>
								<input type="text" style="height:30px;width:35px;" id="f3Start" onkeyup="moveNext(this,7);" onblur="inputBlur(this);">
							</li>
							<li>
								<span style="margin-left: 8px;"><?php echo TRANSACTION_CODE_REPORT?></span>
								<input type="text" style="height:33px;width:80px;" id="transactionCodeStart" onblur="inputBlur(this);">
							</li>
							<li>
								<span style="margin-left: 8px;"><?php echo REPORT_SEARCH_DATE?></span>
								<input class="easyui-datebox" type="text" style="height:33px;width:120px;" id="startDate" editable="true">
							</li>
							<br>
							<br>
							<li>
								<span style="margin-left: 2px;"><?php echo CURRENCY?></span>
								<input type="text" style="height:30px;width:35px;" id="currencyEnd" onkeyup="moveNextEnd(this,0);">
							</li>
							<li>
								<span style="margin-left: 2px;"><?php echo REGION?></span>
								<input type="text" style="height:30px;width:35px;" id="regionEnd" onkeyup="moveNextEnd(this,1);">
							</li>
							<li>
								<span style="margin-left: 2px;"><?php echo MAIN_CODE?></span>
								<input type="text" style="height:30px;width:35px;" id="mainEnd" onkeyup="moveNextEnd(this,2);">
							</li>
							<li>
								<span style="margin-left: 2px;"><?php echo SUB_CODE?></span>
								<input type="text" style="height:30px;width:35px;" id="subEnd" onkeyup="moveNextEnd(this,3);">
							</li>
							<li>
								<span style="margin-left: 2px;"><?php echo SCENE?></span>
								<input type="text" style="height:30px;width:35px;" id="sceneEnd" onkeyup="moveNextEnd(this,4);">
							</li>
							<li>
								<span style="margin-left: 2px;">F1</span>
								<input type="text" style="height:30px;width:35px;" id="f1End" onkeyup="moveNextEnd(this,5);">
							</li>
							<li>
								<span style="margin-left: 2px;">F2</span>
								<input type="text" style="height:30px;width:35px;" id="f2End" onkeyup="moveNextEnd(this,6);">
							</li>
							<li>
								<span style="margin-left: 2px;">F3</span>
								<input type="text" style="height:30px;width:35px;" id="f3End" onkeyup="moveNextEnd(this,7);">
							</li>
							<li>
								<span style="margin-left: 8px;"><?php echo TRANSACTION_CODE_REPORT?></span>
								<input type="text" style="height:33px;width:80px;" id="transactionCodeEnd">
							</li>
							<li>
								<span style="margin-left: 8px;"><?php echo REPORT_SEARCH_DATE?></span>
								<input class="easyui-datebox" type="text" style="height:33px;width:120px;" id="endDate" editable="true">
							</li>
							<br>
							<br>
							<li>
								<span style="margin-left: 2px;"><?php echo BATCH_CODE_REPORT?></span>
								<input class="easyui-textbox" type="text" style="height:32px;width:130px;" id="batchCode">
							</li>
							<li>
								<span style="margin-left: 8px;"><?php echo DESC_REPORT?></span>
								<input class="easyui-textbox" type="text" style="height:32px;width:200px;" id="desc">
							</li>
							<li>
								<span style="margin-left: 8px;"><?php echo REPORT_ASSETS?></span>
								<input class="easyui-combobox" editable="false" style="width: 120px;height:32px" id="isAssets" data-options="valueField:'value',textField:'text',data:[{'value':'0','text':'<?php echo REPORT_NOT_ASSETS?>'},{'value':'1','text':'<?php echo REPORT_ASSETS?>'}]">
							</li>
							<li>
								<span style="margin-left: 8px;"><?php echo CURRENT_TYPE_VIEW?></span>
								<input class="easyui-combobox" editable="false" style="width: 120px;height:32px" id="view">
							</li>
						</ul>
					</form>
				</div>
				<div class="set_subnav_button" style="float:right;margin-right:165px;margin-top:-10px;">
					<div class="xmys_button_download" ><a href="javascript:void(0)" onclick="reloadgrid()"><?php echo SEARCH_REPORT?></a></div>
					<div class="xmys_button_download" ><a href="javascript:void(0)" onclick="clearFunction()"><?php echo REPORT_CLEAR?></a></div>
					<div class="xmys_button_download" ><a href="javascript:void(0)" onclick="ExcleFunction()"><em><img src="../images/icon_type.png"/></em>Excel</a></div>
					<div class="xmys_button_download" ><a href="javascript:void(0)" onclick="pdfFunction()"><em><img src="../images/icon_type.png"/></em>PDF</a></div>
				</div>
			</div>
		<div id="itemList"></div>
		<input value="<?php echo $_SESSION['language'];?>" id="language" type="hidden">
		<?php include '../common/include_js.php';?>
		<script type="text/javascript" src="js/batch-records.js?v=<?php echo $JS_VERSION;?>"></script>
    </body>
</html>