<div class="wrapper">
    <!-- Sidebar  -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <h3> Noticias</h3>
        </div>
        <ul class="list-unstyled components">
            <li>                    
                <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Escritorio</a>                
            </li>
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#posts_dropdown"><i class="fa fa-newspaper-o"></i> Entradas<i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="posts_dropdown" class="collapse">
                    <li>
                        <a href="./entradas.php">Todas las entradas</a>
                    </li>
                    <li>
                        <a href="entradas.php?accion=add_entrada">Añadir nueva entrada</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="./categorias.php"><i class="fa fa-tasks"></i> Categorias</a>
            </li>
            <!-- <li>
                <a href="comentarios.php"><i class="fa fa-fw fa-comments"></i>Comentarios</a>
            </li> -->
            <!--si el usuario es el administrador entonces puede ver el modulo de usuarios y puede ver el listado de usuarios, agregar, editar y eliminar-->   
            <?php                        
            if(isset($_SESSION["rol"]) and $_SESSION["rol"]=="administrador"){
            ?>
                <li>
                    <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-users"></i> Usuarios<i class="fa fa-fw fa-caret-down"></i></a>
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
                <a href="perfil.php"><i class="fa fa-fw fa-user"></i>Perfil</a>
            </li>
        </ul>                    
    </nav>

    <!-- Page Content  -->

    <div id="content">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <button type="button" id="sidebarCollapse" class="btn btn-info">                        
                    <i class="fa fa-align-left"></i>
                    <span>Menu</span>
                </button> 
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav navbar-nav ml-auto">            
                        <?php 
                            require_once("Modelos/Usuarios.php");
                            $usuarios= new Usuarios();
                        ?>
                        <li>
                            <a href="">Online: <span class="usuarios_online"><span class="badge badge-primary"><?php echo $usuarios->usuarios_online();?></span></span></a><i>  |</i>
                        </li>
                        <!--el admin_navigation.php se llama en el index.php del admin luego para ir al index.php(fuera de la carpeta admin solo tendriamos que salir de la carpeta admin y listo)-->
                        <!-- <li>
                            <a href="../index.php">HOME</a>
                        </li> -->
                        <?php echo $_SESSION["nombre"];?>
                        <b class="caret"></b></a>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>
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
                </div>
            </div>
        </nav>        

        <?php
        
        // $url = basename($_SERVER["REQUEST_URI"]);        

        // if(isset($url)){
        //     $rutas = array();
        //     $rutas = explode("?", $url);
        // }

        // include $rutas[0];
        
        ?>

    <!-- Este cierra en el index.php -->
    <!-- </div> -->

<!-- Este cierra en el admin_footer.php -->
<!-- </div> -->