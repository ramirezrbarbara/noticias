<?php


  class Usuarios extends Conectar{
      
    private $db;  
    private $usuarios; 
    private $usuario_por_id;
   
      
      public function __construct(){
          
        $this->db= Conectar::conexion();   
        $this->usuarios=array();  
        $this->usuario_por_id=array(); 
       
      } 
      
      
      public function get_usuarios(){
          
          $sql="select * from usuarios"; 
          
          $resultado=$this->db->prepare($sql);
          
            if(!$resultado->execute()){
              
                header("Location:index.php?m=1");
            
            }else{
                
                 while($reg=$resultado->fetch()){
                     
                      $this->usuarios[]=$reg;  
                 }
                
                return $this->usuarios;
            }
          
      }
      
       public function insertar_usuario($usuario,$password,$nombre,$apellido,$correo,$imagen,$rol){
           
          
           /*validamos que los campos no esten vacios*/
             if(empty($_POST["nombre"]) or empty($_POST["apellido"]) or empty($_POST["rol"]) or empty($_POST["usuario"]) or empty($_POST["correo"]) or empty($_POST["password"])){
                 
                 header("Location:usuarios.php?accion=add_usuario&m=1");
                 exit();
             }
           
           /*el formato del password debe tener al menos una letra mayúscula, una letra minúscula, un caracter extraño y un número, por ejemplo en este proyecto lo tengo $Qw/*12345678$ no importa el orden lo importante es que se cumple el formato*/
                 
                 /*si no se cumpla esta expresion regular con un formato del password de que al menos tenga una letra mayúscula, una letra minúscula, un caracter extraño y un número y que sean minimo 12 caracteres*/
                 else if(!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])([A-Za-z\d$@$!%*?&]|[^ ]){12,15}$/", $_POST["password"])) {

                     header("Location:usuarios.php?accion=add_usuario&m=12");

            }

             else {
              
              /*entonces si los campos no estan vacios y si se cumple el formato del password entonces validamos si existe el correo en la base de datos*/
           
           /*validamos que el usuario y correo no existan en la base de datos*/
           
           $query="select * from usuarios where usuario=? or correo=?";
           
           $result= $this->db->prepare($query);
           
           $result->bindValue(1,$usuario);
           $result->bindValue(2,$correo);
           
              if(!$result->execute()){
                 
                   header("Location:usuarios.php?accion=add_usuario&m=2");
              }else {
                  
                  if($result->rowCount()>0){
                      
                      while($reg=$result->fetch()){
                          
                          $usuario_bd=$reg["usuario"];
                          $correo_bd=$reg["correo"];
                      }
                      
                       if($usuario_bd == $_POST["usuario"]){
                          
                            /*existe el usuario en la bd*/
                            header("Location:usuarios.php?accion=add_usuario&m=13");
                       
                       } elseif($correo_bd == $_POST["correo"]){
                           
                           /*existe el correo en la bd*/
                           header("Location:usuarios.php?accion=add_usuario&m=7"); 
                       }
                     
                    
                      
                  } else {
                      
                      /*inserta el registro*/
                     
                      /*encriptamos el password*/
                      $password=$_POST["password"];
                      
                      $pass_encriptado= password_hash($password,PASSWORD_DEFAULT);


                       $sql="insert into usuarios values(null,?,?,?,?,?,'imagen',?,'0')";

                       $resultado= $this->db->prepare($sql);

                       $resultado->bindValue(1,$_POST["usuario"]);
                       $resultado->bindValue(2,$pass_encriptado);
                       $resultado->bindValue(3,$_POST["nombre"]);
                       $resultado->bindValue(4,$_POST["apellido"]);
                       $resultado->bindValue(5,$_POST["correo"]);
                       $resultado->bindValue(6,$_POST["rol"]);
                       //$resultado->bindValue(7,$_POST["imagen"]);


                         if(!$resultado->execute()){

                             header("Location:usuarios.php?accion=add_usuario&m=2");

                         }else {

                              /*insertamos el registro*/
                              if($resultado->rowCount()>0){

                                   header("Location:usuarios.php?accion=add_usuario&m=3");   

                              }else{
                                 header("Location:usuarios.php?accion=add_usuario&m=4");  
                              }
                         } 

               }
          }
                 
         }/*cierre del else de la condicional de si los campos no estan vacios y si se cumple el formato del password*/
           
    }//cierre de la function
      
      
      public function get_usuario_por_id($id_usuario){
          
           
           $sql="select * from usuarios where id_usuario=?";
          
           $resultado=$this->db->prepare($sql);
          
           $resultado->bindValue(1, $id_usuario);
          
             if(!$resultado->execute()){
                 
                 header("Location:usuarios.php?m=8");
             
             }else{
                  /*existe el registro del usuario*/
                  if($resultado->rowCount()>0){
                      
                      while($reg=$resultado->fetch()){
                          
                          $this->usuario_por_id[]=$reg;
                      }
                      
                      return $this->usuario_por_id;
                  
                  }else{
                     
                      header("Location:usuarios.php?m=5");
                  }
             }
          
      }
      
      
        public function editar_usuario($id_usuario,$nombre,$apellido,$imagen,$rol){
           
          
           /*validamos que los campos no esten vacios*/
              if(empty($_POST["nombre"]) or empty($_POST["apellido"]) or empty($_POST["rol"])){
                 
                 header("Location:usuarios.php?accion=edit_usuario&id_usuario=$id_usuario&m=1");
                 exit();
             }
            
        
                   $sql="update usuarios set

                     nombre=?,
                     apellido=?,
                     imagen='imagen',
                     rol=?
                     where 
                     id_usuario=?


                   ";

                    /*$usuario_imagen= $_FILES["entrada_imagen"]["name"]; 
                    $usuario_imagen_temp=$_FILES["entrada_imagen"]["tmp_name"];
                    move_uploaded_file($usuario_imagen_temp,"../images/$usuario_imagen");*/

                    /*validando la imagen*/
                    /*if(empty($usuario_imagen)){

                       $usuario_imagen= $_POST["archivo"];  

                     }*/


                   $resultado= $this->db->prepare($sql);

                   $resultado->bindValue(1,$_POST["nombre"]);
                   $resultado->bindValue(2,$_POST["apellido"]);
                   //$resultado->bindValue(4,$entrada_imagen);
                   $resultado->bindValue(3,$_POST["rol"]);
                   $resultado->bindValue(4,$_GET["id_usuario"]);

                     if(!$resultado->execute()){

                         header("Location:usuarios.php?accion=edit_usuario&id_usuario=$id_usuario&m=2");

                     }else {

                          /*se edita el registro*/
                          if($resultado->rowCount()>0){

                               header("Location:usuarios.php?accion=edit_usuario&id_usuario=$id_usuario&m=3");   

                          }else{
                             header("Location:usuarios.php?accion=edit_usuario&id_usuario=$id_usuario&m=4");  
                          }
                     } 
                      
       }
      
      
      
         public function eliminar_usuario($id_usuario){
             
               $sql="select * from usuarios where id_usuario=?"; 
             
                $resultado= $this->db->prepare($sql);
             
                $resultado->bindValue(1,$id_usuario);
             
                  if(!$resultado->execute()){
                      
                      header("Location:usuarios.php?m=8");
                  
                  }else{
                      /*existe el id del registro*/ 
                      if($resultado->rowCount()>0){
                          
                          /*eliminamos el registro de la entrada*/
                          
                          $sql="delete from usuarios where id_usuario=?";
                          
                          $resultado= $this->db->prepare($sql);
                          $resultado->bindValue(1,$id_usuario);
                          
                            if(!$resultado->execute()){
                                
                                 header("Location:usuarios.php?m=8");
                                
                            }else{
                                
                                if($resultado->rowCount()>0){
                                    
                                     header("Location:usuarios.php?m=6");
                                }else{
                                    
                                   header("Location:usuarios.php?m=5"); 
                                }
                            }
                          
                      }else{
                          /*no existe el id del registro*/
                         header("Location:usuarios.php?m=5"); 
                      }
                  }
         }
      
      
           public function get_entrada_por_id_comentario($id_entrada){
             
                    
                             $sql="select * from entradas where id_entrada=?"; 
                                                     
                            
                              $resultado=$this->db->prepare($sql);
                                                     
                              $resultado->bindValue(1,$id_entrada);
                                                     
                                if(!$resultado->execute()){
                                   
                                   header("Location:comentarios.php?m=2");
                                
                                }else{
                                    
                                    if($resultado->rowCount()>0){
                                       
                                        while($reg=$resultado->fetch()){
                                           
                                        $id_entrada=$reg["id_entrada"];
                                         $entrada_titulo=$reg["entrada_titulo"];
                                            
                                            echo "<td><a href='../entrada.php?id_entrada=$id_entrada' >$entrada_titulo</a></td>";
                                        }
                                    }
                      }
             
         }
      
      
            public function cambiar_a_administrador($id_usuario){
             
               $sql="select * from usuarios where id_usuario=?"; 
             
                $resultado= $this->db->prepare($sql);
             
                $resultado->bindValue(1,$id_usuario);
             
                  if(!$resultado->execute()){
                      
                      header("Location:usuarios.php?m=8");
                  
                  }else{
                      /*existe el id del registro*/ 
                      if($resultado->rowCount()>0){
                          
                          /*editamos el registro*/
                          
                          $sql="update usuarios set 
                          
                            rol='administrador'
                            where id_usuario=?
                          
                          ";
                          
                          $resultado= $this->db->prepare($sql);
                          $resultado->bindValue(1,$id_usuario);
                          
                            if(!$resultado->execute()){
                                
                                 header("Location:usuarios.php?m=8");
                                
                            }else{
                                
                                if($resultado->rowCount()>0){
                                    
                                     header("Location:usuarios.php?m=9");
                                }else{
                                    
                                   header("Location:usuarios.php?m=11"); 
                                }
                            }
                          
                      }else{
                          /*no existe el id del registro*/
                         header("Location:usuarios.php?m=5"); 
                      }
                  }
         }
      
        
         public function cambiar_a_suscriptor($id_usuario){
             
               $sql="select * from usuarios where id_usuario=?"; 
             
                $resultado= $this->db->prepare($sql);
             
                $resultado->bindValue(1,$id_usuario);
             
                  if(!$resultado->execute()){
                      
                      header("Location:usuarios.php?m=8");
                  
                  }else{
                      /*existe el id del registro*/ 
                      if($resultado->rowCount()>0){
                          
                          /*editamos el registro del usuario*/
                          
                          $sql="update usuarios set 
                          
                            rol='suscriptor'
                            where id_usuario=?
                          
                          ";
                          
                          $resultado= $this->db->prepare($sql);
                          $resultado->bindValue(1,$id_usuario);
                          
                            if(!$resultado->execute()){
                                
                                 header("Location:usuarios.php?m=8");
                                
                            }else{
                                
                                if($resultado->rowCount()>0){
                                    
                                     header("Location:usuarios.php?m=10");
                                }else{
                                    
                                   header("Location:usuarios.php?m=11"); 
                                }
                            }
                          
                      }else{
                          /*no existe el id del registro*/
                         header("Location:usuarios.php?m=5"); 
                      }
                  }
         }
      
         
          public function get_perfil_por_id($id_usuario){
          
           
           $sql="select * from usuarios where id_usuario=?";
          
           $resultado=$this->db->prepare($sql);
          
           $resultado->bindValue(1, $id_usuario);
          
             if(!$resultado->execute()){
                 
                 header("Location:perfil.php?m=2");
             
             }else{
                  /*existe el registro del usuario*/
                  if($resultado->rowCount()>0){
                      
                      while($reg=$resultado->fetch()){
                          
                          $this->usuario_por_id[]=$reg;
                      }
                      
                      return $this->usuario_por_id;
                  
                  }else{
                     
                      header("Location:perfil.php?m=5");
                  }
             }
          
      }
      
      public function editar_perfil($id_usuario,$usuario,$password,$nombre,$apellido,$imagen,$rol,$idd){
           
          
           /*validamos que los campos no esten vacios*/
              if(empty($_POST["nombre"]) or empty($_POST["apellido"]) or empty($_POST["rol"]) or empty($_POST["usuario"]) or empty($_POST["password"]) or empty($idd)){
                 
                 header("Location:perfil.php?m=1");
                 exit();
             }
          
              /*encriptamos el password*/
              $password=$_POST["password"];

              $pass_encriptado= password_hash($password,PASSWORD_DEFAULT);
              
           $sql="update usuarios set
           
             usuario=?,
             password=?,
             nombre=?,
             apellido=?,
             imagen='imagen',
             rol=?,
             idd=?
             where 
             id_usuario=?
           
           
           ";
            
            /*$usuario_imagen= $_FILES["entrada_imagen"]["name"]; 
            $usuario_imagen_temp=$_FILES["entrada_imagen"]["tmp_name"];
            move_uploaded_file($usuario_imagen_temp,"../images/$usuario_imagen");*/
            
            /*validando la imagen*/
            /*if(empty($usuario_imagen)){
                 
               $usuario_imagen= $_POST["archivo"];  
                
             }*/
           
           
           $resultado= $this->db->prepare($sql);

           $resultado->bindValue(1,$_POST["usuario"]);
           $resultado->bindValue(2,$pass_encriptado);
           $resultado->bindValue(3,$_POST["nombre"]);
           $resultado->bindValue(4,$_POST["apellido"]);
           //$resultado->bindValue(4,$entrada_imagen);
           $resultado->bindValue(5,$_POST["rol"]);
           $resultado->bindValue(6,$idd);
           $resultado->bindValue(7,$_SESSION["id_usuario"]);
           
          //  $resultado->bindValue(1,$_POST["usuario"]);
          //  $resultado->bindValue(2,$pass_encriptado);
          //  $resultado->bindValue(3,$_POST["nombre"]);
          //  $resultado->bindValue(4,$_POST["apellido"]);
          //  //$resultado->bindValue(4,$entrada_imagen);
          //  $resultado->bindValue(5,$_POST["rol"]);
          //  $resultado->bindValue(6,$_SESSION["id_usuario"]);          
           
             if(!$resultado->execute()){
                  
                 header("Location:perfil.php?m=2");
             
             }else {
                  
                  /*se edita el registro*/
                  if($resultado->rowCount()>0){
                      
                       header("Location:perfil.php?m=3");   
                  
                  }else{
                     header("Location:perfil.php?m=4");  
                  }
             }  
       } 
      
       public function get_numero_usuarios(){
          
          $sql="select * from usuarios"; 
          
          $resultado=$this->db->prepare($sql);
          
            if(!$resultado->execute()){
              
                header("Location:index.php?m=2");
            
            }else{
                
                 return $resultado->rowCount();
            }
           
       }
      
       public function get_numero_usuarios_suscriptor(){
          
          $sql="select * from usuarios where rol='suscriptor'"; 
          
          $resultado=$this->db->prepare($sql);
          
            if(!$resultado->execute()){
              
                header("Location:index.php?m=2");
            
            }else{
                
                 return $resultado->rowCount();
            }
           
       }
      
      public function registrar_usuario($usuario,$password,$nombre,$apellido,$correo){
           
          
           /*validamos que los campos no esten vacios*/
             if(empty($_POST["nombre"]) and empty($_POST["apellido"]) and empty($_POST["usuario"]) and empty($_POST["correo"]) and empty($_POST["password"])){
                 
                 header("Location:registrar.php?m=1");
                 exit();
             }
           
           /*el formato del password debe tener al menos una letra mayúscula, una letra minúscula, un caracter extraño y un número, por ejemplo en este proyecto lo tengo $Qw/*12345678$ no importa el orden lo importante es que se cumple el formato*/
                 
                 /*si no se cumpla esta expresion regular con un formato del password de que al menos tenga una letra mayúscula, una letra minúscula, un caracter extraño y un número y que sean minimo 12 caracteres*/
                 else if(!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])([A-Za-z\d$@$!%*?&]|[^ ]){12,15}$/", $_POST["password"])) {

                     header("Location:registrar.php?m=6");

            }

             else {
              /*entonces si los campos no estan vacios y si se cumple el formato del password entonces validamos si existe el correo en la base de datos*/
           
           /*validamos que el usuario y correo no existan en la base de datos*/
           $query="select * from usuarios where usuario=? or correo=?";
           
           $result= $this->db->prepare($query);
           
           $result->bindValue(1,$usuario);
           $result->bindValue(2,$correo);
                 
           
              if(!$result->execute()){
                 
                   header("Location:registrar.php?m=2");
              }else {
                  
                  /*existe el usuario o el correo en la bd por lo tanto no se registrar el usuario*/
                  if($result->rowCount()>0){
                     
                      /*recorremos los registros para obtener el usuario y correo de la bd para compararlos con los que ingresa el usuario para ver si existen, si no existen entonces se registra el usuario*/
                       while($reg=$result->fetch()){
                          
                          $usuario_bd=$reg["usuario"];
                          $correo_bd=$reg["correo"];
                      }
                      
                       if($usuario_bd == $_POST["usuario"]){
                          
                            /*existe el usuario en la bd*/
                            header("Location:registrar.php?m=7");
                       
                       } elseif($correo_bd == $_POST["correo"]){
                           
                           /*existe el correo en la bd*/
                           header("Location:registrar.php?m=5"); 
                       }
                      
                        
                  } else {
                      
                      /*inserta el registro*/
                     
                      /*encriptamos el password*/
                      $password=$_POST["password"];
                      
                      $pass_encriptado= password_hash($password,PASSWORD_DEFAULT);


                       $sql="insert into usuarios values(null,?,?,?,?,?,'imagen','suscriptor','0')";

                       $resultado= $this->db->prepare($sql);

                       $resultado->bindValue(1,$_POST["usuario"]);
                       $resultado->bindValue(2,$pass_encriptado);
                       $resultado->bindValue(3,$_POST["nombre"]);
                       $resultado->bindValue(4,$_POST["apellido"]);
                       $resultado->bindValue(5,$_POST["correo"]);
                       

                         if(!$resultado->execute()){

                             header("Location:registrar.php?m=2");

                         }else {

                              /*insertamos el registro*/
                              if($resultado->rowCount()>0){

                                   header("Location:registrar.php?m=3");   

                              }else{
                                 header("Location:registrar.php?m=4");  
                              }
                         } 

               }
          }
                 
         }/*cierre del else de la condicional de si los campos no estan vacios y si se cumple el formato del password*/
           
    }//cierre de la function
      
       
       public function usuarios_online(){
        
           
           $session = session_id();
           $time= time();
           $time_out_in_seconds=30;
           $time_out= $time - $time_out_in_seconds;
           
           
            $sql="select * from usuarios_online where session=?";
            
            $resultado=$this->db->prepare($sql);
           
            $resultado->bindValue(1,$session);
           
              if(!$resultado->execute()){

                 echo "<h2 style='color:red'>Fallo en la consulta</h2>";
                

                }else {
                     
                    $count= $resultado->rowCount();
                }
           
           /**************************************************/
           
           if($count==0){
           
               /*si nadie esta online entonces inserta el $session y el $time*/


                $sql="insert into usuarios_online
                values(null,?,?)";

                $resultado=$this->db->prepare($sql);

                $resultado->bindValue(1,$session);
                $resultado->bindValue(2,$time);

                    if(!$resultado->execute()){

                      echo "<h2 style='color:red'>Fallo en la consulta</h2>";

                    }
               
           
             } else {
           
                   $sql="update usuarios_online set

                     time=?
                     where 
                     session=?
                    ";

                    $resultado=$this->db->prepare($sql);

                    $resultado->bindValue(1,$time);
                    $resultado->bindValue(2,$session);

                        if(!$resultado->execute()){

                          echo "<h2 style='color:red'>Fallo en la consulta</h2>";

                        }
               
           }

           /***************************************************/
           
            $sql="select * from usuarios_online where time > ?";
            
            $resultado=$this->db->prepare($sql);
           
            $resultado->bindValue(1,$time_out);
           
              if(!$resultado->execute()){

                  echo "<h2 style='color:red'>Fallo en la consulta</h2>";

                }else {
                     
                    return $resultado->rowCount();
                } 
        }
      
        /*validamos si existe un correo en la tabla usuarios de la bd para resetear el password*/
         public function get_correo_en_bd($correo,$token){
          
           
           $sql="select * from usuarios where correo=?";
          
           $resultado=$this->db->prepare($sql);
          
           $resultado->bindValue(1,$correo);
          
             if(!$resultado->execute()){
                 
                 echo "<h2 class='text-center' style='color:red'>Fallo en la consulta</h2>";
                 
             }else{
                  /*existe el correo*/
                  if($resultado->rowCount()>0){
                      
                      
                          /*editamos el token*/
                          $sql="update usuarios set 

                             token=?
                             where
                             correo=?

                           ";

                           $resultado=$this->db->prepare($sql);

                           $resultado->bindValue(1,$token);
                           $resultado->bindValue(2,$correo);

                             if(!$resultado->execute()){

                                  echo "<h2 class='text-center' style='color:red'>Fallo en la consulta</h2>";
                                  
                            
                             } else {
                                 
                                  /*COMENZAR - enviamos el correo*/
                                  /*IMPORTANTE: CUANDO VAYAS A SUBIR EL PROYECTO AL HOSTING PONER EL NOMBRE DEL DOMINIO DEL HOSTING EN EL href del ancla href='http://tudominio.com/ que se encuentra en $cuerpo*/

                                    $to         = $correo;
                                    $asunto   = "Proyecto CMS, resetear password";
                                    $cuerpo       = "
                                    
                                        <html> 
                                        <head> 
                                        <title></title> 
                                        </head> 
                                        <body> 
                                        
                                        <h1 style='color:black'>PROYECTO CMS</h1>
                                    
                                        <p>Por favor dar click en el link para resetear el password
                                    
                                         <a href='https://sistemas.mininterior.gob.ar/noticias/resetear.php?correo=".$correo."&token=".$token."'> 
                                         https://sistemas.mininterior.gob.ar/noticias/resetear.php?correo=".$correo."&token=".$token."</a>
                                    
                                    
                                         </p>
                                    
                                        </body> 
                                        </html> 
                                   
                                   ";
                                   
                                       //para el envío en formato HTML 
                                       $cabeceras = "MIME-Version: 1.0\r\n"; 
                                       $cabeceras .= "Content-type: text/html; charset=iso-8859-1\r\n"; 

                                        /*validando el envio del correo*/
                                         if(mail($to,$asunto,$cuerpo,$cabeceras)){
                                             
                                            $correo_enviado = true;

                                            echo "<h2 class='text-center' style='color:green'>Se ha enviado un correo, por favor dar click en el link para resetear el password</h2>"; 
                                             
                                            exit();
                                 
                                         }else {

                                            echo "<h2 class='text-center' style='color:red'>No se envió el correo</h2>";  
                                         }  
  
                                     /*FIN - enviamos el correo*/
                                 
                             }
                      
                  
                  }else{
                     /*no existe el correo en la bd*/
                      echo "<h2 class='text-center' style='color:red'>El correo ingresado no existe en la base de datos</h2>";
                  }
             }
          
      }
      
      
        public function login($correo,$password){
            
              
              $correo=htmlentities(addslashes($_POST["correo"]));
              $password=htmlentities(addslashes($_POST["password"]));
              
               /*validamos que los campos no esten vacíos*/
               if(empty($correo) and empty($password)){

                  echo "<h2 class='text-center'style='color:red'>Los campos estan vacíos</h2>";


                }
                 /*el formato del password al menos una letra mayúscula, una letra minúscula, un caracter extraño y un número, por ejemplo en este proyecto lo tengo $Qw/*12345678$ no importa el orden lo importante es que se cumple el formato*/
                 
                 /*si no se cumpla esta expresion regular con un formato del password de que al menos tenga una letra mayúscula, una letra minúscula, un caracter extraño y un número y que sean minimo 12 caracteres*/
                 else if(!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])([A-Za-z\d$@$!%*?&]|[^ ]){12,15}$/", $password)) {

                     echo "<h2 class='text-center' style='color:red'>El password no existe en la base de datos</h2>";

            }

             else {
              
              /*entonces si los campos no estan vacios y si se cumple el formato del password entonces validamos si existe el correo en la base de datos*/
              
            
              $sql="select * from usuarios where correo=?";
              
              $resultado= $this->db->prepare($sql);
              
              $resultado->bindValue(1,$correo);
              
                if(!$resultado->execute()){
                   
                    echo "<h2 class='text-center' style='color:red'>fallo en la consulta</h2>";
               
                } else {
                    
                     /*existe el correo en la bd*/
                    
                      if($resultado->rowCount()>0){
                          
                          while($reg=$resultado->fetch()){
                              
                              /*password de la tabla usuarios*/
                              $id_usuario= $reg["id_usuario"];
                              $usuario_bd= $reg["usuario"];
                              $password_bd = $reg["password"];
                              $nombre_bd = $reg["nombre"];
                              $correo_bd = $reg["correo"];
                              $rol_bd = $reg["rol"];
                          }
                          
                           /*verificamos que el password que ingresa el usuario sea igual al de la tabla usuarios*/
                          
                           if(password_verify($password,$password_bd)){
                                
                               /*si coinciden entonces me redirecciona al admin*/
                                 $_SESSION["id_usuario"]=$id_usuario;
                                 $_SESSION["usuario"]=$usuario_bd;
                                 $_SESSION["nombre"]=$nombre_bd;
                                 $_SESSION["correo"]=$correo_bd;
                                 $_SESSION["rol"]=$rol_bd;
                               
                                 header("Location:admin/index.php");
                          
                           }else{
                               
                                echo "<h2 class='text-center' style='color:red'>El password no existe en la base de datos</h2>";
                           }
                          
                      } else {
                          
                           echo "<h2 class='text-center' style='color:red'>El correo no existe en la base de datos</h2>";
                      }
                }
         
             }/*cierre del else de la condicional de si los campos no estan vacios y si se cumple el formato del password*/
        }
        
        
  }


?>