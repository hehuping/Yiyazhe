<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>咿呀折用户中心</title>

<link href="/Public/css/user/style.css" media="screen"></link>
<link href="/Public/css/user/global2.0.css" media="screen"
	rel="stylesheet"></link>
<link href="/Public/css/user/style1.0.5.css" media="screen"
	rel="stylesheet"></link>

<script type="text/javascript" src="/Public/js/user/jquery.min.js"></script>

<script type="text/javascript" src="/Public/js/user/sweet-alert.js"></script>

<link rel="stylesheet" type="text/css"
	href="/Public/css/user/example.css"></link>
<link rel="stylesheet" type="text/css"
	href="/Public/css/user/sweet-alert.css"></link>
<link rel="stylesheet" type="text/css"
	href="/Public/css/user/comment.css"></link>
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
					<li><a href="<?php echo U("User/index"); ?>">基本资料</a></li>
					<li class="activ"><a href="<?php echo U("User/comment"); ?>" style="color:rgb(255,255,255);">我的评论</a></li>
					<li><a href="<?php echo U("User/favorate"); ?>">我的收藏</a></li>
					<li><a href="<?php echo U("User/beans"); ?>">我的积分</a></li>
				</ul>
			</div>
		</div>
		<div id="userright">
			<div class="userpic">
				<span>我的评论</span>
			</div>
			<div class="userinfo1">
			<?php foreach($comment as $k=>$v){ ?>
				<div class="commentItem" id="comment<?php echo ($v['cid']); ?>">
					<table class="lists sendable">
						<tbody>
							<tr class="hd">
								<td colspan="7">
									<div class="r" style="">
										<input type="button" value="删除" onclick="toDelete(<?php echo ($v['cid']); ?>);" /> <a
											href="javascript:void(0)" class="delete"></a>
									</div>
									<div class="l">
										<strong>评论时间：<?php echo ($v['addtime']); ?></strong>

										<!-- <span title="婷琳女装特卖店" class="b_shangjia">商家：婷琳女装特卖店</span> -->
									</div>
								</td>
							</tr>

							<tr class="productItem">
								<td class="b_products">
									<div style="float: left">
										<a href="" target="_blank"> <img
											src="<?php echo ($v['gimage']); ?>"
											width="90" height="90"
											></a>
									</div>
									<div style="float: right; width: 100px; margin-top: 20px;">
										<h3>
											<a href="" target="_blank" title="婷琳 新款韩系宽松长袖蕾丝上衣"><?php echo ($v['title']); ?></a>
										</h3>
									</div>
								</td>

								<td class="b_price" rowspan="1">
									<div style="margin-top: 20px;">
										<del><?php echo ($v['oldprice']); ?></del><br>
										<span><?php echo ($v['price']); ?></span>
									</div>
								</td>
								<td class="bl" rowspan="1">
									<div style="padding: 30px"><?php echo ($v['content']); ?></div>
								</td>
							</tr>


						</tbody>
					</table>
				</div>
				<?php } ?>
				<div class="clear"></div>
				<div>
					<?php echo ($page); ?>
				</div>

				<div class="clear"></div>
			</div>
		</div>
	</div>

	<div id="footer">
		<div class="area">
			<a style="color: #666" target="_blank" href="">这个是test</a>&nbsp;这里都是什么备案号什么的
			Copyright&copy;2011-2015 版权所有 YIYAZHE.COM <br /> <a href="#"
				target="_blank">
		</div>
	</div>

	<span style="display: none"> </span>
	  <script type="text/javascript">
		
		function toDelete(id){
			swal({   
					title: "确定删除？",  
					text: "",  
					type: "warning",   
					showCancelButton: true,   
					confirmButtonColor: "#DD6B55",   
					confirmButtonText: "确定",
					CancelButtonText:"取消"
					}, 
					function(){
						$.post("/User/delComment",
								  {
								    "id":id,
								  },
								  function(data){
								    if(data.s == 1){
								    	alert("参数错误");
								    	
								    }else if(data.s == 2){
								    	alert("数据错误");
								    }else{
								    	$("#comment"+id).hide();
								    	location.reload(true);
								    }
								  },"json");
						
					});
		}
   </script>
</body>
</html>