<?php  require_once "includes/conexion.php"; ?>
 <?php  require_once "includes/header.php"; ?>
<?php require_once("admin/Modelos/Entradas.php");?>
 <?php $entrada = new Entradas();?>


    <!-- Menú -->
    
    <?php  require_once "includes/menu.php"; ?>

    
 
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            
            <div class="col-md-8">
               
               
               <?php
                
                  if(isset($_POST["submit"])){
                  
                    $buscar=$_POST["buscar"];  
                 }else {
                     $buscar=""
                 } 
                
                $conectar=Conectar::conexion();
                
                $sql="select * from entradas where entrada_titulo like '%$buscar%' or entrada_etiquetas like '%$buscar%'";

                
                $resultado= $conectar->prepare($sql);
                
                  if(!$resultado->execute()){
                      
                     die("fallo en la consulta"); 
                  
                  } else {
                      
                        if($resultado->rowCount()==0){
                            
                            echo "<h1 class='text-center' style='color:red'>No hay resultados</h1>";
                        
                        
                        }else {
                            
                          
                          while($reg=$resultado->fetch()){
                              $id_entrada=$reg["id_entrada"];
                              $entrada_titulo=$reg["entrada_titulo"];
                              $entrada_autor=$reg["entrada_autor"];
                              $entrada_fecha=$reg["entrada_fecha"];
                              $entrada_imagen=$reg["entrada_imagen"];
                             // $entrada_contenido=$reg["entrada_contenido"];
                              $entrada_contenido=strip_tags(substr($reg["entrada_contenido"],0,100));

                              
                             ?>
                             
                                
                                <!-- First Blog Post -->
                                <h2>
                                    <a href="entrada.php?id_entrada=<?php echo $id_entrada?>"><?php echo $entrada_titulo?></a>
                                </h2>
                                <p class="lead">
                                    por <a href="index.php"><?php echo $entrada_autor?></a>
                                </p>
                                <p><span class="glyphicon glyphicon-time"></span> <?php echo $entrada_fecha?></p>
                                <hr>
                                <img class="img-responsive" src="<?php echo $entrada_imagen?>" width="600px"  alt="">
                                <hr>
                                <p><?php echo $entrada_contenido?></p>
                                <a class="btn btn-primary" href="entrada.php?id_entrada=<?php echo $id_entrada?>">Leer más <span class="glyphicon glyphicon-chevron-right"></span></a>


                                <hr>
          
                             <?php
                          
                          }
                      }
                      
                  } 
                
                ?>

                     
            </div>
            
              

            <!-- Blog Sidebar Widgets Column -->
            
            
            <?php require_once "includes/sidebar.php";?>
             

        </div>
        <!-- /.row -->

        <hr>


        <ul class="pager">

       

        </ul>

   

<?php require_once "includes/footer.php";?>
