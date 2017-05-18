RESULT_CODE_SUCCESS = 10000;
RESULT_CODE_LOGIN_TIME_OUT = 10007;// 登录超时
RESULT_CODE_USER_DISABLE = 10008;// 账户被停用
RESULT_CODE_USER_NO_PERMISSION = 10009;// 账户没有相应操作权限

// 检测接口返回
function checkResult(data) {
	//var data = eval('(' + result + ')');
	if (data.result != RESULT_CODE_SUCCESS) {
		/*if (data.result == RESULT_CODE_LOGIN_TIME_OUT
			|| data.result == RESULT_CODE_USER_DISABLE
			|| data.result == RESULT_CODE_USER_NO_PERMISSION) {
			$.messager.alert(BASSIC_MESSAGE, data.msg, null, function() {locateIndexPage();});
		} else {
			$.messager.alert(BASSIC_MESSAGE, data.msg);
		}*/
		if (data.result == RESULT_CODE_LOGIN_TIME_OUT || data.result == RESULT_CODE_USER_DISABLE) {
			$.messager.alert(BASSIC_MESSAGE, data.msg, null, function() {locateIndexPage();});
		} else if (data.result == RESULT_CODE_USER_NO_PERMISSION) {
			$.messager.alert(BASSIC_MESSAGE, data.msg);
		} else {
			$.messager.alert(BASSIC_MESSAGE, data.msg);
		}
	}
}

// 跳转至登录页
function locateIndexPage() {
	top.location.href = "../sys/index.php";
}

var g_editor_cell_height = 30;

//正则判断整数
var rInteger = /^-?\\d+$/;
//正则判断是否为小数
var rDecimal= /^[+-]?[1-9]?[0-9]*\.[0-9]*$/;

// 设置datagrid可编辑文本框大小
/*function resizeEditor(editors) {
	var len = editors.length;
	for (var i = 0; i < len; i++) {
		var editor = editors[i];
		if (editor.type == "textbox") {
			var width = $(editor.target).textbox('options').width;
			//var height = $(editor.target).textbox('options').height;
			$(editor.target).textbox('options').height = 30;
			$(editor.target).textbox('resize', width);
		} else if (editor.type == "combobox") {
			var width = $(editor.target).combobox('options').width;
			$(editor.target).combobox('options').height = 30;
			$(editor.target).combobox('resize', width);
		}
	}
}*/

/*function checkKeyCode(e) {// backspace enter shift crtl alt esc ins del
	var code = e.keyCode;
	if (code == 8 || code == 13 || code == 16 || code == 17 || code == 18 || code == 27 || code == 45 || code == 46) {
		return false;
	}
	return true;
}*/

if (!Array.prototype.indexOf)
{
  Array.prototype.indexOf = function(elt /*, from*/)
  {
    var len = this.length >>> 0;
    var from = Number(arguments[1]) || 0;
    from = (from < 0)
         ? Math.ceil(from)
         : Math.floor(from);
    if (from < 0)
      from += len;
    for (; from < len; from++)
    {
      if (from in this &&
          this[from] === elt)
        return from;
    }
    return -1;
  };
}

var main_domain = "";

// 消息对话框 居中显示
function showMessage(title, msg) {
	var top_margin = 0;
	if (this.parent == this) {
		body = document.body;
		top_margin = body.scrollTop + body.clientHeight / 2 - 50;
	} else {
		body = parent.frames['mainFrame'].contentWindow.document.body;
		top_margin = parent.document.body.scrollTop + body.clientHeight / 2 - 50;
	}
	//top.$('<div>' + msg + '<div style="text-align:center"><a href="javascript:void(0)" class="easyui-linkbutton" onclick="printDetail(1)" iconcls="icon-save">g</a></div></div>').dialog({
	top.$('<div></div>').dialog({
		title: title,
		content: msg,
    width: 300,
    height: 100,
    closed: false,
    cache: false,
    top: top_margin,
    modal: true
    /*buttons:[{
      text:'确定',
      iconCls:'icon-ok',
      handler:function() {
      	alert('ok');
      }
    }]*/
	});
}

function showProgress() {
	$.messager.progress({
		title:'请稍后',
		msg:'数据加载中...'
	});
}

