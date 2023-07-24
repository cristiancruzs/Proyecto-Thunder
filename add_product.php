<?php
  $page_title = 'Agregar Material';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
  $all_categories = find_all('categories');
  $all_photo = find_all('media');
?>
<?php
 if(isset($_POST['add_product'])){
   $req_fields = array('name','categorie_id','serial' );
   validate_fields($req_fields);
   if(empty($errors)){
     $p_name  = remove_junk($db->escape($_POST['name']));
     $p_client_name = remove_junk($db->escape($_POST['client_name']));
     $p_cat   = remove_junk($db->escape($_POST['categorie_id']));
     $p_serial  = remove_junk($db->escape($_POST['serial']));
     $p_mac  = remove_junk($db->escape($_POST['mac']));
    
     $query  = "INSERT INTO products (";
     $query .=" categorie_id, serial, mac, client_name";
     $query .=") VALUES (";
     $query .=" {$p_cat}, '{$p_serial}','{$p_mac}', '{$p_client_name}' ";
     $query .=")";
     $query .=" ON DUPLICATE KEY UPDATE client_name='{$p_client_name}'";
     if($db->query($query)){
       $session->msg('s',"Producto Agregado ");
       redirect('add_product.php', false);
     } else {
       $session->msg('d',' Error al Intentar Agregar!');
       redirect('product.php', false);
     }

   } else{
     $session->msg("d", $errors);
     redirect('add_product.php',false);
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
  <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Agregar Nuevo Producto</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
          <form method="post" action="add_product.php" class="clearfix">

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
                <div class="input-group">
                  <span class="input-group-addon">
                    <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <select class="form-control" name="categorie_id">
                    <option value="">Seleccionar Modelo</option>
                  <?php  foreach ($all_categories as $cat): ?>
                    <option value="<?php echo (int)$cat['id'] ?>">
                      <?php echo $cat['name'] ?></option>
                    <?php endforeach; ?>
                    </select>
                </div>    
              </div>

              

              <!-- SERIAL -->
              <div class="form-group">
               <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="serial" placeholder="Serial del producto">
               </div>
              </div>

              <!-- MAC -->
              
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="glyphicon glyphicon-th-large"></i>
                </span>
                <input type="text" class="form-control" name="mac" placeholder="M.A.C del producto">
              </div> 
              <div  class="form-group">
             
              </div>
               
              <div class="d-flex justify-content-center">
              
                <button type="submit" name="add_product" class="btn btn-danger " >Agregar Producto</button>
                
              </div>
              
          </form>
         </div>
        </div>
      </div>
    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
