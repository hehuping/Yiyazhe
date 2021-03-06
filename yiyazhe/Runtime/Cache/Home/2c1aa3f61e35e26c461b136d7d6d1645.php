<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="renderer" content="webkit">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=3.0, user-scalable=yes">
    <title>[咿呀折]校园折扣网，汇集青年折扣-学生折扣网，大学生折扣</title>
    <link rel="icon" href=""  type="image/png" sizes="">
    <link rel="stylesheet" href="/Public/css/index/lunbo.css">
    <link rel="stylesheet" href="/Public/css/index/neat.css" type="text/css"  />
    <link rel="stylesheet" href="/Public/css/index/index.css" type="text/css"  />
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
	min-width: 960px;
	background: #aabd46;

}

.info_state span{
	display:block;
}

.goods-pl{
	width:100%;
	height:400px;
	position:absolute;
	top:0px;
	left:0px;
	z-index:9999;
	display:none;
}

</style>

<body>  
<div class="header">
    <div class="header_up">
        <div class="center">
            <ul class="top_navbar">
                <li><a href="#">QQ登录</a></li>
                <li class="line"></li>
                <li><a href="/Login">登录</a>&nbsp;&nbsp;<a href="/Signup">免费注册</a></li>
                <li class="line"></li>
                <li class="active"><a href="#">我的评论</a></li>
                <li class="line"></li>
                <li class="active"><a href="#">我的收藏</a></li>
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
                <a href="#"><img src="/Public/images/index/logo.png" alt=""/></a>
            </div>
            <div class="search">
                <div class="search_box">
                    <input type="search" placeholder="打几个字儿呗"/>
                    <a href="#" class="search_bg">
                        GO
                    </a>
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
	            <li class="active">
	                <a href="#">
	                    <img src="/Public/images/index/goods_type_01.png" alt=""/>
	                    <span>全部</span>
	                </a>
	            </li>
	            <li>
	                <a href="#">
	                    <img src="/Public/images/index/goods_type_02.png" alt=""/>
	                    <span>女神</span>
	                </a>
	            </li>
	            <li>
	                <a href="#">
	                    <img src="/Public/images/index/goods_type_03.png" alt=""/>
	                    <span>男神</span>
	                </a>
	            </li>
	            <li>
	                <a href="#">
	                    <img src="/Public/images/index/goods_type_04.png" alt=""/>
	                    <span>美食</span>
	                </a>
	            </li>
	            <li>
	                <a href="#">
	                    <img src="/Public/images/index/goods_type_05.png" alt=""/>
	                    <span>鞋包</span>
	                </a>
	            </li>
	            <li>
	                <a href="#">
	                    <img src="/Public/images/index/goods_type_06.png" alt=""/>
	                    <span>宅宿舍</span>
	                </a>
	            </li>
	            <li>
	                <a href="#">
	                    <img src="/Public/images/index/goods_type_07.png" alt=""/>
	                    <span>数码</span>
	                </a>
	            </li>
	            <li>
	                <a href="#">
	                    <img src="/Public/images/index/goods_type_08.png" alt=""/>
	                    <span>美妆</span>
	                </a>
	            </li>
	            <li>
	                <a href="#">
	                    <img src="/Public/images/index/goods_type_09.png" alt=""/>
	                    <span>文体</span>
	                </a>
	            </li>
	        </ul>
	    </div>
	</div>
</div>	
<div class="container-fluid">
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
            <li data-target="#carousel-example-generic" data-slide-to="2"></li>

        </ol>
        <div class="carousel-inner" role="listbox">
            <div class="item active" >
                <img src="/Public/images/index/poster_01.png" alt="">
                <div class="carousel-caption">

                </div>
            </div>
            <div class="item">
                <img src="/Public/images/index/poster_01.png" alt="">
                <div class="carousel-caption">

                </div>
            </div>

            <div class="item">
                <img src="/Public/images/index/poster_01.png" alt="">
                <div class="carousel-caption">

                </div>
            </div>
        </div>
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true" style="font-size: 50px;"></span>
            <span class="sr-only"></span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true" style="font-size: 50px;"></span>
            <span class="sr-only"></span>
        </a>
    </div>
