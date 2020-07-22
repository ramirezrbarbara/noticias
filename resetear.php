<?php  require_once "includes/conexion.php"; ?>
<?php  require_once "includes/header.php"; ?>

<?php


    /*si no existen los parametros en la url entonces lo redirecciona al index.php*/
    if(!isset($_GET['correo']) && !isset($_GET['token'])){


        header("Location:index.php");


    } else {
         
         /*parametros de la url que vienen despues de dar click al enlance del correo*/
         $correo=$_GET["correo"];
         $token= $_GET["token"];
        
           /*consultamos si el correo y el token existen en la tabla usuarios, en caso que existan entonces procedemos a resetear el password*/
           
           $conectar=Conectar::conexion();
        
           $sql="select * from usuarios where correo=? and token=?";
        
           $resultado=$conectar->prepare($sql);
        
           $resultado->bindValue(1,$correo);
           $resultado->bindValue(2,$token);
        
            if(!$resultado->execute()){
                
                echo "<h2 style='color:red'>Fallo en la consulta</h2>";
            
            } else {
                 
                  /*si existe la consulta y que los campos password coinciden entonces reseteamos el password*/
                  if($resultado->rowCount()>0){
                      
                      /*si existe el envio del formulario*/
                       if(isset($_POST["submit"])){
                          
                           /*validamos que los campos no esten vacíos*/
                          if(empty($_POST["password"]) and empty($_POST["confirmar_password"])){
                              
                              echo "<h2 class='text-center' style='color:red'>Los campos estan vacíos</h2>";
                          
                          } /*si no se cumpla esta expresion regular con un formato del password de que al menos tenga una letra mayúscula, una letra minúscula, un caracter extraño y un número y que sean minimo 12 caracteres*/
                            else if(!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])([A-Za-z\d$@$!%*?&]|[^ ]){12,15}$/", $_POST["password"])) {

                                     echo "<h2 class='text-center' style='color:red'>El formato del password debe tener al menos una letra mayúscula, una letra minúscula, un caracter extraño y un número y que sean minimo 12 caracteres y maximo 15 caracteres </h2>";

                            }
                        
                          else{
                           
                          /*si los campos del password coninciden entonces editamos el password*/
                          if($_POST["password"]===$_POST["confirmar_password"]){
                               
                              $password= $_POST["password"];
                              
                               $pass_encriptado= password_hash($password,PASSWORD_DEFAULT);
                              
                               $query="update usuarios set 
                               
                                  password=?
                                  where 
                                  correo=?
                                  and 
                                  token=?
                               ";
                              
                                $resultado=$conectar->prepare($query);
                              
                                $resultado->bindValue(1,$pass_encriptado);
                                $resultado->bindValue(2,$correo);
                                $resultado->bindValue(3,$token);
                              
                                  if(!$resultado->execute()){
                                      
                                     echo "<h2 style='color:red'>Fallo en la consulta</h2>";   
                                  
                                  } else{
                                       
                                       /*verificamos si hay fila afectada*/
                                      
                                       if($resultado->rowCount()>0){
                                          
                                         /*lo redirecciona al login con un mensaje de exito ya para loguearse con el nuevo password*/
                                          header("Location:login.php?m=1");
                                       }
                                  }
                                   
                              
                               } else{

                                  echo "<h2 class='text-center' style='color:red'>El password no coincide</h2>";
                              }
                              
                         }/*cierre del else si los campos no estan vacios y el password cumple con el formato*/
                           
                       }else{
                           
                           echo "<h2 class='text-center' style='color:green'>Debe ingresar el nuevo password y que ambos coincidan</h2>";
                       }
                     
                  
                  } else {
                      
                      /*si no existe la consulta entonces lo redireccion a index.php*/
                      header("Location:index.php");
                  }
            }
        
    }


?>




<!-- Menu -->

 <?php  require_once "includes/menu.php"; ?>

<div class="container">



    <div class="container">
        <div class="row" style="justify-content: center;">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">


                            <h3><i class="fa fa-lock fa-4x"></i></h3>
                            <h2 class="text-center">Resetear Password</h2>
                            <p>Usted puede resetear su password aquí</p>
                            <div class="panel-body">


                                <form id="registro_form" role="form" autocomplete="off" class="form" method="post">

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-user color-blue"></i></span>
                                            <input id="password" name="password" placeholder="Escriba su password" class="form-control"  type="password">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-ok color-blue"></i></span>
                                            <input id="confirmar_password" name="confirmar_password" placeholder="Confirmar password" class="form-control"  type="password">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <input name="submit" class="btn btn-lg btn-primary btn-block" value="Resetear Password" type="submit">
                                    </div>

                                    <input type="hidden" class="hide" name="token" id="token" value="">
                                </form>

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



