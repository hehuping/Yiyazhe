<?php
namespace Home\Controller;
use Think\Controller;
class BoysController extends Controller {
    public function index(){
    	$pageInfo = array(
    			'title' => "【男装】时尚男装,折扣特价,新款男装9.9包邮 - 咿呀折",
    			'keywords' => "男装,潮男装,校园男装,折扣男装,新款男装,9.9包邮男装",
    			'description' => "精选优质折扣男装商品，天天有新款，价格足够低。当季新品男装，时尚潮流女装，品牌男装，9.9元包邮男装等特价商品特卖，全场低至1折起包邮，每日更新。【咿呀折-校园折扣】",
    			'cate' => 2,
    	);
    	
    	
    	$p = I ( 'p' );
    	empty($p) ? $p=1 : $p;
    	$p -= 1;
    	$goods_model = D('Index');
    	list($goodsArr, $show, $count) = $goods_model->getIndexGoods($p, '2', 80);

    	$this->assign('pageInfo', $pageInfo);
    	$this->assign('count', $count);
    	$this->assign('show', $show);
    	$this->assign('goodlist', $goodsArr);
    	$this->display();
    }
}