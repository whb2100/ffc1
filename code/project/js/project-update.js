$(function() {
	var projectId = $("#projectId").val();
	$.post('data/project.retrieveAll.php', {project_id:projectId}, function(data) {
		var data = eval("(" + data + ")");
		$("#projectCode").val(data.project.rows[0].project_code);
		$("#projectName").val(data.project.rows[0].project_name);
		$("#projectStatus").combobox('setValue',data.project.rows[0].project_status);
		if (data.company.total>0) {
			for (var i = 1; i <= data.company.total; i++) {
				$("#company_"+i).val(data.company.rows[i-1].company_name);
			};
		};
		if (data.actor.total>0) {
			for (var i = 1; i <= data.actor.total; i++) {
				$("#actor_"+i).val(data.actor.rows[i-1].actor_name);
			};
		};
		if (data.director.total>0) {
			$("#directorName").val(data.director.rows[0].director_name);
		};
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
