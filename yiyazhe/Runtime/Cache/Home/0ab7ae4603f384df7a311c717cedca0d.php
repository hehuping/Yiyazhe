<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>咿呀折用户中心</title>

<link href="/Public/css/user/style.css" media="screen" ></link>
<link href="/Public/css/user/global2.0.css" media="screen" rel="stylesheet"> </link>
<link href="/Public/css/user/style1.0.5.css" media="screen" rel="stylesheet" ></link>

<script type="text/javascript" src="/Public/js/user/jquery.min.js"></script> 

<script type="text/javascript" src="/Public/js/user/cropbox.js"></script>

<script type="text/javascript" src="/Public/js/user/school.js"></script>

  <script type="text/javascript" src="/Public/js/user/sweet-alert.js"></script>

<!--<script type="text/javascript" src="/Public/js/user/sweet-alert.min.js"></script>-->

<script type="text/javascript" src="/Public/js/user/zDialog.js"></script>

<script type="text/javascript" src="/Public/js/user/zDrag.js"></script>

<link rel="stylesheet" type="text/css" href="/Public/css/user/example.css"></link>
<link rel="stylesheet" type="text/css" href="/Public/css/user/sweet-alert.css"></link>

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



	<!--  -->
	<div id="user" class="area clear">
		
		<div id="userleft">
		<div class="left-top">
			<img src="<?php echo $showPic; ?>" width="150px" height="150px"></img>
		</div>
			<div class="sider-bar">
				<ul>
					<li class="activ"><a href="" style="color:rgb(255,255,255);">基本资料</a></li>
					<li><a href="<?php echo U("User/comment"); ?>">我的评论</a></li>
					<li><a href="<?php echo U("User/favorate"); ?>">我的收藏</a></li>
					<li><a href="<?php echo U("User/beans"); ?>">我的积分</a></li>
				</ul>
			</div>
		</div>
		<div id="userright">
			<div class="userpic">
				<span>帐号信息</span>
			</div>
			<div class="userinfo1">
				<div class="userbase">
				<div class="nickname">Hi ~ Dear <span style="color:rgb(243, 83, 153);"><?php echo $_SESSION['user']['username']; ?></span>，欢迎回家！</div>
					
					<table class="table1">
						
						<tr>
							<td>昵称：</td>
							<td id="user_name"><?php echo $_SESSION['user']['username']; ?></td>
							<td><input type="button" id="change1" onclick="open1('<?php echo $_SESSION['user']['username']; ?>',1);" class="table_peyton" value="修改"></td>
						</tr>
						
						<tr>
							<td>手机号：</td>
							<td id="user_phone"><?php echo $_SESSION['user']['phone']; ?></td>
							<td><input type="button" id="change2"  onclick="open2('<?php echo $_SESSION['user']['phone']; ?>',2);"  class="table_peyton" value="修改"></td>
						</tr>
						<tr>
							<td id="user_qq">QQ：</td>
							<td><?php echo $_SESSION['user']['qq']; ?></td>
							<td><input type="button" id="change3" onclick="open1('<?php echo $_SESSION['user']['qq']; ?>',3);" class="table_peyton" value="修改"></td>
						</tr>
						<tr>
							<td>性别：</td>
							<td id="user_sixe"><?php echo $_SESSION['user']['sex']; ?></td>
							<td><input type="button" id="change4" onclick="open3('<?php if(empty($_SESSION['user']['sex'])){echo 'null'; }else{ echo $_SESSION['user']['sex'];} ?>',4)" class="table_peyton" value="修改"></td>
						</tr>
						<tr>
							<td>年龄：</td>
							<td id="user_age"><?php echo $_SESSION['user']['age']; ?></td>
							<td><input type="button" id="change5" onclick="open1('<?php echo $_SESSION['user']['age']; ?>',5);" class="table_peyton" value="修改"></td>
						</tr>
						
						
					</table>
				</div>
				<div class="container">

					<div class="imageBox">

						<div class="thumbBox"></div>

						<div class="spinner" style="display: none"></div>

					</div>

					<div class="action">

						<!-- <input type="file" id="file" style=" width: 200px">-->

						<div class="new-contentarea tc">
							<a href="javascript:void(0)" class="upload-img"> <label
								for="upload-file">点击修改</label>

							</a> <input type="file" class="" name="upload-file" id="upload-file" />

						</div>

						<input type="button" onclick="doChangePic();" class="Btnsty_peyton" value="OK"> <input
							type="button" id="btnZoomIn" class="Btnsty_peyton" value="+">

								<input type="button" id="btnZoomOut" class="Btnsty_peyton"
								value="-">
					</div>

					<div class="cropped"><img id="endPic"  src="<?php echo $showPic; ?>" align="absmiddle" style="width:150px;margin-top:4px;border-radius:180px;box-shadow:0px 0px 12px #7E7E7E;"><p>150px*150px</p></div>

				</div>
				<div class="clear"></div>
			</div>
			<div class="userpic">
				<span>其它资料</span>
			</div>
			<div class="userinfo1" style="height:400px;">
				<div class="school">
					<center>
