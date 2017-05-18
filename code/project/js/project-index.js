$(function() {
	reloadgrid();
})

/*重新加载表格*/
function reloadgrid(){
	$("#PRO").val($("#pro").combobox('getValue'));
	$("#PROSTATUS").val($("#proStatus").combobox('getValue'));
	$("#STARTDATE").val($('#startDate').datebox('getValue'));
	$("#ENDDATE").val($('#endDate').datebox('getValue'));
	$("#projectFrame").show();
	$("#projectFrame").attr("src","project-list.php");
}

// 创建项目
function createProject(){
	$("#projectFrame").show();
	$("#projectFrame").attr("src","project-create.php");
}


function ExcleFunction(){
	
}

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