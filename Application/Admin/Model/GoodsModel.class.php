<?php
namespace Admin\Model;
use Think\Model;
class GoodsModel extends Model 
{	

	//在调用create时允许接收的字段
	protected $insertFields = array('goods_name','price','goods_desc','is_on_sale');

	// 定义表单验证的规则，控制器中的create方法时用
	protected $_validate = array(
		array('goods_name', 'require', '商品名称不能为空！', 1),
		array('goods_name', '1,45', '商品名称必须是1-45个字符', 1, 'length'),
		array('price', 'currency', '价格必须是货币格式', 1),
		array('is_on_sale', '0,1', '是否上架只能是0,1两个值', 1, 'in'),
	);
	// TP在调用add方法之前会自动调用这个方法，我们可以把在插入数据库之前要执行的代码写到这里
	// 第一个参数：就是表单中的数据（要插入到数据库中的数据）是一个一维数组
	// 第二个参数：额外信息，：当前模型对应的实际的表名是什么
	// 说明：在这个函数中要改变这个函数外部的$data，需要按钮引用传递，否则修改也无效
	// 说明：如果return false是指控制器中的add方法返回了false
	protected function _before_insert(&$data, $option)
	{
		// 获取当前时间
		$data['addtime'] = time();

		//上传图片
		if($_FILES['logo']['error'] == 0)
		{
			 $rootPath = C('IMG_rootPath');
			 $upload = new \Think\Upload(array(
			 	'rootPath'=> $rootPath
			 ));// 实例化上传类    
			 $upload->maxSize   =     (int)C('IMG_maxSize') * 1024 * 1024;   
			 $upload->exts      =     C('IMG_exit');
			 //$upload->rootPath  =  	  $rootPath;    
			 $upload->savePath  =     'Goods/'; 
			 // 设置附件上传目录    

			 // 上传文件     
			 $info   =   $upload->upload();    

			 if(!$info) {
			 	 // 上传错误提示错误信息        
			 	 $this->error = $upload->getError();
			 	 return false;    
			 }else{
			 	// 上传成功,生成缩略图        
			 	$image = new \Think\Image(); 

			 	//原图文件名
			 	$logoName = $info['logo']['savepath'] . $info['logo']['savename'];
			 	//拼接缩略图文件名
			 	$smallName = $info['logo']['savepath'] .'sm_'. $info['logo']['savename'];
			 	$image->open($rootPath.$logoName);
			 	$image->thumb(150, 150)->save($rootPath.$smallName);

			 	//把图片路径放到表单中，存入数据库
			 	$data['logo'] = $logoName;
			 	$data['sm_logo'] = $smallName;
			 }
		}
	}

	public function search()
	{	
		//总的记录数
		$count = $this->count();
		//生成分页参数
		$Page = new \Think\Page($count,2);
		//获取分页字符串
		$show = $Page->show();
		//取出当前页的数据
		$data = $this->limit($Page->firstRow.','.$Page->listRows)->select();
	
		return array(
			'page' => $show,
			'data' => $data
			);
	
	}
}