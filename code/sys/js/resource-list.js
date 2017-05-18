function getParams() {
	var arr = new Object();
	arr['resource_names'] = $("#resourceName").val();
	arr['resource_url'] = $("#resource_url").val();
	arr['user_id'] = $("#userId").val();
	return arr;
}
$(function(){
	$("#resourceList").datagrid({
		height:getGridHeight(),
		title:'资源列表',
		idField:'resource_id',
		fitColumns:true, 
		singleSelect:true,
		url:'data/resource.retrieve.data.php',
		loadMsg:'',
		pagination:true,
		pageSize:20,
		pageList:[20,50,100],
		rownumbers:true,
		striped:true,
		columns:[[
		          {title:'资源名称',field:'resource_name',width:150,align:'center'},
		          {title:'资源路径',field:'resource_url',  width: 180, align: 'center'},
		          {title:'资源类型',field:'resource_type',  width: 100, align: 'center',
		        	  formatter:function(value){
		        		  var text = '';
		        		  switch (Number(value)) {
						case 1:
							text="菜单资源";
							break;
						case 2:
							text="按钮资源";
							break;
						case 3:
							text="公共资源";
							break;
						default:
							break;
						}
	        		  return text;
		        	  }
		          },
		          {title:'资源状态',field:'resource_status',  width: 100, align: 'center',
		        	  formatter:function(value){
		        		  var text = '';
		        		  switch (Number(value)) {
						case 1:
							text="正常";
							break;
						case 0:
							text="不可用";
							break;
						default:
							break;
						}
	        		  return text;
		        	  }
		          },
		          {title:'创建时间',field:'create_date',  width: 180, align: 'center'},
		          {title:'资源父目录',field:'parent_name',  width: 100, align: 'center'},
		          {title:'资源父目录',field:'resourceparent_id',  width: 100, align: 'center',hidden:true},
		          {title:'操作员',field:'create_name',  width: 100, align: 'center'}
		          ]]
	});
	$('#resourceList').datagrid({"onBeforeLoad":function(){showLoader()}});
	$('#resourceList').datagrid({"onLoadSuccess":function(){removeLoader()}});
})

/*重新加载表格*/
function reloadgrid(){
	$("#resourceList").datagrid('reload',{
		resource_names:$("#resourceName").val()
	})
}

//添加
function addResource(){
	var resourceUrl = '-';
	$("#resourceForm").form('clear');
	$.extend($.fn.validatebox.defaults.rules, {
		repeat: {
				validator: function(value){
	   				var isExist = false;
							$.ajaxSetup({async : false}); 
							$.post('data/resource.isrepeat.php',{resource_name:value},function(data){
								var data = eval('(' + data + ')');
								if(data.result == 10004){
									isExist = false;
								}else if(data.result == 10000){
									isExist = true;
								}
							});
	   				return isExist;
				},
   			message: "资源名称已被使用"
   		},
   		repeatUrl: {
			validator: function(value){
   				var isExist = false;
   				if(value == "-"){
   					isExist = true;
   				}else{
   					$.ajaxSetup({async : false}); 
   					$.post('data/resource.isrepeat.php',{resource_url:value},function(data){
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
			message: "资源路径已被使用"
		}
	});
	$("#dialogResourceparentName").combobox({
		url:'data/resource.retrieve.all.php?resource_url='+resourceUrl,    
	    valueField:"resource_id",    
	    textField:"resource_name"
	});
	$("#dialogResourceStatus-enable").attr('checked','checked');
	$("#resourceForm").attr('action','data/resource.create.php');
	$("#resourceDialog").dialog("open").dialog('setTitle', '新增'); 
 }

//修改
function editResource() {
	var row = $("#resourceList").datagrid("getSelected");
	if (row) {
		var resourceUrl = '-';
		$("#resourceForm").form('clear');
		$.extend($.fn.validatebox.defaults.rules, {
			repeat: {
					validator: function(value){
						var row = $('#resourceList').datagrid('getSelected');
						var resourceName = row.resource_name;
		   				var isExist = false;
							if(resourceName == value){
								isExist = true;
							}else{
								$.ajaxSetup({async : false}); 
								$.post('data/resource.isrepeat.php',{resource_name:value},function(data){
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
	   			message: "资源名称已被使用"
	   		},
	   		repeatUrl: {
				validator: function(value){
					var row = $('#resourceList').datagrid('getSelected');
					var resourceUrl = row.resource_url;
	   				var isExist = false;
						if(resourceUrl == value || resourceUrl == "-" || value == "-"){
							isExist = true;
						}else{
							$.ajaxSetup({async : false}); 
							$.post('data/resource.url.isrepeat.php',{resource_url:value},function(data){
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
   			message: "资源路径已被使用"
   		}
		});
		$("#dialogResourceparentName").combobox({
			url:'data/resource.retrieve.all.php?resource_url='+resourceUrl,    
		    valueField:"resource_id",    
		    textField:"resource_name"
		});
		$("#dialogResourceId").val(row.resource_id);
		$("#resourceDialog").dialog("open").dialog('setTitle', '修改');
		$("#resourceForm").attr('action','data/resource.update.php');
		$("#dialogResourceName").val(row.resource_name);
		$("#dialogResourceUrl").val(row.resource_url);
		$('#dialogResourceType').combobox('select',row.resource_type);
		$('#dialogResourceparentName').combobox('select',row.resourceparent_id);
		$("#newParent").hide();
		$("#resourceDesc").val(row.resource_desc);
		var resourceStatus = row.resource_status;
		if(resourceStatus == "1"){
			document.getElementById('dialogResourceStatus-enable').checked=true;
		}else{
			document.getElementById('dialogResourceStatus-disable').checked=true;
		}
	} else {
		$.messager.alert("提示信息", "请选择一条记录！");
	}
}

// 保存
function saveResource(){
	$("#resourceForm").form("submit", {
        success: function (data) {
        	var data = eval("(" + data + ")");
            if (data.result == "10000") {
            	$.messager.alert("提示信息", data.msg);
                $("#resourceDialog").dialog("close");
                $("#resourceList").datagrid("reload");
            }else {
            	$.messager.alert("提示信息", data.msg);
            }
        }
    });
}

//删除
function deleteSysResource(){
	var row = $('#resourceList').datagrid('getSelected');
    if (row){
        $.messager.confirm('确定','你确定要删除这条信息吗?',function(confirm){
            if (confirm){
            	$.post('data/deleteResource.php',{resourceId:row.resource_id},function(data){
            		var data = eval('(' + data + ")");
            		if(data.result == 10000){
            			$.messager.alert("提示信息", data.msg);
            			$('#resourceList').datagrid('reload');
            		}else{
            			$.messager.alert("提示信息", data.msg);
            		}
            	});
            }
        });
    }else{
    	$.messager.alert('操作提示','请选择一行记录！');
    }
}

//导出
function exportExccel() {
	showLoader();
	$.ajax({
		type:'POST',
		url:'data/resource.export.php',
		data:getParams(),
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

/*获取高度*/
function getGridHeight(){
	var height1 = $("#_title").height();
	var height2 = $("#_query").height() ;
	var height = document.compatMode=="CSS1Compat"?document.documentElement.clientHeight:document.body.clientHeight;
	return height - height2 - height1 - 100;
}
