<?php

	namespace report\data;

	class ReportContentFunction2 {
		
		// budget cost report
		public static function getBudgetCostContent($project, $datas, $currency_type = null, $balance = false) {
			$date = date('Y-m-d', time());
			$time = date('H:i:s', time());
			@$language = $_SESSION['language'];
			if ($currency_type != null) {
				$n = stripos($currency_type, '(');
				if ($language == 'en') {// en
					$currency_type = substr($currency_type, 0, $n);
				} else {
					$currency_type = substr($currency_type, $n + 1, strlen($currency_type) - $n - 2);
				}
				$project_name = $project['project_name'];
			} else {
				$currency_type = '';
				$project_name = $project['project_name'];
			}
			$content = '<table cellspacing="2" cellpadding="2" border="0" style="border:1px solid #cccccc;">';
			$content .= '<tr align="center">';
			$content .= '<td colspan="5"><font face="dejavusans"><span style="font-size:14">'.$project_name.'</span></font></td>';
			$content .= '</tr>';
			if (!$balance) {
				if ($language == 'en') {
					$width1 = 340;
				} else {
					$width1 = 400;
				}
				$width2 = 130;
				$width3 = 170;
				$width4 = 90;
				$width5 = 90;
			} else {
				if ($language == 'en') {
					$width1 = 100;
				} else {
					$width1 = 160;
				}
				$width2 = 160;
				$width3 = 210;
				$width4 = 120;
				$width5 = 125;
			}
			if ($language == 'en') {// en
				$content .= '<tr>';
				$content .= '<td width="140"><br><br>'.$currency_type.'</td>';// Cost620<br>Production
				$content .= '<td align="right"></td>';// Yr/Pd 2012/06/02<br> Base/Budget
				$content .= '<td width="'.$width1.'" align="center"></td>';// Period Ending 06/16/12
				$content .= '<td width="150"></td>';// Summary<br>Displaying Sets
				//$content .= '<td width="150">Page 0001<br>Run Date 06/29/12<br>Run Time 19:32:29 </td>';
				$content .= '<td width="150">'.$project['search'].'<br>TO:'.$date.'<br>Run Time '.$time.' </td>';
				$content .= '</tr>';
			
				$content .= '<tr>';
				$content .= '<td colspan="5">';
				$content .= '<table border="0" cellspacing="0" cellpadding="1" style="border:1px solid #000000;">';
			
				$content .= '<tr align="center">';
				$content .= '<td width="'.$width2.'" style="border-right: 1px solid #999; border-bottom: 1px solid #000000;">Account<br>Code</td>';
				$content .= '<td width="'.$width3.'" style="border-right: 1px solid #999; border-bottom: 1px solid #000000;">Account<br>Description</td>';
				$content .= '<td width="'.$width4.'" style="border-right: 1px solid #999; border-bottom: 1px solid #000000;">ACTUAL<br>THIS PERIOD</td>';
				$content .= '<td width="'.$width5.'" style="border-right: 1px solid #999; border-bottom: 1px solid #000000;">TOTAL<br>TO DATE</td>';
				if (!$balance) {
					$content .= '<td width="90" style="border-right: 1px solid #999; border-bottom: 1px solid #000000;">PURCHASE<br>ORDER(PO)</td>';
					//$content .= '<td style="border-right: 1px solid #999; border-bottom: 1px solid #000000;">TOTAL COST<br>PLUS COMMITS</td>';
					$content .= '<td width="90" style="border-right: 1px solid #999; border-bottom: 1px solid #000000;">ESTIMATE_TO<br>COMPLET(ETC)</td>';
					$content .= '<td width="90" style="border-right: 1px solid #999; border-bottom: 1px solid #000000;">ESTIMATE<br>FINAL COST(EFC)</td>';
					$content .= '<td width="90" style="border-right: 1px solid #999; border-bottom: 1px solid #000000;">BUDGET AMT</td>';
					$content .= '<td width="85" style="border-right: 1px solid #999; border-bottom: 1px solid #000000;">+:SAVING/-:OVERAGE</td>';
				}
				$content .= '</tr>';
			} else {// zh
				$content .= '<tr>';
				$content .= '<td width="100"><br><br>'.$currency_type.'</td>';// Cost620<br>Production
				$content .= '<td align="right"></td>';// Yr/Pd 2012/06/02<br> Base/Budget
				$content .= '<td width="'.$width1.'" align="center"></td>';// Period Ending 06/16/12
				$content .= '<td width="150"></td>';// Summary<br>Displaying Sets
				//$content .= '<td width="150">Page 0001<br>Run Date 06/29/12<br>Run Time 19:32:29 </td>';
				$content .= '<td width="150">'.$project['search'].'<br>至:'.$date.'<br>运行时间 '.$time.' </td>';
				$content .= '</tr>';
			
				$content .= '<tr>';
				$content .= '<td colspan="5">';
				$content .= '<table border="0" cellspacing="0" cellpadding="1" style="border:1px solid #000000;">';
			
				$content .= '<tr align="center">';
				$content .= '<td width="'.$width2.'" style="border-right: 1px solid #999; border-bottom: 1px solid #000000;">编码</td>';
				$content .= '<td width="'.$width3.'" style="border-right: 1px solid #999; border-bottom: 1px solid #000000;">科目</td>';
				$content .= '<td width="'.$width4.'" style="border-right: 1px solid #999; border-bottom: 1px solid #000000;">本期金额</td>';
				$content .= '<td width="'.$width5.'" style="border-right: 1px solid #999; border-bottom: 1px solid #000000;">累计金额</td>';
				if (!$balance) {
					$content .= '<td width="90" style="border-right: 1px solid #999; border-bottom: 1px solid #000000;">采购申请(PO)</td>';
					//$content .= '<td style="border-right: 1px solid #999; border-bottom: 1px solid #000000;">TOTAL COST<br>PLUS COMMITS</td>';
					$content .= '<td width="90" style="border-right: 1px solid #999; border-bottom: 1px solid #000000;">预计费用(ETC)</td>';
					$content .= '<td width="90" style="border-right: 1px solid #999; border-bottom: 1px solid #000000;">预估总计(EFC)</td>';
					$content .= '<td width="90" style="border-right: 1px solid #999; border-bottom: 1px solid #000000;">预算金额</td>';
					$content .= '<td width="85" style="border-right: 1px solid #999; border-bottom: 1px solid #000000;">+：节省/-：超支</td>';
				}
				$content .= '</tr>';
			}

			//var_dump($datas);
			//$language
			$next_rd_index = 0;
			$total_count = count($datas);
			foreach ($datas as $data) {
				$next_rd_index++;
				//var_dump($data);
				if ($data['statistics_level_id'] == 1) {
					//$content .= '<tr align="left">';
					if ($data['main_sub'] == null || $data['main_sub'] == '' || $data['b_new'] == null) {
						$content .= '<tr align="left">';
					} else {
						$content .= '<tr align="left" bgcolor="#efefef">';
					}
					if (!$balance) {
						$content .= '<td style="border-bottom: 1px solid #000000;vnd.ms-excel.numberformat:@">'.$data['main_sub'].'</td>';
						$content .= '<td colspan="8" style="border-bottom: 1px solid #000000;vnd.ms-excel.numberformat:@">'.$data['code_desc_'.$language].'</td>';
					} else {
						$content .= '<td style="border-bottom: 1px solid #000000;vnd.ms-excel.numberformat:@">'.$data['main_sub'].'</td>';
						$content .= '<td colspan="3" style="border-bottom: 1px solid #000000;vnd.ms-excel.numberformat:@">'.$data['code_desc_'.$language].'</td>';
					}
					$content .= '</tr>';
				} else if ($data['statistics_level_id'] == 2) {
					//$content .= '<tr align="left">';
					if ($data['main_sub'] == null || $data['main_sub'] == '') {
						$content .= '<tr align="left">';
					} else {
						$content .= '<tr align="left" bgcolor="#efefef">';
					}
					//$content .= '<td colspan="9" style="border-top: 1px solid #000000;border-bottom: 1px solid #000000;">'.$data['main_sub'].'</td>';
					$content .= '<td align="left" style="border-top: 1px solid #000000;border-bottom: 1px solid #000000;vnd.ms-excel.numberformat:@">'.$data['main_sub'].'</td>';
					$content .= '<td align="left" style="border-top: 1px solid #000000;border-bottom: 1px solid #000000;vnd.ms-excel.numberformat:@">'.$data['code_desc_'.$language].'</td>';
					$content .= '<td align="right" style="border-top: 1px solid #000000;border-bottom: 1px solid #000000;vnd.ms-excel.numberformat:@">'.$data['b_new'].'</td>';
					$content .= '<td align="right" style="border-top: 1px solid #000000;border-bottom: 1px solid #000000;vnd.ms-excel.numberformat:@">'.$data['b_old'].'</td>';
					if (!$balance) {
						$content .= '<td align="right" style="border-top: 1px solid #000000;border-bottom: 1px solid #000000;vnd.ms-excel.numberformat:@">'.$data['p_old'].'</td>';
						$content .= '<td align="right" style="border-top: 1px solid #000000;border-bottom: 1px solid #000000;vnd.ms-excel.numberformat:@">'.$data['etc'].'</td>';
						$content .= '<td align="right" style="border-top: 1px solid #000000;border-bottom: 1px solid #000000;vnd.ms-excel.numberformat:@">'.$data['current'].'</td>';
						$content .= '<td align="right" style="border-top: 1px solid #000000;border-bottom: 1px solid #000000;vnd.ms-excel.numberformat:@">'.$data['budget'].'</td>';
						if ($data['total'] < 0) {
							$content .= '<td align="right" style="'.$line.'vnd.ms-excel.numberformat:@"><font color="red">'.$data['total'].'</font></td>';
						} else {
							$content .= '<td align="right" style="'.$line.'vnd.ms-excel.numberformat:@">'.$data['total'].'</td>';
						}
					}
					$content .= '</tr>';
				} else {
					if ($total_count == $next_rd_index) {
						$content .= '<tr align="left" bgcolor="#efefef">';
					} else {
						$content .= '<tr align="left">';
					}
					//$content .= '<tr align="left">';
					$content .= '<td align="left" style="border-right: 1px solid #999;vnd.ms-excel.numberformat:@">'.$data['main_sub'].'</td>';
					$content .= '<td align="left">'.$data['code_desc_'.$language].'</td>';
					$content .= '<td align="right"  style="vnd.ms-excel.numberformat:@">'.$data['b_new'].'</td>';
					$content .= '<td align="right"  style="vnd.ms-excel.numberformat:@">'.$data['b_old'].'</td>';
					
					if (!$balance) {
						$content .= '<td align="right"  style="vnd.ms-excel.numberformat:@">'.$data['p_old'].'</td>';
						$content .= '<td align="right"  style="vnd.ms-excel.numberformat:@">'.$data['etc'].'</td>';
						$content .= '<td align="right"  style="vnd.ms-excel.numberformat:@">'.$data['current'].'</td>';
						$content .= '<td align="right"  style="vnd.ms-excel.numberformat:@">'.$data['budget'].'</td>';
						if ($data['total'] < 0) {
							$content .= '<td align="right" style="'.$line.'vnd.ms-excel.numberformat:@"><font color="red">'.$data['total'].'</font></td>';
						} else {
							$content .= '<td align="right" style="'.$line.'vnd.ms-excel.numberformat:@">'.$data['total'].'</td>';
						}
					}
					//$content .= '<td align="right">'.$data[9].'</td>';
					$content .= '</tr>';
				}
			}
	
			$content .= '</table>';
			$content .= '</td>';
			$content .= '</tr>';
			$content .= '</table>';
			return $content;
		}

		public static function getRecordsContent($project, $datas) {
			$date = date('Y-m-d', time());
			$time = date('H:i:s', time());
			@$language = $_SESSION['language'];
			if ($language == 'en') {// en
				$content = '<table cellspacing="2" cellpadding="2" border="0" style="border:1px solid #cccccc;">';
				$content .= '<tr align="center">';
				$content .= '<td><font face="dejavusans"><span style="font-size:14">'.$project['project_name'].'</span></font></td>';
				$content .= '</tr>';
				
				$content .= '<tr>';	
				$content .= '<td align="right" width="620">'.$project['search'].'<br>Run Date '.$date.'<br>Run Time '.$time.' </td>';
				$content .= '</tr>';
				$content .= '<tr>';
				$content .= '<td>';
				$content .= '<table border="0" cellspacing="0" cellpadding="1" style="border:1px solid #000000;">';
					
				$content .= '<tr align="center">';
				$content .= '<td width="120" style="border-right: 1px solid #999; border-bottom: 1px solid #000000;">CODE</td>';
				$content .= '<td width="70" style="border-right: 1px solid #999; border-bottom: 1px solid #000000;">TRANSACTION</td>';
				$content .= '<td width="60" style="border-right: 1px solid #999; border-bottom: 1px solid #000000;">BATCH CODE</td>';
				$content .= '<td width="70" style="border-right: 1px solid #999; border-bottom: 1px solid #000000;">AMOUNT</td>';
				$content .= '<td width="180" style="border-right: 1px solid #999; border-bottom: 1px solid #000000;">DESCRIPTION</td>';
				$content .= '<td width="120" style="border-right: 1px solid #999; border-bottom: 1px solid #000000;">CREATE<br>DATE</td>';
				$content .= '</tr>';
			} else {// zh
				$content = '<table cellspacing="2" cellpadding="2" border="0" style="border:1px solid #cccccc;">';
				$content .= '<tr align="center">';
				$content .= '<td><font face="dejavusans"><span style="font-size:14">'.$project['project_name'].'</span></font></td>';
				$content .= '</tr>';
				
				$content .= '<tr>';	
				$content .= '<td align="right" width="620">'.$project['search'].'<br>运行日期 '.$date.'<br>运行时间 '.$time.' </td>';
				$content .= '</tr>';
				$content .= '<tr>';
				$content .= '<td>';
				$content .= '<table border="0" cellspacing="0" cellpadding="1" style="border:1px solid #000000;">';

				$content .= '<tr align="center">';
				$content .= '<td width="120" style="border-right: 1px solid #999; border-bottom: 1px solid #000000;">编码</td>';
				$content .= '<td width="70" style="border-right: 1px solid #999; border-bottom: 1px solid #000000;">单号</td>';
				$content .= '<td width="60" style="border-right: 1px solid #999; border-bottom: 1px solid #000000;">批处理名</td>';
				$content .= '<td width="70" style="border-right: 1px solid #999; border-bottom: 1px solid #000000;">金额</td>';
				$content .= '<td width="180" style="border-right: 1px solid #999; border-bottom: 1px solid #000000;">描述</td>';
				$content .= '<td width="120" style="border-right: 1px solid #999; border-bottom: 1px solid #000000;">创建时间</td>';
				$content .= '</tr>';
			}

			//var_dump($datas);
			//$language
			foreach ($datas as $data) {
				$Amount = $data['amount'];
				if(!is_numeric($Amount)||strpos($Amount,".") != false){
					$Amount = number_format($Amount,2);
				}else{
					$Amount = number_format($Amount).".00";
				}
				$code = $data['all_code'];
				$content .= '<tr align="left">';
				$content .= '<td align="left" style="border-right: 1px solid #999; border-bottom: 1px solid #000000;vnd.ms-excel.numberformat:@">'.$code.'</td>';
				$content .= '<td align="left" style="border-right: 1px solid #999; border-bottom: 1px solid #000000;vnd.ms-excel.numberformat:@">'.$data['transaction_code'].'</td>';
				$content .= '<td align="left" style="border-right: 1px solid #999;border-bottom: 1px solid #000000;vnd.ms-excel.numberformat:@">'.$data['batch_code'].'</td>';
				$content .= '<td align="right" style="border-right: 1px solid #999;border-bottom: 1px solid #000000;vnd.ms-excel.numberformat:@">'.$Amount.'</td>';
				$content .= '<td align="left" style="border-right: 1px solid #999;border-bottom: 1px solid #000000;vnd.ms-excel.numberformat:@">'.$data['detail_desc'].'</td>';
				$content .= '<td align="center" style="border-right: 1px solid #999;border-bottom: 1px solid #000000;vnd.ms-excel.numberformat:@">'.$data['detail_record_date'].'</td>';
				//$content .= '<td align="right">'.$data[9].'</td>';
				$content .= '</tr>';
			}
	
			$content .= '</table>';
			$content .= '</td>';
			$content .= '</tr>';
			$content .= '</table>';
			return $content;
		}

		// Batch Subject
		public static function getBatchSubjectContent($project, $datas) {
			$date = date('Y-m-d', time());
			$time = date('H:i:s', time());
			@$language = $_SESSION['language'];
			if ($language == 'en') {// en
				$content = '<table cellspacing="2" cellpadding="2" border="0" style="border:1px solid #cccccc;">';
				$content .= '<tr align="center">';
				$content .= '<td><font face="dejavusans"><span style="font-size:14">'.$project['project_name'].'</span></font></td>';
				$content .= '</tr>';
				
				$content .= '<tr>';	
				$content .= '<td colspan="5" align="right" width="620">'.$project['search'].'<br>Run Date '.$date.'<br>Run Time '.$time.' </td>';
				$content .= '</tr>';
			} else {// zh
				$content = '<table cellspacing="2" cellpadding="2" border="0" style="border:1px solid #cccccc;">';
				$content .= '<tr align="center">';
				$content .= '<td><font face="dejavusans"><span style="font-size:14">'.$project['project_name'].'</span></font></td>';
				$content .= '</tr>';
				
				$content .= '<tr>';	
				$content .= '<td colspan="5" align="right" width="620">'.$project['search'].'<br>运行日期 '.$date.'<br>运行时间 '.$time.' </td>';
				$content .= '</tr>';
			}

			//var_dump($datas);
			//$language
			$i = 0;
			foreach ($datas as $data) {
				$i++;
				if ($data['transaction_code'] == '') {
					if ($i != 1) {
						$content .= '</table>';
						$content .= '</td>';
						$content .= '</tr>';
						$content .= '<tr height="5" colspan="5"><td></td></tr>';
					}
					$content .= '<tr height="20">';
					$content .= '<td width="160" align="left"  style="vnd.ms-excel.numberformat:@">'.$data['all_code'].'</td>';
					$content .= '<td width="90" align="left"  style="vnd.ms-excel.numberformat:@">'.$data['is_asset'].'</td>';
					$content .= '<td width="110" align="left"   style="vnd.ms-excel.numberformat:@">'.$data['transaction_code'].'</td>';
					$content .= '<td width="150" align="left"  style="vnd.ms-excel.numberformat:@">'.$data['detail_desc'].'</td>';
					$content .= '<td width="110" align="right"  style="vnd.ms-excel.numberformat:@">'.$data['amount'].'</td>';
					$content .= '</tr>';
					$content .= '<tr>';
					$content .= '<td>';
					$content .= '<table border="0" cellspacing="0" cellpadding="1" style="border: 1px solid #000000;">';

					if ($language == 'en') {// en
						$content .= '<tr align="center">';
						$content .= '<td width="160" style="border-right: 1px solid #000000;border-bottom: 1px solid #000000;">Code</td>';
						$content .= '<td width="90" style="border-right: 1px solid #000000;border-bottom: 1px solid #000000;">ASSET</td>';
						$content .= '<td width="110" style="border-right: 1px solid #000000;border-bottom: 1px solid #000000;">TRANSACTION CODE</td>';
						$content .= '<td width="180" style="border-right: 1px solid #000000;border-bottom: 1px solid #000000;">DESCRIPTION</td>';
						//$content .= '<td width="75" style="border-top: 1px solid #000000;border-bottom:0px solid #000000;">Amount</td>';
						$content .= '<td width="80" style="border-bottom: 1px solid #000000;">Amount</td>';
						$content .= '</tr>';
					} else {// zh
						$content .= '<tr align="center">';
						$content .= '<td width="160" style="border-right: 1px solid #000000;border-bottom: 1px solid #000000;">编码</td>';
						$content .= '<td width="90" style="border-right: 1px solid #000000;border-bottom: 1px solid #000000;">资产</td>';
						$content .= '<td width="110" style="border-right: 1px solid #000000;border-bottom: 1px solid #000000;">交易号</td>';
						$content .= '<td width="180" style="border-right: 1px solid #000000;border-bottom: 1px solid #000000;">描述</td>';
						$content .= '<td width="80" style="border-bottom: 1px solid #000000;">金额</td>';
						$content .= '</tr>';
					}
				} else {
					$content .= '<tr>';
					$content .= '<td align="left" style="vnd.ms-excel.numberformat:@">'.$data['all_code'].'</td>';
					$content .= '<td align="left"  style="vnd.ms-excel.numberformat:@">'.$data['is_asset'].'</td>';
					$content .= '<td align="left"  style="vnd.ms-excel.numberformat:@">'.$data['transaction_code'].'</td>';
					$content .= '<td align="left"  style="vnd.ms-excel.numberformat:@">'.$data['detail_desc'].'</td>';
					$content .= '<td align="right" style="vnd.ms-excel.numberformat:@">'.$data['amount'].'</td>';
					$content .= '</tr>';
				}
			}

			$content .= '</table>';
			$content .= '</td>';
			$content .= '</tr>';
			$content .= '</table>';
			return $content;
		}
		
		// Batch 
		public static function getBatchCodeContent($project, $datas) {
			$date = date('Y-m-d', time());
			$time = date('H:i:s', time());
			@$language = $_SESSION['language'];
			if ($language == 'en') {// en
				$content = '<table cellspacing="2" cellpadding="2" border="0" style="border:1px solid #cccccc;">';
				$content .= '<tr align="center">';
				$content .= '<td><font face="dejavusans"><span style="font-size:14">'.$project['project_name'].'</span></font></td>';
				$content .= '</tr>';
				
				$content .= '<tr>';	
				$content .= '<td colspan="4" align="right" width="620">'.$project['search'].'<br>Run Date '.$date.'<br>Run Time '.$time.' </td>';
				$content .= '</tr>';
			} else {// zh
				$content = '<table cellspacing="2" cellpadding="2" border="0" style="border:1px solid #cccccc;">';
				$content .= '<tr align="center">';
				$content .= '<td><font face="dejavusans"><span style="font-size:14">'.$project['project_name'].'</span></font></td>';
				$content .= '</tr>';
				
				$content .= '<tr>';	
				$content .= '<td colspan="4" align="right" width="620">'.$project['search'].'<br>运行日期 '.$date.'<br>运行时间 '.$time.' </td>';
				$content .= '</tr>';
			}

			//var_dump($datas);
			//$language
			$i = 0;
			foreach ($datas as $data) {
				$i++;
				if ($data['is_asset'] == '') {
					if ($i != 1) {
						$content .= '</table>';
						$content .= '</td>';
						$content .= '</tr>';
						$content .= '<tr height="5" colspan="4"><td></td></tr>';
					}
					$content .= '<tr height="20">';
					$content .= '<td width="160" align="left"  style="vnd.ms-excel.numberformat:@">'.$data['all_code'].'</td>';
					$content .= '<td width="90" align="left"  style="vnd.ms-excel.numberformat:@">'.$data['is_asset'].'</td>';
					$content .= '<td width="260" align="left"  style="vnd.ms-excel.numberformat:@">'.$data['detail_desc'].'</td>';
					$content .= '<td width="110" align="right"  style="vnd.ms-excel.numberformat:@">'.$data['amount'].'</td>';
					$content .= '</tr>';
					$content .= '<tr>';
					$content .= '<td>';
					$content .= '<table border="0" cellspacing="0" cellpadding="1" style="border: 1px solid #000000;">';

					if ($language == 'en') {// en
						$content .= '<tr align="center">';
						$content .= '<td width="160" style="border-right: 1px solid #000000;border-bottom: 1px solid #000000;">Code</td>';
						$content .= '<td width="100" style="border-right: 1px solid #000000;border-bottom: 1px solid #000000;">ASSET</td>';
						$content .= '<td width="280" style="border-right: 1px solid #000000;border-bottom: 1px solid #000000;">DESCRIPTION</td>';
						//$content .= '<td width="75" style="border-top: 1px solid #000000;border-bottom:0px solid #000000;">Amount</td>';
						$content .= '<td width="80" style="border-bottom: 1px solid #000000;">Amount</td>';
						$content .= '</tr>';
					} else {// zh
						$content .= '<tr align="center">';
						$content .= '<td width="160" style="border-right: 1px solid #000000;border-bottom: 1px solid #000000;">编码</td>';
						$content .= '<td width="100" style="border-right: 1px solid #000000;border-bottom: 1px solid #000000;">资产</td>';
						$content .= '<td width="280" style="border-right: 1px solid #000000;border-bottom: 1px solid #000000;">描述</td>';
						$content .= '<td width="80" style="border-bottom: 1px solid #000000;">金额</td>';
						$content .= '</tr>';
					}
				} else {
					$content .= '<tr>';
					$content .= '<td align="left" style="vnd.ms-excel.numberformat:@">'.$data['all_code'].'</td>';
					$content .= '<td align="left"  style="vnd.ms-excel.numberformat:@">'.$data['is_asset'].'</td>';
					$content .= '<td align="left"  style="vnd.ms-excel.numberformat:@">'.$data['detail_desc'].'</td>';
					$content .= '<td align="right"  style="vnd.ms-excel.numberformat:@">'.$data['amount'].'</td>';
					$content .= '</tr>';
				}
			}

			$content .= '</table>';
			$content .= '</td>';
			$content .= '</tr>';
			$content .= '</table>';
			return $content;
		}
		
		// 试算平衡 
		public static function getTrialalanceContent($project, $cost, $capital, $total) {
			$date = date('Y-m-d', time());
			$time = date('H:i:s', time());
			@$language = $_SESSION['language'];
			$content = '<table cellspacing="2" cellpadding="2" border="0" style="border:1px solid #cccccc;">';
			if ($language == 'en') {// en
				$content .= '<tr align="center">';
				$content .= '<td><font face="dejavusans"><span style="font-size:14">'.$project['project_name'].'</span></font></td>';
				$content .= '</tr>';
				
				$content .= '<tr>';	
				$content .= '<td colspan="2" align="right" width="620"><br>Run Date '.$date.'<br>Run Time '.$time.' </td>';
				$content .= '</tr>';
				
				$content .= '<tr>';	
				$content .= '<td align="center" style="border: 1px solid #000000;">TOTAL COST:</td>';
				$content .= '<td align="center" style="border: 1px solid #000000;">'.$cost.'</td>';
				$content .= '</tr>';
				
				$content .= '<tr>';	
				$content .= '<td align="center" style="border: 1px solid #000000;">TOTAL CAPITAL:</td>';
				$content .= '<td align="center" style="border: 1px solid #000000;">'.$capital.'</td>';
				$content .= '</tr>';
				
				$content .= '<tr>';	
				$content .= '<td align="center" style="border: 1px solid #000000;">TOTAL:</td>';
				$content .= '<td align="center" style="border: 1px solid #000000;">'.$total.'</td>';
				$content .= '</tr>';
			} else {// zh
				$content .= '<tr align="center">';
				$content .= '<td><font face="dejavusans"><span style="font-size:14">'.$project['project_name'].'</span></font></td>';
				$content .= '</tr>';
				
				$content .= '<tr>';	
				$content .= '<td colspan="2" align="right" width="620"><br>运行日期 '.$date.'<br>运行时间 '.$time.' </td>';
				$content .= '</tr>';
				
				$content .= '<tr>';	
				$content .= '<td align="center" style="border: 1px solid #000000;">成本总额：</td>';
				$content .= '<td align="center" style="border: 1px solid #000000;">'.$cost.'</td>';
				$content .= '</tr>';
				
				$content .= '<tr>';	
				$content .= '<td align="center" style="border: 1px solid #000000;">资金总额：</td>';
				$content .= '<td align="center" style="border: 1px solid #000000;">'.$capital.'</td>';
				$content .= '</tr>';
				
				$content .= '<tr>';	
				$content .= '<td align="center" style="border: 1px solid #000000;">合计：</td>';
				$content .= '<td align="center" style="border: 1px solid #000000;">'.$total.'</td>';
				$content .= '</tr>';
			}
			
			//$content .= '</table>';
			//$content .= '</td>';
			//$content .= '</tr>';
			$content .= '</table>';
			return $content;
		}
	}
?>