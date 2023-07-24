<?php
  $page_title = 'Lista de Productos';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(2);
  $products = join_product_table();
?>

<!-- reference : 
  SELECT client_name, products.name,categories.name as model, serial, mac, created_at from products INNER JOIN categories ON products.categorie_id=categories.id;
-->
<?php include_once('layouts/header.php'); ?>
  <div class="row">
     <div class="col-md-12">
       <?php echo display_msg($msg); ?>
     </div>
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
         <div class="pull-right">
           <a href="add_product.php" class="btn btn-primary">Agregar Producto</a>
         </div>
        </div>
        <div class="panel-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="text-center" style="width: 10px;">Nº</th>
                <th class="text-center" style="width: 30%;"> Cliente </th>
                <th class="text-center" style="width: 25%;"> Producto </th>
                <th class="text-center" style="width: 10%;"> Modelo </th>
                <th class="text-center" style="width: 10%;"> Serial </th>
                <th class="text-center" style="width: 10%;"> MAC </th>
                <th class="text-center" style="width: 10%;"> Fecha de creación </th>
                <th class="text-center" style="width: 20%;"> Acciones </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($products as $product):?>
              <tr>
                <td class="text-center"><?php echo count_id();?></td>
                <td class="text-center"> <?php echo remove_junk($product['client_name']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['name']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['model']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['serial']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['mac']); ?></td>
                <td class="text-center"> <?php echo read_date($product['created_at']); ?></td>
                <td class="text-center">
                  <div class="btn-group">
                    <a href="edit_product.php?id=<?php echo (int)$product['id'];?>" class="btn btn-info btn-xs"  title="Editar" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-edit"></span>
                    <a>
                    <a href="delete_product.php?id=<?php echo (int)$product['id'];?>" class="btn btn-danger btn-xs"  title="Eliminar" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-trash"></span>
                    <a>
                  </div>
               </td>
              </tr>
             <?php endforeach; ?>
            </tbody>
          </tabel>
        </div>
      </div>
    </div>
  </div>
  <?php include_once('layouts/footer.php'); ?>
