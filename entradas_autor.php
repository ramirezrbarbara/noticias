<?php  require_once "includes/conexion.php"; ?>
 <?php  require_once "includes/header.php"; ?>


    <!-- MENU -->
    
    <?php  include "includes/menu.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            
            <div class="col-md-8">
              
            
               <?php
                
                   $conectar= Conectar::conexion();
                
                   $entradas_autor=$_GET["autor"];
                
                   $sql="select * from entradas where entrada_autor=?";
                   
                   $resultado= $conectar->prepare($sql);
                
                   $resultado->bindValue(1,$entradas_autor);
                
                      if(!$resultado->execute()){
                          
                          die("fallo en la consulta");
                          exit();
                          
                      }else{
                          
                          while($reg=$resultado->fetch()){
                              
                              $id_entrada=$reg["id_entrada"];
                              $entrada_titulo=$reg["entrada_titulo"];
                              $entrada_autor=$reg["entrada_autor"];
                              $entrada_fecha=date("d-m-Y",strtotime($reg["entrada_fecha"]));
                              $entrada_imagen=$reg["entrada_imagen"];
                              $entrada_contenido=$reg["entrada_contenido"];
                              
                             ?>
                             
                                <!--<h1 class="page-header">
                                    Page Heading
                                    <small>Secondary Text</small>
                                </h1>-->

                                <!-- First Blog Post -->
                                <h2>
                                    <a href="entrada.php?id_entrada=<?php echo $id_entrada?>"><?php echo $entrada_titulo?></a>
                                </h2>
                                <p class="lead">
                                    Entradas de <a href="#"><?php echo $entrada_autor?></a>
                                </p>
                                <p><span class="glyphicon glyphicon-time"></span> <?php echo $entrada_fecha?></p>
                                <hr>
                                <!-- <img class="img-responsive" src="images/ -->
                                <img class="img-responsive" src="
                                <?php 
                                    // echo $entrada_imagen                                    
                                    echo 'images/'.substr($entrada_imagen,44);
                                ?>" alt="">
                                <hr>
                                <p><?php echo $entrada_contenido?></p>
                                

                                <hr>
          
                             <?php
                          
                          }
                      }
                
                ?>            

            </div>
            
              

            <!-- Blog Sidebar Widgets Column -->
            
            
            <?php require_once "includes/sidebar.php";?>
             

        </div>
        <!-- /.row -->

        <hr>

   

<?php require_once "includes/footer.php";?>
