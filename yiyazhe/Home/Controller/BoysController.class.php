<?php
namespace Home\Controller;
use Think\Controller;
class BoysController extends Controller {
    public function index(){
    	$p = I ( 'p' );
    	empty($p) ? $p=1 : $p;
    	$p -= 1;
    	$goods_model = D('Index');
    	list($goodsArr, $show, $count) = $goods_model->getIndexGoods($p, '2', 80);
    	 
    	$this->assign('count', $count);
    	$this->assign('show', $show);
    	$this->assign('goodlist', $goodsArr);
    	$this->display();
    }
}