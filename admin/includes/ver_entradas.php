<?php

   /*validacion de cambio de status de la entrada con el checkbox*/

    if(isset($_POST["checkBoxArray"])){
        
        foreach($_POST["checkBoxArray"] as $checkBoxArray){
          
           $bulk_opciones = $_POST["bulk_opciones"];
            
            switch($bulk_opciones){
               
                case "publicado":
                    
                 $entrada->editar_status($checkBoxArray,$bulk_opciones);
                    
                break;
                    
                case "borrador":
                    $entrada->editar_status($checkBoxArray,$bulk_opciones);
                break;
                    
                case "eliminar":
                    
                    $entrada->eliminar_entrada($checkBoxArray);
                    
                break;
                    
                case "clonar":
                
                    /*seleccionamos los registros de acuerdo a los ids seleccionados en el checkbox luego lo recorremos en el ciclo for y luego insertamos los registros de acuerdo a los ids seleccionados*/
                    $datos=$entrada->get_entrada_por_id($checkBoxArray);
                    
                      for($i=0;$i<count($datos);$i++){
                          
                        $entrada->clonar_entrada($datos[$i]["id_categoria_entrada"],$datos[$i]["entrada_titulo"],$datos[$i][ "entrada_autor"],$datos[$i]["entrada_fecha"],$datos[$i]["entrada_imagen"],$datos[$i][ "entrada_contenido"],$datos[$i]["entrada_etiquetas"],$datos[$i]["entrada_comment_count"],$datos[$i]["entrada_status"],$datos[$i]["entrada_views_count"]);
                      }
                    
                break;
                    
            }
            
        }
        
    } 


/*****************************************/
   if(isset($_GET["eliminar"])){
       
       $id_entrada=$_GET["eliminar"];
       
       $entrada->eliminar_entrada($id_entrada);
   }
/*************************************************/

 /*Resetear el numero de vistas*/

     if(isset($_GET["resetear"])){
       
       $id_entrada=$_GET["resetear"];
       
       $entrada->resetear_vistas_entrada($id_entrada);
   }


/* usuario  */
if(isset($_GET["id_usuario"])){
      
    $id_usuario= $_GET["id_usuario"];
    
    $user= $usuarios->get_usuario_por_id($id_usuario);
}
 
    
?>


