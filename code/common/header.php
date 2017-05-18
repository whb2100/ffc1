<!-- header start -->
<?php include 'sessionCheck.php';?>
<?php include '../utils/Autoloader.php';?>
<?php include 'change_language.php';?>


<div class="header_all">
   <!--  <div class="header_logo"><img src="../img/logo.png"/>-->
    <a href="../common/main.php"><div class="header_logo"><img src="" id="logo" style="margin-top:-20px;"></div></a>
  	<div class="nav">
  		<ul>
     		 <li id="projectManagementLi" style="display: none;"><a href="javascript:void(0)" onclick="projectFunction(this)"><img src="../images/icon_xmgl.png"/><p><?php echo PROJECT_MANAGEMENT?></p></a></li>
      		 <li id="basicSettingLi" style="display: none;"><a  href="javascript:void(0)" onclick="basicFunction(this)" ><img src="../images/icon_jcsz.png"/><p><?php echo BASIC_SETTING?></p></a></li>
      		 <li id="projectBudgetLi" style="display: none;"><a href="javascript:void(0)" onclick="budgetFunction(this)"><img src="../images/icon_xmys.png"/><p><?php echo PROJECT_BUDGET?></p></a></li>
      		 <li id="batchProcessingLi" style="display: none;"><a href="javascript:void(0)" onclick="processFunction(this)"><img src="../images/icon_cjpcl.png"/><p><?php echo BATCH_PROCESSING?></p></a></li>
      		 <li id="reportQueryLi" style="display: none;"><a class="link_1_on"  href="javascript:void(0)" onclick="reportFunction(this)"><img src="../images/icon_bbcx.png"/><p><?php echo REPORT_QUERY?></p></a></li>
      		 <li id="POInputLi" style="display: none;"><a href="javascript:void(0)" onclick="POFunction(this)"><img src="../images/icon_polr.png"/><p><span>PO</span><?php echo HEADER_PO?></p></a></li>
      		 <li id="ETCLi" style="display: none;"><a href="javascript:void(0)" onclick="ETCFunction(this)"><img src="../images/icon_etc.png"/><p>ETC</p></a></li>
      		 <li id="VouchersLi" style="display: none;"><a href="javascript:void(0)" onclick="VOUCHERSFunction(this)"><img src="../images/icon_vouchers.png"/><p><?php echo HEADER_VOUCHERS?></p></a></li>
    	</ul>
  	 </div>
  	 <div class="header_right_all">
	  	 <div class="header_right">
	  	 	<ul>  
		         <li><span style="margin-right: 10px;display:<?php  if($_SESSION[common\Constants::LOGINEN_USER_PROJECT_NAME_IN_SESSION] ==0){echo none;} ?>"><?php echo PRJ_NAME?>:<?php echo $_SESSION[common\Constants::LOGINEN_USER_PROJECT_NAME_IN_SESSION];?></span><a href="javascript:void(0)" onclick="resetUserPassword(2)" class="subtop"><img src="../img/icon_set.png"/><span  style="margin-right: 10px"><?php echo RESET_PASSWORD?></span></a><a href="../common/logout.php" class="subtop_exit"><img src="../img/icon_cancle.png"/><span><?php echo LOGIN_OFF?></span></a></li>
		    </ul>
	  	 </div>
	      <div class="header_right_time"><a href="" style="float: left;" > <img src="../img/tys_icon_test.png"/><span><?php echo $_SESSION[common\Constants::LOGINED_USER_NAME_IN_SESSION];?></span></a>
	      	<p  style='float: left;color: white;font-size: 13px;'><?php echo LOGIN_TIME?></p><span id="timeSpan"></span>
	     </div>
     	<!-- 时钟 -->
		<div class="box" style="margin-top: 5px;text-align: right;" id="clock">
			<ul>
				<li style="width:60px;"><span id="year"></span></li><span style="font-weight: bold;color:#BFBFBF;margin-left:-11px;margin-right:-11px;">-</span>
				<li><span id="month"></span></li><span style="font-weight: bold;color:#BFBFBF;margin-left:-10px;margin-right:-8px;">-</span>
				<li><span id="day"></span></li>
				<li><span id="hour"></span></li><span style="font-weight: bold;color:#BFBFBF;margin-left:-7px;margin-right:-7px;">:</span>
				<li><span id="minute"></span></li><span style="font-weight: bold;color:#BFBFBF;margin-left:-7px;margin-right:-7px;">:</span>
				<li><span id="second"></span></li>
			</ul>
		</div>
 	 </div>
 	 <input value="<?php echo $_SESSION['language'];?>" id="language" type="hidden">
 	 <input value="<?php echo $_SESSION[common\Constants::LOGINEN_USER_LOGIN_DATE_IN_SESSION];?>" id="loginDate" type="hidden">
 	 <input value="<?php echo $_SESSION[common\Constants::LOGINEN_USER_POSITION_ID_IN_SESSION];?>" id="positionId" type="hidden">
 </div>
  <!-- header end -->