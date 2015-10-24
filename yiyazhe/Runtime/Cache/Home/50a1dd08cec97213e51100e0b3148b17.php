<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>咿呀折校园同学注册</title>

<link href="/Public/css/login/global2.0.css" media="screen"
	rel="stylesheet" />
<link href="/Public/css/login/style1.0.5.css" media="screen"
	rel="stylesheet" />
<script src="/Public/js/login/jquery1.7.2.min.js"> </script>


</head>

<body>
	<div id="header">
		<div class="area">
			<div class="logo">
				<a href="http://www.yiyazhe.com/"></a>
			</div>
		</div>
	</div>

	<div class="line"></div>


	<div id="register" class="area clear">
		<div id="email" class="Panel PanelA clear l">
			<div class="area_top">
				<span><h1>老同学，欢迎回到咿呀折！</h1></span>
			</div>
			<div class="reg_box clear">
				<div class="item msg_zt1" id="item1">
					<label>手机号/昵称：</label> <input type="text" id="pemail" class="itext1"
						value="">
						<div class="msg_box row1" id="row1">
							<em></em><span class="msg" id="msg1">输入您的手机号或者响亮的昵称</span>
						</div>
				</div>
				<div class="item msg_zt1" id="item2">
					<label>密码：</label> <input type="password" id="password"
						class="itext1">
						<div class="msg_box row1" id="row2">
							<em></em><span class="msg" id="msg2">让密码跑起来</span>
						</div>
				</div>
				
				<div class="item i_code" id="item4">
					<label>验证码：</label> <input type="text" id="validCode"
						class="itext2"> <span id="vcode_box"></span> <a
						href="javascript:void(0);" id="refresh_vcode"></a> <!-- <span class="i_codeP" style="display:display;"><a id="btnSendCode" onclick="sendMessage();" href="javascript:void(0);">免费获取手机验证码</a></span>-->
						<span class="i_codeP" id="codeAdd">
							<a href="javascript:void(0);" id="btnSendCode"><img src="/Login/getVerify" onclick="this.src='/Login/getVerify?d='+Math.random();"></img></a>
							</span>
						<div class="msg_box row1">
							<span class="msg" id="msg4"></span>
						</div>
				</div>

				<!-- <div class="item i_txt">
        <p>
          <input type="checkbox" checked="checked" id="inputacc">
          我已经认真阅读并同意折800的<a target="_blank" href="http://www.zhe800.com/service_terms">《用户注册协议》</a> </p>
        <p>
          <input type="checkbox" id="subscribe_status" checked="checked">
          接收来自折800的优惠信息（可退订）</p>
      </div>-->
				<div class="item">
					<a href="javascript:void(0)" onclick="doLogin();" class="i_btn i_btn1" id="reg_submit"><i>登录</i></a>
				</div>
			</div>
		</div>
		<div class="reg_right">
			<div class="right_top">
				<span>貌似还木有帐号 ？<a href="login">注册走起</a></span>
			</div>
			<div class="ada">
				<a target="_blank"><img
					src="/Public/images/signin/image1.jpg" /></a>
			</div>
			<h3 class="moreps">还可以使用这些账号登录</h3>
			<div class="morelogin">

				<a href="/Login/qqlogin" class="i_btn i_btn2 qq"><i>QQ登录</i></a> 
				<a href="" class="i_btn i_btn2 baidu"><i>百度登录</i></a>
			</div>
		</div>
	</div>

	<div id="footer">
		<div class="area">
			<a style="color: #666" target="_blank" href="">这个是test</a>&nbsp;这里都是什么备案号什么的
			Copyright&copy;2011-2015 版权所有 YIYAZHE.COM <br />
			<a href="http://www.itrust.org.cn/yz/pjwx.asp?wm=3571298269"
				target="_blank">
		</div>
	</div>

	<span style="display: none"> </span>

	<script type="text/javascript">
  $("#pemail").focus(function(){
     // $("#pemail").val('');
   });
  //失去焦点
  $("#pemail").blur(function(){
     checkPemail();
   });

   $("#password").blur(function(){
   		checkPassword();
   });
  
   $("#validCode").blur(function(){
   		checkValidCode();
   });
   
   function checkPemail(){
	   var name = $("#pemail").val();
	  // var m = checkMobile();
	      if(name.length != 0){
	        $("#item1").removeClass('msg_zt1');
	        $("#item1").removeClass('msg_zt3');
	        $("#item1").addClass('msg_zt2');
	        $("#row1").removeClass('row1');
	        $("#row1").addClass('row2');
	        $("#msg1").html("");
	        return true;
	       // alert(666);
	      }else {
	       // alert(5454);
	        $("#item1").removeClass('msg_zt1');
	        $("#item1").removeClass('msg_zt2');
	         $("#item1").addClass('msg_zt3');
	         $("#msg1").html("手机号或者昵称不能为空哦");
	         return false;
	      }
   }
   
   function checkPassword(){
	   var password = $("#password").val();
	      //var m = checkMobile();
	      if(password.length >= 6){
	        $("#item2").removeClass('msg_zt1');
	        $("#item2").removeClass('msg_zt3');
	        $("#item2").addClass('msg_zt2');
	        $("#row2").removeClass('row1');
	        $("#row2").addClass('row2');
	        $("#msg2").html("");
	        return true;
	       // alert(666);
	      }else if(password.length < 6){
	       // alert(5454);
	        $("#item2").removeClass('msg_zt1');
	        $("#item2").removeClass('msg_zt2');
	         $("#item2").addClass('msg_zt3');
	         $("#msg2").html("同学，密码不能少于6位数哟");
	         return false;
	      }
   }
   
   
   function checkValidCode(){
	   var code = $("#validCode").val();
	   if(code == ""){
	        $("#item4").removeClass('msg_zt1');
	        $("#item4").removeClass('msg_zt2');
	        $("#item4").addClass('msg_zt3');
	       // $("#codeAdd").empty('div');
	        $("#msg4").html('验证码不能为空哦');
	        return false;
	       // alert(666);
	      }else if(code.length != 4){
	       // alert(5454);
	    	  $("#item4").removeClass('msg_zt1');
		        $("#item4").removeClass('msg_zt2');
		        $("#item4").addClass('msg_zt3');
		     //   $("#codeAdd").empty();
		        $("#msg4").html('验证码应该是4位数哦');
		        return false;
	      }else{
	    	  $("#item4").removeClass('msg_zt3');
		        $("#item4").removeClass('msg_zt2');
		        $("#item4").addClass('msg_zt1');
		     //   $("#codeAdd").empty();
		        $("#msg4").html('');
		        return true;
	      }
	   
   }

</script>


<script type="text/javascript">
function doLogin(){
	var name = $("#pemail").val();
    var code = $("#validCode").val();
    var password = $("#password").val();
	if(checkPemail() && checkPassword() && checkValidCode()){
		$.post("/Login/doLogin",
				  {
				    "username":name,
				    "code":code,
				    "password":password,
				  },
				  function(data){					  
				      if(data.s == 2){
				    	 $("#item1").removeClass('msg_zt1');
					        $("#item1").removeClass('msg_zt2');
					        $("#item1").addClass('msg_zt3');
					     //   $("#codeAdd").empty();
					        $("#msg1").html(data.error);
				    }else if(data.s == 1){
				    	 $("#item4").removeClass('msg_zt1');
					        $("#item4").removeClass('msg_zt2');
					        $("#item4").addClass('msg_zt3');
					     //   $("#codeAdd").empty();
					        $("#msg4").html(data.error);
				    }else{
				    	window.location.href="/User";
				    	}
				    },"json");
	}
	}
</script>


</body>
</html>