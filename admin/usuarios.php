<?php require_once "includes/admin_header.php" ?>
<?php require_once("Modelos/Usuarios.php");?> 
       
<?php

   $usuarios = new Usuarios();

   $datos = $usuarios->get_usuarios();

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
            
     if(isset($_GET["m"])){
         
         switch($_GET["m"]){
           
             case "8":
             ?>
               <h2 style="color:red">Fallo en la consulta</h2>
             <?php
             break;
                 
             case "5":
             ?>
               <h2 style="color:red">No existe el id del usuario</h2>
             <?php
             break;
                 
             case "6":
             ?>
               <h2 style="color:green">se ha eliminado el registro del usuario</h2>
             <?php
             break;
                 
            case "9":
             ?>
               <h2 style="color:green">el usuario se ha cambiado a administrador</h2>
             <?php
             break;
                 
            case "10":
             ?>
               <h2 style="color:green">el usuario se ha cambiado a suscriptor</h2>
             <?php
             break;
                 
              case "11":
             ?>
               <h2 style="color:red">no se ha cambiado el rol de usuario</h2>
             <?php
             break;
         }
     }            
?>           
           
      
            
            
<?php

if(isset($_GET['accion'])){

$accion = $_GET['accion'];

} else {

$accion = '';

}

switch($accion) {
    
    case 'add_usuario';
    
     require_once "includes/add_usuario.php";
    
    break; 
    
    
    case 'edit_usuario';
    
    require_once "includes/edit_usuario.php";
        
    break;
    
    
    default:
    
    require_once "includes/ver_usuarios.php";
    
    break;
        
    
}


?>

            

            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>

     
        <!-- /#page-wrapper -->
        
    <?php require_once "includes/admin_footer.php" ?>
