var projectId = $("#projectId").val();
var userId = $("#userId").val();
$("#projectIds").val(projectId);
$("#pName").html(currentProjectName+">");

function textKeyup(index) {
	var editors = $('#itemList').datagrid('getEditors', index);
	var editor = editors[0];
	$(editor.target).textbox('textbox').keyup(function (e) {		
		var value = $(editor.target).textbox('getText');
		if (value != null && value.length >= 4) {
			$(editors[1].target).textbox('textbox').focus();
		}
	});
	var editor1 = editors[1];
	$(editor1.target).textbox('textbox').keyup(function (e) {		
		var value = $(editor1.target).textbox('getText');
		if (value != null && value.length >= 3) {
			$(editors[2].target).textbox('textbox').focus();
		}
	});
}

$(function(){
	var datagrid; //定义全局变量datagrid
    var editRow = undefined; //定义全局变量：当前编辑的行
    datagrid = $("#itemList").datagrid({
		height:getGridHeight(),
		width:'91%',
		title:'',
		idField:'record_id',
		singleSelect:true,
//		url:'data/budget.retrieve.php',
		// url:'data/etc.retrieve.php?project_ids='+projectId,
		url:'../basic/data/code.retrieve.php?code_type=2&statistics_level_id=3&project_ids='+projectId,
		loadMsg:'',
		pagination:true,
		pageSize:20,
		pageList:[20,50,100],
//		rownumbers:true,
		onLoadSuccess:removeLoader,
		// onLoadSuccess : function() {
		// 	removeLoader();
		// 	var index=$('#itemList').datagrid('appendRow', {}).datagrid('getRows').length-1;
		//     $('#itemList').datagrid('beginEdit',index);
		//     $('#itemList').datagrid('getRows')[index].a = "1";
		//     textKeyup(index);
		// },
		columns:[[
		          {title:BASIC_MAIN_CODE,field:'main_code',  width: '12%', align: 'left',halign: 'center'},
		          {title:BASIC_SUB_CODE,field:'sub_code',  width: '10%',halign: 'center', align: 'left'},
		          {title:'描述',field:'code_desc_zh',  width: '20%',halign: 'center', align: 'left'},
		          {title:'DESCRIPTION',field:'code_desc_en',  width: '20%',halign: 'center', align: 'left'},	
		          {title:BASIC_AMOUNT,field:'last_amount',  width: '10%', align: 'right',halign: 'center',
		        	  editor: { type: 'textbox', options: {height:g_editor_cell_height}
		        		},
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
		         {title:BASIC_STATISTICS_LEVEL_ID, field:'statistics_level_id' , width:'10%' , align:'center' ,
					  formatter:function(value,rowData,rowIndex){
						  if(value != null){
							  return BASIC_STATISTICS_LEVEL+" "+value;
						  }
					  }
			 },
		          {title:BASIC_SET,field:BASIC_SET,  width: '20%', align: 'center',
		        	  formatter:function(value, row, index) {
		        		  return "<div class='basic_coin_icon'><span><p><a href='javascript:void(0)' onclick='createItem("+index+")'><img src='../images/icon_qd_blue.png'/>"+BASIC_CONFIRM+"</a></p> <p2><a href='javascript:void(0)' onclick='updateItem("+index+")'><img src='../images/icon_xiugai.png'/>"+BASIC_UPDATE+"</a><p2></span></div>";
		        	  }
				  }
          ]],
          onAfterEdit: function (rowIndex, rowData, changes) {
              editRow = undefined;
          }
      });
})

/*保存*/
function createItem(index){
	$("#itemList").datagrid("acceptChanges");
	var row = $('#itemList').datagrid('getRows')[index];
	var rows = $('#itemList').datagrid('getData');
	
//	if(row.main_code == null || row.sub_code == null || row.code_desc_zh == null   ||   row.code_desc_en == null ||  trim(row.amount) == null || row.statistics_level_id == null || row.main_code == "" || row.sub_code == "" || row.code_desc_zh == ""   || row.code_desc_en == "" || trim(row.amount) == "" || row.statistics_level_id == ""){
	if(trim(row.last_amount) == null || trim(row.last_amount) == "" || isNaN(row.last_amount)){
		$.messager.alert(BASSIC_MESSAGE , ETC_MESSAGE2);
		$("#itemList").datagrid("beginEdit", index);
		textKeyup(index);
		return;
	}

	// if(isNaN(row.main_code) || isNaN(row.sub_code)){
	// 	$.messager.alert(BASSIC_MESSAGE , BASIC_MAIN_CODE_MESSAGE1);
	// 	$("#itemList").datagrid("beginEdit", index);
	// 	textKeyup(index);
	// 	return;
	// }
	
	// if(row.statistics_level_id == 1 && row.main_code.length != 1){
	// 	$.messager.alert(BASSIC_MESSAGE , BASIC_MAIN_CODE_MESSAGE1);
	// 	$("#itemList").datagrid("beginEdit", index);
	// 	textKeyup(index);
	// 	return;
	// }
	
	// if(row.statistics_level_id > 1 && row.main_code.length != 4){
	// 	$.messager.alert(BASSIC_MESSAGE , BASIC_MAIN_CODE_MESSAGE2);
	// 	$("#itemList").datagrid("beginEdit", index);
	// 	textKeyup(index);
	// 	return;
	// }
	
	// if(row.sub_code.length != 3){
	// 	$.messager.alert(BASSIC_MESSAGE , BASIC_SUB_CODE_MESSAGE);
	// 	$("#itemList").datagrid("beginEdit", index);
	// 	textKeyup(index);
	// 	return;
	// }
	
	// var times = 0;
	// for(var i=0;i<rows.total;i++){
	// 	if(row.main_code+row.sub_code == rows.rows[i].main_code+rows.rows[i].sub_code){
	// 		times++;
	// 	}
	// }
	// if(times > 1){
	// 	$.messager.alert(BASSIC_MESSAGE , BASIC_MAIN_CODE_REPEAT_MESSAGE);
	// 	$("#itemList").datagrid("beginEdit", index);
	// 	textKeyup(index);
	// 	return;
	// }
	
	// var iscreate = false;
	// $.ajax({
	// 	url: "../basic/data/code.retrieve.php?code_type=2&main_codes="+row.main_code+"&sub_codes="+row.sub_code+"&project_ids="+projectId+"&code_type=2",
	// 	type: 'get',
	// 	async: false,
	// 	dataTye: 'json',
	// 	success: function (data) {
	// 		data = eval('(' + data + ')');
	// 		if(data.total < 1){
	// 			iscreate = true;
	// 		}
	// 	}
	// })
	
 //    if(iscreate){
 //    	$.messager.alert(BASSIC_MESSAGE , ETC_MESSAGE1);
	// 	$("#itemList").datagrid("beginEdit", index);
	// 	textKeyup(index);
	// 	return;
 //    }
	
//	if(row.a == undefined){
//		var isrepeatUpdate = false;
//		
//		$.ajax({
//			url: "../basic/data/code.retrieve.php?code_type=2&main_codes="+row.main_code+"&sub_codes="+row.sub_code+"&project_ids="+projectId,
//	        type: 'get',
//	        async: false,
//	        dataTye: 'json',
//	        success: function (data) {
//	        	data = eval('(' + data + ')');
//	        	if(data.total > 0){
//	        		isrepeatUpdate = true;
//	        	}
//	        }
//	    })
//	    
//		$.ajax({
//			url: "../basic/data/code.retrieve.php?code_type=2&main_codes="+row.main_code+"&sub_codes="+row.sub_code+'&record_ids='+row.record_id+"&project_ids="+projectId,
//	        type: 'get',
//	        async: false,
//	        dataTye: 'json',
//	        success: function (data) {
//	        	data2 = eval('(' + data + ')');
//	        	if(data2.rows[0] != undefined){
//	        		isrepeatUpdate = false;
//	        	}
//	        }
//	    })
//		
//	    if(isrepeatUpdate){
//	    	$.messager.alert(BASSIC_MESSAGE , BASIC_MAIN_CODE_REPEAT_MESSAGE);
//			$("#itemList").datagrid("beginEdit", index);
//			textKeyup(index);
//			return;
//	    }
		
//		 checkCode(row,2);
		var url = '../basic/data/code.update.php';
		$.post(url, {record_id : row.record_id, last_amount : row.last_amount},function(data){
			var data = eval("(" + data + ")");
	        /*if (data.result == "10000") {
	        	$.messager.alert(BASSIC_MESSAGE, BASSIC_SUCCESSFUL_OPERATION);
	            $("#itemList").datagrid("reload");
	        }else {
	        	$.messager.alert(BASSIC_MESSAGE, BASSIC_OPERATION_FAILED);
	        }*/
			if (data.result == RESULT_CODE_SUCCESS) {
				$.messager.alert(BASSIC_MESSAGE, data.msg);
				 $("#itemList").datagrid("reload");
			} else {
				checkResult(data);
			}
		});
//	}else{
//		var isrepeat = false;
//		$.ajax({
//			url: "../basic/data/code.retrieve.php?code_type=2&main_codes="+row.main_code+"&sub_codes="+row.sub_code+"&project_ids="+projectId,
//	        type: 'get',
//	        async: false,
//	        dataTye: 'json',
//	        success: function (data) {
//	        	data = eval('(' + data + ')');
//	        	if(data.total > 0){
//	        		isrepeat = true;
//	        	}
//	        }
//	    })
//	    
//	    if(isrepeat){
//	    	$.messager.alert(BASSIC_MESSAGE , BASIC_MAIN_CODE_REPEAT_MESSAGE);
//			$("#itemList").datagrid("beginEdit", index);
//			textKeyup(index);
//			return;
//	    }
//		
////		 checkCode(row,1);
//		var url = '../basic/data/code.create.php?code_type=2&main_codes=';
//		$.post(url, {main_code : row.main_code , sub_code : row.sub_code , code_desc_zh : row.code_desc_zh ,  code_desc_en : row.code_desc_en , last_amount : row.last_amount , statistics_level_id : row.statistics_level_id , project_id : projectId},function(data){
//			var data = eval("(" + data + ")");
//	        /*if (data.result == "10000") {
//	        	$.messager.alert(BASSIC_MESSAGE, BASSIC_SUCCESSFUL_OPERATION);
//	            $("#itemList").datagrid("reload");
//	        }else {
//	        	$.messager.alert(BASSIC_MESSAGE, BASSIC_OPERATION_FAILED);
//	        }*/
//			if (data.result == RESULT_CODE_SUCCESS) {
//				$.messager.alert(BASSIC_MESSAGE, data.msg);
//				 //$("#itemList").datagrid("reload");
//				 var index=$('#itemList').datagrid('appendRow', {}).datagrid('getRows').length-1;
//				 $('#itemList').datagrid('beginEdit',index);
//				 textKeyup(index);
//			} else {
//				checkResult(data);
//			}
//		});
//	}
}

// //验证唯一性
//function checkCode(row,num){
// 	 $.ajax({
//	        url: "../basic/data/code.retrieve.php?main_code="+rows.main_code+"&sub_code="+rows.sub_code+"&project_ids="+projectId,
//	        type: 'get',
//	        async: false,
//	        dataTye: 'json',
//	        success: function (data) {
//	        	data = eval('(' + data + ')');
//	        	if(data.total < num){
//	        		$.messager.alert(BASSIC_MESSAGE , NO_MATCH_CODE);
//	        		$("#itemList").datagrid("beginEdit", i);
//	        		textKeyup(i);
//	        		return;
//	        	}
//	        }
//	    })	
//}


/*修改*/
function updateItem(index){
	$("#itemList").datagrid("beginEdit", index);
}

//模板下载
function downloadModel(){
	window.location="../uploads/excelModel/etcModel.xls"; 
}

function importExcel(){
	$("#budgetsFile").click();
}


//导入EXCEL
function importBudgets(){
	var file = document.getElementById('budgetsFile').value;
	if(file == ""){
		$.messager.alert("提示信息", "请选择文件！");
		return;
	}
	showLoader();
	$("#budgetsFileForm").form("submit", {
		url:'data/etc.createByExcel.php',
		success: function (data) {
	      		var data = eval("(" + data + ")");
		          if (data.result == "10000") {
		    		removeLoader();
		    		$.messager.alert(BASSIC_MESSAGE, data.msg);
		    		$('#itemList').datagrid('reload');
		      
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
			          	$.messager.alert(BASSIC_MESSAGE, ETC_MESSAGE1);
		          }else{
		          		removeLoader();
			          	//$.messager.alert(BASSIC_MESSAGE, data.msg);
		          		checkResult(data);
		          }
    		}
  	});
}

//密码确认弹出框
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
				clearItem();
			}
		}
	})
}

