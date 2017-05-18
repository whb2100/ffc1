var projectId = $("#projectId").val();
var userId = $("#userId").val();
var language = $("#language").val();


function getParams(){
	var arr = new Object();
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
	var datagrid; //定义全局变量datagrid
    datagrid = $("#itemList").datagrid({
		height:getGridHeight(),
		width:'91%',
		title:'',
		idField:'record_id',
		singleSelect:true,
		url:'data/balance_main.retrieve.php?project_id='+projectId,
		// url:'data/history.retrieve.php?code_type=2&version_num=0'+'&project_ids='+projectId,
		loadMsg:'',
		queryParams:getParams(),
		pagination:true,
		pageSize:100000,
		pageList:[100000],
//		rownumbers:true,
		onLoadSuccess:removeLoader,
		columns:[[
		          {title:ACCOUNT_NUMBER,field:'main_sub',  width: '20%', align: 'left',halign: 'center'},
		          {title:ACCOUNT_DESCRIPTION,field:CODE_DESC_LAN,  width: '25%', align: 'left',halign: 'center' },
		          {title:ACTUAL_THIS_PERIOD,field:'b_new',  width: '25%', align: 'right',halign: 'center' },
		          {title:ACTUAL_TO_DATE,field:'b_old',  width: '25%', align: 'right',halign: 'center'}
		          // {title:PO_COMMITS_TO_DATE,field:'p_old',  width: '15%', align: 'right',halign: 'center'},
		          // {title:ESTIMATE_TO_COMPLETE,field:'etc',  width: '15%', align: 'right',halign: 'center'},
		          // {title:CURRENT_EFC_AMOUNT,field:'current',  width: '18%', align: 'right',halign: 'center'},
		          // {title:CURRENT_BUDGET_AMT,field:'budget',  width: '15%', align: 'right',halign: 'center'},
		          // {title:TOTAL_VARIANCE,field:'total',  width: '15%', align: 'right',halign: 'center'}
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
	if (mix == 0) {
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
			$("#currencyList"+currencyData[i].currency_type_id).datagrid('reload',getParams());
		}
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
				url:'data/balance_main.retrieve2.php?currency_type_id='+currencyData[i].currency_type_id,
				idField:'record_id',
				// url:'data/main_sub.retrieve.php?project_id='+projectId,
				singleSelect:true,
				loadMsg:'',
				queryParams:getParams(),
				pagination:true,
				pageSize:20,
				pageList:[20,50,100],
				rownumbers:true,
				onLoadSuccess:removeLoader,
				columns:[[
				          {title:ACCOUNT_NUMBER,field:'main_sub',  width: '20%', align: 'left',halign: 'center'},
				          {title:ACCOUNT_DESCRIPTION,field:CODE_DESC_LAN,  width: '25%', align: 'left',halign: 'center' },
				          {title:ACTUAL_THIS_PERIOD,field:'b_new',  width: '25%', align: 'right',halign: 'center' },
				          {title:ACTUAL_TO_DATE,field:'b_old',  width: '25%', align: 'right',halign: 'center'}
				          // {title:PO_COMMITS_TO_DATE,field:'p_old',  width: '15%', align: 'right',halign: 'center'},
				          // {title:ESTIMATE_TO_COMPLETE,field:'etc',  width: '15%', align: 'right',halign: 'center'},
				          // {title:CURRENT_EFC_AMOUNT,field:'current',  width: '18%', align: 'right',halign: 'center'}
				          // {title:CURRENT_BUDGET_AMT,field:'budget',  width: '15%', align: 'right',halign: 'center'},
				          // {title:TOTAL_VARIANCE,field:'total',  width: '15%', align: 'right',halign: 'center'}
		          ]]
		      });
		}
}

/*导出*/
function ExcleFunction(){
	var mix = $('#ifMixed').combobox('getValue');
	var start_date = formatEnDate($('#startDate').datebox('getValue'));
	if (mix == 1) {
		window.open("data/report.excel.php?report_type=15&start_date=" + start_date, "_blank");
	} else {
		window.open("data/report.excel.php?report_type=6&start_date=" + start_date, "_blank");
	}
}


/*导出*/
function PDFFunction(){
	var mix = $('#ifMixed').combobox('getValue');
	var start_date = formatEnDate($('#startDate').datebox('getValue'));
	if (mix == 1) {
		window.open("data/report.pdf.php?report_type=15&start_date=" + start_date, "_blank");
	} else {
		window.open("data/report.pdf.php?report_type=6&start_date=" + start_date, "_blank");
	}
}

/*获取高度*/
function getGridHeight(){
	var height1 = $("#_title").height();
	var height2 = $("#_query").height() ;
	var height = document.compatMode=="CSS1Compat"?document.documentElement.clientHeight:document.body.clientHeight;
	return height - height2 - height1 - 100;
}
