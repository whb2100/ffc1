<?php

	namespace utils;

	class PDFUtils2 {

		public static function getDefaultParams() {
			$params = array();
			$params['PDF_CREATOR'] = 'hqinfo';// PDF创建者
			$params['PDF_AUTHOR'] = 'hqinfo';// PDF作者
			// $params['PDF_HEADER_LOGO'] = 'icon_logo.png';// logo图片
			// $params['PDF_HEADER_LOGO_WIDTH'] = 50;// logo图片宽度
			/*$params['PDF_TITLE'] = '文件标题在此设置';// 标题
			$params['PDF_SUBJECT'] = '文件主题在此设置';// 主题
			$params['PDF_KEYWORDS'] = '文件关键字在此设置';// 关键字
			$params['PDF_HEADER_TITLE'] = '页眉标题在此设置';// 页眉标题
			$params['PDF_HEADER_STRING'] = '页眉内容在此设置';// 页眉内容*/
			$params['PDF_TITLE'] = '';// 标题
			$params['PDF_SUBJECT'] = '';// 主题
			$params['PDF_KEYWORDS'] = '';// 关键字
			$params['PDF_HEADER_TITLE'] = '';// 页眉标题
			$params['PDF_HEADER_STRING'] = '';// 页眉内容
			$params['PDF_FONT_NAME_MAIN'] = 'stsongstdlight';// 默认的主字体
			$params['PDF_FONT_SIZE_MAIN'] = 10;// 主字体大小
			$params['PDF_FONT_NAME_DATA'] = 'stsongstdlight';// 默认的数据字体
			$params['PDF_FONT_SIZE_DATA'] = 8;// 数据字体大小
			$params['PDF_HEADER_TEXT_COLOR'] = array(0, 64, 255);// 页眉文字颜色
			$params['PDF_HEADER_LINE_COLOR'] = array(0, 64, 128);// 页眉线条颜色
			$params['PRINT_HEADER'] = false;
			$params['PRINT_FOOTER'] = false;
			$params['CONTENT'] = '正文内容,支持HTML';// 正文<<<EOD...EOD
			$params['PDF_ORIENTATION'] = 'L';// L横式打印,P纵向打印
			// 正文字体
			@$language = $_SESSION['language'];
			if ($language == 'zh') {
				$params['CONTENT_FONT'] = 'stsongstdlight';
			} else {
				$params['CONTENT_FONT'] = 'dejavusans';
			}
			$params['CONTENT_FONT_SIZE'] = 7;// 正文字体大小
			return $params;
		}
		
		/**
		 * 创建PDF.
		 * 
		 * @param $filename PDF文件名.
		 * @param $params 创建PDF所需要的参数数组,格式如下详见函数getDefaultParams.
		 */
		public static function createPDF($filename, $language, $params) {
			// $encoding = $language == 'zh' ? 'zh-CN' : 'utf-8';
			$mode = $params['PDF_ORIENTATION'] == 'L' ? 'A4-L' : 'A4';
			$mpdf=new \mPDF('zh-CN', $mode, 9, '', 10, 10, 10, 10, 10, 10);
			$mpdf->mirrorMargins = 1;
			$mpdf->SetDisplayMode('fullpage');
			$mpdf->list_indent_first_level = 0;// 1 or 0 - whether to indent the first level of a list
			$mpdf->WriteHTML($params['CONTENT'], 2);
			$mpdf->Output($filename, 'I');
		}
	}

?>