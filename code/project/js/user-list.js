$(function(){
	var projectId = $('#projectId').val();
	var code = $('#code').val();
	$("#userList").datagrid({
		height:getGridHeight(),
		width:'91%',
		title:'',
		idField:'user_id',
//		fitColumns:true, 
		singleSelect:true,
		url:'data/user.retrieve.php?project_id='+projectId,
		loadMsg:'',
		striped:true,
		pagination:true,
		pageSize:20,
		pageList:[20,50,100],
		rownumbers:true,
		onBeforeLoad:showLoader,
		onLoadSuccess:removeLoader,
		columns:[[
		          {title:LAN_USER_EMPCODE,field:'user_empcode',width:'15%',align:'center',sortable:true},
		          {title:LAN_POSITION_NAME,field:'position_name',  width:'15%', align: 'center',sortable:true},
		          {title:LAN_USER_STATUS_NAME,field:'user_status_name',  width: '15%', align: 'center',sortable:true},
		          {title:LAN_USER_REALNAME,field:'user_realname',  width: '15%', align: 'center',sortable:true},
		          {title:LAN_CREATE_DATE,field:'create_date',  width: '15%', align: 'center',sortable:true},
		          {title:LAN_SET,field:LAN_SET,  width: '23%', align: 'center',
			  	formatter:function(value, row, index) {
			  		return "<div class='icon'><span><a href='user-update.php?formProjectId="+projectId+"&formUserId="+row.user_id+"&code="+code+"'><img src='../images/icon_set_blue.png'/>"+LAN_UPDATE+"</a> </span></div>";
				}
			  }
		          ]]
	});
	
})

/*获取高度*/
function getGridHeight(){
	var height1 = $("#_title").height();
	var height2 = $("#_query").height() ;
	var height = document.compatMode=="CSS1Compat"?document.documentElement.clientHeight:document.body.clientHeight;
	return height - height2 - height1 - 100;
}


// 导出
function ExcleFunction() {
	var projectId = $('#projectId').val();
	showLoader();
	$.ajax({
		type:'POST',
		url:'data/user.exportExcel.php',
		data:{project_id:projectId},
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