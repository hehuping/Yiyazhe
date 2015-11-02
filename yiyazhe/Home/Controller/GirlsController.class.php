<?php
namespace Home\Controller;
use Think\Controller;
class GirlsController extends Controller {
    public function index(){

    	$pageInfo = array(
    			'title' => "【女装】时尚女装折扣特价,新款女装9.9包邮 - 咿呀折",
    			'keywords' => "女装,时尚女装,校园女装,折扣女装,新款女装,9.9包邮女装",
    			'description' => "精选优质折扣女装商品，天天有新款，价格足够低。当季新品女装，时尚潮流女装，品牌女装，9.9元包邮女装等特价商品特卖，全场低至1折起包邮，每日更新。【咿呀折-校园折扣】",
    			'cate' => 1,
    			'banner' => 'categirl.png'
    	);
    	
    	$p = I ( 'p' );
    	empty($p) ? $p=1 : $p;
    	$p -= 1;
    	$goods_model = D('Index');
    	list($goodsArr, $show, $count) = $goods_model->getIndexGoods($p, 1, 80);
		
    	$this->assign('pageInfo', $pageInfo);
    	$this->assign('count', $count);
    	$this->assign('show', $show);
    	$this->assign('goodlist', $goodsArr);
    	$this->display();
  	}
}