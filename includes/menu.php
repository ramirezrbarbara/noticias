   <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
           
           
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">CMS - FRONTEND</a>
            </div>
            
            
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                
                 <?php
                    
                //    $conectar= Conectar::conexion();
                    
                //    $sql="select * from categorias LIMIT 3";
                   
                //    $resultado = $conectar->prepare($sql);
                    
                   
                //      if(!$resultado->execute()){
                         
                //         die("fallo en la consulta");
                         
                //      }else{
                        
                //          while($reg= $resultado->fetch()){
                             
                //              $id_categoria=$reg["id_categoria"];
                //              $cat_titulo=$reg["titulo"];
                             
                //              /*INICIO link active en el menu*/
                //              $categoria_clase="";
                //              $login_clase="";
                //              $registrarse_clase="";
                //              $contacto_clase="";
                             
                //              $nombre_pagina= basename($_SERVER["PHP_SELF"]);
                             
                //              $registrarse="registrar.php";
                //              $login="login.php";
                             
                //               if(isset($_GET["id_categoria"]) and $_GET["id_categoria"]==$id_categoria){
                                 
                //                   $categoria_clase="active";
                              
                //               } elseif($nombre_pagina==$registrarse){
                                 
                //                    $registrarse_clase="active";
                              
                //               } elseif($nombre_pagina==$login){
                                 
                //                    $login_clase="active";
                              
                //               } 
                             
                             
                //              else{
                                 
                //                   $contacto_clase="active";
                //               }
                             
                //              /*FIN link active en el menu*/
                             
                //              echo "<li class='$categoria_clase'><a href='categoria.php?id_categoria=$id_categoria'>$cat_titulo</a></li>";
                             
                //          }
                         
                //      }
                    
                    
                    
                 ?>
                 
                 <!--Si no esta en session entonces se muestra el boton login para loguearse-->  
                
                <?php
                     
                     if(!isset($_SESSION["rol"])){
                        
                        ?>
                          <li class='<?php echo $login_clase;?>'><a href='login.php'>Login</a></li> 
                        <?php
                         
                     }
                ?> 
                
                
                <!--validar si esta en session se muestra el boton Admin en caso contrario no se muestra-->  
                
                <?php
                     
                     if(isset($_SESSION["rol"])){
                        
                        ?>
                          <li><a href='admin'>Admin</a></li> 
                        <?php
                         
                     }
                ?> 
                 
            
                
                <li class="<?php echo $registrarse_clase;?>"><a href='registrar.php'>Registrarse</a></li> 
                
                <li class="<?php echo $contacto_clase;?>"><a href='contacto.php'>Contacto</a></li> 
                
                <?php
                 /*si el usuario esta logueada y si existe el id_entrada en la url entonces se muestra el link de editar entrada en el menu*/ 
                      
                    if(isset($_SESSION["correo"])){
                         
                        if(isset($_GET["id_entrada"])){
                            
                            $id_entrada=$_GET["id_entrada"];
                            
                            echo "<li><a href='admin/entradas.php?accion=edit_entrada&id_entrada=$id_entrada'>Editar entrada</a></li>";
                        }
                    }    
                    
                    
                ?> 
                 

                <!--<li><a href="#">Services</a></li>

                <li><a href="#">Contact</a></li>-->

           
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
