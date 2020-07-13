    <form action="" method="post">
      <div class="col-6 form-group">
         <label for="cat-titulo">Editar Categoría</label>
         
       
        <?php
         
          $id_categoria= $_GET["editar"];
          
          $categoria->get_categoria_por_id($id_categoria);
          
          
          
         ?>  
                 
 
              
      </div>
       <div class="col-6 form-group">
          <input class="btn btn-primary" type="submit" name="editar_categoria" value="Editar Categoria">
      </div>

    </form>
