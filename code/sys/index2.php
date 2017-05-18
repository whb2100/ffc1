<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="../js/easyui/themes/metro/easyui.css" />

<title>FENG HE</title>
<style>
body{ background:url(../images/login_bg.jpg) no-repeat center; height:943px; margin:0;}
.login{ width:90%; margin:0 auto;}
.login_left{ padding-top: 200px; text-align: center; width: 57%; float:left; display:inline-block;}
.part1{ text-align: center; width: 100%;}
.part2{ text-align: center; width: 100%; padding-top:130px;}

.login_right{ margin-top:175px; text-align: center; width:468px; float:left; display:inline-block; background-color:#efeeee; height:503px;}

.wrap{ width:468px; margin:0 auto;}
.tabss{height:66px;}
.tabss a{display:block;float:left;width:50%;color:#FFF;text-align:center;background:#afb4c3;line-height:66px;font-size:20px;text-decoration:none;}
.tabss a.active{ color:#12163b; background:#efeeee; font-family:"黑体";}
.tabss a.en{ font-family:Arial, Helvetica, sans-serif;}


.swiper-container{background:#efeeee;height:437px;width:100%;border-top:0;}
.swiper-slide{height:437px;width:100%;background:none;color:#fff;}
.content-slide{padding-top:69px;}
.content-slide ul{ width:90%; margin:0 auto; padding:0;}
.content-slide li{ margin-bottom:38px; height:53px; list-style:none;}
.content-slide span{ width:70px; height:51px; background:#12163b; border:#12163b solid 1px; float:left; display:inline-block;}
.content-slide img{ padding-top:9px;}
.content-slide input{padding-left: 10px; width: -moz-calc(98% - 70px); width: -webkit-calc(98% - 70px); width: calc(98% - 80px); height:49px; background:#efeeee; border:#12163b solid 1px; float:left; display:inline-block; font-size:20px; color:#acadb8; font-family:"黑体";}
.login_button1{ width:90%; margin:0 auto; background:#12163b; border:#12163b solid 1px; height:49px; margin-top:72px; font-size:30px; color:#FFF; text-decoration:none; line-height:49px; cursor: pointer;}
.login_button1 a{ font-family:"黑体"; font-size:30px; color:#FFF; text-decoration:none; line-height:49px;}

.swiper-slide2{height:437px;width:100%;background:none;color:#fff;}
.content-slide2{padding-top:69px;}
.content-slide2 ul{ width:90%; margin:0 auto; padding:0;}
.content-slide2 li{ margin-bottom:38px; height:53px; list-style:none;}
.content-slide2 span{ width:70px; height:51px; background:#12163b; border:#12163b solid 1px; float:left; display:inline-block;}
.content-slide2 img{ padding-top:9px;}
.content-slide2 input{ width: -moz-calc(98% - 70px); width: -webkit-calc(98% - 70px); width: calc(98% - 70px); height:49px; background:#efeeee; border:#12163b solid 1px; float:left; display:inline-block; font-size:20px; color:#acadb8; font-family:Arial, Helvetica, sans-serif;}

.login_button2{ width:90%; margin:0 auto; background:#12163b; border:#12163b solid 1px; height:49px; margin-top:72px; font-family:Arial, Helvetica, sans-serif; font-size:30px; color:#FFF; text-decoration:none; line-height:49px; cursor: pointer;}
.login_button2 a{ font-family:Arial, Helvetica, sans-serif; font-size:30px; color:#FFF; text-decoration:none; line-height:49px;}


.content-slide p{ text-indent:2em;line-height:1.9;}

.swiper-container {margin:0 auto;position:relative;overflow:hidden;-webkit-backface-visibility:hidden;-moz-backface-visibility:hidden;-ms-backface-visibility:hidden;-o-backface-visibility:hidden;backface-visibility:hidden;/* Fix of Webkit flickering */  z-index:1;}
.swiper-wrapper {position:relative;width:100%;
  -webkit-transition-property:-webkit-transform, left, top;
  -webkit-transition-duration:0s;
  -webkit-transform:translate3d(0px,0,0);
  -webkit-transition-timing-function:ease;
  
  -moz-transition-property:-moz-transform, left, top;
  -moz-transition-duration:0s;
  -moz-transform:translate3d(0px,0,0);
  -moz-transition-timing-function:ease;
  
  -o-transition-property:-o-transform, left, top;
  -o-transition-duration:0s;
  -o-transform:translate3d(0px,0,0);
  -o-transition-timing-function:ease;
  -o-transform:translate(0px,0px);
  
  -ms-transition-property:-ms-transform, left, top;
  -ms-transition-duration:0s;
  -ms-transform:translate3d(0px,0,0);
  -ms-transition-timing-function:ease;
  
  transition-property:transform, left, top;
  transition-duration:0s;
  transform:translate3d(0px,0,0);
  transition-timing-function:ease;

  -webkit-box-sizing: content-box;
  -moz-box-sizing: content-box;
  box-sizing: content-box;
}
.swiper-free-mode > .swiper-wrapper {
  -webkit-transition-timing-function: ease-out;
  -moz-transition-timing-function: ease-out;
  -ms-transition-timing-function: ease-out;
  -o-transition-timing-function: ease-out;
  transition-timing-function: ease-out;
  margin: 0 auto;
}
.swiper-slide {
  float: left;
  -webkit-box-sizing: content-box;
  -moz-box-sizing: content-box;
  box-sizing: content-box;
}

</style>

</head>

<body>
<div class="login">
  <div class="login_left">
    <div class="part1"></div>
    <div class="part2"><img id="imgLogo" src="../images/logo-en.png"/></div>
  </div>
  <div class="login_right">
  <div class="wrap">
    <div class="tabss">
        <a id="tab_zh" href="#" hidefocus="true" class="en">中文</a>
        <a id="tab_en" href="#" hidefocus="true" class="active">English</a>
    </div>    
    <div class="swiper-container">
        <div class="swiper-wrapper">
        <div class="swiper-slide">
          <form id="loginForm" action="data/user.login.php" method="post" >
           <div class="content-slide">
             <ul>
             <li><span><img src="../images/icon_user.png"/></span><input name="user_empcode" type="text"  /></li>
             <li><span><img src="../images/icon_password.png"/></span><input name="user_password" type="password"/></li>
             </ul>
             <div class="login_button1" id="loginButton" onclick="submitFunction()"><a href="javascript:void(0)">登录</a></div>
             </form>
           </div>
          </div>
        <div class="swiper-slide">
          <form id="loginForm_en" action="data/user.login_en.php" method="post" >
            <div class="content-slide2">
             <ul>
             <li><span><img src="../images/icon_user.png"/></span><input name="user_empcode" type="text"  /></li>
             <li><span><img src="../images/icon_password.png"/></span><input name="user_password" type="password"  /></li>
             </ul>
             <div class="login_button2" onclick="submit_en()"><a href="javascript:void(0)">Login</a></div>
             </form>
            </div>
          </div>
        
      </div>
   </div>
</div>
</div>





</div>
<script  type="text/javascript" src="../js/easyui/jquery-1.11.1.min.js"></script> 
<script type="text/javascript" src="../js/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript" src="../js/easyui/locale/easyui-lang-zh_CN.js"></script>

<script  type="text/javascript" src="../js/idangerous.swiper.min.js"></script> 
<script>
var tabsSwiper = new Swiper('.swiper-container',{
  speed:500,
  onSlideChangeStart: function(){
    $(".tabss .active").removeClass('active');
    $(".tabss a").eq(tabsSwiper.activeIndex).addClass('active');
  }
});

$(".tabss a").on('touchstart mousedown',function(e){
  e.preventDefault()
  $(".tabss .active").removeClass('active');
  $(this).addClass('active');
  tabsSwiper.swipeTo($(this).index());
});

$(".tabss a").click(function(e){
  e.preventDefault();
});
</script>

<script type="text/javascript" src="js/index2.js?v=<?php echo time();?>"></script>


</body>
</html>
