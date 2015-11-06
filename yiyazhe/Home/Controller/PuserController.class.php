<?php
namespace Home\Controller;
use Think\Controller;
use Home\Model\Data;
class PuserController extends Controller {
	public function getComment(){
		$p = I('p');
		$uid = I('uid');
		empty($p) ? $p=1 : $p=I('p');
		$comment = array();
		$model = D('Comment');
		list($comment, $page) = $model->getUserComment($uid, $p-1);
		
		$obj = new Data();
		$obj->status = 0;
		$obj->data = $comment;
		$obj->page = $p;
		$obj->barnner = array(
				//'http://www.yiyazhe.com/Public/images/index/cateboys.png',
		);
		 
		$this->ajaxReturn($obj);
	}
	
	public function doComment(){
		$arr = array('s'=>0,'error'=>'');
		$gid = I('post.gid');
		$uid = I('post.uid');
		$content = I('post.content');
		$username = I('post.username');
		
		$obj = new Data();
		if(!valideContent($content)){
			$obj->status = -1;
			$obj->error = "评论字数不能小于3大于20";
			$this->ajaxReturn($obj);
			die();
		}
		$comment_model = M('comment');
		$goods_model = M('goods');
		$has = $comment_model->where('gid='.$gid.' && uid='.$uid)->find();
	
		if($has){
			$obj->status = -2;
			$obj->error = "一件商品只能评论一次哦";
			$this->ajaxReturn($obj);
			die();
		}
	
		if(IS_POST){
				
			$data = array(
					'uid' => $uid,
					'gid' => $gid,
					'content' => I('content'),
					'username' => $username,
			);
			if($comment_model->add($data)){
				$goods_model->where('gid='.$gid)->setInc('comment',1);
				$this->ajaxReturn($obj);
			}else{
				$arr['s'] = -3;
				$arr['error'] = 'Sorry 数据错误';
				$this->ajaxReturn($obj);
			}
		}else{
			$this->error('非法访问！');
		}
	}
}