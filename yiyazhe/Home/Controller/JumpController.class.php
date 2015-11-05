<?php
namespace Home\Controller;
use Think\Controller;
use Home\Model\DataModel;
use Home\Model\Data;
use Org\Util\Date;

class JumpController extends Controller {
	public function jump(){
		layout(false);
		$gid = I('id');
		$model = M('goods');
		$find = $model->field ( 'gurl' )->where ( 'gid=' . $gid )->find ();
		
		if(empty($find)){
			$this->redirect('/Index');
		}
		$c_model = M('userclick');
		$c_find = $c_model->field('uid')->where('gid='.$gid)->find();
		if(empty($c_find)){
			$data = array(
					'gid' => $gid,
					'count' =>1,
					'endtime' => date('Y-m-d H:i:s'),
			);
			$c_model->add($data);
		}else {
			$c_model->where('gid='.$gid)->setInc('count',1);
			
		}
		
		$pos = strpos($find['gurl'], "=");
		$pos++;
		$pid = substr($find['gurl'], $pos);
		
		$this->assign('pid', $pid);
		$this->assign('gurl', $find['gurl']);
		$this->display();
	}
}