<label for=''>学校名称：</label>
<input type="text" id="schoolName"  value="<?php echo session('user.school'); ?>"/>
<input type="button" id="selectSch"  class="schSelect"  value="选择"/>
<input type="button" id="doPic" onclick="sendBack(6);"  class="schSelect"  value="确定"/>
<div id="proSchool" class="provinceSchool">
    <div class="title"><span>请选择学校</span></div>
    <div class="proSelect">
        <select></select>
        <span>如没找到选择项，请选择其他手动填写</span>
        <input type="text" />
    </div>
    <div class="schoolList">
        <ul></ul>
    </div>
    <div class="button">
        <button flag='0'>取消</button>
        <button flag='1'>确定</button>
    </div>
</div>	
</center>
				</div>
			</div>
		</div>
	</div>

	<div id="footer">
		<div class="area">
			<a style="color: #666" target="_blank" href="">这个是test</a>&nbsp;这里都是什么备案号什么的
			Copyright&copy;2011-2015 版权所有 YIYAZHE.COM <br /> <a
				href="#"
				target="_blank">
		</div>
	</div>

	<span style="display: none"> </span>


<!-- 昵称修改 -->
<script type="text/javascript">

var showPic = '<?php echo $showPic; ?>';

function doChangePic(){
	var pimage =  document.getElementById("endPic").src;
    if(pimage == showPic){
    	sweetAlert("出错喽", "拖动图片才能修改哦","warning");
    	return false;
    }else{
    	$.post("/User/doChangePic",
  			  {
  			    "image":pimage,
  			  },
  			  function(data){
  			    if(data.s == 0){
  			    	sweetAlert("修改成功", "果然是一张美美滴头像！",'success');
  			    	//location.reload(true);
  			    }else{
  			    	
  			    	sweetAlert("出错喽", "拖动图片才能修改哦","warning");
  			    }
  			  },"json");
    }
    
    
}


var ffwe = false;
//在外面先实例化一个对象
var diag = new Dialog();
function open1(name,id){
	diag.TID = id;
	diag.Modal = true;
	diag.Width = 200;
	diag.Height = 50;
	diag.Title = "起个响亮的名字吧！";
	diag.InnerHtml='<div style="text-align:center;color:red;font-size:14px;margin-top:10px;"><input style="border: 1px solid #d2d2d2;padding: 2px 3px;line-height: 30px;border-radius: 5px; margin-top:-10px;" type="text" value="'+name+'" id="n_name" /></div>'
	diag.OKEvent = function(){var v=doChange(id);if(v==1){swal("操作成功", "一次完美的修改", "success");diag.close();location.reload(true);}else{alert(v);}};//点击确定后调用的方法
	//diag.OKEvent = function(){doChange(id);}
	diag.show();
	
}

