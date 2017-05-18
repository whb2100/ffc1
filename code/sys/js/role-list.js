function getParams() {
	var arr = new Object();
	arr['role_names'] = $("#roleName").val();
	arr['resource_url'] = $("#resource_url").val();
	arr['user_id'] = $("#userId").val();
	return arr;
}
$(function(){
	$("#sysRoleList").datagrid({
		height:getGridHeight(),
		title:'角色列表',
		idField:'role_id',
		fitColumns:true, 
		singleSelect:true,
		url:'data/role.retrieve.data.php',
		loadMsg:'',
		pagination:true,
		pageSize:20,
		pageList:[20,50,100],
		rownumbers:true,
		striped:true,
		columns:[[
		          {title:'角色名称',field:'role_name',width:100,align:'center'},
		          {title:'角色状态',field:'role_status',  width: 100, align: 'center',
		        	  formatter:function(value){
		        		  var text = '';
		        		  switch (Number(value)) {
						case 0:
							text="不可用";
							break;
						case 1:
							text="正常";
							break;
						default:
							break;
						}
	        		  return text;
		        	  }
		          },
		          {title:'创建时间',field:'create_date',  width: 180, align: 'center'},
		          {title:'操作员',field:'create_name',  width: 100, align: 'center'}
		          ]],
	});
	
	$('#sysRoleList').datagrid({"onBeforeLoad":function(){showLoader()}});
	$('#sysRoleList').datagrid({"onLoadSuccess":function(){removeLoader()}});
	
	$("#allocatedResource").datagrid({
		title:'角色权限选择',
		height:'200px',
		idField:'resource_id',
		checkbox:true,
		url:'data/resource.retrieve.php?resource_status=1',
		columns:[[
		          {title:'权限ID',field:'resource_id',width:100,align:'center',checkbox:true},
		          {title:'权限名称',field:'resource_name',width:200,align:'center'},
		          ]]
	});
	$.extend($.fn.validatebox.defaults.rules, {
		repeat: {
				validator: function(value){
					var row = $('#sysRoleList').datagrid('getSelected');
					var roleName = row.role_name;
	   				var isExist = false;
						if(roleName == value){
							isExist = true;
						}else{
							$.ajaxSetup({async : false}); 
							$.post('data/role.isrepeat.php',{role_name:value},function(data){
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
   			message: "角色名称已被使用"
   		},
	});
})

/*重新加载表格*/
function reloadgrid(){
	$("#sysRoleList").datagrid('reload',{
		role_names:$("#roleName").val()
	})
}

//添加
function addSysRole(){
	$("#sysRoleForm").form('clear');
	$.extend($.fn.validatebox.defaults.rules, {
		repeat: {
				validator: function(value){
	   				var isExist = false;
							$.ajaxSetup({async : false}); 
							$.post('data/role.isrepeat.php',{role_name:value},function(data){
								var data = eval('(' + data + ')');
								if(data.result == 10004){
									isExist = false;
								}else if(data.result == 10000){
									isExist = true;
								}
							});
	   				return isExist;
				},
   			message: "角色名称已被使用"
   		},
	});
	$("#allocatedResource").datagrid('uncheckAll');
	$("#dialogRoleStatus-enable").attr('checked','checked');
	$("#sysRoleForm").attr('action','data/role.create.php');
	$("#sysRoleDialog").dialog("open").dialog('setTitle', '新增'); 
 }

//修改
function editSysRole() {
	var row = $("#sysRoleList").datagrid("getSelected");
	if (row) {
		$("#sysRoleForm").form('clear');
		$.extend($.fn.validatebox.defaults.rules, {
		repeat: {
				validator: function(value){
					var row = $('#sysRoleList').datagrid('getSelected');
					var roleName = row.role_name;
	   				var isExist = false;
						if(roleName == value){
							isExist = true;
						}else{
							$.ajaxSetup({async : false}); 
							$.post('data/role.isrepeat.php',{role_name:value},function(data){
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
   			message: "角色名称已被使用"
   		},
	});
		$("#sysRoleDialog").dialog("open").dialog('setTitle', '修改');
		$("#sysRoleForm").attr('action','data/role.update.php');
		$('#storeCombobox').hide();
		$("#dialogRoleName").val(row.role_name);
		$("#dialogRoleId").val(row.role_id);
		$("#dialogRoleDesc").val(row.role_desc);
		var roleStatus = row.role_status;
		//console.log(roleStatus);
		if(roleStatus == "1"){
			 document.getElementById('dialogRoleStatus-enable').checked=true;
		}else{
			document.getElementById('dialogRoleStatus-disable').checked=true;
		}
		
		$.post('data/roleresource.retrieve.php',{role_id:row.role_id},function(data){
			var data = eval('(' + data + ')');
			for(var i=0; i<data.length; i++){
				$("#allocatedResource").datagrid('selectRecord',data[i].resource_id);
			}
		})
	} else {
		$.messager.alert("提示信息", "请选择一条记录！");
	}
}

// 保存
function saveSysRole(){
	var rows = $("#allocatedResource").datagrid('getSelections');
	var resourceIds = "";
	for(var i=0; i<rows.length; i++){
		if(i==0){
			resourceIds = rows[i].resource_id;
		}else{
			resourceIds += "," + rows[i].resource_id;
		}
	}
	$("#resourceIds").val(resourceIds);
	$("#sysRoleForm").form("submit", {
        success: function (data) {
        	var data = eval("(" + data + ")");
            if (data.result == "10000") {
            	$.messager.alert("提示信息", data.msg);
            	$("#allocatedResource").datagrid("uncheckAll");
                $("#sysRoleDialog").dialog("close");
                $("#sysRoleList").datagrid("reload");
            }else {
            	$.messager.alert("提示信息", data.msg);
            }
        }
    });
}

//删除
function deleteSysRole(){
	var row = $('#sysRoleList').datagrid('getSelected');
    if (row){
        $.messager.confirm('确定','你确定要删除这条信息吗?',function(confirm){
            if (confirm){
            	$.post('data/deleteSysRole.php',{roleId:row.role_id},function(data){
            		var data = eval('(' + data + ")");
            		if(data.result == 10000){
            			$.messager.alert("提示信息", data.msg);
            			$('#sysRoleList').datagrid('reload');
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
		url:'data/role.export.php',
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
