<?php

namespace Home\Controller;

use Think\Controller;

class IndexController extends Controller {
	
	public function index() {
		$p = I ( 'p' );
		empty($p) ? $p=1 : $p;
		$goods_model = M ( 'goods' );
		$goodlist = $goods_model->where()->limit(0, 50)->order('addtime asc')->select();
		
		//$show = pro_page ( $count, 100, $p, '', $qianzhui );
		
		//$this->assign('show', $show);
		$this->assign('goodlist', $goodlist);
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
}