/*性别选择*/
 
 function open3(name,id){
	var other;
	if(name=="男"){
		 other = "女"
	}else{
		other = "男";
	}
	diag.TID = id;
	diag.Modal = true;
	diag.Width = 200;
	diag.Height = 50;
	diag.Title = "起个响亮的名字吧！";
	diag.InnerHtml='<div style="text-align:center;color:red;font-size:14px;margin-top:10px;"><input style="border: 1px solid #d2d2d2;padding: 2px 3px;line-height: 30px;border-radius: 5px; margin-top:-10px;" type="radio" name="sex" checked="checked" value="'+name+
	'" id="n_name" />'+name+'<input style="border: 1px solid #d2d2d2;padding: 2px 3px;line-height: 30px;border-radius: 5px; margin-top:-10px;" type="radio" name="sex" value="'+other+'" id="n_name" />'+other+'</div>'
	diag.OKEvent = function(){var v=doChange(id);if(v==1){swal("操作成功", "一次完美的修改", "success");diag.close();location.reload(true);}else{alert(v);}};//点击确定后调用的方法
	//diag.OKEvent = function(){getSex();}
	
	diag.show();

}

function open2(name,id){
	diag.TID = id;
	diag.Modal = true;
	diag.Width = 300;
	diag.Height = 70;
	diag.Title = "起个响亮的名字吧！";
	diag.InnerHtml='<div style="text-align:center;color:red;font-size:14px;margin-top:10px;"><input style="width:200px;border: 1px solid #d2d2d2;padding: 2px 3px;line-height: 30px;border-radius: 5px; margin-top:-10px;" type="text" value="'+name+
	'" id="pemail" /> <input style="width:80px;border: 1px solid #d2d2d2;padding: 2px 3px;line-height: 30px;border-radius: 5px; margin-top:-10px;" type="text" id="validCode" />'+
	'<input type="button" class="table_peyton" style="float:none;width:90px;" value="发送验证码" id="btnSendCode" onclick="sendMessage();" />'+'</div>'
	diag.OKEvent = function(){doCode();swal("操作成功", "一次完美的修改", "success");diag.close();window.location.href="/user";/*var v=doCode();if(v==1){swal("操作成功", "恭喜你，操作成功", "success");diag.close();window.location.href="/user";}*/};
	diag.show();

}

function sendBack(id){
	if(id == 2 && checkPemail() && checkValidCode()){
		doCode();
	}else if(id != 2){
		doChange(id);
	}
	
}

function getSex()
{
	 var sex;
    var group = document.getElementsByName('sex');
        for(var i = 0; i< group.length; i++)
           if(group[i].checked == true){
           	sex=group[i].value;	
           }
     return sex;
}

function cheakName(type){
	var name = $("#n_name").val();
	if(type==5){
		name = $("#schoolName").val();
	}
	if(name==""){
		alert("不能为空");
		return false;
	}else if(name.length>20){
		alert("长度不能超过11个字符");
		return false;
	}else{
		return true;
	}
}

function　doChange(type){
	var result = true;
	var name;
	if(type == 4){
		name = getSex();
	}else if(type == 6){
		name = $("#schoolName").val();
	}else{
		name = $("#n_name").val();
	}
	if(name == ""){if(diag.TID != null){diag.close();}sweetAlert("内容不能为空", "",'error'); return false;}
	$.post("/User/doChange",
			  {
			    "name":name,
			    "type":type,
			  },
			  function(data){
			    if(data.s == 0){
			    	if(diag.TID != null){
			    		diag.close();
			    	}
			    	 
			    	sweetAlert("修改成功", "",'success');
			    	setTimeout("location.reload(true)",1000);
			    	
			    }else{
			    	if(diag.TID != null){
			    		diag.close();
			    	}
			    	sweetAlert("修改失败", '错误原因：“已存在”','error');
			    	setTimeout("location.reload(true)",1000);
			    }
			  },"json");
	return result;
}

