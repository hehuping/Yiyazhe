<?php
namespace Home\Controller;
use Think\Controller;
class SignupController extends Controller {
    public function index(){
    	$this->display();
    }
    
    public function doSignups(){
    	$arr = array('s'=>0, 'error'=>'');
    	$phone = I('post.phone');
    	$code = I('post.code');
    	$password = I('post.password');
    	
    	$data = array(
    			'phone'=>$phone,
    			'password'=>md5($password),
    	);
    	
    	$user_model = M('yuser');
    	$have = $user_model->where('phone='.$phone)->find();   	
    	if($code != session('Code')){
    		$arr['s'] = 3;
    		$arr['error'] = "姐（哥），手机上的验证码敲错啦";
    		$arr['code'] = $code;
    		$this->ajaxReturn($arr);
    	}else if(!empty($have)){
    		$arr['s'] = 1;
    		$arr['error'] = "姐（哥），这个手机已注册过了";
    	    $this->ajaxReturn($arr);
    	}else{
    		if($uid = $user_model->add($data)){
    			$find = $user_model->field('uid,username,figureurl,base64pic,school,qq,age,phone,sex')->where('uid='.$uid)->find();
    			session('user',$find);
    			$this->ajaxReturn($arr);
    		}else{
    			$arr['s'] = 2;
    			$arr['error'] = "姐（哥），我们服务器出问题了，sorry";
    			$this->ajaxReturn($arr);
    			
    		}
    	}
    	
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
    	//$aNickname = I('post.nickname', '', 'op_t');
    	$aPassword = I('post.password');
    	$aVerify = I('post.code');
    
    	if (IS_POST) { //注册用户
    		/* 检测验证码 */
    	 	 if ($aVerify != session('Code')) {
                 $arr['s'] = 3;
    			$arr['error'] = "姐（哥），手机上的验证码敲错啦";
    			$arr['code'] = $code;
    			$this->ajaxReturn($arr);
             }
    		
    		/* 注册用户 */
             $model = D('Yuser');
    		$uid = $model->register($aUsername, $aPassword, $aVerify, $aUnType);
    		if (0 < $uid) { //注册成功
    			$this->ajaxReturn($arr);
    		} else { //注册失败，显示错误信息
    			$arr['s'] = 3;
    			$arr['error'] = $this->showRegError($uid);
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