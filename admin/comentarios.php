<?php require_once "includes/admin_header.php" ?>
    
<?php require_once("Modelos/Comentarios.php");?>
<?php require_once("Modelos/Entradas.php");?>


<?php

    $comentario = new Comentarios();
    $entrada= new Entradas();
   
    $datos= $comentario->get_comentarios();

     
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
             
             case "1":
             ?>
               <h2 style="color:red">fallo en la consulta</h2>
             <?php
             break;
                 
             case "2":
             ?>
               <h2 style="color:red">No se eliminó el comentario</h2>
             <?php
             break;
                 
             case "3":
             ?>
               <h2 style="color:green">se ha eliminado el registro del comentario</h2>
             <?php
             break;
                 
            case "4":
             ?>
               <h2 style="color:green">se ha aprobado el comentario</h2>
             <?php
             break;
                 
            case "5":
             ?>
               <h2 style="color:red">no se ha modificado la aprobación del comentario</h2>
             <?php
             break;
                 
            case "6":
             ?>
               <h2 style="color:green">no se aprobó el comentario</h2>
             <?php
             break;
                 
             case "7":
             ?>
               <h2 style="color:red">no se ha modificado la desaprobación del comentario</h2>
             <?php
             break;
                 
            
                 
         }
     }            
?>           
           
   
            
            
<?php
 require_once "includes/ver_comentarios.php";

?>

 
            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>

     
        <!-- /#page-wrapper -->
        
    <?php require_once "includes/admin_footer.php" ?>
