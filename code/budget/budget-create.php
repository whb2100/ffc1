<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <?php include '../common/include_css.php';?>
		<?php include '../common/session_init.php';?>
		<?php include '../common/change_language.php';?>
    </head>
    
    <body>
		<div class="xmys_title"> <span><?php echo CURRENT_LOCATION?><span id="pName" style="font-size: 20px;"></span><?php echo PROJECT_BUDGET?> > <?php echo CREATE_BUDGET?></span>
	  		<div class="xmys_right_button">
	    		<ul>
	    			<li class="xmys_button_download" style="margin-right: 20px"><a href="javascript:void(0)"  onClick="history();"><em></em><?php echo HIS_BUDGET?></a></li>
	    			<li class="xmys_button_download" style="margin-right: 20px"><a href="javascript:void(0)"  onClick="del();"><em></em><?php echo DEL_BUDGET?></a></li>
	      		<li><a href="javascript:void(0)" onClick="importExcel();"><img src="../images/icon_daoru_<?php echo $language;?>.png"/></a></li>

				<form id="budgetsFileForm" method="post" enctype="multipart/form-data"  style="display: none">
	        				<input type="file" id="budgetsFile" name="budgets_file"  onChange="importBudgets()">
        				</form>

	      			<li class="xmys_button_download"><a href="javascript:void(0)" onClick="downloadModel();"><em><img src="../images/icon_download.png"/></em><?php echo DOWNLOAD?></a></li>
	      			<li class="xmys_button_download" style="margin-right: 20px"><a href="javascript:void(0)"  onClick="explain();"><em></em><?php echo EXPLAIN?></a></li>
	      			<li class="xmys_button_download" style="margin-right: 20px"><a  href="javascript:void(0)" onclick="ExcleFunction()"><em><img src="../images/icon_type.png"/></em>Excel</a></li>
	    		</ul>
	  		</div>
		</div>
		<div style="margin-left: 100px;margin-top:25px">
		<div id="itemList"></div>
		</div>
		<input value="<?php echo $_SESSION['hqinfo_qm_current_user_project_id_session'];?>" id="projectId" type="hidden">
		<?php include '../common/include_js.php';?>
        <script type="text/javascript" src="js/budget-create.js?v=<?php echo $JS_VERSION;?>"></script>
    </body>
</html>