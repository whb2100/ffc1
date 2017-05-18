$("#pName").html(currentProjectName+">");

//货币
function currency(obj){
	this.sel(obj);
	$("#basicIframe").attr("src","currency-list.php");
}

//地区
function region(obj){
	this.sel(obj);
	changeBackground();
	$("#basicIframe").attr("src","region-list.php");
}

//编码
function code(obj){
	this.sel(obj);
	changeBackground();
	$("#basicIframe").attr("src","code-list.php");
}

//场景
function scene(obj){
	this.sel(obj);
	changeBackground();
	$("#basicIframe").attr("src","scene-list.php");
}

//F1
function free1(obj){
	this.sel(obj);
	changeBackground();
	$("#basicIframe").attr("src","free-list.php?free_type=1");
}

//F2
function free2(obj){
	this.sel(obj);
	changeBackground();
	$("#basicIframe").attr("src","free-list.php?free_type=2");
}

//F3
function free3(obj){
	this.sel(obj);
	changeBackground();
	$("#basicIframe").attr("src","free-list.php?free_type=3");
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