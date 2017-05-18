$(function() {
	reloadgrid();
})



/*重新加载表格*/
function reloadgrid(){
	
	$("#budgetFrame").show();
	$("#budgetFrame").attr("src","budget-create.php");
}
//历史记录
// function historyBudget(){

// 	$("#budgetFrame").show();
// 	$("#budgetFrame").attr("src","budget-history.php");
// }


/*打印*/
function printFunction(){
	// $("#projectList").datagrid('reload',{
	// 	agent_empcodes:$("#agentEmpcode").val(),
	// })
}
/*获取高度*/
function getGridHeight(){
	var height1 = $("#_title").height();
	var height2 = $("#_query").height() ;
	var height = document.compatMode=="CSS1Compat"?document.documentElement.clientHeight:document.body.clientHeight;
	return height - height2 - height1 - 100;
}