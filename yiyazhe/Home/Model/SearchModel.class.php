<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.yiyazhe.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: hehuping
// +----------------------------------------------------------------------
namespace Home\Model;

use Think\Model;

/**
 * 搜索模型
 */
class SearchModel extends Model{
	
	protected $tableName = 'goods';
	
	public function getSearchGoods($p, $keywords,$pageSize=50){
		$p *= $pageSize;
		$goods_model = M('goods');
		$commet_model = M('comment');
		$count = $goods_model->where('title like "%'.$keywords.'%" && status=1 && end_time>"'.date('Y-m-d H:i:s', time()).'"')->count();
	
		$Page       = new \Think\Page($count,$pageSize);// 实例化分页类 传入总记录数和每页显示的记录数
		$Page->setConfig('prev', '上一页');
		$Page->setConfig('next', '下一页');
		$show       = $Page->show();// 分页显示输出
	
		$goodsData = $goods_model
		->field('gid,title,class_id,price,oldprice,gurl,
							gimage,shop,delimg,detail,yishou,praise,
							dislike,comment')
								->where('title like "%'.$keywords.'%" && status=1 && end_time>"'.date('Y-m-d H:i:s', time()).'"')
								->order('gid desc')
								->limit($p, $pageSize)
								->select();
		foreach ($goodsData as $k=>$v){
			$goodsData[$k]['comments'] = $commet_model->where('gid='.$v['gid'].' && status=1')->select();
		}
	
		return array($goodsData, $show, $count);
	}
}