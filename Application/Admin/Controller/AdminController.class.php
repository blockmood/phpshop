<?php
namespace Admin\Controller;
use \Admin\Controller\IndexController;
class AdminController extends IndexController 
{
    public function add()
    {
    	if(IS_POST)
    	{
    		$model = D('Admin/Admin');
    		if($model->create(I('post.'), 1))
    		{
    			if($id = $model->add())
    			{
    				$this->success('添加成功！', U('Admin/admin/lst?p='.I('get.p')));
    				exit;
    			}
    		}
    		$this->error($model->getError());
    	}

        //取出所有的角色
        $roleModle = M('Role');
        $roleData = $roleModle->select();
        $this->assign('roleData',$roleData);
		$this->setPageBtn('添加管理员', '管理员列表', U('Admin/admin/lst?p='.I('get.p')));
		$this->display();
    }
    public function edit()
    {   
    	$id = I('get.id');
        //先判断是否有权修改
        $adminId = session('id');
        if($adminId > 1 && $adminId != $id){
            $this->error('无权修改');
        }

    	if(IS_POST)
    	{
    		$model = D('Admin/Admin');
    		if($model->create(I('post.'), 2))
    		{
    			if($model->save() !== FALSE)
    			{
    				$this->success('修改成功！', U('Admin/admin/lst', array('p' => I('get.p', 1))));
    				exit;
    			}
    		}
    		$this->error($model->getError());
    	}
    	$model = M('Admin');
    	$data = $model->find($id);
    	$this->assign('data', $data);
        //取出当前管理员所在的角色ID
        $arModle = M('AdminRole');
        $roleId = $arModle->field('GROUP_CONCAT(role_id) role_id')->where(array('admin_id'=>array('eq',$id)))->find();
        $this->assign('roleId',$roleId['role_id']);
        //取出所有的角色
        $roleModle = M('Role');
        $roleData = $roleModle->select();
        $this->assign('roleData',$roleData);

		$this->setPageBtn('修改管理员', '管理员列表', U('Admin/admin/lst?p='.I('get.p')));
		$this->display();
    }
    public function delete()
    {
    	$model = D('Admin/Admin');
    	if($model->delete(I('get.id', 0)) !== FALSE)
    	{
    		$this->success('删除成功！', U('Admin/admin/lst', array('p' => I('get.p', 1))));
    		exit;
    	}
    	else 
    	{
    		$this->error($model->getError());
    	}
    }
    public function lst()
    {
    	$model = D('Admin/Admin');
    	$data = $model->search();
    	$this->assign(array(
    		'data' => $data['data'],
    		'page' => $data['page'],
    	));

		$this->setPageBtn('管理员列表', '添加管理员', U('Admin/admin/add'));
    	$this->display();
    }

    public function ajaxIsUse(){
        $id = I('get.id');
        if($id == 1){
            echo -2;
            return;
        }
        $model = M('Admin');
        $info = $model->find($id);
        if($info['is_use'] == 1){
           $model->where(array('id'=>array('eq',$id)))->setField('is_use',0);
            echo "0";
        }else{
           $model->where(array('id'=>array('eq',$id)))->setField('is_use',1);
           echo "1";
        }
    }
}