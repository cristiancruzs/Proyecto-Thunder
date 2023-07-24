<?php
  $page_title = 'Editar Producto';
  require_once('includes/load.php');

$product = find_by_id('products',(int)$_GET['id']);
$all_categories = find_all('categories');

if(!$product){
  $session->msg("d","Falla en el Id del Producto.");
  redirect('product.php');
}

if(isset($_POST['edit-product'])){
  if(empty($errors)){
    $name  = remove_junk($db->escape($_POST['name']));
    $client_name  = remove_junk($db->escape($_POST['client_name']));
    $serial  = remove_junk($db->escape($_POST['serial']));
    $mac  = remove_junk($db->escape($_POST['mac']));
    $cat   = (int)$_POST['categorie'];
    $id  =(int)$_POST['id'];
        
    // $query   ="UPDATE products ";
    // $query  .="SET name='{$name}', categorie_id=$cat,";
    // $query  .="serial='{$serial}', mac='{$mac}', client_name='{$client_name}' ";
    // $query  .=" WHERE id='{$id}'";
    $query = "UPDATE products ";
    $query .= "SET client_name='$client_name', name='$name', serial='$serial', mac='$mac', categorie_id=$cat";
    $query .= " WHERE id='{$product['id']}'";
    $result = $db->query($query);

    if($result&& $db->affected_rows() === 1){
      $session->msg('s',"Producto Actualizado Correctamente.");
      redirect('product.php', false);
    } 
    else {
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
                <label>Nombre</label>
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="name" placeholder="Nombre del Producto" value="Unidades Ópticas de Red">
               </div>
              </div>

              <!-- CLIENT NAME -->
              <div class="form-group">
                <label>Nombre del Cliente</label>
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="client_name" placeholder="Nombre del Cliente" value="<?php echo remove_junk($product['client_name']);?>">
               </div>
              </div>

                  <!-- CATEGORIES -->
              <div class="form-group mb-4">
                <label>Categoría</label>
                <div class="row">
                  <div class="col-md-12">
                  <div class="input-group">
                    <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                    <select class="form-control" name="categorie">
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
                  <input type="text" class="form-control" name="serial" value="<?php echo remove_junk($product['serial']);?>">
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
                      <input type="text" class="form-control" name="mac" value="<?php echo remove_junk($product['mac']);?>">
                    </div>
                  </div>
                 </div>
                 </div>
                 </div>
                 
                  <!-- BOTON DE ACTUALIZAR -->
               </div>
              </div>
              <!-- Button -->
              <div class= "d-flex justify-content-center" >
              <button type="submit" name="edit-product" class="btn btn-danger">Actualizar</button>
              </div> 
          </form>
         </div>
        </div>
      </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
