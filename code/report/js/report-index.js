$("#pName").html(currentProjectName+">");

//试算平衡
function trialBalance(obj){
	this.sel(obj);
	$("#basicIframe").attr("src","trial-balance.php");
}

//货币
function currency(obj){
	this.sel(obj);
	changeBackground();
	$("#basicIframe").attr("src","main_sub.php");
}

//地区
function region(obj){
	this.sel(obj);
	changeBackground();
	$("#basicIframe").attr("src","main.php");
}

//批处理 明细报表
function code(obj){
	this.sel(obj);
	changeBackground();
	$("#basicIframe").attr("src","top.php");
}

//批处理明细报表
function scene(obj){
	this.sel(obj);
	changeBackground();
	$("#basicIframe").attr("src","batch-list.php");
}

//PO明细报表
function free1(obj){
	this.sel(obj);
	changeBackground();
//	$("#basicIframe").attr("src","po-records.php");
	location.href = "../poInput/poHistory-list.php";
}

//F2
function free2(obj){
	this.sel(obj);
	changeBackground();
	$("#basicIframe").attr("src","balance.php");
}

//F3
function free3(obj){
	this.sel(obj);
	changeBackground();
	$("#basicIframe").attr("src","balance_main.php");
}

//全部批处理详情
function batchDetail(obj){
	this.sel(obj);
	changeBackground();
	$("#basicIframe").attr("src","batch-records.php");
}

function changeBackground(){
	document.getElementById("currencyBG").style.background = "#bbbbbb";
}

var tag = null;
function sel(obj){
	if (tag != null) {
		tag.style.background="#bbbbbb";
	}
	tag = obj;
	tag.style.background="#1e59a8";
 }