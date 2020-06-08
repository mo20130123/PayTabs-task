<?php
// defined('BASEPATH') OR exit('No direct script access allowed');


class CategoryController extends CI_Controller {

	function __construct() {
          parent::__construct();
			 $this->load->model('CategoryModel');
          $this->output->set_header('Access-Control-Allow-Origin: *');
   }


	/*
	* get parents Categories
	* Categories where parent_id = null
	*/
	public function get_super_Categories()
	{
		 // return  json_encode($this->CategoryModel->super_Categories());
	 	echo json_encode([
			 [
				'level' => 1,
			  	'cats' => $this->CategoryModel->super_Categories()
			]
		]);
		return;
	}

	public function get_Category_subs($cat_id)
	{
		 // return $this->CategoryModel->super_Category_subs($cat_id);
	 	print_r(json_encode($this->CategoryModel->super_Category_subs($cat_id)));
		return;
	}
}
