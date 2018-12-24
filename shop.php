<?php
session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();
if(!empty($_REQUEST["action"])) {
switch($_REQUEST["action"]) {
	case "add":
	//$_SESSION["print"] = "hello";
		if(!empty($_REQUEST["itemQty"])) 
		{
			//$_SESSION["print"] = "hi";
			$productByCode = $db_handle->runQuery("SELECT * FROM items WHERE itemNo='" . $_REQUEST["itemNo"] . "'");
			$itemArray = array($productByCode[0]["itemNo"]=>array('itemName'=>$productByCode[0]["itemName"], 'itemNo'=>$productByCode[0]["itemNo"], 'itemQty'=>$_POST["itemQty"], 'itemPrice'=>$productByCode[0]["itemPrice"]));
			
			if(!empty($_SESSION["cart_item"])) 
			{
				if(in_array($productByCode[0]["itemNo"],array_keys($_SESSION["cart_item"]))) 
				{
					foreach($_SESSION["cart_item"] as $k => $v) 
					{
							if($productByCode[0]["itemNo"] == $k) 
							{
								if(empty($_SESSION["cart_item"][$k]["itemQty"])) 
								{
									$_SESSION["cart_item"][$k]["itemQty"] = 0;
								}
								$_SESSION["cart_item"][$k]["itemQty"] += $_POST["itemQty"];
							}
					}
				} 
				else 
				{
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
				}
			} 
			else {
				$_SESSION["cart_item"] = $itemArray;
			}
		}
	break;
	case "remove":
		if(!empty($_SESSION["cart_item"])) {
			/*foreach($_SESSION["cart_item"] as $k => $v) {
					if($_GET["itemNo"] == $k) 
					{
						$_SESSION["print"] = "$k";
						unset($_SESSION["cart_item"][$k]);
					}				
					if (empty($_SESSION["cart_item"]) )
					{	$_SESSION["print"] = "$k hello";
						unset($_SESSION["cart_item"]);
					}
			}*/
			$num = $_REQUEST["removeNum"];
			unset($_SESSION["cart_item"][$num-1]);
			
		}
	break;
	case "empty":
		unset($_SESSION["cart_item"]);
	break;	
}
}
?>
<HTML>
<HEAD>
<TITLE>Simple PHP Shopping Cart</TITLE>
		<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <!------ Include the above in your HEAD tag ---------->
        <link href=style.css rel="stylesheet" >

</HEAD>
<BODY>
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


<div id="shopping-cart" class="container jumbotron ">
<div class="txt-heading display-1 ">Shopping Cart</div>

<a id="btnEmpty" href="shop.php?action=empty" class="btn btn-danger " >Empty Cart</a>
<?php
 //echo $_SESSION["print"] ; 
if(!empty($_SESSION["cart_item"])){
    $total_quantity = 0;
	$total_price = 0;
	 
?>	
<table class="tbl-cart table table-bordered table-dark" cellpadding="10" cellspacing="1">

	<tbody>
		<tr>
		<th > No. </th>
		<th > Name </th>
		<th  width="5%">Quantity</th>
		<th  width="10%">Unit Price</th>
		<th  width="10%">Price</th>
		
		</tr>
	<!--</thead>	
	<tbody>-->
					<?php	
					$_SESSION["sno"]=1;	
						foreach ($_SESSION["cart_item"] as $item) {
							$item_price = $item["itemQty"]*$item["itemPrice"];
							?>
									<tr>
										<td><?php echo $_SESSION["sno"]++; ?></td>
										<td><?php echo $item["itemName"]; ?></td>
										<td ><?php echo $item["itemQty"]; ?></td>
										<td ><?php echo "₹ ".$item["itemPrice"]; ?></td>
										<td ><?php echo "₹ ". number_format($item_price,2); ?></td>
										<!--<td ><a href="shop.php?action=remove&itemNo=<?php echo $item["itemNo"]; ?>" class="btnRemoveAction btn-danger">Remove</a>
											<?php 	//header("location:shop.php"); ?>
										</td>-->
									</tr>
							<?php
									$total_quantity += $item["itemQty"];
									$total_price += ($item["itemPrice"]*$item["itemQty"]);
							}
							?>

									<tr>
										<td colspan="2" align="right">Total:</td>
										<td align="right"><?php echo $total_quantity; ?></td>
										<td align="right" colspan="2"><strong><?php echo "₹ ".number_format($total_price, 2); ?></strong></td>
										
									</tr>
	</tbody>
</table>
<!-- remove action-->
<form action="shop.php"><!--
<input type="text" id="" value="action=remove">
<input type=number id="removeNum" size = "2" />-->
<input type=submit value="refresh"  class="btn btn-danger" /></form>
  <?php
} else {
	
?>
<div class="no-records text-lg display-6 text-light">Your Cart is Empty</div>
<?php 
}
?>
</div>

<div id="product-grid" class="container jumbotron">
	<div class="txt-heading display-1 ">Products</div>
	<table class="table table-bordered table-dark" >
			<thead>
                        <tr>
                            <th>Item No.</th>
                            <th>Item Name</th>
							<th>Item Price </th>
                            <th>Item Quantity and Add</th>
                            
                            
                        </tr>
                    </thead>
			<tbody>
	<?php
	$query = "select * from items order by itemNo";
	$product_array = $db_handle->runQuery($query);
	if (!empty($product_array)) { 
		foreach($product_array as $key=>$value){
	?>

		
			<!--<form method="post" action="shop.php?action=add&itemNo=<?php //echo $product_array[$key]["itemNo"]; ?>">
			-->
			<form method="post" action="shop.php?action=add&itemNo=<?php echo $product_array[$key]["itemNo"]; ?>">
				
			<tr>
			<td class="product-no" width="25%"><?php echo $product_array[$key]["itemNo"]; ?></td>
			<td class="product-title" width="25%"><?php echo $product_array[$key]["itemName"]; ?></td>
			<td class="product-price" width="25%"><?php echo "Rs.".$product_array[$key]["itemPrice"]; ?></td>
			<td><div class="cart-action" width="25%"><input type="text" class="product-quantity" name="itemQty" value="1" size="2" />
			
			<input type="submit" value="Add to Cart" class="btnAddAction btn btn-primary" />
			<?php //header("location:shop.php"); ?>	
			</div></td>
			</tr>
			</form>
			
		
	<?php
		}
	}
	?>
	</tbody>
			</table>
</div>
</BODY>
</HTML>