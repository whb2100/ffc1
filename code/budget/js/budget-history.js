var projectId = $("#projectId").val();
$(function(){
	var datagrid; //定义全局变量datagrid
    datagrid = $("#itemList").datagrid({
		height:getGridHeight(),
		width:'91%',
		title:'',
		idField:'record_id',
		singleSelect:true,
//		url:'data/budget.retrieve.php',
		url:'data/history.retrieve.php?code_type=2&version_num=0'+'&project_ids='+projectId,
		loadMsg:'',
		pagination:true,
		pageSize:20,
		pageList:[20,50,100],
//		rownumbers:true,
		onLoadSuccess:removeLoader,
		columns:[[
		          {title:BASIC_MAIN_CODE,field:'main_code',  width: '15%', align: 'center'},
		          {title:BASIC_SUB_CODE,field:'sub_code',  width: '15%', align: 'center' },
		          {title:'预算描述',field:'code_desc_zh',  width: '20%', align: 'center' },
		          {title:'DESCRIPTION',field:'code_desc_en',  width: '24%', align: 'center'},
		          // {title:BASIC_STATISTICS_LEVEL_ID, field:'statistics_level_id' , width:'13%' , align:'center' },	

		          

		          {title:BUDGET_AMOUNT,field:'amount',  width: '13%', align: 'center'}, 
		          {title:BASIC_STATISTICS_LEVEL_ID, field:'statistics_level_id' , width:'10%' , align:'center' ,
					  formatter:function(value,rowData,rowIndex){
						  if(value != null){
							  return BASIC_STATISTICS_LEVEL+" "+value;
						  }
					  }
			 }
          ]],
      });
})

// 创建
function create(){
	location.href = "budget-create.php";
}

// 恢复记录
function recovery(){
	$.post('../basic/data/code.recovery.php',function(data){
	      		var data = eval("(" + data + ")");
		          if (data.result == "10000") {
		    		removeLoader();
		    		$.messager.alert(BASSIC_MESSAGE, data.msg);
		    		// $('#itemList').datagrid('reload');
		    		location.href = "budget-create.php";
		      
		          }else if(data.result == "11001"){
			        	removeLoader();
			          	$.messager.alert(BASSIC_MESSAGE, LAN_EXCEL_CHOOSE);
		          }else if (data.result == "11002") {
		          		removeLoader();
			          	$.messager.alert(BASSIC_MESSAGE, LAN_EXCEL_NO_CODE);
		          }else if (data.result == "11003") {
		          		removeLoader();
			          	$.messager.alert(BASSIC_MESSAGE, LAN_EXCEL_REPEAT);
		          }else if (data.result == "11005") {
		          		removeLoader();
			          	$.messager.alert(BASSIC_MESSAGE, LAN_EXCEL_RECOVERY);
		          }else{
		          		removeLoader();
			          	//$.messager.alert(BASSIC_MESSAGE, data.msg);
		          		checkResult(data);
		          }
        	});
}

/*获取高度*/
function getGridHeight(){
	var height1 = $("#_title").height();
	var height2 = $("#_query").height() ;
	var height = document.compatMode=="CSS1Compat"?document.documentElement.clientHeight:document.body.clientHeight;
	return height - height2 - height1 - 100;
}
