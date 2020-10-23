<?php
require 'empleados.php';
?>
<!DOCTYPE html>
<html lang = "en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
    <title>SOLICITUD DE EMPLEO </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" >
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" ></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" ></script>
</head>
<body>
<div class = "container">
    <form action="" method="post" enctype="multipart/form-data" > 

        <input type="hidden" required name="txtID" value="<?php echo $txtID;?>" placeholder="" id="txtID" require="">

    <div class="form-group col-md-4">
        <br>
        <label for="">Nombre(s):</label>
        <input type="text" class="form-control <?php echo (isset($error['Nombre']))?"is-invalid":"";?>" name="txtNombre"  required value="<?php echo $txtNombre;?>" placeholder="" id="txtNombre" require="">
        <div class="invalid-feedback">
        <?php echo (isset($error['Nombre']))?$error['Nombre']:"";?>
        </div>
        <br>
        </div>
        
    <div class="form-group col-md-4">
        <label for="">Apellido(s):</label>
        <input type="text" class="form-control <?php echo (isset($error['Apellido']))?"is-invalid":"";?>" name="txtApellido"  value="<?php echo $txtApellido;?>" placeholder="" id="txtApellido" require="">
        <div class="invalid-feedback">
        <?php echo (isset($error['Apellido']))?$error['Apellido']:"";?>
        </div>
        <br>
        </div>
        
    <div class="form-group col-md-4">
        <label for="">Correo:</label>
        <input type="email" class="form-control <?php echo (isset($error['Correo']))?"is-invalid":"";?>" name="txtCorreo"  value="<?php echo $txtCorreo;?>" placeholder="" id="txtCorreo" require="">
        <div class="invalid-feedback">
        <?php echo (isset($error['Correo']))?$error['Correo']:"";?>
        </div>
        <br>
        </div>
        
    <div class="form-group col-md-4">
        <label for="">Telefono:</label>
        <input type="text" class="form-control <?php echo (isset($error['Telefono']))?"is-invalid":"";?>" name="txtTelefono"  value="<?php echo $txtTelefono;?>" placeholder="" id="txtTelefono" require="">
        <div class="invalid-feedback">
        <?php echo (isset($error['Telefono']))?$error['Telefono']:"";?>
        </div>
        <br>
        </div>
        
    <div class="form-group col-md-4">
        <label for="">Dirección:</label>
        <input type="text" class="form-control <?php echo (isset($error['Direccion']))?"is-invalid":"";?>" name="txtDireccion" value="<?php echo $txtDireccion;?>" placeholder="" id="txtDireccion" require="">
        <div class="invalid-feedback">
        <?php echo (isset($error['Direccion']))?$error['Direccion']:"";?>
        </div>
        <br>
        </div>
        
    <div class="form-group col-md-4">
        <label for="">Empleo que solicita:</label>
        <select class="form-control <?php echo (isset($error['Empleo']))?"is-invalid":"";?>" id="txtEmpleo" name="txtEmpleo" value="<?php echo $txtEmpleo;?>" require="" >
            <option>Cloud IT</option>
            <option>Administrador de Redes</option>
            <option>Ingeniero de Seguridad Informática</option>
            <option>Ingeniero de Infraestructura</option>
            <option>Analista de Datos</option>
            <option></option>
        </select>
<!--
        <input type="text" class="form-control <?php echo (isset($error['Empleo']))?"is-invalid":"";?>" name="txtEmpleo"  value="<?php echo $txtEmpleo;?>" placeholder="" id="txtEmpleo" require="">
        <div class="invalid-feedback">
        <?php echo (isset($error['Empleo']))?$error['Empleo']:"";?>
        </div>
-->
        <br>
        </div>
        
     <div class="form-group col-md-12">
        <label for="">Foto:</label>
         <br>
        <?php if ($txtFoto!=""){?>
        <br/>
        <img class="img-thumbnail rounded mx-auto d-block" width="250px" src="../Imagenes/<?php echo $txtFoto;?>"/>
        <br/>
        <br/>
        <?php }?>
        
        <input type="file" class="btn btn-secondary active" accept="image/*" name="txtFoto" value="<?php echo $txtFoto;?>"  placeholder="" id="txtFoto" require="">
        <br>
        </div>   
        
    <div class="form-group col-md-12">
        <label for="">Adjuntar CV:</label>
         <br>
        <?php if ($txtCV!=""){?>
        <br/>
        <br/>
        <br/>
        <?php }?>
        
        <input type="file" class="btn btn-secondary active" accept=".pdf,.doc,.docx" name="txtCV" value="<?php echo $txtCV;?>"  placeholder="" id="txtCV" require="">
        <br>
        </div>   
        
    <div class="form-group col-md-12">
        <button value="btnAgregar" <?php echo $accionAgregar;?> class="btn btn-success" type="submit" name="accion">Agregar</button>
        <button value="btnModificar" <?php echo $accionModificar;?> class="btn btn-warning" type="submit" name="accion">Modificar</button>
        <button value="btnEliminar" onclick="return Confirmar('Relamente deseas borrar?');" <?php echo $accionEliminar;?> class="btn btn-danger" type="submit" name="accion">Eliminar</button>
        <button value="btnCancelar" <?php echo $accionCancelar;?> class="btn btn-primary" type="submit" name="accion">Cancelar</button>
        <br>
        <br>
        </div>
    </form>
    
<div class="row" >
    <table class="table table-hover table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Foto</th>
                <th>Nombre Completo</th>
                <th>Correo</th>
                <th>Telefono</th>
<!--                <th>Direccion</th>-->
                <th>Empleo solicitado</th>
                <th>Acciones</th>
            </tr>
        </thead>
<!--    </table>    -->
        
    <?php foreach($listaEmpleados as $empleado){ ?>
        <tr>
            <td><img class="img-thumbnail" width="100px" src="../Imagenes/<?php echo $empleado['Foto']; ?>" /></td>
            <td> <?php echo $empleado['Nombre'];?> <?php echo $empleado['Apellido'];?>  </td>
            <td> <?php echo $empleado['Correo'];?> </td>
            <td> <?php echo $empleado['Telefono'];?> </td>
<!--            <td> <?php echo $empleado['Direccion'];?> </td>-->
            <td> <?php echo $empleado['Empleo'];?> </td>
            <td>
                
            <form action="" method="post">
                
                <input type="hidden" name="txtID" value="<?php echo $empleado['ID']; ?>">
                <input type="submit" value="Seleccionar" class="btn btn-info" name="accion">
                <button value="btnEliminar" onclick="return Confirmar('Relamente deseas borrar?');" type="submit" class="btn btn-danger" name="accion">Eliminar</button>
            </form>    
                
            
            
            </td>
        </tr>   
    <?php } ?>
 
        
    </table>
    
</div>
<?php if($mostrarModal){?>
    <script>
        $('#exampleModal').modal('show');
    </script>
<?php }?>
    
<script>
    function Confirmar(Mensaje){
        return (confirm(Mensaje))?true:false;
    }
</script>
    
</div>    
</body>
</html>