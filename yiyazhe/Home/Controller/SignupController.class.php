<?php
namespace Home\Controller;
use Think\Controller;
class SignupController extends Controller {
    public function index(){
    	layout(false);
    	$this->display();
    }
    
    public function doSignup(){
    	$arr = array('s'=>0, 'error'=>'');
    	//获取参数
    	$aUsername = I('post.phone');
    	$aPassword = I('post.password');
    	$aVerify = I('post.code');
    	$pattern = "/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i";
    	if(!preg_match($pattern, $aUsername)){
    		$arr['s'] = 3;
    		$arr['error'] = "邮箱格式错误";
    		$arr['code'] = $code;
    		$this->ajaxReturn($arr);
    		die();
    	}
    	if (IS_POST) { //注册用户
    		// 检测验证码 
    		$vemail = md5(md5(md5($aUsername)).md5(md5($aUsername)));
    		$vcode  = md5(md5(md5($aVerify).md5($aVerify)).md5($aVerify));
    		
    		$tovemail = cookie($vemail);
    		//$tovcode = cookie($vemail);
    		
    	 	 if (empty($tovemail) || ($tovemail != $vcode)) {
                 $arr['s'] = 3;
    			$arr['error'] = "姐（哥），邮箱验证码错啦";
    			$arr['code'] = $code;
    			$this->ajaxReturn($arr);
    			die();
             }
    		
             $data = array(
             		'username' => $aUsername,
             		'phone' => $aUsername,
             		'password' => $aPassword,
             );
             $jifenDate = array(
             		'Operation' => "【咿呀折PC端】",
             		'Description' => "新用户注册",
             		'score' => 20
             );
    		// 注册用户 
             $model = D('Yuser');
             $j_model = D('Jifen');
    		if($data2 =  $model->create($data)) { 
    			if($uid=$model->add($data2)){
    				$jifenDate['uid'] = $uid;
    				$j_model->add($jifenDate);
    				$this->ajaxReturn($arr);
    			}
    		} else { //注册失败，显示错误信息
    			$arr['s'] = 3;
    			$arr['error'] = $model->getError();
    			$arr['code'] = $code;
    			$this->ajaxReturn($arr);
    		}
    	} else {
    		$this->error("非法访问",'Index/index');
    	}
    }
    
    //发送验证码邮件
    public function sendVerifyEmail(){
    	if(IS_AJAX){
	    	$email = I('email');
	    	$pattern = "/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i";
	    	$str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
	    	$str = str_shuffle($str);
	    	$code = substr($str, 0, 6);
	    	if(preg_match($pattern, $email)){
	    		if(SendMail($email, '咿呀折用户注册测试', "<h3>欢迎注册咿呀折，在这里你将发现我们的乐趣以及我们的实惠！您的验证码是：<h3><strong>{$code}</strong>请在3分钟内输入验证码。", '')){
	    			$vcode = md5(md5(md5($code).md5($code)).md5($code));
	    			$vemail = md5(md5(md5($email)).md5(md5($email)));
	    			cookie($vemail,$vcode,180);
	    		}
	    	}else{
	    		$this->error('非法邮箱');
	    	}
    	}else{
    		$this->error("非法访问");
    	}
    }
}