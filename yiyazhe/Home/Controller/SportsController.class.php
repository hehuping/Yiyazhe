<?php
namespace Home\Controller;
use Think\Controller;
class SportsController extends Controller {
    public function index(){
    	
    	$pageInfo = array(
    			'title' => "【文体】学生文体折扣特价,体育课,新款文体9.9包邮- 咿呀折",
    			'keywords' => "学生文体,体育课用品,品牌文体,折扣文体,新款文体",
    			'description' => "精选优质折扣文体商品，天天有新款，价格足够低。当季新品文体，品牌文体，9.9元包邮文体等特价商品特卖，全场低至1折起包邮，每日更新。【咿呀折-校园折扣】",
    			'cate' => 8,
    	);
    	
    	
    	$p = I ( 'p' );
    	empty($p) ? $p=1 : $p;
    	$p -= 1;
    	$goods_model = D('Index');
    	list($goodsArr, $show, $count) = $goods_model->getIndexGoods($p, 8, 80);
    	
    	$this->assign('pageInfo', $pageInfo);
    	$this->assign('count', $count);
    	$this->assign('show', $show);
    	$this->assign('goodlist', $goodsArr);
    	$this->display();
    }
    
    public function sendSports(){
    	$p = I ( 'p' );
    	empty($p) ? $p=1 : $p;
    	$p -= 1;
    	$goods_model = D('Index');
    	list($goodsArr, $show, $count) = $goods_model->getIndexGoods($p, 8, 80);
    	$obj = new Data();
    	$obj->status = 1;
    	$obj->data = $goodsArr;
    	$obj->page = $p;
    	$obj->barnner = array(
    			'http://www.yiyazhe.com/Public/images/phone/phone-wenti.png',
    	);
    
    	$this->ajaxReturn($obj);
    }
}