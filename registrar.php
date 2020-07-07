<?php  require_once "includes/conexion.php"; ?>
<?php  require_once "includes/header.php"; ?>
<?php require_once("admin/Modelos/Usuarios.php");?>

<!--Notificaciones con pushercuando se hace un nuevo registro se muestra un mensaje de un nuevo usuario-->      
<?php require("vendor/autoload.php");

/*$pusher = new Pusher\Pusher(getenv('APP_KEY'), getenv('APP_SECRET'), getenv('APP_ID'), $options);*/

$options = array(
    'cluster' => 'us2',
    'encrypted' => true
  );

$pusher = new Pusher\Pusher("624bc5cd08c38b261c9a", "9cd28d70c5c4fbcf6847", "574112", $options);


?> 
       
<?php

      $usuarios = new Usuarios();

    
       if(isset($_POST["registrar_usuario"])){
         
          $usuario=$_POST["usuario"]; 
          
          /*encriptamos el password*/
          $password=$_POST["password"]; 
          /*Formato del password:el formato del password debe tener al menos una letra mayúscula, una letra minúscula, un caracter extraño, un número y minimo 12 caracteres y maximo 15 caracteres, por ejemplo en este proyecto lo tengo $Qw/*12345678$ no importa el orden lo importante es que se cumple el formato*/
          /*si no se cumple el formato del password entonces no se registra*/
          if(!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])([A-Za-z\d$@$!%*?&]|[^ ]){12,15}$/", $password)) {

                     header("Location:registrar.php?m=6");

            }
           
          $pass_encriptado= password_hash($password,PASSWORD_DEFAULT); 
          
          $nombre=$_POST["nombre"]; 
          $apellido=$_POST["apellido"]; 
          $correo=$_POST["correo"];        
           
          /*si se envia el formulario registramos el usuario*/
          $usuarios->registrar_usuario($usuario,$pass_encriptado,$nombre,$apellido,$correo);
           
           /*Notificaciones con pusher cuando se hace un nuevo registro se muestra un mensaje de un nuevo usuario*/   
           $data['message'] = $nombre;

           $pusher->trigger('notificaciones', 'nuevo_usuario', $data);
           
       }


   ?>
 
     
 <?php
        
       if(isset($_GET["m"])){
           
           switch($_GET["m"]){
                   
               case "1":
               ?>
                <h2 class="text-center" style="color:red">Los campos estan vacíos</h2>
               <?php
               break;
                   
                case "2":
               ?>
                <h2 class="text-center" style="color:red">Fallo en la consulta</h2>
               <?php
               break;
                   
               case "3":
               ?>
                <h2 class="text-center" style="color:green">Se ha registrado</h2>
               <?php
               break;
                   
               case "4":
               ?>
                <h2 class="text-center" style="color:red">No se insertó el registro</h2>
               <?php
               break;
                   
               case "5":
               ?>
                <h2 class="text-center" style="color:red">El correo existe en la base de datos</h2>
               <?php
               break;
                   
               case "6":
               ?>
                <h2 class="text-center" style="color:red">El formato del password debe tener al menos una letra mayúscula, una letra minúscula, un caracter extraño y un número y que sean minimo 12 caracteres y maximo 15 caracteres </h2>
               <?php
               break;
                   
                case "7":
               ?>
                <h2 class="text-center" style="color:red">El usuario ya existe en la base de datos </h2>
               <?php
               break;
           }   
       }

   ?>
   
   

 <!-- Menú -->
    
    <?php  require_once "includes/menu.php"; ?>

    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Registrar</h1>
                     <form action="" method="post">    
     
                      <div class="form-group">
                         <label for="title">Nombre</label>
                          <input type="text" class="form-control" name="nombre">
                      </div>

                       <div class="form-group">
                         <label for="post_status">Apellido</label>
                          <input type="text" class="form-control" name="apellido">
                      </div>

                      <div class="form-group">
                         <label for="post_tags">Usuario</label>
                          <input type="text" class="form-control" name="usuario">
                      </div>

                      <div class="form-group">
                         <label for="post_content">Email</label>
                          <input type="email" class="form-control" name="correo">
                      </div>

                      <div class="form-group">
                         <label for="post_content">Password</label>
                          <input type="password" class="form-control" name="password">
                      </div>

                       <div class="form-group">
                          <input class="btn btn-primary btn-lg btn-block" type="submit" name="registrar_usuario" value="Registrar usuario" value="Registrar">
                      </div>

                </form>

                
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php require_once "includes/footer.php";?>