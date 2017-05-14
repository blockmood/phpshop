<?php

namespace Admin\Controller;
use Think\Controller;
class GoodsController extends IndexController {
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
        $this->setPageBtn('添加新商品','商品列表',U('lst'));
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


        $this->setPageBtn('商品列表','添加新商品',U('add'));
        $this->display();
	}

    public function delete(){
        $model = D('Goods');
        $model->delete(I('get.id'));
        $this->success('删除成功',U('lst?p='.I('get.p')));
    }

    public function edit(){

        //处理修改表单代码
        if(IS_POST)
        {
            $model = D('Goods');
            if($model->create(I('post.'),2))
            {   
                //默认不修改返回0也为失败
                if(FALSE !== $model->save())
                {   
                    $this->success('修改成功',U('lst?p='.I('get.p')));
                    exit;
                }
            }
            $this->error($model->getError());
        }


        $id = I('get.id');
        $model = D('Goods');
        $info = $model->find($id);
        $this->assign('info',$info);
        $this->setPageBtn('修改商品','商品列表',U('lst'));
        $this->display();
    }
}