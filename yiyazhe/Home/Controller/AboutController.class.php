<?php
namespace Home\Controller;
use Think\Controller;
use Home\Model\Data;
class AboutController extends Controller {
	public function index(){
		$pageInfo = array(
				'title' => "关于我们-咿呀折",
				'keywords' => "关于咿呀折，关于青年折扣，关于校园折扣，关于学生折扣",
				'description' => "关于咿呀折的详细资料",
				'cate' => 2,
		);
		$this->assign('pageInfo',$pageInfo);
		$this->display('about');
	}
}