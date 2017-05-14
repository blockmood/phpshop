<?php

namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {

	public function __construct(){
		parent::__construct();		
		if(!session('id')){
			redirect(U('Admin/Login/login'));
		}
	}

	public function index(){
		$this->display();
	}

	public function menu(){
		$this->display();
	}

	public function top(){
		$this->display();
	}

	public function main(){
		$this->display();
	}

	public function setPageBtn($title, $btnName, $btnLink)
	{
		$this->assign('_page_title', $title);
		$this->assign('_page_btn_name', $btnName);
		$this->assign('_page_btn_link', $btnLink);
	}


}