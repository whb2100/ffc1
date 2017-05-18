<?php
	if(!isset($_SESSION)){
		session_start();
	}
	@$language = $_SESSION['language'];
	if ($language == null) {
		header("Location: ../sys/index.php");
		return;
	}
	$fname = '';
	if ($language == 'zh') {
		$fname = 'FILM ACCOUNTING SYSTEM INSTRUCTIONS_zh.pdf';
	} else {
		$fname = 'FILM ACCOUNTING SYSTEM INSTRUCTIONS.pdf';
	}
	
	/*$ua = $_SERVER["HTTP_USER_AGENT"];
	if (preg_match("/MSIE/", $ua) || preg_match("/Gecko/", $ua)) {
		$download_name = urlencode($fname);
		$download_name = str_replace("+", "%20", $download_name);
	} else {
		$download_name = $fname;
	}*/

	//header('Content-Type: application/octet-stream');
	header('Content-type: application/pdf');
	header('Content-Disposition: attachment; filename='.$fname);// 强制下载
	readfile('../uploads/'.$fname);
?>