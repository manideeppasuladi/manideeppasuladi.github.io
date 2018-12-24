<?php
session_start();
?>
<html>
    <head>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <!------ Include the above in your HEAD tag ---------->
        <link href="style.css" rel="stylesheet" >
    </head>
    
    <body>
      <!-- navigation bar -->  
    <nav class="navbar navbar-expand-sm bg-light navbar-light justify-content-center">
        <ul class="navbar-nav">
            <li class="nav-item active">
            <a class="nav-link" href="home.php">Home</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="#">About</a></a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="login.php">Logout</a></a>
            </li>
            <li class="nav-item ">
            <a class="nav-link " href="#"> <?php if(!empty($_SESSION['username'])) { echo $_SESSION['username']; } ?> </a></a>
            </li>
            
        </ul>
    </nav>
    <br><Br>
        
    <!-- session name -->
    <h1 class="text-light"> WELCOME
            <?php if(!empty($_SESSION['username'])) { echo $_SESSION['username']; } ?> 
        </h1>
        <br>

        <!-- Box views -->
    <div class="container">
	    <div class="row">
	        
                <!-- box 1 -->
		        <div class="col-lg-4 col-sm-6 text-center">
                    <div class="well" style="background-color:#ffffff"> 
                    <a name="" id="" class="btn btn-outline-primary" href="addItems.php" role="button">
                        <img src="imgs\plus.png" class="img-thumbnail" alt="Cinque Terre" width="304" height="236"> </a>
                             <h3>Add Items</h3>
                            
                     </div> 
                </div>
                <!-- box 2 -->
                <div class="col-lg-4 col-sm-6 text-center">
                    <div class="well" style="background-color:#ffffff"> 
                    <a name="" id="" class="btn btn-outline-primary" href="shop.php" role="button">
                        <img src="imgs\shop.png" class="img-thumbnail" alt="Cinque Terre" width="304" height="236"> </a>
                             <h3>Shop</h3>
                            
                     </div> 
                </div>
                <!-- box 3 -->
                <div class="col-lg-4 col-sm-6 text-center">
                    <div class="well" style="background-color:#ffffff"> 
                    <a name="" id="" class="btn btn-outline-primary" href="items.php" role="button">
                        <img src="imgs\items.png" class="img-thumbnail" alt="Cinque Terre" width="304" height="236"> </a>
                             <h3>All Items </h3>
                            
                     </div> 
                </div>    
        </div>
    </div>


    </body>
</html>

