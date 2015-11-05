<?php
namespace Home\Controller;
use Think\Controller;
use Home\Model\DataModel;
use Home\Model\Data;

class JumpController extends Controller {
	public function jump(){
		layout(false);
		$gid = I('id');
		$model = M('goods');
		$find = $model->field('gurl')->find();
		
		if(empty($find)){
			$this->redirect('/Index');
		}
		$pos = strpos($find['gurl'], "=");
		$pos++;
		$pid = substr($find['gurl'], $pos);
		
		$this->assign('pid', $pid);
		$this->assign('gurl', $find['gurl']);
		$this->display();
	}
}