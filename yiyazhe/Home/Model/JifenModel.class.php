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
 * 积分模型
 */
class JifenModel extends Model{
	protected $tableName = 'jifen';
	
	/*
	 * 分页获取用户积分记录
	 * 
	 * $uid:用户ID $p:分页 $type:0->明细  1->减分
	 * */
	public function getUserBeans($uid, $p, $type){
		
		$p *= 10;
		$jifen =  array();
		$model = M('jifen');
		$count = $model->where("uid={$uid} && status=0 && type={$type}")->count();
		$jifen = $model->where("uid={$uid} && status=0 && type={$type}")->limit($p,10)->order('addtime desc')->select();
		$sum = $model->where("uid={$uid} && status=0 && type={$type}")->sum("score");
		
		$Page       = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数
		$Page->setConfig('prev', '上一页');
		$Page->setConfig('next', '下一页');
		$show       = $Page->show();// 分页显示输出
		
		
		return array($jifen,$show,$sum);
	}

}