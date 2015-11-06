<?php
namespace Home\Controller;
use Think\Controller;
use Home\Model\Data;
class DigitalController extends Controller {
    public function index(){
    	
    	$pageInfo = array(
    			'title' => "【数码】学生特价数码,校园数码,品牌数码折扣特价,新款数码9.9包邮 - 咿呀折",
    			'keywords' => "学生数码,校园数码,数码,品牌数码,折扣数码,新款数码,9.9包邮数码",
    			'description' => "精选优质折扣数码商品，天天有新款，价格足够低。当季新品数码商品，品牌数码商品，9.9元包邮数码商品等特卖，全场低至1折起包邮，每日更新。【咿呀折-校园折扣】",
    			'cate' => 188,
    	);
    	
    	
    	$p = I ( 'p' );
    	empty($p) ? $p=1 : $p;
    	$p -= 1;
    	$goods_model = D('Index');
    	list($goodsArr, $show, $count) = $goods_model->getIndexGoods($p, 188, 80);
    	
    	$this->assign('pageInfo', $pageInfo);
    	$this->assign('count', $count);
    	$this->assign('show', $show);
    	$this->assign('goodlist', $goodsArr);
    	$this->display();
    }
    
    public function sendDigital(){
    	$p = I ( 'p' );
    	empty($p) ? $p=1 : $p;
    	$goods_model = D('Index');
    	list($goodsArr, $show, $count) = $goods_model->getIndexGoods($p-1, 188, 20);
    	$obj = new Data();
    	$obj->status = 1;
    	$obj->data = $goodsArr;
    	$obj->page = $p;
    	$obj->barnner = array(
    			'http://www.yiyazhe.com/Public/images/phone/phone-shuma.png',
    	);
    
    	$this->ajaxReturn($obj);
    }
}