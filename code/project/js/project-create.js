$(function(){	
	$.extend($.fn.validatebox.defaults.rules, {
   	//验证登录账号是否重复
		repeat: {
				validator: function(value){
	   				var isExist = false;
							$.ajaxSetup({async : false}); 
							$.post('data/project.isrepeat.php',{project_code:value},function(data){
								var data = eval('(' + data + ')');
								if(data.result == 10004){
									isExist = false;
								}else if(data.result == 10000){
									isExist = true;
								}
							});
	   				return isExist;
				},
   			message: LAN_PROJECT_CODE_USED
   		},
	});

})


//提交
function submitFunction(){
	var isValid = $("#test").form('validate');
	if(isValid){
		$.messager.confirm(BASSIC_SET_MESSAGE,BASSIC_SET_MESSAGE_OPTION,function(isConfirm){
			if(isConfirm){
				$("#test").form('submit',{
					success:function(data){
						var data = eval("(" + data + ")");
						/*if(data.result == 10000){
							location.href="project-list.php";
						}else if(data.result == 10001){
							$.messager.alert(BASSIC_MESSAGE, data.msg);
						}*/
						if (data.result == RESULT_CODE_SUCCESS) {
							location.href = "project-list.php";
						} else {
							checkResult(data);
						}
					}
				})
			}
		})
	}
}


//提交
function cancleFunction(){
	location.href = "project-list.php";
}

/*获取高度*/
function getGridHeight(){
	var height1 = $("#_title").height();
	var height2 = $("#_query").height() ;
	var height = document.compatMode=="CSS1Compat"?document.documentElement.clientHeight:document.body.clientHeight;
	return height - height2 - height1 - 100;
}
