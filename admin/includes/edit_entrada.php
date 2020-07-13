<?php
    
       if(isset($_POST["editar_entrada"])){
          
          $id_entrada=$_GET["id_entrada"];
          $id_categoria_entrada=$_POST["entrada_categoria"]; 
          $entrada_titulo=$_POST["entrada_titulo"]; 
        
           
          $entrada_imagen=$_FILES["entrada_imagen"]["name"];
          $entrada_imagen_temp=$_FILES["entrada_imagen"]["tmp_name"]; 
          move_uploaded_file($entrada_imagen_temp,"../images/$entrada_imagen");
           
           /*validamos si el campo de la imagen es vacio se envia la misma imagen del registro de la bd*/
             if(empty($entrada_imagen)){
                 
                  $entrada_imagen= $_POST["archivo"];  
                
             }
           
          $entrada_contenido=$_POST["entrada_contenido"]; 
          $entrada_etiquetas=$_POST["entrada_etiquetas"];        
        
          $entrada_status=$_POST["entrada_status"];               

           
            /*si se envia el formulario se edita la entrada*/
           $entrada->editar_entrada($id_entrada,$id_categoria_entrada,$entrada_titulo,$entrada_imagen,$entrada_contenido,$entrada_etiquetas,$entrada_status);
           
             
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
                <h3><a href="../entrada.php?id_entrada=<?php echo $_GET["id_entrada"];?>">ver entrada</h3></a>
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

    if(isset($_GET["id_entrada"])){
        
        $id_entrada= $_GET["id_entrada"];
        
        $datos= $entrada->get_entrada_por_id($id_entrada);
    }

?>
   
    <form action="" method="post" enctype="multipart/form-data">    
     
     
      <div class="form-group">
         <label for="titulo">Titula de Entrada</label>
          <input value="<?php echo $datos[0]["entrada_titulo"]?>"  type="text" class="form-control" name="entrada_titulo">
      </div>

           <div class="form-group">
       <label for="categorias">Categorías</label>
       <select name="entrada_categoria" id="">
          
          <?php
           
              $datosC=$categoria->get_categorias();
                 
                 for($i=0;$i<count($datosC);$i++){
                    
                    ?>
                     
                      <option value='<?php echo $datosC[$i]['id_categoria']?>'><?php echo $datosC[$i]['titulo']?> </option>; 
                    
                    <?php 
                    
                 }
                 
                 
           
           ?>
           
          
            <!--<option value="" selected>PHP</option>
            <option value="">JAVA</option>
            <option value="">ANGULAR</option>-->  
       </select>

      </div>

        <div class="form-group">
       <label for="usuarios">Usuario</label>
       <input type="text" class="form-control" name="entrada_usuario" value="<?php echo $datos[0]["entrada_autor"]?>" disabled>
       <!--<select name="entrada_usuario" id="">
         
          <option value="" selected>ucevito</option>
          <option value="">daniel</option>
          <option value="">carlos</option>
        
       </select>-->
      
      </div>

       <div class="form-group">
        <label for="usuarios">Status de la entrada</label>
      
         <select name="entrada_status" id="">
          
        <option value='<?php echo $datos[0]["entrada_status"]?>' selected><?php echo $datos[0]["entrada_status"]?></option>
            
             <?php
             
               if($datos[0]["entrada_status"]=="publicado"){
                  
                   echo "<option value='borrador'>borrador</option>";
              
               } else {
                   
                    echo "<option value='publicado'>publicado</option>";
               }
             
             
             ?>         
          
        </select>
        </div>
      
        
    <div class="form-group">

       <img width="100"  alt="">
       <input  type="file"  src="../images/imagen.jpg" name="entrada_imagen">
      </div>

      <div class="form-group">
         <label for="entrada_etiquetas">Etiquetas de Entrada</label>
          <input type="text" class="form-control" name="entrada_etiquetas" value="<?php echo $datos[0]["entrada_etiquetas"]?>">
      </div>
      
      <div class="form-group">
         <label for="entrada_contenido">Entrada de Contenido</label>
         <textarea  class="form-control" name="entrada_contenido" id="body" cols="30" rows="10"><?php echo $datos[0]["entrada_contenido"]?>
          
         </textarea>
      </div>
      
      <input type="hidden" name="archivo" value="<?php echo $datos[0]['entrada_imagen']?>">

       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="editar_entrada" value="Editar Entrada">
      </div>


</form>