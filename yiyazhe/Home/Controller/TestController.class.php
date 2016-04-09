<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/9
 * Time: 18:32
 */
namespace Home\Controller;
use Think\Controller;
class TestController extends Controller {

    public function index(){
        echo "2";
        echo $_SERVER['HTTP_USER_AGENT'];
    }

}