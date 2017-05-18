<html>
	<head>
	<?php include '../common/include_css.php';?>
	<?php include '../common/session_init.php';?>
	<?php include '../common/change_language.php';?>
	<?php include '../common/include_js.php';?>
	</head>
	
	<body>			
		<div class="content_title">
			<span><?php echo CURRENT_LOCATION ?>： <a  href="project-list.php"><?php echo PROJECT_MANAGEMENT ?></a></span>
			<div class="xmys_right_button">
			    		<ul>
			    			<li class="xmys_button_download" style="margin-right: 20px"><a  href="javascript:void(0)" onclick="ExcleFunction()"><em><img src="../images/icon_type.png"/></em>Excel</a></li>
			      			
			    		</ul>
			  		</div>
		</div>
		<div style="margin-left: 100px;margin-top:25px">
			<div id="projectList"></div>
		</div>
		<input value="<?php echo $_SESSION['language'];?>" id="language" type="hidden">
		<script type="text/javascript" src="js/project-list.js?v=<?php echo $JS_VERSION;?>"></script>
	</body>
</html>