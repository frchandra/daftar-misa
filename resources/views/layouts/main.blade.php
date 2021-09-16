<!-- 
 Created By: CNCS
 ====================================================================================================
      ___       _______     .___  ___.      ___       __    ______   .______       _______ .___  ___. 
     /   \     |       \    |   \/   |     /   \     |  |  /  __  \  |   _  \     |   ____||   \/   | 
    /  ^  \    |  .--.  |   |  \  /  |    /  ^  \    |  | |  |  |  | |  |_)  |    |  |__   |  \  /  | 
   /  /_\  \   |  |  |  |   |  |\/|  |   /  /_\  \   |  | |  |  |  | |      /     |   __|  |  |\/|  | 
  /  _____  \  |  '--'  |   |  |  |  |  /  _____  \  |  | |  `--'  | |  |\  \----.|  |____ |  |  |  | 
 /__/     \__\ |_______/    |__|  |__| /__/     \__\ |__|  \______/  | _| `._____||_______||__|  |__| 
                                                                                                      
  _______   _______  __       _______  __        ______   .______       __       ___      .___  ___.  
 |       \ |   ____||  |     /  _____||  |      /  __  \  |   _  \     |  |     /   \     |   \/   |  
 |  .--.  ||  |__   |  |    |  |  __  |  |     |  |  |  | |  |_)  |    |  |    /  ^  \    |  \  /  |  
 |  |  |  ||   __|  |  |    |  | |_ | |  |     |  |  |  | |      /     |  |   /  /_\  \   |  |\/|  |  
 |  '--'  ||  |____ |  |    |  |__| | |  `----.|  `--'  | |  |\  \----.|  |  /  _____  \  |  |  |  |  
 |_______/ |_______||__|     \______| |_______| \______/  | _| `._____||__| /__/     \__\ |__|  |__|  
 ==================================================================================================== 
--> 

<!doctype html>
<html lang="en">




  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Agency - Start Bootstrap Theme</title>
    
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
    
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
    
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />    


    <meta name="csrf-token" content="{{ csrf_token() }}">

  </head>
  <body>

    @include('partials.navbar')


    @yield('container')

    @include('partials.footer')



 



    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <!-- * *                               SB Forms JS                               * *-->
    <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>

  </body>
</html>