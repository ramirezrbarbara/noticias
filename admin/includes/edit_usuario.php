<?php
    
       if(isset($_POST["editar_usuario"])){
          
          $id_usuario=$_GET["id_usuario"];
          $nombre=$_POST["nombre"]; 
          $apellido=$_POST["apellido"];    
          $imagen="imagen";
          $rol=$_POST["rol"];  
           
          /*$usuario_imagen=$_FILES["entrada_imagen"]["name"];
          $usuario_imagen_temp=$_FILES["entrada_imagen"]["tmp_name"]; 
          move_uploaded_file($usuario_imagen_temp,"../images/$usuario_imagen");*/
           
           /*validamos si el campo de la imagen es vacio se envia la misma imagen del registro de la bd*/
             /*if(empty($usuario_imagen)){
                 
                  $usuario_imagen= $_POST["archivo"];  
                
             }*/             

           
            /*si se envia el formulario se edita el usuario*/
           $usuarios->editar_usuario($id_usuario,$nombre,$apellido,$imagen,$rol);
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
                <h2 style="color:green">se editó el registro</h2>
               <?php
               break;
                   
               case "4":
               ?>
                <h2 style="color:red">no se editó el registro</h2>
               <?php
               break;
               
              
           }   
       }

   ?>
   
    

    

    
<?php

    if(isset($_GET["id_usuario"])){
        
        $id_usuario= $_GET["id_usuario"];
        
        $datos= $usuarios->get_usuario_por_id($id_usuario);
    }

?>
   
   <h1 class="text-primary">Editar usuario</h1>
   
   
    <form action="" method="post" enctype="multipart/form-data">    
     
     
     
      <div class="form-group">
         <label for="title">Nombre</label>
          <input type="text" value="<?php echo $datos[0]["nombre"]?>" class="form-control" name="nombre">
      </div>
      
      
      

       <div class="form-group">
         <label for="post_status">Apellido</label>
          <input type="text" value="<?php echo $datos[0]["apellido"]?>" class="form-control" name="apellido">
      </div>
     
     
         <div class="form-group">
       
       <select name="rol" id="">
       
      <option value="<?php echo $datos[0]["rol"]?>"><?php echo $datos[0]["rol"]?></option>
      
           <?php
           
               if($datos[0]["rol"]=="administrador"){
                   
                   echo "<option value='suscriptor'>suscriptor</option>";
               
               }else {
                   
                  echo "<option value='administrador'>administrador</option>"; 
               }
           
           ?>
        
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
          <input type="text" value="<?php echo $datos[0]["usuario"]?>" class="form-control" name="usuario" disabled>
      </div>
      
      <div class="form-group">
         <label for="post_content">Email</label>
          <input type="email" value="<?php echo $datos[0]["correo"]?>" class="form-control" name="correo" disabled>
      </div>
      
      <div class="form-group">
         <label for="post_content">Password</label>
          <input type="password" value="<?php //echo $user_password; ?>" class="form-control" name="password" disabled>
      </div>
      
      
      

       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="editar_usuario" value="Editar Usuario">
      </div>


</form>
    