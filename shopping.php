<?php 
    session_start();
    require_once("dbcontroller.php");
    $db_handle = new DBController();


?>
<!doctype html>
<html lang="en">
  <head>
    <title>Shopping Cart</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href=style.css rel="stylesheet" >
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

    <div class="display-1 text-light" > Shopping  </div>

    <div id="ListOfItems " class="container jumbotron" >
        <div class="h1"> Items list : </div> <br>
            <table class="table table-bordered table-dark">
                <thead>
                    <th>Item No.</th>
                    <th>Item Name</th>
                    <th>Item Price</th>
                    <th>item Quantity </th>
                    <th>Add to cart </th>
                </thead>
                <tbody>
                <?php
                    $query = "select * from items order by itemNo";
                    $retval = $db_handle->runQuery($query);
                        if(!empty($retval)) {
                            foreach($retval as $key=>$value){
                                ?>
                                <tr>
                                    <td><?php echo $retval[$key]["itemNo"]; ?></td>
                                    <td><?php echo $retval[$key]["itemName"]; ?></td>
                                    <td><?php echo $retval[$key]["itemPrice"]; ?></td>
                                    <td><input type="text" name="Qty" value="1" size="2"/> <?php  ?></td>
                                    <td>
                                        <form method=POST action="shopping.php?action=add&itemNo=<?php echo $retval[$key]["itemNo"];   ?>">
                                        <input type=submit value="Add to cart" class="btnAddAction btn btn-primary"/>
                                         </form> 
                                    </td>
                                </tr>
                            <?php }
                        }
                ?>
                 </tbody>       
            </table>
    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  
  
  <?php
    if(!empty ($_REQUEST["action"])) 
    {
        $_SESSION["cart_item"] = "hello";
        switch($_REQUEST["action"]) 
        {
            case "add" :
            $_SESSION["cart_item"] = "hi";
            if(!empty($_REQUEST["Qty"])) 
            {
                $_SESSION["cart_item"] = "ok";
                $query=  "SELECT * FROM items WHERE itemNo='" . $_REQUEST["itemNo"] . "'" ;
                $productByCode = $db_handle->runQuery($query);
                
                 $_SESSION["cart_item"] = "hello";
            }
            break;

            case "remove" :

            break;

            case "empty" :

            break;
        }


    }

  ?>
<div id="CartItems " class="container jumbotron" >
    <div class="h1"> Your Cart : </div> <br>

    <?php
        if(!empty($_SESSION["cart_item"])) 
        {
            $total_quantity = 0;
            $total_price = 0;
            
           /* foreach ($_SESSION["cart_item"] as $item) {
                
                 echo $item["itemNo"]; 
            }*/
            echo $_SESSION["cart_item"] ; 
                

            
        }
        else 
        {
    ?>
        <div>Empty </div>
        <?php
        }
        ?>


</div>

  </body>
</html>