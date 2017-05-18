// strPrintName 打印任务名
// printDatagrid 要打印的datagrid
// divContent1 datagrid之前打印的内容
// divContent2 datagrid之后打印的内容
function CreateFormPage(strPrintName, printDatagrid, divContent1, divContent2) {
    var tableString = '<table cellspacing="0" class="pb">';
    var frozenColumns = printDatagrid.datagrid("options").frozenColumns;  // 得到frozenColumns对象
    var columns = printDatagrid.datagrid("options").columns;    // 得到columns对象
    var nameList = '';
    var formatter = new Array();// 用于处理formatter的内容

    // 载入title
    if (typeof columns != 'undefined' && columns != '') {
        $(columns).each(function (index) {
            tableString += '\n<tr>';
            if (typeof frozenColumns != 'undefined' && typeof frozenColumns[index] != 'undefined') {
            	if (frozenColumns[index].checkbox) {
            			alert(index);
            		}
                for (var i = 0; i < frozenColumns[index].length; ++i) {
                    if (!frozenColumns[index][i].hidden && !frozenColumns[index][i].checkbox && frozenColumns[index][i].field != '') {
                        tableString += '\n<th width="' + frozenColumns[index][i].width + '"';
                        if (typeof frozenColumns[index][i].rowspan != 'undefined' && frozenColumns[index][i].rowspan > 1) {
                            tableString += ' rowspan="' + frozenColumns[index][i].rowspan + '"';
                        }
                        if (typeof frozenColumns[index][i].colspan != 'undefined' && frozenColumns[index][i].colspan > 1) {
                            tableString += ' colspan="' + frozenColumns[index][i].colspan + '"';
                        }
                        if (typeof frozenColumns[index][i].field != 'undefined' && frozenColumns[index][i].field != '') {
                            nameList += ',{"f":"' + frozenColumns[index][i].field + '", "a":"' + frozenColumns[index][i].align + '"}';
                        }
                        tableString += '>' + frozenColumns[0][i].title + '</th>';
                    }
                }
            }
            for (var i = 0; i < columns[index].length; ++i) {
                if (!columns[index][i].hidden && !columns[index][i].checkbox && columns[index][i].field != '') {
                    tableString += '\n<th width="' + columns[index][i].width + '"';
                    if (typeof columns[index][i].rowspan != 'undefined' && columns[index][i].rowspan > 1) {
                        tableString += ' rowspan="' + columns[index][i].rowspan + '"';
                    }
                    if (typeof columns[index][i].colspan != 'undefined' && columns[index][i].colspan > 1) {
                        tableString += ' colspan="' + columns[index][i].colspan + '"';
                    }
                    if (typeof columns[index][i].field != 'undefined' && columns[index][i].field != '') {
                        nameList += ',{"f":"' + columns[index][i].field + '", "a":"' + columns[index][i].align + '"}';
                    }
                    tableString += '>' + columns[index][i].title + '</th>';
                    
                    if (typeof columns[index][i].formatter != 'undefined') {
                    	//formatter.push(eval(columns[index][i].formatter));
                    	var fun = eval(columns[index][i].formatter);
                    	if (fun == 'undefined') {
                    		formatter.push(null);
                    	} else {
                    		formatter.push(fun);
                    	}
                    } else {
                    	formatter.push(null);
                    }
                } 
            }
            tableString += '\n</tr>';
        });
    }
    // 载入内容
    var rows = printDatagrid.datagrid("getRows"); // 这段代码是获取当前页的所有行
    var nl = eval('([' + nameList.substring(1) + '])');
    for (var i = 0; i < rows.length; ++i) {
        tableString += '\n<tr>';
        $(nl).each(function (j) {
            var e = nl[j].f.lastIndexOf('_0');
            
            tableString += '\n<td';
            if (nl[j].a != 'undefined' && nl[j].a != '') {
                tableString += ' style="text-align:' + nl[j].a + ';"';
            }
            tableString += '>';
 
            if (formatter[j] != null) {// 处理formatter的内容
            	var val = '';
            	if (e + 2 == nl[j].f.length) {
            		val = rows[i][nl[j].f.substring(0, e)];
	            }
	            else {
	            	val = rows[i][nl[j].f];
	            }
            	tableString += formatter[j](val, rows[i], i);
            } else {
            	if (e + 2 == nl[j].f.length) {
                tableString += rows[i][nl[j].f.substring(0, e)];
	            }
	            else {
	              tableString += rows[i][nl[j].f];
	            }
            }
            
            tableString += '</td>';
        });
        tableString += '\n</tr>';
    }
    tableString += '\n</table>';
    if (divContent1) {
    	tableString = divContent1 + tableString;
    }
    if (divContent2) {
    	tableString = tableString + divContent2;
    }
    if(navigator.userAgent.indexOf("Chrome") >0 ){
    	window.open("../utils/print.php", tableString,
        "location:No;status:No;help:No;dialogWidth:800px;dialogHeight:600px;scroll:auto;");
    }else{
    	window.showModalDialog("../utils/print.php", tableString,
        "location:No;status:No;help:No;dialogWidth:800px;dialogHeight:600px;scroll:auto;");
    }
}

function allPrpos(obj) {
	var props = "";// 用来保存所有的属性名称和值
	for(var p in obj) {
		if (typeof(obj[p]) == "function"){// 方法
			obj[p]();
		} else {// 属性
			props += p + "=" + obj[p] + " ";
		}
	}
	alert(props);
}