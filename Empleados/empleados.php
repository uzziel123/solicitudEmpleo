<?php
$txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
$txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
$txtApellido=(isset($_POST['txtApellido']))?$_POST['txtApellido']:"";
$txtCorreo=(isset($_POST['txtCorreo']))?$_POST['txtCorreo']:"";
$txtTelefono=(isset($_POST['txtTelefono']))?$_POST['txtTelefono']:"";
$txtDireccion=(isset($_POST['txtDireccion']))?$_POST['txtDireccion']:"";
$txtEmpleo=(isset($_POST['txtEmpleo']))?$_POST['txtEmpleo']:"";
//$txtCV=(isset($_POST['txtCV']))?$_POST['txtCV']:"";


$txtFoto=(isset($_FILES['txtFoto']["name"]))?$_FILES['txtFoto']["name"]:"";



$txtCV=(isset($_FILES['txtCV']["name"]))?$_FILES['txtCV']["name"]:""; //quitar


       // echo "GC".$txtCV;
        //echo "<br/>GC".$txtFoto;
$accion=(isset($_POST['accion']))?$_POST['accion']:"";

$error=array();

$accionAgregar="";
$accionModificar=$accionEliminar=$accionCancelar="disable";
$mostrarModal=false;

include ("../Conexion/conexion.php");

