<?php

namespace Admin\Controller;
use Think\Controller;
class GoodsController extends Controller {
    public function add(){
    	//处理表单
    	if(IS_POST){
    		$model = D('Goods');
    		if($model->create(I('post.'),1)){
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
        $model = D('Goods');
        //获取带翻页的数据
        $data = $model->search();

		$this->assign(array(
            //数据
            'data' => $data['data'],
            //分页
            'page' => $data['page'],
            ));
        $this->display();
	}
}