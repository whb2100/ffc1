var needUpdate = false;
var enableSubmit = false;
var appendCheckNum = true;
var appendCheckSub = true;
var projectId = $("#projectId").val();
var batchId;
var currencyId;
var currencyValue;
var regionComboboxData = "";
var sceneComboboxData = "";
var free1ComboboxData = "";
var free2ComboboxData = "";
var free3ComboboxData = "";
var projectId = $("#projectId").val();
var language = $("#language").val();

function textKeyup(index) {
	var editors = $('#transactionDetailList').datagrid('getEditors', index);
	var len = editors.length;
	/*len = 2;
	var arrNum = [3, 4];// 字符长度 地区码-主码
	for (var i = 0; i < len; i++) {
		$(editors[i].target).textbox('textbox').keyup(function (e) {		
			var value = $(editors[i].target).textbox('getText');
			alert(i + "," + value);
			if (value != null && value.length >= arrNum[i]) {
				$(editors[i + 1].target).textbox('textbox').focus();
			}
		});
	}*/
	
	
	// 地区码
	var editor = editors[0];
	$(editor.target).textbox('textbox').keyup(function (e) {		
		var value = $(editor.target).textbox('getText');
		if (value != null && value.length >= 3) {
			$(editors[1].target).textbox('textbox').focus();
		}
	});
	
	// 主码
	var editor1 = editors[1];
	$(editor1.target).textbox('textbox').keyup(function (e) {		
		var value = $(editor1.target).textbox('getText');
		if (value != null && value.length >= 4) {
			$(editors[2].target).textbox('textbox').focus();
		}
	});
	
	// 子码
	var editor2 = editors[2];
	$(editor2.target).textbox('textbox').keyup(function (e) {		
		var value = $(editor2.target).textbox('getText');
		if (value != null && value.length >= 3) {
			$(editors[3].target).textbox('textbox').focus();
		}
	});

	// 场景号
	var editor3 = editors[3];
	$(editor3.target).textbox('textbox').keyup(function (e) {		
		var value = $(editor3.target).textbox('getText');
		if (value != null && value.length >= 3) {
			$(editors[4].target).textbox('textbox').focus();
		}
	});
	
	// F1
	var editor4 = editors[4];
	$(editor4.target).textbox('textbox').keyup(function (e) {		
		var value = $(editor4.target).textbox('getText');
		if (value != null && value.length >= 2) {
			$(editors[5].target).textbox('textbox').focus();
		}
	});
	
	// F2 
	var editor5 = editors[5];
	$(editor5.target).textbox('textbox').keyup(function (e) {		
		var value = $(editor5.target).textbox('getText');
		if (value != null && value.length >= 2) {
			$(editors[6].target).textbox('textbox').focus();
		}
	});
	
  // F3 
	var editor6 = editors[6];
	$(editor6.target).textbox('textbox').keyup(function (e) {		
		var value = $(editor6.target).textbox('getText');
		if (value != null && value.length >= 2) {
			$(editors[7].target).textbox('textbox').focus();
		}
	});
	
	//金额
	var total = 0;
	var totalValue = 0;
	var editor7 = editors[7];
	$(editor7.target).textbox('textbox').keyup(function (e) {		
		var value = $(editor7.target).textbox('getText');
		var rows = $('#transactionDetailList').datagrid('getRows');
		total = 0;
		for(var i = 0; i < rows.length; i++){
			var row = $('#transactionDetailList').datagrid('getEditors' , i);
			if(row[0] != null){
				totalValue = $(row[7].target).textbox('getText');
				total = total+Number(totalValue);
			}
		}
		$("#totalAmount").html(total);
	});
	
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
	
	/*$(editor8.target).textbox('textbox').click(function (e) {
		$(editor8.target).textbox('textbox').select();
	});*/
}

/*基础值*/
function showBatch(code,id,currency_id,currency_type){
	batchId = id;
	currencyId = currency_id;
	currencyValue = currency_type;
	$("#showBatchCode").html("-"+code);
	$("#showBatchCode").show();
	$("#createTransactionLi").show();
	$("#createTransactionButton").show();
//	$("#transactionCode").val("");
	$('#transactionDetailList').datagrid('loadData', { total: 0, rows: [] });
}

