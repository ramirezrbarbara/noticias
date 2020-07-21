

   <?php

   /*eliminamos el usuario*/
   if(isset($_GET["eliminar"])){
       
       $id_usuario=$_GET["eliminar"];
       
       $usuarios->eliminar_usuario($id_usuario);
   }

   /*cambiar rol a administrador*/
  
    if(isset($_GET["cambiar_a_administrador"])){
        
        $id_usuario=$_GET["cambiar_a_administrador"]; 
        
        $usuarios->cambiar_a_administrador($id_usuario);
    }


   /*cambiar rol a suscriptor*/
     
      if(isset($_GET["cambiar_a_suscriptor"])){
        
        $id_usuario=$_GET["cambiar_a_suscriptor"]; 
        
        $usuarios->cambiar_a_suscriptor($id_usuario);
    }

?>
<h1 class="text-primary text-center">USUARIOS</h1>

<form action="" method='post'>

<table class="table table-bordered table-hover">
              

        <!--<div id="contenedor_opciones" class="col-xs-4">

        <select class="form-control" name="opciones" id="">
        <option value="">Seleccione Opciones</option>
        <option value="published">Publicar</option>
        <option value="draft">Borrador</option>
        <option value="delete">Borrar</option>
         <option value="clone">Clonar</option>
        </select>

        </div>--> 

            
<!-- <div class="col-xs-4">
    <input type="submit" name="submit" class="btn btn-success" value="Aplicar">
    <a class="btn btn-primary" href="usuarios.php?accion=add_usuario">Añadir Nuevo</a>

 </div> -->
         
   

                <thead class="table table-striped  thead-dark" >
                    <tr>
                <!-- <th><input id="selecciona_todo" type="checkbox"></th>
                        <th>Id</th> -->
                        <th>Usuario</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <!-- <th>Rol 1</th>
                        <th>Rol 2</th> -->
                        <th>Accion</th>
                    </tr>
                </thead>
                
                <tbody>
                      
               <?php for($i=0;$i<count($datos);$i++){?>
  
                    <tr>
                       <!-- <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='1'></td>
                       <td><?php echo $datos[$i]["id_usuario"];?></td> -->
                       <td><?php echo $datos[$i]["usuario"];?></td>
                       
                       <td><?php echo $datos[$i]["nombre"];?></td>
                       
                       <td><?php echo $datos[$i]["apellido"];?></td>
                       
                       
                       <td><?php echo $datos[$i]["correo"];?></td>
                       
                       <td><?php echo $datos[$i]["rol"];?></td>
                      
                       
<!--                       
                      <td><a  href='usuarios.php?cambiar_a_administrador=<?php echo $datos[$i]["id_usuario"];?>'>  administrador</a></td>
                      
                      <td><a  href='usuarios.php?cambiar_a_suscriptor=<?php echo $datos[$i]["id_usuario"];?>'>  suscriptor</a></td>   
                        
                         -->
                       <td><div class="btn-group">
                        <a class='btn btn-success' href='usuarios.php?accion=edit_usuario&id_usuario=<?php echo $datos[$i]["id_usuario"];?>'><i class="fa fa-pencil"></i> </a> 
                        <a onClick="javascript:return confirm('Estas seguro que lo quieres eliminar?');" class='btn btn-danger' href='usuarios.php?eliminar=<?php echo $datos[$i]["id_usuario"];?>'><i class="fa fa-trash"></i></a></div></td>
                        
                       
                   </tr>
                   
             <?php }?>

    
            </tbody>
            </table>
            
            </form>
    

            

            
            
            
            
            
      