// 弹出加载层
function showLoader() {
	$("<div class=\"datagrid-mask\"></div>").css({
		display:"block",
		width:"100%",
		height:$(document).height()
	}).appendTo("body");  
	$("<div class=\"datagrid-mask-msg\"></div>").html(SHOW_LOADING).appendTo("body").css({
		'background-color':'#1071b8',
		display:"block",
		'z-index':9999,
		'padding': '30px 5px 10px 30px',
		'font-size':"21px",
	    'border-width': "2px",
	    'color':'#FFF',
	    'border-style': "solid",
	    'height':"60px",
	    'width':"290px",
		left:($(document.body).outerWidth(true) - 190) / 2,
		top:( ($(window).height() - 45) / 2 ) + $(document.body).scrollTop()
	});
}

function removeLoader() {
	$(".datagrid-mask").remove(); 
	$(".datagrid-mask-msg").remove();
}

// 对Date的扩展，将 Date 转化为指定格式的String   
// 月(M)、日(d)、小时(h)、分(m)、秒(s)、季度(q) 可以用 1-2 个占位符，   
// 年(y)可以用 1-4 个占位符，毫秒(S)只能用 1 个占位符(是 1-3 位的数字)      
Date.prototype.format = function(fmt) {
	var o = {
		"M+": this.getMonth()+1,// 月
		"d+": this.getDate(),// 日
		"h+": this.getHours(),// 时
		"m+": this.getMinutes(),// 分
		"s+": this.getSeconds(),// 秒
		"q+": Math.floor((this.getMonth()+3)/3),// 季度   
		"S": this.getMilliseconds()// 毫秒
  };
	if(/(y+)/.test(fmt)) {
		fmt = fmt.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
	}
	for(var k in o) {
		if(new RegExp("("+ k +")").test(fmt)) {
			fmt = fmt.replace(RegExp.$1, (RegExp.$1.length == 1) ? (o[k]) : (("00" + o[k]).substr(("" + o[k]).length)));
		}
	}
	return fmt;
}  

// 获取前一天日期
function getYesterdayDate() {
	var now = new Date();
	//now.setDate(now.getDate() - 30);
	now.setDate(now.getDate() - 1);
  return now.format("yyyy-MM-dd hh:mm:ss");
}

function getYesterdayDate2() {
	var now = new Date();
	//now.setDate(now.getDate() - 30);
	now.setDate(now.getDate() - 1);
	now.setHours(0);
	now.setMinutes(0);
	now.setSeconds(0);
  return now.format("yyyy-MM-dd hh:mm:ss");
}

function getYesterdayDate3() {
	var now = new Date();
	//now.setDate(now.getDate() - 30);
	now.setDate(now.getDate() - 1);
	now.setHours(23);
	now.setMinutes(59);
	now.setSeconds(59);
  return now.format("yyyy-MM-dd hh:mm:ss");
}

// 获取当前日期
function getTodayDate() {
	var now = new Date();
	return now.format("yyyy-MM-dd hh:mm:ss");
}

function getTodayDate2() {
	var now = new Date();
	now.setHours(0);
	now.setMinutes(0);
	now.setSeconds(0);
	return now.format("yyyy-MM-dd hh:mm:ss");
}

function getTodayDate3() {
	var now = new Date();
	now.setHours(23);
	now.setMinutes(59);
	now.setSeconds(59);
	return now.format("yyyy-MM-dd hh:mm:ss");
}

// 根据当前日期增加/减少月份
function addDateByMonth(month) {
	var now = new Date();
	now.setMonth(now.getMonth() + month);
	return now.format("yyyy-MM-dd hh:mm:ss");
}

function addDateByMonth2(month) {
	var now = new Date();
	now.setMonth(now.getMonth() + month);
	now.setHours(0);
	now.setMinutes(0);
	now.setSeconds(0);
	return now.format("yyyy-MM-dd hh:mm:ss");
}

function addDateByMonth3(month) {
	var now = new Date();
	now.setMonth(now.getMonth() + month);
	now.setHours(23);
	now.setMinutes(59);
	now.setSeconds(59);
	return now.format("yyyy-MM-dd hh:mm:ss");
}

// 日期转秒
function startDateToSecond(date) {
	var arr = date.split("-");
  var new_date = new Date(parseInt(arr[0]), parseInt(arr[1]) - 1, parseInt(arr[2]), 0, 0, 0);
  var time = new_date.getTime() / 1000;
  return time;
}

