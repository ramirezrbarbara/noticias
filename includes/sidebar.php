

<!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">
                
            

                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Buscador</h4>
                    <form action="buscar.php" method="post">
                    <div class="input-group">
                        <input name="buscar" type="text" class="form-control">
                        <span class="input-group-btn">
                            <button name="submit" class="btn btn-default" type="submit">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                    </div>
                    </form><!--search form-->
                    <!-- /.input-group -->
                </div>
                
                
                
  <!--Login -->
    <div class="well">
    
     <?php
      
          /*validamos si existe el envio del formulario*/
          if(isset($_POST["login"])){
              
             $usuarios->login($_POST["correo"],$_POST["password"]);
       
          
          } 
        
        
      ?>
      
      <?php
        
          if(isset($_GET["m"])){
              
              switch($_GET["m"]){
                  
                  case "1":
                  ?>
                   <h2 style='color:red'>Debe loguearse</h2>
                  <?php
                  break;
                      
                  case "2":
                  ?>
                   <h2 style='color:red'>ha cerrado sesion</h2>
                  <?php
                  break;
              } 
          }
        
        ?>
         
        <!--validacion si estas logueado o no-->
        
         <?php
        
            if(isset($_SESSION["rol"])){
                
                ?>
                 <h4>Estas logueado como <strong><?php echo $_SESSION["usuario"]?></strong></h4>
                 
                 <a href="includes/logout.php" class="btn btn-primary">Logout</a>
                 
                 
                <?php
                    
                
            }else{
                
         ?>
                   
             <h4>Login</h4>

                <form method="post">
                <div class="form-group">
                    <input name="correo" type="text" class="form-control" placeholder="Escriba el correo">
                </div>

                  <div class="input-group">
                    <input name="password" type="password" class="form-control" placeholder="Enter Password">
                    <span class="input-group-btn">
                       <button class="btn btn-primary" name="login" type="submit">Enviar
                       </button>
                    </span>
                   </div>

                    <div class="form-group">

                        <a href="recuperar_password.php">¿Olvidó su Password ?</a>


                    </div>

                </form><!--search form-->
                <!-- /.input-group -->
          
          <?php
                 
            }
        
          ?>
    </div>
                
                
                
                

                <!-- Blog Categories Well -->
                <!-- <div class="well">
                  
                  
                  
       
                 <h4>Categorías</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">
                            
                            <?php
                                
                             $conectar=Conectar::conexion();    
                                
                              $sql="select * from categorias";
                              
                              $resultado=$conectar->prepare($sql);
                               
                                if(!$resultado->execute()){
                                    
                                  die("fallo en la consulta");
                                    
                                }else{
                                    
                                    while($reg=$resultado->fetch()){
                                        
                                        $id_categoria=$reg["id_categoria"];
                                        $cat_titulo=$reg["titulo"];
                                        
                                       echo "<li><a href='categoria.php?id_categoria=$id_categoria'>$cat_titulo</></li>";
                                    } 
                                
                                }
                                
                            ?>
                             
                            <!--<li><a href="#">Category Name</a></li>
                            <li><a href="#">Category Name</a></li>
                            <li><a href="#">Category Name</a></li>
                            <li><a href="#">Category Name</a></li>-->
                             
                            </ul>
                        </div>
                        
                    </div>
                    <!-- /.row -->
                </div>
                
                <!-- Side Widget Well -->
                 <?php require_once "widget.php"; ?>

            </div>
             -->