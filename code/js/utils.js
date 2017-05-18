// JScript �������ļ�
/**
 * 
 */
function desTrim(str){
	var pos = str.indexOf(' ');
	return str.substring(0, pos);
} 

/**
* ɾ���������˵Ŀո�
*/
function trim(str)
{
    //return str.replace(/(^\s*)|(\s*$)/g, '');	
	return str.replace(/^\s+|\s+$/g,"");	
}
/**
* ɾ����ߵĿո�
*/
function ltrim(str)
{
     return str.replace(/(^\s*)/g,'');
}
/**
* ɾ���ұߵĿո�
*/
function rtrim(str)
{
     return str.replace(/(\s*$)/g,'');
}

function getCurrentDatetimeStr(){  //��ȡ��ǰ��datetime	
	var curr_time = new Date();
	var strDate = curr_time.getFullYear()+"-";
	strDate += curr_time.getMonth()+1+"-";
	strDate += curr_time.getDate()+"-";
	strDate += ' ';
	strDate += curr_time.getHours()+":";
	strDate += curr_time.getMinutes()+":";
	strDate += curr_time.getSeconds();
	return strDate;		
};

function getDatetimeStrAfterCurrent(years){  //��ȡ��������datetime	
	var curr_time = new Date();
	var yearStr = curr_time.getFullYear()+years;
	//alert(yearStr);
	var strDate = yearStr+"-";
	strDate += curr_time.getMonth()+1+"-";
	strDate += curr_time.getDate()+"-";
	strDate += ' ';
	strDate += curr_time.getHours()+":";
	strDate += curr_time.getMinutes()+":";
	strDate += curr_time.getSeconds();
	return strDate;		
};

/*获取高度*/
function getGridHeight(){
	var height1 = $("#_title").height();
	var height2 = $("#formDiv").height() ;
	var height = document.compatMode=="CSS1Compat"?document.documentElement.clientHeight:document.body.clientHeight;
	return height - height2 - height1 - 100;
};

//复选框全选
//复选框
function checkAll(checkName,checkId){
	this.checkName = checkName;
	this.checkId = checkId;
}
checkAll.prototype.checkAllName = function(){
	for(var i = 0; i < this.checkName.length; i++){
		if(this.checkId.checked== true){
			this.checkName[i].checked = true;
		}else{
			this.checkName[i].checked = false;
		}
	}
}

//新建提交
function submitCreate(formName,listName){
	this.formName = formName;
	this.listName = listName;
}
submitCreate.prototype.submit = function(){
	var form = this.formName;
	var list= this.listName;
	var isValid = form.form('validate');
	if(isValid){
		$.messager.confirm('操作提示','确认提交数据？',function(isConfirm){
			if(isConfirm){
				form.form('submit',{
					success:function(data){
						form.form('clear');
						var data = eval("(" + data + ")");
						var resultObj = data.obj;
						if(data.result == 10000){
							if(resultObj.length > 1){
								 for(var i = 0; i < resultObj.length; i++){
									 list.datagrid('appendRow',resultObj[i]);
								 }
							 }else{
							 	 list.datagrid('appendRow',resultObj);
							 }
						 	 $.messager.alert("提示信息", data.msg);
						}else if(data.result == 10001){
							$.messager.alert("提示信息", data.msg);
						}
					}
				})
			}
		})
	}
}

//加法函数  
function accAdd(arg1, arg2) {  
    var r1, r2, m;  
    try {  
        r1 = arg1.toString().split(".")[1].length;  
    }  
    catch (e) {  
        r1 = 0;  
    }  
    try {  
        r2 = arg2.toString().split(".")[1].length;  
    }  
    catch (e) {  
        r2 = 0;  
    }  
    m = Math.pow(10, Math.max(r1, r2));  
    return (arg1 * m + arg2 * m) / m;  
}   
//给Number类型增加一个add方法，，使用时直接用 .add 即可完成计算。   
Number.prototype.add = function (arg) {  
    return accAdd(arg, this);  
};  
  
//减法函数  
function Subtr(arg1, arg2) {  
    var r1, r2, m, n;  
    try {  
        r1 = arg1.toString().split(".")[1].length;  
    }  
    catch (e) {  
        r1 = 0;  
    }  
    try {  
        r2 = arg2.toString().split(".")[1].length;  
    }  
    catch (e) {  
        r2 = 0;  
    }  
    m = Math.pow(10, Math.max(r1, r2));  
     //last modify by deeka  
     //动态控制精度长度  
    n = (r1 >= r2) ? r1 : r2;  
    return ((arg1 * m - arg2 * m) / m).toFixed(n);  
}  
  
//给Number类型增加一个sub方法，，使用时直接用 .sub 即可完成计算。   
Number.prototype.sub = function (arg) {  
    return Subtr(this, arg);  
};  
  
//乘法函数  
function accMul(arg1, arg2) {  
    var m = 0, s1 = arg1.toString(), s2 = arg2.toString();  
    try {  
        m += s1.split(".")[1].length;  
    }  
    catch (e) {  
    }  
    try {  
        m += s2.split(".")[1].length;  
    }  
    catch (e) {  
    }  
    return Number(s1.replace(".", "")) * Number(s2.replace(".", "")) / Math.pow(10, m);  
}   
//给Number类型增加一个mul方法，使用时直接用 .mul 即可完成计算。   
Number.prototype.mul = function (arg) {  
    return accMul(arg, this);  
};   
  
//除法函数  
function accDiv(arg1, arg2) {  
    var t1 = 0, t2 = 0, r1, r2;  
    try {  
        t1 = arg1.toString().split(".")[1].length;  
    }  
    catch (e) {  
    }  
    try {  
        t2 = arg2.toString().split(".")[1].length;  
    }  
    catch (e) {  
    }  
    with (Math) {  
        r1 = Number(arg1.toString().replace(".", ""));  
        r2 = Number(arg2.toString().replace(".", ""));  
        return (r1 / r2) * pow(10, t2 - t1);  
    }  
}   
//给Number类型增加一个div方法，，使用时直接用 .div 即可完成计算。   
Number.prototype.div = function (arg) {  
    return accDiv(this, arg);  
}; 

//var _hmt = _hmt || [];
//(function() {
//  var hm = document.createElement("script");
//  hm.src = "//hm.baidu.com/hm.js?803d983e925b2689cef0c06d031fee31";
//  var s = document.getElementsByTagName("script")[0]; 
//  s.parentNode.insertBefore(hm, s);
//})();
