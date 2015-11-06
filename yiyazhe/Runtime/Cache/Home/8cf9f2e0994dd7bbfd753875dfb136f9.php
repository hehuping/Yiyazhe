<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=3.0, user-scalable=yes">
    <title><?php echo ($pageInfo['title']); ?></title>
    <meta name="keywords" content="<?php echo ($pageInfo['keywords']); ?>"/>
    <meta name="description" content="<?php echo ($pageInfo['description']); ?>"/>
    
    <link rel="icon" href=""  type="image/png" sizes="">
    <link rel="stylesheet" href="/Public/css/public/neat.css" type="text/css"  />
    <link rel="stylesheet" href="/Public/css/index/lunbo.css" type="text/css"  />
    <link rel="stylesheet" href="/Public/css/public/index.css" type="text/css"  />
    <link rel="stylesheet" href="/Public/css/index/sweet-alert.css" />
	<script src="/Public/js/index/jquery-1.11.3.min.js"></script>
	<script src="/Public/js/index/prefixfree.min.js"></script>
	<script src="/Public/js/index/jquery.smint.js"></script>
	<script src="/Public/js/index/sweet-alert-index.js"></script>
</head>

<style>
.big:hover > img {
    transform: scale(1.05, 1.05);
    transition: .5s transform;
}

.big img{
	width:275px;
	height:275px;
}

.new_goods_list > ul:hover{
	border:1px solid #ef6060;
}

.subMenu {
	position: absolute;
	top: 127px;
	height: 40px;
	z-index: 9998;
	width: 100%;
	max-width: 100%;
	min-width:1200px;
	background: #aabd46;

}

.info_state span{
	display:block;
}


.goods-pl{
	background: #aabd46;
	width:100%;
	height:100%;
	position:absolute;
	top:0px;
	left:0px;
	z-index:9995;
	padding-top: 12px;
  	background-color: rgba(0,0,0,0.7);/* IE9、标准浏览器、IE6和部分IE7内核的浏览器(如QQ浏览器)会读懂 */
  	display:none;
}

.goods-pl p{
	color: white;
}


.plcontent{
	width:100%;
	height:80%;
	overflow-x: hidden; overflow-y: auto; 
}
.plsend{
	padding-left:6%;
	padding-top:5%;
}

.plsend a{
	color:white;
}

.plsend input{
	width:70%;
	height:30px;
	border-radius: 4px 4px 4px 4px;
	border: 1px solid #fb6d78;
}

.pl_bg {
	display: inline-block;
	background: #fb6d78;
	height: 30px;
	line-height: 30px;
	width: 44px;
	text-align: center;
	border-radius: 4px 4px 4px 4px;
}
.plname{
	color: rgba(127, 253, 11, 0.92);
}

#cellclien{
	width:150px;
	color:white;
	line-height:40px;
	margin-left:50px;
	position: absolute;
}
#cellclien:hover .qrcode{
	display:block;
}

.qrcode{
	display:none;	
	position:absolute;
	z-index:9995; 
	left:-45px;
	top:40px;
}

#jifen{
	color:white;
	margin-left:150px;
	line-height:40px;
	position: absolute;
}

#weixin{
	margin-top: 65px;
	padding-left:5px;
	text-align:left;
	width:100px;
	position: absolute;
}

#weixin:hover .weixincode{
	display:block;
}

.weixincode{
	top:1px;
	height:100px;
	left:-100px;
	position: absolute;
	display:none;
}

#weibo{
	padding-left:5px;
	text-align:left;
	width:100px;
	position: absolute;
}

#weibo:hover .weibocode{
	display:block;
}

.weibocode{
	top:1px;
	height:100px;
	left:-100px;
	position: absolute;
	display:none;
}

</style>

