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
		$find = $user_model->field('userpic,school,age,sex,qq,cellphone,username')->where('uid='.session('user.uid'))->find();
		
		$picName = $find['userpic'];
		$picInfo = pathinfo($picName);
		$find['smallPic'] = $picInfo['filename'].'150.'.$picInfo['extension'];
		$find['smallPic2'] = $picInfo['filename'].'70.'.$picInfo['extension'];
		
		
		$this->assign('showPic',$showPic);
		$this->assign('info', $find);
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
				session('user',$find);	
				$this->ajaxReturn($arr);
			}else{
				$arr['s']=1;
				$arr['error']="数据错误s";
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
	/*
	 * 删除收藏
	 * */
	/*
	 * 用户自我评论删除
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
	
 public function showRegError($code = 0)
    {
    	switch ($code) {
    		 case -1:
                $error = '昵称长度必须在3-8个字符以内！';
                break;
            case -20:
                $error = '昵称不能包含空格！';
                break;
            case -2:
                $error = '用户名被禁止注册！';
                break;
            case -3:
                $error = '用户名被占用！';
                break;
            case -4:
                $error = '密码长度必须在6-30个字符之间！';
                break;
            case -41:
                $error = '用户旧密码不正确';
                break;
            case -5:
                $error = '邮箱格式不正确！';
                break;
            case -6:
                $error = '邮箱长度必须在1-32个字符之间！';
                break;
            case -7:
                $error = '邮箱被禁止注册！';
                break;
            case -8:
                $error = '邮箱被占用！';
                break;
            case -9:
                $error = '手机格式不正确！';
                break;
            case -10:
                $error = '手机被禁止注册！';
                break;
            case -11:
                $error = '手机号被占用！';
                break;
            case -12:
                $error = '用户名必须以中文或字母开始，只能包含拼音数字，字母，汉字！';
                break;
            case -31:
                $error = '昵称禁止注册';
                break;
            case -33:
                $error = '昵称长度不合法';
                break;
            case -32:
                $error = '昵称不合法';
                break;
            case -30:
                $error = '昵称已被占用';
                break;
            case -50:
                $error = '验证码错误';
                break;
            case -51:
                $error = '验证码长度不合法';
                break;
            case -52:
                $error = '长度不合法';
                break;

            default:
                $error = '未知错误';
    	}
    	return $error;
    }
	
}