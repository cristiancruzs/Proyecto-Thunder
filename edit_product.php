<?php
if (isset($_GET['id'])) {
    $product_id = intval($_GET['id']);
    // Resto del código para editar el producto con el ID $product_id
} else {
    // Código para manejar el caso en el que no se recibe el parámetro 'id'
}
?>
<?php
  $page_title = 'Editar Producto';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(2);
?>
<?php
$product = find_by_id('products',(int)$_GET['id']);
$all_categories = find_all('categories');

if(!$product){
  $session->msg("d","Falla en el Id del Producto.");
  redirect('product.php');
}
?>
<?php
 if(isset($_POST['product'])){
    $req_fields = array('product-title','product-categorie','product-quantity', 'product-serial', 'product-mac');
    validate_fields($req_fields);

   if(empty($errors)){
       $p_name  = remove_junk($db->escape($_POST['product-title']));
       $p_serial  = remove_junk($db->escape($_POST['product-serial']));
       $p_mac  = remove_junk($db->escape($_POST['product-mac']));
       $p_cat   = (int)$_POST['product-categorie'];
       $p_qty   = remove_junk($db->escape($_POST['product-quantity']));
       
       $query   = "UPDATE products SET";
       $query  .=" name ='{$p_name}', quantity = 1,";
       $query  .=" categorie_id ='{$p_cat},serial='{$p_serial}',mac='{$p_mac}'";
       $query  .=" WHERE id ='{$product['id']}'";
       $result = $db->query($query);
               if($result && $db->affected_rows() === 1){
                 $session->msg('s',"Producto Actualizado Correctamente.");
                 redirect('product.php', false);
               } else {
                 $session->msg('d',' Falla al Actualizar Producto.!');
                 redirect('edit_product.php?id='.$product['id'], false);
               }

   } else{
       $session->msg("d", $errors);
       redirect('edit_product.php?id='.$product['id'], false);
   }

 }

?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
</div>
  <div class="row">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Editar Producto</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
           <form method="post" action="edit_product.php?id=<?php echo (int)$product['id'] ?>">
          
          <!-- NAME -->
           <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="name" placeholder="Nombre del Producto" value="Unidades Ópticas de Red">
               </div>
              </div>

              <!-- CLIENT NAME -->
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="client_name" placeholder="Nombre del Cliente">
               </div>
              </div>

                  <!-- CATEGORIES -->
              <div class="form-group mb-4">
                <div class="row">
                  <div class="col-md-12">
                  <div class="input-group">
                    <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                    <select class="form-control" name="product-categorie">
                    <option value=""> Seleccionar Modelo</option>
                   <?php  foreach ($all_categories as $cat): ?>
                     <option value="<?php echo (int)$cat['id']; ?>" <?php if($product['categorie_id'] === $cat['id']): echo "selected"; endif; ?> >
                       <?php echo remove_junk($cat['name']); ?></option>
                   <?php endforeach; ?>
                   
                 </select>
                  </div>
                    </select>
                  </div>
                </div>
              </div>

               <!-- SERIAL -->
              <div class="form-group">
               <div class="row">
                 <div class="col-md-12">
                  <div class="form-group">
                    <label for="qty">Serial</label>
                    <div class="input-group">
                    <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="product-serial" value="<?php echo remove_junk($product['serial']);?>">
                    </div>
                  </div>
                 </div>
                 </div>
                 </div>

                  <!-- MAC -->
              <div class="form-group">
               <div class="row">
                 <div class="col-md-12">
                  <div class="form-group">
                    <label for="qty">MAC</label>
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="glyphicon glyphicon-th-large"></i>
                      </span>
                      <input type="text" class="form-control" name="product-mac" value="<?php echo remove_junk($product['mac']);?>">
                    </div>
                  </div>
                 </div>
                 </div>
                 </div>
                 
                  <!-- BOTON DE ACTUALIZAR -->
               </div>
              </div>
              <button type="submit" name="product" class="btn btn-danger">Actualizar</button>
          </form>
         </div>
        </div>
      </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
