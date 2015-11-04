<?php 
namespace Home\Model;
use Think\Model;

/**
 * 反馈模型
 */
class QuestionModel extends Model
{
	 protected $tableName = 'question';
	 
	 protected $_validate = array(
	 		/* 验证手机号 */
	 		array('phone', '/^(1[3|4|5|8])[0-9]{9}$/', "手机号格式不正确", 0),
	 		array('content', '1,1000', "内容长度必须在1-1000之间", 0, 'length'), //长度不合法
		);
	 protected $_auto = array(
	 		array('ip', 'get_client_ip', self::MODEL_INSERT, 'function'),	
	 );
	
}