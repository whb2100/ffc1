<?php
	include 'session_init.php';
	include 'Constants.php';
	
	use common\Constants;
// 	echo 'start to check';
	//echo $_SESSION[$LOGINED_USER_CODE_IN_SESSION].$_SESSION[$LOGINED_USER_NAME_IN_SESSION].$_SESSION[$LOGINED_USER_ID_IN_SESSION].$_SESSION[$LOGINED_USER_STORE_ID_IN_SESSION];

	if (!isset($_SESSION[Constants::LOGINED_USER_NAME_IN_SESSION])
			|| !isset($_SESSION[Constants::LOGINED_USER_ID_IN_SESSION])
			|| !isset($_SESSION[Constants::LOGINED_USER_CODE_IN_SESSION])) {
		//当前用户未登录或者已经失效
		echo "<script language='javascript' type='text/javascript'>";
		echo "alert('用户已失效，请重新登录系统！');";
// 		echo "window.parent.location.href='".$APP_ROOT_PATH."../sys/index.php'";
		echo "window.parent.location.href='../sys/index.php'";
		echo "</script>";
		return;
	}
	
?>