<body>  
<div class="header">
    <div class="header_up">
        <div class="center">
            <ul class="top_navbar">
            <?php $login=session('user.uid'); if(!$login){ ?>
                <li><a href="/Login/qqlogin">QQ登录</a></li>
                <li class="line"></li>
                <li><a href="/Login">登录</a>&nbsp;&nbsp;<a href="/Signup">免费注册</a></li>
            <?php }else{ ?>
            	<li class="active"><a href="/user" ><img width="20px" src="/uploads/<?php echo session('user.userpic'); ?>" /></a></li>
            	<li class="active"><a href="/User" style="color:red"><?php echo session('user.username'); ?></a></li>
            	<li class="active"><a href="/Login/loginout" style="color:red">退出</a></li>
            <?php } ?>
            
                <li class="line"></li>
                <li class="active"><a href="/user/comment">我的评论</a></li>
                <li class="line"></li>
                <li class="active"><a href="/user/favorate">我的收藏</a></li>
                <li class="line"></li>
                <li><a href="#">联系客服</a></li>
                <li class="line"></li>
                <li><a href="#">卖家报名</a></li>
            </ul>
        </div>
    </div>
    <div class="header_down">
        <div class="center">
            <div class="logo">
                <a href="/"><img src="/Public/images/index/logo.png" alt=""/></a>
            </div>
            <div class="search">
                <div class="search_box">
                <form id="searchfrom" method="get" action="/search/index">
	                    <input type="search" name="keywords" placeholder="打几个字儿呗"/>
		                <a href="javascript:void(0)" onclick="submit()" class="search_bg">GO</a> 
                  </form>
                </div>
            </div>
            <div class="top_text">
                <ul>
                    <li>
                        <img src="/Public/images/index/top_icon_01.png" alt=""/>
                        <span>每天11:00开抢</span>
                    </li>
                    <li>
                        <img src="/Public/images/index/top_icon_02.png" alt=""/>
                        <span>校园专业挑款</span>
                    </li>
                    <li>
                        <img src="/Public/images/index/top_icon_03.png" alt=""/>
                        <span>商家品质保证</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="subMenu">
	<div class="goods_navbar">
	    <div class="center">
	        <ul>
	            <li class="<?php $cate=$pageInfo['cate']; if(empty($cate)){echo 'active';} ?>">
	                <a href="/">
	                    <img src="/Public/images/index/goods_type_01.png" alt=""/>
	                    <span>全部</span>
	                </a>
	            </li>
	            <li class="<?php if($pageInfo['cate']==1){echo 'active';} ?>">
	                <a href="/Girls">
	                    <img src="/Public/images/index/goods_type_02.png" alt=""/>
	                    <span>女神</span>
	                </a>
	            </li>
	            <li class="<?php if($pageInfo['cate']==2){echo 'active';} ?>">
	                <a href="Boys">
	                    <img src="/Public/images/index/goods_type_03.png" alt=""/>
	                    <span>男神</span>
	                </a>
	            </li>
	            <li class="<?php if($pageInfo['cate']==5){echo 'active';} ?>">
	                <a href="/Foods">
	                    <img src="/Public/images/index/goods_type_04.png" alt=""/>
	                    <span>美食</span>
	                </a>
	            </li>
	            <li class="<?php if($pageInfo['cate']==4){echo 'active';} ?>">
	                <a href="/ShoeAndBags">
	                    <img src="/Public/images/index/goods_type_05.png" alt=""/>
	                    <span>鞋包</span>
	                </a>
	            </li>
	            <li class="<?php if($pageInfo['cate']==187){echo 'active';} ?>">
	                <a href="/Dormitory">
	                    <img src="/Public/images/index/goods_type_06.png" alt=""/>
	                    <span>宅宿舍</span>
	                </a>
	            </li>
	            <li class="<?php if($pageInfo['cate']==188){echo 'active';} ?>">
	                <a href="/Digital">
	                    <img src="/Public/images/index/goods_type_07.png" alt=""/>
	                    <span>数码</span>
	                </a>
	            </li>
	            <li class="<?php if($pageInfo['cate']==3){echo 'active';} ?>">
	                <a href="/Beauty">
	                    <img src="/Public/images/index/goods_type_08.png" alt=""/>
	                    <span>美妆</span>
	                </a>
	            </li>
	            <li class="<?php if($pageInfo['cate']==8){echo 'active';} ?>">
	                <a href="/Sports">
	                    <img src="/Public/images/index/goods_type_09.png" alt=""/>
	                    <span>文体</span>
	                </a>
	            </li>
	            	
	                <a href="javascript:void(0)" id="cellclien">手机客户端<img class="qrcode" src="/Public/images/index/qrcode.png" /></a>
	                
	                <a href="javascript:void(0)" <?php $qiandao=session('user.qiandao');if(!$qiandao){ ?>  onclick="qiandao()"<?php } ?> id="jifen"><?php if($qiandao){echo "已签到";}else{echo "签到领积分";} ?></a>
	           
	        </ul>
	    </div>
	</div>
</div>
 ﻿
<link rel="stylesheet" type="text/css" href="/Public/css/user/comment.css"></link>

<!--  -->
<div id="user" class="area clear">
	<div id="userleft">
		<div class="left-top">
			<img src="/uploads/<?php echo session('user.userpic'); ?>" width="150px" height="150px"></img>
		</div>
		<div class="sider-bar">
			<ul>
				<li><a href="<?php echo U("User/index"); ?>">基本资料</a></li>
				<li class="activ"><a href="<?php echo U("User/comment"); ?>"
						style="color:rgb(255,255,255);">我的评论</a></li>
				<li><a href="<?php echo U("User/favorate"); ?>">我的收藏</a></li>
				<li><a href="<?php echo U("User/beans"); ?>">我的积分</a></li>
			</ul>
		</div>
	</div>
	<div id="userright">
		<div class="userinfo1">
		
		      		 	 <div class="star_goods" >
        <h3>
            <img src="/Public/images/index/star.png" alt=""/>
            <span>我的评论</span>
            <span class="vice"></span>
        </h3> 
        <ul>
        <?php  foreach($comment as $k=>$v){ ?>
            <li class="star_goods_list">
                <ul>
                    <li class="goods_pic">
                      <img src="<?php echo ($v['gimage']); ?>" alt=""/>
                      <a href="javascript:void(0)"><img class="NO_num" onclick="toDelete(<?php echo ($v['cid']); ?>)" src="/Public/images/user/delete.png" alt=""/></a>
                    </li>
                    <li class="goods_title"><p><span style="color:red">评论内容：</span><?php echo ($v['content']); ?></p></li>
                    <li class="goods_title"><p style="color:#968888"><span style="color:red">时间：</span><?php echo ($v['addtime']); ?></p></li>
                    <li class="pirce"><span></span></li>
                </ul>
            </li>
           <?php } ?>
        </ul>
    </div>
		</div>
		<div class="clear"></div>
		<div><?php echo ($page); ?></div>

		<div class="clear"></div>
	</div>
