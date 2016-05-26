<?php
/**
 * Created by PhpStorm.
 * User: hehuping
 * Date: 2016/5/26
 * Time: 10:54
 */


$code = $_GET['code'];

$url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=wxb096e505f9556191&secret=d4624c36b6795d1d99dcf0547af5443d&code={$code}&grant_type=authorization_code";

$content = file_get_contents($url);

$obj = json_decode($content);

$url = "https://api.weixin.qq.com/sns/userinfo?access_token={$obj->access_token}&openid={$obj->openid}&lang=zh_CN";

$content = file_get_contents($url);

$obj = json_decode($content);

echo "<html>用户昵称：{$obj->nickname}<br>性别：{$obj->sex}<br>省份：{$obj->province}<br><img src='{$obj->headimgurl}' /></html>";

//print_r($content);