var needUpdate = false;
var enableSubmit = false;
var appendCheckNum = true;
var appendCheckSub = true;
var projectId = $("#projectId").val();
var userId = $("#userId").val();
var batchId;
var checkBatchId;
var currencyId;
var currencyValue;
var currencyText;
var projectId = $("#projectId").val();
var language = $("#language").val();
var showList = $("#showList").val();
var checkStatus;
var isHistory = $("#isHistory").val();
$("#pName").html(currentProjectName+">");

if(showList == 1){
	document.getElementById('batchCodeDiv').style.display = "block";
}

function textKeyup(index) {
	var editors = $('#transactionDetailList').datagrid('getEditors', index);
	var len = editors.length;

	// 地区码
	var editor = editors[0];
	$(editor.target).textbox('textbox').keyup(function (e) {		
		var value = $(editor.target).textbox('getText');
		if (value != null && value.length >= 3) {
			$(editors[1].target).textbox('textbox').focus();
		}
	});
	$(editor.target).textbox('textbox').focus(function (e) {
		if (index > 0) {
			var lastEditors = $('#transactionDetailList').datagrid('getEditors', index - 1);
			var lastEditor = lastEditors[0];
			var lastText = $(lastEditor.target).textbox('getText');
			var curText = $(editor.target).textbox('getText');
			if (lastText != null && (curText == null || curText == "")) {
				$(editor.target).textbox('setText', lastText);
			}
		}
	});
	
	// 主码
	var editor1 = editors[1];
	$(editor1.target).textbox('textbox').keyup(function (e) {		
		var value = $(editor1.target).textbox('getText');
		$(editor1.target).textbox("textbox").css("color", "black");
		if (value != null && value.length >= 4) {
			$(editors[2].target).textbox('textbox').focus();
		}
	});
	
	// 子码
	var editor2 = editors[2];
	$(editor2.target).textbox('textbox').keyup(function (e) {		
		var value = $(editor2.target).textbox('getText');
		$(editor2.target).textbox("textbox").css("color", "black");
		if (value != null && value.length >= 3) {
			$(editors[3].target).textbox('textbox').focus();
		}
	});

	// 场景号
	var editor3 = editors[3];
	var val3 = $(editor3.target).textbox('getText');
//	if(val3 == null || val3 == ""){
//		$(editor3.target).textbox('setText', '000');
//	}
	$(editor3.target).textbox('textbox').keyup(function (e) {		
		var value = $(editor3.target).textbox('getText');
		if (value != null && value.length >= 3) {
			$(editors[4].target).textbox('textbox').focus();
		}
	});
	
	// F1
	var editor4 = editors[4];
	var val4 = $(editor4.target).textbox('getText');
//	if(val4 == null || val4 == ""){
//		$(editor4.target).textbox('setText', '00');
//	}
	$(editor4.target).textbox('textbox').keyup(function (e) {		
		var value = $(editor4.target).textbox('getText');
		if (value != null && value.length >= 2) {
			$(editors[5].target).textbox('textbox').focus();
		}
	});
	
	// F2 
	var editor5 = editors[5];
	var val5 = $(editor5.target).textbox('getText');
//	if(val5 == null || val5 == ""){
//		$(editor5.target).textbox('setText', '00');
//	}
	$(editor5.target).textbox('textbox').keyup(function (e) {		
		var value = $(editor5.target).textbox('getText');
		if (value != null && value.length >= 2) {
			$(editors[6].target).textbox('textbox').focus();
		}
	});
	
  // F3 
	var editor6 = editors[6];
	var val6 = $(editor6.target).textbox('getText');
//	if(val6 == null || val6 == ""){
//		$(editor6.target).textbox('setText', '00');
//	}
	$(editor6.target).textbox('textbox').keyup(function (e) {		
		var value = $(editor6.target).textbox('getText');
		if (value != null && value.length >= 2) {
			$(editors[7].target).textbox('textbox').focus();
		}
	});
	
	//金额
//	var total = 0;
//	var totalValue = 0;
//	var editor7 = editors[7];
//	$(editor7.target).textbox('textbox').keyup(function (e) {		
//		var value = $(editor7.target).textbox('getText');
//		var rows = $('#transactionDetailList').datagrid('getRows');
//		total = 0;
//		for(var i = 0; i < rows.length; i++){
//			var row = $('#transactionDetailList').datagrid('getEditors' , i);
//			if(row[0] != null){
//				totalValue = $(row[7].target).textbox('getText');
//				total = total+Number(totalValue);
//			}
//		}
//		if(rDecimal.test(total)){
//			total = total;
//		}else{
//			total = total+'.00';
//		}
//		var parts = total.toString().split(".");
//	    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
//	    total = parts.join(".");
//		$("#totalAmount").html(total);
//	});
	
	// 复制上一行的描述
	var editor8 = editors[8];
	$(editor8.target).textbox('textbox').focus(function (e) {
		if (index > 0) {
			var lastEditors = $('#transactionDetailList').datagrid('getEditors', index - 1);
			var lastEditor = lastEditors[8];
			var lastText = $(lastEditor.target).textbox('getText');
			var curText = $(editor8.target).textbox('getText');
			if (lastText != null && (curText == null || curText == "")) {
				$(editor8.target).textbox('setText', lastText);
			}
		}
	});
}

/*基础值*/
function showBatch(code,id,currency_id,currency_code,currency_type){
	batchId = id;
	currencyId = currency_id;
	currencyValue = currency_code;
	$("#showBatchCode").html("—"+code);
//	$("#transactionCode").val("");
	$('#transactionDetailList').datagrid('loadData', { total: 0, rows: [] });
	$("#batchInput").hide();
	$("#createBatchButton").hide();
	$("#addBatchButton").show();
	$("#batchSpan").show();
	$("#batchSpan").html(code);
	$("#currencySpan").html(currency_type);
	document.getElementById('currencyIdLi').style.display = "none";
	document.getElementById('currencySpanLi').style.display = "block";
	$("#showBatchCode").show();
	$("#createTransactionLi").show();
	$("#createTransactionButton").show();
	$("#updateCurrencyButton").show();
	$("#batch_title").html(LOCATION_BATCH+"<span style='font-size: 20px;'>"+currentProjectName+"></span>"+UPDATE_TITLE_PO);
	$("#confirmDetailDiv").hide();
	$("#deleteDetailDiv").hide();
	$("#subDiv").empty();
	$("#numDiv").empty();
	$("#numA").show();
	$("#subA").show();
	var isExpand = document.getElementById('expand'+code).style.display;
	if(isExpand == 'none'){
		$("#list"+id).datagrid('options')['url'] = 'data/transaction.retrieve.php?batch_ids='+id;
		$("#list"+id).datagrid('reload');
		$("#expand"+code).show();
	}else{
		$("#expand"+code).hide();
	}
}

