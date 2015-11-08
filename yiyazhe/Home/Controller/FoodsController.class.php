<?php
namespace Home\Controller;
use Think\Controller;
use Home\Model\Data;
class FoodsController extends Controller {
    public function index(){
    	
    	$pageInfo = array(
    			'title' => "【美食】学生美食,校园零食,好吃的零食,网上买零食9.9包邮 - 咿呀折",
    			'keywords' => "美食,零食,人气美食,好吃的零食,网上买零食,9.9包邮美食",
    			'description' => "精选优质折扣美食商品，天天有新款，价格足够低。淘宝网人气美食，休闲零食，特色零食等好吃的零食特卖，全场低至1折起包邮，每日更新，天天都是1111。【咿呀折-校园折扣】",
    			'cate' => 5,
    	);
    	
    	$p = I ( 'p' );
    	empty($p) ? $p=1 : $p;
    	$goods_model = D('Index');
    	list($goodsArr, $show, $count) = $goods_model->getIndexGoods($p-1, 5, 80);
    	
    	$this->assign('pageInfo',$pageInfo);
    	$this->assign('count', $count);
    	$this->assign('show', $show);
    	$this->assign('goodlist', $goodsArr);
    	$this->display();
    }
    
    public function sendFoods(){
    	$p = I ( 'p' );
    	empty($p) ? $p=1 : $p;
    	$p -= 1;
    	$goods_model = D('Index');
    	list($goodsArr, $show, $count) = $goods_model->getIndexGoods($p, 5, 20);
    	$obj = new Data();
    	$obj->count = $count;
    	$obj->status = 1;
    	$obj->data = $goodsArr;
    	$obj->page = $p;
    	$obj->barnner = array(
    			'http://www.yiyazhe.com/Public/images/phone/phone-meishi.png',
    	);
    
    	$this->ajaxReturn($obj);
    }
}