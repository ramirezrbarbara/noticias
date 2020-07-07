
$(document).ready(function(){
    
    //editor ckeditor
    
      ClassicEditor
        .create( document.querySelector('#body'))
        .catch( error => {
            console.error( error );
        } );
    
    
    //el resto del codigo 
    
     /*selecciona todos los registros del checkbox en entradas*/
    
      $("#selecciona_todo").click(function(event){
           
           if(this.checked){
               
                $(".checkBoxes").each(function(){
                    
                     this.checked=true;
                });
              
           }else {
              
                $(".checkBoxes").each(function(){

                     this.checked=false;
                 });
           }
      });
    
    
});



