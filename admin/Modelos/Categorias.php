<?php

  class Categorias extends Conectar{
      
     private $db;
     private $categorias;
      
      
      public function __construct(){
          
          $this->db=Conectar::conexion();
          $this->categorias=array();
          
      }       
      
      public function get_categorias(){
          
          $conectar= $this->db;

          $sql="select * from categorias";
         
          $resultado= $conectar->prepare($sql);

           if(!$resultado->execute()){
               
               die("fallo en la consulta");
           
           } else{
               
               while($reg=$resultado->fetch()){
                   
                    $this->categorias[]=$reg;
               }
        
              return $this->categorias;
        }
                
      
      }
      
      
      public function insertar_categoria($cat_titulo){
          
           //print_r($_POST);exit();
          
            $cat_titulo=$_POST["cat_titulo"];
            
            if(empty($_POST["cat_titulo"])){
                
                header("Location:categorias.php?m=1");
                //exit();
                
            }else{
                
                /*validamos si existe la categoria en la base de datos*/
                
               $sql="select * from categorias where titulo=?";
                
               $resultado=$this->db->prepare($sql);
                
               $resultado->bindValue(1,$cat_titulo);
                
                 if(!$resultado->execute()){
                    
                     header("Location:categorias.php?m=2");
                     //exit();
                      
                 } else{
                     //existe el titulo de la categoria
                      if($resultado->rowCount()>0){
                         
                          header("Location:categorias.php?m=3");
                          //exit();
                      
                      } else{
                          


                           $sql="insert into categorias values(null,?)";

                           //echo $sql; exit(); 
                          
                           $resultado= $this->db->prepare($sql);
                          
                           $resultado->bindValue(1,$cat_titulo);

                              if(!$resultado->execute()){

                                   header("Location:categorias.php?m=2");
                                
                                   //exit();

                              } else{
                                

                                    if($resultado->rowCount()>0){

                                      
                                        header("Location:categorias.php?m=4");
                                        
                                

                                    } else {
                                        
                                        header("Location:categorias.php?m=5");
                                        
                                        //exit();
                                    }
                              }


                         }

                     }
              }
          
      }//CIERRE DE LA FUNCION INSERTAR CATEGORIA
      
      
        public function eliminar_categoria($id_categoria){
             
              
             /*validamos que exista el id_categoria en la base de datos*/
            
            $id_categoria=$_GET["eliminar"];
            
            $sql="select * from categorias where id_categoria=?";
            
            $resultado= $this->db->prepare($sql);
            
            $resultado->bindValue(1,$id_categoria);
            
              if(!$resultado->execute()){
                  
                  header("Location:categorias.php?m=2");
             
              }else {
                   
                   /*existe el id_categoria*/
                   if($resultado->rowCount()>0){
                       
                       $sql="delete from categorias where id_categoria=?";
                       
                       $resultado=$this->db->prepare($sql);
                       
                       $resultado->bindValue(1,$id_categoria);
                          
                          if(!$resultado->execute()){
                              
                              header("Location:categorias.php?m=2");
                         
                          } else{
                                /*se elimina la categoria*/
                               if($resultado->rowCount()>0){
                                   
                                  header("Location:categorias.php?m=6");  
                               }
                          }
                       
                   } else {
                       /*no existe el id de la categoria*/
                        header("Location:categorias.php?m=7");
                   }
              }
            
        }
      
      
        public function get_categoria_por_id($id_categoria){
            
             
              $sql="select * from categorias where id_categoria=?";
            
              $resultado=$this->db->prepare($sql);
            
              $resultado->bindValue(1,$id_categoria);
            
                if(!$resultado->execute()){
                    
                     header("Location:categorias.php?m=2");
                
                } else {
                     /*existe el id_categoria*/
                     if($resultado->rowCount()>0){
                          
                         while($reg=$resultado->fetch()){
                             
                              $cat_titulo=$reg["titulo"];
                             
                             echo "<input value='$cat_titulo' type='text' class='form-control' name='cat_titulo'>";
                         }
                         
                     }else {
                        
                         header("Location:categorias.php?m=7");
                        
                        }
                     }
        }
      
        
       public function editar_categoria($id_categoria,$cat_titulo){
           
           
             if(empty($_POST["cat_titulo"])){
               
            header("Location:categorias.php?editar=$id_categoria&m=1");
            exit();
                 
             } 
           
             /*valido que la categoria no exista en la base de datos*/
           
             $sql="select * from categorias where titulo=?";
           
             $resultado=$this->db->prepare($sql);
           
             $resultado->bindValue(1,$cat_titulo);
             
           
               if(!$resultado->execute()){
                    
                   header("Location:categorias.php?m=2");  
               
               }else{
                    /*existe la categoria en la bd*/
                   if($resultado->rowCount()>0){
                        
                        header("Location:categorias.php?editar=$id_categoria&m=3");  
                   
                   }else{
                       
                        
                        /*edito la categoria*/
                       
                        $sql="update categorias set 
                        
                        titulo=?
                         where 
                         id_categoria=?
                        
                        ";
                       
                        $resultado=$this->db->prepare($sql);
                       
                        $resultado->bindValue(1,$cat_titulo);
                        $resultado->bindValue(2,$id_categoria);
                       
                          if(!$resultado->execute()){
                              
                             header("Location:categorias.php?m=2");   
                              
                          }else{
                              
                               if($resultado->rowCount()>0){
                                   
                                    header("Location:categorias.php?editar=$id_categoria&m=8");
                               
                               }else {
                                   
                                   header("Location:categorias.php?editar=$id_categoria&m=9");
                                   
                               }
                          }
                           
                       
                   }
               }
               
           
           
       }
      
         public function get_categoria_por_id_entrada($id_categoria){
             
                    
                             $sql="select * from categorias where id_categoria=?"; 
                                                     
                            
                              $resultado=$this->db->prepare($sql);
                                                     
                              $resultado->bindValue(1,$id_categoria);
                                                     
                                if(!$resultado->execute()){
                                   
                                   header("Location:entradas.php?m=2");
                                
                                }else{
                                    
                                    if($resultado->rowCount()>0){
                                       
                                        while($reg=$resultado->fetch()){
                                           
                                            $cat_titulo=$reg["titulo"];
                                            
                                            echo "<td>$cat_titulo</td>";
                                        }
                                    }
                      }
             
         }
      
        public function get_numero_categorias(){
          
          $sql="select * from categorias"; 
          
          $resultado=$this->db->prepare($sql);
          
            if(!$resultado->execute()){
              
                header("Location:index.php?m=2");
            
            }else{
                
                 return $resultado->rowCount();
            }
           
       }
        
      
  }

?>