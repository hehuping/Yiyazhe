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
}