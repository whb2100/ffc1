$(function() {
	var projectId = $("#projectId").val();
	$.post('data/project.retrieve.php', {project_id:projectId}, function(data) {
		var data = eval("(" + data + ")");
		$("#projectCode").val(data.rows[0].project_code);
		$("#projectName").val(data.rows[0].project_name);
	});
	
})

$(function(){	
	$.extend($.fn.validatebox.defaults.rules, {
   	//验证登录账号是否重复
		repeat: {
				validator: function(value){
	   				var isExist = false;
							$.ajaxSetup({async : false}); 
							$.post('data/user.isrepeat.php',{user_empcode:value},function(data){
								var data = eval('(' + data + ')');
								if(data.result == 10004){
									isExist = false;
								}else if(data.result == 10000){
									isExist = true;
								}
							});
	   				return isExist;
				},
   			message: LAN_USER_EMPCODE_USED
   		},
	});

})


//提交
function submitFunction(){
	var projectId = $("#projectId").val();
	var code = $("#code").val();
	var isValid = $("#test").form('validate');
	if(isValid){
		$.messager.confirm(BASSIC_SET_MESSAGE,BASSIC_SET_MESSAGE_OPTION,function(isConfirm){
			if(isConfirm){
				$("#test").form('submit',{
					success:function(data){
						var data = eval("(" + data + ")");
						/*if(data.result == 10000){
							location.href="user-list.php?formProjectId="+projectId+"&code="+code;
						}else if(data.result == 10001){
							$.messager.alert(BASSIC_MESSAGE, data.msg);
						}*/
						if (data.result == RESULT_CODE_SUCCESS) {
							location.href="user-list.php?formProjectId="+projectId+"&code="+code;
						} else {
							checkResult(data);
						}
					}
				})
			}
		})
	}
}

/*获取高度*/
function getGridHeight(){
	var height1 = $("#_title").height();
	var height2 = $("#_query").height() ;
	var height = document.compatMode=="CSS1Compat"?document.documentElement.clientHeight:document.body.clientHeight;
	return height - height2 - height1 - 100;
}
