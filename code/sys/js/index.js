$(function() {
	if (navigator.language.toLocaleLowerCase() == "zh-cn") {
		$("#tab_zh").attr("class", "active");
		$("#tab_en").attr("class", "en");
		$("#imgLogo").attr("src", "../images/logo-zh.png");
		tabsSwiper.swipeTo(0);
	} else {
		$("#tab_zh").attr("class", "en");
		$("#tab_en").attr("class", "active");
		$("#imgLogo").attr("src", "../images/logo-en.png");
		tabsSwiper.swipeTo(1);
	}
});

// 中文登录
function submitFunction(){
	$("#loginForm").form('submit',{
		success:function(data){
			var data = eval('(' + data + ')');
			if(data.result == 10000){
				window.location.href = '../common/main.php';
				$.post('../changeLog/data/changeLog.create.php',{change_obj_type:'N'});
			}
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
	})
}
// 英文登录
function submit_en(){
	$("#loginForm_en").form('submit',{
		success:function(data){
			var data = eval('(' + data + ')');
			if(data.result == 10000){
				window.location.href = '../common/main.php';
				$.post('../changeLog/data/changeLog.create.php',{change_obj_type:'N'});
			}
			$.messager.show({
				title:'message',
				msg:data.msg,
				showType:'show',
				 style:{  		
					    right:'',  		
					    top:document.body.scrollTop+document.documentElement.scrollTop,  		
					    bottom:''  	
					  }  
			});
		}
	})
}

function changeFunction(){
	alert('change');
}

function getHeight(){
	var height = document.compatMode=="CSS1Compat"?document.documentElement.clientHeight:document.body.clientHeight;
//	alert(height + "px");
	document.body.style.height = height + "px";
}