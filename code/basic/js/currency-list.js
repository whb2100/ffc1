var projectId = $("#projectId").val();
var userId = $("#userId").val();
var language = $("#language").val();

$(function(){
	var datagrid; //定义全局变量datagrid
    var editRow = undefined; //定义全局变量：当前编辑的行
    datagrid = $("#itemList").datagrid({
		height:getGridHeight(),
		width:'91%',
		title:'',
		idField:'record_id',
//		fitColumns:true, 
		singleSelect:true,
		url:'data/currency.retrieve.php?create='+userId+'&project_ids='+projectId+'&language='+language,
		loadMsg:'',
		pagination:true,
		pageSize:20,
		pageList:[20,50,100],
//		rownumbers:true,
		onLoadSuccess:removeLoader,
		onLoadSuccess : function() {
			removeLoader();
			var index=$('#itemList').datagrid('appendRow', {}).datagrid('getRows').length-1;
		    $('#itemList').datagrid('beginEdit',index);
		    $('#itemList').datagrid('getRows')[index].a = "1";
		    textKeyup(index);
		},
		columns:[[
				  {title:BASIC_CURRENCY_CODE_ID , field:'currency_code_id' , width:'10%' , align: 'left',halign: 'center', editor:{  
					      type: 'combobox',  
					      options: {
					      	 height:g_editor_cell_height,
					         url: "data/currency.code.retrieve.php",  
					         valueField: "currency_code_id",  
					         textField: "currency_code",  
					         editable: true,  
					         panelHeight:70
					      }
					  },
					  formatter:function(value,rowData,rowIndex){
						  if(rowData.currency_code == "00"){
							  return rowData.currency_code+BASIC_CURRENCY_MAIN_CODE;
						  }
						  if(rowData.currency_code != ""){
							  return rowData.currency_code;
						  }
					  }
				  },
				  {title:BASIC_CURRENCY_TYPE_ID , field:'currency_type' , width:'20%' , align: 'left',halign: 'center',
					  editor: { type: 'textbox', options: {height:g_editor_cell_height}}
				  },
		          {title:BASIC_EXCHANGE_RATE ,field:'exchange_rate',  width: '20%', align: 'right',halign: 'center',
		              editor: { type: 'textbox', options: {height:g_editor_cell_height}},
					  formatter:function(value,rowData,rowIndex){
						  if(value == "" || value == null){
							  return "0.000000"
						  }else{
							  return value;
						  }
					  }
				  },
		          {title:BASIC_CURRENCY_DESC ,field:'currency_desc',  width: '28%', align: 'left',halign: 'center',
		              editor: { type: 'textbox', options: {height:g_editor_cell_height}}
		          },
		          {title:BASIC_SET ,field:BASIC_SET ,  width: '20%', align: 'center',
		        	  formatter:function(value, row, index) {
				  		  return "<div class='basic_coin_icon'><span><p><a href='javascript:void(0)' onclick='createItem("+index+")'><img src='../images/icon_qd_blue.png'/>"+BASIC_CONFIRM+"</a></p> <p2><a href='javascript:void(0)' onclick='updateItem("+index+")'><img src='../images/icon_xiugai.png'/>"+BASIC_UPDATE+"</a><p2></span></div>";
		        	  }
				  }
          ]],
//          toolbar: [{ text:BASIC_ADD, iconCls: 'icon-add', handler: function () {
//	              datagrid.datagrid("insertRow", {
//	                  index: 0,
//	                  row: {
//	                  }
//	              });
//	              datagrid.datagrid("beginEdit", 0);
//	              editRow = 0;
//	              enableSubmit = true;
//	          }
//          }, '-'],
          onAfterEdit: function (rowIndex, rowData, changes) {
              editRow = undefined;
          },
          onDblClickRow: function (rowIndex, rowData) {
          	//双击开启编辑行
//        	  needUpdate = true;
//              datagrid.datagrid("beginEdit", rowIndex);
//              editRow = rowIndex;
          }
      });
//    $('#itemList').datagrid('getPanel').removeClass('lines-both lines-no lines-right lines-bottom').addClass(cls);
})

/*重新加载表格*/
function reloadgrid(){
	$("#itemList").datagrid('reload',{
		
	})
}

