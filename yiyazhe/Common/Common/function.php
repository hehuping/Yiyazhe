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