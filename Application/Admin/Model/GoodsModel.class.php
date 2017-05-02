<?php
namespace Admin\Model;
use Think\Model;
class GoodsModel extends Model 
{
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
	}
}