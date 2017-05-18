<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <?php include '../common/include_css.php';?>
		<?php include '../common/session_init.php';?>
		<?php include '../common/change_language.php';?>
    </head>
    
    <body>
		<div class="xmys_title"> <span><?php echo CURRENT_LOCATION?><span id="pName" style="font-size: 20px;"></span><?php echo VOUCHERS?></span>
	  		<div class="xmys_right_button">
	    		<ul>
					<li style="margin-top: -10px;margin-right: 20px;"><span style="margin-left: 5px;"><?php echo VOUCHERS_NAME ?></span><input class="easyui-textbox" type="text"   style="width:145px;height:36px" id="vouchersName"></li>
	      			<li class="xmys_button_download"><a href="javascript:void(0)"  onClick="searchVouchers();"><em></em><?php echo SEARCH?></a></li>
	      			<li class="xmys_button_download"><a href="javascript:void(0)"  onClick="addVouchers();"><em></em><?php echo VOUCHERS_ADD?></a></li>
<!-- 	      		<li class="xmys_button_download"><a href="javascript:void(0)"  onClick="addContract();"><em></em><?php echo CONTRACT_ADD?></a></li> -->
	    		</ul>
	  		</div>
		</div>
		<div style="margin-left: 100px;margin-top:25px">
			<table style="width:100%">
				<tr>
					<td valign="top" style="width:220px">
						<div style="float:left;margin-right:50px;display:inline;"><ul id="vouchersTree" class="easyui-tree" animate="true" data-options="lines:true" style="height:70%;weight:50%;"></ul></div>
					</td>
              		<td>
						<div id="itemList"></div>
              		</td>
              	</tr>
			</table>
		</div>
		
        <!-- 新增 -->
		<div class="easyui-dialog" id="checkPwdDialog" closed="true" buttons="#checkPwdDialog-buttons" style="width: 500px; height: 220px; padding: 10px 10px;"  data-options="resizable:true,modal:true, closable: false"  >
             <form id="vouchersForm" method="post" action="data/vouchers.create.php" enctype="multipart/form-data" class="easyui-form" style="margin-left: 10px">
	             <input id="projectName" name="project_name" type="hidden">
	             <input id="vouchersType" name="vouchers_type" type="hidden">
	             <table style="width: 100%;">
	             	<tr>
	             		<td style="width: 40%;height: 50px;text-align: center;"><span><?php echo VOUCHERS_PIC?></span></td>
	             		<td>
	             		    <!-- <input type="file" id="vouchersPic" name="images[]" multiple="multiple"/> -->
							<input  id='vouchersPic' name='images[]' multiple='multiple' type='file' style='display:none;' onchange='changeFunction(this)'/>
							<input type="button" id="filebutton" style="width: 50px;height: 20px;" value="<?php echo REPORT_CHOOSE?>" onclick="vouchersPic.click()">
	             		    <input type="text" border=1 id="filepath">
						</td>
	             	</tr>
	             	<tr>
	             		<td colspan="2" style="text-align: right;"><span id="chooseMessage"></span></td>
	             		<td></td>
	             	</tr>
	             </table>
		        </form>
		</div>
		<div id="checkPwdDialog-buttons">
            <a href="javascript:void(0)" class="easyui-linkbutton" onclick="createItem()" iconcls="icon-save"><?php echo CONFIRM ?></a>
            <a href="javascript:void(0)" class="easyui-linkbutton" onclick="javascript:$('#checkPwdDialog').dialog('close')" iconcls="icon-cancel"   id="cancle" ><?php echo CANCLE ?></a>
        </div>
        
        <!-- 图片预览 -->
		<div class="easyui-dialog" id="showPicDialog" closed="true" buttons="#showPicDialog-buttons" style="width: 800px; height: 500px; padding: 10px 20px;"  data-options="resizable:true,modal:true, closable: false"  >
             <form id="vouchersForm" method="post" action="data/vouchers.create.php" enctype="multipart/form-data" class="easyui-form" style="margin-left: 30px">
	             <input id="projectName" name="project_name" type="hidden">
			        <div style="margin:15px 0px 15px 0px;">
			             <span><?php echo VOUCHERS_PIC?></span>
			             <img id="vouchersPicShow" src="" >
			             <div id="pdf"></div>
			        </div>
		        </form>
		</div>
		<div id="showPicDialog-buttons">
            <a href="javascript:void(0)" class="easyui-linkbutton" onclick="javascript:$('#showPicDialog').dialog('close')" iconcls="icon-cancel"   id="cancle" ><?php echo CANCLE ?></a>
        </div>
		
		<input value="<?php echo $_SESSION['hqinfo_qm_current_user_project_id_session'];?>" id="projectId" type="hidden">
		<input value="<?php echo $_SESSION['hqinfo_qm_current_user_id_in_session'];?>" id="userId" type="hidden">
		<?php include '../common/include_js.php';?>
        <script type="text/javascript" src="js/vouchers-list.js"></script>
    </body>
</html>