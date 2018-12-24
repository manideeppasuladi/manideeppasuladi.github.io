<?php session_start(); ?>
<html>
  <head>

  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
  </head>
<body id="LoginForm" class="primary">
<div class="container">
<h1 class="form-heading">login Form</h1>
<div class="login-form">
<div class="main-div">
    <div class="panel">
   

   <p>Please enter your Username and password</p>
   </div>
   <div class="container jumbotron">
    <form id="Login" action=check.php method="POST">

        <div class="form-group">
            <input type="text" class="form-control" name="inputUsername" placeholder="Username">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="inputPassword" placeholder="Password">
        </div><br>
        <div class="forgot">
        <a href="reset.html">Forgot password?</a><br>
</div><br>
        <button type="submit" class="btn btn-primary">Login</button>

    </form>
    <div id="errMsg" class="text-danger" >
            <?php if(!empty($_SESSION['errMsg'])) { echo $_SESSION['errMsg']; } ?> 
        </div>
        <?php unset($_SESSION['errMsg']); ?>
    </div>
    </div>

</div></div></div>


</body>
</html>
