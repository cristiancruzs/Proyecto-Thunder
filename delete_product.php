<?php
if (isset($_GET['id'])) {
    $product_id = intval($_GET['id']);
    // Resto del código para eliminar el producto con el ID $product_id
} else {
    // Código para manejar el caso en el que no se recibe el parámetro 'id'
}
?>
<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
?>
<?php
  $product = find_by_id('products',(int)$_GET['id']);
  if(!$product){
    $session->msg("d","Falla en el Id del Producto.");
    redirect('product.php');
  }
?>
<?php
  $delete_id = delete_by_id('products',(int)$product['id']);
  if($delete_id){
      $session->msg("s","Producto Borrado Correctamente.");
      redirect('product.php');
  } else {
      $session->msg("d","Falla al Borrar Prodcuto.");
      redirect('product.php');
  }
?>
