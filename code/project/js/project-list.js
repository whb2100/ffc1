var language = $("#language").val();

function getItemParam() {
	var arr = new Object();
	arr['start_date'] = $('#STARTDATE', window.parent.document).val();
	arr['end_date'] = $('#ENDDATE', window.parent.document).val();
	arr['pro_status'] = $('#PROSTATUS', window.parent.document).val();
	arr['pro'] = $('#PRO', window.parent.document).val();
	arr['pro_name'] = $('#proName', window.parent.document).val();
	return arr;
}

$(function(){
	var proName = $('#proName', window.parent.document).val();
	var pro = $('#PRO', window.parent.document).val();
	var proStatus = $('#PROSTATUS', window.parent.document).val();
	var startDate = $('#STARTDATE', window.parent.document).val();
	var endDate = $('#ENDDATE', window.parent.document).val();
	if(startDate != ""){
		startDate = formatEnDate(startDate);
	}
	if(endDate != ""){
		endDate = formatEnDate(endDate);
	}

	$("#projectList").datagrid({
		height:getGridHeight(),
		width:'91%',
		title:'',
		idField:'project_id',
//		fitColumns:true, 
		singleSelect:true,
		url:'data/project.search.php?pro='+pro+'&pro_status='+proStatus+'&start_date='+startDate+'&end_date='+endDate,
		queryParams:{pro_name:proName},
		loadMsg:'',
		striped:true,
		pagination:true,
		// multiSort:true,
		pageSize:20,
		pageList:[20,50,100],
		rownumbers:true,
		onBeforeLoad:showLoader,
		onLoadSuccess:removeLoader,
		columns:[[
		          {title:LAN_PROJECT_CODE,field:'project_code',width:'18%',align:'center',sortable:true},
		          {title:LAN_PROJECT_NAME,field:'project_name',  width:'20%', align: 'center',sortable:true},
		          {title:LAN_PROJECT_STATUS_NAME,field:LAN_PROJECT_STATUS_NAME_EN,  width: '10%', align: 'center',sortable:true},
		          {title:LAN_CREATE_DATE,field:'create_date',  width: '20%', align: 'center',sortable:true},
		          {title:LAN_SET,field:LAN_SET,  width: '30%', align: 'center',
			  	formatter:function(value, row, index) {
		  			// return '<a href="javascript:showDetail(' + index + ',1);">查看明细';
			  		return "<div class='icon'><span><a href='project-update.php?formProjectId="+row.project_id+"'><img src='../images/icon_set_blue.png'/>"+LAN_UPDATE+"</a> <a href='user-list.php?formProjectId="+row.project_id+"&code="+row.project_code+"'><img src='../images/icon_zhgl.png'/>"+LAN_ACCOUNTS_SET+"</a></span></div>";
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
	showLoader();
	$.ajax({
		type:'POST',
		url:'data/project.exportExcel.php',
		data:getItemParam(),
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