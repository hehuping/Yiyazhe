<?php
namespace Home\Controller;
use Think\Controller;
use Home\Model\Data;
use Org\Util\Date;
class PuserController extends Controller {
	
	public function getComnetByid(){
		$gid = I('id');
		$c_model = M('comment');
		$data = $c_model->where("gid={$gid}")->select();
		$re = $arr["data"] = $data;
		$obj = new Data();
		$obj->status = 0;
		$obj->data = $re;
		$this->ajaxReturn($obj);
	}
	
	public function getComment(){
		$p = I('p');
		$uid = I('uid');
		empty($p) ? $p=1 : $p=I('p');
		$comment = array();
		$model = D('Comment');
		list($comment, $page) = $model->getUserComment($uid, $p-1);
		
		$obj = new Data();
		$obj->status = 0;
		$obj->data = $comment;
		$obj->page = $p;
		$obj->barnner = array(
				//'http://www.yiyazhe.com/Public/images/index/cateboys.png',
		);
		 
		$this->ajaxReturn($obj);
	}
	
	public function doComment(){
		$arr = array('s'=>0,'error'=>'');
		$gid = I('post.gid');
		$uid = I('post.uid');
		$content = I('post.content');
		$username = I('post.username');
		
		$obj = new Data();
		if(!valideContent($content)){
			$obj->status = -1;
			$obj->error = "评论字数不能小于3大于20";
			$this->ajaxReturn($obj);
			die();
		}
		$comment_model = M('comment');
		$goods_model = M('goods');
		$has = $comment_model->where('gid='.$gid.' && uid='.$uid)->find();
	
		if($has){
			$obj->status = -2;
			$obj->error = "一件商品只能评论一次哦";
			$this->ajaxReturn($obj);
			die();
		}
	
		if(IS_POST){
				
			$data = array(
					'uid' => $uid,
					'gid' => $gid,
					'content' => I('content'),
					'username' => $username,
			);
			if($comment_model->add($data)){
				$goods_model->where('gid='.$gid)->setInc('comment',1);
				$this->ajaxReturn($obj);
			}else{
				$arr['s'] = -3;
				$arr['error'] = 'Sorry 数据错误';
				$this->ajaxReturn($obj);
			}
		}else{
			$this->error('非法访问！');
		}
	}
	
	/*
	 * 积分页面
	 * */
	public function getbeans(){

		$p = I('p');
		$uid = I('uid');
		empty($p) ? $p=1 : $p=I('p');
		$jifen = array();
		$page = '';
		$model = D('Jifen');
		list($jifen, $page, $sum) = $model->getUserBeans($uid, $p-1, 0);
	

		$obj = new Data();
		$obj->status = 0;
		$obj->data = $jifen;
		$obj->page = $p;
		$obj->totle = $sum;
			
		$this->ajaxReturn($obj);
	}
	
	/*
	 *收藏
	 */
	public function doFavorate(){
		$gid = I('gid');
		if(IS_POST){
			$uid = I('uid');
			$arr = array('s'=>0, 'error'=>'');
			$model = M('favorate');
			$has = $model->where("uid={$uid} && gid={$gid}")->find();
			if(!empty($has)){
				cookie("fav{$gid}",rand(10000,1000000),24*60*60*5);
				$arr['s'] = 1;
				$arr['error'] = "已经收藏过了，请到用户中心查看";
				$this->ajaxReturn($arr);
				die();
			}
			$data = array(
					'gid' => $gid,
					'uid' => $uid,
			);
			if($model->add($data)){
				cookie("fav{$gid}",rand(10000,1000000),24*60*60*5);
				$this->ajaxReturn($arr);
			}else{
				$arr['s'] = 1;
				$arr['error'] = "数据错误";
				$this->ajaxReturn($arr);
			}
		}else{
			$this->error("非法访问");
		}
	}
	
	/*
	 *获取收藏
	 */
	public function getFavorate(){
		
		$uid = I('uid');
		$model = D('Favorate');
		$list = $model->getUserFavorate($uid);
		
		$obj = new Data();
		$obj->status = 0;
		$obj->data = $list;
		$this->ajaxReturn($obj);
	}
	
