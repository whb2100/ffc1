$("#pName").html(currentProjectName+">");

var projectData = "";
var projectName = "";
$.ajax({
	url: "../project/data/project.name.retrieve.php",
	type: 'get',
	async: false,
	dataTye: 'json',
	success: function (data) {
		projectData = eval('(' + data + ')');
		projectName = projectData.rows[0].project_name;
	}
})

$(function(){
	var datagrid;
    var editRow = undefined;
    datagrid = $("#itemList").datagrid({
		height:getGridHeight(),
		width:'91%',
		title:'',
		idField:'vouchers_id',
		singleSelect:true,
		url:'data/vouchers.retrieve.php',
		loadMsg:'',
		pagination:true,
		pageSize:20,
		pageList:[20,50,100],
		rownumbers:true,
		onLoadSuccess:removeLoader,
		columns:[[
		          {title:VOUCHERS_NAME,field:'vouchers_name',  width: '25%', align: 'left',halign: 'center',sortable:true},
//		          {title:VOUCHERS_TYPE,field:'vouchers_type',  width: '10%', align: 'left',halign: 'center',
//		        	  formatter:function(value){
//		        		  var text = '';
//		        		  switch (Number(value)) {
//						case -1:
//							text="凭证";
//							break;
//						case -2:
//							text="合同";
//							break;
//						default:
//							break;
//						}
//	        		  return text;
//		        	  }
//		          },
		          {title:VOUCHERS_DATE,field:'create_date',  width: '40%',halign: 'center', align: 'center',sortable:true},
		          {title:BASIC_SET,field:BASIC_SET,  width: '35%', halign: 'center', align: 'left',
		        	  formatter:function(value, row, index) {
		        		  return "<div style='text-align: center;'><span><p><a href='javascript:void(0)' onclick='showPic("+index+")'>"+VOUCHERS_SHOW_PIC+"</a></p></span></div>";
		        	  }
				  }
          ]]
      });
    
	$('#vouchersTree').tree({    
		url:'data/vouchers.retrieve.tree.php?name='+projectName,
		parentField:"vouchers_type",
	    textFiled : "vouchers_name",
	    idFiled : "vouchers_id"
	});
	$('#vouchersTree').tree({
		onClick: function(node){
			if(node.vouchers_pic != undefined){
				var name = node.vouchers_name;
				var parts = name.toString().split(".");
				$("#itemList").datagrid('reload',{
					vouchers_id:node.vouchers_id
				})
				if(parts[1] == "jpg"){
					document.getElementById('vouchersPicShow').src = node.vouchers_pic;
					$("#showPicDialog").dialog("open").dialog('setTitle', '新增凭证'); 
					$("#showPicDialog").dialog("move",{top:$(document).scrollTop() + ($(window).height() - $("#showPicDialog").height() - 50) * 0.5});
				}else{
					var pic = document.getElementById("vouchersPicShow").src = node.vouchers_pic;
					var win = window.open(pic, '', 'height=500px, width=800px, top=50, left=300, toolbar=no, menubar=no, scrollbars=no, resizable=no, location=no, status=no');
				}
			}else{
				if(node.vouchers_id == -1){
					$("#itemList").datagrid('reload',{
						vouchers_type:-1
					});
				}else if(node.vouchers_id == -2){
					$("#itemList").datagrid('reload',{
						vouchers_type:-2
					});
				}else if(node.vouchers_id == -3){
					$("#itemList").datagrid('reload',{
						vouchers_id:''
					});
				}
			}
		}
	});
    
})

//搜索
function searchVouchers(){
	$("#itemList").datagrid('reload',{
		vouchers_name:$("#vouchersName").val()
	})
}

function changeFunction(obj) {  
	var len=obj.files.length;
	var message = VOUCHERS_MESSAGE1+len+VOUCHERS_MESSAGE2;
	$("#chooseMessage").html(message);
}

/*新增凭证*/
function addVouchers(){
	$("#vouchersForm").form('clear');
	$("#chooseMessage").html("");
	$("#projectName").val(projectName);
	$("#vouchersType").val(-1);
	$("#checkPwdDialog").dialog("open").dialog('setTitle', 'new'); 
	$("#checkPwdDialog").dialog("move",{top:$(document).scrollTop() + ($(window).height() - $("#checkPwdDialog").height() - 50) * 0.5});
}

/*新增合同*/
//function addContract(){
//	$("#vouchersForm").form('clear');
//	$("#chooseMessage").html("");
//	$("#projectName").val(projectName);
//	$("#vouchersType").val(-2);
//	$("#checkPwdDialog").dialog("open").dialog('setTitle', 'new'); 
//	$("#checkPwdDialog").dialog("move",{top:$(document).scrollTop() + ($(window).height() - $("#checkPwdDialog").height() - 50) * 0.5});
//}

/*保存*/
function createItem(index){
	showLoader();
	$("#vouchersForm").form("submit", {
        success: function (data) {
        	var data = eval("(" + data + ")");
            if (data.result == "10000") {
            	$.messager.alert(BASSIC_MESSAGE, data.msg);
                $("#checkPwdDialog").dialog("close");
				$("#itemList").datagrid('reload',{
					vouchers_id:''
				});
            	$('#vouchersTree').tree({    
            		url:'data/vouchers.retrieve.tree.php?name='+projectName,
            		parentField:"vouchers_type",
            	    textFiled : "vouchers_name",
            	    idFiled : "vouchers_id"
            	});
            	removeLoader();
            }else if(data.result == "100"){
            	removeLoader();
            	$.messager.alert(BASSIC_MESSAGE, VOUCHERS_PDF);
            }else{
            	removeLoader();
            	$.messager.alert(BASSIC_MESSAGE, data.msg);
            }
        }
    });
}

/*图片预览*/
function showPic(index){
	var row = $('#itemList').datagrid('getRows')[index];
	var name = row.vouchers_name;
	var parts = name.toString().split(".");
	if(parts[1] == "jpg"){
		document.getElementById('vouchersPicShow').src = row.vouchers_pic;
		$("#showPicDialog").dialog("open").dialog('setTitle', '新增凭证'); 
		$("#showPicDialog").dialog("move",{top:$(document).scrollTop() + ($(window).height() - $("#showPicDialog").height() - 50) * 0.5});
	}else{
		var pic = document.getElementById("vouchersPicShow").src = row.vouchers_pic;
		var win = window.open(pic, '', 'height=500px, width=800px, top=50, left=300, toolbar=no, menubar=no, scrollbars=no, resizable=no, location=no, status=no');
	}
}

/*获取高度*/
function getGridHeight(){
	var height1 = $("#_title").height();
	var height2 = $("#_query").height() ;
	var height = document.compatMode=="CSS1Compat"?document.documentElement.clientHeight:document.body.clientHeight;
	return height - height2 - height1 - 100;
}