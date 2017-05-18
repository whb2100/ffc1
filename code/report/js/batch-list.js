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
var checkStatus;

function textKeyup(index) {
	var editors = $('#transactionDetailList').datagrid('getEditors', index);
	var len = editors.length;
	
	// F1
	var editor4 = editors[4];
	var val4 = $(editor4.target).textbox('getText');
	if(val4 == null || val4 == ""){
		$(editor4.target).textbox('setText', '00');
	}
	$(editor4.target).textbox('textbox').keyup(function (e) {	
		var value = $(editor4.target).textbox('getText');
		if (value != null && value.length >= 2) {
			$(editors[5].target).textbox('textbox').focus();
		}
	});
	
	// F2 
	var editor5 = editors[5];
	var val5 = $(editor5.target).textbox('getText');
	if(val5 == null || val5 == ""){
		$(editor5.target).textbox('setText', '00');
	}
	$(editor5.target).textbox('textbox').keyup(function (e) {		
		var value = $(editor5.target).textbox('getText');
		if (value != null && value.length >= 2) {
			$(editors[6].target).textbox('textbox').focus();
		}
	});
	
  // F3 
	var editor6 = editors[6];
	var val6 = $(editor6.target).textbox('getText');
	if(val6 == null || val6 == ""){
		$(editor6.target).textbox('setText', '00');
	}
	$(editor6.target).textbox('textbox').keyup(function (e) {	
		var value = $(editor6.target).textbox('getText');
		if (value != null && value.length >= 2) {
			$(editors[7].target).textbox('textbox').focus();
		}
	});
}

/*基础值*/
function showBatch(code,id,currency_id,currency_code,currency_type){
	batchId = id;
	currencyId = currency_id;
	currencyValue = currency_code;
	$("#showBatchCode").html(code);
	$("#transactionCode").html("");
	$('#transactionDetailList').datagrid('loadData', { total: 0, rows: [] });
	$("#batchSpan").show();
	$("#batchSpan").html(code);
	$("#currencySpan").html(currency_type);
	document.getElementById('currencySpanLi').style.display = "block";
	$("#showBatchCode").show();
	$("#confirmDetailDiv").hide();
	$("#subDiv").empty();
	$("#numDiv").empty();
	$("#numA").show();
	$("#subA").show();
	var isExpand = document.getElementById('expand'+code).style.display;
	if(isExpand == 'none'){
		$("#list"+id).datagrid('options')['url'] = '../batch/data/transaction.retrieve.php?batch_ids='+id;
		$("#list"+id).datagrid('reload');
		$("#expand"+code).show();
	}else{
		$("#expand"+code).hide();
	}
}

function expandBatch(expandCode,expandId){
	var isExpand = document.getElementById('expand'+expandCode).style.display;
	if(isExpand == 'none'){
		$("#list"+expandId).datagrid('options')['url'] = '../batch/data/transaction.retrieve.php?batch_ids='+expandId;
		$("#list"+expandId).datagrid('reload');
		$("#expand"+expandCode).show();
	}else{
		$("#expand"+expandCode).hide();
	}
}

/*多条批处理*/
function allBatch(){
	$("#batchCodeDiv").empty();
	var batchData = "";
	$.ajax({
		url: "../batch/data/batch.retrieve.php?project_ids="+projectId+"&status=2",
		type: 'get',
		async: false,
		dataTye: 'json',
		success: function (data) {
			batchData = eval('(' + data + ')');
		}
	})
	for (var i = 0; i < batchData.total; i++) {
		if(i != batchData.total-1){
			$("#batchCodeDiv").append("<a href='javascript:void(0)' onclick='showBatch(\""+batchData.rows[i].batch_code+"\","+batchData.rows[i].batch_id+","+batchData.rows[i].currency_id+",\""+batchData.rows[i].currency_code+"\",\""+batchData.rows[i].currency_type+"\")'><div style='text-align:center;border-top:1px solid #BFBFBF;border-left:1px solid #BFBFBF;border-right:1px solid #BFBFBF;font-size:15px;'>"+BATCH_NAME+batchData.rows[i].batch_code+"</div></a><div id='expand"+batchData.rows[i].batch_code+"' style='display: none;'><div style='width:239px;' id='list"+batchData.rows[i].batch_id+"'></div></a><br></div>");
		}else{
			$("#batchCodeDiv").append("<a href='javascript:void(0)' onclick='showBatch(\""+batchData.rows[i].batch_code+"\","+batchData.rows[i].batch_id+","+batchData.rows[i].currency_id+",\""+batchData.rows[i].currency_code+"\",\""+batchData.rows[i].currency_type+"\")'><div style='text-align:center;border:1px solid #BFBFBF;font-size:15px;'>"+BATCH_NAME+batchData.rows[i].batch_code+"</div></a><div id='expand"+batchData.rows[i].batch_code+"' style='display: none;'><div style='width:239px;' id='list"+batchData.rows[i].batch_id+"'></div></a><br></div>");
		}
		$("#list"+batchData.rows[i].batch_id).datagrid({
			autoHeight:true,
			idField:'batch_id',
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
	}
}

$(function(){
	allBatch();
	var datagrid;
    var editRow = undefined;
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
		          {title:BATCH_REGION,field:'region_code',  width: '6%', align: 'left',halign: 'center'},
		          {title:BATCH_MAIN_CODE,field:'main_code',  width: '5%', align: 'left',halign: 'center'},
		          {title:BATCH_SUB_CODE,field:'sub_code',  width: '5%', align: 'left',halign: 'center'},
		          {title:BATCH_SCENE,field:'scene_code',  width: '6%', align: 'left',halign: 'center'},
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
		          {title:BATCH_DESC,field:'detail_desc',  width: '37%', align: 'left',halign: 'center'}
          ]],
          onAfterEdit: function (rowIndex, rowData, changes) {
              editRow = undefined;
          },
          onClickCell: function (rowIndex, rowData) {
              datagrid.datagrid("beginEdit", rowIndex);
              $('#transactionDetailList').datagrid('getRows')[rowIndex].a = "1";
              editRow = rowIndex;
              textKeyup(rowIndex);
          }
      });
})

