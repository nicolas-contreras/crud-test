<?php
class data_management{
	
	private $id;
	private $name;
	private $category;
	private $cost_price;
	private $unit_price;
	private $pic_filename;
	
	public function __GET($k){
		return $this->$k; 
	}
    public function __SET($k, $v){
		return $this->$k = $v;
	}
}
?>