/*多条批处理*/
function allBatch(){
	$("#batchCodeDiv").empty();
	var batchData = "";
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
		$("#batchCodeDiv").append("<a href='javascript:void(0)' onclick='showBatch(\""+batchData.rows[i].batch_code+"\","+batchData.rows[i].batch_id+","+batchData.rows[i].currency_id+",\""+batchData.rows[i].currency_code+"\")'><div id='"+batchData.rows[i].batch_id+"'></div></a><div class='pcl_left_nav_button'><ul><li><a href='javascript:void(0)' onclick='submitBatch("+batchData.rows[i].batch_id+","+batchData.rows[i].currency_id+")'><span>"+BATCH_SUBMIT+"</span></a></li></ul></div><div class='pcl_left_nav_button'><ul><li><a href='javascript:void(0)' onclick='deleteBatch("+batchData.rows[i].batch_id+")'><span>"+BATCH_DELETE+"</span></a></li></ul></div><br><br><br>");
		$("#"+batchData.rows[i].batch_id).datagrid({
			autoHeight:true,
			title:BATCH_NAME+batchData.rows[i].batch_code,
			idField:'batch_id',
			singleSelect:true,
			fitColumns:false,
			showHeader:false,
			collapsible:true,
			collapsed:true,
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

$(function(){
	regionCombobox();
	sceneCombobox();
	free1Combobox();
	free2Combobox();
	free3Combobox();
	allBatch();
	
//	$("#transactionList").datagrid({
//		autoHeight:true,
//		title:'',
//		idField:'transaction_id',
//		singleSelect:true,
//		fitColumns:false,
//		showHeader:false,
//		url:'',
//		onClickRow : function(index, row){
//			showDetail(index);
//		},
//		columns:[[
//		          {title:TRANSACTION_CODE,field:'transaction_code',width:237,align:'center'}
//		]]
//	});
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
		          {title:BATCH_REGION,field:'project_region_id',  width: '6%', align: 'left',halign: 'center',
		        	  formatter:function(value,rowData,rowIndex){
		        		  for (var i = 0; i < regionComboboxData.length; i++) {
		                      if (regionComboboxData[i].record_id == value) {
		                          return regionComboboxData[i].region_code;
		                      }
		                  }
					  },
		        	  editor: { type: 'combobox',  
						      	  options: {
						      	   height:g_editor_cell_height,
						      		 data: regionComboboxData,
							         valueField: "record_id",  
							         textField: "region_code",  
							         editable: true,  
							         panelHeight:70
							      }
		        	  }
		          },
		          {title:BATCH_MAIN_CODE,field:'main_code',  width: '5%', align: 'left',halign: 'center',
		        	  editor: { type: 'textbox', options: {height:g_editor_cell_height}}
		          },
		          {title:BATCH_SUB_CODE,field:'sub_code',  width: '5%', align: 'left',halign: 'center',
		        	  editor: { type: 'textbox', options: {height:g_editor_cell_height}}
		          },
		          {title:BATCH_SCENE,field:'project_scene_id',  width: '6%', align: 'left',halign: 'center',
		        	  formatter:function(value,rowData,rowIndex){
		        		  for (var i = 0; i < sceneComboboxData.length; i++) {
		                      if (sceneComboboxData[i].record_id == value) {
		                          return sceneComboboxData[i].scene_code;
		                      }
		                  }
					  },
		        	  editor: { type: 'combobox',  
						      	  options: {
						      	   height:g_editor_cell_height,
						      		 data: sceneComboboxData,
							         valueField: "record_id",  
							         textField: "scene_code",  
							         editable: true,  
							         panelHeight:70
							      }
		        	  }
		          },
		          {title:'F1',field:'project_free1_id',  width: '6%', align: 'left',halign: 'center',
		        	  formatter:function(value,rowData,rowIndex){
		        		  for (var i = 0; i < free1ComboboxData.length; i++) {
		                      if (free1ComboboxData[i].record_id == value) {
		                          return free1ComboboxData[i].free_code;
		                      }
		                  }
					  },
		        	  editor: { type: 'combobox',  
						      	  options: {
						      	   height:g_editor_cell_height,
						      		 data: free1ComboboxData,
							         valueField: "record_id",  
							         textField: "free_code",  
							         editable: true,  
							         panelHeight:70
							      }
		        	  }
		          },
		          {title:'F2',field:'project_free2_id',  width: '6%', align: 'left',halign: 'center',
		        	  formatter:function(value,rowData,rowIndex){
		        		  for (var i = 0; i < free2ComboboxData.length; i++) {
		                      if (free2ComboboxData[i].record_id == value) {
		                          return free2ComboboxData[i].free_code;
		                      }
		                  }
					  },
		        	  editor: { type: 'combobox',  
						      	  options: {
						      	   height:g_editor_cell_height,
						      		 data: free2ComboboxData,
							         valueField: "record_id",  
							         textField: "free_code",  
							         editable: true,  
							         panelHeight:70
							      }
		        	  }
		          },
		          {title:'F3',field:'project_free3_id',  width: '6%', align: 'left',halign: 'center',
		        	  formatter:function(value,rowData,rowIndex){
		        		  for (var i = 0; i < free3ComboboxData.length; i++) {
		                      if (free3ComboboxData[i].record_id == value) {
		                          return free3ComboboxData[i].free_code;
		                      }
		                  }
					  },
		        	  editor: { type: 'combobox',  
						      	  options: {
						      	   height:g_editor_cell_height,
						      		 data: free3ComboboxData,
							         valueField: "record_id",  
							         textField: "free_code",  
							         editable: true,  
							         panelHeight:70
							      }
		        	  }
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
		          {title:BATCH_AMOUNT,field:'amount',  width: '10%', align: 'right',halign: 'center',
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
		          {title:BATCH_DESC,field:'detail_desc',  width: '39%', align: 'left',halign: 'center',
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
	    valueField:"currency_code_id",    
	    textField:"currency_type"
	});
	
	$.extend($.fn.validatebox.defaults.rules, {
		repeat: {
				validator: function(value){
	   				var isExist = false;
	   					$.ajaxSetup({async : false}); 
	   					$.post('data/batch.isrepeat.php',{batch_codes:value},function(data){
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
   					$.post('data/transaction.isrepeat.php',{transaction_codes:value},function(data){
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
			console.log(data);
			currencyValue = data.rows[0].currency_code;
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
	    	$("#batchSpan").html(batchCode);
	    	$("#batchCode").html(batchCode);
	    	$("#currencySpan").html(currencyValue);
	    	document.getElementById('createTransactionLi').style.display = "block";
	    	document.getElementById('confirmDetailDiv').style.display = "block";
	    	document.getElementById('deleteDetailDiv').style.display = "block";
	    	document.getElementById('batchCodeDiv').style.display = "block";
	    	allBatch();
	    	$("#transactionCode").val("");
	    	$('#transactionDetailList').datagrid('loadData', { total: 0, rows: [] });
//	    	$("#batchInput").hide();
//	    	$("#createBatchButton").hide();
//	    	document.getElementById('currencyIdLi').style.display = "none";
//	    	document.getElementById('currencySpanLi').style.display = "block";
		} else {
			checkResult(data);
		}
	});
	$('#transactionDetailList').datagrid('appendRow', {});
}

/*提交批处理*/
function submitBatch(id,currency_id){
    $.messager.confirm(BATCH_CONFIRM , BATCH_MESSAGE5,function(confirm){
        if (confirm){
        	$.post('data/batch.update.php',{batch_id : id , status : 2 , currency_id : currency_id},function(data){
        		var data = eval('(' + data + ")");
        		if (data.result == RESULT_CODE_SUCCESS) {
        			$.messager.alert(BASSIC_MESSAGE, BASSIC_SUCCESSFUL_OPERATION);
        			allBatch();
        		} else {
        			checkResult(data);
        		}
        	});
        }
    });
}

/*删除批处理*/
function deleteBatch(id){
    $.messager.confirm(BATCH_CONFIRM , BATCH_MESSAGE5,function(confirm){
        if (confirm){
        	$.post('data/batch.delete.php',{batch_id : id},function(data){
        		var data = eval('(' + data + ")");
        		if (data.result == RESULT_CODE_SUCCESS) {
        			$.messager.alert(BASSIC_MESSAGE, BASSIC_SUCCESSFUL_OPERATION);
        			allBatch();
        		} else {
        			checkResult(data);
        		}
        	});
        }
    });
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
   					$.post('data/transaction.isrepeat.php',{transaction_codes:value},function(data){
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
	   					$.post('data/transaction.isrepeat.php',{transaction_codes:value},function(data){
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
			if(rows[i].project_region_id == null || rows[i].project_region_id == "" || rows[i].main_code == null || rows[i].main_code == "" || rows[i].sub_code == null || rows[i].sub_code == "" || rows[i].project_scene_id == null || rows[i].project_scene_id == "" || rows[i].project_free1_id == null || rows[i].project_free1_id == "" || rows[i].project_free2_id == null || rows[i].project_free2_id == "" || rows[i].project_free3_id == null || rows[i].project_free3_id == "" || rows[i].amount == null || rows[i].amount == "" || rows[i].detail_desc == null || rows[i].detail_desc == ""){
				$.messager.alert(BASSIC_MESSAGE , BASSIC_NULL_MESSAGE);
				$("#transactionDetailList").datagrid("beginEdit", i);
				textKeyup(i);
				return;
			}
			if(isNaN(rows[i].project_region_id)){
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
			if(isNaN(rows[i].project_scene_id)){
				$.messager.alert(BASSIC_MESSAGE , BATCH_MESSAGE7);
				$("#transactionDetailList").datagrid("beginEdit", i);
				textKeyup(i);
				return;
			}
			if(isNaN(rows[i].project_free1_id)){
				$.messager.alert(BASSIC_MESSAGE , BATCH_MESSAGE7);
				$("#transactionDetailList").datagrid("beginEdit", i);
				textKeyup(i);
				return;
			}
			if(isNaN(rows[i].project_free2_id)){
				$.messager.alert(BASSIC_MESSAGE , BATCH_MESSAGE7);
				$("#transactionDetailList").datagrid("beginEdit", i);
				textKeyup(i);
				return;
			}
			if(isNaN(rows[i].project_free3_id)){
				$.messager.alert(BASSIC_MESSAGE , BATCH_MESSAGE7);
				$("#transactionDetailList").datagrid("beginEdit", i);
				textKeyup(i);
				return;
			}
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
				textKeyup(i);
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
		$.messager.alert(BASSIC_MESSAGE , BATCH_MESSAGE9);
		return;
	}
	
	$("#totalAmount").html(amount);
	
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
	  						allBatch();
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
		url: "data/batch.retrieve.php?batch_ids="+batch,
		type: 'get',
		async: false,
		dataTye: 'json',
		success: function (data) {
			data = eval('(' + data + ')');
			currencyValue = data.rows[0].currency_type;
		}
	})
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
			   					$.post('data/transaction.isrepeat.php',{transaction_codes:value},function(data){
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

/*地区下拉框*/
function regionCombobox(){
    $.ajax({
        url: "../basic/data/region.code.retrieve.php?project_id="+projectId,
        type: 'get',
        async: false,
        dataTye: 'json',
        success: function (data) {
        	var data = eval('(' + data + ')');
        	regionComboboxData = data;
        }
    })
}

/*场景下拉框*/
function sceneCombobox(){
    $.ajax({
        url: "../basic/data/scene.code.retrieve.php?project_id="+projectId,
        type: 'get',
        async: false,
        dataTye: 'json',
        success: function (data) {
        	var data = eval('(' + data + ')');
        	sceneComboboxData = data;
        }
    })
}

/*F1下拉框*/
function free1Combobox(){
    $.ajax({
        url: "../basic/data/free.code.retrieve.php?free_type=1&project_id="+projectId,
        type: 'get',
        async: false,
        dataTye: 'json',
        success: function (data) {
        	var data = eval('(' + data + ')');
        	free1ComboboxData = data;
        }
    })
}

/*F2下拉框*/
function free2Combobox(){
    $.ajax({
        url: "../basic/data/free.code.retrieve.php?free_type=2&project_id="+projectId,
        type: 'get',
        async: false,
        dataTye: 'json',
        success: function (data) {
        	var data = eval('(' + data + ')');
        	free2ComboboxData = data;
        }
    })
}

/*F3下拉框*/
function free3Combobox(){
    $.ajax({
        url: "../basic/data/free.code.retrieve.php?free_type=3&project_id="+projectId,
        type: 'get',
        async: false,
        dataTye: 'json',
        success: function (data) {
        	var data = eval('(' + data + ')');
        	free3ComboboxData = data;
        }
    })
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
	$("#numA").hide();
	$("#subA").show();
	$("#detailListDiv").hide();
	$("#confirmDetailDiv").hide();
	$("#deleteDetailDiv").hide();
	$("#examSubjectDiv").hide();
	$("#examNumberDiv").show();
	document.getElementById('createTransactionButton').style.display = "block";
	if(appendCheckNum){
		var subjectData = "";
		$.ajax({
			url: "data/transaction.retrieve.php?batch_ids="+batchId,
			type: 'get',
			async: false,
			dataTye: 'json',
			success: function (data) {
				numberData = eval('(' + data + ')');
			}
		})
		for (var i = 0; i < numberData.total; i++) {
			var amounts = "0.00";
			$("#numDiv").append("<div class='pcl_text_nav'><div class='pcl_nav_left'>"+BATCH_TRANSACTION_CODE+"<span>"+numberData.rows[i].transaction_code+"</span></div><div class='pcl_nav_right'>"+BATCH_TRANSACTION_AMOUNT+"<span>"+amounts+"</span></div><div id='"+numberData.rows[i].transaction_id+"'></div></div>");
			$("#"+numberData.rows[i].transaction_id).datagrid({
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
	$("#subA").hide();
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
				          {title:BATCH_NUM_DETAIL_DESC,field:'detail_desc',width:'30%',align: 'left',halign: 'center'},
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

function assetClick(index){
	var asset = document.getElementsByName("asset"+index)[0];
	if(asset.checked == true){
		$('#transactionDetailList').datagrid('getRows')[index].is_asset = "1";
	}else{
		$('#transactionDetailList').datagrid('getRows')[index].is_asset = "0";
	}
}

/*获取高度*/
function getGridHeight(){
	var height1 = $("#_title").height();
	var height2 = $("#_query").height() ;
	var height = document.compatMode=="CSS1Compat"?document.documentElement.clientHeight:document.body.clientHeight;
	return height - height2 - height1 - 100;
}
