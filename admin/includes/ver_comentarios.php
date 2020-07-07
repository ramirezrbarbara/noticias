
<?php


   /*Eliminar los registros de los comentarios con el checkbox*/

    if(isset($_POST["checkBoxArray"])){
        
        foreach($_POST["checkBoxArray"] as $checkBoxArray){
          
           $bulk_opciones = $_POST["bulk_opciones"];
          
         if($bulk_opciones){
             
               $comentario->eliminar_comentario($checkBoxArray);

             
           }
            
        }
        
    } 

 /***************************************************************/

   /*eliminamos el comentario*/
   if(isset($_GET["eliminar"])){
       
       $id_comentario=$_GET["eliminar"];
       
       $comentario->eliminar_comentario($id_comentario);
   }

   /*aprobacion de comentario*/
  
    if(isset($_GET["aprobar"])){
        
        $id_comentario=$_GET["aprobar"]; 
        
        $comentario->aprobar_comentario($id_comentario);
    }


   /*desaprobacion de comentario*/
     
      if(isset($_GET["desaprobar"])){
        
        $id_comentario=$_GET["desaprobar"]; 
        
        $comentario->desaprobar_comentario($id_comentario);
    }

?>
<h1 class="text-primary">Comentarios</h1>

<form action="" method='post'>

<table class="table table-bordered table-hover">
              

        <div id="contenedor_opciones" class="col-xs-4">

        <select  class="form-control" name="bulk_opciones" id="">
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
                       
                      
                      <td><a class='btn btn-primary' href='comentarios.php?aprobar=<?php echo $datos[$i]["id_comentario"];?>'><i class="fa fa-check"></i>  Aprobar</a></td>
                        
                        
                       <td><a class='btn btn-warning' href='comentarios.php?desaprobar=<?php echo $datos[$i]["id_comentario"];?>'><i class="fa fa-times"></i> Desaprobar</a></td> 

                        <td> <a onClick="javascript:return confirm('Estas seguro que lo quieres eliminar?');" class='btn btn-danger' href='comentarios.php?eliminar=<?php echo $datos[$i]["id_comentario"];?>'><i class="fa fa-trash"></i>  Eliminar</a>  </td>
                    
                       
                   </tr>
                   
             <?php }?>

    
            </tbody>
            </table>
            
            </form>
    

            

            
            
            
            
            
      