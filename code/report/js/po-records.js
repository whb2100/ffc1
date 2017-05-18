var language = $("#language").val();

/*搜索条件*/
function getParams(){
	var arr = new Object();
	var date = formatEnDate($('#startDate').datebox('getValue'));
	arr['start_date'] = date;
	return arr;
}

function changeMix(newValue, oldValue){
	if(newValue.value == 1){
		searchNoMix();
		document.getElementById('mixDiv').style.display = "none";
		document.getElementById('noMixDiv').style.display = "block";
	}else{
		$("#itemList").datagrid('load');
		document.getElementById('mixDiv').style.display = "block";
		document.getElementById('noMixDiv').style.display = "none";
	}
}

$(function(){
	$("#ifMixed").combobox({
		onSelect:changeMix
	});
	$("#ifMixed").combobox('setValue',0);
	var datagrid;
    datagrid = $("#itemList").datagrid({
		height:getGridHeight(),
		width:'91%',
		title:'',
		idField:'detail_id',
		singleSelect:true,
		url:'../poInput/data/batch.records.retrieve.php',
		loadMsg:'',
		pagination:true,
		pageSize:100000,
		pageList:[100000],
		rownumbers:true,
		onLoadSuccess:removeLoader,
		columns:[[
		          {title:BATCH_MAIN_CODE,field:'main_code',  width: '15%', align: 'left',halign: 'center' },
		          {title:BATCH_SUB_CODE,field:'sub_code',  width: '15%', align: 'left',halign: 'center' },
		          {title:BATCH_AMOUNT,field:'amount',  width: '15%', align: 'right',halign: 'center' ,
		        	  formatter:function(value,rowData,rowIndex){
		        		var amount = value*rowData.exchange_rate;
		        		if(parseInt(amount) === amount){
		        			amount = amount+'.00';
		        		}
	        	  	 	if(value != null){
						    var parts = amount.toString().split(".");
						    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
						    return parts.join(".");
						}else{
							return amount;
						}
					 }
			      },
		          {title:BATCH_DESC,field:'detail_desc',  width: '35%', align: 'left',halign: 'center' },
		          {title:PO_CREATE_DATE,field:'detail_record_date',  width: '18%', align: 'center',halign: 'center' }
          ]]
      });
})

/*重新加载表格*/
function reloadgrid(){
	searchNoMix();
	$("#itemList").datagrid('reload',getParams());
}

/*查询不混合数据*/
function searchNoMix(){
	$("#noMixDiv").empty();
	var currencyData = "";
	var dateMix = formatEnDate($('#startDate').datebox('getValue'));
	$.ajax({
		url: "../poInput/data/batch.currency.retrieve.php?start_date="+dateMix,
		type: 'get',
		async: false,
		dataTye: 'json',
		success: function (data) {
			currencyData = eval('(' + data + ')');
		}
	})
	for (var i = 0; i < currencyData.length; i++) {
			$("#noMixDiv").append("<div id='currencyList"+currencyData[i].currency_code+"'></div><br>");
			$("#currencyList"+currencyData[i].currency_code).datagrid({
				autoHeight:true,
				width:'91%',
				title:currencyData[i].currency_type,
				url:'../poInput/data/batch.records.retrieve.php?currency='+currencyData[i].currency_code+'&start_date='+dateMix,
				idField:'detail_id',
				singleSelect:true,
				loadMsg:'',
				pagination:true,
				pageSize:20,
				pageList:[20,50,100],
				rownumbers:true,
				onLoadSuccess:removeLoader,
				columns:[[
				          {title:BATCH_MAIN_CODE,field:'main_code',  width: '12%', align: 'left',halign: 'center' },
				          {title:BATCH_SUB_CODE,field:'sub_code',  width: '12%', align: 'left',halign: 'center' },
				          {title:BATCH_AMOUNT,field:'amount',  width: '15%', align: 'right',halign: 'center' ,
				        	  formatter:function(value,rowData,rowIndex){
				        		var amount = value;
				        		if(parseInt(amount) === amount){
				        			amount = amount+'.00';
				        		}
			        	  	 	if(value != null){
								    var parts = amount.toString().split(".");
								    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
								    return parts.join(".");
								}else{
									return amount;
								}
							 }
					      },
				          {title:BATCH_DESC,field:'detail_desc',  width: '35%', align: 'left',halign: 'center' },
				          {title:PO_CREATE_DATE,field:'detail_record_date',  width: '18%', align: 'center',halign: 'center' }
		          ]]
		      });
		}
}

/*导出*/
function ExcleFunction(){
	var time = formatEnDate($('#startDate').datebox('getValue'));
	window.open("data/po.records.pdf.php?report_type=5&start_date="+time, "_blank");
}

/*获取高度*/
function getGridHeight(){
	var height1 = $("#_title").height();
	var height2 = $("#_query").height() ;
	var height = document.compatMode=="CSS1Compat"?document.documentElement.clientHeight:document.body.clientHeight;
	return height - height2 - height1 - 100;
}
