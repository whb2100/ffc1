<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <?php include '../common/include_css.php';?>
		<?php include '../common/session_init.php';?>
		<?php include '../common/change_language.php';?>
    </head>
    
    <body>
		<div class="set_subnav"> 
			<div class="set_subnav_all">
				<div class="set_subnav_left">
					<ul>
						<li>
							<p><?php echo CURRENCY?></p>
							<span><input class="easyui-textbox" type="text" style="height:35px;" name="" id=""></span>
						</li>
						<li>
							<p><?php echo REGION?></p>
							<span><input class="easyui-textbox" type="text" style="height:35px;" name="" id=""></span>
						</li>
						<li>
							<p><?php echo MAIN_CODE?></p>
							<span><input class="easyui-textbox" type="text" style="height:35px;" name="" id=""></span>
						</li>
						<li>
							<p><?php echo SUB_CODE?></p>
							<span><input class="easyui-textbox" type="text" style="height:35px;" name="" id=""></span>
						</li>
						<li>
							<p><?php echo SCENE?></p>
							<span><input class="easyui-textbox" type="text" style="height:35px;" name="" id=""></span>
						</li>
						<li>
							<p>F1</p>
							<span><input class="easyui-textbox" type="text" style="height:35px;" name="" id=""></span>
						</li>
						<li>
							<p>F2</p>
							<span><input class="easyui-textbox" type="text" style="height:35px;" name="" id=""></span>
						</li>
						<li>
							<p>F3</p>
							<span><input class="easyui-textbox" type="text" style="height:35px;" name="" id=""></span>
						</li>
						<li>
							<p><?php echo ASSET?></p>
							<span><input class="easyui-textbox" type="text" style="height:35px;" name="" id=""></span>
						</li>
					</ul>
				</div>
				<div class="set_subnav_middle" style="display:none">
					<ul>
						<li><span><?php echo CREATE_DATE?>：</span><input class="easyui-datebox" type="text" style="height:36px;" name="start_date" id="startDate"  editable="false"></li>
						<li><span>--</span><input class="easyui-datebox" type="text" style="height:36px;" name="end_date" id="endDate"  editable="false"></li>
					</ul>
				</div>
				<div class="set_subnav_button" style="display:none">
					<div class="set_search" ><a href="javascript:void(0)" onclick="searchItem()"><?php echo SEARCH?></a></div>
					<span><a  href="javascript:void(0)" onclick="PDFFunction()"><em><img src="../images/icon_type.png"/></em><?php echo PRINT_ITEM?></a></span> 
				</div>
			</div>
		</div>


		<iframe id="budgetFrame" src="" style="width: 100%;height: 100%;display:none;min-height: 500px;"></iframe>
		
		<?php include '../common/include_js.php';?>
        <script type="text/javascript" src="js/budget-index.js?v=<?php echo $JS_VERSION;?>"></script>
    </body>
</html>