<?php
require_once 'database.php';
require_once 'worker.php';
require_once 'upload.php';

$item = new data_management();
$model = new handle_info();
$upload = new upload_handler();
if(isset($_REQUEST['action']))
{
    switch($_REQUEST['action'])
    {
        case 'update':
			$item->__SET('id', $_REQUEST['id']);
			$item->__SET('name', $_REQUEST['name']);
			$item->__SET('category', $_REQUEST['category']);
			$item->__SET('cost_price', $_REQUEST['cost_price']);
			$item->__SET('unit_price', $_REQUEST['unit_price']);
			$item->__SET('pic_filename',$_REQUEST[$file]);
			$result = $db->query("SELECT image FROM epico_items ORDER BY id DESC"); 
			$model->update_data($item);
			header('Location: index.php');
			break;

		case 'add':
			$item->__SET('name',$_REQUEST['name']);
			$item->__SET('category',$_REQUEST['category']);
			$item->__SET('unit_price',$_REQUEST['unit_price']);
			$item->__SET('cost_price',$_REQUEST['cost_price']);
			$item->__SET('pic_filename',$_REQUEST['pic_filename']);

			$model->add_data($item);
			header('Location: index.php');
			break;

		case 'delete':
			$model->delete_data($_REQUEST['id']);
			header('Location: index.php');
			break;

		case 'edit':
			$item = $model->get_data($_REQUEST['id']);
			break;
	}
}

?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>CRUD [Nicolás]</title>
        <link rel="stylesheet" href="https://unpkg.com/purecss@2.0.3/build/pure-min.css">
		<link rel="stylesheet" href="css/styles.css">
	</head>
    <body style="padding:15px;">

        <div class="ml-center" style="3px 3px 3px 3px; max-width:650px; background-color:#d1cfcb;">
            <div class="ml-center " style="">
                <form action="?action=<?php echo $item->id > 0 ? 'update' : 'add'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px; width:100%;">
                    <input type="hidden" name="id" value="<?php echo $item->__GET('id'); ?>" />
                    
                    <table style="width:100%;">
                        <tr>
                            <th style="text-align:left;">Nombre</th>
                            <td><input type="text" name="name" value="<?php echo $item->__GET('name'); ?>" style="width:100%;" required/></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Categoría</th>
                            <td required>
                                <select name="category" style="width:100%;">
                                    <option value="1" <?php echo $item->__GET('category') == 1 ? 'selected' : ''; ?>>Gorros</option>
                                    <option value="2" <?php echo $item->__GET('category') == 2 ? 'selected' : ''; ?>>Camisas</option>
									<option value="3" <?php echo $item->__GET('category') == 3 ? 'selected' : ''; ?>>Camisetas</option>
									<option value="4" <?php echo $item->__GET('category') == 4 ? 'selected' : ''; ?>>Jeans</option>
									<option value="5" <?php echo $item->__GET('category') == 5 ? 'selected' : ''; ?>>Zapatos</option>
                                </select>
                            </td>
                        </tr>
						<tr>
                            <th style="text-align:left;">Precio al Coste</th>
                            <td><input type="number" name="cost_price" value="<?php echo $item->__GET('cost_price'); ?>" style="width:100%;" required/></td>
                        </tr>
						<tr>
                            <th style="text-align:left;">Precio por Unidad</th>
                            <td><input type="number" name="unit_price" value="<?php echo $item->__GET('unit_price'); ?>" style="width:100%;" required/></td>
                        </tr>
						<tr>
						<th style="text-align:left;">Imagen</th>
							<td><input type="file" name="file" /></td>
						</tr>
                        <tr>
                            <td colspan="2">
                                <button type="submit"  style="align:right;" class="pure-button pure-button-primary">Guardar</button>
                            </td>
                        </tr>
                    </table>
                </form>

                <table class="pure-table pure-table-horizontal ml-table-fit" style="width:100%; ">
                    <thead>
                        <tr>
                            <th style="text-align:left;">ID</th>
							<th style="text-align:left;">Imagen</th>
                            <th style="text-align:left;">Nombre</th>
                            <th style="text-align:left;">Categoría</th>
                            <th style="text-align:left;">Precio al Coste</th>
                            <th style="text-align:left;">Precio por Unidad</th>
                            <th></th>
							<th></th>
                        </tr>
                    </thead>
                    <?php foreach($model->list_data() as $r): ?>
                        <tr>
							<td style="background-color:#d1cfcb"><?php echo $r->__GET('id'); ?></td>
							<td style="background-color:#d1cfcb"><img src=""<?php echo $r->__GET('pic_filename'); ?>""</td>
							<td style="background-color:#d1cfcb"><?php echo $r->__GET('name'); ?></td>
							<td style="background-color:#d1cfcb"><?php $cat = $r->__GET('category'); switch ($cat){ case "1": echo "Gorros"; break; case "2": echo "Camisas"; break; case "3": echo "Camisetas"; break; case "4": echo "Jeans"; break; case "5": echo "Zapatos"; break;}
?></td>
                            <td style="background-color:#d1cfcb"><?php echo $r->__GET('cost_price'); ?></td>
                            <td style="background-color:#d1cfcb"><?php echo $r->__GET('unit_price'); ?></td>
                            <td style="background-color:#d1cfcb">
                                <a href="?action=edit&id=<?php echo $r->id; ?>">Editar</a>
                            </td>
                            <td style="background-color:#d1cfcb">
                                <a href="?action=delete&id=<?php echo $r->id; ?>">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>     
              
            </div>
        </div>

    </body>
</html>	