/*检查手机号*/
 function checkPemail(){
	   var m = checkMobile();
	      if(m==0){
	       
	        return true;
	       // alert(666);
	      }else if(m==1){
	       // alert(5454);
	       alert("同学，记得填写手机号码哟");
	         return false;
	      }else if(m==2){
	        alert("同学，11位手机号码写错啦");
	         return false;
	      }
   }
   
/*
 * 正则检查位数
 */
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

//验证码倒计时按钮 -->


var InterValObj; //timer变量，控制时间
var count = 60; //间隔函数，1秒执行
var curCount;//当前剩余秒数

function sendMessage() {
	//alert(90909);
  if(!checkPemail()){
	  return false;
  }
  　curCount = count;
　　//设置button效果，开始计时
//<a href="javascript:void(0);" style="color: rgb(204, 204, 204); cursor: default;">99秒后重新获取</a>
     $("#btnSendCode").attr("disabled", "true");
     $("#btnSendCode").css({"color":"rgb(204, 204, 204)","cursor":"default"});
     $("#btnSendCode").val(curCount + "秒后重发");
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
                $("#btnSendCode").val("重发验证码");
            }
            else {
                curCount--;
                $("#btnSendCode").val(curCount + "秒后重发");
            }
       }
       
/*
 * 验证码检查
 */
 
 function checkValidCode(){
	   var code = $("#validCode").val();
	   if(code == ""){
		   alert('验证码要填写哟');
	        return false;

	      }else if(code.length < 6){

	    	alert('验证码应该是6位数哟');
		        return false;
	      }
	   return true;
	   
 }
 
 /*
 手机修改发送数据验证
 */
  
 function toReturn(value){
	 ffwe = value;
 }

 function doCode(){
	 var name = $("#pemail").val();
	 var codes = $("#validCode").val();
			$.post("/User/doCode",
					  {
					    "phone":name,
					    "code":codes,
					    "type":2,
					  },
					  function(data){
					    if(data.s == 1){
					    	alert("验证码错误");
					    	
					    }else if(data.s == 2){
					    	alert("手机号重复");
					    }else{
					    	alert("修改成功");
					    	diag.close();
					    	location.reload(true);
					    }
					  },"json");
		return ffwe;
	}
 
