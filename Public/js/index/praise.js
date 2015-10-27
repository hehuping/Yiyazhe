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
	if(login){
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
		
	}else{
		swal({   
			title: "会员独享评论", 
			text: "亲爱的，你还没登录哦，去登录吧？", 
			type: "warning",
			showCancelButton: true,
			confirmButtonText: "走起",
			closeOnConfirm: false 
			},
			function(){
				window.location.href="/Login";
			});
	}

}