/*多条批处理*/
function allBatch(){
	$("#batchCodeDiv").empty();
	var batchData = "";
	if(projectId != undefined){
		$.ajax({
			url: "data/batch.retrieve.php?project_ids="+projectId+"&status=1",
			type: 'get',
			async: false,
			dataTye: 'json',
			success: function (data) {
				batchData = eval('(' + data + ')');
			}
		})
		for (var i = 0; i < batchData.total; i++) {
			if(i != batchData.total-1){
				$("#batchCodeDiv").append("<a href='javascript:void(0)' onclick='showBatch(\""+batchData.rows[i].batch_code+"\","+batchData.rows[i].batch_id+","+batchData.rows[i].currency_id+",\""+batchData.rows[i].currency_code+"\",\""+batchData.rows[i].currency_type+"\")'><div style='text-align:center;border-top:1px solid #BFBFBF;border-left:1px solid #BFBFBF;border-right:1px solid #BFBFBF;font-size:15px;'>"+BATCH_NAME+batchData.rows[i].batch_code+"</div></a><div id='expand"+batchData.rows[i].batch_code+"' style='display: none;'><div style='width:239px;' id='list"+batchData.rows[i].batch_id+"'></div></a><div class='pcl_left_nav_button'><ul><li><a href='javascript:void(0)' onclick='submitBatch("+batchData.rows[i].batch_id+","+batchData.rows[i].currency_id+")'><span>"+BATCH_SUBMIT+"</span></li></ul></div><div class='pcl_left_nav_button'><ul><li><a href='javascript:void(0)' onclick='deleteBatch("+batchData.rows[i].batch_id+")'><span>"+BATCH_DELETE+"</span></a></li></ul></div><br><br><br></div>");
			}else{
				$("#batchCodeDiv").append("<a href='javascript:void(0)' onclick='showBatch(\""+batchData.rows[i].batch_code+"\","+batchData.rows[i].batch_id+","+batchData.rows[i].currency_id+",\""+batchData.rows[i].currency_code+"\",\""+batchData.rows[i].currency_type+"\")'><div style='text-align:center;border:1px solid #BFBFBF;font-size:15px;'>"+BATCH_NAME+batchData.rows[i].batch_code+"</div></a><div id='expand"+batchData.rows[i].batch_code+"' style='display: none;'><div style='width:239px;' id='list"+batchData.rows[i].batch_id+"'></div></a><div class='pcl_left_nav_button'><ul><li><a href='javascript:void(0)' onclick='submitBatch("+batchData.rows[i].batch_id+","+batchData.rows[i].currency_id+")'><span>"+BATCH_SUBMIT+"</span></li></ul></div><div class='pcl_left_nav_button'><ul><li><a href='javascript:void(0)' onclick='deleteBatch("+batchData.rows[i].batch_id+")'><span>"+BATCH_DELETE+"</span></a></li></ul></div><br><br><br></div>");
			}
			$("#list"+batchData.rows[i].batch_id).datagrid({
				autoHeight:true,
//				title:BATCH_NAME+batchData.rows[i].batch_code,
				idField:'batch_id',
				singleSelect:true,
				fitColumns:false,
				showHeader:false,
//				collapsible:true,
//			    collapsed:true,
				url:'data/transaction.retrieve.php?batch_ids='+batchData.rows[i].batch_id,
				onClickRow : function(index, row){
					showDetail(row.batch_id,row.transaction_id,row.transaction_code,row.total_amount);
				},
				columns:[[
				          {title:TRANSACTION_CODE,field:'transaction_code',width:237,align:'center'}
				          ]]
			});
		}
	}
}

