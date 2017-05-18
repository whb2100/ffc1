<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <?php include '../common/include_css.php';?>
		<?php include '../common/session_init.php';?>
		<?php include '../common/change_language.php';?>
    </head>
    
    <body style="text-align:center;" >
		<div style="width:600px;margin-left:auto;margin-right:auto;margin-top:20px;">
			<div class="xmys_right_button">
	    	<ul>
	     		<li class="xmys_button_download" style="margin-top: -10px;"><a href="javascript:void(0)" onclick="ExcleFunction()"><em><img src="../images/icon_type.png"/></em>PDF</a></li>
	     		<li class="xmys_button_download" style="margin-top: -10px;margin-right: 100px;"><a id="helpFile" href="javascript:void(0)" onClick="explain();"><em></em><?php echo EXPLAIN?></a></li>
    		</ul>
  		</div>
  		<br><br>
			<table style="margin-left:-100px;" border="15" width="100%" id="trialTable">
			</table>
		</div>
		
		<input value="<?php echo $_SESSION['hqinfo_qm_current_user_project_id_session'];?>" id="projectId" type="hidden">
		<input value="<?php echo $_SESSION['language'];?>" id="language" type="hidden">
		<?php include '../common/include_js.php';?>
		<script type="text/javascript" src="js/trial-balance.js?v=<?php echo $JS_VERSION;?>"></script>
    </body>
</html>