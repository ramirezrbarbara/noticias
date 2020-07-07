       <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">BACKEND -    CMS</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">

              <!--   <li><a href="">Users Online: <?php //echo users_online(); ?></a></li> -->
                
               <?php require_once("Modelos/Usuarios.php");?>
                
                <?php $usuarios= new Usuarios();?>

                <li><a href="">Usuarios Online: 
                <span class="usuarios_online"><span class="badge badge-primary"><?php echo $usuarios->usuarios_online();?></span>
                </span></a></li>
            
              <!--el admin_navigation.php se llama en el index.php del admin luego para ir al index.php(fuera de la carpeta admin solo tendriamos que salir de la carpeta admin y listo)-->
               <li><a href="../index.php">HOME</a></li>
               
               
               
    
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>
                    
                    <?php echo $_SESSION["nombre"];?>               
                    
                    
                    <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                           
                           
                           
                            <a href="perfil.php"><i class="fa fa-fw fa-user"></i> Perfil</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="../includes/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            
            
            
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Escritorio</a>
                    </li>
                
                     <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#posts_dropdown"><i class="fa fa-fw fa-arrows-v"></i>Entradas <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="posts_dropdown" class="collapse">
                            <li>
                                <a href="./entradas.php"> Todas las entradas</a>
                            </li>
                            <li>
                                <a href="entradas.php?accion=add_entrada">Añadir nueva entrada</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="./categorias.php"><i class="fa fa-fw fa-wrench"></i> Categorias</a>
                    </li>
                   
                    <!-- <li class="">
                        <a href="comentarios.php"><i class="fa fa-fw fa-comments"></i> Comentarios</a>
                    </li> -->
                    
                    <!--si el usuario es el administrador entonces puede ver el modulo de usuarios y puede ver el listado de usuarios, agregar, editar y eliminar-->
                   
                   <?php
                        
                        if(isset($_SESSION["rol"]) and $_SESSION["rol"]=="administrador"){
                    ?>
                     
                        <li>
                            <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i> Usuarios <i class="fa fa-fw fa-caret-down"></i></a>
                            <ul id="demo" class="collapse">
                                <li>
                                    <a href="usuarios.php">Todos los usuarios</a>
                                </li>
                                <li>
                                    <a href="usuarios.php?accion=add_usuario">Añadir usuario</a>
                                </li>
                            </ul>
                        </li>

                    <?php
                        
                        }
                    
                    ?>
                    
                    <li>
                        <a href="perfil.php"><i class="fa fa-fw fa-user"></i> Perfil</a>
                    </li>
                    
                    
                    
                </ul>
            </div>
            
            
            
            <!-- /.navbar-collapse -->
        </nav>
        