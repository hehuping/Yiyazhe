<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>咿呀折校园同学注册</title>

<link href="/Public/css/signin/global2.0.css" media="screen"
	rel="stylesheet" />
<link href="/Public/css/signin/style1.0.5.css" media="screen"
	rel="stylesheet" />
<script src="/Public/js/signin/jquery1.7.2.min.js"> </script>


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
				<span><h1>注册就能发现我们的趣味！</h1></span>
			</div>
			<div class="reg_box clear">
				<div class="item msg_zt1" id="item1">
					<label>手机号：</label> <input type="text" id="pemail" class="itext1"
						value="">
						<div class="msg_box row1" id="row1">
							<em></em><span class="msg" id="msg1">同学，输入您的11位手机号吧</span>
						</div>
				</div>
				<div class="item msg_zt1" id="item2">
					<label>密码：</label> <input type="password" id="password"
						class="itext1">
						<div class="msg_box row1" id="row2">
							<em></em><span class="msg" id="msg2">同学，密码要6位数哦</span>
						</div>
				</div>
				<div class="item msg_zt1" id="item3">
					<label>确认密码：</label> <input type="password" id="password2"
						class="itext1">
						<div class="msg_box row1" id="row3">
							<em></em><span class="msg" id="msg3">同学，密码要和上面相同哦</span>
						</div>
				</div>
				<div class="item i_code" id="item4">
					<label>验证码：</label> <input type="text" id="validCode"
						class="itext2"> <span id="vcode_box"></span> <a
						href="javascript:void(0);" id="refresh_vcode"></a> <!-- <span class="i_codeP" style="display:display;"><a id="btnSendCode" onclick="sendMessage();" href="javascript:void(0);">免费获取手机验证码</a></span>-->
						<span class="i_codeP" id="codeAdd"><input type="button"
							id="btnSendCode" onclick="sendMessage();" value="免费获取手机验证码" /></span>
						<div class="msg_box row1">
							<span class="msg" id="msg4"></span>
						</div>
				</div>

				<div class="item">
					<a href="javascript:void(0)" onclick="doPost();" class="i_btn i_btn1" id="reg_submit"><i>注册，起来嗨</i></a>
				</div>
			</div>
		</div>
		<div class="reg_right">
			<div class="right_top">
				<span>原来是老朋友，快去登录吧！<a href="login">登录</a></span>
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

   $("#password2").blur(function(){
    	checkPassword2();
   });
  
   $("#validCode").blur(function(){
   		checkValidCode();
   });
   
   function checkPemail(){
	   var m = checkMobile();
	      if(m==0){
	        $("#item1").removeClass('msg_zt1');
	        $("#item1").removeClass('msg_zt3');
	        $("#item1").addClass('msg_zt2');
	        $("#row1").removeClass('row1');
	        $("#row1").addClass('row2');
	        $("#msg1").html("");
	        return true;
	       // alert(666);
	      }else if(m==1){
	       // alert(5454);
	        $("#item1").removeClass('msg_zt1');
	        $("#item1").removeClass('msg_zt2');
	         $("#item1").addClass('msg_zt3');
	         $("#msg1").html("同学，记得填写手机号码哟");
	         return false;
	      }else if(m==2){
	         $("#item1").removeClass('msg_zt2');
	          $("#item1").removeClass('msg_zt1');
	         $("#item1").addClass('msg_zt3');
	         $("#msg1").html("同学，11位手机号码写错啦");
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
   
   function checkPassword2(){
	   var password2 = $("#password2").val();
	    var password = $("#password").val();
	      //var m = checkMobile();
	      if(password2 == ""){
	         $("#item3").removeClass('msg_zt1');
	        $("#item3").removeClass('msg_zt2');
	         $("#item3").addClass('msg_zt3');
	         $("#msg3").html("同学，密码不能为空哟");
	         return false;
	      }else if(password2 == password){
	         $("#item3").removeClass('msg_zt1');
	        $("#item3").removeClass('msg_zt3');
	        $("#item3").addClass('msg_zt2');
	        $("#row3").removeClass('row1');
	        $("#row3").addClass('row2');
	        $("#msg3").html("");
	        return true;
	      }else{
	         $("#item3").removeClass('msg_zt1');
	        $("#item3").removeClass('msg_zt2');
	         $("#item3").addClass('msg_zt3');
	         $("#msg3").html("同学，重复密码要相同");
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
	        $("#msg4").html('验证码要填写哟');
	        return false;
	       // alert(666);
	      }else if(code.length < 6){
	       // alert(5454);
	    	  $("#item4").removeClass('msg_zt1');
		        $("#item4").removeClass('msg_zt2');
		        $("#item4").addClass('msg_zt3');
		     //   $("#codeAdd").empty();
		        $("#msg4").html('验证码应该是6位数哟');
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

  function checkMobile() {
    var str = $("#pemail").val();
    var re = /^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/
    if(str == ""){
      return 1;
    }
    if (!re.test(str)) {
        return 2;
    }

    return 0;
}
</script>


<script type="text/javascript">

var InterValObj; //timer变量，控制时间
var count = 60; //间隔函数，1秒执行
var curCount;//当前剩余秒数

function sendMessage() {
  if(!checkPemail()){
	  return false;
  }
  　curCount = count;
　　//设置button效果，开始计时
//<a href="javascript:void(0);" style="color: rgb(204, 204, 204); cursor: default;">99秒后重新获取</a>
     $("#btnSendCode").attr("disabled", "true");
     $("#btnSendCode").css({"color":"rgb(204, 204, 204)","cursor":"default"});
     $("#btnSendCode").val(curCount + "秒后重新发送");
     InterValObj = window.setInterval(SetRemainTime, 1000); //启动计时器，1秒执行一次
　　  //向后台发送处理数据
		$.post("/Signup/getValidCode",
				  {
				    "set":"set",
				  },
				  function(data){
				  },"json");
}

//timer处理函数
function SetRemainTime() {
            if (curCount == 0) {                
                window.clearInterval(InterValObj);//停止计时器
                $("#btnSendCode").removeAttr("disabled");//启用按钮
                $("#btnSendCode").css({"color":"","cursor":""});
                $("#btnSendCode").val("重新发送验证码");
            }
            else {
                curCount--;
                $("#btnSendCode").val(curCount + "秒后重新发送");
            }
       }
</script>

<script type="text/javascript">
function doPost(){
	var phone = $("#pemail").val();
    var code = $("#validCode").val();
    var password = $("#password").val();
	if(checkPemail() && checkPassword() && checkPassword2() && checkValidCode()){
		$.post("/Signup/doSignup",
				  {
				    "phone":phone,
				    "code":code,
				    "password":password,
				  },
				  function(data){
				    if(data.s == 1){
				    	$("#item1").removeClass('msg_zt1');
				        $("#item1").removeClass('msg_zt2');
				         $("#item1").addClass('msg_zt3');
				         $("#msg1").html(data.error);
				         //window.location.href="/Index";
				    }else if(data.s == 3){
				    	 $("#item4").removeClass('msg_zt1');
					        $("#item4").removeClass('msg_zt2');
					        $("#item4").addClass('msg_zt3');
					     //   $("#codeAdd").empty();
					        $("#msg4").html(data.error);
				    }else{
				    	window.location.href="/Login";
				    }
				  },"json");
	}
}
</script>


</body>
</html>