switch($accion){
        
        case "btnAgregar":
        
            if($txtNombre==""){
                $error['Nombre']="Escribe el nombre";
            }
            if($txtApellido==""){
                $error['Apellido']="Escribe el apellido";
            }
            if($txtCorreo==""){
                $error['Correo']="Escribe tu correo";
            }
            if($txtTelefono==""){
                $error['Telefono']="Escribe tu número de teléfono";
            }
            if($txtDireccion==""){
                $error['Direccion']="Escribe tu domicilio";
            }
            if($txtEmpleo==""){
                $error['Empleo']="Escribe la plaza a aplicar";
            }
            if($txtCV==""){
                $error['CV']="Escribe la plaza a aplicar";
            }
            
            if(count($error)>0){
                $mostrarModal=true;
                break;
            }
        //guarda en db
            $sentencia=$pdo->prepare("INSERT INTO `Solicitudes`(Nombre,Apellido,Correo,Telefono,Direccion,Empleo,Foto,CV)
            VALUES (:Nombre,:Apellido,:Correo,:Telefono,:Direccion,:Empleo,:Foto,:CV) ");
            $sentencia->bindParam(':Nombre',$txtNombre);
            $sentencia->bindParam(':Apellido',$txtApellido);
            $sentencia->bindParam(':Correo',$txtCorreo);
            $sentencia->bindParam(':Telefono',$txtTelefono);
            $sentencia->bindParam(':Direccion',$txtDireccion);
            $sentencia->bindParam(':Empleo',$txtEmpleo);
            $sentencia->bindParam(':Foto',$txtFoto);
            $sentencia->bindParam(':CV',$txtCV);
        
        

        
            $Fecha=new DateTime();
            $nombreArchivo=($txtFoto!="")?$Fecha->getTimestamp()."_".$_FILES["txtFoto"]["name"]:"imagen.jpg";
        
            $tmpFoto= $_FILES["txtFoto"]["tmp_name"];
            if($tmpFoto!=""){
                move_uploaded_file($tmpFoto,"../Imagenes/".$nombreArchivo);
            }
        
            $sentencia->bindParam(':Foto',$nombreArchivo);
            //$sentencia->execute();
        
        
        //cv ..............................................
        

            $nombreFile=($txtCV!="")?$_FILES["txtCV"]["name"]:"doc.pdf";
        
            //echo $nombreFile."_cochito";
        
            $tmpCV= $_FILES["txtCV"]["tmp_name"];
            if($tmpCV!=""){
                move_uploaded_file($tmpCV,"../CV/".$nombreFile);
            }
        
            $sentencia->bindParam(':CV',$nombreFile);
            $sentencia->execute();
//        
        //cv...............................................
        
        
        
        header('Location: index.php');
        break;
        
        case "btnModificar":
            $sentencia=$pdo->prepare(" UPDATE `Solicitudes` SET 
            Nombre=:Nombre,
            Apellido=:Apellido,
            Telefono=:Telefono,
            Direccion=:Direccion,
            Empleo=:Empleo,
            CV=:CV,
            Correo=:Correo WHERE id=:id");
        
            $sentencia->bindParam(':Nombre',$txtNombre);
            $sentencia->bindParam(':Apellido',$txtApellido);
            $sentencia->bindParam(':Telefono',$txtTelefono);
            $sentencia->bindParam(':Direccion',$txtDireccion);
            $sentencia->bindParam(':Empleo',$txtEmpleo);
            $sentencia->bindParam(':Correo',$txtCorreo);
            $sentencia->bindParam(':CV',$txtCV);
            
            $sentencia->bindParam(':id',$txtID);
            $sentencia->execute();
        
            $Fecha=new DateTime();
            $nombreArchivo=($txtFoto!="")?$Fecha->getTimestamp()."_".$_FILES["txtFoto"]["name"]:"imagen.jpg";
        
            $tmpFoto= $_FILES["txtFoto"]["tmp_name"];
        
            if($tmpFoto!=""){
                move_uploaded_file($tmpFoto,"../Imagenes/".$nombreArchivo);
                
                $sentencia=$pdo->prepare(" SELECT Foto FROM `Solicitudes` WHERE id=:id");
                $sentencia->bindParam(':id',$txtID);
                $sentencia->execute();
                $empleado=$sentencia->fetch(PDO::FETCH_LAZY);
                print_r($empleado);
            
                if(isset($empleado["Foto"])){
                    if(file_exists("../Imagenes/".$empleado["Foto"])){
                        if($empleado['Foto']!="imagen.jpg"){
                        unlink("../Imagenes/".$empleado["Foto"]);   
                        }   
                    }
                }
                
                $sentencia=$pdo->prepare(" UPDATE `Solicitudes` SET Foto=:Foto WHERE id=:id");
                $sentencia->bindParam(':Foto',$nombreArchivo);
                $sentencia->bindParam(':id',$txtID);
                $sentencia->execute();
            }    
        
            header('Location: index.php');
            echo $txtID;
            echo "Presionaste btnModificar";
        break;
        
        case "btnEliminar":
            $sentencia=$pdo->prepare(" SELECT Foto FROM `Solicitudes` WHERE id=:id");
            $sentencia->bindParam(':id',$txtID);
            $sentencia->execute();
            $empleado=$sentencia->fetch(PDO::FETCH_LAZY);
            print_r($empleado);
            
            if(isset($empleado["Foto"])&&($item['Foto']!="imagen.jpg")){
                if(file_exists("../Imagenes/".$empleado["Foto"])){
                    unlink("../Imagenes/".$empleado["Foto"]);
                }
            }
            $sentencia=$pdo->prepare("DELETE FROM `Solicitudes` WHERE id=:id");
            $sentencia->bindParam(':id',$txtID);
            $sentencia->execute();
            header('Location: index.php');
        
        case "btnCancelar":
            header('Location: index.php');
        break;
        
        case "Seleccionar":
            $accionAgregar="disable";
            $accionModificar=$accionEliminar=$accionCancelar="";
            $mostrarModal=true;
        
            $sentencia=$pdo->prepare(" SELECT * FROM `Solicitudes` WHERE id=:id");
            $sentencia->bindParam(':id',$txtID);
            $sentencia->execute();
            $empleado=$sentencia->fetch(PDO::FETCH_LAZY);
        
            $txtNombre=$empleado['Nombre'];
            $txtApellido=$empleado['Apellido'];
            $txtCorreo=$empleado['Correo'];
            $txtTelefono=$empleado['Telefono'];
            $txtDireccion=$empleado['Direccion'];
            $txtEmpleo=$empleado['Empleo'];
            $txtFoto=$empleado['Foto'];
            $txtCV=$empleado['CV'];
        
        break;
}

        $sentencia=$pdo->prepare("SELECT * FROM `Solicitudes` WHERE 1");
        $sentencia->execute();
        $listaEmpleados=$sentencia->fetchAll(PDO::FETCH_ASSOC);

//        print_r($listaEmpleados);

?>