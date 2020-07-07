<?php require_once "includes/admin_header.php" ?>
    
<?php require_once("Modelos/Comentarios.php");?>
<?php require_once("Modelos/Entradas.php");?>


<?php

    $comentario = new Comentarios();
    $entrada= new Entradas();
    

       /*si existe el paramtro id_entrada en la url entonces se llama al metodo*/
       if(isset($_GET["id_entrada"])){
           
        $id_entrada= $_GET["id_entrada"];
        $datos= $comentario->get_comentarios_por_id_entrada($id_entrada);
           
           
          /*Mostrar nombre de la entrada*/
            $entrada_titulo=$entrada->get_entrada_por_id($id_entrada);
           
       }

     
?>    

    <div id="wrapper">
        
  

        <!-- Navigation -->
 
        <?php require_once "includes/admin_menu.php" ?>
        
        
    

<div id="page-wrapper">

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
<!-- 
  <h1 class="page-header">
            
               BACKEND - CMS
               
  </h1> -->
   
  <?php
    
    /*Eliminar los registros de los comentarios con el checkbox*/

    if(isset($_POST["checkBoxArray"])){
        
        foreach($_POST["checkBoxArray"] as $checkBoxArray){
          
           $bulk_opciones = $_POST["opciones"];
          
         if($bulk_opciones){
             
               $comentario->eliminar_comentario($checkBoxArray);

             
           }
            
        }
        
    } 

 /***************************************************************/
    
    

   /*eliminamos el comentario*/
   if(isset($_GET["eliminar_comentario"])){
       
       $id_comentario=$_GET["eliminar_comentario"];
       
       $comentario->eliminar_comentario($id_comentario);
   }

   /*aprobacion de comentario*/
  
    if(isset($_GET["aprobar_comentario"])){
        
        $id_comentario=$_GET["aprobar_comentario"]; 
        
        $comentario->aprobar_comentario($id_comentario);
    }


   /*desaprobacion de comentario*/
     
      if(isset($_GET["desaprobar_comentario"])){
        
        $id_comentario=$_GET["desaprobar_comentario"]; 
        
        $comentario->desaprobar_comentario($id_comentario);
    }

?>
            <h1 class="text-primary">Comentarios de la entrada <strong><?php echo $entrada_titulo[0]["entrada_titulo"]?></strong></h1>

<?php
            
    if(isset($_GET["m"])){
        
        switch($_GET["m"]){
                
            case "1":
            ?>
              <h2 style="color:green">Se ha eliminado el comentario</h2>
            <?php  
            break;
                
            case "2":
            ?>
              <h2 style="color:red">No se ha eliminado el comentario</h2>
            <?php  
            break;
                
            case "3":
            ?>
              <h2 style="color:red">Fallo en la consulta</h2>
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



<form action="" method='post'>

<table class="table table-bordered table-hover">
              

        <div id="contenedor_opciones" class="col-xs-4">

        <select class="form-control" name="opciones" id="">
        <option value="">Seleccione Opciones</option>
        
        <option value="eliminar">Borrar</option>
         
        </select>

        </div> 

            
<div class="col-xs-4">

<input type="submit" onClick="javascript:return confirm('Estas seguro que lo quieres eliminar?');" name="submit" class="btn btn-success" value="Aplicar">


 </div>
         
   

                <thead>
                    <tr>
                <th><input id="selecciona_todo" type="checkbox"></th>
                        <th>Id</th>
                        <th>Autor</th>
                        <th>Comentario</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>En respuesta a</th>
                        <th>Fecha</th>
                        <th>Aprobar</th>
                        <th>Desaprobar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                
                <tbody>
                      
               <?php for($i=0;$i<count($datos);$i++){?>
  
                    <tr>
                       <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $datos[$i]["id_comentario"];?>'></td>
                       <td><?php echo $datos[$i]["id_comentario"];?></td>
                       <td><?php echo $datos[$i]["comentario_autor"];?></td>
                       
                       <td><?php echo $datos[$i]["comentario_contenido"];?></td>
                       
                       <td><?php echo $datos[$i]["comentario_email"];?></td>
                       
                       
                       <td><?php echo $datos[$i]["comentario_status"];?></td>
                      
                       
                        <?php
                        
                          $entrada->get_entrada_por_id_comentario($datos[$i]["id_entrada_comentario"]);
                        
                        
                        ?>
                        
                       
                       <td><?php echo date("d-m-Y",strtotime($datos[$i]["comentario_fecha"]));?></td>
                       
                      
                      <td><a class='btn btn-primary' href='entrada_comentarios.php?aprobar_comentario=<?php echo $datos[$i]["id_comentario"];?>'><i class="fa fa-check"></i>  Aprobar</a></td>
                        
                        
                       <td><a class='btn btn-warning' href='entrada_comentarios.php?desaprobar_comentario=<?php echo $datos[$i]["id_comentario"];?>'><i class="fa fa-times"></i> Desaprobar</a></td> 

                        <td> <a onClick="javascript:return confirm('Estas seguro que lo quieres eliminar?');" class='btn btn-danger' href='entrada_comentarios.php?eliminar_comentario=<?php echo $datos[$i]["id_comentario"];?>'><i class="fa fa-trash"></i>  Eliminar</a>  </td>
                        
                        
                   </tr>
                   
             <?php }?>

    
            </tbody>
            </table>
            
            </form>
    

     
            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>

     
        <!-- /#page-wrapper -->
        
    <?php require_once "includes/admin_footer.php" ?>
       

            
            
            
            
            
      