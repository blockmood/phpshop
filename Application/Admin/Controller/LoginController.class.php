<?php

namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {


	public function login(){

		if(IS_POST){
			$model = D('Admin');
			if($model->validate($model->_login_validate)->create()){
				if(TRUE === $model->login()){
					$this->success('登录成功',U('Index/index'),TRUE);
				}
			}
			$this->error($model->getError(),TRUE);
		}
		$this->display();
	}

	/**
	 * 生成验证码
	 */

	public function checkcode(){
		$Verify = new \Think\Verify(array(
			 'length'      =>    2,     // 验证码位数
			 'useNoise'    =>    false, // 关闭验证码杂点
			 'fontSize'    =>    20,    // 验证码字体大小
			));
		$Verify->entry();
	}

}