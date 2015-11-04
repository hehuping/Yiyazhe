<?php
namespace Home\Controller;
use Think\Controller;
class QuestionController extends Controller {
	public function index(){
		if(IS_AJAX){
			$arr = array('s'=>0, 'error'=>'');
			$phone = I('phone');
			$content = I('content');
			$code = I('code');
			if(!check_verify($code)){
				$arr['s'] =1;
				$arr['error'] = "验证码错误";
				$this->ajaxReturn($arr);
				die;
			}
			$data = array(
					'phone'=> $phone,
					'content' => $content,
			);
			$model = D('Question');
			if($cdate = $model->create($data)){
				$model->add($cdate);
				$this->ajaxReturn($arr);
			}else{
				$arr['error'] = $model->getError();
				$arr['s'] = 1;
				$this->ajaxReturn($arr);
			}
			
		}
		 $this->display();
	}
}