<?php

function removeXSS($val)
{
	// 实现了一个单例模式，这个函数调用多次时只有第一次调用时生成了一个对象之后再调用使用的是第一次生成的对象（只生成了一个对象），使性能更好
	static $obj = null;
	if($obj === null)
	{
		require('./HTMLPurifier/HTMLPurifier.includes.php');
		$config = HTMLPurifier_Config::createDefault();
		// 保留a标签上的target属性
		$config->set('HTML.TargetBlank', TRUE);
		$obj = new HTMLPurifier($config);  
	}
	return $obj->purify($val);  
}


function upLoadImg($imgName,$dirname,$thumb = array()){
	//上传图片
	if(isset($_FILES[$imgName]) && $_FILES[$imgName]['error'] === 0)
	{
		 $rootPath = C('IMG_rootPath');
		 $upload = new \Think\Upload(array(
		 	'rootPath'=> $rootPath
		 ));
		 // 实例化上传类    
		 $upload->maxSize   =     (int)C('IMG_maxSize') * 1024 * 1024;   
		 $upload->exts      =     C('IMG_exit');
		 // 设置附件上传目录  
		 $upload->savePath  =     $dirname;    
		 // 上传文件     
		 $info   =   $upload->upload();    

		 if(!$info) {
		 	 // 上传错误提示错误信息
		 	 return array(
		 	 	'ok'=>0,
		 	 	'error'=> $upload->getError()
		 	 	);        
		 }else{
		 	// 上传成功,生成缩略图 
		 	$res['ok'] = 1;
		 	$res['images'][0] = $logoName = $info[$imgName]['savepath'] . $info[$imgName]['savename'];
		 	//判断是否成成缩略体
		 	if($thumb){
		 		//拼接缩略图文件名
		 		foreach ($thumb as $key => $value) {
		 			$res['images'][$key+1] = $info[$imgName]['savepath'] .'sm_'.$key.'_'. $info[$imgName]['savename'];
		 			$image = new \Think\Image(); 
		 			$image->open($rootPath.$logoName);
				 	$image->thumb($value[0], $value[1])->save($rootPath.$res['images'][$key+1]);
		 		}
		 	}
		 	return $res;
		 }
	}
}


function showImg($url,$width='',$height=''){
	$url = '/shop/Uploads/'.$url;
	echo "<img width='$width' height='$height' src='$url' />";
}

function deleteImg($images){
	//先取出图片所在目录
	$rp = C('IMG_rootPath');
	foreach ($images as $key => $value) {
		@unlink($rp . $value);
	}
}	