<?php
namespace Home\Controller;
use Think\Controller;
use Home\Model\Data;
class DormitoryController extends Controller {
    public function index(){
    	

    	$pageInfo = array(
    			'title' => "【宅宿舍】宿舍神器,学校卫浴,学生床上用品9.9包邮- 咿呀折",
    			'keywords' => "宿舍用品,卫浴用品,折扣,9.9包邮",
    			'description' => "精选优质折扣宿舍用品商品，天天有新款，价格足够低。淘宝网品牌家居，厨房用品，卫浴用品等淘宝商城家居商品，更有超值居寝室用品9.9包邮特卖抢购！【咿呀折-校园折扣】",
    			'cate' => 187,
    	);
    	
    	
    	$p = I ( 'p' );
    	empty($p) ? $p=1 : $p;
    	$p -= 1;
    	$goods_model = D('Index');
    	list($goodsArr, $show, $count) = $goods_model->getIndexGoods($p, 187, 80);
    	
    	$this->assign('pageInfo', $pageInfo);
    	$this->assign('count', $count);
    	$this->assign('show', $show);
    	$this->assign('goodlist', $goodsArr);
    	$this->display();
    }
    
    public function sendDormitory(){
    	$p = I ( 'p' );
    	empty($p) ? $p=1 : $p;
    	$p -= 1;
    	$goods_model = D('Index');
    	list($goodsArr, $show, $count) = $goods_model->getIndexGoods($p, 187, 80);
    	$obj = new Data();
    	$obj->status = 1;
    	$obj->data = $goodsArr;
    	$obj->page = $p;
    	$obj->barnner = array(
    			'http://www.yiyazhe.com/Public/images/phone/phone-sushe.png',
    	);
    
    	$this->ajaxReturn($obj);
    }
}