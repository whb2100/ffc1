<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <?php include '../common/include_css.php';?>
		<?php include '../common/session_init.php';?>
		<?php include '../common/change_language.php';?>
    </head>
    
    <body>
		<div class="xmys_title"> <span><?php echo CURRENT_LOCATION?>：<?php echo PROJECT_BUDGET?> > <?php echo HIS_BUDGET?></span>
	  		<div class="xmys_right_button">
	    		<ul>
	    			<li class="xmys_button_download" style="margin-right: 20px"><a href="javascript:void(0)"  onClick="recovery();"><em></em><?php echo RECOVERY_BUDGET?></a></li>
	    			<li class="xmys_button_download" style="margin-right: 20px"><a href="javascript:void(0)"  onClick="create();"><em></em><?php echo CREATE_BUDGET?></a></li>
	      			
	    		</ul>
	  		</div>
		</div>
		<div style="margin-left: 100px;margin-top:25px">
		<div id="itemList"></div>
		</div>
		<input value="<?php echo $_SESSION['hqinfo_qm_current_user_project_id_session'];?>" id="projectId" type="hidden">
		<?php include '../common/include_js.php';?>
        <script type="text/javascript" src="js/budget-history.js?v=<?php echo $JS_VERSION;?>"></script>
    </body>
</html>