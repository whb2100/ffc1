$(function(){
	var date = $("#loginDate").val(); 
	$("#timeSpan").text(date);
	
	var language = $("#language").val();
	if (language  == "en") {
		//document.getElementById("logo").src = "../images/icon_logo_en.png";
		document.getElementById("logo").src = "../images/logo-en2.png";
	} else {
		//document.getElementById("logo").src = "../images/icon_logo_zh.png";
		document.getElementById("logo").src = "../images/logo-zh2.png";
	}
	$("#logo").width(150);
	$("#logo").height(80);
	
	//时钟
	var year=document.getElementById('year');
	var month=document.getElementById('month');
	var day=document.getElementById('day');
	var hour=document.getElementById('hour');
	var minute=document.getElementById('minute');
	var second=document.getElementById('second');
	function showTime(){
		var oDate=new Date();
		var iYear=oDate.getFullYear();
		var iMonth=oDate.getMonth();
		var iDay=oDate.getDate();
		var iHours=oDate.getHours();
		var iMinute=oDate.getMinutes();
		var iSecond=oDate.getSeconds();
		year.innerHTML=iYear;
		month.innerHTML=iMonth+1;
		day.innerHTML=iDay;
		hour.innerHTML=AddZero(iHours);
		minute.innerHTML=AddZero(iMinute);
		second.innerHTML=AddZero(iSecond);
	}
	showTime();
	setInterval(showTime,1000);
	function AddZero(n){
		if(n<10){
			return '0'+n;
		}
		return ''+n;
	}
	
	var positionId = $("#positionId").val();
	if(positionId == 1){
		$("#projectManagementLi").show();
		$("#basicSettingLi").hide();
		$("#projectBudgetLi").hide();
		$("#batchProcessingLi").hide();
		$("#reportQueryLi").hide();
		$("#POInputLi").hide();
		$("#ETCLi").hide();
		$("#VouchersLi").hide();
		$("#mainFrame").show();
		$("#mainFrame").attr("src","../project/project-index.php");
		firstLogin();
	}else if(positionId == 5){
		$("#projectManagementLi").hide();
		$("#basicSettingLi").hide();
		$("#projectBudgetLi").hide();
		$("#batchProcessingLi").show();
		$("#reportQueryLi").show();
		$("#POInputLi").hide();
		$("#ETCLi").hide();
		$("#VouchersLi").hide();
		$("#mainFrame").show();
		$("#mainFrame").attr("src","../report/trial-balance.php");
		firstLogin();
	}else{
		$("#projectManagementLi").hide();
		$("#basicSettingLi").show();
		$("#projectBudgetLi").show();
		$("#batchProcessingLi").show();
		$("#reportQueryLi").show();
		$("#POInputLi").show();
		$("#ETCLi").show();
		$("#mainFrame").show();
		$("#VouchersLi").show();
		$("#mainFrame").attr("src","../report/report-index.php");
		$('#reportQueryLi a').addClass('link_1_on');
		firstLogin();
	}
	$.extend($.fn.validatebox.defaults.rules, {
		// 验证两次输入的密码是否相同
		equalTo:{
			validator:function(value){
				var password = $("#userNewPassword").val();
				if(password != "" && value != ""){
					return password == value;
				}else{
					return true;
				}
			},
			message:"两次输入的密码不一致"
		},
	});
	
});

// 第一次登陆跳转修改密码
function  firstLogin(){
	var userId = $("#formUserId").val(); 
	 $.ajax({
	        url: "../sys/data/user.retrieve.php?user_id="+userId,
	        type: 'get',
	        async: false,
	        dataTye: 'json',
	        success: function (data) {
	        	data = eval('(' + data + ')');
	        	if(data.rows[0].last_modify_pwd_date ==null){
	        		resetUserPassword(1);
	        		return;
	        	}
	        }
	    })	
}


function projectFunction(obj){
	this.sel(obj);
	$("#mainFrame").show();
	$("#mainFrame").attr("src","../project/project-index.php");
}

function basicFunction(obj){
	this.sel(obj);
	$("#mainFrame").show();
	$("#mainFrame").attr("src","../basic/basic-set.php");
}

function budgetFunction(obj){
	this.sel(obj);
	$("#mainFrame").show();
	$("#mainFrame").attr("src","../budget/budget-index.php");
}

function processFunction(obj){
	this.sel(obj);
	$("#mainFrame").show();
	$("#mainFrame").attr("src","../batch/batch-list.php");
}

function reportFunction(obj){
	var positionId = $("#positionId").val();
	this.sel(obj);
	$("#mainFrame").show();
	if(positionId == 5){
		$("#mainFrame").attr("src","../report/trial-balance.php");
	}else{
		$("#mainFrame").attr("src","../report/report-index.php");
	}
}

function POFunction(obj){
	this.sel(obj);
	$("#mainFrame").show();
	$("#mainFrame").attr("src","../poInput/poInput-list.php");
}

function ETCFunction(obj){
	this.sel(obj);
	$("#mainFrame").show();
	$("#mainFrame").attr("src","../etc/etc-create.php");
}

function VOUCHERSFunction(obj){
	this.sel(obj);
	$("#mainFrame").show();
	$("#mainFrame").attr("src","../vouchers/vouchers-list.php");
}

var tag = null;
function sel(obj){
	$('#reportQueryLi a').removeClass('link_1_on');
	if (tag != null) {
		tag.style.background="#12153e";
		tag.style.borderTop="#668ec4 1px solid";
		tag.style.borderLeft="";
	}
	tag = obj;
	tag.style.background="#3674cc";
	tag.style.borderTop="";
 }

function logOut(){
	location.href = "../sys/index.php";
}
function resetUserPassword(a){
	if (a==2) {
		$('#cancle').show();
	};
	$("#resetUserPasswordForm").form('clear');
	$("#resetUserPasswordDialog").dialog('open');
}
function submitResetUserPasswordForm(){
	$.messager.confirm('操作提示','确定修改密码？',function(r){
		if(r){
			$("#resetUserPasswordForm").form('submit',{
				success:function(data){
					var data = eval('(' + data + ')');
					if(data.result == 10000){
						$("#resetUserPasswordDialog").dialog('close');
						$.messager.show({
							title:'提示信息',
							msg:'修改成功，系统将在3秒钟之后返回登录页！',
							showType:'show',
							style:{  		
								right:'',  		
								top:document.body.scrollTop+document.documentElement.scrollTop,  		
								bottom:''  	
							}  
						});
						 setTimeout('logOut()',3000); 
					}else{
						$.messager.show({
							title:'提示信息',
							msg:data.msg,
							showType:'show',
							style:{  		
								right:'',  		
								top:document.body.scrollTop+document.documentElement.scrollTop,  		
								bottom:''  	
							}  
						});
					}
				}
			});
		}
	})
}
