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
		singleSelect:true,
		url:'data/code.retrieve.php?create='+userId+'&code_type=1'+'&project_ids='+projectId,
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
		    textKeyup2(index);
		},
		columns:[[
		          {title:BASIC_MAIN_CODE,field:'main_code',  width: '6%', align: 'left',halign: 'center',
		              editor: { type: 'textbox', options: {height:g_editor_cell_height}}
		          },
		          {title:BASIC_SUB_CODE,field:'sub_code',  width: '4%', align: 'left',halign: 'center',
		              editor: { type: 'textbox', options: {height:g_editor_cell_height}}
		          },
		          {title:'描述',field:'code_desc_zh',  width: '25%', align: 'left',halign: 'center',
		        	  editor: { type: 'textbox', options: {height:g_editor_cell_height}}
		          },
		          {title:'DESCRIPTION',field:'code_desc_en',  width: '25%', align: 'left',halign: 'center',
		        	  editor: { type: 'textbox', options: {height:g_editor_cell_height}}
		          },
		          {title:BASIC_AMOUNT,field:'amount',  width: '8%', align: 'right',halign: 'center',
					  formatter:function(value,rowData,rowIndex){
						  return '0.00';
					  }
		          },
		          {title:BASIC_STATISTICS_LEVEL_ID, field:'statistics_level_id' , width:'10%' , align:'center' , editor:{  
					      type: 'combobox',  
					      options: {
					      		height:g_editor_cell_height,
					         data: [
									{statistics_level_id:'1' , text:BASIC_STATISTICS_LEVEL1},
									{statistics_level_id:'2', text:BASIC_STATISTICS_LEVEL2},
									{statistics_level_id:'3', text:BASIC_STATISTICS_LEVEL3}
								],
					         valueField: "statistics_level_id",  
					         textField: "text",  
					         editable: true,  
					         panelHeight:85
					     }
					  },
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
	
	if(row.statistics_level_id == undefined || trim(row.main_code) == null || trim(row.sub_code) == null || trim(row.code_desc_zh) == null || trim(row.code_desc_en) == null || trim(row.statistics_level_id) == null || trim(row.main_code) == "" || trim(row.sub_code) == "" || trim(row.code_desc_zh) == "" || trim(row.code_desc_en) == "" || trim(row.statistics_level_id) == ""){
		$.messager.alert(BASSIC_MESSAGE , BASSIC_NULL_MESSAGE);
		$("#itemList").datagrid("beginEdit", index);
		textKeyup(index);
		return;
	}
	
	if(isNaN(row.main_code) || isNaN(row.sub_code)){
		$.messager.alert(BASSIC_MESSAGE , BASIC_MAIN_CODE_MESSAGE1);
		$("#itemList").datagrid("beginEdit", index);
		textKeyup(index);
		return;
	}
	
	if(row.statistics_level_id == 1 && row.main_code.length != 1){
		$.messager.alert(BASSIC_MESSAGE , BASIC_MAIN_CODE_MESSAGE1);
		$("#itemList").datagrid("beginEdit", index);
		textKeyup(index);
		return;
	}
	
	if(row.statistics_level_id > 1 && row.main_code.length != 4){
		$.messager.alert(BASSIC_MESSAGE , BASIC_MAIN_CODE_MESSAGE2);
		$("#itemList").datagrid("beginEdit", index);
		textKeyup(index);
		return;
	}
	
	if(row.sub_code.length != 3){
		$.messager.alert(BASSIC_MESSAGE , BASIC_SUB_CODE_MESSAGE);
		$("#itemList").datagrid("beginEdit", index);
		textKeyup(index);
		return;
	}
	
	if(row.a == undefined){
		var isrepeatUpdate = false;
		$.ajax({
			url: "data/code.retrieve.php?main_codes="+row.main_code+"&sub_codes="+row.sub_code+"&project_ids="+projectId,
	        type: 'get',
	        async: false,
	        dataTye: 'json',
	        success: function (data) {
	        	data = eval('(' + data + ')');
	        	if(data.total > 0){
	        		isrepeatUpdate = true;
	        	}
	        }
	    })
	    
		$.ajax({
			url: "data/code.retrieve.php?main_codes="+row.main_code+"&sub_codes="+row.sub_code+'&record_ids='+row.record_id+"&project_ids="+projectId,
	        type: 'get',
	        async: false,
	        dataTye: 'json',
	        success: function (data) {
	        	data2 = eval('(' + data + ')');
	        	if(data2.rows[0] != undefined){
	        		isrepeatUpdate = false;
	        	}
	        }
	    })
		
	    if(isrepeatUpdate){
	    	$.messager.alert(BASSIC_MESSAGE , BASIC_MAIN_CODE_REPEAT_MESSAGE);
			$("#itemList").datagrid("beginEdit", index);
			textKeyup(index);
			return;
	    }
		
		var url = 'data/code.update.php';
		$.post(url, {record_id : row.record_id, main_code : row.main_code , sub_code : row.sub_code , code_desc_zh : row.code_desc_zh , code_desc_en : row.code_desc_en , statistics_level_id : row.statistics_level_id},function(data){
			var data = eval("(" + data + ")");
			if (data.result == RESULT_CODE_SUCCESS) {
				$.messager.alert(BASSIC_MESSAGE, data.msg);
				$("#itemList").datagrid("reload");
			} else {
				checkResult(data);
			}
		});
	}else{
		var isrepeat = false;
		$.ajax({
			url: "data/code.retrieve.php?main_codes="+row.main_code+"&sub_codes="+row.sub_code+"&project_ids="+projectId,
	        type: 'get',
	        async: false,
	        dataTye: 'json',
	        success: function (data) {
	        	data = eval('(' + data + ')');
	        	if(data.total > 0){
	        		isrepeat = true;
	        	}
	        }
	    })
	    
	    if(isrepeat){
	    	$.messager.alert(BASSIC_MESSAGE , BASIC_MAIN_CODE_REPEAT_MESSAGE);
			$("#itemList").datagrid("beginEdit", index);
			textKeyup(index);
			return;
	    }
		
		var url = 'data/code.create.php';
		$.post(url, {main_code : row.main_code , sub_code : row.sub_code , code_desc_zh : row.code_desc_zh , code_desc_en : row.code_desc_en , amount : 0 , statistics_level_id : row.statistics_level_id , project_id : projectId , code_type : 1},function(data){
			var data = eval("(" + data + ")");
			if (data.result == RESULT_CODE_SUCCESS) {
				$.messager.alert(BASSIC_MESSAGE, data.msg);
				//$("#itemList").datagrid("reload");
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
	//resizeEditor($('#itemList').datagrid('getEditors', index));
	textKeyup(index);
}

function textKeyup(index) {
	var editors = $('#itemList').datagrid('getEditors', index);
	var editor = editors[0];
	$(editor.target).textbox('textbox').keyup(function (e) {
		var value = $(editor.target).textbox('getText');
		if (value != null && value.length >= 4) {
			$(editors[1].target).textbox('textbox').focus();
		}
	});
//	$(editor.target).textbox('setText', '9');
	var editor1 = editors[1];
	$(editor1.target).textbox('textbox').keyup(function (e) {		
		var value = $(editor1.target).textbox('getText');
		if (value != null && value.length >= 3) {
			$(editors[2].target).textbox('textbox').focus();
		}
	});
//	$(editor1.target).textbox('setText', '000');
//	var editor2 = editors[2];
//	$(editor2.target).textbox('setText', '资金账户');
//	var editor3 = editors[3];
//	$(editor3.target).textbox('setText', 'BALANCE ACCOUNT');
//	var editor4 = editors[4];
//	$(editor4.target).combobox('select', 1);
}

function textKeyup2(index) {
	var editors = $('#itemList').datagrid('getEditors', index);
	var editor = editors[0];
	$(editor.target).textbox('textbox').keyup(function (e) {
		var value = $(editor.target).textbox('getText');
		if (value != null && value.length >= 4) {
			$(editors[1].target).textbox('textbox').focus();
		}
	});
	$(editor.target).textbox('setText', '9');
	var editor1 = editors[1];
	$(editor1.target).textbox('textbox').keyup(function (e) {		
		var value = $(editor1.target).textbox('getText');
		if (value != null && value.length >= 3) {
			$(editors[2].target).textbox('textbox').focus();
		}
	});
	$(editor1.target).textbox('setText', '000');
	var editor2 = editors[2];
	$(editor2.target).textbox('setText', '资金账户');
	var editor3 = editors[3];
	$(editor3.target).textbox('setText', 'BALANCE ACCOUNT');
	var editor4 = editors[4];
	$(editor4.target).combobox('select', 1);
}

/*导出*/
function ExcleFunction(){
	showLoader();
	$.ajax({
		type:'POST',
		url:'data/code.export.php?project_ids='+projectId+'&code_type=1'+'&language='+language,
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
