    <!-- Inicio -->
    <nav class="navbar navbar-expand navbar-orange navbar-light">                
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="login.php" class="nav-link">Inicio</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <!-- <a href="#" class="nav-link">Contacto</a> -->                
                    <a class="nav-link" href='contacto.php'>Contacto</a>
            </li>
            <!-- <li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link">Contact</a>
            </li> -->
        </ul>

        <!-- SEARCH -->
        <!-- <form class="form-inline ml-3">
            <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                </button>
                </div>
            </div>
        </form> -->
    </nav>
    <br>          
    <!-- Final -->

<!-- INICIO -->
   <!-- <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">          
           
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Menu noticias</a>
            </div>
            
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                
                 <?php
                    
                   $conectar= Conectar::conexion();
                    
                   $sql="select * from categorias LIMIT 3";
                   
                   $resultado = $conectar->prepare($sql);
                    
                   
                     if(!$resultado->execute()){
                         
                        die("fallo en la consulta");
                         
                     }else{
                        
                         while($reg= $resultado->fetch()){
                             
                             $id_categoria=$reg["id_categoria"];
                             $cat_titulo=$reg["titulo"];
                             
                             /*INICIO link active en el menu*/
                             $categoria_clase="";
                             $login_clase="";
                             $registrarse_clase="";
                             $contacto_clase="";
                             
                             $nombre_pagina= basename($_SERVER["PHP_SELF"]);
                             
                             $registrarse="registrar.php";
                             $login="login.php";
                             
                              if(isset($_GET["id_categoria"]) and $_GET["id_categoria"]==$id_categoria){
                                 
                                  $categoria_clase="active";
                              
                              } elseif($nombre_pagina==$registrarse){
                                 
                                   $registrarse_clase="active";
                              
                              } elseif($nombre_pagina==$login){
                                 
                                   $login_clase="active";
                              
                              } 
                             
                             
                             else{
                                 
                                  $contacto_clase="active";
                              }                             
                             
                             echo "<li class='$categoria_clase'><a href='categoria.php?id_categoria=$id_categoria'>$cat_titulo</a></li>";
                             
                         }
                         
                     }
                    
                    
                    
                 ?> 
                
                <?php
                     
                     if(!isset($_SESSION["rol"])){
                        
                        ?>
                          <li class='<?php echo $login_clase;?>'><a href='login.php'>Login</a></li> 
                        <?php
                         
                     }
                ?> 
                
                
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
                      
                    if(isset($_SESSION["correo"])){
                         
                        if(isset($_GET["id_entrada"])){
                            
                            $id_entrada=$_GET["id_entrada"];
                            
                            echo "<li><a href='admin/entradas.php?accion=edit_entrada&id_entrada=$id_entrada'>Editar entrada</a></li>";
                        }
                    }    
                    
                    
                ?> 

           
                </ul>
            </div>
        
        </div>
        
    </nav> -->
<!-- FINAL -->    
