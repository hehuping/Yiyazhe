<?php
// +----------------------------------------------------------------------
// | YIYAZHE [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2015 http://www.yiyazhe.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: hehuping
// +----------------------------------------------------------------------
namespace Home\Model;

use Think\Model;

/**
 * 评论模型
 */
class GoodsModel extends Model{
	protected $tableName = 'goods';
	
	
	public function getGoods($p,$pageSize=50, $condition='', $order){
		$p *= $pageSize;
	
		$goods_model = M('goods');
		$commet_model = M('comment');
		$count = $goods_model->where('status=1 && end_time>"'.date('Y-m-d H:i:s', time()).'"'.$condition)->count();
	
		$Page       = new \Think\Page($count,$pageSize);// 实例化分页类 传入总记录数和每页显示的记录数
		$Page->setConfig('prev', '上一页');
		$Page->setConfig('next', '下一页');
		$show       = $Page->show();// 分页显示输出
	
		$goodsData = $goods_model
		->field('gid,title,cate,price,oldprice,gurl,
							gimage,shop,delimg,detail,yishou,praise,
							dislike,comment,star_time')
								->where('status=1 && end_time>"'.date('Y-m-d H:i:s', time()).'"'.$condition)
								->order($order.'gid desc')
								->limit($p, $pageSize)
								->select();
		foreach ($goodsData as $k=>$v){
			$goodsData[$k]['comments'] = $commet_model->where('gid='.$v['gid'].' && status=1')->select();
			$goodsData[$k]['jumpurl'] = "http://www.yiyazhe.com/Jump/jump?id={$v['gid']}&from=app";
			$goodsData[$k]['commenturl'] = "http://www.yiyazhe.com/Puser/getComnetByid?id={$v['gid']}";
		}
	
		return array($goodsData, $show, $count);
	}

}