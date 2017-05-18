var language = $("#language").val();

/*搜索条件*/
var arr = new Object();
function getParams(){
	var viewId = $('#view').combobox('getValue');
	var currencyStart = $("#currencyStart").val();
	var currencyEnd = $("#currencyEnd").val();
	var regionStart = $("#regionStart").val();
	var regionEnd = $("#regionEnd").val();
	var mainStart = $("#mainStart").val();
	var mainEnd = $("#mainEnd").val();
	var subStart = $("#subStart").val();
	var subEnd = $("#subEnd").val();
	var sceneStart = $("#sceneStart").val();
	var sceneEnd = $("#sceneEnd").val();
	var f1Start = $("#f1Start").val();
	var f1End = $("#f1End").val();
	var f2Start = $("#f2Start").val();
	var f2End = $("#f2End").val();
	var f3Start = $("#f3Start").val();
	var f3End = $("#f3End").val();
	var transactionCodeStart = $("#transactionCodeStart").val();
	var transactionCodeEnd = $("#transactionCodeEnd").val();
	var batchCode = $("#batchCode").val();
	var desc = $("#desc").val();
	var startDate = formatEnDate($('#startDate').datebox('getValue'));
	var endDate = formatEnDate($('#endDate').datebox('getValue'));
	var isAsset = $('#isAssets').combobox('getValue');
	arr['view_id'] = viewId;
	arr['currency_start'] = currencyStart;
	arr['currency_end'] = currencyEnd;
	arr['region_start'] = regionStart;
	arr['region_end'] = regionEnd;
	arr['main_start'] = mainStart;
	arr['main_end'] = mainEnd;
	arr['sub_start'] = subStart;
	arr['sub_end'] = subEnd;
	arr['scene_start'] = sceneStart;
	arr['scene_end'] = sceneEnd;
	arr['f1_start'] = f1Start;
	arr['f1_end'] = f1End;
	arr['f2_start'] = f2Start;
	arr['f2_end'] = f2End;
	arr['f3_start'] = f3Start;
	arr['f3_end'] = f3End;
	arr['transaction_start'] = transactionCodeStart;
	arr['transaction_end'] = transactionCodeEnd;
	arr['batch_code'] = batchCode;
	arr['detail_desc'] = desc;
	arr['start_date'] = startDate;
	arr['end_date'] = endDate;
	arr['is_asset'] = isAsset;
	return arr;
}

// 复制数据
function inputBlur(target) {
	var startId = target.id;
	if (target.value != null && target.value != "") {
		var endId = startId.replace("Start", "End");
		var val = $("#" + endId).val();
		if (val == null || val == "") {
			$("#" + endId).val(target.value);
		}
	}
}

$(function() {
	searchView();
	$('#startDate').datebox({
		onSelect: function(date) {
			if ($('#endDate').datebox('getValue') == null || $('#endDate').datebox('getValue') == "") {
				$('#endDate').datebox('setValue', $('#startDate').datebox('getValue'));
			}
		}
	});

	var datagrid;
    datagrid = $("#itemList").datagrid({
		height:getGridHeight(),
		width:'91%',
		title:'',
		idField:'detail_id',
		singleSelect:true,
		url:'../batch/data/batch.records.retrieve.php',
		loadMsg:'',
		pagination:true,
		pageSize:20,
		pageList:[20,50,100],
		rownumbers:true,
		onLoadSuccess:removeLoader,
		columns:[[
		          {title:CODE_REPORT,field:'all_code',  width: '18%', align: 'left',halign: 'center',sortable:true,
		        	  formatter:function(value,rowData,rowIndex){
		        		  return value;
		        	  }
		          },
		          {title:TRANSACTION_CODE_REPORT,field:'transaction_code',  width: '9%', align: 'left',halign: 'center',sortable:true },
		          {title:BATCH_CODE_REPORT,field:'batch_code',  width: '9%', align: 'left',halign: 'center',sortable:true },
		          {title:BATCH_AMOUNT,field:'amount',  width: '11%', align: 'right',halign: 'center',sortable:true ,
		        	  formatter:function(value,rowData,rowIndex){
		        		var amount = parseFloat(value);
		        		if(parseInt(amount) === amount){
		        			amount = amount+'.00';
		        		}
	        	  	 	if(value != null){
						    var parts = amount.toString().split(".");
						    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
						    return parts.join(".");
						}else{
							return amount;
						}
					 }
			      },
		          {title:BATCH_DESC,field:'detail_desc',  width: '30%', align: 'left',halign: 'center',sortable:true },
		          {title:PO_CREATE_DATE,field:'detail_record_date',  width: '17%', align: 'center',halign: 'center',sortable:true }
          ]]
      });
})

/*重新加载表格*/
function reloadgrid(){
	$("#itemList").datagrid('reload',getParams());
 }

/*重置*/
function clearFunction(){
	$('#recordsForm').form('clear');
}

