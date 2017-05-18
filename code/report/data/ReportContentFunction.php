<?php

	namespace report\data;

	class ReportContentFunction {
		
		public static function getHeaderContent($project, $currency_type, $type = 0) {
			$date = date('Y-m-d', time());
			$time = date('H:i:s', time());
			@$language = $_SESSION['language'];
			$logo = "../../images/logo-$language.png";
			
			if ($currency_type != null) {
				$n = stripos($currency_type, '(');
				if ($n > 0) {
					if ($language == 'en') {// en
						$currency_type = substr($currency_type, 0, $n);
					} else {
						$currency_type = substr($currency_type, $n + 1, strlen($currency_type) - $n - 2);
					}
				}
				$project_name = $project['project_name'];
			} else {
				$currency_type = '';
				$project_name = $project['project_name'];
			}
			
			$logo = "../../images/logo-$language.png";
			
			//$content  = '<div style="border:1px solid #cccccc;">';
			$content .= '<table width="100%" border="0" style="border:0px solid #000000;"><tbody>';
			$content .= '<tr align="center">';
			$content .= '<td width="220"><img style="vertical-align: top" width="160" src="'.$logo.'"/></td>';
			$content .= '<td align="center" style="vertical-align: top"><span style="font-size:24">'.$project_name.'</span></td>';
			if ($type == 0) {
				if ($language == 'en') {
					$content .= '<td width="220" align="right" style="vertical-align: top">'.$project['search'].'<br>Run Date '.$date.'<br>Run Time '.$time.' </td>';
				} else {
					$content .= '<td width="220" align="right" style="vertical-align: top">'.$project['search'].'<br>运行日期 '.$date.'<br>运行时间 '.$time.' </td>';
				}
			} else {
				if ($language == 'en') {
					$content .= '<td width="220" align="right" style="vertical-align: top">'.$project['search'].'<br>TO:'.$date.'<br>Run Time '.$time.' </td>';
				} else {
					$content .= '<td width="220" align="right" style="vertical-align: top">'.$project['search'].'<br>至:'.$date.'<br>运行时间 '.$time.' </td>';
				}
			}
			$content .= '</tr>';
			if ($currency_type != null) {
				$content .= '<tr>';
				$content .= '<td width="140" colspan="3">'.$currency_type.'</td>';// Cost620<br>Production
			}
			$content .= '</tr></tbody></table>';
			return $content;
		}
		
		// budget cost report
		public static function getBudgetCostContent($project, $datas, $currency_type = null, $balance = false, $report_type = 0) {
			//$date = date('Y-m-d', time());
			//$time = date('H:i:s', time());
			@$language = $_SESSION['language'];
			$content = ReportContentFunction::getHeaderContent($project, $currency_type, 1);
			
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

			$content .= '<table align="center" width="99%" border="0" cellspacing="0" cellpadding="0" style="border-collapse:collapse;border:1px solid #000000;border-top: 0px solid #000000;"><tbody>';
			if ($report_type == 3) {
				$line = 'border-bottom: 1px solid #000000;';
			} else {
				$line = 'border-bottom: 1px solid #000000;';
			}
			$index = 0;
			if ($language == 'en') {
				$content .= '<tr align="center">';
				$content .= '<td width="'.$width2.'" style="border-top: 1px solid #000000;border-right: 1px solid #000000;'.$line.'">Account<br>Code</td>';
				$content .= '<td width="'.$width3.'" style="border-top: 1px solid #000000;border-right: 1px solid #000000;'.$line.'">Account<br>Description</td>';
				$content .= '<td width="'.$width4.'" style="border-top: 1px solid #000000;border-right: 1px solid #000000;'.$line.'">ACTUAL<br>THIS PERIOD</td>';
				if (!$balance) {
					$content .= '<td width="'.$width5.'" style="border-top: 1px solid #000000;border-right: 1px solid #000000;'.$line.'">TOTAL<br>TO DATE</td>';
				} else {
					$content .= '<td width="'.$width5.'" style="border-top: 1px solid #000000;border-right: 0px solid #000000;'.$line.'">TOTAL<br>TO DATE</td>';
				}
				if (!$balance) {
					$content .= '<td width="90" style="border-top: 1px solid #000000;border-right: 1px solid #000000;'.$line.'">PURCHASE<br>ORDER(PO)</td>';
					$content .= '<td width="90" style="border-top: 1px solid #000000;border-right: 1px solid #000000;'.$line.'">ESTIMATE_TO<br>COMPLET(ETC)</td>';
					$content .= '<td width="90" style="border-top: 1px solid #000000;border-right: 1px solid #000000;'.$line.'">ESTIMATE<br>FINAL COST(EFC)</td>';
					$content .= '<td width="90" style="border-top: 1px solid #000000;border-right: 1px solid #000000;'.$line.'">BUDGET AMT</td>';
					$content .= '<td width="85" style="border-top: 1px solid #000000;border-bottom: 1px solid #000000;">+:SAVING/-:OVERAGE</td>';
				}
				$content .= '</tr>';
			} else {
				$content .= '<tr align="center">';
				$content .= '<td width="'.$width2.'" style="border-top: 1px solid #000000;border-right: 1px solid #000000;'.$line.'">编码</td>';
				$content .= '<td width="'.$width3.'" style="border-top: 1px solid #000000;border-right: 1px solid #000000;'.$line.'">科目</td>';
				$content .= '<td width="'.$width4.'" style="border-top: 1px solid #000000;border-right: 1px solid #000000;'.$line.'">本期金额 </td>';
				if (!$balance) {
					$content .= '<td width="'.$width5.'" style="border-top: 1px solid #000000;border-right: 1px solid #000000;'.$line.'">累计金额</td>';
				} else {
					$content .= '<td width="'.$width5.'" style="border-top: 1px solid #000000;border-right: 0px solid #000000;'.$line.'">累计金额</td>';
				}
				if (!$balance) {
					$content .= '<td width="90" style="border-top: 1px solid #000000;border-right: 1px solid #000000;'.$line.'">采购申请(PO)</td>';
					$content .= '<td width="90" style="border-top: 1px solid #000000;border-right: 1px solid #000000;'.$line.'">预计费用(ETC)</td>';
					$content .= '<td width="90" style="border-top: 1px solid #000000;border-right: 1px solid #000000;'.$line.'">预估总计(EFC)</td>';
					$content .= '<td width="90" style="border-top: 1px solid #000000;border-right: 1px solid #000000;'.$line.'">预算金额</td>';
					$content .= '<td width="85" style="border-top: 1px solid #000000;'.$line.'">+：节省/-：超支</td>';
				}
				$content .= '</tr>';
			}
			$next_rd_index = 0;
			$total_count = count($datas);
			foreach ($datas as $data) {
				$next_rd_index++;
				$index++;
				//echo $total_count.';'.$next_rd_index.'='.$data['statistics_level_id'].','.$data['code_desc_'.$language].'<br>';
				//var_dump($data);echo('<br><br>');
				if ($data['statistics_level_id'] == 1) {
					if ($data['main_sub'] == null || $data['main_sub'] == '' || $data['b_new'] == null) {
						$content .= '<tr align="left">';
					} else {
						$content .= '<tr align="left" bgcolor="#efefef">';
					}
					$line = 'border-top: 1px solid #000000;border-bottom: 1px solid #000000;';
					if (!$balance) {
						$content .= '<td style="'.$line.'vnd.ms-excel.numberformat:@">'.$data['main_sub'].'</td>';
						$content .= '<td colspan="8" style="'.$line.'vnd.ms-excel.numberformat:@">'.$data['code_desc_'.$language].'</td>';
					} else {
						$content .= '<td style="'.$line.'vnd.ms-excel.numberformat:@">'.$data['main_sub'].'</td>';
						$content .= '<td colspan="3" style="'.$line.'vnd.ms-excel.numberformat:@">'.$data['code_desc_'.$language].'</td>';
					}
					$content .= '</tr>';
				} else if ($data['statistics_level_id'] == 2) {
					if ($data['main_sub'] == null || $data['main_sub'] == '') {
						$content .= '<tr align="left">';
					} else {
						$content .= '<tr align="left" bgcolor="#efefef">';
					}
					if (strlen($data['main_sub']) == 1) {
						if ($report_type == 1) {
							$line = 'border-top: 1px solid #000000;border-bottom: 1px solid #000000;';
						} else if ($report_type == 2) {
							$line = 'border-top: 1px solid #000000;border-bottom: 1px solid #000000;';
						} else if ($report_type == 5 || $report_type == 14) {
							$line = 'border-top: 1px solid #000000;border-bottom: 1px solid #000000;';
						} else if ($report_type == 6 || $report_type == 15) {
							$line = 'border-top: 1px solid #000000;border-bottom: 1px solid #000000;';
						} else if ($report_type == 11) {
							$line = 'border-top:1px solid #000000;border-bottom: 1px solid #000000;';
						} else if ($report_type == 12) {
							$line = 'border-top: 1px solid #000000;border-bottom: 1px solid #000000;';
						} else {
							$line = 'border-top: 1px solid #000000;border-bottom: 1px solid #000000;';
						}
					} else if (strlen($data['main_sub']) == 4) {
						$line = 'border-top:1px solid #000000;border-bottom: 0px solid #000000;';
					} else {
						/*if ($report_type == 11 || $report_type == 12) {
							$line = 'border-top: 1px solid #000000;border-bottom: 0px solid #000000;';
						} else {
							$line = 'border-top: 1px solid #000000;border-bottom: 1px solid #000000;';
						}*/
						$line = 'border-top: 1px solid #000000;border-bottom: 1px solid #000000;';
					}
					//$content .= '<td align="left" style="'.$line.'vnd.ms-excel.numberformat:@">'.$data['main_sub'].'_'.$index.'</td>';
					$content .= '<td align="left" style="'.$line.'vnd.ms-excel.numberformat:@">'.$data['main_sub'].'</td>';
					$content .= '<td align="left" style="'.$line.'vnd.ms-excel.numberformat:@">'.$data['code_desc_'.$language].'</td>';
					$content .= '<td align="right" style="'.$line.'vnd.ms-excel.numberformat:@">'.$data['b_new'].'</td>';
					$content .= '<td align="right" style="'.$line.'vnd.ms-excel.numberformat:@">'.$data['b_old'].'</td>';
					if (!$balance) {
						$content .= '<td align="right" style="'.$line.'vnd.ms-excel.numberformat:@">'.$data['p_old'].'</td>';
						$content .= '<td align="right" style="'.$line.'vnd.ms-excel.numberformat:@">'.$data['etc'].'</td>';
						$content .= '<td align="right" style="'.$line.'vnd.ms-excel.numberformat:@">'.$data['current'].'</td>';
						$content .= '<td align="right" style="'.$line.'vnd.ms-excel.numberformat:@">'.$data['budget'].'</td>';
						if ($data['total'] < 0) {
							$content .= '<td align="right" style="'.$line.'vnd.ms-excel.numberformat:@"><font color="red">'.$data['total'].'</font></td>';
						} else {
							$content .= '<td align="right" style="'.$line.'vnd.ms-excel.numberformat:@">'.$data['total'].'</td>';
						}
					}
					$content .= '</tr>';
				} else {
					if ($report_type == 1 || $report_type == 11) {
						if ($data['main_sub'] == null) {// 总计
							$line = 'border-top: 1px solid #000000;';
						} else {
							$line = 'border-top: 0px solid #000000;';
						}
					} else if ($report_type == 2 || $report_type == 12) {
						if ($data['main_sub'] == null) {// 总计
							$line = 'border-top: 1px solid #000000;';
						} else {
							$line = 'border-top: 0px solid #000000;';
						}
					} else if ($report_type == 3) {
						if ($data['main_sub'] == null) {// 总计
							$line = 'border-top: 1px solid #000000;';
						} else {
							$line = 'border-top: 0px solid #000000;';
						}
					} else {
						$line = '';
					}
					if ($total_count == $next_rd_index) {
						$content .= '<tr align="left" bgcolor="#efefef">';
					} else {
						$content .= '<tr align="left">';
					}
					//$content .= '<tr align="left">';
					$content .= '<td align="left" style="'.$line.'border-right: 1px solid #000000;vnd.ms-excel.numberformat:@">'.$data['main_sub'].'</td>';
					$content .= '<td align="left" style="'.$line.'">'.$data['code_desc_'.$language].'</td>';
					$content .= '<td align="right" style="'.$line.'vnd.ms-excel.numberformat:@">'.$data['b_new'].'</td>';
					$content .= '<td align="right" style="'.$line.'vnd.ms-excel.numberformat:@">'.$data['b_old'].'</td>';
					
					if (!$balance) {
						$content .= '<td align="right" style="'.$line.'vnd.ms-excel.numberformat:@">'.$data['p_old'].'</td>';
						$content .= '<td align="right" style="'.$line.'vnd.ms-excel.numberformat:@">'.$data['etc'].'</td>';
						$content .= '<td align="right" style="'.$line.'vnd.ms-excel.numberformat:@">'.$data['current'].'</td>';
						$content .= '<td align="right" style="'.$line.'vnd.ms-excel.numberformat:@">'.$data['budget'].'</td>';
						if ($data['total'] < 0) {
							$content .= '<td align="right" style="'.$line.'vnd.ms-excel.numberformat:@"><font color="red">'.$data['total'].'</font></td>';
						} else {
							$content .= '<td align="right" style="'.$line.'vnd.ms-excel.numberformat:@">'.$data['total'].'</td>';
						}
					}
					$content .= '</tr>';
				}
				if ($report_type == 1 || $report_type == 2 || $report_type == 3) {
					$page_num = 38;
				} else {
					$page_num = 36;
				}
				// 换页
				if ($index % $page_num == 0) {
					if (count($datas) <= $next_rd_index) {// 没有数据了
						//$content .= '</tbody></table><br></div>';
						$content .= '</tbody></table><br>';
						return $content;
					} else {
						//$content .= '</tbody></table><br></div><pagebreak />';
						$content .= '</tbody></table><br><pagebreak />';
					}
					$content .= ReportContentFunction::getHeaderContent($project, $currency_type, 1);
					$content .= '<table align="center" width="99%" border="0" cellspacing="0" cellpadding="0" style="border-collapse:collapse;border:1px solid #000000;border-top: 0px solid #000000;"><tbody>';
					if ($report_type == 3) {
						$line = 'border-bottom: 1px solid #000000;';
					} else {
						if (count($datas) > $next_rd_index) {
							$next_data = $datas[$next_rd_index];
							if ($next_data['statistics_level_id'] == 3) {
								$line = 'border-bottom: 1px solid #000000;';
							} else {
								$line = 'border-bottom: 0px solid #000000;';
							}
						} else {
							$line = 'border-bottom: 0px solid #000000;';
						}
					}
					$index = 0;
					if ($language == 'en') {
						$content .= '<tr align="center">';
						$content .= '<td width="'.$width2.'" style="border-top: 1px solid #000000;border-right: 1px solid #000000;'.$line.'">Account<br>Code</td>';
						$content .= '<td width="'.$width3.'" style="border-top: 1px solid #000000;border-right: 1px solid #000000;'.$line.'">Account<br>Description</td>';
						$content .= '<td width="'.$width4.'" style="border-top: 1px solid #000000;border-right: 1px solid #000000;'.$line.'">ACTUAL<br>THIS PERIOD</td>';
						if (!$balance) {
							$content .= '<td width="'.$width5.'" style="border-top: 1px solid #000000;border-right: 1px solid #000000;'.$line.'">TOTAL<br>TO DATE</td>';
						} else {
							$content .= '<td width="'.$width5.'" style="border-top: 1px solid #000000;border-right: 0px solid #000000;'.$line.'">TOTAL<br>TO DATE</td>';
						}
						if (!$balance) {
							$content .= '<td width="90" style="border-top: 1px solid #000000;border-right: 1px solid #000000;'.$line.'">PURCHASE<br>ORDER(PO)</td>';
							$content .= '<td width="90" style="border-top: 1px solid #000000;border-right: 1px solid #000000;'.$line.'">ESTIMATE_TO<br>COMPLET(ETC)</td>';
							$content .= '<td width="90" style="border-top: 1px solid #000000;border-right: 1px solid #000000;'.$line.'">ESTIMATE<br>FINAL COST(EFC)</td>';
							$content .= '<td width="90" style="border-top: 1px solid #000000;border-right: 1px solid #000000;'.$line.'">BUDGET AMT</td>';
							$content .= '<td width="85" style="border-top: 1px solid #000000;border-bottom: 1px solid #000000;">+:SAVING/-:OVERAGE</td>';
						}
						$content .= '</tr>';
					} else {
						$content .= '<tr align="center">';
						$content .= '<td width="'.$width2.'" style="border-top: 1px solid #000000;border-right: 1px solid #000000;'.$line.'">编码</td>';
						$content .= '<td width="'.$width3.'" style="border-top: 1px solid #000000;border-right: 1px solid #000000;'.$line.'">科目</td>';
						$content .= '<td width="'.$width4.'" style="border-top: 1px solid #000000;border-right: 1px solid #000000;'.$line.'">本期金额 </td>';
						if (!$balance) {
							$content .= '<td width="'.$width5.'" style="border-top: 1px solid #000000;border-right: 1px solid #000000;'.$line.'">累计金额</td>';
						} else {
							$content .= '<td width="'.$width5.'" style="border-top: 1px solid #000000;border-right: 0px solid #000000;'.$line.'">累计金额</td>';
						}
						if (!$balance) {
							$content .= '<td width="90" style="border-top: 1px solid #000000;border-right: 1px solid #000000;'.$line.'">采购申请(PO)</td>';
							$content .= '<td width="90" style="border-top: 1px solid #000000;border-right: 1px solid #000000;'.$line.'">预计费用(ETC)</td>';
							$content .= '<td width="90" style="border-top: 1px solid #000000;border-right: 1px solid #000000;'.$line.'">预估总计(EFC)</td>';
							$content .= '<td width="90" style="border-top: 1px solid #000000;border-right: 1px solid #000000;'.$line.'">预算金额</td>';
							$content .= '<td width="85" style="border-top: 1px solid #000000;'.$line.'">+：节省/-：超支</td>';
						}
						$content .= '</tr>';
					}
				}
			}
			$content .= '</tbody></table><br>';
			//$content .= '</div>';
			return $content;
		}
		
		public static function getRecordsContent($project, $datas) {
			//$date = date('Y-m-d', time());
			//$time = date('H:i:s', time());
			/*for ($i = 0; $i < 100; $i++) {
				$f = array('all_code'=>'abc'.$i);
				array_push($datas, $f);
			}*/
			@$language = $_SESSION['language'];
			$content = ReportContentFunction::getHeaderContent($project, $currency_type);
			$index = 0;
			$next_rd_index = 0;
			$content .= '<table align="center" width="99%" border="0" cellspacing="1" cellpadding="0" style="border-collapse:collapse;border:1px solid #000000;"><tbody>';
			if ($language == 'en') {// en
				$content .= '<tr align="center">';
				$content .= '<td width="110" style="border-right: 1px solid #000000; border-bottom: 0px solid #000000;">CODE</td>';
				$content .= '<td width="70" style="border-right: 1px solid #000000; border-bottom: 0px solid #000000;">TRANSACTION</td>';
				$content .= '<td width="60" style="border-right: 1px solid #000000; border-bottom: 0px solid #000000;">BATCH CODE</td>';
				$content .= '<td width="70" style="border-right: 1px solid #000000; border-bottom: 0px solid #000000;">AMOUNT</td>';
				$content .= '<td width="190" style="border-right: 1px solid #000000; border-bottom: 0px solid #000000;">DESCRIPTION</td>';
				$content .= '<td width="120" style="border-right: 0px solid #000000; border-bottom: 0px solid #000000;">CREATE<br>DATE</td>';
				$content .= '</tr>';
			} else {
				$content .= '<tr align="center">';
				$content .= '<td width="110" style="border-right: 1px solid #000000; border-bottom: 0px solid #000000;">编码</td>';
				$content .= '<td width="70" style="border-right: 1px solid #000000; border-bottom: 0px solid #000000;">单号</td>';
				$content .= '<td width="60" style="border-right: 1px solid #000000; border-bottom: 0px solid #000000;">批处理名</td>';
				$content .= '<td width="70" style="border-right: 1px solid #000000; border-bottom: 0px solid #000000;">金额</td>';
				$content .= '<td width="190" style="border-right: 1px solid #000000; border-bottom: 0px solid #000000;">描述</td>';
				$content .= '<td width="120" style="border-right: 0px solid #000000; border-bottom: 0px solid #000000;">创建时间</td>';
				$content .= '</tr>';
			}
			foreach ($datas as $data) {
				$next_rd_index++;
				$index++;
				$Amount = $data['amount'];
				if(!is_numeric($Amount)||strpos($Amount,".") != false){
					$Amount = number_format($Amount,2);
				}else{
					$Amount = number_format($Amount).".00";
				}
				$code = $data['all_code'];
				$content .= '<tr align="left">';
				$content .= '<td align="left" style="border-right: 1px solid #000000; border-top: 1px solid #000000;vnd.ms-excel.numberformat:@">'.$code.'</td>';
				$content .= '<td align="left" style="border-right: 1px solid #000000; border-top: 1px solid #000000;vnd.ms-excel.numberformat:@">'.$data['transaction_code'].'</td>';
				$content .= '<td align="left" style="border-right: 1px solid #000000;border-top: 1px solid #000000;vnd.ms-excel.numberformat:@">'.$data['batch_code'].'</td>';
				$content .= '<td align="right" style="border-right: 1px solid #000000;border-top: 1px solid #000000;vnd.ms-excel.numberformat:@">'.$Amount.'</td>';
				$content .= '<td align="left" style="border-right: 1px solid #000000;border-top: 1px solid #000000;vnd.ms-excel.numberformat:@">'.$data['detail_desc'].'</td>';
				$content .= '<td align="center" style="border-right: 0px solid #000000;border-top: 1px solid #000000;vnd.ms-excel.numberformat:@">'.$data['detail_record_date'].'</td>';
				$content .= '</tr>';
				// 换页
				if ($index % 55 == 0) {
					if (count($datas) <= $next_rd_index) {
						//$content .= '</tbody></table><br></div>';
						$content .= '</tbody></table><br>';
						return $content;
					} else {
						//$content .= '</tbody></table><br></div><pagebreak />';
						$content .= '</tbody></table><br><pagebreak />';
					}
					$content .= ReportContentFunction::getHeaderContent($project, $currency_type);
					$content .= '<table align="center" width="99%" border="0" cellspacing="1" cellpadding="0" style="border-collapse:collapse;border:1px solid #000000;"><tbody>';
					if ($language == 'en') {// en
						$content .= '<tr align="center">';
						$content .= '<td width="110" style="border-right: 1px solid #000000; border-bottom: 0px solid #000000;">CODE</td>';
						$content .= '<td width="70" style="border-right: 1px solid #000000; border-bottom: 0px solid #000000;">TRANSACTION</td>';
						$content .= '<td width="60" style="border-right: 1px solid #000000; border-bottom: 0px solid #000000;">BATCH CODE</td>';
						$content .= '<td width="70" style="border-right: 1px solid #000000; border-bottom: 0px solid #000000;">AMOUNT</td>';
						$content .= '<td width="190" style="border-right: 1px solid #000000; border-bottom: 0px solid #000000;">DESCRIPTION</td>';
						$content .= '<td width="120" style="border-right: 0px solid #000000; border-bottom: 0px solid #000000;">CREATE<br>DATE</td>';
						$content .= '</tr>';
					} else {
						$content .= '<tr align="center">';
						$content .= '<td width="110" style="border-right: 1px solid #000000; border-bottom: 0px solid #000000;">编码</td>';
						$content .= '<td width="70" style="border-right: 1px solid #000000; border-bottom: 0px solid #000000;">单号</td>';
						$content .= '<td width="60" style="border-right: 1px solid #000000; border-bottom: 0px solid #000000;">批处理名</td>';
						$content .= '<td width="70" style="border-right: 1px solid #000000; border-bottom: 0px solid #000000;">金额</td>';
						$content .= '<td width="190" style="border-right: 1px solid #000000; border-bottom: 0px solid #000000;">描述</td>';
						$content .= '<td width="120" style="border-right: 0px solid #000000; border-bottom: 0px solid #000000;">创建时间</td>';
						$content .= '</tr>';
					}
				}
			}
			$content .= '</tbody></table><br>';
			//$content .= '</div>';
			return $content;
		}
		
		// Batch Subject
		public static function getBatchSubjectContent($project, $datas) {
			//$date = date('Y-m-d', time());
			//$time = date('H:i:s', time());
			@$language = $_SESSION['language'];
			$is_continue = false;
			$index = 0;
			$next_rd_index = 0;
			$content = ReportContentFunction::getHeaderContent($project, $currency_type);

			$i = 0;
			$content .= '<table align="center" width="100%" cellspacing="0" cellpadding="0" border="0" style="border-collapse:collapse;border:0px solid #000000;"><tbody>';
			foreach ($datas as $data) {
				$i++;
				$next_rd_index++;
				$index++;
				if ($is_continue) {
					$is_continue = false;
					continue;
				}
				if ($data['transaction_code'] == null || $data['transaction_code'] == '') {
					if ($i != 1) {
						//$content .= '</tbody></table><br>';
						$all_code = $data['all_code'];
						$amount = $data['amount'];
						$content .= '<tr><td colspan="5">&nbsp;</td></tr>';
						$index++;
					}
					//$content .= '<table align="center" width="70" cellspacing="0" cellpadding="0" border="0" style="border:0px solid #000000;"><tbody>';
					$content .= '<tr height="24">';
					$content .= '<td width="340" colspan="2" align="left" style="vnd.ms-excel.numberformat:@">'.$data['all_code'].'</td>';
					$content .= '<td width="40" align="left" style="vnd.ms-excel.numberformat:@">'.$data['transaction_code'].'</td>';
					$content .= '<td width="200" align="left" style="vnd.ms-excel.numberformat:@">'.$data['detail_desc'].'</td>';
					$content .= '<td align="right" style="vnd.ms-excel.numberformat:@">'.$data['amount'].'</td>';
					$content .= '</tr>';
					//$content .= '</tbody></table>';
					
					//$content .= '<table align="center" width="700" cellspacing="0" cellpadding="0" border="0" style="border:1px solid #000000;"><tbody>';
					if ($language == 'en') {// en
						$content .= '<tr align="center">';
						$content .= '<td width="160" style="border-bottom: 0px solid #000000;border-top: 1px solid #000000;border-left: 1px solid #000000;border-right: 1px solid #000000;">Code</td>';
						$content .= '<td width="90" style="border-right: 1px solid #000000;border-bottom: 0px solid #000000;border-top: 1px solid #000000;">ASSET</td>';
						$content .= '<td width="110" style="border-right: 1px solid #000000;border-bottom: 0px solid #000000;border-top: 1px solid #000000;">TRANSACTION CODE</td>';
						$content .= '<td width="200" style="border-right: 1px solid #000000;border-bottom: 0px solid #000000;border-top: 1px solid #000000;">DESCRIPTION</td>';
						$content .= '<td width="150" style="border-right: 1px solid #000000;border-bottom: 0px solid #000000;border-top: 1px solid #000000;">Amount</td>';
						$content .= '</tr>';
					} else {// zh
						$content .= '<tr align="center">';
						$content .= '<td width="160" style="border-bottom: 0px solid #000000;border-top: 1px solid #000000;border-left: 1px solid #000000;border-right: 1px solid #000000;">编码</td>';
						$content .= '<td width="90" style="border-right: 1px solid #000000;border-bottom: 0px solid #000000;border-top: 1px solid #000000;">资产</td>';
						$content .= '<td width="110" style="border-right: 1px solid #000000;border-bottom: 0px solid #000000;border-top: 1px solid #000000;">交易号</td>';
						$content .= '<td width="200" style="border-right: 1px solid #000000;border-bottom: 0px solid #000000;border-top: 1px solid #000000;">描述</td>';
						$content .= '<td width="150" style="border-right: 1px solid #000000;border-bottom: 0px solid #000000;border-top: 1px solid #000000;vnd.ms-excel.numberformat:@">金额</td>';
						$content .= '</tr>';
					}
				} else {
					$content .= '<tr>';
					$content .= '<td width="160" align="left" style="border: 1px solid #000000;vnd.ms-excel.numberformat:@">'.$data['all_code'].'</td>';
					$content .= '<td width="90" align="left" style="border-right: 1px solid #000000;border-bottom: 1px solid #000000;border-top: 1px solid #000000;vnd.ms-excel.numberformat:@">'.$data['is_asset'].'</td>';
					$content .= '<td width="110" align="left" style="border-right: 1px solid #000000;border-bottom: 1px solid #000000;border-top: 1px solid #000000;vnd.ms-excel.numberformat:@">'.$data['transaction_code'].'</td>';
					$content .= '<td width="200" align="left" style="border-right: 1px solid #000000;border-bottom: 1px solid #000000;border-top: 1px solid #000000;vnd.ms-excel.numberformat:@">'.$data['detail_desc'].'</td>';
					$content .= '<td width="150" align="right" style="border-right: 1px solid #000000;border-bottom: 1px solid #000000;border-top: 1px solid #000000;vnd.ms-excel.numberformat:@">'.$data['amount'].'</td>';
					$content .= '</tr>';
				}
				// 换页
				if ($index % 51 == 0 || $index % 52 == 0) {
					if (count($datas) > $next_rd_index) {
						$next_data = $datas[$next_rd_index];
						if ($next_data['transaction_code'] == null || $next_data['transaction_code'] == '') {
							$is_continue = true;
						}
					}
					$index = 0;
					if (count($datas) <= $next_rd_index) {
						//$content .= '</tbody></table><br></div>';
						$content .= '</tbody></table><br>';
						return $content;
					} else {
						//$content .= '</tbody></table><br></div><pagebreak />';
						$content .= '</tbody></table><br><pagebreak />';
					}
					$content .= ReportContentFunction::getHeaderContent($project, $currency_type);
					$content .= '<table align="center" width="100%" cellspacing="0" cellpadding="0" border="0" style="border-collapse:collapse;border:0px solid #000000;"><tbody>';
					$content .= '<tr height="24">';
					$content .= '<td width="160" align="left" style="vnd.ms-excel.numberformat:@">'.$all_code.'</td>';
					$content .= '<td width="90" align="left" style="vnd.ms-excel.numberformat:@"></td>';
					$content .= '<td width="110" align="left" style="vnd.ms-excel.numberformat:@"></td>';
					$content .= '<td width="200" align="left" style="vnd.ms-excel.numberformat:@"></td>';
					$content .= '<td width="150" align="right" style="vnd.ms-excel.numberformat:@">'.$amount.'</td>';
					$content .= '</tr>';
					//$content .= '</tbody></table>';
					
					//$content .= '<table align="center" width="700" cellspacing="0" cellpadding="0" border="0" style="border:1px solid #000000;"><tbody>';
					if ($language == 'en') {// en
						$content .= '<tr align="center">';
						$content .= '<td width="160" style="border-bottom: 0px solid #000000;border-top: 1px solid #000000;border-left: 1px solid #000000;border-right: 1px solid #000000;">Code</td>';
						$content .= '<td width="90" style="border-right: 1px solid #000000;border-bottom: 0px solid #000000;border-top: 1px solid #000000;">ASSET</td>';
						$content .= '<td width="110" style="border-right: 1px solid #000000;border-bottom: 0px solid #000000;border-top: 1px solid #000000;">TRANSACTION CODE</td>';
						$content .= '<td width="200" style="border-right: 1px solid #000000;border-bottom: 0px solid #000000;border-top: 1px solid #000000;">DESCRIPTION</td>';
						$content .= '<td width="150" style="border-right: 1px solid #000000;border-bottom: 0px solid #000000;border-top: 1px solid #000000;">Amount</td>';
						$content .= '</tr>';
					} else {// zh
						$content .= '<tr align="center">';
						$content .= '<td width="160" style="border-bottom: 0px solid #000000;border-top: 1px solid #000000;border-left: 1px solid #000000;border-right: 1px solid #000000;">编码</td>';
						$content .= '<td width="90" style="border-right: 1px solid #000000;border-bottom: 0px solid #000000;border-top: 1px solid #000000;">资产</td>';
						$content .= '<td width="110" style="border-right: 1px solid #000000;border-bottom: 0px solid #000000;border-top: 1px solid #000000;">交易号</td>';
						$content .= '<td width="200" style="border-right: 1px solid #000000;border-bottom: 0px solid #000000;border-top: 1px solid #000000;">描述</td>';
						$content .= '<td width="150" style="border-right: 1px solid #000000;border-bottom: 0px solid #000000;border-top: 1px solid #000000;vnd.ms-excel.numberformat:@">金额</td>';
						$content .= '</tr>';
					}
				}
			}
			$content .= '</tbody></table><br>';
			//$content .= '</div>';
			return $content;
		}
		
		// Batch 
		public static function getBatchCodeContent($project, $datas) {
			//$date = date('Y-m-d', time());
			//$time = date('H:i:s', time());
			@$language = $_SESSION['language'];
			$is_continue = false;
			$index = 0;
			$next_rd_index = 0;
			$content = ReportContentFunction::getHeaderContent($project, $currency_type);

			$i = 0;
			$content .= '<table align="center" width="100%" cellspacing="0" cellpadding="0" border="0" style="border-collapse:collapse;border:0px solid #000000;"><tbody>';
			foreach ($datas as $data) {
				$i++;
				$next_rd_index++;
				$index++;
				if ($is_continue) {
					$is_continue = false;
					continue;
				}
				if ($data['is_asset'] == null || $data['is_asset'] == '') {
					if ($i != 1) {
						//$content .= '</tbody></table><br>';
						$all_code = $data['all_code'];
						$amount = $data['amount'];
						$content .= '<tr><td colspan="5">&nbsp;</td></tr>';
						$index++;
					}
					//$content .= '<table align="center" width="70" cellspacing="0" cellpadding="0" border="0" style="border:0px solid #000000;"><tbody>';
					$content .= '<tr height="24">';
					$content .= '<td width="340" colspan="2" align="left" style="vnd.ms-excel.numberformat:@">'.$data['all_code'].'</td>';
					$content .= '<td width="200" align="left" style="vnd.ms-excel.numberformat:@">'.$data['detail_desc'].'</td>';
					$content .= '<td align="right" style="vnd.ms-excel.numberformat:@">'.$data['amount'].'</td>';
					$content .= '</tr>';
					//$content .= '</tbody></table>';
					
					//$content .= '<table align="center" width="700" cellspacing="0" cellpadding="0" border="0" style="border:1px solid #000000;"><tbody>';
					if ($language == 'en') {// en
						$content .= '<tr align="center">';
						$content .= '<td width="160" style="border-bottom: 0px solid #000000;border-top: 1px solid #000000;border-left: 1px solid #000000;border-right: 1px solid #000000;">Code</td>';
						$content .= '<td width="90" style="border-right: 1px solid #000000;border-bottom: 0px solid #000000;border-top: 1px solid #000000;">ASSET</td>';
						$content .= '<td width="200" style="border-right: 1px solid #000000;border-bottom: 0px solid #000000;border-top: 1px solid #000000;">DESCRIPTION</td>';
						$content .= '<td width="150" style="border-right: 1px solid #000000;border-bottom: 0px solid #000000;border-top: 1px solid #000000;">Amount</td>';
						$content .= '</tr>';
					} else {// zh
						$content .= '<tr align="center">';
						$content .= '<td width="160" style="border-bottom: 0px solid #000000;border-top: 1px solid #000000;border-left: 1px solid #000000;border-right: 1px solid #000000;">编码</td>';
						$content .= '<td width="90" style="border-right: 1px solid #000000;border-bottom: 0px solid #000000;border-top: 1px solid #000000;">资产</td>';
						$content .= '<td width="200" style="border-right: 1px solid #000000;border-bottom: 0px solid #000000;border-top: 1px solid #000000;">描述</td>';
						$content .= '<td width="150" style="border-right: 1px solid #000000;border-bottom: 0px solid #000000;border-top: 1px solid #000000;vnd.ms-excel.numberformat:@">金额</td>';
						$content .= '</tr>';
					}
				} else {
					$content .= '<tr>';
					$content .= '<td width="160" align="left" style="border: 1px solid #000000;vnd.ms-excel.numberformat:@">'.$data['all_code'].'</td>';
					$content .= '<td width="90" align="left" style="border-right: 1px solid #000000;border-bottom: 1px solid #000000;border-top: 1px solid #000000;vnd.ms-excel.numberformat:@">'.$data['is_asset'].'</td>';
					$content .= '<td width="200" align="left" style="border-right: 1px solid #000000;border-bottom: 1px solid #000000;border-top: 1px solid #000000;vnd.ms-excel.numberformat:@">'.$data['detail_desc'].'</td>';
					$content .= '<td width="150" align="right" style="border-right: 1px solid #000000;border-bottom: 1px solid #000000;border-top: 1px solid #000000;vnd.ms-excel.numberformat:@">'.$data['amount'].'</td>';
					$content .= '</tr>';
				}
				// 换页
				if ($index % 45 == 0 || $index % 46 == 0) {
					if (count($datas) > $next_rd_index) {
						$next_data = $datas[$next_rd_index];
						if ($next_data['is_asset'] == null || $next_data['is_asset'] == '') {
							$is_continue = true;
						}
					}
					$index = 0;
					if (count($datas) <= $next_rd_index) {
						//$content .= '</tbody></table><br></div>';
						$content .= '</tbody></table><br>';
						return $content;
					} else {
						//$content .= '</tbody></table><br></div><pagebreak />';
						$content .= '</tbody></table><br><pagebreak />';
					}
					$content .= ReportContentFunction::getHeaderContent($project, $currency_type);
					$content .= '<table align="center" width="100%" cellspacing="0" cellpadding="0" border="0" style="border-collapse:collapse;border:0px solid #000000;"><tbody>';
					$content .= '<tr height="24">';
					$content .= '<td width="160" align="left" style="vnd.ms-excel.numberformat:@">'.$all_code.'</td>';
					$content .= '<td width="90" align="left" style="vnd.ms-excel.numberformat:@"></td>';
					$content .= '<td width="200" align="left" style="vnd.ms-excel.numberformat:@"></td>';
					$content .= '<td width="150" align="right" style="vnd.ms-excel.numberformat:@">'.$amount.'</td>';
					$content .= '</tr>';
					//$content .= '</tbody></table>';
					
					//$content .= '<table align="center" width="700" cellspacing="0" cellpadding="0" border="0" style="border:1px solid #000000;"><tbody>';
					if ($language == 'en') {// en
						$content .= '<tr align="center">';
						$content .= '<td width="160" style="border-bottom: 0px solid #000000;border-top: 1px solid #000000;border-left: 1px solid #000000;border-right: 1px solid #000000;">Code</td>';
						$content .= '<td width="90" style="border-right: 1px solid #000000;border-bottom: 0px solid #000000;border-top: 1px solid #000000;">ASSET</td>';
						$content .= '<td width="200" style="border-right: 1px solid #000000;border-bottom: 0px solid #000000;border-top: 1px solid #000000;">DESCRIPTION</td>';
						$content .= '<td width="150" style="border-right: 1px solid #000000;border-bottom: 0px solid #000000;border-top: 1px solid #000000;">Amount</td>';
						$content .= '</tr>';
					} else {// zh
						$content .= '<tr align="center">';
						$content .= '<td width="160" style="border-bottom: 0px solid #000000;border-top: 1px solid #000000;border-left: 1px solid #000000;border-right: 1px solid #000000;">编码</td>';
						$content .= '<td width="90" style="border-right: 1px solid #000000;border-bottom: 0px solid #000000;border-top: 1px solid #000000;">资产</td>';
						$content .= '<td width="200" style="border-right: 1px solid #000000;border-bottom: 0px solid #000000;border-top: 1px solid #000000;">描述</td>';
						$content .= '<td width="150" style="border-right: 1px solid #000000;border-bottom: 0px solid #000000;border-top: 1px solid #000000;vnd.ms-excel.numberformat:@">金额</td>';
						$content .= '</tr>';
					}
				}
			}
			$content .= '</tbody></table><br>';
			//$content .= '</div>';
			return $content;
		}
		
		// 试算平衡 
		public static function getTrialalanceContent($project, $cost, $capital, $total, $records3, $records4, $records5) {
			//$date = date('Y-m-d', time());
			//$time = date('H:i:s', time());
			@$language = $_SESSION['language'];
			$content = ReportContentFunction::getHeaderContent($project, $currency_type);

			$content .= '<table align="center" width="99%" cellspacing="0" cellpadding="1" border="0" style="border-collapse:collapse;border:1px solid #000000;"><tbody>';
			if ($language == 'en') {// en
				$content .= '<tr height="10">';	
				$content .= '<td colspan="2" align="left" style="border: 1px solid #000000;">Creative Staff:</td>';
				$content .= '</tr>';

				if (count($records3) > 0) {// 导演
					$content .= '<tr>';	
					$content .= '<td align="right" style="border-top: 0px solid #000000;">DIRECTOR:</td>';
					$content .= '<td align="center" style="border-top: 0px solid #000000;border-left: 1px solid #000000;">'.$records3[0]['director_name'].'</td>';
					$content .= '</tr>';
				}
				
				$i = 0;
				foreach($records4 as $record) {// 演员
					$i++;
					$content .= '<tr>';	
					$content .= '<td align="right" style="border-top: 1px solid #000000;">'.$i.'#ACTOR:</td>';
					$content .= '<td align="center" style="border-top: 1px solid #000000;border-left: 1px solid #000000;">'.$record['actor_name'].'</td>';
					$content .= '</tr>';
				}
				
				$content .= '<tr height="10">';	
				$content .= '<td align="left" style="border-top: 1px solid #000000;">STATUS:</td>';
				$content .= '<td align="right" style="border-top: 1px solid #000000;border-left: 1px solid #000000;">'.$project['project_status_name_en'].'</td>';
				$content .= '</tr>';

				$content .= '<tr height="10">';	
				$content .= '<td colspan="2" align="left" style="border-top: 1px solid #000000;">EXCHANGE RATE:</td>';
				$content .= '</tr>';
				
				foreach($records5 as $record) {// 汇率
					$currency_type = $record['currency_type'];
					$n = stripos($currency_type, '(');
					if ($n > 0) {
						$currency_type = substr($currency_type, 0, $n);
					}
					$content .= '<tr>';	
					$content .= '<td align="right" style="border-top: 1px solid #000000;">'.$currency_type.'</td>';
					$content .= '<td align="right" style="border-top: 1px solid #000000;border-left: 1px solid #000000;">'.$record['exchange_rate'].'</td>';
					$content .= '</tr>';
				}

				$content .= '<tr height="10">';	
				$content .= '<td colspan="2" align="left" style="border-top: 1px solid #000000;">SUMMARY:</td>';
				$content .= '</tr>';
				
				$content .= '<tr>';	
				$content .= '<td align="right" style="border-top: 1px solid #000000;">TOTAL COST:</td>';
				$content .= '<td align="right" style="border-top: 1px solid #000000;border-left: 1px solid #000000;">'.$cost.'</td>';
				$content .= '</tr>';
				
				$content .= '<tr>';	
				$content .= '<td align="right" style="border-top: 1px solid #000000;">TOTAL CAPITAL:</td>';
				$content .= '<td align="right" style="border-top: 1px solid #000000;border-left: 1px solid #000000;">'.$capital.'</td>';
				$content .= '</tr>';
				
				$content .= '<tr>';	
				$content .= '<td align="right" style="border-top: 1px solid #000000;">TOTAL:</td>';
				$content .= '<td align="right" style="border-top: 1px solid #000000;border-left: 1px solid #000000;">'.$total.'</td>';
				$content .= '</tr>';
			} else {// zh
				$content .= '<tr height="10">';	
				$content .= '<td colspan="2" align="left" style="border: 1px solid #000000;">主创：</td>';
				$content .= '</tr>';
				
				if (count($records3) > 0) {// 导演
					$content .= '<tr>';	
					$content .= '<td align="right" style="border-top: 0px solid #000000;">导演：</td>';
					$content .= '<td align="center" style="border-top: 0px solid #000000;border-left: 1px solid #000000;">'.$records3[0]['director_name'].'</td>';
					$content .= '</tr>';
				}
				$i = 0;
				foreach($records4 as $record) {// 演员
					$i++;
					$content .= '<tr>';	
					$content .= '<td align="right" style="border-top: 1px solid #000000;">'.$i.'#主演：</td>';
					$content .= '<td align="center" style="border-top: 1px solid #000000;border-left: 1px solid #000000;">'.$record['actor_name'].'</td>';
					$content .= '</tr>';
				}
				
				$content .= '<tr height="10">';	
				$content .= '<td align="lect" style="border-top: 1px solid #000000;">项目进度:</td>';
				$content .= '<td align="right" style="border-top: 1px solid #000000;border-left: 1px solid #000000;">'.$project['project_status_name'].'</td>';
				$content .= '</tr>';

				$content .= '<tr height="10">';	
				$content .= '<td colspan="2" align="left" style="border-top: 1px solid #000000;">汇率：</td>';
				$content .= '</tr>';
				
				foreach($records5 as $record) {// 汇率
					$currency_type = $record['currency_type'];
					$n = stripos($currency_type, '(');
					if ($n > 0) {
						$currency_type = substr($currency_type, 0, $n);
					}
					$content .= '<tr>';	
					$content .= '<td align="right" style="border-top: 1px solid #000000;">'.$currency_type.'</td>';
					$content .= '<td align="right" style="border-top: 1px solid #000000;border-left: 1px solid #000000;">'.$record['exchange_rate'].'</td>';
					$content .= '</tr>';
				}

				$content .= '<tr height="10">';	
				$content .= '<td colspan="2" align="left" style="border-top: 1px solid #000000;">汇总：</td>';
				$content .= '</tr>';
				
				$content .= '<tr>';	
				$content .= '<td align="right" style="border-top: 1px solid #000000;">成本总额：</td>';
				$content .= '<td align="right" style="border-top: 1px solid #000000;border-left: 1px solid #000000;">'.$cost.'</td>';
				$content .= '</tr>';
				
				$content .= '<tr>';	
				$content .= '<td align="right" style="border-top: 1px solid #000000;">资金总额：</td>';
				$content .= '<td align="right" style="border-top: 1px solid #000000;border-left: 1px solid #000000;;">'.$capital.'</td>';
				$content .= '</tr>';
				
				$content .= '<tr>';	
				$content .= '<td align="right" style="border-top: 1px solid #000000;">合计：</td>';
				$content .= '<td align="right" style="border-top: 1px solid #000000;border-left: 1px solid #000000;">'.$total.'</td>';
				$content .= '</tr>';
			}
			//$content .= '</tbody></table><br></div>';
			$content .= '</tbody></table><br>';
			return $content;
		}
	}
?>