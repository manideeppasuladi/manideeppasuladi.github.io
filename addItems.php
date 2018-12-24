<?php session_start(); ?>
<!DOCTYPE html>
<html lang='en'>
<head>
    <title>Item Manager</title>
      <meta charset="utf-8" />
      <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    <link href="style.css" rel="stylesheet" >
</head>
<body>
<!-- 
    Navigation bar
    -->
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
        </ul>
    </nav>

    <!--  header -->
    <div class="container ">
        <div class="display-1 text-light">Sales Manager</div>
    </div>

    <!--
            adding items to the database 
        -->
    <div class="jumbotron page-header">
        <div class="container">
            <div class="h1">Enter Item :</div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th><label for="item-No">Item No</label></th>
                        <th><label for="item-Name">Item Name</label></th>
                        <th><label for="item-Quantity">Item Quantity</label></th>
                        <th><label for="item-Price">Price</label></th>
                    </tr>
                </thead>
                <tbody>
                    <form method="POST" action="insert.php" >
                    <div class="form-group">
                    <tr>   
                        <td><input type="number" class="form-control" name="item-No"> </td>

                        <td><input type="text" class="form-control" name="item-Name"> </td>
                   
                  
                        <td><input type="number" class="form-control" name="item-Quantity"> </td>
                    
                   
                        <td><input type="number" class="form-control" name="item-Price"> </td>
                    </tr>
                    <tr>
                        <td colspan="3"><input type="submit" class="btn btn-primary" value="Add Item" /> </td>
                    </tr>
                    </div>
                    </form>
                    
                     <div id="msg" class="text-danger" >
                        <?php if(!empty($_SESSION['msg'])) { echo $_SESSION['msg']; } ?> 
                    </div>
                        <?php unset($_SESSION['msg']); ?>

                </tbody>
            </table>

        </div>
    </div>


<!--
    Displaying all the items 
    -->

    <div class="jumbotron">
        <div class="container">
            <div class="h1"> All Items </div>
                <table class="table table-bordered table-dark">
                    <thead>
                        <tr>
                            <th>Item No.</th>
                            <th>Item Name</th>
                            <th>Item Quantity</th>
                            <th>Price</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                       
                            
                                 Items will be displayed here
                            
                                <?php
                                                
                                                $host_name = 'localhost';
                                                $db_user ='root';
                                                $db_pass = '';
                                                $db_name = 'mani';

                                                $con = mysqli_connect($host_name, $db_user, $db_pass,$db_name) or die ("Couldn't connect!");

                                                $statement = "select * from items order by itemNo";
                                                $retval = mysqli_query($con,$statement);
                                                        
                                                if(!$retval)
                                                echo "not retrived ..! " ;

                                                

                                                while($row = mysqli_fetch_array($retval))
                                                {
                                                    
                                                  echo "<tr>";
                                                    echo "<td>" . $row['itemNo'] . " </td>";
                                                    echo " <td>". $row['itemName'] ."</td>";
                                                    echo "<td>". $row['itemQty']." </td>";
                                                    echo "<td>". $row['itemPrice']." </td>";
                                                    echo "</tr>";
                                                }
                                                 mysqli_close($con);

                                 ?>
                  
                    </tbody>
                </table>
        </div>
    </div>


</body>
</html>
