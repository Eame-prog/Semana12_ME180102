<?php
include 'database.php';


function get_usuario_seguro($name,$seguro)
{
    $pdo = Database::connect();
    $status=[];
    $sql = "SELECT * FROM ejercicioclase11 where NombreApellido = '{$name}' and NumSeguro = '{$seguro}'";
    try {
        $query = $pdo->prepare($sql);
        $query->execute();
        
        if($row=$query->fetch(PDO::FETCH_ASSOC)){
            $status['message'] = "Usuario valido";
        }else{
            $status['message'] = "Usuario invalido";
        }
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
    Database::disconnect();
    return $status;
}

function get_all_usuario_seguro()
{
    $pdo = Database::connect();
    $sql = "SELECT * FROM ejercicioclase11";
    try {
        $query = $pdo->prepare($sql);
        $query->execute();
        $seguros=array();
        while($row=$query->fetch(PDO::FETCH_ASSOC)){
          $item=array(
              "ID_e"=>$row['ID_e'],
              "NombreApellido"=>$row['NombreApellido'],
              "NumSeguro"=>$row['NumSeguro'],
          );
          array_push($seguros,$item);
        }
        $all_seguros_info =  $seguros;
    } catch (PDOException $e) {

        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
    Database::disconnect();
    return $all_seguros_info;
}

function get_un_seguro_info($id)
{
    $pdo = Database::connect();
    $sql = "SELECT * FROM ejercicioclase11 where ID_e = {$id} ";
    try {
        $query = $pdo->prepare($sql);
        $query->execute();

        $seguros=array();
        while($row=$query->fetch(PDO::FETCH_ASSOC)){
          $item=array(
              "ID_e"=>$row['ID_e'],
              "NombreApellido"=>$row['NombreApellido'],
              "NumSeguro"=>$row['NumSeguro'],
          );
          array_push($seguros,$item);
        }
        $seguro_info = $seguros;
    } catch (PDOException $e) {

        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }

    Database::disconnect();
    return $seguro_info;
}




function update_seguro_info($id,$name,$seguro)
{
    $pdo = Database::connect();
    $sql = "UPDATE ejercicioclase11 SET NombreApellido = '{$name}', NumSeguro = '{$seguro}' where ID_e = '{$id}'";
    $status = [];

    try {

        $query = $pdo->prepare($sql);
        $result = $query->execute();
        if($result)
        {
            $status['message'] = "Dato actualizado";
        }
        else{
            $status['message'] = "Dato no actualizado";
        }

    } catch (PDOException $e) {

        $status['message'] = $e->getMessage(); 
    }

    Database::disconnect();
    return $status;
}


function add_seguro_info($id,$name,$seguro)
{
    $pdo = Database::connect();
    $sql = "INSERT INTO ejercicioclase11(`ID_e`,`NombreApellido`,`NumSeguro`) VALUES('{$id}', '{$name}','{$seguro}')";
    $status = [];
    
    try {
        $query = $pdo->prepare($sql);
        $result = $query->execute();
        if($result)
        {
            $status['message'] = "Seguro insertado";
        }
        else{
            $status['message'] = "Seguro no insertado";
        }
    } catch (PDOException $e) {

        $status['message'] = $e->getMessage(); 
    }
    Database::disconnect();
    return $status;
}

function delete_seguro_info($id)
{
    $pdo = Database::connect();
    $sql ="DELETE FROM ejercicioclase11 where ID_e = '{$id}'";
    $status = [];

    try {

        $query = $pdo->prepare($sql);
        $result = $query->execute();
        if($result)
        {
            $status['message'] = "Dato eliminado";
        }
        else{
            $status['message'] = "Dato no ha sido eliminado";
        }

    } catch (PDOException $e) {

        $status['message'] = $e->getMessage(); 
    }

    Database::disconnect();
    return $status;
}