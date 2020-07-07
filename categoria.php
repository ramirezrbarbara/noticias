<?php  require_once "includes/conexion.php"; ?>
 <?php  require_once "includes/header.php"; ?>
<?php require_once("admin/Modelos/Entradas.php");?>
 <?php $entrada = new Entradas();?>

    <!-- MENU -->
    
    <?php  include "includes/menu.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            
            <div class="col-md-8">
              
            
               <?php
                
                   $conectar= Conectar::conexion();
                
                   $id_categoria=$_GET["id_categoria"];
                
                   $sql="select * from entradas where id_categoria_entrada=?";
                   
                   $resultado= $conectar->prepare($sql);
                
                   $resultado->bindValue(1,$id_categoria);
                
                      if(!$resultado->execute()){
                          
                          die("fallo en la consulta");
                         
                          
                      } else{
                           
                          if($resultado->rowCount()>0){
                          
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
                                    por <a href="index.php"><?php echo $entrada_autor?></a>
                                </p>
                                <p><span class="glyphicon glyphicon-time"></span> <?php echo $entrada_fecha?></p>
                                <hr>
                                <img class="img-responsive" src="images/<?php echo $entrada_imagen?>" alt="">
                                <hr>
                                <p><?php echo $entrada_contenido?></p>
                                

                                <hr>
          
                             <?php
                          
                          }
                               
                      } else {
                              
                             echo "<h1 style='color:red'>NO HAY ENTRADAS</h1>";
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
