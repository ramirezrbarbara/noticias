<?php  require_once "includes/conexion.php"; ?>
<?php  require_once "includes/header.php"; ?>
<?php require_once("admin/Modelos/Usuarios.php");?>
    
  <?php

      $usuarios = new Usuarios();
  ?>

<?php

          /*validamos si existe el envio del formulario*/
          if(isset($_POST["login"])){
              
             $usuarios->login($_POST["correo"],$_POST["password"]);
        }


?>

<?php
 
   if(isset($_GET["m"])){

       switch($_GET["m"]){
               
           case "1":
               
               ?>
                 <h2 class='text-center' style='color:green'>Se ha reseteado el password satisfactoriamente, ahora puede loguearse con el nuevo password</h2>
               <?php
               
           break;
       }
       
   }

?>



<!-- Menu -->

<?php  require_once "includes/menu.php"; ?>


<!-- Page Content -->
<div class="container">

	<div class="form-gap"></div>
	<div class="container">
		<div class="row" style="justify-content: center;">
			<div class="col-md-4 col-md-offset-4">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="text-center" >


							<h3><i class="fa fa-user fa-4x"></i></h3>
							<h2 class="text-center">Login</h2>
							<div class="panel-body">


								<form id="login-form" role="form" autocomplete="off" class="form" method="post">

									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-user color-blue"></i></span>

											<input name="correo" type="text" class="form-control" placeholder="Escriba su correo">
										</div>
									</div>

									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-lock color-blue"></i></span>
											<input name="password" type="password" class="form-control" placeholder="Escriba su Password">
										</div>
									</div>

									<div class="form-group">

										<input name="login" class="btn btn-lg btn-primary btn-block" value="Login" type="submit">
									</div>


								</form>

								<a href='registrar.php'>Registrarse</a>

							</div><!-- Body-->

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<hr>

	<?php require_once "includes/footer.php";?>

</div> <!-- /.container -->