</div>

<div class="content">
    <div class="star_goods center" >
        <h3>
            <img src="/Public/images/index/star.png" alt=""/>
            <span>明星9.9</span>
            <span class="vice">start 5</span>
        </h3> 
        <ul>
            <li class="star_goods_list">
                <ul>
                    <li class="goods_pic">
                      <a href="#"><img src="/Public/images/index/goods_01.png" alt=""/></a>
                      <img src="/Public/images/index/NO1.png" alt="" class="NO_num"/>
                    </li>
                    <li class="goods_title"><p><a href="#">韩版脖套加厚保暖学生针织</a></p></li>
                    <li class="pirce">￥ <span>19.00</span></li>
                </ul>
            </li>
            <li class="star_goods_list">
                <ul>
                    <li class="goods_pic">
                        <a href="#"><img src="/Public/images/index/goods_01.png" alt=""/></a>
                        <img src="/Public/images/index/NO2.png" alt="" class="NO_num"/>
                    </li>
                    <li class="goods_title"><p><a href="#">韩版脖套加厚保暖学生针织</a></p></li>
                    <li class="pirce">￥ <span>19.00</span></li>
                </ul>
            </li>
            <li class="star_goods_list">
                <ul>
                    <li class="goods_pic">
                        <a href="#"><img src="/Public/images/index/goods_01.png" alt=""/></a>
                        <img src="/Public/images/index/NO3.png" alt="" class="NO_num"/>
                    </li>
                    <li class="goods_title"><p><a href="#">韩版脖套加厚保暖学生针织</a></p></li>
                    <li class="pirce">￥ <span>19.00</span></li>
                </ul>
            </li>
            <li class="star_goods_list">
                <ul>
                    <li class="goods_pic">
                        <a href="#"><img src="/Public/images/index/goods_01.png" alt=""/></a>
                        <img src="/Public/images/index/NO4.png" alt="" class="NO_num"/>
                    </li>
                    <li class="goods_title"><p><a href="#">韩版脖套加厚保暖学生针织</a></p></li>
                    <li class="pirce">￥ <span>19.00</span></li>
                </ul>
            </li>
            <li class="star_goods_list">
                <ul>
                    <li class="goods_pic">
                        <a href="#"><img src="/Public/images/index/goods_01.png" alt=""/></a>
                        <img src="/Public/images/index/NO5.png" alt="" class="NO_num"/>
                    </li>
                    <li class="goods_title"><p><a href="#">韩版脖套加厚保暖学生针织</a></p></li>
                    <li class="pirce">￥ <span>19.00</span></li>
                </ul>
            </li>
        </ul>
    </div>
    <div class="new_goods center" >
        <h3>
            <img src="/Public/images/index/now.png" alt=""/>
            <span>今天已更新啦</span>
            <span class="vice">450款</span>
        </h3>
        <ul>
        <?php foreach($goodlist as $k=>$v){ ?>
            <li class="new_goods_list">
           
                <ul>
                    <li class="goods_pic">
                        <a href="#"><div class="big"><img src="<?php echo ($v['gimage']); ?>" alt=""/></div></a>
                        <img src="/Public/images/index/xinpin.png" alt="" class="new"/>
                    </li>
                    <li class="goods_title"><p><a href="#"><?php echo ($v['title']); ?></a></p></li>
                    <li class="goods_info">
                        <ul>
                            <li class="goods_info_left">
                                <ul>
                                    <li class="pirce">￥ <span><?php echo ($v['price']); ?></span></li>
                                    <li><span class="original">￥<?php echo ($v['oldprice']); ?></span> <span class="discount">3.2折</span></li>
                                    <li class="sell_out">
                                        <span>已售<?php echo ($v['yishou']); ?></span>
                                        
                                    </li>
                                </ul>
                            </li>
                            <li class="goods_info_right">
                                <ul>
                                    <li class="info_state">
                                        <ul style="position:rela">
                                            <li>
                                               <a href="javascript::void(0);" onclick="make(<?php echo ($v['gid']); ?>);" id="za<?php echo ($v['gid']); ?>"><img id="z<?php echo ($v['gid']); ?>" width="20px" src="/Public/images/index/info_icon_01.png" alt=""/></a>
                                                <span id="zn<?php echo ($v['gid']); ?>">9</span>
                                            </li>
                                            <li>
                                             <a href="javascript::void(0);" onclick="comment(<?php echo ($v['gid']); ?>);" id="pl<?php echo ($v['gid']); ?>"><img src="/Public/images/index/info_icon_02.png" alt=""/></a>
                                                <span id="pn<?php echo ($v['gid']); ?>">19999</span>
                                            </li>
                                            <li>
                                               <a href="javascript::void(0);" onclick="dislike(<?php echo ($v['gid']); ?>);" id="da<?php echo ($v['gid']); ?>"><img id="nz<?php echo ($v['gid']); ?>"  width="20px" src="/Public/images/index/info_icon_03.png" alt=""/></a>
                                                <span id="dn<?php echo ($v['gid']); ?>">19</span>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="tmall">
                                        <a href="#">
                                            <img src="/Public/images/index/tmall.png" alt=""/> 天猫
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <?php } ?>
        </ul>
    </div>
    <div class="page center">
           <ul>
               <li class="arrow"><a href="#">&lsaquo;</a></li>
               <li class="active"><a href="#">1</a></li>
               <li><a href="#">2</a></li>
               <li><a href="#">3</a></li>
               <li><a href="#">4</a></li>
               <li><a href="#">5</a></li>
               <li><a href="#">&hellip;</a></li>
               <li><a href="#">11</a></li>
               <li class="arrow"><a href="#">&rsaquo;</a></li>
           </ul>
    </div>