$(function(){
	batchId = $("#poHistoryId").val();
	var poHistoryCode = $("#poHistoryCode").val();
	currencyText = $("#poHistoryCurrencyType").val();
	currencyValue = $("#poHistoryCurrencyCode").val();
	$("#transactionList").datagrid({
		autoHeight:true,
		title:BATCH_NAME+poHistoryCode,
		idField:'transaction_id',
		singleSelect:true,
		fitColumns:false,
		showHeader:false,
		url:'',
		onClickRow : function(index, row){
			showDetail(row.batch_id,row.transaction_id,row.transaction_code,row.total_amount);
		},
		columns:[[
		          {title:TRANSACTION_CODE,field:'transaction_code',width:237,align:'center'}
		]]
	});
	
	if(batchId != null && batchId != ""){
		$('#transactionList').datagrid('options')['url'] = 'data/transaction.retrieve.php?batch_ids='+batchId;
		$("#transactionList").datagrid('load');
		$("#batchSpan").html(poHistoryCode);
    	$("#batchCode").html(poHistoryCode);
    	$("#currencySpan").html(currencyText);
    	document.getElementById('createTransactionLi').style.display = "block";
    	document.getElementById('createTransactionButton').style.display = "block";
    	$("#batchInput").hide();
    	$("#batchSpan").show();
    	$("#createBatchButton").hide();
    	document.getElementById('currencyIdLi').style.display = "none";
    	document.getElementById('currencySpanLi').style.display = "block";
        $("#subA").show();
        $("#numA").show();
	}else{
		allBatch();
	}
	
	var datagrid; //定义全局变量datagrid
    var editRow = undefined; //定义全局变量：当前编辑的行
    datagrid = $("#transactionDetailList").datagrid({
    	autoHeight:true,
		width:'100%',
		title:'',
		idField:'detail_id',
		singleSelect:true,
		url:'',
  	    onBeforeEdit:function(rowIndex,rowData){
  	    	if($('#transactionDetailList').datagrid('getRows')[rowIndex].a == "1"){
  	    		return;
  	    	}else{
  	    		$('#transactionDetailList').datagrid('appendRow', {});
  	    	}
	    },
		columns:[[
		          {title:BATCH_CURRENCY,field:'project_currency_id',  width: '8%', align: 'left',halign: 'center',
					  formatter:function(value,rowData,rowIndex){
						  return currencyValue;
					  }
		          },
		          {title:BATCH_REGION,field:'region_code',  width: '6%', align: 'left',halign: 'center',
		        	  editor: { type: 'textbox', options: {height:g_editor_cell_height}}
		          },
		          {title:BATCH_MAIN_CODE,field:'main_code',  width: '5%', align: 'left',halign: 'center',
		        	  editor: { type: 'textbox', options: {height:g_editor_cell_height}}
		          },
		          {title:BATCH_SUB_CODE,field:'sub_code',  width: '5%', align: 'left',halign: 'center',
		        	  editor: { type: 'textbox', options: {height:g_editor_cell_height}}
		          },
		          {title:BATCH_SCENE,field:'scene_code',  width: '6%', align: 'left',halign: 'center',
		        	  editor: { type: 'textbox', options: {height:g_editor_cell_height}}
		          },
		          {title:'F1',field:'free_code1',  width: '6%', align: 'left',halign: 'center',
		        	  editor: { type: 'textbox', options: {height:g_editor_cell_height}}
		          },
		          {title:'F2',field:'free_code2',  width: '6%', align: 'left',halign: 'center',
		        	  editor: { type: 'textbox', options: {height:g_editor_cell_height}}
		          },
		          {title:'F3',field:'free_code3',  width: '6%', align: 'left',halign: 'center',
		        	  editor: { type: 'textbox', options: {height:g_editor_cell_height}}
		          },
		          {title:BATCH_ASSET,field:'is_asset',  width: '5%', align: 'center',halign: 'center',
		        	  formatter:function(value,rowData,rowIndex){
		        		 if(value == 0 || value == "" || value == null){
		        			 return "<input name='asset"+rowIndex+"' type='checkbox' value='1' onclick='assetClick("+rowIndex+")'>";
		        		 }else{
		        			 return "<input name='asset"+rowIndex+"' type='checkbox' value='1' checked onclick='assetClick("+rowIndex+")'>";
		        		 }
					  }
		          },
		          {title:BATCH_AMOUNT,field:'amount',  width: '12%', align: 'right',halign: 'center',
		        	  editor: { type: 'textbox', options: {height:g_editor_cell_height}}, 
		        	  formatter:function(value,rowData,rowIndex){
	        	  	 	if(value != null){
						    var parts = value.toString().split(".");
						    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
						    return parts.join(".");
						}else{
							return value;
						}
					 },
		          },
		          {title:BATCH_DESC,field:'detail_desc',  width: '37%', align: 'left',halign: 'center',
		        	  editor: { type: 'textbox', options: {height:g_editor_cell_height}}
		          }
          ]],
          onAfterEdit: function (rowIndex, rowData, changes) {
              editRow = undefined;
          },
          onClickCell: function (rowIndex, rowData) {
          	//单击开启编辑行
              datagrid.datagrid("beginEdit", rowIndex);
              $('#transactionDetailList').datagrid('getRows')[rowIndex].a = "1";
              editRow = rowIndex;
              textKeyup(rowIndex);
          }
      });
    
	$("#currencyId").combobox({
		url:'../basic/data/currency.retrieve.all.php?project_ids='+projectId,    
	    valueField:"record_id",    
	    textField:"currency_type"
	});
	
	$.extend($.fn.validatebox.defaults.rules, {
		repeat: {
				validator: function(value){
	   				var isExist = false;
	   					$.ajaxSetup({async : false}); 
	   					$.post('data/batch.isrepeat.php',{batch_codes:value,project_ids:projectId},function(data){
	   						var data = eval('(' + data + ')');
	   						if(data.result == 10004){
	   							isExist = false;
	   						}else if(data.result == 10000){
	   							isExist = true;
	   						}
	   					});
	   				return isExist;
				},
   			message: BATCH_MESSAGE1
   		},
		repeatCode: {
			validator: function(value){
   				var isExist = false;
   					$.ajaxSetup({async : false}); 
   					$.post('data/transaction.isrepeat.php',{transaction_codes:value,batch_ids:batchId},function(data){
   						var data = eval('(' + data + ')');
   						if(data.result == 10004){
   							isExist = false;
   						}else if(data.result == 10000){
   							isExist = true;
   						}
   					});
   				return isExist;
			},
			message: BATCH_MESSAGE2
		}
   });
	
})

/*创建批处理*/
function createBatch(){
	var isValid = $("#batchInput").validatebox('isValid');
	var batchCode = $("#batchInput").val();
	currencyId = $("#currencyId").combobox('getValue');
	$.ajax({
		url: "../basic/data/currency.retrieve.php?record_ids="+currencyId+"&project_ids="+projectId,
		type: 'get',
		async: false,
		dataTye: 'json',
		success: function (data) {
			data = eval('(' + data + ')');
			currencyValue = data.rows[0].currency_code;
			currencyText = data.rows[0].currency_type;
		}
	})
	if(batchCode == null || currencyId == null || batchCode == "" || currencyId == ""){
		$.messager.alert(BASSIC_MESSAGE , BATCH_MESSAGE3);
		return;
	}
	if(!isValid){
		$.messager.alert(BASSIC_MESSAGE , BATCH_MESSAGE1);
		return;
	}
	var url = 'data/batch.create.php';
	$.post(url, {batch_code : batchCode , status : 1 , project_id : projectId , currency_id : currencyId},function(data){
		var data = eval("(" + data + ")");
    	$("#subDiv").empty();
    	$("#numDiv").empty();
    	$("#detailListDiv").show();
    	$("#examSubjectDiv").hide();
    	$("#examNumberDiv").hide();
    	$("#numA").hide();
    	$("#subA").hide();
		if (data.msg.result == RESULT_CODE_SUCCESS) {
			$.messager.alert(BASSIC_MESSAGE, BASSIC_SUCCESSFUL_OPERATION);
			batchId = data.id;
	    	$("#currencySpan").html(currencyValue);
	    	document.getElementById('createTransactionLi').style.display = "block";
	    	document.getElementById('confirmDetailDiv').style.display = "block";
	    	document.getElementById('deleteDetailDiv').style.display = "block";
	    	document.getElementById('batchCodeDiv').style.display = "block";
	    	allBatch();
	    	$("#transactionCode").val("");
	    	$('#transactionDetailList').datagrid('loadData', { total: 0, rows: [] });
	    	$("#batchInput").hide();
	    	$("#createBatchButton").hide();
	    	$("#addBatchButton").show();
	    	$("#updateCurrencyButton").show();
	    	$("#batchSpan").html(batchCode);
	    	$("#batchSpan").show();
	    	$("#currencySpan").html(currencyText);
	    	document.getElementById('currencyIdLi').style.display = "none";
	    	document.getElementById('currencySpanLi').style.display = "block";
		} else {
			checkResult(data);
		}
	});
	$('#transactionDetailList').datagrid('appendRow', {});
}

