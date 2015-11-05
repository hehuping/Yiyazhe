<?php

namespace Home\Controller;
use Think\Controller;
use Home\Model\DataModel;
use Home\Model\Data;

class SearchController extends Controller {
	public function index(){
		$p = I('p');
		empty($p) ? $p=1 : $p;
		$p-=1;
		$keywords = I('keywords');
		if(empty($keywords)){
			$this->redirect('Index');
		}
		$model = D('Search');
		list($result, $show, $count)=$model->getSearchGoods($p, $keywords, 80);
		
		$this->assign('keywords', $keywords);
		$this->assign('goodlist', $result);
		$this->assign('show', $show);
		$this->assign('count', $count);
		$this->display();
		
	}
	
	public function sendSearch(){
		
		$p = I('p');
		empty($p) ? $p=1 : $p;
		$obj = new Data();
		$keywords = I('keywords');
		if(empty($keywords)){
			$obj->status = -1;
			$obj->error = "关键字不能为空";
			$this->ajaxReturn($obj);
			die;
		}
		$model = D('Search');
		list($result, $show, $count)=$model->getSearchGoods($p-1, $keywords, 80);

		$obj->count = $count;
		$obj->data = $result;
		$obj->page = $p;
		$obj->barnner = array(
				//'http://www.yiyazhe.com/Public/images/index/cateboys.png',
		);
		 
		$this->ajaxReturn($obj);
	}
}