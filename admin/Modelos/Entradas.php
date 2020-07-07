<?php

  class Entradas extends Conectar{
      
    private $db;  
    private $entradas; 
    private $entrada_por_id;
    
      
      public function __construct(){
          
        $this->db= Conectar::conexion();   
        $this->entradas=array();  
        $this->entrada_por_id=array(); 
        
      } 
      
      
      public function get_entradas(){
          
          $sql="select * from entradas order by id_entrada DESC"; 
          
          $resultado=$this->db->prepare($sql);
          
            if(!$resultado->execute()){
              
                header("Location:index.php?m=1");
            
            }else{
                
                 while($reg=$resultado->fetch()){
                     
                      $this->entradas[]=$reg;  
                 }
                
                return $this->entradas;
            }
          
      }
      
       public function get_ultimas_entradas(){
          
          $sql="select * from entradas where entrada_status='publicado' order by id_entrada DESC LIMIT 10"; 
          
          $resultado=$this->db->prepare($sql);
          
            if(!$resultado->execute()){
              
                echo "<h2 style='color:red'>Fallo en la consulta</h2>";
            
            }else{
                
                 while($reg=$resultado->fetch()){
                     
                      $id_entrada=$reg["id_entrada"];
                      $entrada_titulo=$reg["entrada_titulo"];
                     
                       echo "<li><a href='entrada.php?id_entrada= $id_entrada'>$entrada_titulo</a></li>";
                     
                 }
                
            }
          
      }
      
       public function insertar_entrada($id_categoria_entrada,$entrada_titulo,$entrada_imagen,$entrada_contenido,$entrada_etiquetas,$entrada_comment_count,$entrada_status){
                     
           /*validamos que los campos no esten vacios*/
             if(empty($_POST["entrada_titulo"]) or empty($_POST["entrada_categoria"]) or empty($_POST["entrada_status"]) or empty($_FILES["entrada_imagen"]) or empty($_POST["entrada_etiquetas"])or empty($_POST["entrada_contenido"])){
                 
                 header("Location:entradas.php?accion=add_entrada&m=1");
                 exit();
             }
                         
           //$sql="insert into entradas values(null,?,?,?,now(),?,?,?,0,?)";           
           $sql="insert into entradas(id_entrada, id_categoria_entrada, entrada_titulo, entrada_autor, entrada_imagen, entrada_contenido, entrada_etiquetas, entrada_status, entrada_comment_count, entrada_views_count, entrada_fecha) 
                values(NULL, :id_categoria_entrada, :entrada_titulo, :entrada_autor, :entrada_imagen, :entrada_contenido, :entrada_etiquetas, :entrada_status,0,0,now())";
        //$sql="INSERT INTO `entradas` (`id_entrada`, `id_categoria_entrada`, `entrada_titulo`, `entrada_autor`, `entrada_fecha`, `entrada_imagen`, `entrada_contenido`, `entrada_etiquetas`, `entrada_comment_count`, `entrada_status`, `entrada_views_count`) VALUES (NULL, '1', 'Video 1 - Java 3', 'ucevito', '2018-07-16', 'java.jpg', 'buen curso de java. Lorem ipsum dolor sit amet consectetur adipiscing elit, felis conubia magnis aliquet laoreet magna, natoque libero integer ligula donec quis. Donec curae placerat class mauris pharetra cursus inceptos scelerisque, feugiat maecenas morbi tortor vitae duis aliquet dapibus ligula, penatibus libero hendrerit dictumst ullamcorper taciti cras. Hac curae sagittis tincidunt pharetra pulvinar sapien mus nulla accumsan at, tempus interdum scelerisque suscipit laoreet nisl mattis semper quis, habitasse proin montes conubia ultricies imperdiet facilisis venenatis urna. \r\n ', 'java', '0', 'publicado', '4');";        

           $resultado= $this->db->prepare($sql);
           $resultado->bindValue(':id_categoria_entrada',$_POST["entrada_categoria"]);
           $resultado->bindValue(':entrada_titulo',$_POST["entrada_titulo"]);
           $resultado->bindValue(':entrada_autor',$_SESSION["usuario"]);
           $resultado->bindValue(':entrada_imagen',"https://sistemas.mininterior.gob.ar/noticias/images/".$_FILES["entrada_imagen"]["name"]);
           $resultado->bindValue(':entrada_contenido',$_POST["entrada_contenido"]);
           $resultado->bindValue(':entrada_etiquetas',$_POST["entrada_etiquetas"]);           
           $resultado->bindValue(':entrada_status',$_POST["entrada_status"]);        
           
          //  $resultado->bindValue(1,$_POST["entrada_categoria"]);
          //  $resultado->bindValue(2,$_POST["entrada_titulo"]);
          //  $resultado->bindValue(3,$_SESSION["usuario"]);
          //  $resultado->bindValue(4,$_FILES["entrada_imagen"]["name"]);
          //  $resultado->bindValue(5,$_POST["entrada_contenido"]);
          //  $resultado->bindValue(6,$_POST["entrada_etiquetas"]);
          //  //$resultado->bindValue(7,$_POST["entrada_comment_count"]);
          //  $resultado->bindValue(7,$_POST["entrada_status"]);
           
             if(!$resultado->execute()){
                  
                 header("Location:entradas.php?accion=add_entrada&m=2");
             
             }else {
                  
                  /*insertamos el registro*/
                  if($resultado->rowCount()>0){
                      
                      //se insertó el registro
                       header("Location:entradas.php?accion=add_entrada&m=3");  
                          
                  }else{
                     header("Location:entradas.php?accion=add_entrada&m=4");  
                  }
             } 
           
       }
      
      
      public function get_entrada_por_id($id_entrada){
          
           
           $sql="select * from entradas where id_entrada=?";
          
           $resultado=$this->db->prepare($sql);
          
           $resultado->bindValue(1, $id_entrada);
          
             if(!$resultado->execute()){
                 
                 header("Location:entradas.php?m=2");
             
             }else{
                  /*existe el registro de la entrada*/
                  if($resultado->rowCount()>0){
                      
                      while($reg=$resultado->fetch()){
                          
                          $this->entrada_por_id[]=$reg;
                      }
                      
                      return $this->entrada_por_id;
                  
                  }else{
                     
                      header("Location:entradas.php?m=5");
                  }
             }
          
      }
      
      
        public function editar_entrada($id_entrada,$id_categoria_entrada,$entrada_titulo,$entrada_imagen,$entrada_contenido,$entrada_etiquetas,$entrada_status){
           
          
           /*validamos que los campos no esten vacios*/
             if(empty($_POST["entrada_titulo"]) or empty($_POST["entrada_categoria"]) or empty($_POST["entrada_status"]) or  empty($_POST["entrada_etiquetas"])or empty($_POST["entrada_contenido"])){
                 
                 header("Location:entradas.php?accion=edit_entrada&id_entrada=$id_entrada&m=1");
                 exit();
             }
           
           $sql="update entradas set
           
             id_categoria_entrada=?,
             entrada_titulo=?,
             entrada_autor=?,
             entrada_fecha=now(),
             entrada_imagen=?,
             entrada_contenido=?,
             entrada_etiquetas=?,
             entrada_status=?
             where 
             id_entrada=?
           
           
           ";
            
            $entrada_imagen= $_FILES["entrada_imagen"]["name"]; 
            $entrada_imagen_temp=$_FILES["entrada_imagen"]["tmp_name"];
            move_uploaded_file($entrada_imagen_temp,"../images/$entrada_imagen");
            
            /*validando la imagen*/
            if(empty($entrada_imagen)){
                 
               $entrada_imagen= $_POST["archivo"];  
                
             }
           
           
           $resultado= $this->db->prepare($sql);
           
           $resultado->bindValue(1,$_POST["entrada_categoria"]);
           $resultado->bindValue(2,$_POST["entrada_titulo"]);
           $resultado->bindValue(3,$_SESSION["usuario"]);
           $resultado->bindValue(4,$entrada_imagen);
           $resultado->bindValue(5,$_POST["entrada_contenido"]);
           $resultado->bindValue(6,$_POST["entrada_etiquetas"]);
           //$resultado->bindValue(7,$_POST["entrada_comment_count"]);
           $resultado->bindValue(7,$_POST["entrada_status"]);
           $resultado->bindValue(8,$_GET["id_entrada"]);
           
             if(!$resultado->execute()){
                  
                 header("Location:entradas.php?accion=edit_entrada&id_entrada=$id_entrada&m=2");
             
             }else {
                  
                  /*se edita el registro*/
                  if($resultado->rowCount()>0){
                      
                      
                       header("Location:entradas.php?accion=edit_entrada&id_entrada=$id_entrada&m=3");  
                  
                  }else{
                     header("Location:entradas.php?accion=edit_entrada&id_entrada=$id_entrada&m=4");  
                  }
             }  
       }
      
         public function eliminar_entrada($id_entrada){
             
               $sql="select * from entradas where id_entrada=?"; 
             
                $resultado= $this->db->prepare($sql);
             
                $resultado->bindValue(1,$id_entrada);
             
                  if(!$resultado->execute()){
                      
                      header("Location:entradas.php?m=2");
                  
                  }else{
                      /*existe el id del registro*/ 
                      if($resultado->rowCount()>0){
                          
                          /*eliminamos el registro de la entrada*/
                          
                          $sql="delete from entradas where id_entrada=?";
                          
                          $resultado= $this->db->prepare($sql);
                          $resultado->bindValue(1,$id_entrada);
                          
                            if(!$resultado->execute()){
                                
                                 header("Location:entradas.php?m=2");
                                
                            }else{
                                
                                if($resultado->rowCount()>0){
                                    
                                     header("Location:entradas.php?m=6");
                                }else{
                                    
                                   header("Location:entradas.php?m=5"); 
                                }
                            }
                          
                      }else{
                          /*no existe el id del registro*/
                         header("Location:entradas.php?m=5"); 
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
      
      
      public function get_numero_entradas(){
          
          $sql="select * from entradas"; 
          
          $resultado=$this->db->prepare($sql);
          
            if(!$resultado->execute()){
              
                header("Location:index.php?m=2");
            
            }else{
                
                 return $resultado->rowCount();
            }
          
      }
      
      
      public function get_numero_entradas_publicadas(){
          
          $sql="select * from entradas where entrada_status='publicado'"; 
          
          $resultado=$this->db->prepare($sql);
          
            if(!$resultado->execute()){
              
                header("Location:index.php?m=2");
            
            }else{
                
                 return $resultado->rowCount();
            }
          
      }
      
      
       public function get_numero_entradas_borrador(){
          
          $sql="select * from entradas where entrada_status='borrador'"; 
          
          $resultado=$this->db->prepare($sql);
          
            if(!$resultado->execute()){
              
                header("Location:index.php?m=2");
            
            }else{
                
                 return $resultado->rowCount();
            }
          
      }
      
       public function editar_status($id_entrada,$entrada_status){
           
          
           
           $sql="update entradas set
           
             entrada_status=?
             where 
             id_entrada=?
              
           ";
           
           
           $resultado= $this->db->prepare($sql);
           
           $resultado->bindValue(1,$_POST["bulk_opciones"]);
           $resultado->bindValue(2,$id_entrada);
           
             if(!$resultado->execute()){
                  
                 header("Location:entradas.php?m=2");
             
             }else {
                  
                  /*se edita la entrada del status*/
                  if($resultado->rowCount()>0){
                      
                      if($entrada_status=="publicado"){
                          
                          header("Location:entradas.php?m=7");  
                      
                      } else {
                         /*se ha cambiado el status a borrador*/  
                         header("Location:entradas.php?m=8");   
                      }
                      
                        
                  
                  }else{
                      /*no se ha cambiado el status*/
                     header("Location:entradas.php?m=9");
                      
                      
                  }
             }  
       }
      
      
          public function clonar_entrada($id_categoria_entrada,$entrada_titulo,$entrada_autor,$entrada_fecha,$entrada_imagen,$entrada_contenido,$entrada_etiquetas,$entrada_comment_count,$entrada_status,$entrada_views_count){
          
              
           
           $sql="insert into entradas values(null,?,?,?,?,?,?,?,?,?,?)";
           
           
           $resultado= $this->db->prepare($sql);
           
           $resultado->bindValue(1,$id_categoria_entrada);
           $resultado->bindValue(2,$entrada_titulo);
           $resultado->bindValue(3,$entrada_autor);
           $resultado->bindValue(4,$entrada_fecha);
           $resultado->bindValue(5,$entrada_imagen);
           $resultado->bindValue(6,$entrada_contenido);
           $resultado->bindValue(7,$entrada_etiquetas);
           $resultado->bindValue(8,$entrada_comment_count);
           $resultado->bindValue(9,$entrada_status);
           $resultado->bindValue(10,$entrada_views_count);   
           
             if(!$resultado->execute()){
                  
                 header("Location:entradas.php?m=2");
             
             }else {
                  
                  /*clonamos el registro*/
                  if($resultado->rowCount()>0){
                      
                      //se clonó el registro
                       header("Location:entradas.php?m=10");  
                          
                  }else{
                      
                     /*No se han clonado los registros*/
                     header("Location:entradas.php?m=11");  
                  }
             } 
           
       }
      
      
        public function resetear_vistas_entrada($id_entrada){
             
               $sql="select * from entradas where id_entrada=?"; 
             
                $resultado= $this->db->prepare($sql);
             
                $resultado->bindValue(1,$id_entrada);
             
                  if(!$resultado->execute()){
                      
                      header("Location:entradas.php?m=2");
                  
                  }else{
                      /*existe el id del registro*/ 
                      if($resultado->rowCount()>0){
                          
                          /*reseteamos el registro de la entrada*/
                          
                          $sql="update entradas set entrada_views_count=0 where id_entrada=?";
                          
                          $resultado= $this->db->prepare($sql);
                          $resultado->bindValue(1,$id_entrada);
                          
                            if(!$resultado->execute()){
                                
                                 header("Location:entradas.php?m=2");
                                
                            }else{
                                
                                if($resultado->rowCount()>0){
                                     
                                     /*se resetea las vistas de la entrada*/
                                     header("Location:entradas.php?m=12");
                                }else{
                                   
                                    /*no se reseteó la entrada*/
                                   header("Location:entradas.php?m=13"); 
                                }
                            }
                          
                      }else{
                          /*no existe el id del registro*/
                         header("Location:entradas.php?m=5"); 
                      }
                  }
         }
          
      
  }


?>