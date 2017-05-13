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


}