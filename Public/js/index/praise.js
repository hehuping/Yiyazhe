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