</div>


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
            <a href="#"><img src="/Public/images/index/float_02.png" alt=""/><span>收藏</span></a>
        </li>
        <li>
            <a href="#"><img src="/Public/images/index/float_03.png" alt=""/><span>评论</span></a>
        </li>
        <li>
            <a href="#"><img src="/Public/images/index/float_04.png" alt=""/><span>微博</span></a>
        </li>
        <li>
            <a href="#"><img src="/Public/images/index/float_05.png" alt=""/><span>微信</span></a>
        </li>
        <li style="margin-top: 160px;">
            <a href="#"><img src="/Public/images/index/float_06.png" alt=""/><span>其他</span></a>
        </li>
        <li class="return">
            <a href="javascript:;"><img src="/Public/images/index/float_07.png" alt=""/><span>回到顶部</span></a>
        </li>
    </ul>
</div>
</body>
<script src="/Public/js/index/jquery-1.11.3.min.js"></script>
<script src="/Public/js/index/lunbo.js"></script>
<script src="/Public/js/index/prefixfree.min.js"></script>
<script src="/Public/js/index/jquery.smint.js"></script>

<!-- 轮播图JS实现 -->
<script>
    $(function(){
        $(".return").click(function(){
            $('body,html').animate({scrollTop:0},200);

        });
    });
</script>
<!--[if lte IE 9]>

<script src="js/jquery.placeholder.min.js"></script>
<script src="js/ie_placeholder.js"></script>
<![endif]-->

<script>
/*
 * 点赞动画交互
 */

function make(id){
	var has = $("#da"+id).attr('onclick');
	if(has != ""){
		$("#z"+id).animate({width:'23px'});
		$("#z"+id).animate({width:'20px'});
		$("#z"+id).attr('src','/Public/images/index/like.png');
		$("#za"+id).attr('onclick','');
		var num = parseInt($("#zn"+id).html());
		$("#zn"+id).html(num+1);
	}
}
/*
 * 不喜欢按钮
 */
function dislike(id){
	var has = $("#za"+id).attr('onclick');
	if(has != ""){
		$("#nz"+id).animate({width:'23px'});
		$("#nz"+id).animate({width:'20px'});
		$("#nz"+id).attr('src','/Public/images/index/dislike.png');
		$("#da"+id).attr('onclick','');
		var num = parseInt($("#dn"+id).html());
		$("#dn"+id).html(num+1);
	}
}
</script>
<!-- 浮动导航 -->
<script type="text/javascript">
$(document).ready( function() {
    $('.subMenu').smint({
    	'scrollSpeed' : 1000
    });
});
</script>

</html>