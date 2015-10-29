<?php

namespace Home\Controller;

use Think\Controller;
use Org\Util\Date;

class LoginController extends Controller {
	
	public function index(){
		layout(false);
		$this->display();
	}
	
	public function doLogin(){
		session_start();
		$arr = array('s'=>0,'error'=>'');
		$username = I('username');
		$password=md5(I('password'));
		$code = I('code');
		$user_model = M('yuser');
		$find = $user_model->field('uid,username,figureurl,base64pic,school,qq,age,phone,sex')->where('phone="'.$username.'" && password="'.$password.'"')->find();
		 
		if(!check_verify($code)){
			$arr['s']=1;
			$arr['error']='验证码敲错喽';
			$this->ajaxReturn($arr);
		}else if(empty($find)){
			$arr['s']=2;
			$arr['error']='用户名或者密码错误';
			$this->ajaxReturn($arr);
		}else{
			$_SESSION['user'] = $find;
			$data =array( 'lastlogin' => date('Y-m-d H:i:s',time()), 'uid'=>session('user.uid'));
			$user_model->save($data);
			$this->ajaxReturn($arr);
		}
		 
	}
	
	public function qqlogin() {
		define ( 'M_ROOT', dirname ( dirname ( __FILE__ ) ) );
		// echo M_ROOT;
		$ss = M_ROOT;
		$str = str_replace ( "\\", "/", $ss );
		
		include_once ($str . "/API/qq/qqConnectAPI.php");
		
		$qc = new \QC ();
		$qc->qq_login ();
		$state = I ( 'state' );
		$_SESSION ['state'] = $state;
	}
	public function qq_sucsess() {
		session_start ();
		
		define ( 'M_ROOT', dirname ( dirname ( __FILE__ ) ) );
		$ss = M_ROOT;
		$str = str_replace ( "\\", "/", $ss );
		include_once ($str . "/API/qq/qqConnectAPI.php");
		$qc = new \QC ();
		
		$atid = $qc->qq_callback ();
		$opid = $qc->get_openid ();
		$opid = ( string ) $opid;
		$state = I ( 'state' );
		$_SESSION ['state'] = $state;
		$qc = new \QC ( $atid, $opid ); // 重新带参地new一次否则会丢失信息
		$user_model = M ( 'yuser' );
		$find = $user_model->field ( 'uid,nickname,figureurl' )->where ( ' openid=' . '"' . $opid . '"' )->find ();
		if (empty ( $find ))
			$info = $qc->__call ( 'get_user_info' );
		
		if (! empty ( $info )) {
			$data = array (
					'nickname' => $info ['nickname'],
					'sex' => $info ['gender'],
					'province' => $info ['province'],
					'city' => $info ['city'],
					'year' => $info ['year'],
					'figureurl' => $info ['figureurl_qq_2'],
					'openid' => $opid,
					'tokenid' => $atid,
					'addtime' => date ( 'Y-m-d H:i:s' ),
					'loginip' => get_client_ip(),
					'status' => 1 
			);
			
			if ($id = $user_model->add ( $data )) {
				$user = $user_model->field ( 'uid,nickname,figureurl' )->where ( 'uid=' . $id )->select ();
				$_SESSION ['user'] = $user;
				$this->redirect ( '/Index', '登录成功，正在跳转到首页', 0 );
			}
		} else {
			$data =array( 'lastlogin' => date('Y-m-d H:i:s',time()), 'uid'=>session('user.uid'));
			$user_model->save($data);
			$_SESSION ['user'] = $find;
			$this->redirect ( '/Index', '登录成功，正在跳转到首页', 0 );
		}
	}
	
	public function getVerify(){
		$config =    array(
				'fontSize'    =>    30,    // 验证码字体大小
				'length'      =>    4,     // 验证码位数
				'useNoise'    =>    false, // 关闭验证码杂点
		);
		$Verify =     new \Think\Verify($config);
		// 开启验证码背景图片功能 随机使用 ThinkPHP/Library/Think/Verify/bgs 目录下面的图片
		$Verify->useImgBg = true;
		$Verify->entry();
	}
	
	public function loginOut(){
		session('user','null');
		$this->redirect('index');
	}
}