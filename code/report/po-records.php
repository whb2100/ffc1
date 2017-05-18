<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                <?php include '../common/include_css.php';?>
		<?php include '../common/session_init.php';?>
		<?php include '../common/change_language.php';?>
    </head>
    
    <body>
		<span style="margin-left: 5px;"><?php echo CURRENT_START_TIME ?>：</span><input class="easyui-datebox" type="text" style="width:145px;height:36px" name="start_date" id="startDate"   editable="false">
		<span style="margin-left: 5px;"><?php echo CURRENT_START_TIME ?>：</span><input class="easyui-combobox" style="width: 80px;height:28px" id="ifMixed" data-options="valueField:'value',textField:'text',data:[{'value':'0','text':'不混合'},{'value':'1','text':'混合'}]">
		<div class="xmys_right_button">
			<ul>
				<li class="xmys_button_download"  style="margin-top: -10px;"><a href="javascript:void(0)" onclick="reloadgrid()"><?php echo SEARCH_REPORT?></a></li>
				<li class="xmys_button_download" style="margin-top: -10px;margin-right: 100px"><a  href="javascript:void(0)" onclick="ExcleFunction()"><em><img src="../images/icon_type.png"/></em>PDF</a></li>
			</ul>
		</div>
		<br>
		<br>
		<div id="mixDiv" style="display: block;"><div id="itemList"></div></div>
		<div id="noMixDiv" style="display: none;width: 100%;"></div>
		<input value="<?php echo $_SESSION['language'];?>" id="language" type="hidden">
		<?php include '../common/include_js.php';?>
		<script type="text/javascript" src="js/po-records.js?v=<?php echo $JS_VERSION;?>"></script>
    </body>
</html>