<?php 
class catController{
	private $name;
	private $catCode;
	private $catField;


	public function __construct(){
		$dbnew = new dbConnect( 'categories' );
		$catList = $dbnew->getall();
		foreach($catList as $catRec){
		    $id[] = $catRec['cat_id'];
    		$name[] = $catRec['cat_name'];
    		$code[] = $catRec['code_cat'];
    		$field[] = $catRec['cat_field'];
		}
		$this->name = array_combine($id,$name);
	}
	public function get_name(){
		return $this->name;
	}
	public function get_code(){
		return $this->catCode;
	}
	public function get_field(){
		return $this->catField;
	}
	}

 ?>