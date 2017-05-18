var projectId = $("#projectId").val();
var userId = $("#userId").val();
var language = $("#language").val();


function getParams(){
	var arr = new Object();
	// arr['start_date'] = $('#startDate').datebox('getValue');
	arr['start_date'] = formatEnDate($('#startDate').datebox('getValue'));

	// arr['resource_url'] = $("#resource_url").val();
	// arr['user_id'] = $("#userId").val();
	return arr;
}

function changeMix(newValue, oldValue){
	if(newValue.value == 1){
		searchNoMix();
		document.getElementById('mixDiv').style.display = "none";
		document.getElementById('noMixDiv').style.display = "block";
	}else{
		reloadgrid();
		document.getElementById('mixDiv').style.display = "block";
		document.getElementById('noMixDiv').style.display = "none";
	}
}

$(function(){
	$("#ifMixed").combobox({
		onSelect:changeMix
	});
	$("#ifMixed").combobox('setValue',0);
	searchView();
	var datagrid; //定义全局变量datagrid
    datagrid = $("#itemList").datagrid({
		height:getGridHeight(),
		width:'91%',
		title:'',
		idField:'main_sub',
		// singleSelect:true,
		url:'data/main_sub.retrieve.php?project_id='+projectId,
		// url:'data/history.retrieve.php?code_type=2&version_num=0'+'&project_ids='+projectId,
		loadMsg:'',
		selectOnCheck:true,
		checkOnSelect:true,
		queryParams:getParams(),
		pagination:true,
		pageSize:100000,
		pageList:[100000],
//		rownumbers:true,
		onLoadSuccess:removeLoader,
		columns:[[
		          {title:'',field:'',  width: '10%', align: 'center',checkbox:true},
		          {title:ACCOUNT_NUMBER,field:'main_sub',  width: '20%', align: 'left',halign: 'center'},
		          {title:ACCOUNT_DESCRIPTION,field:CODE_DESC_LAN,  width: '25%', align: 'left',halign: 'center' },
		          {title:ACTUAL_THIS_PERIOD,field:'b_new',  width: '15%', align: 'right',halign: 'center' },
		          {title:ACTUAL_TO_DATE,field:'b_old',  width: '15%', align: 'right',halign: 'center'},
		          {title:PO_COMMITS_TO_DATE,field:'p_old',  width: '15%', align: 'right',halign: 'center'},
		          {title:ESTIMATE_TO_COMPLETE,field:'etc',  width: '15%', align: 'right',halign: 'center'},
		          {title:CURRENT_EFC_AMOUNT,field:'current',  width: '15%', align: 'right',halign: 'center'},
		          {title:CURRENT_BUDGET_AMT,field:'budget',  width: '15%', align: 'right',halign: 'center'},
		          {title:TOTAL_VARIANCE,field:'total',  width: '15%', align: 'right',halign: 'center'}
		  //         {title:BASIC_STATISTICS_LEVEL_ID, field:'statistics_level_id' , width:'10%' , align:'center' ,
				// 	  formatter:function(value,rowData,rowIndex){
				// 		  if(value != null){
				// 			  return BASIC_STATISTICS_LEVEL+" "+value;
				// 		  }
				// 	  }
			 // }
          ]],
      });
})

/*重新加载表格*/
function reloadgrid(){
	var mix = $('#ifMixed').combobox('getValue');
	var id = $('#view').combobox('getValue');
	if (mix == 0) {

			$('#itemList').datagrid('options')['url'] = 'data/main_sub.retrieve.php?id='+id;
			// $('#itemList').datagrid('options')['url'] = 'data/main_sub.retrieve.php?id='+id;
			// $('#itemList').datagrid('options')['onBeforeLoad'] = function(){showLoader()};
			// $('#itemList').datagrid('options')['onLoadSuccess'] = function(){removeLoader()};
			// $('#itemList').datagrid('options')['onLoadError'] = function(){removeLoader()};
			$("#itemList").datagrid('reload',getParams());



	} else {
		$.ajax({
			url: "data/currency.retrieve.php",
			type: 'get',
			async: false,
			dataTye: 'json',
			success: function (data) {
				currencyData = eval('(' + data + ')');
			}
		})
		for (var i = 0; i < currencyData.length; i++) {
			$("#currencyList"+currencyData[i].currency_type_id).datagrid('options')['url'] = 'data/main_sub.retrieve2.php?currency_type_id='+currencyData[i].currency_type_id+'&id='+id,
			$("#currencyList"+currencyData[i].currency_type_id).datagrid('reload',getParams());
		}
	}	
}

// 获取标签
function  searchView(){
	$.ajax({
		type:'GET',
		url:'data/view.retrieve.php',
		contentType:'application/json;charset=utf-8',
		dataType:'json',
		success: function(data) {
			var obj = new Object();
			obj.view_id = "";
			obj.view_name = VIEW_ALL;
			data.splice(0, 0, obj);
			$("#view").combobox({
				data:data,
				valueField:"view_id",
				textField:"view_name"
			});
		}
	});
}


// 删除标签
function  delView(){
	var id = $('#view').combobox('getValue');
	if (id) {
		$.messager.confirm(BASIC_CONFIRM,SAVE_VIEW_3,function(confirm){
			            if (confirm){
					$.post('data/view.del.php',{id : id},function(data){
				        		var data = eval('(' + data + ")");
				        		if (data.result == RESULT_CODE_SUCCESS) {
				        			$.messager.alert(BASSIC_MESSAGE, BASSIC_SUCCESSFUL_OPERATION);
				        			searchView();
				        			// $("#itemList").datagrid("reload");
				        		// }else if (data.result == "11006") {
				          // 		removeLoader();
					         //  	$.messager.alert(BASSIC_MESSAGE, LAN_EXCEL_DEL);
				          		}else {
				        			checkResult(data);
				        		}
				        	});
				}else{
					// $.messager.alert(BASSIC_MESSAGE, SAVE_VIEW_4);
				}
			});
	}else{
		$.messager.alert(BASSIC_MESSAGE, SAVE_VIEW_4);
	}
}