/*保存*/
function createItem(index){
	$("#itemList").datagrid("acceptChanges");
	var row = $('#itemList').datagrid('getRows')[index];
	var rows = $('#itemList').datagrid('getData');
//	if(index == 0 && row.currency_code_id != 1){
//		$.messager.alert(BASSIC_MESSAGE , MAIN_CURRENCY_CODE_MESSAGE);
//		$("#itemList").datagrid("reload");
//		$("#itemList").datagrid("beginEdit", index);
//		return;
//	}
	
	if(row.currency_code_id == undefined || trim(row.currency_code_id) == null || trim(row.currency_type) == null || trim(row.exchange_rate) == null || trim(row.currency_desc) == null || trim(row.currency_code_id) == "" || trim(row.currency_type) == "" || trim(row.exchange_rate) == "" || trim(row.currency_desc) == ""){
		$.messager.alert(BASSIC_MESSAGE , BASSIC_NULL_MESSAGE);
		$("#itemList").datagrid("beginEdit", index);
		return;
	}
	
	if(isNaN(row.exchange_rate)){
		$.messager.alert(BASSIC_MESSAGE , BASIC_EXCHANGE_RATE_MESSAGE);
		$("#itemList").datagrid("beginEdit", index);
		return;
	}
    
	if(row.a == undefined){
		var isrepeatUpdateCode = false;
		$.ajax({
			url: "data/currency.retrieve.php?code_id="+row.currency_code_id+"&project_ids="+projectId,
	        type: 'get',
	        async: false,
	        dataTye: 'json',
	        success: function (data) {
	        	data = eval('(' + data + ')');
	        	if(data.total > 0){
	        		isrepeatUpdateCode = true;
	        	}
	        }
	    })
		$.ajax({
			url: "data/currency.retrieve.php?code_id="+row.currency_code_id+'&record_ids='+row.record_id+"&project_ids="+projectId,
	        type: 'get',
	        async: false,
	        dataTye: 'json',
	        success: function (data) {
	        	data2 = eval('(' + data + ')');
	        	if(data2.rows[0] != undefined){
	        		isrepeatUpdateCode = false;
	        	}
	        }
	    })
//	    var isrepeatUpdateType = false;
//		$.ajax({
//			url: "data/currency.retrieve.php?type_id="+row.currency_type_id+"&project_ids="+projectId,
//			type: 'get',
//			async: false,
//			dataTye: 'json',
//			success: function (data) {
//				data = eval('(' + data + ')');
//				if(data.total > 0){
//					isrepeatUpdateType = true;
//				}
//			}
//		})
//		$.ajax({
//			url: "data/currency.retrieve.php?type_id="+row.currency_type_id+'&record_ids='+row.record_id+"&project_ids="+projectId,
//			type: 'get',
//			async: false,
//			dataTye: 'json',
//			success: function (data) {
//				data2 = eval('(' + data + ')');
//				if(data2.rows[0] != undefined){
//					isrepeatUpdateType = false;
//				}
//			}
//		})
		
	    if(isrepeatUpdateCode){
	    	$.messager.alert(BASSIC_MESSAGE , BASIC_CURRENCY_CODE_REPEAT_MESSAGE);
			$("#itemList").datagrid("beginEdit", index);
			return;
	    }
//		if(isrepeatUpdateType){
//			$.messager.alert(BASSIC_MESSAGE , BASIC_CURRENCY_TYPE_REPEAT_MESSAGE);
//			$("#itemList").datagrid("beginEdit", index);
//			return;
//		}
		
		var url = 'data/currency.update.php';
		$.post(url, {record_id : row.record_id, currency_code_id : row.currency_code_id , currency_type1 : row.currency_type , currency_type_id : row.currency_type_id , exchange_rate : row.exchange_rate , currency_desc : row.currency_desc},function(data){
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
	}else{
		var isrepeatCode = false;
		$.ajax({
			url: "data/currency.retrieve.php?code_id="+row.currency_code_id+"&project_ids="+projectId,
	        type: 'get',
	        async: false,
	        dataTye: 'json',
	        success: function (data) {
	        	data = eval('(' + data + ')');
	        	if(data.total > 0){
	        		isrepeatCode = true;
	        	}
	        }
	    })
//	    var isrepeatType = false;
//		$.ajax({
//			url: "data/currency.retrieve.php?type_id="+row.currency_type_id+"&project_ids="+projectId,
//			type: 'get',
//			async: false,
//			dataTye: 'json',
//			success: function (data) {
//				data = eval('(' + data + ')');
//				if(data.total > 0){
//					isrepeatType = true;
//				}
//			}
//		})
	    
	    if(isrepeatCode){
	    	$.messager.alert(BASSIC_MESSAGE , BASIC_CURRENCY_CODE_REPEAT_MESSAGE);
			$("#itemList").datagrid("beginEdit", index);
			return;
	    }
//		if(isrepeatType){
//			$.messager.alert(BASSIC_MESSAGE , BASIC_CURRENCY_TYPE_REPEAT_MESSAGE);
//			$("#itemList").datagrid("beginEdit", index);
//			return;
//		}
		
		var url = 'data/currency.create.php';
		$.post(url, {currency_code_id : row.currency_code_id , currency_type1 : row.currency_type , exchange_rate : row.exchange_rate , currency_desc : row.currency_desc , project_id : projectId},function(data){
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
				var index=$('#itemList').datagrid('appendRow', {}).datagrid('getRows').length-1;
				$('#itemList').datagrid('beginEdit',index);
				$('#itemList').datagrid('getRows')[index].a = "1";
				textKeyup(index);
			} else {
				checkResult(data);
			}
		});
	}
}

/*修改*/
function updateItem(index){
	$("#itemList").datagrid("beginEdit", index);
}

function textKeyup(index) {
	var editors = $('#itemList').datagrid('getEditors', index);
	var editor = editors[2];
	$(editor.target).textbox('setText', '0.000000');
}

/*导出*/
function ExcleFunction(){
	showLoader();
	$.ajax({
		type:'POST',
		url:'data/currency.export.php?project_ids='+projectId+'&language='+language,
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

/*获取高度*/
function getGridHeight(){
	var height1 = $("#_title").height();
	var height2 = $("#_query").height() ;
	var height = document.compatMode=="CSS1Compat"?document.documentElement.clientHeight:document.body.clientHeight;
	return height - height2 - height1 - 100;
}
