<?php
class upload_manager
{
	
	public function upload_handler()
	{
		require_once 'database.php';
		$target_dir = "img/products/";
		$target_file = $target_dir . basename($_FILES['pic_filename']['name']);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
		

		//check if is an image
		if (isset($_POST["submit"])) {
			$check = getimagesize($_FILES['pic_filename']['tmp_name']);
			if ($check !== false) {
				echo "El archivo es una imagen - " . $check['mime'] . ".";
				$uploadOk = 1;
			} else {
				echo "El archivo no es una imagen";
				$uploadOk = 0;
			}
		}
		//check format
		if ($imageFileType != "jpg" && $imageFileType != "jpeg") {
			echo "Sólo puedes subir JPG y JPEG";
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
