<?php
namespace Admin\Model;
use Think\Model;
class AdminModel extends Model 
{	

	/**
	 *	表单验证的规则
	 */
	public $_login_validate = array(
		array('username','require','用户名不能为空',1),
		array('password','require','密码不能为空',1),
		array('checkcode','require','验证码不能为空',1),
		array('checkcode','chk_checkcode','验证码不正确',1,'callback'),
		);

	/**
	 *  验证验证码
	 */
	public function chk_checkcode($code){
		$verify = new \Think\Verify();    
		return $verify->check($code);
	}

	/**
	 *  登录方法
	 */
	public function login(){
		//获取用户名和密码
		$username = $this->username;
		$password = $this->password;
		//先查询有没有这个账号
		$user = $this->where(array('username'=>array('eq',$username)))->find();
		if($user){
			//判断是否启用 root无法被禁用
			if($user['id'] == 1 || $user['is_use'] == 1){
				//判断密码
				if($user['password'] == md5($password . C('md5_key'))){
					session('id',$user['id']);
					session('id',$user['username']);
					return true;
				}else{
					$this->error = '密码不正确';
					return false;
				}
			}else{
				$this->error = '账户被禁用';
				return false;
			}
		}else{
			$this->error = '账户不存在';
			return false;
		}
	}
}