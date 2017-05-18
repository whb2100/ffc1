function getParams() {
	var arr = new Object();
	arr['user_empcodes'] = $("#userEmpcode").val();
	arr['resource_url'] = $("#resource_url").val();
	arr['user_id'] = $("#userId").val();
	return arr;
}
$(function(){
	$("#sysUserList").datagrid({
		height:getGridHeight(),
		width:'95%',
		title:'用户列表',
		idField:'user_id',
//		fitColumns:true, 
		singleSelect:true,
		url:'data/user.retrieve.data.php',
		loadMsg:'',
		pagination:true,
		pageSize:20,
		pageList:[20,50,100],
		rownumbers:true,
		striped:true,
		columns:[[
		          {title:'登录账号',field:'user_empcode',width:100,align:'center'},
		          {title:'角色ID',field:'role_id',  width: 100, align: 'center',hidden:true},
		          {title:'真实姓名',field:'user_realname',  width: 100, align: 'center'},
		          {title:'邮箱',field:'user_email',  width: 100, align: 'center'},
		          {title:'手机号码',field:'user_mobile',  width: 100, align: 'center'},
		          {title:'证件号码',field:'user_certificate_no',  width: 100, align: 'center'},
		          {title:'用户状态',field:'user_status',  width: 100, align: 'center',
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
		          {title:'部门',field:'dept_name',  width: 150, align: 'center'},
//		          {title:'部门',field:'depart_id', width: 180, align: 'center',
//					formatter:function(value,rowData,rowIndex){
//						var deptCode = rowData.dept_code;
//						if(value == null){
//							return "";
//						}
//						$.ajaxSetup({
//							async: false
//						});
//						var depart_name = ''; 
//						$.post('data/department.name.retrieve.php', {dept_id : value},function(data){
//							var data = eval("(" + data + ")");
//							depart_name = data.name;
//						});
//						return depart_name;
//					}
//				  },
		          {title:'创建时间',field:'create_date',  width: 150, align: 'center'},
		          {title:'操作员',field:'create_name',  width: 100, align: 'center'},
		          {title:'备注信息',field:'user_desc',  width: 100, align: 'center'}
		          ]]
	});
	$('#sysUserList').datagrid({"onBeforeLoad":function(){showLoader()}});
	$('#sysUserList').datagrid({"onLoadSuccess":function(){removeLoader()}});
	
	$('#departmentTree').tree({    
		url: "data/department.tree.retrieve.php",  
		parentField:"parent_id",
	    textFiled:"dept_name",
	    idFiled:"dept_id",
	    onContextMenu: function(e, node){
	    	$("#menuForm").form('clear');
			$("#departMenuId").val(node.dept_id);
			$("#departMenuName").val(node.dept_name);
			$("#departMenuParentName").val(node.parent_name);
			$("#departMenuParentId").val(node.parent_id);
			$("#departMenuParentCode").val(node.parent_code);
			e.preventDefault();
			$('#departmentTree').tree('select', node.target);
			$('#menu').menu('show', {
				left: e.pageX,
				top: e.pageY
			});
		}
	}); 
	
	$('#departmentTree').tree({
		onClick: function(node){
			var departId = node.dept_id;
			if(departId == 1){
				$("#sysUserList").datagrid('reload',{
					dept_id:''
				})
			}else{
				$("#sysUserList").datagrid('reload',{
					dept_id:departId
				})
			}
		}
	});
	
	$('#departTree').tree({
		onClick: function(node){
			$('#parentId').val(node.dept_id);
			$('#dialogDepartmentCode').val(node.dept_code);
		}
	});
	
	$('#updateDepartTree').tree({
		onClick: function(node){
			$('#updateParentId').val(node.dept_id);
			$('#updateDepartmentCode').val(node.dept_code);
		}
	});
	
	$.extend($.fn.validatebox.defaults.rules, {
		repeat: {
				validator: function(value){
					var departId = $('#parentId').val();
	   				var isExist = false;
							$.ajaxSetup({async : false}); 
							$.post('data/department.isrepeat.php',{dept_name:value,parent_id:departId},function(data){
								var data = eval('(' + data + ')');
								if(data.total == 1){
									isExist = false;
								}else if(data.total != 1){
									isExist = true;
								}
							});
	   				return isExist;
				},
   			message: "部门名称已被使用"
   		},
	});
	
})

/*重新加载表格*/
function reloadgrid(){
	$("#sysUserList").datagrid('reload',{
		user_empcodes:$("#userEmpcode").val()
	})
}

//添加用户
function addSysUser(){
	location.href="user-create.php";
 }

//修改用户
function editSysUser() {
	var row = $('#sysUserList').datagrid('getSelected');
    if (row){
    		location.href='user-update.php?formUserId='+row.user_id+'&userEmpcode='+row.user_empcode;
    }else{
    	$.messager.alert("操作提示", "请选择一条记录！");
    }
}

//删除用户
function deleteSysUser(){
	var row = $('#sysUserList').datagrid('getSelected');
    if (row){
        $.messager.confirm('确定','你确定要删除这条信息吗?',function(confirm){
            if (confirm){
            	$.post('data/deleteSysUser.php',{userId:row.user_id},function(data){
            		var data = eval('(' + data + ")");
            		if(data.result == 10000){
            			$.messager.alert("提示信息", data.msg);
            			$('#sysUserList').datagrid('reload');
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
		url:'data/user.export.php',
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

//添加部门
function addDepart(){
	$('#departTree').tree({    
		url: "data/department.tree.retrieve.php",  
		parentField:"parent_id",
	    textFiled:"dept_name",
	    idFiled:"dept_id",
	}); 
	$("#departForm").form('clear');
	$("#departForm").attr('action','data/department.create.php');
	$("#departDialog").dialog("open").dialog('setTitle', '新增'); 
 }

// 保存部门
function saveDepart(){
	var departId = $('#parentId').val();
	if(departId == ""){
		$.messager.alert("提示信息", "请选择上级部门！")
		return;
	}
	$("#departForm").form("submit", {
        success: function (data) {
        	var data = eval("(" + data + ")");
            if (data.result == "10000") {
            	$.messager.alert("提示信息", data.msg);
                $("#departDialog").dialog("close");
                $("departTree").tree("reload");
            	$('#departmentTree').tree({    
            		url: "data/department.tree.retrieve.php",  
            		parentField:"parent_id",
            	    textFiled:"dept_name",
            	    idFiled:"dept_id",
            	}); 
            }else {
            	$.messager.alert("提示信息", data.msg);
            }
        }
    });
}

//修改部门
function updataDepart(){
	var departId = $("#departMenuId").val();
	var departName = $("#departMenuName").val();
	var departParentId = $("#departMenuParentId").val();
	var departParentName = $("#departMenuParentName").val();
	var departParentCode = $("#departMenuParentCode").val();
	$('#updateDepartTree').tree({    
		url: "data/department.tree.retrieve.php",  
		parentField:"parent_id",
		textFiled:"dept_name",
		idFiled:"dept_id",
	}); 
	$("#updateDepartForm").form('clear');
	$("#updateDepartmentId").val(departId);
	$("#updateDepartmentName").val(departName);
	$("#updateParentName").html(departParentName);
	$('#updateDepartmentCode').val(departParentCode);
	$("#updateParentId").val(departParentId);
	$("#updateDepartForm").attr('action','data/department.name.update.php');
	$("#updateDepartDialog").dialog("open").dialog('setTitle', '修改');
}

//保存修改部门
function saveUpdateDepart(){
	$("#updateDepartForm").form("submit", {
        success: function (data) {
        	var data = eval("(" + data + ")");
            if (data.result == "10000") {
            	$.messager.alert("提示信息", data.msg);
                $("#updateDepartDialog").dialog("close");
                $("departTree").tree("reload");
                $("updateDepartTree").tree("reload");
            	$('#departmentTree').tree({    
            		url: "data/department.tree.retrieve.php",  
            		parentField:"parent_id",
            	    textFiled:"dept_name",
            	    idFiled:"dept_id",
            	}); 
            }else {
            	$.messager.alert("提示信息", data.msg);
            }
        }
    });
}

//删除部门
function deleteDepart(){
	var departId = $("#departMenuId").val();
	if(departId == 1){
		$.messager.alert("提示信息", "一级部门不能删除！");
		return;
	}
	$.messager.confirm('确定','你确定要删除这条信息吗?',function(confirm){
		if (confirm){
			$.post('data/department.delete.php',{dept_id:departId},function(data){
				var data = eval('(' + data + ")");
				if(data.result == 10000){
					$.messager.alert("提示信息", data.msg);
					$("departTree").tree("reload");
	                $("updateDepartTree").tree("reload");
					$('#departList').datagrid('reload');
					$('#departmentTree').tree({    
	            		url: "data/department.tree.retrieve.php",  
	            		parentField:"parent_id",
	            	    textFiled:"dept_name",
	            	    idFiled:"dept_id",
	            	}); 
				}else{
					$.messager.alert("提示信息", data.msg);
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