</div>

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
								    if(data.s != 0){
								    	alert("参数错误");	
								    }else{
								    	location.reload(true);
								    }
								  },"json");
					});
		}
   </script>



<div class="footer">
        <div class="footer_up">
            <div class="center">
                <ul>
                    <li><img src="/Public/images/index/foot_info_01.png" alt=""/>100%品质保障</li>
                    <li><img src="/Public/images/index/foot_info_02.png" alt=""/>新品更新速度快</li>
                    <li><img src="/Public/images/index/foot_info_03.png" alt=""/>青春潮流的聚集地</li>
                    <li><img src="/Public/images/index/foot_info_04.png" alt=""/>专业在线客服</li>
                </ul>
            </div>
        </div>
       <div class="footer_down">
           <div class="center">
               <ul>
                   <li>
                       <ul>
                           <li class="title">关于我们</li>
                           <li><a href="#">关于我们</a></li>
                           <li><a href="#">诚聘英才</a></li>
                           <li><a href="#">校园合伙人</a></li>
                       </ul>
                   </li>
                   <li>
                       <ul>
                           <li class="title">商务合作</li>
                           <li><a href="#">卖家免费报名</a></li>
                           <li><a href="#">友情链接</a></li>
                       </ul>
                   </li>
                   <li>
                       <ul>
                           <li class="title">帮助中心</li>
                           <li><a href="#">联系我们</a></li>
                           <li><a href="#">联系客服</a></li>
                       </ul>
                   </li>
                   <li>
                       <ul>
                           <li class="title">关注我们</li>
                           <li><a href="#">新浪微博</a></li>
                           <li><a href="#">微信号</a></li>
                       </ul>
                   </li>
                   <li>
                       <ul>
                           <li class="title">购物指南</li>
                           <li><a href="#">用户注册</a></li>
                           <li><a href="#">支付方式</a></li>
                       </ul>
                   </li>
                   <li class="code">
                       <ul>
                           <li><img src="/Public/images/index/code.png" alt=""/></li>
                           <li>
                               关注我们，更多惊喜
                           </li>
                       </ul>
                   </li>
               </ul>
           </div>
       </div>
</div>
<div class="right_fix_nav">
    <ul>
        <li>
            <a href="#"><img src="/Public/images/index/float_01.png" alt=""/><span>用户</span></a>
        </li>
        <li>
            <a href="/user/favorate"><img src="/Public/images/index/float_02.png" alt=""/><span>收藏</span></a>
        </li>
        <li>
            <a href="/user/comment"><img src="/Public/images/index/float_03.png" alt=""/><span>评论</span></a>
        </li>
        <li id="weibo">
      	  <img class="weibocode" src="/Public/images/index/weiboqr.png"  />
            <a href="javascript:void(0)"><img src="/Public/images/index/float_04.png" alt=""/><span>微博</span></a>
        </li>
        <li id="weixin">
        	<img class="weixincode" src="/Public/images/index/weixinqr.jpg"  />
            <a href="javascript:void(0)"><img src="/Public/images/index/float_05.png" alt=""/><span>微信</span></a>
        </li>
        <li style="margin-top: 160px;">
            <a href="/Question"><img src="/Public/images/index/float_06.png" alt=""/><span>意见</span></a>
        </li>
        <li class="return">
            <a href="javascript:;"><img src="/Public/images/index/float_07.png" alt=""/><span>回到顶部</span></a>
        </li>
    </ul>
</div>
<input type="hidden" value="<?php echo session('user.username'); ?>" id="username" />

<!-- 浮动导航 -->
<script src="/Public/js/index/jquery.smint.js"></script>
<script src="/Public/js/index/lunbo.js"></script>
<script src="/Public/js/index/praise.js"></script>
<script type="text/javascript">
$(document).ready( function() {
    $('.subMenu').smint({
    	'scrollSpeed' : 1000
    });
});

var login = <?php if($uid = is_login()){echo $uid;}else{echo 'false';} ?>;

</script>
<script>
    $(function(){
        $(".return").click(function(){
            $('body,html').animate({scrollTop:0},200);

        });
    });
</script>
</body>
</html>