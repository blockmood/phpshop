<?php

namespace Admin\Controller;
use Think\Controller;
class GoodsController extends Controller {
    public function add(){
    	//处理表单
    	if(IS_POST){
    		$model = D('Goods');
    		if($model->create()){
    			if($model->add()){
    				$this->success('操作成功',U('lst'));
    				exit;
    			}
    		}
    		//如果失败，获取失败的原因
    		$error =  $model->getError();
    		//显示错误信息
    		$this->error($error);
    	}
    	//显示表单
		$this->display();
	}

	public function lst(){
		echo 'lst';
	}
}