//一键清零
function clearItem(){
	$.messager.confirm(BATCH_CONFIRM , BATCH_MESSAGE5,function(confirm){
        if (confirm){
        	$.post('data/etc.clear.php',{project_ids : projectId},function(data){
        		var data = eval('(' + data + ")");
        		if (data.result == RESULT_CODE_SUCCESS) {
        			$.messager.alert(BASSIC_MESSAGE, BASSIC_SUCCESSFUL_OPERATION);
        			$("#itemList").datagrid("reload");
        		} else {
        			checkResult(data);
        		}
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
// 导出
function ExcleFunction() {
	showLoader();
	$.ajax({
		type:'POST',
		url:'../basic/data/codes.exportExcelEtc.php?code_type=2&statistics_level_id=3'+'&project_ids='+projectId,
		// data:getItemParam(),
		async:true,
		cache:false,
		error:function() {
			removeLoader();
			$.messager.alert('提示信息', '导出失败！');
		},
		success:function(data) {
			removeLoader();
			var data = eval('(' + data + ')');
			if (data.result != '10000') {
				$.messager.alert('提示信息', data.msg);
			} else {
				window.open('../'+data.msg);
			}
		}
	});
}
function importExcel(){
	$("#budgetsFile").click();
}
//导入EXCEL
function importBudgets(){
	var file = document.getElementById('budgetsFile').value;
	if(file == ""){
		//$.messager.alert("提示信息", "请选择文件！");
		return;
	}
	showLoader();
	$("#budgetsFileForm").form("submit", {
		url:'../basic/data/amount.createByExcel.php',
		success: function (data) {
	      		var data = eval("(" + data + ")");
		          if (data.result == "10000") {
		    		removeLoader();
		    		$.messager.alert(BASSIC_MESSAGE, data.msg);
		    		$("#budgetsFile").val("");
		    		$('#itemList').datagrid('reload');
		      
		          }else if(data.result == "11001"){
			        	removeLoader();
			          	$.messager.alert(BASSIC_MESSAGE, LAN_EXCEL_CHOOSE);
		          }else if (data.result == "11002") {
		          		removeLoader();
			          	$.messager.alert(BASSIC_MESSAGE, LAN_EXCEL_NO_CODE);
		          }else if (data.result == "11003") {
		          		removeLoader();
			          	$.messager.alert(BASSIC_MESSAGE, LAN_EXCEL_REPEAT);
		          }else if (data.result == "11004") {
		          		removeLoader();
			          	$.messager.alert(BASSIC_MESSAGE, LAN_EXCEL_USED);
		          }else{
		          		removeLoader();
			          	//$.messager.alert(BASSIC_MESSAGE, data.msg);
		          		checkResult(data);
		          }
    		}
  	});
}