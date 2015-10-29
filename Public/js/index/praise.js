/*
 * 点赞动画交互
 */
function like(id){
	var has = $("#da"+id).attr('onclick');
	if(has != ""){
		$.ajax({
            type: "POST",
            url: "/Index/praise",
            data: {'gid':id, 'type':1},
            dataType: "json",
            success: function(data){
            			if(data.s == 0){
            				$("#z"+id).animate({width:'23px'});
            				$("#z"+id).animate({width:'20px'});
            				$("#z"+id).attr('src','/Public/images/index/like.png');
            				$("#za"+id).attr('onclick','');
            				var num = parseInt($("#zn"+id).html());
            				$("#zn"+id).html(num+1);
            			}else{
            				alert(data.error);
            			}
                     }
        });
		
	}
}


/*
 * 不喜欢按钮
 */
function dislike(id){
	var has = $("#za"+id).attr('onclick');
	if(has != ""){
		$.ajax({
            type: "POST",
            url: "/Index/praise",
            data: {'gid':id, 'type':2},
            dataType: "json",
            success: function(data){
            			if(data.s == 0){
            				$("#nz"+id).animate({width:'23px'});
            				$("#nz"+id).animate({width:'20px'});
            				$("#nz"+id).attr('src','/Public/images/index/dislike.png');
            				$("#da"+id).attr('onclick','');
            				var num = parseInt($("#dn"+id).html());
            				$("#dn"+id).html(num+1);
            			}else{
            				alert(data.error);
            			}
                     }
        });
	}
}

/*
 * 评论
 * */
function sendComment(id){
	var content = $("#comment"+id).val();
	if(is_login()){
	var username = $("#username").val();
		$.ajax({
            type: "POST",
            url: "/Index/comment",
            data: {'gid':id,'content':content},
            dataType: "json",
            success: function(data){
            			if(data.s != 0){
            				sweetAlert("有点小错误", data.error,'warning');
            				swal({   
            					title: "", 
            					text: data.error, 
            					type: "warning",
            					showCancelButton: false,
            					confirmButtonText: "知道了",
            					closeOnConfirm: false 
            					});
            					
            			}else{
            				var num = parseInt($("#pn"+id).html());
            				$("#pn"+id).html(num+1);
            				$("#comment"+id).val('');
            				$('<p><em class="plname">'+username+'</em>：'+content+'</p>').appendTo("#plcontent"+id);
            			}
                     }
        });
		
	}
}

/*
 * 收藏
 * */
function favorate(id){
	if(is_login()){
		$.ajax({
            type: "POST",
            url: "/Index/favorate",
            data: {'gid':id},
            dataType: "json",
            success: function(data){
            			$("#favorate"+id).attr("src","/Public/images/index/favorates.png");
            			$("#favorate"+id).attr("onclick","");
                     }
        });
	}
}

function is_login(){
	if(!login){
		swal({   
			title: "", 
			text: "亲爱的，你还没登录哦，去登录吧？", 
			type: "warning",
			showCancelButton: true,
			confirmButtonText: "走起",
			closeOnConfirm: false 
			},
			function(){
				window.location.href="/Login";
			});
		return false;
	}else{
		return true;
	}
}

/*
 * 评论点击出来
 */
function comment(id){
	//$("#scom"+id).css("display","block");
	  $("#scom"+id).fadeToggle("slow");

}
/*
 * 鼠标离开评论隐藏
 */
$(".goods-pl").mouseleave(function(){
	 $(this).fadeOut("slow");
	// alert(3232);

});

