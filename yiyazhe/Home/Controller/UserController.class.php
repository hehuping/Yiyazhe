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
		
		$pageInfo = array(
				'title' => "基本资料修改-用户中心",
				'keywords' => "咿呀折,用户资料,资料修改",
				'description' => "咿呀折校园折扣网用户中心资料修改。【咿呀折-校园折扣】",
		);
		
		
		$user_model = D('yuser');
		$showPic = '';
		$find = $user_model->field('userpic,school,age,sex,qq,cellphone,username')->where('uid='.session('user.uid'))->find();
		
		$picName = $find['userpic'];
		$picInfo = pathinfo($picName);
		$find['smallPic'] = $picInfo['filename'].'150.'.$picInfo['extension'];
		$find['smallPic2'] = $picInfo['filename'].'70.'.$picInfo['extension'];
		
		
		$this->assign('pageInfo',$pageInfo);
		$this->assign('showPic',$showPic);
		$this->assign('info', $find);
		$this->display();
	}
	
	//评论页面
	public function comment(){
		
		$pageInfo = array(
				'title' => "我的评论-用户中心",
				'keywords' => "咿呀折,用户评论,评论管理",
				'description' => "咿呀折校园折扣网用户中心评论管理。【咿呀折-校园折扣】",
		);
		
	
			$p = I('p');
			empty($p) ? $p=1 : $p=I('p');
			$comment = array();
			$page = '';
			$model = D('Comment');
			list($comment, $page) = $model->getUserComment(session('user.uid'), $p-1);
			
			$this->assign('pageInfo',$pageInfo);
			$this->assign('page', $page);
			$this->assign('comment', $comment);
			$this->display('comment');
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
			case 2:
				$data = array('cellphone'=>$name,'uid'=>session('user.uid'));
				$this->updataDate($data);
				break;
			case 4:
				$data = array('sex'=>$name,'uid'=>session('user.uid'));
				$this->updataDate($data);
				break;
			case 5:
				$name = abs($name);
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
		$user_model = D('yuser');
		if($user_model->create($data,4)){
			if($user_model->save($data)){
				$find = $user_model->field('uid,username,figureurl,userpic')->where('uid='.session('user.uid'))->find();
				$picName = $find['userpic'];
				$picInfo = pathinfo($picName);
				$find['userpic'] = $picInfo['filename'].'70.'.$picInfo['extension'];
				$qiandao = $user_model->getQiandao($find['uid']);
				$find['qiandao'] = $qiandao;
				session('user',$find);	
				$this->ajaxReturn($arr);
			}else{
				$arr['s']=1;
				$arr['error']="重复或者数据错误";
				$this->ajaxReturn($arr);
			}
		}else{
			$arr['s'] = 3;
			$arr['error'] = $user_model->getError();
			$arr['code'] = $code;
			$this->ajaxReturn($arr);
		}
	}
	
	public function doCode(){
		$arr = array('s'=>0,'error'=>'');
		
		$user_model = M('yuser');
		$phone = I('phone');
		
		$data = array(
				'cellphone'=>$phone,
				'uid'=>session('user.uid'),
		);
		
		$this->updataDate($data);
		
		/*if(!$user_model->save($data)){
			$arr['s']=2;
			$arr['error']='数据错误';
			$this->ajaxReturn($arr);
		}else{
			$find = $user_model->field('uid,username,figureurl,userpic')->where('uid='.session('user.uid'))->find();
			session('user',$find);
			$this->ajaxReturn($arr);
		}*/
	}
	
	public function doChangePic(){
		$arr = array('s'=>0, 'error'=>'');
		$user_model = M('yuser');
		$image = I('image');
		
		$data = array('userpic'=>$image,'uid'=>session('user.uid'));
		
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
		
		$pageInfo = array(
				'title' => "积分明细-用户中心",
				'keywords' => "咿呀折,用户积分,积分管理",
				'description' => "咿呀折校园折扣网用户中心积分管理。【咿呀折-校园折扣】",
		);
		
		$p = I('p');
		empty($p) ? $p=1 : $p=I('p');
		$jifen = array();
		$page = '';
		$model = D('Jifen');
		list($jifen, $page) = $model->getUserBeans(session('user.uid'), $p-1, 0);
		
		$this->assign('pageInfo',$pageInfo);
		$this->assign('page', $page);
		$this->assign('jifen', $jifen);
		$this->assign('type',0);
		$this->display('beans');
	}
	
	/*
	 * 积分消耗页面
	 * */
	
	public function beansDown(){
	
		$pageInfo = array(
				'title' => "我的积分-用户中心",
				'keywords' => "咿呀折,用户积分,积分管理",
				'description' => "咿呀折校园折扣网用户中心积分管理。【咿呀折-校园折扣】",
		);
		
		
		$p = I('p');
		empty($p) ? $p=1 : $p=I('p');
		$jifen = array();
		$page = '';
		$model = D('Jifen');
		list($jifen, $page) = $model->getUserBeans(session('user.uid'), $p-1, 1);
		$type = 1;
		$this->assign('pageInfo',$pageInfo);
		$this->assign('page', $page);
		$this->assign('jifen', $jifen);
		$this->assign('type',$type);
		$this->display('beans');
	}
	
	
	/*
	 *收藏 
	 */
	public function favorate(){
		
		$pageInfo = array(
				'title' => "我的收藏-用户中心",
				'keywords' => "咿呀折,用户收藏,收藏管理",
				'description' => "咿呀折校园折扣网用户中心收藏管理。【咿呀折-校园折扣】",
		);
		
		
		$model = D('Favorate');
		$list = $model->getUserFavorate(session('user.uid'));
		
		$this->assign('pageInfo', $pageInfo);
		$this->assign('favorate',$list);
		$this->display();
	}

	/*
	 * 用户收藏删除
	 * */
	public function delFavorate(){
		$data = array('s'=>0, 'error'=>'');
		if(IS_POST){
			$fid = I('id');
			empty($fid) ? $this->ajaxReturn($data) : $fid;
				
			$model = M('favorate');
			if($model->where('fid='.$fid)->delete()){
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
	
	//用户签到
	public function qiandao(){
		$arr = array('s'=>0, 'error'=>'');
		if(IS_AJAX){
			$uid = is_login();
			$date = date('Y-m-d',time());
			$data = array(
					'uid' => $uid,
					'date' => $date,
			);
			$data2 = array(
					'uid' => $uid,
					'Operation' => '【咿呀折PC端】',
					'Description' => '签到',
					'score' => 10
			);
			$q_model = M('qiandao');
			$j_model = M('jifen');
			$last = $q_model->where("uid={$uid}")->order('qid desc')->find();
			if(empty($last)){
				$_SESSION['user']['qiandao'] = 1;
				$j_model->add($data2);
				$q_model->add($data);
				$this->ajaxReturn($arr);
			}else{
				if($last['date'] != $date){
					$_SESSION['user']['qiandao'] = 1;
					$j_model->add($data2);
					$q_model->add($data);
					$this->ajaxReturn($arr);
				}else{
					//$_SESSION['user']['qiandao'] = 1;
					$arr['s'] =1;
					$this->ajaxReturn($arr);
				}
			}
		}else{
			$this->error('非法访问');
		}
	}
	public function toecho(){
		print_r($_SESSION);
	}
	
	public function uploadify(){
		$targetFolder = '/tempdir'; // Relative to the root
		
		$verifyToken = md5('unique_salt' . $_POST['timestamp']);
		
		if (!empty($_FILES) && $_POST['token'] == $verifyToken) {
			$tempFile = $_FILES['Filedata']['tmp_name'];
			$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
			$targetFile = rtrim($targetPath,'/') . '/' . $_FILES['Filedata']['name'];
		
			// Validate the file type
			$fileTypes = array('jpg','jpeg','gif','png'); // File extensions
			$fileParts = pathinfo($_FILES['Filedata']['name']);
		
			if (in_array($fileParts['extension'],$fileTypes)) {
				move_uploaded_file($tempFile,iconv("UTF-8","gb2312", $targetFile));
				$this->saveImage($targetFile);
			} else {
				echo 'Invalid file type.';
			}
		}
	}
	
	public function saveImage($Filename){
		
		$info = pathinfo($Filename);
		$imageName = time().rand(1,10000);
		$imagePath = '/uploads';
		$targetPath = $_SERVER['DOCUMENT_ROOT'] . $imagePath;
		$targetFile = rtrim($targetPath,'/') . '/' . $imageName.'.'.$info['extension'];
		//rename($Filename, $targetFile);
		rename(iconv('UTF-8','GBK',$Filename), iconv('UTF-8','GBK',$targetFile));
		
		$thumb1 = rtrim($targetPath,'/') . '/' . $imageName.'150.'.$info['extension'];
		$thumb2 = rtrim($targetPath,'/') . '/' . $imageName.'70.'.$info['extension'];
		$image = new \Think\Image();
		$image->open($targetFile);
		// 生成一个居中裁剪为150*150的缩略图并保存为thumb.jpg
		$image->thumb(150, 150,\Think\Image::IMAGE_THUMB_CENTER)->save($thumb1);
		$image->thumb(70, 70,\Think\Image::IMAGE_THUMB_CENTER)->save($thumb2);
		
		$model = M('yuser');
		$data['userpic'] = $imageName.'.'.$info['extension'];
		$data['uid'] = is_login();
		if($model->save($data)){
			session('user.userpic',$imageName.'70.'.$info['extension']);
			echo $imageName.'.'.$info['extension'];
		}
		
	}
	
}