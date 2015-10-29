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
		$condition = empty(!$class_id) ? " && class_id in ({$class_id})" : '';
		$p *= $pageSize;
		$goods_model = M('goods');
		$commet_model = M('comment');
		$count = $goods_model->where('status=1 && end_time>"'.date('Y-m-d H:i:s', time()).'"'.$condition)->count();
		
		$Page       = new \Think\Page($count,$pageSize);// 实例化分页类 传入总记录数和每页显示的记录数
		$Page->setConfig('prev', '上一页');
		$Page->setConfig('next', '下一页');
		$show       = $Page->show();// 分页显示输出
		
		$goodsData = $goods_model
					->field('gid,title,class_id,price,oldprice,gurl,
							gimage,shop,delimg,detail,yishou,praise,
							dislike,comment')
					->where('status=1 && end_time>"'.date('Y-m-d H:i:s', time()).'"'.$condition)
					->order('gid desc')
					->limit($p, $pageSize)
					->select();
		foreach ($goodsData as $k=>$v){
			$goodsData[$k]['comments'] = $commet_model->where('gid='.$v['gid'].' && status=1')->select();
		}
		
		return array($goodsData, $show, $count);
	}
	
	public function getStart5(){
		$model = M('goods');
		return $start = $model->where('status=1 && fromwhere="jiukuaiyou" && end_time>"'.date('Y-m-d H:i:s', time()).'"')
						->limit(5)->select();
	}
}