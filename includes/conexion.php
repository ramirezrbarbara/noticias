<?php

/*esta funcion crea y reanuda una session si existe y debe ponerse en la parte superior del archivo, esta funcion deberia de ponerse justo cuando se crea la variable de session (antes de la variable) y en las vistas, arriba de las variables de session para reanudar la session si existiese, pero como desde el index.php se llama este archivo y que llama a los controladores entonces no es necesario ubicarse en esos archivos sino en uno solo*/
//session_start();


class Conectar {
    
    /*conexión a la base de datos*/
    public static function conexion(){


		 		try {

                     //$conectar = new PDO("mysql:local=localhost;dbname=c1bbddcms","c1gestores","Genesis2020");
                     $conectar = new PDO("mysql:local=localhost;dbname=c1bbddcms","root","");
				    
                     $conectar->query("SET NAMES 'utf8'");
                    
				     return $conectar;
		 			
		 		} catch (Exception $e) {

		 			print "¡Error!: " . $e->getMessage() . "<br/>";
		            die();  
		 			
		 		}
		 

		 } //cierre de llave de la function conexion()

    
}
    
    


      /*if(Conectar::conexion()){
          
          echo "conectado";
          
      } else{
          
          echo "error en la conexion";
      }*/

?>