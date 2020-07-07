<?php require_once "includes/admin_header.php" ?>
    
<?php require_once("Modelos/Entradas.php");?>
<?php require_once("Modelos/Categorias.php")?>
<?php require_once("Modelos/Comentarios.php");?>
      
<?php

    $entrada = new Entradas();
    $categoria= new Categorias();
    $comentario = new Comentarios();   

    $datos= $entrada->get_entradas();

     
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
            /*El ajuste solo se hizo en eliminar_entrada($id_entrada)*/
            /*case 1 por case 2,case 2 por case 5,case 3 por case 6*/ 
             case "2":
             ?>
               <h2 style="color:red">Fallo en la consulta</h2>
             <?php
             break;
                 
             case "5":
             ?>
               <h2 style="color:red">No existe el id de la entrada</h2>
             <?php
             break;
                 
             case "6":
             ?>
               <h2 style="color:green">se ha eliminado el registro de la entrada</h2>
             <?php
             break;
                 
             case "7":
             ?>
               <h2 style="color:green">El status se ha cambiado a publicado</h2>
             <?php
             break;
                 
             case "8":
             ?>
               <h2 style="color:green">El status se ha cambiado a borrador</h2>
             <?php
             break;
                 
             case "9":
             ?>
                <h2 style="color:red">no se ha cambiado el status de alguno de los registros</h2>
                
             <?php
                 
             break;
                 
             case "10":
             ?>
               <h2 style="color:green">Se han clonado los registros</h2>
             <?php
             break;
                 
             case "11":
             ?>
               <h2 style="color:red">No se han clonado los registros</h2>
             <?php
             break;
                 
             case "12":
             ?>
               <h2 style="color:green">Se ha reseteado las vistas de la entrada</h2>
             <?php
             break;
                 
             case "13":
             ?>
               <h2 style="color:green">No se ha reseteado las vistas de la entrada</h2>
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
    
    case 'add_entrada';
    
     require_once "includes/add_entrada.php";
    
    break; 
    
    
    case 'edit_entrada';
    
    require_once "includes/edit_entrada.php";
        
    break;
    

    default:
    
    require_once "includes/ver_entradas.php";
    
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
