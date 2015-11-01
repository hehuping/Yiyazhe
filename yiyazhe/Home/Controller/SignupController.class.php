<?php
namespace Home\Controller;
use Think\Controller;
class SignupController extends Controller {
    public function index(){
    	layout(false);
    	$this->display();
    }
    
  
    /**
     * register  注册页面
     * @author:hehuping
     */
    public function doSignup()
    {
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
    		/* 检测验证码 */
    		$vemail = md5(md5(md5($aUsername)).md5(md5($aUsername)));
    		$vcode  = md5(md5(md5($aVerify).md5($aVerify)).md5($aVerify));
    			
    	 	 if (empty(cookie($vemail)) || cookie($vemail) != $vcode) {
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
    		/* 注册用户 */
             $model = D('Yuser');
    		
    		if($data2 =  $model->create($data)) { 
    			if($model->add($data2)){
    				$this->ajaxReturn($arr);
    			}
    		} else { //注册失败，显示错误信息
    			$arr['s'] = 3;
    			$arr['error'] = $model->getError();
    			$arr['code'] = $code;
    			$this->ajaxReturn($arr);
    			//$this->error($this->showRegError($uid));
    		}
    	} else { //显示注册表单
    		$this->error("非法访问",'Index/index');
    	}
    }
    
    public function getValidCode(){
    	$str = '0123456789';
    	$shuffled  =  str_shuffle( $str );
    	$code = substr($shuffled, 0, 6);
    	session('Code',$code);
    }
    
    public function getCode(){
    	echo session('Code');
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
    

    /**
     * 获取用户注册错误信息
     * @param  integer $code 错误编码
     * @return string        错误信息
     */
    public function showRegError($code = 0)
    {
    	switch ($code) {
    		case -1:
    			$error = '用户名长度必须在4-32个字符以内！';
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
    		case -5:
    			$error = '邮箱格式不正确！';
    			break;
    		case -6:
    			$error = '邮箱长度必须在4-32个字符之间！';
    			break;
    		case -7:
    			$error = '邮箱被禁止注册！';
    			break;
    		case -8:
    			$error = '邮箱被占用！请直接登录';
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
    		case -20:
    			$error = '用户名只能由数字、字母和"_"组成！';
    			break;
    		case -30:
    			$error = '昵称被占用！';
    			break;
    		case -31:
    			$error = '昵称被禁止注册！';
    			break;
    		case -32:
    			$error = '昵称只能由数字、字母、汉字和"_"组成！';
    			break;
    		case -33:
    			$error = '昵称不能少于四个字！';
    			break;
    		case -50:
    			$error = '验证码错误';
    			break;
    		case -51:
    			$error = '验证码长度不合法';
    			break;
    		default:
    			$error = '未知错误24';
    	}
    	return $error;
    }
    
}