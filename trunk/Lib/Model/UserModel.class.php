<?php
class UserModel extends Model {
	// 自动验证设置
	protected $_validate	 =	 array(
		array('user_name','require','用户名字必须！',1),
		array('email','require','邮箱必须！',1),
		array('email','email','邮箱格式错误！',2),
		array('email','','邮箱已经存在',0,'unique',self::MODEL_INSERT),
		array('user_name','','标题已经存在',0,'unique',self::MODEL_INSERT),
		);
	// 自动填充设置
	protected $_auto	 =  array(

		array('time','time',self::MODEL_INSERT,'function'),
		);

}
?>