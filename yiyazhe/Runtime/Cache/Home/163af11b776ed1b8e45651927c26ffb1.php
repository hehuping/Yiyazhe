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

<!-- <link rel="stylesheet" type="text/css"
	href="/Public/css/user/example.css"></link> -->
<link rel="stylesheet" type="text/css"
	href="/Public/css/user/sweet-alert.css"></link>
<link rel="stylesheet" type="text/css"
	href="/Public/css/user/beans.css"></link>
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
					<li><a href="<?php echo U("User/comment"); ?>">我的评论</a></li>
					<li><a href="<?php echo U("User/favorate"); ?>">我的收藏</a></li>
					<li class="activ"><a href="<?php echo U("User/beans"); ?>" style="color:rgb(255,255,255);">我的积分</a></li>
				</ul>
			</div>
		</div>
		<div id="userright">
			<!-- <div class="userpic">
				<span>我的评论</span>
			</div>  -->
			<div class="userinfo1">
			<div class="beanstop">
				<h1>我的积分</h1>
				<span>&nbsp目前累计总积分数：</span>
				<h2>100</h2>&nbsp分
				<span class="zhanji" height="30px">根据你的战绩，打败了咿呀折<h2>&nbsp80%&nbsp</h2>的用户</span>
			</div>
			
			<div class="beansbutton">
				<ul class="an_tab_nav">
                  <li <?php if($type == 0){echo 'class="on"';} ?>>
                    <a href="/user/beans">加分明细</a>
                  </li>
                 <!-- <li>
                    <a href="">积分增加</a>
                  </li>  -->
                  <li <?php if($type == 1){echo 'class="on"';} ?>>
                    <a href="/user/beansdown">积分消耗</a>
                  </li>
                 <!-- <li>
                    <a href="">过期积分</a>
                  </li> -->
                  <li class="tiaolink">
                    <a target="_blank" href="#">积分规则&gt;&gt;</a>
                  </li>
                </ul>
                
				<table id="converid" cellpadding="0" cellspacing="0">
				  <tbody><tr>
				    <th width="25%">日期</th><th width="20%">操作</th><th width="40%">详细描述</th><th width="15%">积分</th>
				  </tr>
				  <?php foreach($jifen as $k=>$v){ ?>
				  <?php if($k==0){ ?>
				    <tr>
				      <td><?php echo ($v['addtime']); ?></td>
				      <td><?php echo ($v['operation']); ?></td>
				      <td class="nohytd"><div><?php echo ($v['description']); ?></div></td>
				      <td><em class="jia">+<?php echo ($v['score']); ?></em></td>
				    </tr>
				    <?php }else{ ?>
				    <tr class="'yback'">
				       <td><?php echo ($v['addtime']); ?></td>
				      <td><?php echo ($v['operation']); ?></td>
				      <td class="nohytd"><div><?php echo ($v['description']); ?></div></td>
				      <td><em class="jia">+<?php echo ($v['score']); ?></em></td>
				    </tr>
				    
				    <?php }} ?>
				</tbody></table>
				<div class="page"><?php echo ($page); ?></div>
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
</body>
</html>