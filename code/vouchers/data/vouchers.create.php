<?php 
namespace vouchers\data;
use utils\UploadUtils;
require '../../utils/Autoloader.php';

$arr = array();
$vouchersPic=array();
for($i = 0 ; $i < count($_FILES['images']['name']) ; $i++){
	$vouchersPic['name'] = $_FILES['images']['name'][$i];
	$vouchersPic['type'] = $_FILES['images']['type'][$i];
	$vouchersPic['tmp_name'] = $_FILES['images']['tmp_name'][$i];
	$vouchersPic['error'] = $_FILES['images']['error'][$i];
	$vouchersPic['size'] = $_FILES['images']['size'][$i];
	if(substr($vouchersPic['name'], -3) != "pdf" && substr($vouchersPic['name'], -3) != "jpg"){
		$arr['result'] = 100;
	}else{
		$isPicture = UploadUtils::isPDF($vouchersPic);
		if($isPicture){
			$pic_url = UploadUtils::uploadFile2($vouchersPic, 'uploads/vouchers/'.$requestParamArr['project_name'],0);
			if($pic_url){
				$requestParamArr['vouchers_pic'] = $pic_url;
				$requestParamArr['vouchers_name'] = $vouchersPic['name'];
			}
		$arr = VouchersFunction::createitem($requestParamArr);
		}else{
			$arr['result'] = 100;
		}
	}
}
echo json_encode($arr);
?>