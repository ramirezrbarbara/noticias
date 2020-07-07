<?php  require_once "includes/conexion.php"; ?>
<?php  require_once "includes/header.php"; ?>
<?php require_once("admin/Modelos/Entradas.php");?>
<?php require_once("admin/Modelos/Usuarios.php");?>
    
  <?php

      $entrada = new Entradas();
      $usuarios = new Usuarios();
  ?>

    <!-- Menú -->
    
    <?php  require_once "includes/menu.php"; ?>

    
 
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            
            <div class="col-md-8">
            
              
              <?php
                
                $por_pagina=5;
                
                 /*validamos si existe el parametro pagina en la url*/
                 if(isset($_GET["pagina"])){
                     
                     $pagina=$_GET["pagina"]; 
                     
                 }else {
                     
                     $pagina="";
                 }
                
                   /*si $pagina es vacio o igual a 1 entonces la pagina inicial estonces lo redirecciona a index.php el cual es la primera pagina*/
                   if($pagina=="" || $pagina==1){
                       
                      $pagina_inicial = 0;  
                  
                   }else {
                      
                       /*hay 5 registros por pagina*/
                      $pagina_inicial= ($pagina*$por_pagina) -$por_pagina;
                   }
                
                 /*contabilizamos el numero de registros de entradas de la tabla entradas de la base de datos*/
                 $num_entradas=count($entrada->get_entradas());
                
                /*dividimos el numero de registros totales entre 5 para paginar 5 registros por pagina y lo redondeamos con la funcion ceil*/
                 $num_entradas= ceil($num_entradas/$por_pagina);
                
              ?>
               
               
               <?php
                
                   $conectar= Conectar::conexion();
                
                   $sql="select * from entradas where entrada_status='publicado' LIMIT $pagina_inicial,$por_pagina";
                   
                   $resultado= $conectar->prepare($sql);
                
                      if(!$resultado->execute()){
                          
                          die("fallo en la consulta");
                          exit();
                          
                      }else{
                          /*hay registros con status publicado*/
                        if($resultado->rowCount()>0){
                          
                          while($reg=$resultado->fetch()){
                              
                              $id_entrada=$reg["id_entrada"];
                              $entrada_titulo=$reg["entrada_titulo"];
                              $entrada_autor=$reg["entrada_autor"];
                              $entrada_fecha=date("d-m-Y",strtotime($reg["entrada_fecha"]));
                              $entrada_imagen=$reg["entrada_imagen"];
                              $entrada_contenido=substr($reg["entrada_contenido"],0,100);
                              
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
                                    por <a href="entradas_autor.php?autor=<?php echo $entrada_autor?>&id_entrada=<?php echo $id_entrada?>"><?php echo $entrada_autor?></a>
                                </p>
                                <p><span class="glyphicon glyphicon-time"></span> <?php echo $entrada_fecha?></p>
                                <hr>
                                <a href="entrada.php?id_entrada=<?php echo $id_entrada?>">
                                    <!-- <img class="img-responsive" src="images/<?php //echo $entrada_imagen?>" alt=""> -->
                                <img class="img-responsive" src="
                                <?php                                 
                                    echo substr($entrada_imagen,45);
                                ?>" alt="">
                                </a>
                                <hr>
                                <p><?php echo $entrada_contenido?></p>
                                <a class="btn btn-primary" href="entrada.php?id_entrada=<?php echo $id_entrada?>">Leer más <span class="glyphicon glyphicon-chevron-right"></span></a>

                                <hr>
          
                             <?php
                          
                          }
                        
                        /*no hay registros publicados*/    
                        }else {
                             
                             echo "<h2 style='color:red' class='text-center'>No hay entradas publicadas</h2>";
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

           <?php
            
            
              for($i=1;$i<=$num_entradas;$i++){
                  
                if($i==$pagina){
                  
                  echo "<li><a class='active_link' href='index.php?pagina=$i'>$i</a></li>";
                    
                }else {
                    
                    echo "<li><a href='index.php?pagina=$i'>$i</a></li>"; 
                }
                  
              }
            
            
            ?>
       

        </ul>

   

<?php require_once "includes/footer.php";?>
