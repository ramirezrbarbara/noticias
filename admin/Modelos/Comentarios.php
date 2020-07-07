<?php

  class Comentarios extends Conectar{
      
    private $db;  
    private $comentarios; 
    private $comentario_por_id;
    private $comentarios_por_entrada; 
      
      public function __construct(){
          
        $this->db= Conectar::conexion();   
        $this->comentarios=array();  
        $this->comentario_por_id=array(); 
        $this->comentarios_por_entrada=array();
      } 
      
      
      public function get_comentarios(){
          
          $sql="select * from comentarios"; 
          
          $resultado=$this->db->prepare($sql);
          
            if(!$resultado->execute()){
              
                header("Location:index.php?m=1");
            
            }else{
                
                 while($reg=$resultado->fetch()){
                     
                      $this->comentarios[]=$reg;  
                 }
                
                return $this->comentarios;
            }
          
      }
      
      
         public function eliminar_comentario($id_comentario){
             
               $sql="select * from comentarios where id_comentario=?"; 
             
                $resultado= $this->db->prepare($sql);
             
                $resultado->bindValue(1,$id_comentario);
             
                  if(!$resultado->execute()){
                      
                      header("Location:comentarios.php?m=1");
                  
                  }else{
                      /*existe el id del registro*/ 
                      if($resultado->rowCount()>0){
                          
                          /*recorremos el registro para obtener el id_entrada y asi enviarlo a entrada_comentarios en la url para que se muestren la lista de comentarios de lo contrario no se mostraria*/
                          
                            while($reg=$resultado->fetch()){
                            
                                $id_entrada=$reg["id_entrada_comentario"];
                            }
                          
                          /*eliminamos el registro del comentario*/
                          
                          $sql="delete from comentarios where id_comentario=?";
                          
                          $resultado= $this->db->prepare($sql);
                          $resultado->bindValue(1,$id_comentario);
                          
                            if(!$resultado->execute()){
                                
                                 header("Location:comentarios.php?m=1");
                                
                            }else{
                                
                               
                                if($resultado->rowCount()>0){
                                    
                                   
                                    /*si existe el parametro eliminar entonces lo redirecciona a comentarios.php*/
                                      if(isset($_GET["eliminar"])){
                                           header("Location:comentarios.php?m=3");
                                          
                                      } elseif(isset($_POST["bulk_opciones"])){
                                         header("Location:comentarios.php?m=3"); 
                                      } 
                                    
                                    
                                      else{
                                           
                                         /*lo redicciona a entrada_comentarios.php ya que el parametro es eliminar_comentario y opciones en el select de entrada_comentarios.php*/ header("Location:entrada_comentarios.php?id_entrada=$id_entrada&m=1");
                                      }
                                    
                                    
                                }else{
                                     
                                    /*si existe el parametro eliminar entonces no se eliminó el comentario*/
                                     if(isset($_GET["eliminar"])){
                                            header("Location:comentarios.php?m=2"); 
                                          
                                      }
                                    
                                      elseif(isset($_POST["bulk_opciones"])){
                                          header("Location:comentarios.php?m=2"); 
                                           
                                      } 
                                    
                                       
                                    
                                      else{
                                           
                                        /*lo redicciona a entrada_comentarios.php ya que el parametro es eliminar_comentario y opciones en el select de entrada_comentarios.php*/ header("Location:entrada_comentarios.php?id_entrada=$id_entrada&m=2");
                                      }
                                    
                                }
                            }
                          
                      }else{
                          /*no existe el id del registro*/
                         header("Location:comentarios.php?m=2"); 
                      }
                  }
         }
      
      
         public function aprobar_comentario($id_comentario){
             
               $sql="select * from comentarios where id_comentario=?"; 
             
                $resultado= $this->db->prepare($sql);
             
                $resultado->bindValue(1,$id_comentario);
             
                  if(!$resultado->execute()){
                      
                      header("Location:comentarios.php?m=1");
                  
                  }else{
                      
                      /*existe el id del registro*/ 
                      if($resultado->rowCount()>0){
                          
                           /*recorremos el registro para obtener el id_entrada y asi enviarlo a entrada_comentarios en la url para que se muestren la lista de comentarios de lo contrario no se mostraria*/
                          
                            while($reg=$resultado->fetch()){
                            
                                $id_entrada=$reg["id_entrada_comentario"];
                            }
                          
                          
                          /*editamos el registro del comentario*/
                          
                          $sql="update comentarios set 
                          
                            comentario_status='aprobado'
                            where id_comentario=?
                          
                          ";
                          
                          $resultado= $this->db->prepare($sql);
                          $resultado->bindValue(1,$id_comentario);
                          
                            if(!$resultado->execute()){
                                
                                 header("Location:comentarios.php?m=1");
                                
                            }else{
                                
                                if($resultado->rowCount()>0){
                                    
                                     /*si existe el parametro aprobar entonces lo redirecciona a comentarios.php*/
                                      if(isset($_GET["aprobar"])){
                                           
                                       header("Location:comentarios.php?m=4");
                                          
                                      } else {
                                          
                                         /*lo redicciona a entrada_comentarios.php ya que el parametro es aprobar_comentario*/ header("Location:entrada_comentarios.php?id_entrada=$id_entrada&m=4");   
                                      }
                                    
                                }else{
                                    
                                       /*si existe el parametro aprobar entonces no se aprobó el comentario*/
                                      if(isset($_GET["aprobar"])){
                                    
                                        header("Location:comentarios.php?m=5"); 
                                          
                                      }else {
                                           
                                          /*lo redicciona a entrada_comentarios.php ya que el parametro es aprobar_comentario*/
                                          header("Location:entrada_comentarios.php?id_entrada=$id_entrada&m=5"); 
                                      }
                                }
                            }
                          
                      }else{
                          /*no existe el id del registro*/
                         header("Location:comentarios.php?m=2"); 
                      }
                  }
         }
      
        
         public function desaprobar_comentario($id_comentario){
             
               $sql="select * from comentarios where id_comentario=?"; 
             
                $resultado= $this->db->prepare($sql);
             
                $resultado->bindValue(1,$id_comentario);
             
                  if(!$resultado->execute()){
                      
                      header("Location:comentarios.php?m=1");
                  
                  }else{
                      /*existe el id del registro*/ 
                      if($resultado->rowCount()>0){
                          
                           /*recorremos el registro para obtener el id_entrada y asi enviarlo a entrada_comentarios en la url para que se muestren la lista de comentarios de lo contrario no se mostraria*/
                          
                            while($reg=$resultado->fetch()){
                            
                                $id_entrada=$reg["id_entrada_comentario"];
                            }
                          
                          /*editamos el registro del comentario*/
                          
                          $sql="update comentarios set 
                          
                            comentario_status='no aprobado'
                            where id_comentario=?
                          
                          ";
                          
                          $resultado= $this->db->prepare($sql);
                          $resultado->bindValue(1,$id_comentario);
                          
                            if(!$resultado->execute()){
                                
                                 header("Location:comentarios.php?m=1");
                                
                            }else{
                                
                                if($resultado->rowCount()>0){
                                    
                                     /*si existe el parametro desaprobar entonces lo redirecciona a comentarios.php*/
                                      if(isset($_GET["desaprobar"])){
                                    
                                       header("Location:comentarios.php?m=6");
                                          
                                      } else {
                                          
                                         header("Location:entrada_comentarios.php?id_entrada=$id_entrada&m=6");
                                      }
                                    
                                }else{
                                    
                                    /*si existe el parametro desaprobar entonces no se aprobó el comentario*/
                                      if(isset($_GET["desaprobar"])){
                                    
                                       header("Location:comentarios.php?m=7"); 
                                          
                                      }else {
                                          
                                        /*lo redicciona a entrada_comentarios.php ya que el parametro es desaprobar_comentario*/ header("Location:entrada_comentarios.php?id_entrada=$id_entrada&m=7"); 
                                      }
                                }
                            }
                          
                      }else{
                          /*no existe el id del registro*/
                         header("Location:comentarios.php?m=2"); 
                      }
                  }
         }
      
         public function get_numero_comentarios(){
          
          $sql="select * from comentarios"; 
          
          $resultado=$this->db->prepare($sql);
          
            if(!$resultado->execute()){
              
                header("Location:index.php?m=2");
            
            }else{
                
                 return $resultado->rowCount();
            }
          
      }
      
       public function get_numero_comentarios_no_aprobado(){
          
          $sql="select * from comentarios where comentario_status='no aprobado'"; 
          
          $resultado=$this->db->prepare($sql);
          
            if(!$resultado->execute()){
              
                header("Location:index.php?m=2");
            
            }else{
                
                 return $resultado->rowCount();
            }
          
      }
      
       /*con este metodo se obtiene el numero de comentarios de una entrada*/
        public function get_numero_comentarios_por_id_entrada($id_entrada){
          
          $sql="select * from comentarios where id_entrada_comentario=?"; 
          
          $resultado=$this->db->prepare($sql);
          
          $resultado->bindValue(1,$id_entrada);
          
            if(!$resultado->execute()){
              
                header("Location:index.php?m=2");
            
            }else{
                
                return $resultado->rowCount();
                
                
            }
          
      }
      
      /*con este metodo obtengo los comentarios de una entrada, de acuerdo al id de la entrada*/
         public function get_comentarios_por_id_entrada($id_entrada){
          
          $sql="select * from comentarios where id_entrada_comentario=?"; 
          
          $resultado=$this->db->prepare($sql);
          
          $resultado->bindValue(1,$id_entrada);
          
            if(!$resultado->execute()){
              
                header("Location:index.php?m=2");
            
            }else{
                
                 while($reg=$resultado->fetch()){
                     
                  $this->comentarios_por_entrada[]=$reg;  
                 
                 } 
                
                 return $this->comentarios_por_entrada;
                
            }
          
      }
      
      
  }


?>