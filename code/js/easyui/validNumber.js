$(function(){
	$.extend($.fn.validatebox.defaults.rules, {    
		naturalNumber: {    
			validator: function(value){
				var reg = /^[0-9]+$/;
				return reg.test(value);
			},   
	        message: '该输入项必须是非负整数'   
	    },
	    number:{
	    	validator: function(value){
				return !isNaN(value);
			},   
	        message: '该输入项必须是数字'   
	    }
	});  
})
//浮点类型乘法运算用来得到精确计算结果
function FloatMul(arg1, arg2) {
    var m = 0, s1 = arg1.toString(), s2 = arg2.toString();
    try { m += s1.split(".")[1].length } catch (e) { }
    try { m += s2.split(".")[1].length } catch (e) { }
    return Number(s1.replace(".", "")) * Number(s2.replace(".", "")) / Math.pow(10, m)
}
//给Number类型增加一个mul方法，调用起来更加方便。 
Number.prototype.mul = function (arg){ 
	return FloatMul(arg, this); 
} 