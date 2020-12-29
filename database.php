<?php
class handle_info{
	private $pdo;
	
	public function __CONSTRUCT(){
		try{
			$this->pdo = new PDO('mysql:host=localhost;dbname=wbpg','root','');
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch(Exception $e){
			die($e->getMessage());
		}
	}
	
	public function list_data(){
		try{
			$result = array();
			$dbdata = $this->pdo->prepare("SELECT * FROM epico_items");
			$dbdata->execute();
			
			foreach($dbdata->fetchAll(PDO::FETCH_OBJ) as $r){
				$item = new data_management();
				
				$item->__set('id', $r->id);
				$item->__set('name', $r->name);
				$item->__set('category', $r->category);
				$item->__set('cost_price', $r->cost_price);
				$item->__set('unit_price', $r->unit_price);
				$item->__set('pic_filename', $r->pic_filename);
				
				$result[]=$item;
			}
		return $result;
	}
	catch(Exception $e){
		die($e->getMessage());
	}
	}
	
	public function get_data($id){
		try{
			$dbdata = $this->pdo->prepare("SELECT * FROM epico_items WHERE id = ?");
			$dbdata->execute(array($id));
			$r = $dbdata->fetch(PDO::FETCH_OBJ);
			
			$item = new data_management();
			$item->__set('id', $r->id);
			$item->__set('name', $r->name);
			$item->__set('category', $r->category);
			$item->__set('cost_price', $r->cost_price);
			$item->__set('unit_price', $r->unit_price);
			$item->__set('pic_filename', $r->pic_filename);
			
			return $item;
		}
		catch(Exception $e){
			die($e->getMessage());
		}
	}
	
	public function delete_data($id){
		try{
			$dbdata = $this->pdo->prepare("DELETE FROM epico_items WHERE id = ?");
			$dbdata->execute(array($id));			
		}
		catch(Exception $e){
			die($e->getMessage());
		}
	}
	
	public function update_data(data_management $data){
		try{
			$sql = "UPDATE epico_items SET 
					name = ?, category = ?, cost_price = ?, unit_price = ?, pic_filename = ?
				    WHERE id = ?";

			$this->pdo->prepare($sql)
			->execute(
			array(
				$data->__GET('name'), 
				$data->__GET('category'), 
				$data->__GET('cost_price'),
				$data->__GET('unit_price'),
				$data->__GET('pic_filename'),
				$data->__GET('id')
				)
			);
		} 
		catch(Exception $e){
			die($e->getMessage());
		}
	}
	
/*	public function update_data(data_management $data){
		try{
			$sql = "UPDATE epico_items 
					SET	name=?, category=?, cost_price= ?, unit_price=?
					WHERE id = ?";
					
			$this->pdo->prepare($sql)
			->execute(
			array(
				$data->__GET('name'),
				$data->__GET('category'),
				$data->__GET('cost_price'),
				$data->__GET('unit_price'),
				$data->__GET('id')
				)
			);
		}
		catch(Exception $e){
			die($e->getMessage());
		}
	}
	*/
	
	public function add_data(data_management $data){
		try{
			$sql ="INSERT INTO epico_items 
					(name,
					 category,
					 cost_price,
					 unit_price,
					 pic_filename)
				 VALUES (?,?,?,?,?)";
			
			$this->pdo->prepare($sql)->execute(array(
			$data->__get('name'),
			$data->__get('category'),
			$data->__get('cost_price'),
			$data->__get('unit_price'),
			$data->__get('pic_filename')
			
			));
			
		}
		catch(Exception $e){
			die($e->getMessage());
		} 
	}
	public function check_category(){
		try{
			
			
		}
		catch(Exception $e){
			die($e->getMessage());
		} 
	}

}


?>