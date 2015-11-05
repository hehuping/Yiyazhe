<?php
	// Yii中截取字符串(UTF-8) 这是从YII上面获取的代码，截取UTF8字符，转译html代码
function truncate_utf8_string($string, $length, $etc = '...') {
	$result = '';
	$string = html_entity_decode ( trim ( strip_tags ( $string ) ), ENT_QUOTES, 'UTF-8' );
	$strlen = strlen ( $string );
	for($i = 0; (($i < $strlen) && ($length > 0)); $i ++) {
		if ($number = strpos ( str_pad ( decbin ( ord ( substr ( $string, $i, 1 ) ) ), 8, '0', STR_PAD_LEFT ), '0' )) {
			if ($length < 1.0) {
				break;
			}
			$result .= substr ( $string, $i, $number );
			$length -= 1.0;
			$i += $number - 1;
		} else {
			$result .= substr ( $string, $i, 1 );
			$length -= 0.5;
		}
	}
	$result = htmlspecialchars ( $result, ENT_QUOTES, 'UTF-8' );
	if ($i < $strlen) {
		$result .= $etc;
	}
	return $result;
}

	// 验证码验证
function check_verify($code, $id = '') {
	$verify = new \Think\Verify ();
	return $verify->check ( $code, $id );
}

/*
 * 判断用户书否登录
 */
function is_login(){
	$has = session('user.uid');
	if(!empty($has)){
		return session('user.uid');
	}else{
		return false;
	}
}

function get_client_ip2($type = 0) {
	$type       =  $type ? 1 : 0;
	static $ip  =   NULL;
	if ($ip !== NULL) return $ip[$type];
	if($_SERVER['HTTP_X_REAL_IP']){//nginx 代理模式下，获取客户端真实IP
		$ip=$_SERVER['HTTP_X_REAL_IP'];
	}elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {//客户端的ip
		$ip     =   $_SERVER['HTTP_CLIENT_IP'];
	}elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {//浏览当前页面的用户计算机的网关
		$arr    =   explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
		$pos    =   array_search('unknown',$arr);
		if(false !== $pos) unset($arr[$pos]);
		$ip     =   trim($arr[0]);
	}elseif (isset($_SERVER['REMOTE_ADDR'])) {
		$ip     =   $_SERVER['REMOTE_ADDR'];//浏览当前页面的用户计算机的ip地址
	}else{
		$ip=$_SERVER['REMOTE_ADDR'];
	}
	// IP地址合法验证
	$long = sprintf("%u",ip2long($ip));
	$ip   = $long ? array($ip, $long) : array('0.0.0.0', 0);
	return $ip[$type];
}

//邮件发送函数
function SendMail($address,$title,$message,$attachment)
{
	import('Org.Net.PHPMailerAutoload');
	$mail=new PHPMailer();
	// 设置PHPMailer使用SMTP服务器发送Email
	$mail->IsSMTP();
	// 设置邮件的字符编码，若不指定，则为'UTF-8'
	$mail->CharSet='UTF-8';
	// 添加收件人地址，可以多次使用来添加多个收件人
	$mail->AddAddress($address);
	// 设置邮件正文
	$mail->Body=$message;
	// 设置邮件头的From字段。
	$mail->From=C('MAIL_ADDRESS');
	// 设置发件人名字
	$mail->FromName='咿呀折';
	// 设置邮件标题
	$mail->Subject=$title;
	// 设置SMTP服务器。
	$mail->Host=C('MAIL_SMTP');
	// 设置为“需要验证”
	$mail->SMTPAuth=true;
	// 设置用户名和密码。
	$mail->Username=C('MAIL_LOGINNAME');
	$mail->Password=C('MAIL_PASSWORD');
	// 发送邮件。
	/*if(is_array($attachment)){ // 添加附件

	foreach ($attachment as $file){

	is_file($file) && $mail->AddAttachment($file);

	}

	}*/
	$mail->AddAttachment($attachment);
	return($mail->Send());
}
/*
 * 过滤首位空格，并且判断字数
 * */
function valideContent($content){
	$content = trim($content);
	$strlen = mb_strlen($content,'utf-8');
	if($strlen>20 || $strlen<3){
		return false;
	}else{
		return true;
	}
}

/**
 * 获取客户端IP地址
 * @param integer $type 返回类型 0 返回IP地址 1 返回IPV4地址数字
 * @return mixed
 
function get_client_ip($type = 0) {
	$type       =  $type ? 1 : 0;
	static $ip  =   NULL;
	if ($ip !== NULL) return $ip[$type];
	if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$arr    =   explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
		$pos    =   array_search('unknown',$arr);
		if(false !== $pos) unset($arr[$pos]);
		$ip     =   trim($arr[0]);
	}elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
		$ip     =   $_SERVER['HTTP_CLIENT_IP'];
	}elseif (isset($_SERVER['REMOTE_ADDR'])) {
		$ip     =   $_SERVER['REMOTE_ADDR'];
	}
	// IP地址合法验证
	$long = sprintf("%u",ip2long($ip));
	$ip   = $long ? array($ip, $long) : array('0.0.0.0', 0);
	return $ip[$type];
}
*/
