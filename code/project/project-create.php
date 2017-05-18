<html>
<head>
<?php include '../common/include_css.php';?>
<?php include '../common/session_init.php';?>
<?php include '../common/change_language.php';?>
</head>

<body>

				

<div class="content_title">
	<span><?php echo CURRENT_LOCATION ?>： <a  href="project-list.php"><?php echo PROJECT_MANAGEMENT ?></a> > <?php echo CREATE_PRJ ?></span>
</div>



<div class="creat_text">
  	<div class="creat_text_left">
 		 <ul>
    			<li><?php echo PRJ_SN ?></li>
    			<li><?php echo PRJ_NAME ?></li>
        			<li><?php echo PRJ_STATUS ?></li>
         			<li> <?php echo DIRECTOR ?></li>
	         		<li><?php echo LEADING_STAR_1 ?></li>
	         		<li><?php echo LEADING_STAR_2 ?></li>
	         		<li><?php echo LEADING_STAR_3 ?></li>
	        		<li><?php echo LEADING_STAR_4 ?></li>
       			<li><?php echo INVESTMENT_COMPANY_1 ?></li>
      	 		<li><?php echo INVESTMENT_COMPANY_2 ?></li>
      			<li><?php echo INVESTMENT_COMPANY_3 ?></li>
    
  		</ul>
  	</div>
  
   	<div class="creat_text_right">
   		<form id="test" method="post"   action="data/project.create.php" enctype="multipart/form-data"   class="easyui-form" >
  		<ul>
		    	<li><input class="easyui-validatebox textbox" type="text"  name="project_code" id="projectCode"   style="width:288px;height:36px;"  data-options="required:true,validType:'repeat'"  missingMessage="<?php echo MISS_PRJ_SN ?>"><span style="color: red">*</span></li>
		    	<li><input class="easyui-validatebox textbox" type="text"  name="project_name" id="projectName"   style="width:288px;height:36px;"   data-options="required:true"  missingMessage="<?php echo MISS_PRJ_NAME ?>"><span style="color: red">*</span></li>
		    	<li >
		    		<select name="project_status" class="easyui-combobox" style="width:300px;height:40px" id="projectStatus"   editable="false">
				<option value="1"><?php echo PRJ_STATUS_READYING ?></option>
				<option value="2"><?php echo PRJ_STATUS_ONGOING ?></option>
				<option value="3"><?php echo PRJ_STATUS_POST ?></option>
				<option value="4"><?php echo PRJ_STATUS_FINISH ?></option>
				<option value="5"><?php echo PRJ_STATUS_DISABLE ?></option>
				</select><span  style="color: red">*</span>
		    	</li>
		    	<li><input class="easyui-validatebox textbox" type="text"  name="director_name" id="directorName"   style="width:288px;height:36px;"></li>
		    	<li><input class="easyui-validatebox textbox" type="text"  name="actor_1" id="actor_1"   style="width:288px;height:36px;"></li>
		    	<li><input class="easyui-validatebox textbox" type="text"  name="actor_2" id="actor_2"   style="width:288px;height:36px;"></li>
		    	<li><input class="easyui-validatebox textbox" type="text"  name="actor_3" id="actor_3"   style="width:288px;height:36px;"></li>
		    	<li><input class="easyui-validatebox textbox" type="text"  name="actor_4" id="actor_4"   style="width:288px;height:36px;"></li>
		    	<li><input class="easyui-validatebox textbox" type="text"  name="company_1" id="company_1"   style="width:288px;height:36px;"></li>
		    	<li><input class="easyui-validatebox textbox" type="text"  name="company_2" id="company_2"   style="width:288px;height:36px;"></li>
		    	<li><input class="easyui-validatebox textbox" type="text"  name="company_3" id="company_3"   style="width:288px;height:36px;"></li>
  		</ul>
  	</form>
  	</div>
</div>
<!-- <div class="button_qd">
  	<ul>
    		<li><a href="javascript:void(0)"   onClick="submitFunction()"><img src="../images/icon_qd.png" width="22" height="22" style="margin-bottom: 0px;"/><span>确   定</span></a></li>
    	</ul>
</div>
<div class="button_qd">
	<ul>
    		<li><a href="javascript:void(0)"   onClick="cancleFunction()"><img src="../images/icon_shanchu.png" width="22" height="22" style="margin-bottom: 0px;"/><span>取   消</span></a></li>
  	</ul>
</div> -->
 <div class="pcl_button_all"  style="margin-top: -100px;">
	    <div class="pcl_button_qd" id="confirmDetailDiv" >
	    	<ul>
	        	<li><a href="javascript:void(0)" onclick="submitFunction()"><img src="../images/icon_qd.png"/><span><?php echo TRANSACTION_CONFIRM?></span></a></li>
	        </ul>
	  	</div>
  	    <div class="pcl_button_shanchu" id="deleteDetailDiv">
	        <ul>
	            <li><a href="javascript:void(0)" onclick="cancleFunction()"><img src="../images/icon_shanchu.png"/><span><?php echo TRANSACTION_CANCLE?></span></a></li>
	        </ul>
	    </div>
	</div>
</div>

<?php include '../common/include_js.php';?>
<script type="text/javascript" src="js/project-create.js?v=<?php echo $JS_VERSION;?>"></script>
</body>
</html>
