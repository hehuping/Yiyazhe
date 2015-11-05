<?php
namespace Home\Controller;
use Think\Controller;
use Home\Model\Data;
class PuserController extends Controller {
	public function getComment(){
		$p = I('p');
		$uid = I('post.uid');
		empty($p) ? $p=1 : $p=I('p');
		$comment = array();
		$model = D('Comment');
		list($comment, $page) = $model->getUserComment($uid, $p-1);
		
		$obj = new Data();
		$obj->status = 1;
		$obj->data = $comment;
		$obj->page = $p;
		$obj->barnner = array(
				'http://www.yiyazhe.com/Public/images/index/cateboys.png',
		);
		 
		$this->ajaxReturn($obj);
	}
}