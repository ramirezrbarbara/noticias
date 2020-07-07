<?php  require_once "includes/conexion.php"; ?>
 <?php  require_once "includes/header.php"; ?>
 
<?php 


if(isset($_POST['submit'])) {
    
    if(empty($_POST["correo"]) and empty($_POST["titulo"]) and empty($_POST["cuerpo"])){
        
        echo "<h2 class='text-center' style='color:red'>Los campos estan vacios</h2>";  
   
    } elseif(empty($_POST["correo"]) or empty($_POST["titulo"]) or empty($_POST["cuerpo"])){
        
       echo "<h2 class='text-center' style='color:red'>Los campos estan vacios</h2>";  
    }
    
    else {

        $to         = "tucorreo@gmail.com";
        $asunto    = wordwrap($_POST['titulo'],70);
        $cuerpo       = $_POST['cuerpo'];
        //para el envío en formato HTML 
        $cabecera = "MIME-Version: 1.0\r\n"; 
        $cabecera .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
        $cabecera     .= " From: ".$_POST["correo"];

        // send email
        //mail($to,$subject,$body,$header);

            /*validando el envio del correo*/
             if(mail($to,$asunto,$cuerpo,$cabecera)){

                echo "<h2 class='text-center' style='color:green'>Se ha enviado el comentario satisfactoriamente</h2>";

             }else {

                echo "<h2 class='text-center' style='color:red'>No se envió el correo</h2>";  
             }  


      }
}


?>


    <!-- Menu -->
    
    <?php  require_once "includes/menu.php"; ?>
    
    
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Contacto</h1>
                    <form role="form" action="" method="post" id="login-form" autocomplete="off">
                       
    
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="correo" id="correo" class="form-control" placeholder="Escriba su email">
                        </div>

                        <div class="form-group">
                            <label for="subject" class="sr-only">Titulo</label>
                            <input type="text" name="titulo" id="titulo" class="form-control" placeholder="Escriba el titulo">
                        </div>
                         <div class="form-group">
                           
                           <textarea class="form-control" name="cuerpo" id="cuerpo" cols="50" rows="10"></textarea>
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-primary btn-lg btn-block" value="Enviar">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php require_once "includes/footer.php";?>
