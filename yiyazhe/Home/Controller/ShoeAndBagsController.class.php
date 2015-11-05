<?php
namespace Home\Controller;
use Think\Controller;
use Home\Model\Data;
class ShoeAndBagsController extends Controller {
    public function index(){
    	
    	$pageInfo = array(
    			'title' => "【鞋包】网上买女鞋,男鞋,品牌鞋子,品牌箱包折扣特价,网购9.9包邮- 咿呀折",
    			'keywords' => "女鞋,买鞋子,男鞋,网购鞋子,9.9包邮鞋子,品牌鞋子,箱包,品牌箱包,折扣箱包,新款箱包",
    			'description' => "精选优质折扣鞋包商品，天天有新款，价格足够低。当季新品鞋包，品牌鞋包，9.9元包邮鞋包等特价商品特卖，全场低至1折起包邮，每日更新.【咿呀折-校园折扣】",
    			'cate' => 4,
    	);
    	
    	
    	$p = I ( 'p' );
    	empty($p) ? $p=1 : $p;
    	$p -= 1;
    	$goods_model = D('Index');
    	list($goodsArr, $show, $count) = $goods_model->getIndexGoods($p, '4,273', 80);

    	$this->assign('pageInfo', $pageInfo);
    	$this->assign('count', $count);
    	$this->assign('show', $show);
    	$this->assign('goodlist', $goodsArr);
    	$this->display();
    
    }
    
    public function sendShoeAndBags(){
    	$p = I ( 'p' );
    	empty($p) ? $p=1 : $p;
    	$p -= 1;
    	$goods_model = D('Index');
    	list($goodsArr, $show, $count) = $goods_model->getIndexGoods($p, '4,273', 80);
    	$obj = new Data();
    	$obj->status = 1;
    	$obj->data = $goodsArr;
    	$obj->page = $p;
    	$obj->barnner = array(
    			'http://www.yiyazhe.com/Public/images/phone/phone-xiebao.png',
    	);
    
    	$this->ajaxReturn($obj);
    }
}