/*提交批处理*/
function confirmDetail(){
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
			}else{
				$("#checkPwdDialog").dialog('close');
				confirm();
			}
		}
	})
}

//判断对象是否为空
function isEmptyObject(obj) {
	for (var key in obj) {
		return false;
	}
	  return true;
}

/*确定*/
function confirm(){
	$("#transactionDetailList").datagrid("acceptChanges");
	
	var rows = $('#transactionDetailList').datagrid('getRows');
	var delId = [];

	for (var i = 0; i < rows.length; i++) {
		if(isEmptyObject(rows[i])){
			delId.push(i);
		}else{
			if(trim(rows[i].free_code1) == "" || trim(rows[i].free_code2) == null || trim(rows[i].free_code2) == "" || trim(rows[i].free_code3) == null || trim(rows[i].free_code3) == ""){
				$.messager.alert(BASSIC_MESSAGE , BASSIC_NULL_MESSAGE);
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
					rows[i].code_id = data.rows[0].record_id;
				}
			})
			
			//地区
			$.ajax({
				url: "../basic/data/region.retrieve.php?region_codes="+rows[i].region_code+"&project_ids="+projectId,
				type: 'get',
				async: false,
				dataTye: 'json',
				success: function (data) {
					data = eval('(' + data + ')');
					rows[i].project_region_id = data.rows[0].record_id;
				}
			})
			
			//场景
			$.ajax({
				url: "../basic/data/scene.retrieve.php?scene_codes="+rows[i].scene_code+"&project_ids="+projectId,
				type: 'get',
				async: false,
				dataTye: 'json',
				success: function (data) {
					data = eval('(' + data + ')');
					rows[i].project_scene_id = data.rows[0].record_id;
				}
			})
			
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
			
			//F2
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
			
			//F3
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
	
	var transactionDetail = JSON.stringify(rows);
	
	var transactionId = $("#transactionId").val();
	$.messager.confirm(BATCH_CONFIRM , BATCH_MESSAGE10,function(confirm){
		if (confirm){
        	$.post('../batch/data/transaction.update.php',{batch_id : batchId , transaction_id : transactionId , transaction_detail : transactionDetail},function(data){
        		var data = eval('(' + data + ")");
        		if (data.result == RESULT_CODE_SUCCESS) {
      				$.messager.alert(BASSIC_MESSAGE, data.msg);
  						document.getElementById('confirmDetailDiv').style.display = "none";
  						allBatch();
      			} else {
      				checkResult(data);
      			}
        	});
        }
	});
}

