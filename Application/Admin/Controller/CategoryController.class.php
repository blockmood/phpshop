<?php
namespace Admin\Controller;
use \Admin\Controller\IndexController;
class CategoryController extends IndexController 
{
    public function add()
    {
    	if(IS_POST)
    	{
    		$model = D('Admin/Category');
    		if($model->create(I('post.'), 1))
    		{
    			if($id = $model->add())
    			{
    				$this->success('添加成功！', U('lst?p='.I('get.p')));
    				exit;
    			}
    		}
    		$this->error($model->getError());
    	}
		$parentModel = D('Admin/Category');
		$parentData = $parentModel->getTree();
		$this->assign('parentData', $parentData);

		$this->setPageBtn('添加商品分类', '商品分类列表', U('lst?p='.I('get.p')));
		$this->display();
    }
    public function edit()
    {
    	$id = I('get.id');
    	if(IS_POST)
    	{
    		$model = D('Admin/Category');
    		if($model->create(I('post.'), 2))
    		{
    			if($model->save() !== FALSE)
    			{
    				$this->success('修改成功！', U('lst', array('p' => I('get.p', 1))));
    				exit;
    			}
    		}
    		$this->error($model->getError());
    	}
    	$model = M('Category');
    	$data = $model->find($id);
        // echo "<pre>";
        // var_dump($data);
    	$this->assign('data', $data);
		$parentModel = D('Admin/Category');
		$parentData = $parentModel->getTree();
        // echo "<pre>";
        // var_dump($parentData);
		$children = $parentModel->getChildren($id);
        // echo 'chrldren';
        // echo "<pre>";
        // var_dump($children);
		$this->assign(array(
			'parentData' => $parentData,
			'children' => $children,
		));

		$this->setPageBtn('修改商品分类', '商品分类列表', U('lst?p='.I('get.p')));
		$this->display();
    }
    public function delete()
    {
    	$model = D('Admin/Category');
    	if($model->delete(I('get.id', 0)) !== FALSE)
    	{
    		$this->success('删除成功！', U('lst', array('p' => I('get.p', 1))));
    		exit;
    	}
    	else 
    	{
    		$this->error($model->getError());
    	}
    }
    public function lst()
    {
    	$model = D('Admin/Category');
		$data = $model->getTree();
    	$this->assign(array(
    		'data' => $data,
    	));

		$this->setPageBtn('商品分类列表', '添加商品分类', U('add'));
    	$this->display();
    }
}