/*新增批处理*/
function addBatch(){
	needUpdate = false;
	$("#hide").show();
	$("#batchInput").show();
	$("#batchInput").val("");
	$("#createBatchButton").show();
	$("#addBatchButton").hide();
	$("#updateCurrencyButton").hide();
	$("#batchSpan").hide();
	$("#numA").hide();
	$("#subA").hide();
	$("#showBatchCode").hide();
	$("#createTransactionButton").hide();
	$("#confirmDetailDiv").hide();
	$("#deleteDetailDiv").hide();
	$("#subDiv").empty();
	$("#numDiv").empty();
	$("#detailListDiv").show();
	$("#examSubjectDiv").hide();
	$("#examNumberDiv").hide();
	$("#batch_title").html(LOCATION_BATCH+"<span style='font-size: 20px;'>"+currentProjectName+"></span>"+ADD_TITLE_PO);
	$("#transactionCode").val("");
	$('#transactionDetailList').datagrid('loadData', { total: 0, rows: [] });
	$("#currencyId").combobox('setValue',"");
	document.getElementById('currencyIdLi').style.display = "block";
	document.getElementById('currencySpanLi').style.display = "none";
}

/*修改货币*/
function updateCurrency(){
	$("#updateCurrencyId").combobox({
		url:'../basic/data/currency.retrieve.all.php?project_ids='+projectId,    
		valueField:"record_id",    
		textField:"currency_type"
	});
	$("#updateCurrencyForm").form('clear');
	$("#updateBatchId").val(batchId);
	$("#updateCurrencyDialog").dialog('open');
	$("#updateCurrencyId").combobox('setValue',currencyId);
}

/*保存修改货币*/
function submitupdateCurrencyForm(){
	var pwd = trim($("#userPassword").val());
	if(pwd == "" || pwd == null){
		$.messager.alert(BASSIC_MESSAGE , BATCH_MESSAGE19);
		return;
	}
	var updateCurrencyId = $("#updateCurrencyId").combobox("getValue");
	var updateCurrencyText = $("#updateCurrencyId").combobox("getText");
	$.ajax({
		url: "../sys/data/user.retrieve.php?userId="+userId+"&pwd="+pwd,
		type: 'get',
		async: false,
		dataTye: 'json',
		success: function (data) {
			var data = eval('(' + data + ')');
			if(data.total < 1){
				$.messager.alert(BASSIC_MESSAGE , BATCH_MESSAGE19);
				return;
			}else{
				$.messager.confirm(BASSIC_SET_MESSAGE,CONFIRM_UPDATE_CURRENCY,function(r){
					if(r){
						$.ajax({
							url: "data/batch.update.php?batch_id="+batchId+"&currency_id="+updateCurrencyId,
							type: 'post',
							async: false,
							dataTye: 'json',
							success: function (data) {
								var data1 = eval('(' + data + ')');
								if(data1.result == 10000){
									$("#updateCurrencyDialog").dialog('close');
									allBatch();
									currencyId = updateCurrencyId;
									$.ajax({
										url: "../basic/data/currency.retrieve.php?record_ids="+currencyId+"&project_ids="+projectId,
										type: 'get',
										async: false,
										dataTye: 'json',
										success: function (bbb) {
											var data2 = eval('(' + bbb + ')');
											currencyValue = data2.rows[0].currency_code;
											currencyText = data2.rows[0].currency_type;
										}
									})
									$("#batchSpan").show();
									$("#currencySpan").html(updateCurrencyText);
									$("#transactionDetailList").datagrid('reload');
									$.messager.alert(BASSIC_MESSAGE , data1.msg);
								}else{
									$.messager.alert(BASSIC_MESSAGE , data1.msg);
								}
							}
						})
					}
				})
			}
		}
	})
}

/*提交批处理*/
function submitBatch(id){
	checkBatchId = id;
	checkStatus = 1;
	$("#checkPwdDialog").form('clear');
	$("#checkPwdDialog").dialog('open');
}

/*删除批处理*/
function deleteBatch(id){
	checkBatchId = id;
	checkStatus = 2;
	$("#checkPwdDialog").form('clear');
	$("#checkPwdDialog").dialog('open');
}

/*密码检查*/
function checkPwd(){
	var pwd = $("#checkPassword").val();
	$.ajax({
		url: "../sys/data/user.retrieve.php?userId="+userId+"&pwd="+pwd,
		type: 'get',
		async: false,
		dataTye: 'json',
		success: function (data) {
			data = eval('(' + data + ')');
			if(data.total < 1){
				$.messager.alert(BASSIC_MESSAGE , BATCH_MESSAGE19);
				return;
			}else if(checkStatus == 1){
				$("#checkPwdDialog").dialog('close');
			    $.messager.confirm(BATCH_CONFIRM , BATCH_MESSAGE5,function(confirm){
			        if (confirm){
			        	$.post('data/batch.update.php',{batch_id : checkBatchId , status : 2},function(data){
			        		var data = eval('(' + data + ")");
			        		if (data.result == RESULT_CODE_SUCCESS) {
			        			$.messager.alert(BASSIC_MESSAGE, BASSIC_SUCCESSFUL_OPERATION);
			        			allBatch();
			        			addBatch();
			        		} else {
			        			checkResult(data);
			        		}
			        	});
			        }
			    });
			}else if(checkStatus == 2){
				$("#checkPwdDialog").dialog('close');
			    $.messager.confirm(BATCH_CONFIRM , BATCH_MESSAGE5,function(confirm){
			        if (confirm){
			        	$.post('data/batch.delete.php',{batch_id : checkBatchId},function(data){
			        		var data = eval('(' + data + ")");
			        		if (data.result == RESULT_CODE_SUCCESS) {
			        			$.messager.alert(BASSIC_MESSAGE, BASSIC_SUCCESSFUL_OPERATION);
			        			allBatch();
			        			addBatch();
			        		} else {
			        			checkResult(data);
			        		}
			        	});
			        }
			    });
			}
		}
	})
}

/*新增交易*/
function createTransaction(){
	$("#subDiv").empty();
	$("#numDiv").empty();
	$("#numA").show();
	$("#subA").show();
	$("#detailListDiv").show();
	$("#confirmDetailDiv").show();
	$("#deleteDetailDiv").show();
	$("#examSubjectDiv").hide();
	$("#examNumberDiv").hide();
	$.extend($.fn.validatebox.defaults.rules, {
   		repeatCode: {
			validator: function(value){
   				var isExist = false;
   					$.ajaxSetup({async : false}); 
   					$.post('data/transaction.isrepeat.php',{transaction_codes:value,batch_ids:batchId},function(data){
   						var data = eval('(' + data + ')');
   						if(data.result == 10004){
   							isExist = false;
   						}else if(data.result == 10000){
   							isExist = true;
   						}
   					});
   				return isExist;
			},
			message: BATCH_MESSAGE2
		}
	});
	needUpdate = false;
	$("#transactionCode").val("");
	$('#transactionDetailList').datagrid('loadData', { total: 0, rows: [] });
	document.getElementById('createTransactionButton').style.display = "none";
	document.getElementById('confirmDetailDiv').style.display = "block";
	document.getElementById('deleteDetailDiv').style.display = "block";
	$.extend($.fn.validatebox.defaults.rules, {
		repeatCode: {
				validator: function(value){
	   				var isExist = false;
	   					$.ajaxSetup({async : false}); 
	   					$.post('data/transaction.isrepeat.php',{transaction_codes:value,batch_ids:batchId},function(data){
	   						var data = eval('(' + data + ')');
	   						if(data.result == 10004){
	   							isExist = false;
	   						}else if(data.result == 10000){
	   							isExist = true;
	   						}
	   					});
	   				return isExist;
				},
   			message: BATCH_MESSAGE2
   		}
   });
   $('#transactionDetailList').datagrid('appendRow', {});
}

