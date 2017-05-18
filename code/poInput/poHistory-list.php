<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <?php include '../common/include_css.php';?>
		<?php include '../common/session_init.php';?>
		<?php include '../common/change_language.php';?>
    </head>
    
    <body>
		<div class="pocl_history_title">
			<span><?php echo PO_LOCATION?><?php echo PO_TITLE?></span>
			<div class="xmys_right_button">
	    		<ul>
	      			<li class="xmys_button_download"><a href="javascript:void(0)"  onClick="clearItem();"><em><img src="../images/icon_shanchu.png"/></em><?php echo ETC_DELETE?></a></li>
	    		</ul>
	  		</div>
		</div>
		<br>
		<div style="margin-left: 330px;">
			<div id="itemGrid"></div>
		</div>
		<input value="<?php echo $_SESSION['hqinfo_qm_current_user_project_id_session'];?>" id="projectId" type="hidden">
		<?php include '../common/include_js.php';?>
        <script type="text/javascript" src="js/poHistory-list.js?v=<?php echo $JS_VERSION;?>"></script>
    </body>
</html>