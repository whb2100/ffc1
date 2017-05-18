var projectId = $("#projectId").val();

$(function(){
    datagrid = $("#itemGrid").datagrid({
		height:getGridHeight(),
		width:'75%',
		title:'',
		idField:'batch_id',
		singleSelect:true,
//		fitColumns:true, 
		url:'data/batch.retrieve.php?status=2'+'&project_ids='+projectId,
		loadMsg:'',
		pagination:true,
		pageSize:20,
		pageList:[20,50,100],
		rownumbers:true,
		onBeforeLoad:showLoader,
		onLoadSuccess:removeLoader,
		columns:[[
		          {title:PO_LIST,field:'batch_id', checkbox:true},
		          {title:PO_LIST,field:'batch_code',  width: '33%', align: 'left',halign: 'center'},
		          {title:PO_CREATE_DATE,field:'create_date',  width: '33%', align: 'left',halign: 'center'},
		          {title:BASIC_SET,field:BASIC_SET,  width: '34%', align: 'center',
		        	  formatter:function(value, row, index) {
		        		  return "<div class='pocl_coin_icon'><span><p2><a href='javascript:void(0)' onclick='updateItem("+index+")'><img src='../images/icon_xiugai.png'/>"+PO_UPDATE+"</a><p2></span></div>";
		        	  }
				  }
          ]]
      });
})

//编辑
function updateItem(index){
	var row = $('#itemGrid').datagrid('getRows')[index];
	var url = "poInput-create.php?poHistoryId="+row.batch_id+"&poHistoryCode="+row.batch_code+"&poHistoryCurrencyType="+row.currency_type+"&showList=1"+"&poHistoryCurrencyCode="+row.currency_code+"&isHistory=1";
	location.href = url;
}

//一键清零
function clearItem(){
	var row = $('#itemGrid').datagrid('getSelected');
	if(row){
		$.messager.confirm(BATCH_CONFIRM , BATCH_MESSAGE5,function(confirm){
			if (confirm){
				$.post('data/poInput.clear.php',{batch_id : row.batch_id},function(data){
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
	}else{
		$.messager.alert(BASSIC_MESSAGE, PO_CLEAR);
	}
}

/*获取高度*/
function getGridHeight(){
	var height1 = $("#_title").height();
	var height2 = $("#_query").height() ;
	var height = document.compatMode=="CSS1Compat"?document.documentElement.clientHeight:document.body.clientHeight;
	return height - height2 - height1 - 100;
}