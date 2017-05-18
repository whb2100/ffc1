<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <?php include '../common/include_css.php';?>
		<?php include '../common/session_init.php';?>
		<?php include '../common/change_language.php';?>
    </head>
    
    <body>
        <div class="xmys_right_button">
	    	<ul>
	    		<li class="xmys_button_download" style="margin-top: -10px;margin-right: 100px"><a  href="javascript:void(0)" onclick="ExcleFunction()"><em><img src="../images/icon_type.png"/></em>Excel</a></li>
    		</ul>
  		</div>
  		<br>
  		<br>
    	<div id="itemList"></div>
        <input value="<?php echo $_SESSION['hqinfo_qm_current_user_project_id_session'];?>" id="projectId" type="hidden">
        <input value="<?php echo $_SESSION['hqinfo_qm_current_user_id_in_session'];?>" id="userId" type="hidden">
		<input value="<?php echo $_SESSION['language'];?>" id="language" type="hidden">
		<?php include '../common/include_js.php';?>
        <script type="text/javascript" src="js/code-list.js?v=<?php echo $JS_VERSION;?>"></script>
    </body>
</html>