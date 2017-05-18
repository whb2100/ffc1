$(function() {
	$('#departmentTree').tree({    
		url: "data/department.tree.retrieve.php",  
		parentField:"parent_id",
	    textFiled:"dept_name",
	    idFiled:"dept_id",
	});
	
	var userId = $("#formUserId").val();
	$.post('data/user.retrieve.php', {user_id : userId}, function(data) {
		var data = eval("(" + data + ")");
		$("#formUserEmpcode").val(data.rows[0].user_empcode);
		$("#formUserRealname").val(data.rows[0].user_realname);
		$("#formUserRank").val(data.rows[0].user_rank);
		$("#formUserEmail").val(data.rows[0].user_email);
		$("#formUserMobile").val(data.rows[0].user_mobile);
		$("#userOldImg").val(data.rows[0].user_img);
		$("#departmentId").val(data.rows[0].depart_id);
		var userStatus = data.rows[0].user_status;
		if (userStatus == "0") {
			$("#formUserStatus-disable").attr('checked', 'checked');
		} else {
			$("#formUserStatus-enable").attr('checked', 'checked');
		}
		$("#formUserDesc").val(data.rows[0].user_desc);
		var departId = data.rows[0].depart_id;
		if(departId == null){
			$("#departName").html();
		}else{
			$.ajaxSetup({
				async: false
			});
			$.post('data/department.name.retrieve.php', {dept_id : departId},function(data){
				var data = eval("(" + data + ")");
				$("#departName").html(data.name);
			});
		}
	});
	
	$('#departmentTree').tree({
		onClick: function(node){
			$('#departmentId').val(node.dept_id);
		}
	});
	
	$("#allocatedRole").datagrid({
		title : '用户角色选择',
		height : '200px',
		idField : 'role_id',
		checkbox : true,
		url : 'data/role.retrieve.php?role_status=1',
		onLoadSuccess:lazyLoad(userId),
		columns : [ [ {
			title : '权限ID',
			field : 'role_id',
			width : 100,
			align : 'center',
			checkbox : true
		}, {
			title : '权限名称',
			field : 'role_name',
			width : 150,
			align : 'center'
		} ] ]
	});
	$.extend($.fn.validatebox.defaults.rules, {
   	//验证登录账号是否重复
		repeat: {
				validator: function(value){
					var userEmpcode = $("#userEmpcode").val();
	   				var isExist = false;
						if(userEmpcode == value){
							isExist = true;
						}else{
							$.ajaxSetup({async : false}); 
							$.post('data/user.isrepeat.php',{user_empcode:value},function(data){
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
   			message: "登录账号已被使用"
   		},
	});
})

function finish(){
	
}

$(function() {
	$.extend(
					$.fn.validatebox.defaults.rules,
					{
						//验证手机号
						mobile : {
							validator : function(value) {
								var reg = /^1[3|4|5|7|8|9]\d{9}$/;
								return reg.test(value);
							},
							message : '输入手机号码格式不准确.'
						},

						// 验证电话号码
						phone : {
							validator : function(value) {
								var reg = /^((0\d{2,3})-)(\d{7,8})(-(\d{3,}))?$/;
								return reg.test(value);
							},
							message : '格式不正确,请使用下面格式:XXXX-XXXXXXX，XXXX-XXXXXXXX，XXX-XXXXXXX，XXX-XXXXXXXX，XXXXXXX，XXXXXXXX。'
						},

						//验证身份证号
						idcard : {
							validator : function(value) {
								var flag = IdCardValidate(value);
								return flag == true ? true : false;
							},
							message : "证件号码格式错误！"
						}
					});
});

function submitFunction() {
	 var d_id=$('#departmentId').val();
	 var d_name=$('#departName').text();
	 if ((!d_id)&&(!d_name)) {
		 $.messager.alert("提示信息", '部门不允许为空！');
	 	 return;
	 };
	var isValid = $("#sysUserRegisterForm").form('validate');
	var rows = $("#allocatedRole").datagrid('getSelections');
	var roleIds = "";
	for (var i = 0; i < rows.length; i++) {
		if (i == 0) {
			roleIds = rows[i].role_id;
		} else {
			roleIds += "," + rows[i].role_id;
		}
	}
	$("#roleIds").val(roleIds);
	
	var isValid = $("#sysUserRegisterForm").form('validate');
	if (isValid) {
		$.messager.confirm('操作提示', '确认提交数据？', function(isConfirm) {
			if (isConfirm) {
				$("#sysUserRegisterForm").form('submit', {
					success : function(data) {
						var data = eval("(" + data + ")");
						if (data.result == 10000) {
							$("#allocatedRole").datagrid("uncheckAll");
							location.href = "user-list.php";
						} else if (data.result == 10001) {
							$.messager.alert("提示信息", data.msg);
						}
					}
				})
			}
		})
	}
}

function cancelFunction() {
	location.href = "user-list.php";
}

var timer;

function lazyLoad(userId){
	setTimeout("selectRole("+userId+")",100);
}

function selectRole(userId){
	$.post('data/userrole.retrieve.php',{user_id:userId},function(data){
		var data = eval('(' + data + ')');
		for(var i=0; i<data.length; i++){
			$("#allocatedRole").datagrid('selectRecord',data[i].role_id);
		}
	});
}

var Wi = [ 7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2, 1 ]; // 加权因子   
var ValideCode = [ 1, 0, 10, 9, 8, 7, 6, 5, 4, 3, 2 ]; // 身份证验证位值.10代表X   
function IdCardValidate(idCard) {
	idCard = trim(idCard.replace(/ /g, "")); //去掉字符串头尾空格                     
	if (idCard.length == 15) {
		return isValidityBrithBy15IdCard(idCard); //进行15位身份证的验证    
	} else if (idCard.length == 18) {
		var a_idCard = idCard.split(""); // 得到身份证数组   
		if (isValidityBrithBy18IdCard(idCard)
				&& isTrueValidateCodeBy18IdCard(a_idCard)) { //进行18位身份证的基本验证和第18位的验证
			return true;
		} else {
			return false;
		}
	} else {
		return false;
	}
}
/**  
 * 判断身份证号码为18位时最后的验证位是否正确  
 * @param a_idCard 身份证号码数组  
 * @return  
 */
function isTrueValidateCodeBy18IdCard(a_idCard) {
	var sum = 0; // 声明加权求和变量   
	if (a_idCard[17].toLowerCase() == 'x') {
		a_idCard[17] = 10; // 将最后位为x的验证码替换为10方便后续操作   
	}
	for (var i = 0; i < 17; i++) {
		sum += Wi[i] * a_idCard[i]; // 加权求和   
	}
	valCodePosition = sum % 11; // 得到验证码所位置   
	if (a_idCard[17] == ValideCode[valCodePosition]) {
		return true;
	} else {
		return false;
	}
}
/**  
 * 验证18位数身份证号码中的生日是否是有效生日  
 * @param idCard 18位书身份证字符串  
 * @return  
 */
function isValidityBrithBy18IdCard(idCard18) {
	var year = idCard18.substring(6, 10);
	var month = idCard18.substring(10, 12);
	var day = idCard18.substring(12, 14);
	var temp_date = new Date(year, parseFloat(month) - 1, parseFloat(day));
	// 这里用getFullYear()获取年份，避免千年虫问题   
	if (temp_date.getFullYear() != parseFloat(year)
			|| temp_date.getMonth() != parseFloat(month) - 1
			|| temp_date.getDate() != parseFloat(day)) {
		return false;
	} else {
		return true;
	}
}
/**  
 * 验证15位数身份证号码中的生日是否是有效生日  
 * @param idCard15 15位书身份证字符串  
 * @return  
 */
function isValidityBrithBy15IdCard(idCard15) {
	var year = idCard15.substring(6, 8);
	var month = idCard15.substring(8, 10);
	var day = idCard15.substring(10, 12);
	var temp_date = new Date(year, parseFloat(month) - 1, parseFloat(day));
	// 对于老身份证中的你年龄则不需考虑千年虫问题而使用getYear()方法   
	if (temp_date.getYear() != parseFloat(year)
			|| temp_date.getMonth() != parseFloat(month) - 1
			|| temp_date.getDate() != parseFloat(day)) {
		return false;
	} else {
		return true;
	}
}
//去掉字符串头尾空格   
function trim(str) {
	return str.replace(/(^\s*)|(\s*$)/g, "");
}