//判断对象是否为空
function isEmptyObject(obj) {
	for (var key in obj) {
		return false;
	}
	  return true;
}

/*确定*/
function confirmDetail(){
	var transactionCode = $("#transactionCode").val();

	if(transactionCode == null || transactionCode == ""){
		$.messager.alert(BASSIC_MESSAGE , BATCH_MESSAGE6);
		return;
	}
	
	$("#transactionDetailList").datagrid("acceptChanges");
	
	var rows = $('#transactionDetailList').datagrid('getRows');
	
	var amount = 0;
	var delId = [];
	for (var i = 0; i < rows.length; i++) {
		if(isEmptyObject(rows[i])){
			delId.push(i);
		}else{
			if(trim(rows[i].region_code) == null || trim(rows[i].region_code) == "" || trim(rows[i].main_code) == null || trim(rows[i].main_code) == "" || trim(rows[i].sub_code) == null || trim(rows[i].sub_code) == "" || trim(rows[i].scene_code) == null || trim(rows[i].scene_code) == "" || trim(rows[i].free_code1) == null || trim(rows[i].free_code1) == "" || trim(rows[i].free_code2) == null || trim(rows[i].free_code2) == "" || trim(rows[i].free_code3) == null || trim(rows[i].free_code3) == "" || trim(rows[i].amount) == null || trim(rows[i].amount) == "" || trim(rows[i].detail_desc) == null || trim(rows[i].detail_desc) == ""){
				$.messager.alert(BASSIC_MESSAGE , BASSIC_NULL_MESSAGE);
				$("#transactionDetailList").datagrid("beginEdit", i);
				textKeyup(i);
				return;
			}
			if(isNaN(rows[i].region_code)){
				$.messager.alert(BASSIC_MESSAGE , BATCH_MESSAGE7);
				$("#transactionDetailList").datagrid("beginEdit", i);
				textKeyup(i);
				return;
			}
			if(isNaN(rows[i].main_code)){
				$.messager.alert(BASSIC_MESSAGE , BATCH_MESSAGE7);
				$("#transactionDetailList").datagrid("beginEdit", i);
				textKeyup(i);
				return;
			}
			if(isNaN(rows[i].sub_code)){
				$.messager.alert(BASSIC_MESSAGE , BATCH_MESSAGE7);
				$("#transactionDetailList").datagrid("beginEdit", i);
				textKeyup(i);
				return;
			}
			if(isNaN(rows[i].scene_code)){
				$.messager.alert(BASSIC_MESSAGE , BATCH_MESSAGE7);
				$("#transactionDetailList").datagrid("beginEdit", i);
				textKeyup(i);
				return;
			}
//			if(isNaN(rows[i].free_code1)){
//				$.messager.alert(BASSIC_MESSAGE , BATCH_MESSAGE7);
//				$("#transactionDetailList").datagrid("beginEdit", i);
//				textKeyup(i);
//				return;
//			}
//			if(isNaN(rows[i].free_code2)){
//				$.messager.alert(BASSIC_MESSAGE , BATCH_MESSAGE7);
//				$("#transactionDetailList").datagrid("beginEdit", i);
//				textKeyup(i);
//				return;
//			}
//			if(isNaN(rows[i].free_code3)){
//				$.messager.alert(BASSIC_MESSAGE , BATCH_MESSAGE7);
//				$("#transactionDetailList").datagrid("beginEdit", i);
//				textKeyup(i);
//				return;
//			}
			if(isNaN(rows[i].amount)){
				$.messager.alert(BASSIC_MESSAGE , BATCH_MESSAGE7);
				$("#transactionDetailList").datagrid("beginEdit", i);
				textKeyup(i);
				return;
			}
			
			if($('#transactionDetailList').datagrid('getRows')[i].is_asset == "1"){
				rows[i].is_asset = "1";
			}else{
				rows[i].is_asset = "0";
			}
			
			var data = "";
			var isrepeat = false;
			//编码
			$.ajax({
				url: "../basic/data/code.retrieve.php?main_codes="+rows[i].main_code+"&sub_codes="+rows[i].sub_code+"&project_ids="+projectId,
				type: 'get',
				async: false,
				dataTye: 'json',
				success: function (data) {
					data = eval('(' + data + ')');
					if(data.total < 1){
						isrepeat = true;
					}else{
						rows[i].code_id = data.rows[0].record_id;
					}
				}
			})
		    if(isrepeat){
				$.messager.alert(BASSIC_MESSAGE , BATCH_MESSAGE8);
				$("#transactionDetailList").datagrid("beginEdit", i);
				var edit = $('#transactionDetailList').datagrid('getEditors', i);
				$(edit[1].target).textbox("textbox").css("color", "red");
				$(edit[2].target).textbox("textbox").css("color", "red");
				textKeyup(i);
				isrepeat = false;
				return;
		    }
			
			//地区
			$.ajax({
				url: "../basic/data/region.retrieve.php?region_codes="+rows[i].region_code+"&project_ids="+projectId,
				type: 'get',
				async: false,
				dataTye: 'json',
				success: function (data) {
					data = eval('(' + data + ')');
					if(data.total < 1){
						isrepeat = true;
					}else{
						rows[i].project_region_id = data.rows[0].record_id;
					}
				}
			})
		    if(isrepeat){
				$.messager.alert(BASSIC_MESSAGE , BATCH_MESSAGE14);
				$("#transactionDetailList").datagrid("beginEdit", i);
				textKeyup(i);
				isrepeat = false;
				return;
		    }
			
			//场景
			$.ajax({
				url: "../basic/data/scene.retrieve.php?scene_codes="+rows[i].scene_code+"&project_ids="+projectId,
				type: 'get',
				async: false,
				dataTye: 'json',
				success: function (data) {
					data = eval('(' + data + ')');
					if(data.total < 1){
						isrepeat = true;
					}else{
						rows[i].project_scene_id = data.rows[0].record_id;
					}
				}
			})
		    if(isrepeat){
				$.messager.alert(BASSIC_MESSAGE , BATCH_MESSAGE15);
				$("#transactionDetailList").datagrid("beginEdit", i);
				textKeyup(i);
				isrepeat = false;
				return;
		    }
			
			//F1
			$.ajax({
				url: "../basic/data/free.retrieve.php?free_codes="+rows[i].free_code1+"&project_ids="+projectId+"&free_type=1",
				type: 'get',
				async: false,
				dataTye: 'json',
				success: function (data) {
					data = eval('(' + data + ')');
					if(data.total < 1){
						isrepeat = true;
					}else{
						rows[i].project_free1_id = data.rows[0].record_id;
					}
				}
			})
		    if(isrepeat){
				$.messager.alert(BASSIC_MESSAGE , BATCH_MESSAGE16);
				$("#transactionDetailList").datagrid("beginEdit", i);
				textKeyup(i);
				isrepeat = false;
				return;
		    }
			
			//F1
			$.ajax({
				url: "../basic/data/free.retrieve.php?free_codes="+rows[i].free_code2+"&project_ids="+projectId+"&free_type=2",
				type: 'get',
				async: false,
				dataTye: 'json',
				success: function (data) {
					data = eval('(' + data + ')');
					if(data.total < 1){
						isrepeat = true;
					}else{
						rows[i].project_free2_id = data.rows[0].record_id;
					}
				}
			})
		    if(isrepeat){
				$.messager.alert(BASSIC_MESSAGE , BATCH_MESSAGE17);
				$("#transactionDetailList").datagrid("beginEdit", i);
				textKeyup(i);
				isrepeat = false;
				return;
		    }
			
			//F1
			$.ajax({
				url: "../basic/data/free.retrieve.php?free_codes="+rows[i].free_code3+"&project_ids="+projectId+"&free_type=3",
				type: 'get',
				async: false,
				dataTye: 'json',
				success: function (data) {
					data = eval('(' + data + ')');
					if(data.total < 1){
						isrepeat = true;
					}else{
						rows[i].project_free3_id = data.rows[0].record_id;
					}
				}
			})
		    if(isrepeat){
				$.messager.alert(BASSIC_MESSAGE , BATCH_MESSAGE18);
				$("#transactionDetailList").datagrid("beginEdit", i);
				textKeyup(i);
				isrepeat = false;
				return;
		    }
			
			//合计
			amount += Number(rows[i].amount);
		}
	}
	
	for (var i = 0; i < delId.length; i++) {
		$("#transactionDetailList").datagrid('deleteRow', delId[0]);
	}
	
	if(rows.length == 0){
		$.messager.alert(BASSIC_MESSAGE , BATCH_MESSAGE13);
		$('#transactionDetailList').datagrid('appendRow', {});
		return;
	}
	
	if(amount != 0){
		if(rDecimal.test(amount)){
			amount = amount;
		}else{
			amount = amount+'.00';
		}
		var parts = amount.toString().split(".");
	    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	    amount = parts.join(".");
		$("#totalAmount").html("<span style='color:red'>"+amount+"</span>");
		}else{
			$("#totalAmount").html("0.00");
		}
//	if(amount != 0){
//		$.messager.alert(BASSIC_MESSAGE , BATCH_MESSAGE9);
//		return;
//	}
	
	var transactionDetail = JSON.stringify(rows);
	
	if(needUpdate){
		var isValid = $("#transactionCode").validatebox('isValid');
		if(!isValid){
			$.messager.alert(BASSIC_MESSAGE , BATCH_MESSAGE2);
			return;
		}
		var transactionId = $("#transactionId").val();
		$.messager.confirm(BATCH_CONFIRM , BATCH_MESSAGE10,function(confirm){
			if (confirm){
	        	$.post('data/transaction.update.php',{batch_id : batchId , transaction_id : transactionId , transaction_code : transactionCode , total_amount : amount , transaction_detail : transactionDetail},function(data){
	        		var data = eval('(' + data + ")");
	        		if (data.result == RESULT_CODE_SUCCESS) {
	      				$.messager.alert(BASSIC_MESSAGE, data.msg);
	      				document.getElementById('createTransactionButton').style.display = "block";
	  						document.getElementById('confirmDetailDiv').style.display = "none";
	  						document.getElementById('deleteDetailDiv').style.display = "none";
	  						if (isHistory != 1){
	  							allBatch();
	  						}
//	  						$('#transactionList').datagrid('options')['url'] = 'data/transaction.retrieve.php?batch_id='+batchId;
//	  						$("#transactionList").datagrid('load');
	      			} else {
	      				checkResult(data);
	      			}
	        	});
	        }
		});
	}else{
		var isValid = $("#transactionCode").validatebox('isValid');
		if(!isValid){
			$.messager.alert(BASSIC_MESSAGE , BATCH_MESSAGE2);
			return;
		}
		$.messager.confirm(BATCH_CONFIRM,BATCH_MESSAGE11,function(confirm){
			if (confirm){
	        	$.post('data/transaction.create.php',{batch_id : batchId , transaction_code : transactionCode , total_amount : amount , transaction_detail : transactionDetail},function(data){
	        		var data = eval('(' + data + ")");
	        		if (data.result == RESULT_CODE_SUCCESS) {
	      				$.messager.alert(BASSIC_MESSAGE, data.msg);
	  						document.getElementById('createTransactionButton').style.display = "block";
	  						document.getElementById('confirmDetailDiv').style.display = "none";
	  						document.getElementById('deleteDetailDiv').style.display = "none";
		  			        $("#subA").show();
		  			        $("#numA").show();
		  			        allBatch();
//	  						$('#transactionList').datagrid('options')['url'] = 'data/transaction.retrieve.php?batch_id='+batchId;
//	  						$("#transactionList").datagrid('load');
	      			} else {
	      				checkResult(data);
	      			}
	        	});
	        }
		});
	}
}

