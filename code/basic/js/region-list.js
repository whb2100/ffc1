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
		url:'data/region.retrieve.php?create='+userId+'&project_ids='+projectId,
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
		    textKeyup1(index);
		},
		columns:[[
		          {title:BASIC_REGION_CODE,field:'region_code',  width: '39%', align: 'left',halign: 'center',
		              editor: { type: 'textbox', options: {height:g_editor_cell_height}}
		          },
		          {title:BASIC_REGION_NAME,field:'region_name',  width: '39%', align: 'left',halign: 'center',
		        	  editor: { type: 'textbox', options: {height:g_editor_cell_height}}
		          },
		          {title:BASIC_SET,field:BASIC_SET,  width: '20%', align: 'center',
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
	
	if(trim(row.region_code) == null || trim(row.region_name) == null || trim(row.region_code) == "" || trim(row.region_name) == ""){
		$.messager.alert(BASSIC_MESSAGE , BASSIC_NULL_MESSAGE);
		$("#itemList").datagrid("beginEdit", index);
		textKeyup2(index);
		return;
	}
	
	if(row.region_code.length != 3 || isNaN(row.region_code)){
		$.messager.alert(BASSIC_MESSAGE , BASIC_REGION_CODE_MESSAGE);
		$("#itemList").datagrid("beginEdit", index);
		textKeyup2(index);
		return;
	}
	
	if(row.a == undefined){
		var isrepeatUpdate = false;
		$.ajax({
			url: "data/region.retrieve.php?region_codes="+row.region_code+"&project_ids="+projectId,
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
			url: "data/region.retrieve.php?region_codes="+row.region_code+'&record_ids='+row.record_id+"&project_ids="+projectId,
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
	    	$.messager.alert(BASSIC_MESSAGE , BASIC_REGION_REPEAT_MESSAGE);
			$("#itemList").datagrid("beginEdit", index);
			textKeyup2(index);
			return;
	    }
		
		var url = 'data/region.update.php';
		$.post(url, {record_id : row.record_id, region_code : row.region_code , region_name : row.region_name},function(data){
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
		var isrepeat = false;
		$.ajax({
			url: "data/region.retrieve.php?region_codes="+row.region_code+"&project_ids="+projectId,
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
	    	$.messager.alert(BASSIC_MESSAGE , BASIC_REGION_REPEAT_MESSAGE);
			$("#itemList").datagrid("beginEdit", index);
			textKeyup2(index);
			return;
	    }
		
		var url = 'data/region.create.php';
		$.post(url, {region_code : row.region_code , region_name : row.region_name , project_id : projectId},function(data){
			var data = eval("(" + data + ")");
			/*if (data.result == "10000") {
				$.messager.alert(BASSIC_MESSAGE, BASSIC_SUCCESSFUL_OPERATION);
				$("#itemList").datagrid("reload");
			}else {
				$.messager.alert(BASSIC_MESSAGE, BASSIC_OPERATION_FAILED);
			}*/
			if (data.result == RESULT_CODE_SUCCESS) {
				$.messager.alert(BASSIC_MESSAGE, data.msg);
				//$("#itemList").datagrid("reload");
				var index=$('#itemList').datagrid('appendRow', {}).datagrid('getRows').length-1;
				$('#itemList').datagrid('beginEdit',index);
				$('#itemList').datagrid('getRows')[index].a = "1";
				textKeyup1(index);
			} else {
				checkResult(data);
			}
		});
	}
}

/*修改*/
function updateItem(index){
	$("#itemList").datagrid("beginEdit", index);
	textKeyup2(index);
}

function textKeyup1(index) {
	var editors = $('#itemList').datagrid('getEditors', index);
	var editor = editors[0];
	$(editor.target).textbox('textbox').keyup(function (e) {		
		var value = $(editor.target).textbox('getText');
		if (value != null && value.length >= 3) {
			$(editors[1].target).textbox('textbox').focus();
			/*var e = jQuery.Event("keydown");
			e.which = 9;
			$(window).trigger(e);*/
		}
	});
	$(editor.target).textbox('setText', '000');
	var editor1 = editors[1];
	$(editor1.target).textbox('setText', 'DEFAULT');
}

function textKeyup2(index) {
	var editors = $('#itemList').datagrid('getEditors', index);
	var editor = editors[0];
	$(editor.target).textbox('textbox').keyup(function (e) {		
		var value = $(editor.target).textbox('getText');
		if (value != null && value.length >= 3) {
			$(editors[1].target).textbox('textbox').focus();
			/*var e = jQuery.Event("keydown");
			e.which = 9;
			$(window).trigger(e);*/
		}
	});
//	$(editor.target).textbox('setText', '000');
//	var editor1 = editors[1];
//	$(editor1.target).textbox('setText', 'DEFAULT');
}

/*导出*/
function ExcleFunction(){
	showLoader();
	$.ajax({
		type:'POST',
		url:'data/region.export.php?project_ids='+projectId+'&language='+language,
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
