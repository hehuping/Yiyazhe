<?php

namespace Home\Controller;
use Think\Controller;
class UserController extends Controller {
	//初始化，判断登录
	public function _initialize(){
		if(empty($_SESSION['user'])){
			$this->error("过期啦，请重新登录一下下",U('Login/index'),3);
		}
	}
	
	//首页
	public function index(){
		//layout(false);
		$user_model = M('yuser');
		$showPic = '';
		$find = $user_model->field('base64pic,school')->where('uid='.session('user.uid'))->find();
		(!empty($find['base64pic'])) ? $showPic = $find['base64pic'] : $showPic = 'data:image/png;base64,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';

		$this->assign('showPic',$showPic);
		$this->display();
	}
	
	//评论页面
	public function comment(){
	
			$p = I('p');
			empty($p) ? $p=1 : $p=I('p');
			$comment = array();
			$page = '';
			$model = D('Comment');
			list($comment, $page) = $model->getUserComment(session('user.uid'), $p-1);

			$this->assign('page', $page);
			$this->assign('comment', $comment);
			$this->display('comment');
	}
	
	public function test(){
		$str =  base64_decode('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');
	   file_put_contents("1.png",$str);
	}
	
	public function toecho(){
		print_r($_SESSION);
	}
	
	public function doChange(){
		
		$name = I('name');
		$type = I('type');
		
		if(IS_POST){
		
		switch ($type) {
			case 1:
				$data = array('username'=>$name,'uid'=>session('user.uid'));
				$this->updataDate($data);
				break;
			case 3:
				$data = array('qq'=>$name,'uid'=>session('user.uid'));
				$this->updataDate($data);
				break;
			case 4:
				$data = array('sex'=>$name,'uid'=>session('user.uid'));
				$this->updataDate($data);
				break;
			case 5:
				$data = array('age'=>$name,'uid'=>session('user.uid'));
				$this->updataDate($data);
				break;
			case 6:
				$data = array('school'=>$name,'uid'=>session('user.uid'));
				$this->updataDate($data);
				break;
			
			default:
				;
			break;
			}
		}else{
			$this->error('非法访问');
		}
		
	}
	
	//入库函数
	private function updataDate($data){
		$arr = array('s'=>0,'error'=>'');
		$user_model = M('yuser');
		if($user_model->save($data)){
			$find = $user_model->field('uid,username,figureurl,base64pic,school,qq,age,phone,sex')->where('uid='.session('user.uid'))->find();
			session('user',$find);	
			$this->ajaxReturn($arr);
		}else{
			$arr['s']=1;
			$arr['error']="数据错误";
			$this->ajaxReturn($arr);
		}
	}
	
	public function doCode(){
		$arr = array('s'=>0,'error'=>'');
		
		$user_model = M('yuser');
		$phone = I('phone');
		$code = I('code');
		
		$data = array(
				'phone'=>$phone,
				'uid'=>session('user.uid'),
		);
		
		if($code !== session('Code')){
			$arr['s']=1;
			$arr['error']='验证码敲错喽';
			$this->ajaxReturn($arr);
		}else if(!$user_model->save($data)){
			$arr['s']=2;
			$arr['error']='数据错误';
			$this->ajaxReturn($arr);
		}else{
			$find = $user_model->field('uid,username,figureurl,base64pic,school,qq,age,phone,sex')->where('uid='.session('user.uid'))->find();
			session('user',$find);
			$this->ajaxReturn($arr);
		}
	}
	
	public function doChangePic(){
		$arr = array('s'=>0, 'error'=>'');
		$user_model = M('yuser');
		$image = I('image');
		
		$data = array('base64pic'=>$image,'uid'=>session('user.uid'));
		
		if($user_model->save($data)){
			$this->ajaxReturn($arr);
		}else{
			$arr['s'] = 1;
			$arr['error'] = '数据错误';
			$this->ajaxReturn($arr);
		}	
	}
	/*
	 * 用户自我评论删除
	 * */
	public function delComment(){
		$data = array('s'=>1, 'error'=>'参数错误');
		if(IS_POST){
			$cid = I('id');
			empty($cid) ? $this->ajaxReturn($data) : $cid;
			
			$model = M('comment');
			if($model->where('cid='.$cid)->delete()){
				$data['s'] = 0;
				$data['error'] = ""; 
				$this->ajaxReturn($data);
			}else{
				$data['s'] = 2;
				$data['error'] = "数据错误";
				$this->ajaxReturn($data);
			}
		}else{
			$this->error('非法访问');
		}
	}
	
	/*
	 * 积分页面
	 * */
	public function beans(){
		
		$p = I('p');
		empty($p) ? $p=1 : $p=I('p');
		$jifen = array();
		$page = '';
		$model = D('Jifen');
		list($jifen, $page) = $model->getUserBeans(session('user.uid'), $p-1, 0);
		
		$this->assign('page', $page);
		$this->assign('jifen', $jifen);
		$this->assign('type',0);
		$this->display('beans');
	}
	
	/*
	 * 积分消耗页面
	 * */
	
	public function beansDown(){
	
		$p = I('p');
		empty($p) ? $p=1 : $p=I('p');
		$jifen = array();
		$page = '';
		$model = D('Jifen');
		list($jifen, $page) = $model->getUserBeans(session('user.uid'), $p-1, 1);
		$type = 1;
		$this->assign('page', $page);
		$this->assign('jifen', $jifen);
		$this->assign('type',$type);
		$this->display('beans');
	}
	
	/*
	 * 邀请好友注册
	 * */
	public function my_rank(){
		
	}
	
	/*
	 *收藏 
	 */
	public function favorate(){
		$model = D('Favorate');
		$list = $model->getUserFavorate(session('user.uid'));
		$this->assign('favorate',$list);
		$this->display();
	}
	
}