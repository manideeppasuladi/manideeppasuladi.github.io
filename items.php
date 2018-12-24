<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet" >
  </head>
  <body>
  <!-- Navigation bar --> 
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
        <div class="display-1 text-light">Items List</div>
    </div>

    <!--
    Displaying all the items 
    -->

    <div class="jumbotron">
        <div class="container">
            <div class="h1"> All Items </div>
                <!-- searching -->
                <div>
                        
                </div>
                <table class="table table-bordered table-dark">
                    <thead>
                        <tr>
                            <th>Item No.</th>
                            <th>Item Name</th>
                            <th>Item Quantity</th>
                            <th>Price</th>
                            <th>Actions</th>
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
                                                    echo '<td width="15%">
                                                    <button class="btn btn-sm  btn-primary justify-context-center" onclick="">Edit</button>
                                                     <button class="btn btn-sm  btn-danger justify-context-center" onclick="">Delete</button>
                                                 </td>';
                                                    echo "</tr>";
                                                }
                                                 mysqli_close($con);

                                 ?>
                  
                    </tbody>
                </table>
        </div>
    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>