    <form action="" method="post">
      <div class="form-group">
         <label for="cat-titulo">Editar Categoría</label>
         
       
        <?php
         
          $id_categoria= $_GET["editar"];
          
          $categoria->get_categoria_por_id($id_categoria);
          
          
          
         ?>  
                 
 
              
      </div>
       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="editar_categoria" value="Editar Categoria">
      </div>

    </form>
