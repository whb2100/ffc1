<?php

	@$language = $_SESSION['language'];
	if ($language == null) {
		if (strrpos(strtolower($_SERVER['HTTP_ACCEPT_LANGUAGE']), 'zh-cn') !== false) {// 简体中文
			$language = 'zh';
		} else {
			$language = 'en';
		}
	}
	if ($language == 'zh') {
		$URL_LAN = '../common/language_zh.js?v=';
		$URL_EASYUI = '../js/easyui/locale/easyui-lang-zh_CN.js?v=';
		include 'language_zh.php';
	} else {
		$URL_LAN = '../common/language_en.js?v=';
		$URL_EASYUI = '../js/easyui/locale/easyui-lang-en.js?v=';
		include 'language_en.php';
	}
?>