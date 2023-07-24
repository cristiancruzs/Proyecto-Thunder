<?php
require_once('includes/load.php');
// Checkin What level user has permission to view this page
page_require_level(1);

$categorie = find_by_id('categories',(int)$_GET['id']);
if(!$categorie){
  $session->msg("d","ID de la categoría falta.");
  redirect('categorie.php');
}

// Antes de eliminar la categoría, verificamos si está asociada con algún producto.
$product = find_by_field('products', 'categorie_id', $categorie['id']);
if ($product) {
  $session->msg("d","Esta categoría está asociada a un(os) producto(s), por lo cual no se puede eliminar.");
  redirect('categorie.php');
} else {
  $delete_id = delete_by_id('categories',$categorie['id']);
  if($delete_id){
      $session->msg("s","Categoría eliminada");
      redirect('categorie.php');
  } else {
      $session->msg("d","Eliminación falló");
      redirect('categorie.php');
  }
}
?>
