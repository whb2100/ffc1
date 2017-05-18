<?php

	namespace utils;

	class PDFUtils {

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
		public static function createPDF($filename, $params) {
			// 创建PDF文档
			ob_start();
			$pdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

			// 设置文档信息
			$pdf->setPageOrientation($params['PDF_ORIENTATION']);
			$pdf->SetCreator($params['PDF_CREATOR']);
			$pdf->SetAuthor($params['PDF_AUTHOR']);
			$pdf->SetTitle($params['PDF_TITLE']);
			$pdf->SetSubject($params['PDF_SUBJECT']);
			$pdf->SetKeywords($params['PDF_KEYWORDS']);
			$pdf->setPrintHeader($params['PRINT_HEADER']);
			$pdf->setPrintFooter($params['PRINT_FOOTER']);

			// 设置页眉和页脚信息
			// $pdf->SetHeaderData($params['PDF_HEADER_LOGO'], $params['PDF_HEADER_LOGO_WIDTH'], $params['PDF_HEADER_TITLE'],
			// $params['PDF_HEADER_STRING'], $params['PDF_HEADER_TEXT_COLOR'], $params['PDF_HEADER_LINE_COLOR']);

			// 设置页眉和页脚字体
			$pdf->setHeaderFont(Array($params['PDF_FONT_NAME_MAIN'], '', $params['PDF_FONT_SIZE_MAIN']));
			$pdf->setFooterFont(Array($params['PDF_FONT_NAME_DATA'], '', $params['PDF_FONT_SIZE_DATA']));

			// 设置默认等宽字体
			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

			// 设置间距
			$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
			$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
			$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
			// 设置分页
			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
			
			// 设置图像缩放因子
			$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
			
			// 设置语言相关(可选)
			if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
				require_once(dirname(__FILE__).'/lang/eng.php');
				$pdf->setLanguageArray($l);
			}
			
			// 设置默认字体子集模式
			$pdf->setFontSubsetting(true);

			// 设置字体
			$pdf->SetFont($params['CONTENT_FONT'], '', $params['CONTENT_FONT_SIZE'], '', true);
			
			// 添加页
			$pdf->AddPage();
			
			// 设置文字阴影效果
			$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0, 'depth_h'=>0, 'color'=>array(196, 196, 196), 'opacity'=>1, 'blend_mode'=>'Normal'));
			
			// 输出
			$pdf->writeHTMLCell(0, 0, '', '', $params['CONTENT'], 0, 1, 0, true, '', true);
			//$pdf->multiCell(100, 100, $params['CONTENT']);
			$pdf->Output($filename, 'I');
		}
	}

?>