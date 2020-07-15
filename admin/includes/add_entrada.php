   <?php
    
       if(isset($_POST["crear_entrada"])){
           
          $id_categoria_entrada=$_POST["entrada_categoria"]; 
          $entrada_titulo=$_POST["entrada_titulo"]; 
          
           
          $entrada_imagen=$_FILES["entrada_imagen"]["name"];
          $entrada_imagen_temp=$_FILES["entrada_imagen"]["tmp_name"]; 
          move_uploaded_file($entrada_imagen_temp,"../images/$entrada_imagen");
           
          $entrada_contenido=$_POST["entrada_contenido"]; 
          $entrada_etiquetas=$_POST["entrada_etiquetas"];        
          $entrada_comment_count=0;
          $entrada_status=$_POST["entrada_status"];               

           
            /*si se envia el formulario registramos la entrada*/
           $entrada->insertar_entrada($id_categoria_entrada,$entrada_titulo,$entrada_imagen,$entrada_contenido,$entrada_etiquetas,$entrada_comment_count,$entrada_status);
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
           }   
       }

   ?>
   
   
   
   <h1 class="text-primary">Crear Entrada</h1>
   
    <form action="" method="post" enctype="multipart/form-data">    
     
     
      <div class="form-group">
         <label for="titulo">Titulo de la entrada</label>
          <input type="text" class="form-control" name="entrada_titulo">
      </div>

    <div class="form-group">
        <label for="entrada_categoria">Categoría</label>

                  <?php  
                
            if(isset($_SESSION["id_usuario"])){
                
                $id_usuario= $_SESSION["id_usuario"];
                
                $datos= $usuarios->get_perfil_por_id($id_usuario);
            }
            
            $cat = $categoria->get_categorias();
              
            for($i=0;$i<count($cat);$i++){                    
                if ($cat[$i]["idd"] == $datos[0]["idd"] && $cat[$i]["titulo"] == $datos[0]["idddesc"]){                        
                    $select='selected';
                    echo '<input type="hidden" name="entrada_categoria" value="'.$cat[$i]["id_categoria"].'">';
                    echo '<input type="text" class="form-control" name="display_categoria" value="'.$cat[$i]["titulo"].'" readonly>'; 
                }else{
                    $select='';
                }
            }
           ?>
        
    </div>

       <div class="form-group">
       <label for="usuarios">Usuario</label>
        <input type="text" class="form-control" name="entrada_usuario" value="<?php echo $_SESSION['usuario'];?>" disabled>
       <!--<select name="entrada_usuario" id="">
          
          <option value="">seleccione</option>
           <option value="">ucevito</option>
          <option value="">daniel</option>
          <option value="">carlos</option>
  
       </select>-->
      
      </div>

        <?php //echo '<h4>'.$_SESSION['idd'].'-'.$_SESSION['idddesc'].'</h4>'; ?>

        <!-- Asigno la categoria que viene de la base de datos -->
        <!-- <div class="form-group">
            <label>Categoría</label>
            <input type="text" class="form-control" value="<?php //echo $_SESSION['correo'];?>" disabled>
        </div> -->

       <div class="form-group">
       <label for="status">Status de la entrada</label>
        <!--<input type="text" class="form-control" name="entrada_status">-->
         <select name="entrada_status" id="">
           
             <option value="">seleccione el status</option>  
             <option value="publicado">publicado</option>
             <option value="borrador">borrador</option>
         </select>
      </div>
      
      
      
    <div class="form-group">
         <label for="entrada_imagen">Imagen de la entrada</label>
          <input type="file"  name="entrada_imagen">
      </div>

      <div class="form-group">
         <label for="entrada_etiquetas">Etiquetas de la entrada</label>
          <input type="text" class="form-control" name="entrada_etiquetas">
      </div>
      
      <div class="form-group">
         <label for="entrada_contenido">Contenido de la entrada</label>
         <textarea class="form-control" name="entrada_contenido" id="body" cols="30" rows="10">
         </textarea>
      </div>
      
      

       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="crear_entrada" value="Publicar entrada">
      </div>


</form>
    