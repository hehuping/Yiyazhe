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
class FavorateModel extends Model{
	protected $tableName = 'favorate';
	
	public function getUserFavorate($uid){
		$model = M('favorate');
		return $model->field('goods.gimage, goods.title, goods.price, goods.oldprice, goods.gurl')
				->join('goods on favorate.gid=goods.gid')
				->where('favorate.uid='.$uid)
				->select();
	}
}