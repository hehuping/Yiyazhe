<?php
/**
 * Created by PhpStorm.
 * User: hehuping
 * Date: 2016/5/24
 * Time: 15:38
 */

function post($url, $post_data = '', $timeout = 5){//curl

    $ch = curl_init();

    curl_setopt ($ch, CURLOPT_URL, $url);

    curl_setopt ($ch, CURLOPT_POST, 1);

    if($post_data != ''){

        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);

    }

    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);

    curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

    curl_setopt($ch, CURLOPT_HEADER, false);

    $file_contents = curl_exec($ch);

    curl_close($ch);

    return $file_contents;

}

function getaccss(){
    $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wxb096e505f9556191&secret=d4624c36b6795d1d99dcf0547af5443d";
    $content = file_get_contents($url);

    $obj = json_decode($content);
    return $obj->access_token;
}





$data = array(

);

$mune = '{
     "button":[
     {
          "type":"click",
          "name":"今日头条",
          "key":"V1001_TODAY_MUSIC"
      },
      {
           "name":"哈哈",
           "sub_button":[
           {
               "type":"view",
               "name":"最新折扣",
               "url":"https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxb096e505f9556191&redirect_uri=http://www.yiyazhe.com/wtest.php&scope=snsapi_userinfo&response_type=code&state=hehuping#wechat_redirect"
            },
            {
               "type":"view",
               "name":"咿呀折",
               "url":"http://www.juanpi.com/"
            },
            {
               "type":"click",
               "name":"赞一下我们",
               "key":"V1001_GOOD"
            }]
       }]
 }';

$token = getaccss();

$url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=$token";


print_r(post($url,$mune));




