<?php

namespace Home\Controller;

use Think\Controller;

class IndexController extends Controller {
	
	public function index() {
		$p = I ( 'p' );
		empty($p) ? $p=1 : $p;
		$p -= 1;
		$goods_model = D('Index');
		list($goodsArr, $show) = $goods_model->getIndexGoods($p, 80);
		
		$this->assign('show', $show);
		$this->assign('goodlist', $goodsArr);
		$this->display();
	}

	public function send(){
		$goods_model = M ( 'goods' );
		$goodlist = $goods_model->where()->limit(0, 20)->order('addtime asc')->select();
		
		$this->ajaxReturn($goodlist);
	}
	
	/*
	 * 用户点赞
	 * 
	 * */
	public function praise(){
		$arr = array('s'=>0,'error'=>'');
		$ip = get_client_ip();
		$praise_model = M('praise');
		$goods_model = M('goods');
		if(IS_AJAX){
			$gid = I('gid');
			$type = I('type');
			$data = array(
					'uid' => is_login(),
					'gid' => $gid,
					'type' => $type,
					'ip' =>  $ip,
			);
			if($praise_model->add($data)){
				if($type == 1){
					$goods_model->where('gid='.$gid)->setInc('praise',1);
					cookie('like'.$gid,$gid,(24*60*60*5));
				}else{
					$goods_model->where('gid='.$gid)->setInc('dislike',1);
					cookie('dislike'.$gid,$gid,(24*60*60*5));
				}
				$this->ajaxReturn($arr);
			}else{
				$arr['s'] = 1;
				$arr['error'] = 'Sorry 数据错误';
				$this->ajaxReturn($arr);
			}
		}else{
			$this->error('非法访问！');
		}
	}
	
	/*
	 * 用户评论
	 *
	 * */
	public function comment(){
		$arr = array('s'=>0,'error'=>'');
		$gid = I('gid');
		$uid = is_login();
		$content = I('content');
		
		if(!$this->valideContent($content)){
			$arr['s'] = 1;
			$arr['error'] = "评论字数不能小于3大于20";
			$this->ajaxReturn($arr);
			die();
		}
		$comment_model = M('comment');
		$goods_model = M('goods');
		$has = $comment_model->where('gid='.$gid.' && uid='.$uid)->find();
		
		if($has){
			$arr['s'] = 2;
			$arr['error'] = "亲爱的，一件商品只能评论一次哦";
			$this->ajaxReturn($arr);
			die();
		}
		
		if(IS_AJAX){
			
			$data = array(
					'uid' => $uid,
					'gid' => $gid,
					'content' => I('content'),
					'username' => session('user.username'),
			);
			if($comment_model->add($data)){
				$goods_model->where('gid='.$gid)->setInc('comment',1);
				$this->ajaxReturn($arr);
			}else{
				$arr['s'] = 3;
				$arr['error'] = 'Sorry 数据错误';
				$this->ajaxReturn($arr);
			}
		}else{
			$this->error('非法访问！');
		}
	}
	
	/*
	 * 过滤评论空格，验证其字数
	 * */
	private function valideContent($content){
		$content = trim($content);
		$strlen = mb_strlen($content);
		if($strlen>20 || $strlen<3){
			return false;
		}else{
			return true;
		}
	}
}