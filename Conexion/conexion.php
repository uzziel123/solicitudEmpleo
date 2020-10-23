<?php
$servidor = "mysql:dbname=Solicitud;host=127.0.0.1";
$usuario = "root";
$password = "";

try{
    $pdo = new PDO($servidor, $usuario, $password,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMEs utf8"));
//    echo "La conexion a la base de datos ha sido exitosa ! ";
}catch(PDOException $e){
        echo "La conexion a la base de datos ha fallado ! ".$e->getMessage();
}
?>