	/*
	 * 用户收藏删除
	 * */
	public function delFavorate(){
		$data = array('s'=>0, 'error'=>'');
		if(IS_POST){
			$fid = I('id');
			empty($fid) ? $this->error("参数错误") : $fid;
	
			$model = M('favorate');
			if($model->where('fid='.$fid)->delete()){
				$data['s'] = 0;
				$data['error'] = "";
				$this->ajaxReturn($data);
			}else{
				$data['s'] = 2;
				$data['error'] = "数据错误";
				$this->ajaxReturn($data);
			}
		}else{
			$this->error('非法访问');
		}
	}
	
	/*
	 * 今日上新
	 * */
	public function getToday(){
		$p = I('p');
		empty($p) ? $p=1 : $p=I('p');
		$model = D('Goods');
		$date = date('Y-m-d',time()).' 10:00:00';
		$condition = " && star_time = '{$date}'";
		$order = "addtime asc,";
		list($goodsData, $show, $count) = $model->getgoods($p, 20, $condition, $order);
		
		$obj = new Data();
		$obj->status = 0;
		$obj->data = $goodsData;
		$obj->page = $p;
		$obj->count = $count;
			
		$this->ajaxReturn($obj);
	}
	
	/*
	 * 昨日上新
	 * */
	public function getYesterday(){
		$p = I('p');
		empty($p) ? $p=1 : $p=I('p');
		$model = D('Goods');
		$date = date('Y-m-d',time()-(3600*24)).' 10:00:00';
		$condition = " && star_time = '{$date}'";
		list($goodsData, $show, $count) = $model->getgoods($p, 20, $condition);
	
		$obj = new Data();
		$obj->status = 0;
		$obj->data = $goodsData;
		$obj->page = $p;
		$obj->count = $count;
			
		$this->ajaxReturn($obj);
	}
	
	/*
	 * 九块九
	 * */
	public function getJiukuaijiu(){
		$p = I('p');
		empty($p) ? $p=1 : $p=I('p');
		$model = D('Goods');
		$condition = " && price<10";
		list($goodsData, $show, $count) = $model->getgoods($p, 20, $condition);
	
		$obj = new Data();
		$obj->status = 0;
		$obj->data = $goodsData;
		$obj->page = $p;
		$obj->count = $count;
			
		$this->ajaxReturn($obj);
	}
	
	/*
	 * top100
	 * */
	public function getTop100(){
		$model = D('Goods');
		$order = "yishou desc,";
		list($goodsData, $show, $count) = $model->getgoods($p, 100, $condition,$order);
		
		$obj = new Data();
		$obj->status = 0;
		$obj->data = $goodsData;
		$obj->count = $count;
			
		$this->ajaxReturn($obj);
	}
	
	public function getInfo(){
		$uid= I('uid');
		$b_model = M('jifen');
		$u_model = M('yuser');
		$q_model = 	M('qiandao');
		
		$date = date('Y-m-d',time());
		$qiandao = $q_model->where("date='{$data}' && uid=".$uid)->find();
		empty($qiandao) ? $qd = 0 : $qd = 1;
		$beans = $b_model->where("uid={$uid}")->sum('score');
		$userInfo = $u_model->field('username,userpic')->where("uid={$uid}")->find();
		
		$data = array(
				'beans' => $beans,
				'username' => $userInfo['username'],
				'userpic' => "http://www.yiyazhe.com/uploads/".$userInfo['userpic'],
				'qiandao' => $qd,
		);
		print_r($date);
		//$this->ajaxReturn($data);
	}
	
	//用户签到
	public function qiandao(){
		$arr = array('s'=>1, 'error'=>'');
		if(IS_POST){
			$uid = I('uid');
			$date = date('Y-m-d',time());
			$data = array(
					'uid' => $uid,
					'date' => $date,
			);
			$data2 = array(
					'uid' => $uid,
					'Operation' => '【咿呀折手机端】',
					'Description' => '签到',
					'score' => 10
			);
			$q_model = M('qiandao');
			$j_model = M('jifen');
			$last = $q_model->where("uid={$uid}")->order('qid desc')->find();
			if(empty($last)){
				$j_model->add($data2);
				$q_model->add($data);
				$this->ajaxReturn($arr);
			}else{
				if($last['date'] != $date){
					$j_model->add($data2);
					$q_model->add($data);
					$this->ajaxReturn($arr);
				}else{
					$arr['s'] =0;
					$arr['error'] = "数据库错误";
					$this->ajaxReturn($arr);
				}
			}
		}else{
			$this->error('非法访问');
		}
	}
	
}