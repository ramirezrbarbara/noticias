    

    </div>    
    <!-- /#wrapper -->

    <!-- jQueryAdminlte -->
    <!-- <script src="adminlte/plugins/jquery/jquery.min.js"></script> -->
    <!-- BootstrapAdminlte -->
    <script src="adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE -->
    <script src="adminlte/js/adminlte.js"></script>

    <!-- OPTIONAL SCRIPTS ADMINLTE -->
    <script src="adminlte/plugins/chart.js/Chart.min.js"></script>
    <script src="adminlte/js/demo.js"></script>
    <script src="adminlte/js/pages/dashboard3.js"></script>
    
    <!-- jQuery -->
    <script src="js/scripts.js"></script>
    <script src="js/jquery-3.5.1.slim.min.js"></script>
    <script src="js/jquery-3.5.1.min.js"></script>

    <!-- Bootstrap Core JavaScript -->    
    <script src="js/popper.min.js"></script>    
    <!-- <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap.js"></script> -->
    <script src="js/sidebar.js"></script>
    <script src="js/perfil.js"></script>
    <script src="js/usuario.js"></script>
    
    
     <!--Notificaciones con pusher-->
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    
    <script src="https://js.pusher.com/4.2/pusher.min.js"></script>
   

     
        <script>

            $(document).ready(function(){


              var pusher =   new Pusher('624bc5cd08c38b261c9a', {

                  cluster: 'us2',
                  encrypted: true
              });


              var notificationChannel =  pusher.subscribe('notificaciones');


                notificationChannel.bind('nuevo_usuario', function(notification){

                    var message = notification.message;
                    
                    console.log(message);

                    toastr.success(`${message} se ha registrado`);

                });



            });



        </script>

     <!--FIN Notificaciones con pusher-->


      

</body>

</html>




