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
	
	/* 用户模型自动验证 */
	protected $_validate = array(
			/* 验证用户名
			 array('username', '4,32', -1, self::EXISTS_VALIDATE, 'length'), //用户名长度不合法
	array('username', 'checkDenyMember', -2, self::EXISTS_VALIDATE, 'callback'), //用户名禁止注册
	array('username', 'checkUsername', -20, self::EXISTS_VALIDATE, 'callback'),
	array('username', '', -3, self::EXISTS_VALIDATE, 'unique'), //用户名被占用
	*/
	
	/* 验证密码 */
	array('password', '0,30', -4, self::EXISTS_VALIDATE, 'length'), //密码长度不合法
	
			/* 验证验证码*/
			//array('verify_code', '6', -51, self::EXISTS_VALIDATE, 'length'), //验证码长度不合法
			//array('verify_code', 'check_verify',-50, self::EXISTS_VALIDATE, 'function'), //验证码错误
	
			/* 验证邮箱
			array('email', 'email', -5, self::EXISTS_VALIDATE), //邮箱格式不正确
			array('email', '4,32', -6, self::EXISTS_VALIDATE, 'length'), //邮箱长度不合法
			 array('email', 'checkDenyEmail', -7, self::EXISTS_VALIDATE, 'callback'), //邮箱禁止注册
			array('email', '', -8, self::EXISTS_VALIDATE, 'unique'), //邮箱被占用
			*/
	
			/* 验证手机号码 */
			array('phone', '/^(1[3|4|5|8])[0-9]{9}$/', -9, self::EXISTS_VALIDATE), //手机格式不正确 TODO:
			array('phone', 'checkDenyMobile', -10, self::EXISTS_VALIDATE, 'callback'), //手机禁止注册
			array('phone', '', -11, self::EXISTS_VALIDATE, 'unique'), //手机号被占用
			);
	
			/* 用户模型自动完成 */
			protected $_auto = array(
			array('password', 'md5code', self::MODEL_BOTH, 'callback'),
					//array('addtime', NOW_TIME, self::MODEL_INSERT),
					array('loginip', 'get_client_ip', self::MODEL_INSERT, 'function'),
					// array('update_time', NOW_TIME),
					//array('status', 'getStatus', self::MODEL_BOTH, 'callback'),
    );

}