// 日期转秒
function endDateToSecond(date) {
	var arr = date.split("-");
  var new_date = new Date(parseInt(arr[0]), parseInt(arr[1]) - 1, parseInt(arr[2]), 23, 59, 59);
  var time = new_date.getTime() / 1000;
  return time;
}

// 把秒格式化时分秒
function formatSecond(value) {
	var theTime = parseInt(value);// 秒
	var theTime1 = 0;// 分
	var theTime2 = 0;// 小时
	if(theTime > 60) {
		theTime1 = parseInt(theTime / 60);
		theTime = parseInt(theTime % 60);
		if (theTime1 > 60) {
			theTime2 = parseInt(theTime1 / 60);
			theTime1 = parseInt(theTime1 % 60);
		}
	}

	var result = ""+parseInt(theTime) + "秒";
	if(theTime1 > 0) {
		result = "" + parseInt(theTime1) + "分" + result;
	}
	if(theTime2 > 0) {
		result = "" + parseInt(theTime2) + "小时" + result;
	}
	return result;
}

/*英文日期格式化为中文日期*/
function formatEnDate(date){
	if(date == "" || date == null){
		return "";
	}
	if(language == "en"){
		var zhDate = date.split("/");
		return zhDate[2]+"-"+zhDate[0]+"-"+zhDate[1];
	}else{
		return date;
	}
}

/*获取高度*/
function getGridHeight(){
	var height1 = $("#_title").height();
	var height2 = $("#_query").height() ;
	var height = document.compatMode=="CSS1Compat"?document.documentElement.clientHeight:document.body.clientHeight;
	return height - height2 - height1 - 100;
}

// 解决datagrid数据为空时 没有滚动条问题
function showDatagridScroll(datagrid) {  
  datagrid.prev(".datagrid-view2").children(".datagrid-body").html("<div style='width:" + datagrid.prev(".datagrid-view2").find(".datagrid-header-row").width() + "px;border:solid 0px;height:1px;'></div>");  
} 

//（部门）树形结构展现
$.fn.tree.defaults.loadFilter = function (data, parent) {
    var opt = $(this).data().tree.options;
    var idFiled,
    textFiled,
    parentField;
    if (opt.parentField) {
        idFiled = opt.idFiled || 'id';
        textFiled = opt.textFiled || 'text';
        parentField = opt.parentField;
        
        var i,
        l,
        treeData = [],
        tmpMap = [];
        
        for (i = 0, l = data.length; i < l; i++) {
            tmpMap[data[i][idFiled]] = data[i];
        }
        
        for (i = 0, l = data.length; i < l; i++) {
            if (tmpMap[data[i][parentField]] && data[i][idFiled] != data[i][parentField]) {
                if (!tmpMap[data[i][parentField]]['children'])
                    tmpMap[data[i][parentField]]['children'] = [];
                data[i]['text'] = data[i][textFiled];
                tmpMap[data[i][parentField]]['children'].push(data[i]);
            } else {
                data[i]['text'] = data[i][textFiled];
                treeData.push(data[i]);
            }
        }
        return treeData;
    }
    return data;
};

function setTimeSpinner() {
	$('#startDate').datetimebox({
		onShowPanel:function() {
			$(this).datetimebox("spinner").timespinner("setValue","00:00:00");
		}
	});
	
	$('#endDate').datetimebox({
		onShowPanel:function() {
			$(this).datetimebox("spinner").timespinner("setValue","23:59:59");
		}
	});
}

// 格式化任务状态
function formatTaskStatus(value, row, index) {
	var str = "";
	if (value == 1) {
		str = "初建";
	} else if (value == 2) {
		str = "执行中";
	} else if (value == 3) {
		str = "结束";
	} else if (value == 4) {
		str = "审核完成";
	}
	return str;
}

// 格式化需要复检
function formatIsNeedCheck(value, row, index) {
	/*if (value == 0) {
		return "不需要";
	} else {
		return "需要";
	}*/
	if (value == null || value == "") {
		return "不需要";
	} else {
		return "需要";
	}
}

//检查时间有效性
function check(dates){
	date =dates.substr(0,10);
	date = date.replace(/-/g, '/');
	// alert(date);
    return (new Date(date).getDate()==date.substring(date.length-2));
   // alert(new Date(date).getDate()==date.substring(date.length-2));
}

