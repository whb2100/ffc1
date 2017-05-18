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
			<!--	<div class="set_subnav_middle">
					<ul>
						<li><span><?php echo CREATE_DATE?>：</span><input class="easyui-datebox" type="text" style="height:36px;" name="start_date" id="startDate"  editable="true"></li>
						<li><span>--</span><input class="easyui-datebox" type="text" style="height:36px;" name="end_date" id="endDate"  editable="true"></li>
					</ul>
				</div>
				<div class="set_subnav_button">
					<div class="set_search" ><a href="javascript:void(0)" onclick="searchItem()"><?php echo SEARCH?></a></div>
					<span><a href="javascript:void(0)" onclick="createItem()"><em><img src="../images/icon_create.png"/></em><?php echo CREATE_BUDGET?></a></span>
				</div> -->
			</div>
		</div>
		<div class="basic_title"><span><?php echo CURRENT_LOCATION?><span id="pName" style="font-size: 20px;"></span><?php echo REPORT_QUERY?></span>
		 <div class="title_nav">
		   <ul>
		    <li><a class="link_1_on" id="currencyBG" href="javascript:void(0)" onclick="trialBalance(this)"><?php echo TRIAL_BALANCE?></a></li>
		    <li><a href="javascript:void(0)" onclick="currency(this)"><?php echo REPORT_MAIN_SUB?></a></li>
		    <li><a href="javascript:void(0)" onclick="region(this)"><?php echo REPORT_MAIN?></a></li>
		    <li><a href="javascript:void(0)" onclick="code(this)"><?php echo REPORT_TOP?></a></li>
		    <li><a href="javascript:void(0)" onclick="scene(this)"><?php echo BATCH_RECORDS?></a></li>
		    <li class="en"><a href="javascript:void(0)" onclick="free1(this)">PO</a></li>
		    <li class="en"><a href="javascript:void(0)" onclick="free2(this)"><?php echo BALANCE?></a></li>
		    <li class="en"><a href="javascript:void(0)" onclick="free3(this)"><?php echo BALANCE_MAIN?></a></li>
		    <li class="en"><a href="javascript:void(0)" onclick="batchDetail(this)"><?php echo ALL_DETAIL?></a></li>
		    <!-- <li class="en"><a href="javascript:void(0)" onclick="free3(this)">BALANCE PERIOD</a></li> -->
		    </ul>
		  </div>
		</div>
		<br>
		<iframe id="basicIframe" src="trial-balance.php" style="width: 92%;height: 94%;display:block;min-height: 500px;margin-left:100px;"></iframe>
		<?php include '../common/include_js.php';?>
        <script type="text/javascript" src="js/report-index.js?v=<?php echo $JS_VERSION;?>"></script>
    </body>
</html>