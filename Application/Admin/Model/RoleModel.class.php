<?php
namespace Admin\Model;
use Think\Model;
class RoleModel extends Model 
{
	protected $insertFields = array('role_name');
	protected $updateFields = array('id','role_name');
	protected $_validate = array(
		array('role_name', 'require', '角色名称不能为空！', 1, 'regex', 3),
		array('role_name', '1,30', '角色名称的值最长不能超过 30 个字符！', 1, 'length', 3),
	);
	public function search($pageSize = 20)
	{
		/**************************************** 搜索 ****************************************/
		$where = array();
		/************************************* 翻页 ****************************************/
		$count = $this->alias('a')->where($where)->count();
		$page = new \Think\Page($count, $pageSize);
		// 配置翻页的样式
		$page->setConfig('prev', '上一页');
		$page->setConfig('next', '下一页');
		$data['page'] = $page->show();
		/************************************** 取数据 ******************************************/
		$data['data'] = $this->field('a.*,GROUP_CONCAT(c.pri_name) pri_name')->alias('a')->join('left join php34_role_privilege b on a.id = b.role_id left join php34_privilege c on b.pri_id = c.id')->where($where)->group('a.id')->limit($page->firstRow.','.$page->listRows)->select();
		return $data;
	}
	// 添加前
	protected function _before_insert(&$data, $option)
	{
	}
	//添加后
	protected function _after_insert(&$data, $option)
	{	
		//把权限存入权限表
		$priId = I('post.pri_id');
		if($priId){
			$rpModel = M('RolePrivilege');
			foreach ($priId as $k => $v) {
				$rpModel->add(array(
					'pri_id'  => $v,
					'role_id' => $data['id']
					));
			}
		}
	}
	// 修改前
	protected function _before_update(&$data, $option)
	{	
		//先清除原来的权限
		$rpModel = M('RolePrivilege');
		$rpModel->where(array('role_id'=>array('eq',$option['where']['id'])))->delete();
		//把权限存入权限表
		$priId = I('post.pri_id');
		if($priId){
			$rpModel = M('RolePrivilege');
			foreach ($priId as $k => $v) {
				$rpModel->add(array(
					'pri_id'  => $v,
					'role_id' => $option['where']['id']
					));
			}
		}
	}
	// 删除前
	protected function _before_delete($option)
	{
		//判断有没有管理员属于这个角色
		$arModel = M('AdminRole');
		$has = $arModel->where(array('role_id'=>array('eq',$option['where']['id'])))->count();
		if($has > 0){
			$this->error = '有管理员属于这个角色,不允许删除';
			return false;
		}

		//把这个角色所拥有的权限的ID也一起删除
		$roModel = M('RolePrivilege');
		$roModel->where(array('role_id'=>array('eq',$option['where']['id'])))->delete();
	}
	/************************************ 其他方法 ********************************************/
}