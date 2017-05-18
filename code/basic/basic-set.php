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
							<span><input type="text" style="height:35px;" name="" id="aaaaaa"></span>
						</li>
						<li>
							<p><?php echo REGION?></p>
							<span><input type="text" style="height:35px;" name="" id=""></span>
						</li>
						<li>
							<p><?php echo MAIN_CODE?></p>
							<span><input type="text" style="height:35px;" name="" id=""></span>
						</li>
						<li>
							<p><?php echo SUB_CODE?></p>
							<span><input type="text" style="height:35px;" name="" id=""></span>
						</li>
						<li>
							<p><?php echo SCENE?></p>
							<span><input type="text" style="height:35px;" name="" id=""></span>
						</li>
						<li>
							<p>F1</p>
							<span><input type="text" style="height:35px;" name="" id=""></span>
						</li>
						<li>
							<p>F2</p>
							<span><input type="text" style="height:35px;" name="" id=""></span>
						</li>
						<li>
							<p>F3</p>
							<span><input type="text" style="height:35px;" name="" id=""></span>
						</li>
						<li>
							<p><?php echo ASSET?></p>
							<span><input type="text" style="height:35px;" name="" id=""></span>
						</li>
					</ul>
				</div>
				<div class="set_subnav_middle" style="display:none">
					<ul>
						<li><span><?php echo CREATE_DATE?>：</span><input class="easyui-datebox" type="text" style="height:36px;" name="start_date" id="startDate"  editable="true"></li>
						<li><span>--</span><input class="easyui-datebox" type="text" style="height:36px;" name="end_date" id="endDate"  editable="true"></li>
					</ul>
				</div>
				<div class="set_subnav_button" style="display:none">
					<div class="set_search"><a href="javascript:void(0)" onclick="searchItem()"><?php echo SEARCH?></a></div>
					<span><a href="javascript:void(0)" onclick="createItem()"><em><img src="../images/icon_create.png"/></em><?php echo CREATE_BUDGET?></a></span>
				</div>
			</div>
		</div>
		<div class="basic_title"><span><?php echo CURRENT_LOCATION?><span id="pName" style="font-size: 20px;"></span><?php echo TITLE_BASIC?></span>
		 <div class="title_nav">
		   <ul>
		    <li><a class="link_1_on" id="currencyBG" href="javascript:void(0)" onclick="currency(this)"><?php echo CURRENCY?></a></li>
		    <li><a href="javascript:void(0)" onclick="region(this)"><?php echo REGION?></a></li>
		    <li><a href="javascript:void(0)" onclick="code(this)"><?php echo CODE?></a></li>
		    <li><a href="javascript:void(0)" onclick="scene(this)"><?php echo SCENE?></a></li>
		    <li class="en"><a href="javascript:void(0)" onclick="free1(this)">F1</a></li>
		    <li class="en"><a href="javascript:void(0)" onclick="free2(this)">F2</a></li>
		    <li class="en"><a href="javascript:void(0)" onclick="free3(this)">F3</a></li>
		    </ul>
		  </div>
		</div>
		<br>
		<iframe id="basicIframe" src="currency-list.php" style="width: 95%;height: 94%;display:block;min-height: 500px;margin-left:100px;"></iframe>
		<?php include '../common/include_js.php';?>
        <script type="text/javascript" src="js/basic-set.js?v=<?php echo $JS_VERSION;?>"></script>
    </body>
</html>