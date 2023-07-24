<?php include_once('includes/load.php');
$req_fields = array('username','password' );
validate_fields($req_fields);
$username = remove_junk($_POST['username']);
$password = remove_junk($_POST['password']);

if(empty($errors)){
  $user_id = authenticate($username, $password);
  if($user_id){
    //create session with id
     $session->login($user_id);
     redirect('home.php',false);

  } else {
    $session->msg("d", "Lo sentimos, Nombre de Usuario/Contraseña Incorrectos.");
    redirect('index.php',false);
  }

} else {
   $session->msg("d", $errors);
   redirect('index.php',false);
}

?>
