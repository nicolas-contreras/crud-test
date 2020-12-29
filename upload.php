<?php
class upload_manager
{
	public function upload_handler()
	{
		require_once 'worker.php';
		$target_dir = "img/products/";
		$target_file = $target_dir . basename($_FILES['pic_filename']['name']);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
		

		//check if is an image
		if (isset($_REQUEST['action'])) {
			$file_name = $_FILES["photo"]["name"];
			$check = getimagesize($_FILES['pic_filename']['tmp_name']);
			if ($check !== false) {
				echo "El archivo es una imagen - " . $check['mime'] . ".";
				$uploadOk = 1;
			} else {
				echo "El archivo no es una imagen";
				$uploadOk = 0;
			}
			//check format
		if ($imageFileType != "jpg" && $imageFileType != "jpeg") {
			echo "Sólo puedes subir JPG y JPEG";
			$uploadOk = 0;
		}
		if (file_exists($target_file)) {
			echo "Sorry, file already exists.";
			$uploadOk = 0;
		}

		//check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			echo "No ha sido posible subir tu archivo.";
		//check if its possible to upload file
		} else {
			if (move_uploaded_file($_FILES['pic_filename']['tmp_name'], $target_file)) {
				echo "El archivo " . htmlspecialchars(basename($_FILES['pic_filename']['name'])) . " ha sido subido.";
			} else {
				echo "Ha ocurrido un error subiendo la imagen";
			}
		}
		}
		
		
	}
}