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
}