/*删除交易条目*/
function deleteDetail(){
    var row = $("#transactionDetailList").datagrid("getSelected");
    if (row) {
        $.messager.confirm(BASSIC_MESSAGE, DELETE_CONFIRM, function (r) {
            if (r) {
           	 var rowIndex = $("#transactionDetailList").datagrid('getRowIndex', row);
           	$("#transactionDetailList").datagrid('deleteRow', rowIndex);  
            }
        });
    }else {
        $.messager.alert(BASSIC_MESSAGE, DELETE_SELECT, BATCH_MESSAGE12);
    }
}

/*点击交易号查看详情*/
function showDetail(batch,id,code,amount){
	$.ajax({
		url: "data/batch.retrieve.php?batch_ids="+batch+"&project_ids="+projectId,
		type: 'get',
		async: false,
		dataTye: 'json',
		success: function (data) {
			data = eval('(' + data + ')');
			batchCode = data.rows[0].batch_code;
			currencyValue = data.rows[0].currency_code;
			currencyText = data.rows[0].currency_type;
		}
	})
	$("#showBatchCode").html("—"+batchCode);
	$("#batchInput").hide();
	$("#createBatchButton").hide();
	$("#addBatchButton").show();
	$("#batchSpan").show();
	$("#batchSpan").html(batchCode);
	$("#currencySpan").html(currencyText);
	document.getElementById('currencyIdLi').style.display = "none";
	document.getElementById('currencySpanLi').style.display = "block";
	$("#showBatchCode").show();
	$("#createTransactionLi").show();
	$("#createTransactionButton").show();
	$("#updateCurrencyButton").show();
	$("#batch_title").html(LOCATION_BATCH+"<span style='font-size: 20px;'>"+currentProjectName+"></span>"+UPDATE_TITLE_PO);
	batchId = batch;
	$("#subDiv").empty();
	$("#numDiv").empty();
	$("#numA").show();
	$("#subA").show();
	$("#detailListDiv").show();
	$("#confirmDetailDiv").show();
	$("#deleteDetailDiv").show();
	$("#examSubjectDiv").hide();
	$("#examNumberDiv").hide();
	$.extend($.fn.validatebox.defaults.rules, {
		repeatCode: {
				validator: function(value){
	   					var isExist = false;
	   					$.ajaxSetup({async : false}); 
		   				var isExist = false;
							if(code == value){
								isExist = true;
							}else{
			   					$.post('data/transaction.isrepeat.php',{transaction_codes:value,batch_ids:batchId},function(data){
			   						var data = eval('(' + data + ')');
			   						if(data.result == 10004){
			   							isExist = false;
			   						}else if(data.result == 10000){
			   							isExist = true;
			   						}
			   					});
							}
	   				return isExist;
				},
   			message: BATCH_MESSAGE2
   		}
    });
	needUpdate = true; 
	document.getElementById('createTransactionButton').style.display = "block";
	document.getElementById('confirmDetailDiv').style.display = "block";
	document.getElementById('deleteDetailDiv').style.display = "block";
	$("#transactionId").val(id);
	$("#transactionCode").val(code);
	$("#totalAmount").html(amount);
	$("#batchInput").val();
	$("#currencyId").val();
	$('#transactionDetailList').datagrid('options')['url'] = 'data/transaction.detail.retrieve.php?transaction_id='+id;
	$("#transactionDetailList").datagrid('load');
}

