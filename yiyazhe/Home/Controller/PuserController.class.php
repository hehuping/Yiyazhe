<?php
namespace Home\Controller;
use Think\Controller;
use Home\Model\Data;
use Org\Util\Date;
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
	
	/*
	 * 积分页面
	 * */
	public function getbeans(){

		$p = I('p');
		$uid = I('uid');
		empty($p) ? $p=1 : $p=I('p');
		$jifen = array();
		$page = '';
		$model = D('Jifen');
		list($jifen, $page, $sum) = $model->getUserBeans($uid, $p-1, 0);
	

		$obj = new Data();
		$obj->status = 0;
		$obj->data = $jifen;
		$obj->page = $p;
		$obj->totle = $sum;
			
		$this->ajaxReturn($obj);
	}
	
	/*
	 * 今日上新
	 * */
	public function getToday(){
		$p = I('p');
		empty($p) ? $p=1 : $p=I('p');
		$model = D('Goods');
		$date = date('Y-m-d',time()).' 10:00:00';
		$condition = " && star_time = '{$date}'";
		list($goodsData, $show, $count) = $model->getgoods($p, 20, $condition);
		
		$obj = new Data();
		$obj->status = 0;
		$obj->data = $goodsData;
		$obj->page = $p;
		$obj->count = $count;
			
		$this->ajaxReturn($obj);
	}
	
	/*
	 * 昨日上新
	 * */
	public function getYesterday(){
		$p = I('p');
		empty($p) ? $p=1 : $p=I('p');
		$model = D('Goods');
		$date = date('Y-m-d',time()-(3600*24)).' 10:00:00';
		$condition = " && star_time = '{$date}'";
		list($goodsData, $show, $count) = $model->getgoods($p, 20, $condition);
	
		$obj = new Data();
		$obj->status = 0;
		$obj->data = $goodsData;
		$obj->page = $p;
		$obj->count = $count;
			
		$this->ajaxReturn($obj);
	}
	
	/*
	 * 九块九
	 * */
	public function getJiukuaijiu(){
		$p = I('p');
		empty($p) ? $p=1 : $p=I('p');
		$model = D('Goods');
		$condition = " && price<10";
		list($goodsData, $show, $count) = $model->getgoods($p, 20, $condition);
	
		$obj = new Data();
		$obj->status = 0;
		$obj->data = $goodsData;
		$obj->page = $p;
		$obj->count = $count;
			
		$this->ajaxReturn($obj);
	}
	
	/*
	 * top100
	 * */
	public function getTop100(){
		$model = D('Goods');
		$order = "yishou desc,";
		list($goodsData, $show, $count) = $model->getgoods($p, 100, $condition,$order);
		
		$obj = new Data();
		$obj->status = 0;
		$obj->data = $goodsData;
		$obj->count = $count;
			
		$this->ajaxReturn($obj);
	}
	
}