function createName(type) {
	$.messager.prompt(BASIC_CONFIRM, DETAIL_LIST_1, function(confirm) {
		if (confirm) {
			var viewId = $('#view').combobox('getValue');
			var currencyStart = $("#currencyStart").val();
			var currencyEnd = $("#currencyEnd").val();
			var regionStart = $("#regionStart").val();
			var regionEnd = $("#regionEnd").val();
			var mainStart = $("#mainStart").val();
			var mainEnd = $("#mainEnd").val();
			var subStart = $("#subStart").val();
			var subEnd = $("#subEnd").val();
			var sceneStart = $("#sceneStart").val();
			var sceneEnd = $("#sceneEnd").val();
			var f1Start = $("#f1Start").val();
			var f1End = $("#f1End").val();
			var f2Start = $("#f2Start").val();
			var f2End = $("#f2End").val();
			var f3Start = $("#f3Start").val();
			var f3End = $("#f3End").val();
			var transactionCodeStart = $("#transactionCodeStart").val();
			var transactionCodeEnd = $("#transactionCodeEnd").val();
			var batchCode = $("#batchCode").val();
			var desc = $("#desc").val();
			var startDate = formatEnDate($('#startDate').datebox('getValue'));
			var endDate = formatEnDate($('#endDate').datebox('getValue'));
			var isAsset = $('#isAssets').combobox('getValue');
			var sortName = $('#itemList').datagrid('options')['sortName'];
			var sortOrder = $('#itemList').datagrid('options')['sortOrder'];
			if (type == 1) {
				window.open("data/report.pdf.php?report_type=4&start_date="+startDate+"&end_date="+endDate+"&currency_start="+currencyStart+"&currency_end="+currencyEnd+"&region_start="+regionStart+"&region_end="+regionEnd+"&main_start="+mainStart+"&main_end="+mainEnd+"&sub_start="+subStart+"&sub_end="+subEnd+"&scene_start="+sceneStart+"&scene_end="+sceneEnd+"&f1_start="+f1Start+"&f1_end="+f1End+"&f2_start="+f2Start+"&f2_end="+f2End+"&f3_start="+f3Start+"&f3_end="+f3End+"&transaction_start="+transactionCodeStart+"&transaction_end="+transactionCodeEnd+"&batch_code="+batchCode+"&detail_desc="+desc+"&is_asset="+isAsset+"&sort="+sortName+"&order="+sortOrder+"&view_id="+viewId+"&pname="+confirm, "_blank");
			} else {
				window.open("data/report.excel.php?report_type=4&start_date="+startDate+"&end_date="+endDate+"&currency_start="+currencyStart+"&currency_end="+currencyEnd+"&region_start="+regionStart+"&region_end="+regionEnd+"&main_start="+mainStart+"&main_end="+mainEnd+"&sub_start="+subStart+"&sub_end="+subEnd+"&scene_start="+sceneStart+"&scene_end="+sceneEnd+"&f1_start="+f1Start+"&f1_end="+f1End+"&f2_start="+f2Start+"&f2_end="+f2End+"&f3_start="+f3Start+"&f3_end="+f3End+"&transaction_start="+transactionCodeStart+"&transaction_end="+transactionCodeEnd+"&batch_code="+batchCode+"&detail_desc="+desc+"&is_asset="+isAsset+"&sort="+sortName+"&order="+sortOrder+"&view_id="+viewId+"&pname="+confirm, "_blank");
			}
		} else {
			return null;
		}
	});
}

/*导出pdf*/
function pdfFunction() {
	createName(1);
}

/*导出Excel*/
function ExcleFunction(){
	createName(2);
}

/*快速输入*/
function moveNext(object,index){
    if(index == 0){
    	if(object.value.length == 2){  
    		$("#regionStart").focus();
    	}
    }else if(index == 1){
    	if(object.value.length == 3){  
    		$("#mainStart").focus();
    	}
    }else if(index == 2){
    	if(object.value.length == 4){  
    		$("#subStart").focus();
    	}
    }else if(index == 3){
    	if(object.value.length == 3){  
    		$("#sceneStart").focus();
    	}
    }else if(index == 4){
    	if(object.value.length == 3){  
    		$("#f1Start").focus();
    	}
    }else if(index == 5){
    	if(object.value.length == 2){  
    		$("#f2Start").focus();
    	}
    }else if(index == 6){
    	if(object.value.length == 2){  
    		$("#f3Start").focus();
    	}
    }else if(index == 7){
		if(object.value.length == 2){  
			$("#f3Start").blur();
		}
	}
}

/*快速输入结束*/
function moveNextEnd(object,index){
    if(index == 0){
    	if(object.value.length == 2){  
    		$("#regionEnd").focus();
    	}
    }else if(index == 1){
    	if(object.value.length == 3){  
    		$("#mainEnd").focus();
    	}
    }else if(index == 2){
    	if(object.value.length == 4){  
    		$("#subEnd").focus();
    	}
    }else if(index == 3){
    	if(object.value.length == 3){  
    		$("#sceneEnd").focus();
    	}
    }else if(index == 4){
    	if(object.value.length == 3){  
    		$("#f1End").focus();
    	}
    }else if(index == 5){
    	if(object.value.length == 2){  
    		$("#f2End").focus();
    	}
    }else if(index == 6){
    	if(object.value.length == 2){  
    		$("#f3End").focus();
    	}
    }else if(index == 7){
		if(object.value.length == 2){  
			$("#f3End").blur();
		}
	}
}

//获取标签
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

/*获取高度*/
function getGridHeight(){
	var height1 = $("#_title").height();
	var height2 = $("#_query").height() ;
	var height = document.compatMode=="CSS1Compat"?document.documentElement.clientHeight:document.body.clientHeight;
	return height - height2 - height1 - 100;
}
