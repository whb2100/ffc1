<html>
<head>
<?php include '../common/include_css.php';?>
<?php include '../common/session_init.php';?>
<?php include '../common/change_language.php';?>
</head>

<body>


				

<div class="content_title">
	<div class="xmys_right_button">
    		<ul>
    			<li class="xmys_button_download" style="margin-right: 20px"><a  href="javascript:void(0)" onclick="ExcleFunction()"><em><img src="../images/icon_type.png"/></em>Excel</a></li>
      			
    		</ul>
	</div>
	<span><?php echo CURRENT_LOCATION ?>： <a  href="project-list.php"><?php echo PROJECT_MANAGEMENT ?></a> > <?php echo $_GET['code']?><h3><a href="user-create.php?formProjectId=<?php echo $_GET['formProjectId']?>&code=<?php echo $_GET['code']?>">+ <?php echo CREATE_ACCOUNT ?></a></h3></span>
</div>
<div style="margin-left: 100px;margin-top:25px">
	<div id="userList"></div>
</div>

<input id="projectId" type="hidden" name="project_id" value="<?php echo $_GET['formProjectId']?>">
<input id="code" type="hidden" name="code" value="<?php echo $_GET['code']?>">
<?php include '../common/include_js.php';?>
<script type="text/javascript" src="js/user-list.js?v=<?php echo $JS_VERSION;?>"></script>
</body>
</html>
