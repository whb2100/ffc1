var projectId = $("#projectId").val();

$(function(){
	//初始化
	var costData = "";
	var capitalData = "";
	var directorData = "";
	var actorData = "";
	var rateData = "";
	var projectData = "";
	var cost = 0;
	var capital = 0;
	var total = 0;
	var status = "";
	
	//计算成本
	$.ajax({
		url: "data/top.retrieve.php",
		type: 'get',
		async: false,
		dataTye: 'json',
		success: function (data) {
			costData = eval('(' + data + ')');
		}
	})
	for(var i = 0 ; i < costData.total-1 ; i++){
		if(costData.rows[i].b_old != undefined){
			cost = cost+Number(costData.rows[i].b_old.replace(/,/g,''));
		}
	}
	if(rDecimal.test(cost)){
		var part = cost.toString().split(".");
		if(part[1].length == 2){
			cost = cost;
		}else if(part[1].length == 1){
			cost = cost+'0';
		}
	}else if(cost == 0){
		cost = "0.00";
	}else{
		cost = cost+'.00';
	}
	var parts = cost.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    cost = parts.join(".");
    
    //计算资产
	$.ajax({
		url: "data/balance.retrieve.php",
		type: 'get',
		async: false,
		dataTye: 'json',
		success: function (data) {
			capitalData = eval('(' + data + ')');
		}
	})
	if(capitalData.total == 0){
		capital = "0.00";
	}else{
		for(var i = 0 ; i < capitalData.total ; i++){
			if(capitalData.rows[i] != null && capitalData.rows[i].main_sub == "9"){
				capital = capitalData.rows[i].b_old;
			}else{
				capital = "0.00";
			}
		}
	}
	
	//计算合计
	if(cost == 0 && capital != 0){
		total = Number(cost)+Number(capital.replace(/,/g,''));
	}else if(cost != 0 && capital == 0){
		total = Number(cost.replace(/,/g,''))+Number(capital);
	}else if(cost == 0 && capital == 0){
		total = Number(cost)+Number(capital);
	}else{
		total = Number(cost.replace(/,/g,''))+Number(capital.replace(/,/g,''));
	}
	if(rDecimal.test(total)){
		total = total;
	}else{
		total = total+'.00';
	}
	var parts = total.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    total = parts.join(".");
    
    //导演
	$.ajax({
		url: "../project/data/director.retrieve.php",
		type: 'get',
		async: false,
		dataTye: 'json',
		success: function (data) {
			directorData = eval('(' + data + ')');
		}
	})
	if(directorData.rows[0] != null){
		$("#trialTable").append("<tr><td colspan='2' style='text-align: left;font-size: 22px;'>"+LEADER_REPORT+"</td></tr>");
		$("#trialTable").append("<tr><td style='text-align: right;width: 40%;font-size: 22px;'>"+DIRECTOR_REPORT+"</td><td style='text-align: center;width: 60%;font-size: 22px;'>"+directorData.rows[0].director_name+"</td></tr>");
	}
	
    //演员
	$.ajax({
		url: "../project/data/actor.retrieve.php",
		type: 'get',
		async: false,
		dataTye: 'json',
		success: function (data) {
			actorData = eval('(' + data + ')');
		}
	})
	if(actorData.rows[0] != null){
		for(var i = 0; i < actorData.total; i++){
			var num = i+1;
			$("#trialTable").append("<tr><td style='text-align: right;width: 40%;font-size: 22px;'>"+num+"#"+ACTOR_REPORT+"</td><td style='text-align: center;width: 60%;font-size: 22px;'>"+actorData.rows[i].actor_name+"</td></tr>");
		}
	}
	
	//项目进度
	$.ajax({
		url: "../project/data/project.retrieve.php?project="+projectId,
		type: 'get',
		async: false,
		dataTye: 'json',
		success: function (data) {
			projectData = eval('(' + data + ')');
		}
	})
	if(projectData.rows[0].project_status == 1){
		status = PRJ_STATUS_READYING;
	}else if(projectData.rows[0].project_status == 2){
		status = PRJ_STATUS_ONGOING;
	}else if(projectData.rows[0].project_status == 3){
		status = PRJ_STATUS_POST;
	}else if(projectData.rows[0].project_status == 4){
		status = PRJ_STATUS_FINISH;
	}else if(projectData.rows[0].project_status == 5){
		status = PRJ_STATUS_DISABLE;
	}
	if(projectData.rows[0] != null){
		$("#trialTable").append("<tr><td style='text-align: left;width: 40%;font-size: 22px;'>"+PROJECT_STATUS_REPORT+"</td><td style='text-align: right;width: 60%;font-size: 22px;'>"+status+"</td></tr>");
	}
	
	//汇率
	$.ajax({
		url: "../basic/data/currency.retrieve.php",
		type: 'get',
		async: false,
		dataTye: 'json',
		success: function (data) {
			rateData = eval('(' + data + ')');
		}
	})
	$("#trialTable").append("<tr><td colspan='2' style='text-align: left;font-size: 22px;'>"+RATE_REPORT+"</td></tr>");
	if(rateData.rows[0] != null){
		for(var i = 0; i < rateData.total; i++){
			$("#trialTable").append("<tr><td style='text-align: right;width: 40%;font-size: 22px;'>"+rateData.rows[i].currency_type+"</td><td style='text-align: right;width: 60%;font-size: 22px;'>"+rateData.rows[i].exchange_rate+"</td></tr>");
		}
	}
	
    //汇总
	$("#trialTable").append("<tr><td colspan='2' style='text-align: left;font-size: 22px;'>"+TOTAL_REPORT+"</td></tr>");
	$("#trialTable").append("<tr><td style='text-align: right;width: 40%;font-size: 22px;'>"+TOTAL_COST+"</td><td style='text-align: right;width: 60%;font-size: 22px;'>"+cost+"</td></tr>");
	$("#trialTable").append("<tr><td style='text-align: right;width: 40%;font-size: 22px;'>"+TOTAL_CAPITAL+"</td><td style='text-align: right;width: 60%;font-size: 22px;'>"+capital+"</td></tr>");
	$("#trialTable").append("<tr><td style='text-align: right;width: 40%;font-size: 22px;'>"+TOTAL_BALANCE+"</td><td style='text-align: right;width: 60%;font-size: 22px;'>"+total+"</td></tr>");
})

// 说明书下载
function explain() {
	window.open("../common/downloadhelp.php", "_blank");
}

/*导出*/
function ExcleFunction(){
	window.open("data/report.pdf.php?report_type=16", "_blank");
}