<h1 class="text-primary text-center">ENTRADAS</h1>

    <table class="table table-striped table-bordered">        
       <div class="col-sm-3">   
            <form method="post" action=""  class="sidebar-form">
                <div class="input-group">
                <input type="text" name="buscar" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="submit" class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                    </span>
                </div>
            </form>
        </div>


        <thead class="table table-bordered table-striped dataTable thead-dark" style="text-align:center">
            <tr>
                <th style="width:15%">Fecha</th>
                <th>Usuarios</th>
                <th>Titulo</th>
                <th>Categoría</th>
                <th>Status</th>
                <th>Imagen</th>
                <th>Etiquetas</th>
                <th>Visitas</th>
                <th>Accion</th>
            </tr>
        </thead>
        
        <tbody  style="text-align:center">                            
            <?php 

            $iddCat=$categoria->get_iddCategoria($_SESSION["id_usuario"]);
            
            if(isset($_POST["submit"])){
                $buscar= $_POST["buscar"];
            
                $conectar = Conectar::conexion();
                $sql="select * from entradas where entrada_titulo like '%$buscar%' or entrada_contenido like '%$buscar%' or entrada_etiquetas like '%$buscar%'";
                
                $resultado= $conectar->prepare($sql);
            
                if(!$resultado->execute()){
                
                    die("fallo en la consulta"); 
                    
                } else {
                    if($resultado->rowCount()==0){
                    
                    echo "<h1 class='text-center' style='color:red'>No hay resultados</h1>";
                    
                    }else {
                        while($reg=$resultado->fetch()){
                            if($iddCat == $reg["id_categoria_entrada"] && $_SESSION["rol"]=="suscriptor"){?>
                            <tr>
                                <td><?php echo date("d-m-Y",strtotime($reg["entrada_fecha"]));?></td>
                                <td><?php echo $reg["entrada_autor"];?></td>
                                <td><?php echo $reg["entrada_titulo"];?></td>
                                <?php
                                    $categoria->get_categoria_por_id_entrada($reg["id_categoria_entrada"]);
                                ?>
                                <td><?php echo $reg["entrada_status"];?></td>
                                <td><img width='100' src="
                                <?php 
                                    echo '..'.substr($reg["entrada_imagen"],44);
                                ?>
                                " alt=""></td>
                                <td><?php echo $reg["entrada_etiquetas"];?></td>
                                <!--<td><span class="badge badge-danger"><?php //echo $datos[$i]["entrada_comment_count"];?></span></td>-->
                                <!-- <td><a href="entrada_comentarios.php?id_entrada=<?php echo $reg["id_entrada"]?>"><?php echo $comentario->get_numero_comentarios_por_id_entrada($reg["id_entrada"]);?></a></td> -->
                                <td><a onClick="javascript:return confirm('Estas seguro que lo quieres resetear?');"  href='entradas.php?resetear=<?php echo $reg["id_entrada"];?>'><?php echo $reg["entrada_views_count"];?></a></td>                                                
                                <td><div class="btn-group">
                                    <button type="button" class='btn btn-primary'> <a href='../entrada.php?id_entrada=<?php echo $reg["id_entrada"]?>'><i class="fa fa-eye" style="color:white;"></i></a></button>
                                    <button type="button" class='btn btn-success'><a href='entradas.php?accion=edit_entrada&id_entrada=<?php echo $reg["id_entrada"];?>'><i class="fa fa-pencil" style="color:white;"></i></a></button>
                                    <button type="button" class='btn btn-danger'><a onClick="javascript:return confirm('Estas seguro que lo quieres eliminar?');"  href='entradas.php?eliminar=<?php echo $reg["id_entrada"];?>'><i class="fa fa-trash" style="color:white;"></i></a></button>
                                </div></td>
                            </tr>
                        <?php 
                            }
                            if ($_SESSION["rol"]=="administrador") {?>
                                <tr>
                                <td><?php echo date("d-m-Y",strtotime($reg["entrada_fecha"]));?></td>
                                <td><?php echo $reg["entrada_autor"];?></td>
                                <td><?php echo $reg["entrada_titulo"];?></td>
                                <?php
                                    $categoria->get_categoria_por_id_entrada($reg["id_categoria_entrada"]);
                                ?>
                                <td><?php echo $reg["entrada_status"];?></td>
                                <td><img width='100' src="
                                <?php 
                                    echo '..'.substr($reg["entrada_imagen"],44);
                                ?>
                                " alt=""></td>
                                <td><?php echo $reg["entrada_etiquetas"];?></td>
                                <!--<td><span class="badge badge-danger"><?php //echo $datos[$i]["entrada_comment_count"];?></span></td>-->
                                <!-- <td><a href="entrada_comentarios.php?id_entrada=<?php echo $reg["id_entrada"]?>"><?php echo $comentario->get_numero_comentarios_por_id_entrada($reg["id_entrada"]);?></a></td> -->
                                <td><a onClick="javascript:return confirm('Estas seguro que lo quieres resetear?');"  href='entradas.php?resetear=<?php echo $reg["id_entrada"];?>'><?php echo $reg["entrada_views_count"];?></a></td>                                                
                                <td><div class="btn-group">
                                    <button type="button" class='btn btn-primary'> <a href='../entrada.php?id_entrada=<?php echo $reg["id_entrada"]?>'><i class="fa fa-eye" style="color:white;"></i></a></button>
                                    <button type="button" class='btn btn-success'><a href='entradas.php?accion=edit_entrada&id_entrada=<?php echo $reg["id_entrada"];?>'><i class="fa fa-pencil" style="color:white;"></i></a></button>
                                    <button type="button" class='btn btn-danger'><a onClick="javascript:return confirm('Estas seguro que lo quieres eliminar?');"  href='entradas.php?eliminar=<?php echo $reg["id_entrada"];?>'><i class="fa fa-trash" style="color:white;"></i></a></button>
                                </div></td>
                            </tr>
                            <?php 
                            }
                        }
                    }
                }
            }else { 

                for($i=0;$i<count($datos);$i++){
                    if($iddCat == $datos[$i]["id_categoria_entrada"] && $_SESSION["rol"]=="suscriptor"){
                   ?>
                    <tr>
                        <!-- <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $datos[$i]["id_entrada"];?>'></td> -->
                        <!-- <td><?php echo $datos[$i]["id_entrada"];?></td> -->
                        <td><?php echo date("d-m-Y",strtotime($datos[$i]["entrada_fecha"]));?></td>
                        <td><?php echo $datos[$i]["entrada_autor"];?></td>
                        <td><?php echo $datos[$i]["entrada_titulo"];?></td>
                        <?php
                            $categoria->get_categoria_por_id_entrada($datos[$i]["id_categoria_entrada"]);
                        ?>
                        <td><?php echo $datos[$i]["entrada_status"];?></td>
                        <!-- <td><img width='100' src="../images/ -->
                        <td><img width='100' src="
                        <?php 
                            // echo $datos[$i]["entrada_imagen"];
                            echo '..'.substr($datos[$i]["entrada_imagen"],44);
                        ?>
                        " alt=""></td>
                        <td><?php echo $datos[$i]["entrada_etiquetas"];?></td>
                        <!--<td><span class="badge badge-danger"><?php //echo $datos[$i]["entrada_comment_count"];?></span></td>-->
                        <!-- <td><a href="entrada_comentarios.php?id_entrada=<?php echo $datos[$i]["id_entrada"]?>"><?php echo $comentario->get_numero_comentarios_por_id_entrada($datos[$i]["id_entrada"]);?></a></td> -->
                        <td><a onClick="javascript:return confirm('Estas seguro que lo quieres resetear?');"  href='entradas.php?resetear=<?php echo $datos[$i]["id_entrada"];?>'><?php echo $datos[$i]["entrada_views_count"];?></a></td>                                                
                        <td><div class="btn-group">
                            <button type="button" class='btn btn-primary'> <a href='../entrada.php?id_entrada=<?php echo $datos[$i]["id_entrada"]?>'><i class="fa fa-eye" style="color:white;"></i></a></button>
                            <button type="button" class='btn btn-success'><a href='entradas.php?accion=edit_entrada&id_entrada=<?php echo $datos[$i]["id_entrada"];?>'><i class="fa fa-pencil" style="color:white;"></i></a></button>
                            <button type="button" class='btn btn-danger'><a onClick="javascript:return confirm('Estas seguro que lo quieres eliminar?');"  href='entradas.php?eliminar=<?php echo $datos[$i]["id_entrada"];?>'><i class="fa fa-trash" style="color:white;"></i></a></button>
                        </div></td>
                        
                    </tr>

                <?php 
                    } 
                    
                    if ($_SESSION["rol"]=="administrador") { ?>
                        <tr>
                        <!-- <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $datos[$i]["id_entrada"];?>'></td> -->
                        <!-- <td><?php echo $datos[$i]["id_entrada"];?></td> -->
                        <td><?php echo date("d-m-Y",strtotime($datos[$i]["entrada_fecha"]));?></td>
                        <td><?php echo $datos[$i]["entrada_autor"];?></td>
                        <td><?php echo $datos[$i]["entrada_titulo"];?></td>
                        <?php
                            $categoria->get_categoria_por_id_entrada($datos[$i]["id_categoria_entrada"]);
                        ?>
                        <td><?php echo $datos[$i]["entrada_status"];?></td>
                        <!-- <td><img width='100' src="../images/ -->
                        <td><img width='100' src="
                        <?php 
                            // echo $datos[$i]["entrada_imagen"];
                            echo '..'.substr($datos[$i]["entrada_imagen"],44);
                        ?>
                        " alt=""></td>
                        <td><?php echo $datos[$i]["entrada_etiquetas"];?></td>
                        <!--<td><span class="badge badge-danger"><?php //echo $datos[$i]["entrada_comment_count"];?></span></td>-->
                        <!-- <td><a href="entrada_comentarios.php?id_entrada=<?php echo $datos[$i]["id_entrada"]?>"><?php echo $comentario->get_numero_comentarios_por_id_entrada($datos[$i]["id_entrada"]);?></a></td> -->
                        <td><a onClick="javascript:return confirm('Estas seguro que lo quieres resetear?');"  href='entradas.php?resetear=<?php echo $datos[$i]["id_entrada"];?>'><?php echo $datos[$i]["entrada_views_count"];?></a></td>                                                
                        <td><div class="btn-group">
                            <button type="button" class='btn btn-primary'> <a href='../entrada.php?id_entrada=<?php echo $datos[$i]["id_entrada"]?>'><i class="fa fa-eye" style="color:white;"></i></a></button>
                            <button type="button" class='btn btn-success'><a href='entradas.php?accion=edit_entrada&id_entrada=<?php echo $datos[$i]["id_entrada"];?>'><i class="fa fa-pencil" style="color:white;"></i></a></button>
                            <button type="button" class='btn btn-danger'><a onClick="javascript:return confirm('Estas seguro que lo quieres eliminar?');"  href='entradas.php?eliminar=<?php echo $datos[$i]["id_entrada"];?>'><i class="fa fa-trash" style="color:white;"></i></a></button>
                        </div></td>
                        
                        </tr>
                    <?php
                    }
                }
            }
                
            ?>            
        </tbody>
    </table>
