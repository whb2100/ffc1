$(function(){
	//查出登录用户所能看到的资源
	$.post("../sys/data/userresource.retrieve.php",function(data){
        var data = eval('(' + data + ')');
        //转为json格式
        var resource = JSON.stringify(data);
        var resourceArray = new Array();
        for(var i = 0 ; i < data.length ; i++){
        	//所有可用的资源
        	
        	if(data[i].resource_status != 0 && data[i].resource_url == "-"){
        		resourceArray.push(data[i]);
        	//防止权限管理被隐藏
        	}else if(data[i].resource_name == "权限管理"){
        		resourceArray.push(data[i]);
        	}
        }
        //		console.log(resourceArray);
        
        //创建菜单
        new hqMenu({menuArrs:resourceArray});
    });
});

var tag2 = null;
function sel2(obj){
	//console.log(obj);
	if (tag2 != null) {
		tag2.style.background="#1e59a8";
		tag2.style.borderTop="#668ec4 1px solid";
		tag2.style.borderLeft="";
	}
	tag2 = obj;
	tag2.style.background="#3674cc";
	tag2.style.borderTop="";
	tag2.style.borderLeft="#ff0621 6px solid";
 }

function hqMenu(options) {
    this.config = {
        containerCls        : '.hq-menu',         // 外层容器
        menuArrs            :  '',                        //  JSON传进来的数据
        type                :  'click',                    // 默认为click 也可以mouseover
        renderCallBack      :  null,                  // 渲染html结构后回调
        clickItemCallBack   : null                   // 每点击某一项时候回调
    };
    this.cache = {
    };
    this.init(options);
 }


 hqMenu.prototype = {
    constructor: hqMenu,
    init: function(options){
    	
        this.config = $.extend(this.config,options || {});
        var self = this,
            config = self.config,
            cache = self.cache;
        // 渲染html结构
        $(config.containerCls).each(function(index,item){
        	self.renderHTML(item);
            // 处理点击事件
            self.bindEnv(item);
        });
    },
    renderHTML: function(container){
        var self = this,
            config = self.config,
            cache = self.cache;
        var ulhtml = $('<ul></ul>');
        $(config.menuArrs).each(function(index,item){
            var lihtml = $("<li><h2>"+item.resource_name+'</h2></li>');

            if(item.children && item.children.length > 0) {
                self.createchildren(item.children,lihtml);
            }
            $(ulhtml).append(lihtml);
        });
        $(container).append(ulhtml);

        config.renderCallBack && $.isFunction(config.renderCallBack) && config.renderCallBack();

        // 处理层级缩进
        self.levelIndent(ulhtml);
    },
    /**
     * 创建子菜单
     * @param {array} 子菜单
     * @param {lihtml} li项
     */
    createchildren: function(children,lihtml){
        var self = this,
            config = self.config,
            cache = self.cache;
        var subUl = $('<ul></ul>'),
            callee = arguments.callee,
            subLi;

        $(children).each(function(index,item){
            var url = item.resource_url;
            //显示所有可用资源
            if(item.resource_status == 1 && item.resource_type != 2){
            	if(url == "-"){
            		subLi = $("<li><a>"+item.resource_name+"</a></li>");
            	}else{
            		subLi = $("<li onclick='sel2(this);'><a href=..\/"+url+" target='_self' onclick='setFramSrc(this);return false;'>"+item.resource_name+"</a></li>");
            	}
            	
            //防止资源管理被隐藏
            }else if(item.resource_name == "资源管理"){
            	if(url == "-"){
            		subLi = $("<li><a>"+item.resource_name+"</a></li>");
            	}else{
            		subLi = $("<li onclick='sel2(this);'><a href=..\/"+url+" target='_self' onclick='setFramSrc(this);return false;'>"+item.resource_name+"</a></li>");
            	}
            }
            if(item.children && item.children.length > 0) {

                callee(item.children, subLi);
            }
            $(subUl).append(subLi);
        });
        $(lihtml).append(subUl);
    },
    /**
     * 处理层级缩进
     */
    levelIndent: function(ulList){
        var self = this,
            config = self.config,
            cache = self.cache,
            callee = arguments.callee;
        var initTextIndent = 2,
            lev = 1,
            $oUl = $(ulList);
        while($oUl.find('ul').length > 0){
            initTextIndent = parseInt(initTextIndent,10) + 2 + 'em';
            $oUl.children().children('ul').addClass('lev-' + lev)
                        .children('li').css('text-indent', initTextIndent);
            $oUl = $oUl.children().children('ul');
            lev++;
        }
        $(ulList).find('ul').hide();
    },
    /**
     * 绑定事件
     */
    bindEnv: function(container) {
        var self = this,
            config = self.config;

        $('h2,a',container).unbind(config.type);
        $('h2,a',container).bind(config.type,function(e){
            if($(this).siblings('ul').length > 0) {
                $(this).siblings('ul').slideToggle('slow').end().toggleClass('unfold');
            }
            $(this).parent('li').siblings().find('ul').hide()
//                   .end().find('img.unfold').removeClass('unfold');
            config.clickItemCallBack && $.isFunction(config.clickItemCallBack) && config.clickItemCallBack($(this));

        });
    }
 };