<?php
	/**
	 * 自动加载所需类文件
	 */
	$PHP_SELF = $_SERVER['PHP_SELF'] ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME'];
	$HTTP = 'http://';
	$HTTP_HOST = $_SERVER['HTTP_HOST'];
	
	error_reporting(E_ALL^E_NOTICE^E_WARNING);
	define('BASE_DIR', str_replace('\\', '/', realpath(dirname(dirname(__FILE__).'/')))."/");
	define('WEB_ROOT', $HTTP.$HTTP_HOST.substr($PHP_SELF,0,strrpos(dirname(dirname($PHP_SELF)), '/') + 1));
	
	session_start();
	$requestParamArr = array_merge($_POST,$_GET);
	foreach ($requestParamArr as $key => $value) {
		if ($key != 'datas' && $key != 'datasd' && $key != 'datasgifts') {
			$requestParamArr[$key] = addcslashes(stripcslashes($value), '\'');
		}
	}
	
	class autoloader {
		
		public static function aotuload($class) {
			include BASE_DIR.str_replace('\\', '/', $class).'.php';
		}
	}
	
	spl_autoload_register('autoloader::aotuload');
?>