/*点击交易号查看详情*/
function showDetail(batch,id,code,amount){
	$.ajax({
		url: "../batch/data/batch.retrieve.php?batch_ids="+batch+"&project_ids="+projectId,
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
	$("#showBatchCode").html(batchCode);
	$("#batchSpan").show();
	$("#batchSpan").html(batchCode);
	$("#currencySpan").html(currencyText);
	document.getElementById('currencySpanLi').style.display = "block";
	$("#showBatchCode").show();
	$("#createTransactionLi").show();
	batchId = batch;
	$("#subDiv").empty();
	$("#numDiv").empty();
	$("#numA").show();
	$("#subA").show();
	$("#detailListDiv").show();
	$("#confirmDetailDiv").show();
	$("#examSubjectDiv").hide();
	$("#examNumberDiv").hide();
	document.getElementById('confirmDetailDiv').style.display = "block";
	$("#transactionId").val(id);
	$("#transactionCode").html(code);
	$("#totalAmount").html(amount);
	$("#currencyId").val();
	$('#transactionDetailList').datagrid('options')['url'] = '../batch/data/transaction.detail.retrieve.php?transaction_id='+id;
	$("#transactionDetailList").datagrid('load');
}

/*检查单号*/
function examNumber(){
	$("#numDiv").empty();
	$("#numA").show();
	$("#subA").show();
	$("#detailListDiv").hide();
	$("#confirmDetailDiv").hide();
	$("#examSubjectDiv").hide();
	$("#examNumberDiv").show();
	if(appendCheckNum){
		var subjectData = "";
		$.ajax({
			url: "../batch/data/transaction.retrieve.php?batch_ids="+batchId,
			type: 'get',
			async: false,
			dataTye: 'json',
			success: function (data) {
				numberData = eval('(' + data + ')');
			}
		})
		$("#numDiv").append('<div class="xmys_right_button" style="margin-right:-100px;"><ul><li class="xmys_button_download" style="margin-top: -10px;margin-right: 100px"><a  href="javascript:void(0)" onclick="ExcelNumFunction()"><em><img src="../images/icon_type.png"/></em>PDF</a></li></ul></div><br>');
		for (var i = 0; i < numberData.total; i++) {
			var amounts = "0.00";
			$("#numDiv").append("<div class='pcl_text_nav'><div class='pcl_nav_left'>"+BATCH_TRANSACTION_CODE+"<span>"+numberData.rows[i].transaction_code+"</span></div><div class='pcl_nav_right'>"+BATCH_TRANSACTION_AMOUNT+"<span>"+amounts+"</span></div><div id='"+numberData.rows[i].transaction_id+numberData.rows[i].transaction_code+"'></div></div>");
			$("#"+numberData.rows[i].transaction_id+numberData.rows[i].transaction_code).datagrid({
				autoHeight:true,
				title:'',
				idField:'all_code',
				singleSelect:true,
				fitColumns:false,
				url:'../batch/data/transaction.code.retrieve.php?transaction_ids='+numberData.rows[i].transaction_id,
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
				          {title:BATCH_NUM_DETAIL_DESC,field:'detail_desc',width:'53%',align: 'left',halign: 'center'},
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
	$("#examNumberDiv").hide();
	$("#examSubjectDiv").show();
    if(appendCheckSub){
		var subjectData = "";
		$.ajax({
			url: "../batch/data/batch.code.retrieve.php?batch_ids="+batchId,
			type: 'get',
			async: false,
			dataTye: 'json',
			success: function (data) {
				subjectData = eval('(' + data + ')');
			}
		})
		$("#subDiv").append('<div class="xmys_right_button" style="margin-right:-100px;"><ul><li class="xmys_button_download" style="margin-top: -10px;margin-right: 100px"><a  href="javascript:void(0)" onclick="ExcelSubFunction()"><em><img src="../images/icon_type.png"/></em>PDF</a></li></ul></div><br>');
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
				url:'../batch/data/transaction.detail.retrieve.php?batch_ids='+subjectData.rows[i].batch_id+'&main_codes='+subjectData.rows[i].main_code+'&sub_codes='+subjectData.rows[i].sub_code,
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
						if(amounts != 0){
							$("#"+data.rows[0].main_code+data.rows[0].sub_code).html("<span style='color:red'>"+amounts+"</span>");
						}else{
							$("#"+data.rows[0].main_code+data.rows[0].sub_code).html(amounts);
						}
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

/*资产勾选框*/
function assetClick(index){
	var asset = document.getElementsByName("asset"+index)[0];
	if(asset.checked == true){
		$('#transactionDetailList').datagrid('getRows')[index].is_asset = "1";
	}else{
		$('#transactionDetailList').datagrid('getRows')[index].is_asset = "0";
	}
}

/*导出单号*/
function ExcelNumFunction(){
	/*showLoader();
	$.ajax({
		type:'POST',
		url:'../batch/data/batch.num.export.php?batch_ids='+batchId+'&language='+language,
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
	});*/
	window.open("data/report.pdf.php?report_type=8&batch_ids=" + batchId + "&language=" + language, "_blank");
}

/*导出科目*/
function ExcelSubFunction(){
	/*showLoader();
	$.ajax({
		type:'POST',
		url:'../batch/data/batch.sub.export.php?batch_ids='+batchId+'&language='+language,
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
	});*/
	window.open("data/report.pdf.php?report_type=7&batch_ids=" + batchId + "&language=" + language, "_blank");
}

/*获取高度*/
function getGridHeight(){
	var height1 = $("#_title").height();
	var height2 = $("#_query").height() ;
	var height = document.compatMode=="CSS1Compat"?document.documentElement.clientHeight:document.body.clientHeight;
	return height - height2 - height1 - 100;
}
