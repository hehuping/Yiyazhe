<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2015 http://www.yiyazhe.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: hehuping  <http://www.yiyazhe.com>
// +----------------------------------------------------------------------
namespace Home\Model;

use Think\Model;

/**
 * 
 */
class IndexModel extends Model
{
	protected $tableName = 'goods';
	public function getIndexGoods($p, $class_id,$pageSize=50){
		$condition = !empty($class_id) ? " && class_id in ({$class_id})" : '';
		$p *= $pageSize;
		if($class_id == ''){
			$p+=5;
		}
		
		$goods_model = M('goods');
		$commet_model = M('comment');
		$count = $goods_model->where('status=1 && end_time>"'.date('Y-m-d H:i:s', time()).'" && star_time<"'.date('Y-m-d H:i:s', time()).'"'.$condition)->count();
		
		$Page       = new \Think\Page($count,$pageSize);// 实例化分页类 传入总记录数和每页显示的记录数
		$Page->setConfig('prev', '上一页');
		$Page->setConfig('next', '下一页');
		$show       = $Page->show();// 分页显示输出
		
		$goodsData = $goods_model
					->field('gid,title,cate,price,oldprice,gurl,
							gimage,shop,delimg,detail,yishou,praise,
							dislike,comment,star_time')
					->where('status=1 && end_time>"'.date('Y-m-d H:i:s', time()).'" && star_time<"'.date('Y-m-d H:i:s', time()).'"'.$condition)
					->order('gid desc')
					->limit($p, $pageSize)
					->select();
		foreach ($goodsData as $k=>$v){
			$goodsData[$k]['comments'] = $commet_model->where('gid='.$v['gid'].' && status=1')->select();
			$goodsData[$k]['jumpurl'] = "http://www.yiyazhe.com/Jump/jump?id={$v['gid']}&from=app";
			$goodsData[$k]['commenturl'] = "http://www.yiyazhe.com/Puser/getComnetByid?id={$v['gid']}";
		}
		
		return array($goodsData, $show, $count);
	}
	
	public function getStart5(){
		$model = M('goods');
		return $start = $model->where('status=1 && fromwhere="jiukuaiyou" && end_time>"'.date('Y-m-d H:i:s', time()).'"')
						->limit(0,5)
						->order('gid desc')
						->select();
	}
	
	public function getIndexGoods2($p, $class_id,$pageSize=50){
		$condition = !empty($class_id) ? " && class_id in ({$class_id})" : '';
		$now = $p;
		$p *= $pageSize;
		$p+=5;
		$goods_model = M('goods');
		$commet_model = M('comment');
		$count = $goods_model->where('status=1 && end_time>"'.date('Y-m-d H:i:s', time()).'" && star_time<"'.date('Y-m-d H:i:s', time()).'"'.$condition)->count();
	
		$Page       = new \Think\Page($count,$pageSize);// 实例化分页类 传入总记录数和每页显示的记录数
		$Page->setConfig('prev', '上一页');
		$Page->setConfig('next', '下一页');
		$show       = $Page->show();// 分页显示输出
		
		$cate_model = M('cate');
		$cate = $cate_model->where('id not in(8,187)')->select();
		/*if($now != 0){
			shuffle($cate);
		}*/
		$alldate=array();
		if($p<300){
			foreach ($cate as $v){
				//print_r($alldate);
				$goodsData = $goods_model
				->field('gid,title,cate,price,oldprice,gurl,
						gimage,shop,delimg,detail,yishou,praise,
						dislike,comment,star_time')
							->where('status=1 && class_id='.$v['id'].' && end_time>"'.date('Y-m-d H:i:s', time()).'" && star_time<"'.date('Y-m-d H:i:s', time()).'"')
							->order('gid desc')
							->limit(($now*10), 10)
							->select();
				foreach ($goodsData as $k=>$v){
					$goodsData[$k]['comments'] = $commet_model->where('gid='.$v['gid'].' && status=1')->select();
				}
				$alldate = array_merge($alldate, $goodsData);
			}
		}else{
			$goodsData = $goods_model
			->field('gid,title,cate,price,oldprice,gurl,
							gimage,shop,delimg,detail,yishou,praise,
							dislike,comment,star_time')
							->where('status=1 && end_time>"'.date('Y-m-d H:i:s', time()).'" && star_time<"'.date('Y-m-d H:i:s', time()).'"')
							->order('gid desc')
							->limit($p, $pageSize)
							->select();
			foreach ($goodsData as $k=>$v){
				$goodsData[$k]['comments'] = $commet_model->where('gid='.$v['gid'].' && status=1')->select();
			}
			$alldate = $goodsData;
		}
		return array($alldate, $show, $count);
	}
}