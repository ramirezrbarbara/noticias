  <?php
    
       if(isset($_POST["crear_usuario"])){
         
          $usuario=$_POST["usuario"]; 
          
          /*encriptamos el password*/
          $password=$_POST["password"]; 
        
          if(!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])([A-Za-z\d$@$!%*?&]|[^ ]){12,15}$/", $password)) {

                     header("Location:usuarios.php?accion=add_usuario&m=12");

            }
           
          $pass_encriptado= password_hash($password,PASSWORD_DEFAULT); 
          
          $nombre=$_POST["nombre"]; 
          $apellido=$_POST["apellido"]; 
          $correo=$_POST["correo"];        
          $imagen="imagen";
           
           /*$imagen=$_FILES["entrada_imagen"]["name"];
          $imagen_temp=$_FILES["entrada_imagen"]["tmp_name"]; 
          move_uploaded_file($imagen_temp,"../images/$imagen");*/
           
          $rol=$_POST["rol"];               

           
            /*si se envia el formulario registramos el usuario*/
        $usuarios->insertar_usuario($usuario,$pass_encriptado,$nombre,$apellido,$correo,$imagen,$rol);
           
       }


   ?>
   
   
   <?php
        
       if(isset($_GET["m"])){
           
           switch($_GET["m"]){
                   
               case "1":
               ?>
                <h2 style="color:red">El campo está vacío</h2>
               <?php
               break;
                   
                case "2":
               ?>
                <h2 style="color:red">Fallo en la consulta</h2>
               <?php
               break;
                   
               case "3":
               ?>
                <h2 style="color:green">se insertó el registro</h2>
               <?php
               break;
                   
               case "4":
               ?>
                <h2 style="color:red">no se insertó el registro</h2>
               <?php
               break;
                   
               case "7":
               ?>
                <h2 style="color:red">el correo existe en la base de datos</h2>
               <?php
               break;
                   
               case "12":
               ?>
                <h2 style="color:red">El formato del password debe tener al menos una letra mayúscula, una letra minúscula, un caracter extraño y un número y que sean minimo 12 caracteres y maximo 15 caracteres </h2>
               <?php
               break;
                   
                case "13":
               ?>
                <h2 style="color:red">El usuario ya existe en la base de datos </h2>
               <?php
               break;
           }   
       }

   ?>
   
   
    
    
    
    
    <h1 class="text-primary">Agregar usuario</h1>

    <form action="" method="post" enctype="multipart/form-data">    
     
     
     
      <div class="form-group">
         <label for="title">Nombre</label>
          <input type="text" class="form-control" name="nombre">
      </div>
      
      
      

       <div class="form-group">
         <label for="post_status">Apellido</label>
          <input type="text" class="form-control" name="apellido">
      </div>
     
     
         <div class="form-group">
       
       <select name="rol" id="">
        <option value="suscriptor">Seleccione Opciones</option>
          <option value="administrador">administrador</option>
          <option value="suscriptor">suscriptor</option>
           
        
       </select>
       
       
       
       
      </div>
      
<!--
      <div class="form-group">
         <label for="post_image">Post Image</label>
          <input type="file"  name="image">
      </div>
-->

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
          <input class="btn btn-primary" type="submit" name="crear_usuario" value="Añadir usuario">
      </div>


</form>
    