function checkEditDate(){
	var startDate = $('#editStartDate').datebox('getValue');
	var endDate = $('#editEndDate').datebox('getValue');
	if (startDate != "" && startDate.length>7) {
		if (!check(startDate)) {
			$.messager.alert('提示信息','开始时间不是有效日期，请重新输入！');
			return false;
		};
	};
	if (endDate != "" && endDate.length>7) {
		if (!check(endDate)) {
			$.messager.alert('提示信息','结束时间不是有效日期，请重新输入！');
			return false;
		};
	};
	if(endDate != ""){
		if(startDate>endDate){
			$.messager.alert("提示信息","开始时间大于结束时间，请重新输入！");
			return false;
		}else{
			return true;
		}
	}else{
		return true;
	}
}

function checkDate(){
	var startDate = $('#startDate').datebox('getValue');
	var endDate = $('#endDate').datebox('getValue');check(startDate);
	if (startDate != "" && startDate.length>7) {
		if (!check(startDate)) {
			$.messager.alert('提示信息','开始时间不是有效日期，请重新输入！');
			return false;
		};
	};
	if (endDate != "" && endDate.length>7) {
		if (!check(endDate)) {
			$.messager.alert('提示信息','结束时间不是有效日期，请重新输入！');
			return false;
		};
	};
	
	if(endDate != ""){
		if(startDate>endDate){
			$.messager.alert("提示信息","开始时间大于结束时间，请重新输入！");
			return false;
		}else{
			return true;
		}
	}else{
		return true;
	}
}

function checkDetailDate(){
	var startDate = $('#recordStartDate').datebox('getValue');
	var endDate = $('#recordEndDate').datebox('getValue');
	if (startDate != "" && startDate.length>7) {
	if (check(startDate)==false) {
		$.messager.alert('提示信息','开始时间不是有效日期，请重新输入！');
		return false;
	};
};


if (endDate != "" && endDate.length>7) {
	if (check(endDate)==false) {
		$.messager.alert('提示信息','结束时间不是有效日期，请重新输入！');
		return false;
	};
};
	if(endDate != ""){
		if(startDate>endDate){
			$.messager.alert("提示信息","开始时间大于结束时间，请重新输入！");
			return false;
		}else{
			return true;
		}
	}else{
		return true;
	}
}

function getTimeFromSeconds(totalSeconds) {  
    if (totalSeconds < 86400) {  
        var dt = new Date("01/01/2000 0:00");  
        dt.setSeconds(totalSeconds);  
        return formatTime(dt);  
    } else {  
        return null;  
    }  
}  

//秒转化为HH:MM:ss
function formatTime(dt) {  
    var h = dt.getHours(),  
        m = dt.getMinutes(),  
        s = dt.getSeconds(),  
        r = "";  
    if (h > 0) {  
        r += (h > 9 ? h.toString() : "0" + h.toString()) + ":";  
    }  
    r += (m > 9 ? m.toString() : "0" + m.toString()) + ":"  
    r += (s > 9 ? s.toString() : "0" + s.toString());  
    return r;  
}

//datagrid序号栏宽度自适应
$.extend($.fn.datagrid.methods, {
    fixRownumber : function (jq) {
        return jq.each(function () {
            var panel = $(this).datagrid("getPanel");
            //获取最后一行的number容器,并拷贝一份
            var clone = $(".datagrid-cell-rownumber", panel).last().clone();
            //由于在某些浏览器里面,是不支持获取隐藏元素的宽度,所以取巧一下
            clone.css({
                "position" : "absolute",
                left : -1000
            }).appendTo("body");
            var width = clone.width("auto").width();
            //默认宽度是25,所以只有大于25的时候才进行fix
            if (width > 25) {
                //多加5个像素,保持一点边距
                $(".datagrid-header-rownumber,.datagrid-cell-rownumber", panel).width(width + 15);
                //修改了宽度之后,需要对容器进行重新计算,所以调用resize
                $(this).datagrid("resize");
                //一些清理工作
                clone.remove();
                clone = null;
            } else {
                //还原成默认状态
                $(".datagrid-header-rownumber,.datagrid-cell-rownumber", panel).removeAttr("style");
            }
        });
    }
});

//查询项目名称
var currentProjectData = "";
var currentProjectName = "";
$.ajax({
	url: "../project/data/project.name.retrieve.php",
	type: 'get',
	async: false,
	dataTye: 'json',
	success: function (data) {
		currentProjectData = eval('(' + data + ')');
		currentProjectName = currentProjectData.rows[0].project_name;
	}
})
