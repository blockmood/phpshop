<?php
namespace Admin\Model;
use Think\Model;
class GoodsModel extends Model 
{	

	//在调用create时允许接收的字段
	protected $insertFields = array('goods_name','price','goods_desc','is_on_sale');
	protected $updatetFields = array('id','goods_name','price','goods_desc','is_on_sale');

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
		$res = upLoadImg('logo','Goods',array(
			array(50,50),
			));
		if($res['ok'] == 1){
			$data['logo'] = $res['images'][0];
			$data['sm_logo'] = $res['images'][1];
		}else{
			$this->error = $res['error'];
			return false;
		}
		
	}

	public function search()
	{	
		/******** 搜索 ********/
		$where = array();
		//商品名称搜索
		$goods_name= I('get.goods_name');
		if($goods_name){
			$where['goods_name'] = array('like',"%$goods_name%");
		}
		//商品价格的搜索
		$start_price = I('get.start_price');
		$end_price = I('get.end_price');
		if($start_price && $end_price){
			$where['price'] = array('between',array($start_price,$end_price));
		}elseif($start_price){
			$where['price'] = array('egt',$start_price);
		}elseif($end_price){
			$where['price'] = array('elt',$end_price);
		}
		//排序方式
		$orderby = 'id';  //默认排序字段
		$orderway = 'asc'; //默认排序方式
		$orderByArray = array('id_asc','id_desc','price_asc','price_desc');
		$order = I('get.order');
		if($order && in_array($order,$orderByArray)){
			if($order == 'id_asc'){
			}
			if($order == 'id_desc'){
				$orderway = 'desc';
			}
			if($order == 'price_asc'){
				$orderby = 'price';
			}
			if($order == 'price_desc'){
				$orderby = 'price';
				$orderway = 'desc';
			}
		}
		//时间搜索
		$start_addtime = I('get.start_addtime');
		$end_addtime = I('get.end_addtime');
		if($start_addtime && $end_addtime){
			$where['addtime'] = array('between',array(strtotime("$start_addtime 00:00:01"),strtotime("$end_addtime 23:59:59")));
		}elseif($start_addtime){
			$where['addtime'] = array('egt',strtotime("$start_addtime 00:00:01"));
		}elseif($end_addtime){
			$where['addtime'] = array('elt',strtotime("$end_addtime 23:59:59"));
		}

		//是否上架的搜索
		$isOnSale = I('get.is_on_sale',-1);
		if($isOnSale != -1){
			$where['is_on_sale'] = array('eq',$isOnSale);
		}
		//是否删除的搜索
		$isDelete = I('get.is_delete',-1);
		if($isDelete != -1){
			$where['is_delete'] = array('eq',$isDelete);
		}


		/************ 翻页 *************/
		// 总的记录数
		$count = $this->where($where)->count();
		// 生成翻页对象
		$page = new \Think\Page($count, 2);
		$page->setConfig('next','下一页');
		$page->setConfig('prev','上一页');
		// 获取翻页字符串
		$show = $page->show();
		// 取出当前页的数据
		$data = $this->where($where)->limit($page->firstRow.','.$page->listRows)->order("$orderby $orderway")->select();
		
		// echo $this->getlastsql();
		
		return array(
			'page' => $show,
			'data' => $data,
		);
	
	}


	protected function _before_delete($option){
		$logo = $this->field('logo,sm_logo')->find($option['where']['id']);
		//从配置文件中取出图片所在目录
		$rp = C('IMG_rootPath');
		//删除图片
		unlink($rp . $logo['logo']);
		unlink($rp . $logo['sm_logo']);
	}

	protected function _before_update(&$data,$option){
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

			 	//删除商品的原图
			 	$logo = $this->field('logo,sm_logo')->find($option['where']['id']);
				deleteImg($logo);
			 }
		}
	}
}