/*主码子码匹配查询*/
function codeCombobox(mainCode,subCode){
	var data = "";
    $.ajax({
        url: "../basic/data/code.retrieve.php?main_codes="+mainCode+"&sub_codes="+subCode+"&project_id="+projectId,
        type: 'get',
        async: false,
        dataTye: 'json',
        success: function (data) {
        	data = eval('(' + data + ')');
        }
    })
    return data;
}

/*检查单号*/
function examNumber(){
	$("#numDiv").empty();
	$("#numA").show();
	$("#subA").show();
	$("#detailListDiv").hide();
	$("#confirmDetailDiv").hide();
	$("#deleteDetailDiv").hide();
	$("#examSubjectDiv").hide();
	$("#examNumberDiv").show();
	document.getElementById('createTransactionButton').style.display = "block";
	if(appendCheckNum){
		var numberData = "";
		$.ajax({
			url: "data/transaction.retrieve.php?batch_ids="+batchId,
			type: 'get',
			async: false,
			dataTye: 'json',
			success: function (data) {
				numberData = eval('(' + data + ')');
			}
		})
		//$("#numDiv").append('<div class="xmys_right_button" style="margin-right:-100px;"><ul><li class="xmys_button_download" style="margin-top: -10px;margin-right: 100px"><a  href="javascript:void(0)" onclick="ExcelNumFunction()"><em><img src="../images/icon_type.png"/></em>Excel</a></li></ul></div><br>');
		$("#numDiv").append('<div class="xmys_right_button"><ul><li class="xmys_button_download" style="margin-top: -10px;margin-right: 0px"><a href="javascript:void(0)" onclick="PDFNumFunction()"><em><img src="../images/icon_type.png"/></em>PDF</a></li><li class="xmys_button_download" style="margin-top: -10px;margin-right: 50px"><a href="javascript:void(0)" onclick="ExcelNumFunction()"><em><img src="../images/icon_type.png"/></em>Excel</a></li></ul></div><br>');

		for (var i = 0; i < numberData.total; i++) {
			var amounts = numberData.rows[i].total_amount;
			var parts = amounts.toString().split(".");
		    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
		    amounts = parts.join(".");
			$("#numDiv").append("<div class='pcl_text_nav'><div class='pcl_nav_left'>"+BATCH_TRANSACTION_CODE+"<span>"+numberData.rows[i].transaction_code+"</span></div><div class='pcl_nav_right'>"+BATCH_TRANSACTION_AMOUNT+"<span>"+amounts+"</span></div><div id='"+numberData.rows[i].transaction_id+numberData.rows[i].transaction_code+"'></div></div>");
			$("#"+numberData.rows[i].transaction_id+numberData.rows[i].transaction_code).datagrid({
				autoHeight:true,
				title:'',
				idField:'all_code',
				singleSelect:true,
				fitColumns:false,
				url:'data/transaction.code.retrieve.php?transaction_ids='+numberData.rows[i].transaction_id,
				columns:[[
				          {title:BATCH_NUM_ALL_CODE,field:'all_code',width:'25%',align: 'left',halign: 'center'},
				          {title:BATCH_ASSET,field:'is_asset',  width: '5%', align: 'center',halign: 'center',
				        	  formatter:function(value,rowData,rowIndex){
				        		 if(value == 0 || value == "" || value == null){
				        			 return "<input  type='checkbox' >";
				        		 }else{
				        			 return "<input  type='checkbox' checked >";
				        		 }
							  }
				          },
				          {title:BATCH_NUM_DETAIL_DESC,field:'detail_desc',width:'55%',align: 'left',halign: 'center'},
				          {title:BATCH_NUM_DETAIL_AMOUNT,field:'amount',width:'17%',align: 'right',halign: 'center', 
				        	  formatter:function(value,rowData,rowIndex){
				        	  	 	if(value != null){
									    var parts = value.toString().split(".");
									    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
									    return parts.join(".");
									}else{
										return value;
									}
								 }
							}
				          ]]
			});
		}
	}
}

