<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CategoryModel extends CI_Model
{

 // protected $db =null;

function __construct() {
	// $this->db = \Config\Database::connect();
}
	function super_Categories()
	{
		// $this->db->select('name');
		$this->db->where('parent_id',null);
		$records = $this->db->get('categories');
		return $records->result_array();
	}

	function super_Category_subs($selected_cat_id)
	{
			$selected_cat = $this->db->query("SELECT * FROM `categories` WHERE id = $selected_cat_id")->row() ;
			$parent_id = $selected_cat->parent_id;

			$levelCats_array = [];

			if(!$parent_id) // if first select
			{
				array_push($levelCats_array,[
						'level' => 0,
						'cats' => $this->db->query("SELECT * FROM `categories` WHERE parent_id IS NULL")->result_array()
				]);

					$cat = $this->db->query("SELECT * FROM `categories` WHERE parent_id = ".$selected_cat->id)->result_array();
			   if($cat)
					array_push($levelCats_array,[
							'level' => 1,
							'cats' => $cat
					]);

				return $levelCats_array;
			}

			$start_cat_id =  $selected_cat_id;

			while (true)
			{
				$record = $this->db->query("SELECT * FROM `categories` WHERE id = $start_cat_id")->row();

				//----Start push
				   $cats = $this->db->query("SELECT * FROM `categories` WHERE parent_id = ".$record->id)->result_array();
					if($cats)
						array_push($levelCats_array,[
								'level' => $record->id,
								'cats' => $cats
						]);
				//-----End push
				 if($record->parent_id == null){
					  break;
				 }
				 else {
				 	$start_cat_id = $record->parent_id;
				 }
			}

			// reverse the array
			$levelCats_array = array_reverse($levelCats_array);

			// add the super cats(main cats)
			array_unshift($levelCats_array,[
					'level' => '0',
					'cats' => $this->db->query("SELECT * FROM `categories` WHERE parent_id IS NULL")->result_array()
			]);
			return $levelCats_array;
	}



}
