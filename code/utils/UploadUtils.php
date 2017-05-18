<?php

namespace utils;

class UploadUtils {
	
	public static function isPicture($picture){
		if(($picture['type'] != "image/png") && ($picture['type'] != "image/jpeg") && ($picture['type'] != "image/pjpeg") && ($picture['type'] != 'image/bmp')){
			return false;
		}
		if($picture['size'] > 2000000/*2MB*/){
			return false;
		}
		return true;
	}
	
	public static function isPDF($picture){
		if(($picture['type'] != "application/pdf") && ($picture['type'] != "image/jpeg")){
			return false;
		}
		if($picture['size'] > 2000000/*2MB*/){
			return false;
		}
		return true;
	}
	
	public static function isExcel($file){
		if($file["type"] != 'application/kset' && $file["type"] != 'application/vnd.ms-excel' && $file["type"] != 'application/octet-stream' && $file["type"] != 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'){
			return false;
		}else{
			return true;
		}
	}

	public static function isTxt($file){
		if($file["type"] != 'text/plain'){
			return false;
		}else{
			return true;
		}
	}

	public static function isFlash($flash){
		if($flash['type'] != "application/swf"&&$flash['type'] != "video/mp4"&&$flash["type"]!= 'application/octet-stream'){
			return false;
		}
		if($flash['size'] > 2000000/*2MB*/){
			return false;
		}
			return true;	
	}
	

	
	public static function uploadFile2($file,$folder,$fileIndex){
		
		date_default_timezone_set('PRC');//中国时区
		$timestamp = date("YmdHis");//时间戳
		
		$filetype = substr(strrchr($file['name'],"."),1);//获取文件后缀名
		if(!file_exists(BASE_DIR.$folder)){
			mkdir(BASE_DIR.$folder,0777,true);
		}
// 		$fileName = $timestamp."_$fileIndex.".$filetype; //文件新名字
		$fileName = $file['name']; //文件新名字
		$uploadState = move_uploaded_file($file['tmp_name'], BASE_DIR.$folder.'/'.$fileName);//保存文件
		
		if($uploadState){
			if(self::isPicture($file)){
				return WEB_ROOT.$folder.'/'.$fileName;
			}else{
				return WEB_ROOT.$folder.'/'.$fileName;
			}
		}else{
			return $uploadState;
		}
	}
	
	public static function uploadFile($file,$folder,$fileIndex){
	
		date_default_timezone_set('PRC');//中国时区
		$timestamp = date("YmdHis");//时间戳
	
		$filetype = substr(strrchr($file['name'],"."),1);//获取文件后缀名
		if(!file_exists(BASE_DIR.$folder)){
			mkdir(BASE_DIR.$folder,0777,true);
		}
		$fileName = $timestamp."_$fileIndex.".$filetype; //文件新名字
		$uploadState = move_uploaded_file($file['tmp_name'], BASE_DIR.$folder.'/'.$fileName);//保存文件
	
		if($uploadState){
			if(self::isPicture($file)){
				return WEB_ROOT.$folder.$fileName;
			}else{
				return BASE_DIR.$folder.'/'.$fileName;
			}
		}else{
			return $uploadState;
		}
	}
	
	public static function parseFileArray($fileArray){
		$file = array();
		$index = 0;
		foreach ($fileArray['tmp_name'] as $value){
			$file[$index]['tmp_name'] = $fileArray['tmp_name'][$index];
			$file[$index]['name'] = $fileArray['name'][$index];
			$file[$index]['type'] = $fileArray['type'][$index];
			$file[$index]['size'] = $fileArray['size'][$index];
			$file[$index]['error'] = $fileArray['error'][$index];
			$index++;
		}
		return $file;
	}
}

?>