</script>
<!-- 学校选择插件 -->
<script type="text/javascript">
$(function(){
	//province;
	//proSchool;
	//学校名称 激活状态
	$("#selectSch").focus(function(){
	  var top = $(this).position().top+$(this).height()+2;
	  var left = $(this).position().left;
	  $("div[class='provinceSchool']").css({top:top,left:"500px"});
	  $("div[class='provinceSchool']").show();
	});
	//初始化省下拉框
	var provinceArray = "";
	var provicneSelectStr = "";
	for(var i=0,len=province.length;i<len;i++){
	  provinceArray = province[i];
	  provicneSelectStr = provicneSelectStr + "<option value='"+provinceArray[0]+"'>"+provinceArray[1]+"</option>"
	} 
	$("div[class='proSelect'] select").html(provicneSelectStr);
	//初始化学校列表
	var selectPro = $("div[class='proSelect'] select").val();
	var schoolUlStr = "";
	var schoolListStr = new String(proSchool[selectPro]);
	var schoolListArray = schoolListStr.split(",");
	var tempSchoolName = "";
	for(var i=0,len=schoolListArray.length;i<len;i++){
	  tempSchoolName = schoolListArray[i];
	  if(tempSchoolName.length>13){
		schoolUlStr = schoolUlStr + "<li class='DoubleWidthLi' title="+schoolListArray[i]+">"+schoolListArray[i]+"</li>"
	  }else {
		schoolUlStr = schoolUlStr + "<li>"+schoolListArray[i]+"</li>"
	  }
	}
	$("div[class='schoolList'] ul").html(schoolUlStr);
	//省切换事件
	$("div[class='proSelect'] select").change(function(){
	  if("99"!=$(this).val()){
		$("div[class='proSelect'] span").show();
		$("div[class='proSelect'] input").hide();
		schoolUlStr = "";
		schoolListStr = new String(proSchool[$(this).val()]);
		schoolListArray = schoolListStr.split(",");
		for(var i=0,len=schoolListArray.length;i<len;i++){
		  tempSchoolName = schoolListArray[i];
		  if(tempSchoolName.length>13){
			schoolUlStr = schoolUlStr + "<li class='DoubleWidthLi' title="+schoolListArray[i]+">"+schoolListArray[i]+"</li>"
		  }else {
			schoolUlStr = schoolUlStr + "<li>"+schoolListArray[i]+"</li>"
		  }
		}
		$("div[class='schoolList'] ul").html(schoolUlStr);
	  }
	  else {
		$("div[class='schoolList'] ul").html("<span class='entertext'>请在输入框内手动输入学校！</span>");
		$("div[class='proSelect'] span").hide();
		$("div[class='proSelect'] input").show();
	  }
	});
	//学校列表mouseover事件
	$("div[class='schoolList'] ul li").live("mouseover",function(){
	  $(this).css("background-color","#f38e81");
	});
	//学校列表mouseout事件
	$("div[class='schoolList'] ul li").live("mouseout",function(){
	  $(this).css("background-color","");
	});
	//学校列表点击事件
	$("div[class='schoolList'] ul li").live("click",function(){
	  $("#schoolName").val($(this).html());
	  $("div[class='provinceSchool']").hide();
	});
	//按钮点击事件
	$("div[class='button'] button").live("click",function(){
	  var flag = $(this).attr("flag");
	  if("0"==flag){
		$("div[class='provinceSchool']").hide();
	  }else if("1"==flag){
		var selectPro = $("div[class='proSelect'] select").val();
		if("99"==selectPro){
		  $("#schoolName").val($("div[class='proSelect'] input").val());
		}
		$("div[class='provinceSchool']").hide();
	  }
	});
});
</script>



<!-- 图片上传 -->
	<script type="text/javascript">
	var showPic = '<?php echo $showPic; ?>';
	
	$(window).load(
						function() {
							//$('#btnCrop').click();$("#idName").css("cssText","background-color:red!important");
							//$(".imageBox").css("cssText","background-position:88px 88px!important");$(".imageBox").css("cssText","background-size:222px 222px!important");
							var options = {
								thumbBox : '.thumbBox',
								spinner : '.spinner',
								imgSrc : showPic,
							}
							var cropper = $('.imageBox').cropbox(options);
							var img = showPic;
							//getImg();
							$('#upload-file').on('change', function() {
								var reader = new FileReader();
								reader.onload = function(e) {
									options.imgSrc = e.target.result;
									cropper = $('.imageBox').cropbox(options);
									getImg();
								}
								reader.readAsDataURL(this.files[0]);
								this.files = [];
								//getImg();
							})
							$('#btnCrop').on('click', function() {
								alert("图片上传喽");
							})
							function getImg() {
								img = cropper.getDataURL();
								if(img == ""){
									img = showPic;
								}
								$('.cropped').html('');
								$('.cropped')
										.append(
												'<img id="endPic" src="'+img+'" align="absmiddle" style="width:150px;margin-top:4px;border-radius:180px;box-shadow:0px 0px 12px #7E7E7E;"><p>150px*150px</p>');

							}
							$(".imageBox").on("mouseup", function() {
								getImg();
							});
							$('#btnZoomIn').on('click', function() {
								//getImg();
								cropper.zoomIn();
							})
							$('#btnZoomOut').on('click', function() {
								//getImg();
								cropper.zoomOut();
							})
						});
	
	
	</script>



</body>
</html>