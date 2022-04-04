<?php
include('lib/functions.php');
header('content-type: application/json');


if($_SERVER['REQUEST_METHOD']=="GET")
{
  if(isset($_GET['usuario'])){
  $usu = $_GET['usuario'];
  $pwd = $_GET['pwd'];
  $json = get_usuario($usu,$pwd);
  if(empty($json))
  header("HTTP/1.1 404 Not Found");
  echo json_encode($json);
  }
  elseif(isset($_GET['ID_e']))
  {
    $id =  $_GET['ID_e'];
    $json = get_un_seguro_info($id);
    if(empty($json))
    header("HTTP/1.1 404 Not Found");
    echo json_encode($json);
  }
  else{
    $json = get_all_usuario_seguro();
    echo json_encode($json);
  }
}



if($_SERVER['REQUEST_METHOD']=="POST")
{
  $data = json_decode( file_get_contents( 'php://input') );
  
  $id = $data->ID_e;
  $name = $data->NombreApellido;
  $seguro =$data->NumSeguro;
   $json = add_seguro_info($id,$name,$seguro);
  echo json_encode($json);
}

if($_SERVER['REQUEST_METHOD']=="PUT")
{
  $data = json_decode( file_get_contents( 'php://input' ) );
  
  $id = $data->ID_e;
  $name = $data->NombreApellido;
  $seguro =$data->NumSeguro;
  
  $json = update_seguro_info($id,$name,$seguro);
  echo json_encode($json);
}

if($_SERVER['REQUEST_METHOD']=="DELETE")
{
  $data = json_decode( file_get_contents( 'php://input' ));
  
  $id = $data->ID_e;
  $json = delete_seguro_info($id);
  echo json_encode($json);
}
?>