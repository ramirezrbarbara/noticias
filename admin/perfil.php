<?php require_once "includes/admin_header.php" ?>
<?php require_once("Modelos/Usuarios.php");?>
  
<?php  

  $usuarios = new Usuarios();

?>
   
    <div id="wrapper">
        
  

        <!-- Navigation -->
 
        <?php require_once "includes/admin_menu.php" ?>
        
        
    

<div id="page-wrapper">

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">

  <!-- <h1 class="page-header">
                   
                   BACKEND - CMS
                
  </h1> -->
            
            <?php
    
       if(isset($_POST["editar_usuario"])){                

          $id_usuario=$_SESSION["id_usuario"];
          $usuario=$_POST["usuario"];
           
          /*encriptamos el password*/
            //   $password=$_POST["password"];

            //   $pass_encriptado= password_hash($password,PASSWORD_DEFAULT);   
           
          $nombre=$_POST["nombre"]; 
          $apellido=$_POST["apellido"];
          $imagen="imagen";
          $rol=$_POST["rol"];
          $idd=$_POST["iddValor"];
          $iddDes=$_POST["iddDesc"];
        
          if(empty($_POST["password"])){
               /*si se envia el formulario se edita el usuario*/
            $usuarios->editar_perfil($id_usuario,$usuario,"",$nombre,$apellido,$imagen,$rol,$idd,$iddDes);
          }else {
              /*encriptamos el password*/
            $password=$_POST["password"];

            $pass_encriptado= password_hash($password,PASSWORD_DEFAULT);  

            /*$usuario_imagen=$_FILES["entrada_imagen"]["name"];
            $usuario_imagen_temp=$_FILES["entrada_imagen"]["tmp_name"]; 
            move_uploaded_file($usuario_imagen_temp,"../images/$usuario_imagen");*/
            
            /*validamos si el campo de la imagen es vacio se envia la misma imagen del registro de la bd*/
                /*if(empty($usuario_imagen)){
                    
                    $usuario_imagen= $_POST["archivo"];
                    
                }*/             

            
                /*si se envia el formulario se edita el usuario*/
            $usuarios->editar_perfil($id_usuario,$usuario,$pass_encriptado,$nombre,$apellido,$imagen,$rol,$idd,$iddDes);
            }
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
                <h2 style="color:green">se editó el perfil</h2>
               <?php
               break;
                   
               case "4":
               ?>
                <h2 style="color:red">no se editó el perfil</h2>
               <?php
               break;
                   
                case "5":
               ?>
                <h2 style="color:red">El id del usuario no existe en la base de datos</h2>
               <?php
               break;
           }   
       }

   ?>
   
    

    

    
<?php

    if(isset($_SESSION["id_usuario"])){
        
        $id_usuario= $_SESSION["id_usuario"];
        
        $datos= $usuarios->get_perfil_por_id($id_usuario);
    }

?>
   
   <h1 class="text-primary">Perfil de usuario</h1>
   
   
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
       <label>Rol de usuario</label><br>
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

    <!-- CATEGORIAS ORGANIGRAMA --> 
    <label>Categoría</label>  
    <div class="row d-flex text-left">
        <div class="col-md-6 mb-3">        
            <input type="idddescripcion" value="<?php echo $datos[0]["idddesc"]?>" class="form-control" name="idddescripcion" disabled>
        </div>
    </div>

    <div class="row d-flex text-left">
        <div class="col-md-6 mb-3">
            <label for="ministerio"><i class="far fa-arrow-alt-circle-right"></i>Ministerio</label>
            <select class="form-control" id="ministerio" onChange="getSecretaria()"></select>
        </div>
    </div>

    <div class="osecretaria" id="osecretaria" style="display: none">
        <div class="row d-flex text-left">
            <div class="col-md-6 mb-3">
                <label for="secretaria"><i class="far fa-arrow-alt-circle-right"></i>Secretaria</label>
                <select class="form-control" id="secretaria" onChange="getSubSecretaria()"></select>
            </div>
        </div>
    </div>
        
    <div class="osubsecretaria" id="osubsecretaria" style="display: none">
        <div class="row d-flex text-left">
            <div class="col-md-6 mb-3">
                <label for="subsecretaria"><i class="far fa-arrow-alt-circle-right"></i>SubSecretaria</label>
                <select class="form-control" id="subsecretaria" onChange="getDirecciongral()"></select>
            </div>
        </div>
    </div>

    <div class="odirecciongral" id="odirecciongral" style="display: none">
        <div class="row d-flex text-left">
            <div class="col-md-6 mb-3">
                <label for="direcciongral"><i class="far fa-arrow-alt-circle-right"></i>Direcciongral</label>
                <select class="form-control" id="direcciongral" onChange="getDireccion()"></select>
            </div>
        </div>
    </div>    

    <div class="odireccion" id="odireccion" style="display: none">
        <div class="row d-flex text-left">
            <div class="col-md-6 mb-3">
                <label for="direccion"><i class="far fa-arrow-alt-circle-right"></i>Direccion</label>
                <select class="form-control" id="direccion" onChange="getCoordinacion()"></select>
            </div>
        </div>
    </div>    
        
    <div class="ocoordinacion" id="ocoordinacion" style="display: none">
        <div class="row d-flex text-left">
            <div class="col-md-6 mb-3">
                <label for="coordinacion"><i class="far fa-arrow-alt-circle-right"></i>Coordinacion</label>
                <select class="form-control" id="coordinacion"></select>
            </div>    
        </div>
    </div>      
    <!-- Fin categoria -->
      
<!--
      <div class="form-group">
         <label for="post_image">Post Image</label>
          <input type="file"  name="image">
      </div>
-->

      <div class="form-group">
         <label for="post_tags">Usuario</label>
          <input type="text" value="<?php echo $datos[0]["usuario"]?>" class="form-control" name="usuario">
      </div>
      
      <div class="form-group">
         <label for="post_content">Email</label>
          <input type="email" value="<?php echo $datos[0]["correo"]?>" class="form-control" name="correo" disabled>
      </div>
      
      <div class="form-group">
         <label for="post_content">Password</label>
          <!-- <input type="password" value="value="<?php echo $datos[0]["password"]?>"" class="form-control" name="password"> -->
          <input type="password" value="" class="form-control" name="password">

      </div>
      
      
      

       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="editar_usuario" id="editar_usuario" value="Editar Perfil">
      </div>
        <!-- <div class="form-group">
          <input class="btn btn-primary" type="button" onClick="Setdata()" value="Prueba">
      </div> -->

      <input type="hidden" name="iddValor" id="iddValor" value="">
      <input type="hidden" name="iddDesc" id="iddDesc" value="">

</form>
    <!-- <script>
     function Setdata(){
         var idd = $("#coordinacion>option:selected").attr("idd");
         alert(idd);
     }
    </script> -->
            
            
            
      
            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>

     
        <!-- /#page-wrapper -->
        
    <?php require_once "includes/admin_footer.php" ?>
