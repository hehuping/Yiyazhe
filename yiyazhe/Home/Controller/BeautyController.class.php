<?php
namespace Home\Controller;
use Think\Controller;
use Home\Model\Data;
class BeautyController extends Controller {
    public function index(){
    	
    	$pageInfo = array(
    			'title' => "【美妆】学生化妆品,护肤品,学生美妆,护理用品,女士化妆品,男士化妆品,网购化妆品9.9包邮 - 咿呀折",
    			'keywords' => "化妆品,护肤品,美妆,男士化妆品,女士化妆品,网购化妆品,买化妆品,化妆品品牌,9.9包邮化妆品",
    			'description' => "精选优质折扣化妆品商品，天天有新款，价格足够低。女士化妆品，男士化妆品，护肤品，护理用品等特价美妆特卖，全场低至1折起包邮，每日更新。【咿呀折-校园折扣】",
    			'cate' => 3,
    	);
    	
    	
    	$p = I ( 'p' );
    	empty($p) ? $p=1 : $p;
    	$p -= 1;
    	$goods_model = D('Index');
    	list($goodsArr, $show, $count) = $goods_model->getIndexGoods($p, '3,275', 80);
    	
    	$this->assign('pageInfo', $pageInfo);
    	$this->assign('count', $count);
    	$this->assign('show', $show);
    	$this->assign('goodlist', $goodsArr);
    	$this->display();
    }
    
    public function sendBeauty(){
    	$p = I ( 'p' );
    	empty($p) ? $p=1 : $p;
    	$goods_model = D('Index');
    	list($goodsArr, $show, $count) = $goods_model->getIndexGoods($p-1, '3,275', 80);
    	$obj = new Data();
    	$obj->status = 1;
    	$obj->data = $goodsArr;
    	$obj->page = $p;
    	$obj->barnner = array(
    			'http://www.yiyazhe.com/Public/images/phone/phone-meizhuang.png',
    	);
    	 
    	$this->ajaxReturn($obj);
    }
}