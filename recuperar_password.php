<?php  require_once "includes/conexion.php"; ?>
<?php  require_once "includes/header.php"; ?>
<?php  require_once "admin/Modelos/Usuarios.php"; ?>

<?php

   $usuarios = new Usuarios();
?>

<?php
  
   /*validamos si se envia el correo por via POST*/
   if(isset($_POST["submit"])){
       
         $correo= $_POST["correo"]; 
       
         $length = 60;

         $token = bin2hex(openssl_random_pseudo_bytes($length));
       
         /*validamos si existe el correo en la tabla usuarios de la bd*/
         
          $verificar_correo=$usuarios->get_correo_en_bd($correo,$token);
            
   }


?>


<!-- Menu -->

<?php  require_once "includes/menu.php"; ?>

<!-- Page Content -->
<div class="container">

    <div class="form-gap"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">


                           <?php
                            
                              if(!isset($correo_enviado)){
                            
                            ?>


                                <h3><i class="fa fa-lock fa-4x"></i></h3>
                                <h2 class="text-center">Olvidó su Password?</h2>
                                <p>Usted puede resetear su password aquí</p>
                                <div class="panel-body">




                                    <form id="registro_form" role="form" autocomplete="off" class="form" method="post">

                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                                <input id="correo" name="correo" placeholder="Correo electrónico" class="form-control"  type="correo">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input name="submit" class="btn btn-lg btn-primary btn-block" value="Resetear Password" type="submit">
                                        </div>

                                        <input type="hidden" class="hide" name="token" id="token" value="">
                                    </form>

                                </div><!-- Body-->

                                <?php
                                  
                                 } 

                                 ?>
                          

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <hr>

   <?php require_once "includes/footer.php";?>

</div> <!-- /.container -->

