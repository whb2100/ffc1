<?php include '../common/session_init.php';?>
<?php include '../common/sessionCheck.php';?>
<?php include '../common/resourceCheck.php';?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <?php include '../common/include_css.php';?>
    </head>
    
    <body>
		<div class="am-cf admin-main">
            <div class="admin-content" >
              <div class="am-cf am-padding" id="_title">
            	  <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">资源管理</strong> / <small>资源列表</small></div>
              </div>
              <div class="am-g">
                	<div class="col-md-6 am-cf" id="_query" style="width: 100%">
        				<div>
        					资源名称：<input class="easyui-textbox" type="text" style="width: 180px;height:28px" name="resource_name" id="resourceName">
        					<div style="float:right;margin-top:-10px;margin-right:3px">
								<div style="cursor:pointer;float:left;"><img src="../img/tys_icon_search.png" onclick="reloadgrid();" /></div>
								<div style="cursor:pointer;float:left;margin-left:2px;"><img src="../img/tys_icon_add.png" onclick="addResource();" /></div>
								<div style="cursor:pointer;float:left;margin-left:2px;"><img src="../img/tys_icon_change.png" onclick="editResource();" /></div>
								<div style="cursor:pointer;float:left;margin-left:2px;"><img src="../img/tys_icon_export.png" onclick="exportExccel();" /></div>
							</div>
    					</div>
            		</div>
              </div>
              <div id="resourceList"></div>
            </div>
		</div>
		
		<!--新增，修改dialog-->
		<div id="resourceDialog" class="easyui-dialog" style="width: 400px; height: 450px; padding: 10px 20px;"
       closed="true" buttons="#resource-buttons">
       <form id="resourceForm" method="post">
       <input id="dialogResourceId" type="hidden" name="resource_id">
        <div style="margin-bottom:15px">
             <span>资源名称：</span>
             <input style="height:20px;width:150px;margin-left:13px" class="easyui-validatebox textbox" type="text" id="dialogResourceName" name="resource_name" data-options="required:true,validType:'repeat'" missingMessage="请填写资源名称"></input>
        </div>
        <div style="margin-bottom:15px">
             <span>资源路径：</span>
             <input style="height:20px;width:150px;margin-left:13px" class="easyui-validatebox textbox" type="text" id="dialogResourceUrl" name="resource_url" data-options="required:true,validType:'repeatUrl'"  missingMessage="请填写资源路径"></input>
        </div>
        <div style="margin-bottom:15px">
             <span>资源类型：&nbsp&nbsp&nbsp&nbsp</span>
             <select name="resource_type" style="width: 150px" id="dialogResourceType" class="easyui-combobox"  data-options="required:true">
             	<option value="1">菜单资源</option>
             	<option value="2">按钮资源</option>
             	<option value="3">公共资源</option>
             </select>
        </div>
        <div style="margin-bottom:15px">
             <span>选择父目录：</span>
             <select style="width: 150px" id="dialogResourceparentName" name="resourceparent_id" class="easyui-combobox" >
             </select>
        </div>
         <div style="margin-bottom:15px   ">
             <span>资源状态：&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</span>
             <input   type="radio" id="dialogResourceStatus-enable" name="resource_status" value="1">&nbsp 正常&nbsp &nbsp 
             <input   type="radio" id="dialogResourceStatus-disable" name="resource_status" value="0">&nbsp 不可用
        </div>
        <div style="margin-bottom:15px">
        	<span>资源说明：</span>
        	<textarea name="resource_desc" id="resourceDesc" style="width: 200px;height: 100px;resize: none;"></textarea>
        </div>
       </form>
   </div>

   <div id="resource-buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton" onclick="saveResource()" iconcls="icon-save">保存</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" onclick="javascript:$('#resourceDialog').dialog('close')" iconcls="icon-cancel">取消</a>
    </div>
    	<input value="<?php echo $_SESSION[common\Constants::LOGINED_USER_ID_IN_SESSION];?>" name="user_id" id="userId" type="hidden">
		<input id="resource_url" type="hidden" value="sys/data/resource.export.php">
		<?php include '../common/include_js.php';?>
        <script type="text/javascript" src="js/resource-list.js"></script>
    </body>
</html>