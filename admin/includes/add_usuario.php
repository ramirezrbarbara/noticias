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
          $idd=$_POST["iddValor"];
          $iddDes=$_POST["iddDesc"];
           
           /*$imagen=$_FILES["entrada_imagen"]["name"];
          $imagen_temp=$_FILES["entrada_imagen"]["tmp_name"]; 
          move_uploaded_file($imagen_temp,"../images/$imagen");*/
           
          $rol=$_POST["rol"];               

           
            /*si se envia el formulario registramos el usuario*/
        $usuarios->insertar_usuario($usuario,$pass_encriptado,$nombre,$apellido,$correo,$imagen,$rol,$idd,$iddDes);
           
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

       <!-- CATEGORIAS ORGANIGRAMA --> 
       <div>Categoría</div><br>

        <div class="row d-flex text-left">
            <div class="col-md-6 mb-3">
                <label for="ministerio"><i class="fas fa-map-marked-alt"></i>>>Ministerio</label>
                <select class="form-control" id="ministerio" onChange="getSecretaria()"></select>
            </div>
        </div>

        <div class="osecretaria" id="osecretaria" style="display: none">
            <div class="row d-flex text-left">
                <div class="col-md-6 mb-3">
                    <label for="secretaria"><i class="fas fa-map-marked-alt"></i>>>Secretaria</label>
                    <select class="form-control" id="secretaria" onChange="getSubSecretaria()"></select>
                </div>
            </div>
        </div>
            
        <div class="osubsecretaria" id="osubsecretaria" style="display: none">
            <div class="row d-flex text-left">
                <div class="col-md-6 mb-3">
                    <label for="subsecretaria"><i class="fas fa-map-marked-alt"></i>>>SubSecretaria</label>
                    <select class="form-control" id="subsecretaria" onChange="getDirecciongral()"></select>
                </div>
            </div>
        </div>

        <div class="odirecciongral" id="odirecciongral" style="display: none">
            <div class="row d-flex text-left">
                <div class="col-md-6 mb-3">
                    <label for="direcciongral"><i class="fas fa-map-marked-alt"></i>>>Direcciongral</label>
                    <select class="form-control" id="direcciongral" onChange="getDireccion()"></select>
                </div>
            </div>
        </div>    

        <div class="odireccion" id="odireccion" style="display: none">
            <div class="row d-flex text-left">
                <div class="col-md-6 mb-3">
                    <label for="direccion"><i class="fas fa-map-marked-alt"></i>>>Direccion</label>
                    <select class="form-control" id="direccion" onChange="getCoordinacion()"></select>
                </div>
            </div>
        </div>    
            
        <div class="ocoordinacion" id="ocoordinacion" style="display: none">
            <div class="row d-flex text-left">
                <div class="col-md-6 mb-3">
                    <label for="coordinacion"><i class="fas fa-map-marked-alt"></i>>>Coordinacion</label>
                    <select class="form-control" id="coordinacion"></select>
                </div>    
            </div>
        </div>      
        <!-- Fin categoria -->
      
      <div class="form-group">
         <label for="post_content">Password</label>
          <input type="password" class="form-control" name="password">
      </div>
      
       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="crear_usuario" id="editar_usuario" value="Añadir usuario">
      </div>

      <input type="hidden" name="iddValor" id="iddValor" value="">
      <input type="hidden" name="iddDesc" id="iddDesc" value="">



</form>
    