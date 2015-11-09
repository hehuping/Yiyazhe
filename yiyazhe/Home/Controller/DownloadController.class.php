<?php
namespace Home\Controller;
use Think\Controller;
use Home\Model\Data;
class DownloadController extends Controller {
    public function index(){
    	layout(false);
    	$this->display();
    }
}