// 保存标签
function  saveView(){
	var rows = $('#itemList').datagrid('getChecked');
	if (!rows || rows.length < 1) {
		$.messager.alert(BASSIC_MESSAGE, SAVE_VIEW);
		return;
	}
	var ids = '';
	for (var i = 0; i < rows.length; i++) {
		var row = rows[i];
		if (row.main_sub==null||row.main_sub.length != 7) {
			$.messager.alert(BASSIC_MESSAGE, SAVE_VIEW_1);
			return;
		}
		if (i == 0) {
			ids = row.main_sub;
		} else {
			ids += "," + row.main_sub;
		}	
			
	}
	if (ids) {
		 $.messager.prompt(BASIC_CONFIRM,SAVE_VIEW_0,function(confirm){
		            if (confirm){
				$.post('data/view.create.php',{ids : ids,name:confirm},function(data){
			        		var data = eval('(' + data + ")");
			        		if (data.result == RESULT_CODE_SUCCESS) {
			        			$.messager.alert(BASSIC_MESSAGE, BASSIC_SUCCESSFUL_OPERATION);
			        			searchView();
			        			$('#itemList').datagrid('uncheckAll');
			        			// $("#itemList").datagrid("reload");
			        		// }else if (data.result == "11006") {
			          // 		removeLoader();
				         //  	$.messager.alert(BASSIC_MESSAGE, LAN_EXCEL_DEL);
			          		}else {
			        			checkResult(data);
			        		}
			        	});
			}else{
				// $.messager.alert(BASSIC_MESSAGE, SAVE_VIEW_2);
			}
		});
	}else{
		$.messager.alert(BASSIC_MESSAGE, SAVE_VIEW);
	}	
}



/*查询不混合数据*/
function searchNoMix(){
	$("#noMixDiv").empty();
	var currencyData = "";
	var dateMix = formatEnDate($('#startDate').datebox('getValue'));
	$.ajax({
		url: "data/currency.retrieve.php",
		type: 'get',
		async: false,
		dataTye: 'json',
		success: function (data) {
			currencyData = eval('(' + data + ')');
		}
	})
	for (var i = 0; i < currencyData.length; i++) {
			$("#noMixDiv").append("<div id='currencyList"+currencyData[i].currency_type_id+"'></div><br>");
			$("#currencyList"+currencyData[i].currency_type_id).datagrid({
				autoHeight:true,
				width:'91%',
				title:currencyData[i].currency_type,
				url:'data/main_sub.retrieve2.php?currency_type_id='+currencyData[i].currency_type_id,
				idField:'record_id',

				queryParams:getParams(),
				// url:'data/main_sub.retrieve.php?project_id='+projectId,
				singleSelect:true,
				loadMsg:'',
				pagination:true,
				pageSize:20,
				pageList:[20,50,100],
				rownumbers:true,
				onLoadSuccess:removeLoader,
				columns:[[
				          {title:ACCOUNT_NUMBER,field:'main_sub',  width: '20%', align: 'left',halign: 'center'},
				          {title:ACCOUNT_DESCRIPTION,field:CODE_DESC_LAN,  width: '25%', align: 'left',halign: 'center' },
				          {title:ACTUAL_THIS_PERIOD,field:'b_new',  width: '15%', align: 'right',halign: 'center' },
				          {title:ACTUAL_TO_DATE,field:'b_old',  width: '15%', align: 'right',halign: 'center'},
				          {title:PO_COMMITS_TO_DATE,field:'p_old',  width: '15%', align: 'right',halign: 'center'},
				          {title:ESTIMATE_TO_COMPLETE,field:'etc',  width: '15%', align: 'right',halign: 'center'},
				          {title:CURRENT_EFC_AMOUNT,field:'current',  width: '15%', align: 'right',halign: 'center'},
				          {title:CURRENT_BUDGET_AMT,field:'budget',  width: '15%', align: 'right',halign: 'center'},
				          {title:TOTAL_VARIANCE,field:'total',  width: '15%', align: 'right',halign: 'center'}
		          ]]
		      });
		}
}

/*导出*/
function ExcleFunction() {
	var view = $('#view').combobox('getValue');
	var mix = $('#ifMixed').combobox('getValue');
	var start_date = formatEnDate($('#startDate').datebox('getValue'));
	if (mix == 1) {
		window.open("data/report.excel.php?report_type=11&start_date=" + start_date + "&id=" + view, "_blank");
	} else {
		window.open("data/report.excel.php?report_type=1&start_date=" + start_date + "&id=" + view, "_blank");
	}
}


/*导出*/
function PDFFunction(){
	var view = $('#view').combobox('getValue');
	var mix = $('#ifMixed').combobox('getValue');
	var start_date = formatEnDate($('#startDate').datebox('getValue'));
	if (mix == 1) {
		window.open("data/report.pdf.php?report_type=11&start_date=" + start_date + "&id=" + view, "_blank");
	} else {
		window.open("data/report.pdf.php?report_type=1&start_date=" + start_date + "&id=" + view, "_blank");
	}
}

/*获取高度*/
function getGridHeight(){
	var height1 = $("#_title").height();
	var height2 = $("#_query").height() ;
	var height = document.compatMode=="CSS1Compat"?document.documentElement.clientHeight:document.body.clientHeight;
	return height - height2 - height1 - 100;
}