/*检查科目*/
function examSubject(){
	$("#subDiv").empty();
	$("#numA").show();
	$("#subA").show();
	$("#detailListDiv").hide();
	$("#confirmDetailDiv").hide();
	$("#deleteDetailDiv").hide();
	$("#examNumberDiv").hide();
	$("#examSubjectDiv").show();
	document.getElementById('createTransactionButton').style.display = "block";
    if(appendCheckSub){
		var subjectData = "";
		$.ajax({
			url: "data/batch.code.retrieve.php?batch_ids="+batchId,
			type: 'get',
			async: false,
			dataTye: 'json',
			success: function (data) {
				subjectData = eval('(' + data + ')');
			}
		})
		$("#subDiv").append('<div class="xmys_right_button"><ul><li class="xmys_button_download" style="margin-top: -10px;margin-right: 0px"><a href="javascript:void(0)" onclick="PDFSubFunction()"><em><img src="../images/icon_type.png"/></em>PDF</a></li><li class="xmys_button_download" style="margin-top: -10px;margin-right: 50px"><a href="javascript:void(0)" onclick="ExcelSubFunction()"><em><img src="../images/icon_type.png"/></em>Excel</a></li></ul></div><br>');
		for (var i = 0; i < subjectData.total; i++) {
			if(language == 'en'){
				var desc = subjectData.rows[i].code_desc_en;
			}else{
				var desc = subjectData.rows[i].code_desc_zh;
			}
			var spanId = subjectData.rows[i].main_code+subjectData.rows[i].sub_code;
			$("#subDiv").append("<div class='pcl_text_nav'><div class='pcl_nav_left'>"+BATCH_KM_CODE+"<span>"+subjectData.rows[i].main_code+"</span><span style='margin-left: 5px;'>"+subjectData.rows[i].sub_code+"</span><span style='margin-left: 5px;'>"+desc+"</span></div><div class='pcl_nav_right'>"+BATCH_TRANSACTION_AMOUNT+"<span id='"+spanId+"'></span></div><div id='"+subjectData.rows[i].batch_id+subjectData.rows[i].main_code+subjectData.rows[i].sub_code+"'></div></div>");
			$("#"+subjectData.rows[i].batch_id+subjectData.rows[i].main_code+subjectData.rows[i].sub_code).datagrid({
				autoHeight:true,
				title:'',
				idField:'all_code',
				singleSelect:true,
				fitColumns:false,
				url:'data/transaction.detail.retrieve.php?batch_ids='+subjectData.rows[i].batch_id+'&main_codes='+subjectData.rows[i].main_code+'&sub_codes='+subjectData.rows[i].sub_code,
				onLoadSuccess:function(data){
					var subAmount = 0;
					for (var j = 0; j < data.total; j++) {
						subAmount += Number(data.rows[j].amount);
					}
					if(subAmount == 0){
						$("#"+data.rows[0].main_code+data.rows[0].sub_code).html("0.00");
					}else{
						if(rDecimal.test(subAmount)){
							subAmount = subAmount;
						}else{
							subAmount = subAmount+'.00';
						}
						var amounts = subAmount.toString().split(".");
						amounts[0] = amounts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
						amounts = amounts.join(".");
						$("#"+data.rows[0].main_code+data.rows[0].sub_code).html(amounts);
					}
				},
				columns:[[
				          {title:BATCH_SUB_ALL_CODE,field:'all_code',width:'26%',align: 'left',halign: 'center'},
				          {title:BATCH_ASSET,field:'is_asset',  width: '5%', align: 'center',halign: 'center',
				        	  formatter:function(value,rowData,rowIndex){
				        		 if(value == 0 || value == "" || value == null){
				        			 return "<input  type='checkbox' >";
				        		 }else{
				        			 return "<input  type='checkbox' checked >";
				        		 }
							  }
				          },
				          {title:BATCH_SUB_DETAIL_DESC,field:'transaction_code',width:'16%',align: 'left',halign: 'center'},
				          {title:BATCH_NUM_DETAIL_DESC,field:'detail_desc',width:'28%',align: 'left',halign: 'center'},
				          {title:BATCH_SUB_DETAIL_AMOUNT,field:'amount',width:'25%',align: 'right',halign: 'center', 
				        	  formatter:function(value,rowData,rowIndex){
				        	  	 	if(value != null){
									    var parts = value.toString().split(".");
									    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
									    return parts.join(".");
									}else{
										return value;
									}
								 }
				          }
				          ]]
			});
		}
	}
}

/*导出单号*/
function ExcelNumFunction(){
	showLoader();
	$.ajax({
		type:'POST',
		url:'data/batch.num.export.php?batch_ids='+batchId+'&language='+language,
		async:true,
		cache:false,
		error:function() {
			removeLoader();
			$.messager.alert(BASSIC_MESSAGE, BASIC_EXPORT_MESSAGE);
		},
		success:function(data) {
			removeLoader();
			var data = eval('(' + data + ')');
			if (data.result != '10000') {
				$.messager.alert(BASSIC_MESSAGE, data.msg);
			} else {
				window.open('../'+data.msg);
			}
		}
	});
}

function PDFNumFunction() {
	window.open("../report/data/report.pdf.php?report_type=10&language=" + language+"&batch_ids=" + batchId, "_blank");
}

/*导出科目*/
function ExcelSubFunction(){
	showLoader();
	$.ajax({
		type:'POST',
		url:'data/batch.sub.export.php?batch_ids='+batchId+'&language='+language,
		async:true,
		cache:false,
		error:function() {
			removeLoader();
			$.messager.alert(BASSIC_MESSAGE, BASIC_EXPORT_MESSAGE);
		},
		success:function(data) {
			removeLoader();
			var data = eval('(' + data + ')');
			if (data.result != '10000') {
				$.messager.alert(BASSIC_MESSAGE, data.msg);
			} else {
				window.open('../'+data.msg);
			}
		}
	});
}

function PDFSubFunction(){
	window.open("../report/data/report.pdf.php?report_type=9&language=" + language+"&batch_ids=" + batchId, "_blank");
}

//历史PO
function poHistory(){
	location.href = "poHistory-list.php";
}

function assetClick(index){
	var asset = document.getElementsByName("asset"+index)[0];
	if(asset.checked == true){
		$('#transactionDetailList').datagrid('getRows')[index].is_asset = "1";
	}else{
		$('#transactionDetailList').datagrid('getRows')[index].is_asset = "0";
	}
}

function toPO(){
	location.href = "poInput-create.php";
}

/*获取高度*/
function getGridHeight(){
	var height1 = $("#_title").height();
	var height2 = $("#_query").height() ;
	var height = document.compatMode=="CSS1Compat"?document.documentElement.clientHeight:document.body.clientHeight;
	return height - height2 - height1 - 100;
}
