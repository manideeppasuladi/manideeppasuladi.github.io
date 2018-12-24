<?php
session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();
if(!empty($_GET["action"])) {
switch($_GET["action"]) {
	case "add":
		if(!empty($_POST["itemQty"])) {
			$productByCode = $db_handle->runQuery("SELECT * FROM items WHERE itemNo='" . $_GET["itemNo"] . "'");
			$itemArray = array($productByCode[0]["itemNo"]=>array('itemNo'=>$productByCode[0]["itemNo"], 'itemNo'=>$productByCode[0]["itemNo"], 'itemQty'=>$_POST["itemQty"], 'itemPrice'=>$productByCode[0]["itemPrice"]));
			
			if(!empty($_SESSION["cart_item"])) {
				if(in_array($productByCode[0]["itemNo"],array_keys($_SESSION["cart_item"]))) {
					foreach($_SESSION["cart_item"] as $k => $v) {
							if($productByCode[0]["itemNo"] == $k) {
								if(empty($_SESSION["cart_item"][$k]["itemQty"])) {
									$_SESSION["cart_item"][$k]["itemQty"] = 0;
								}
								$_SESSION["cart_item"][$k]["itemQty"] += $_POST["itemQty"];
							}
					}
				} else {
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
				}
			} else {
				$_SESSION["cart_item"] = $itemArray;
			}
		}
	break;
	case "remove":
		if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {
					if($_GET["itemNo"] == $k)
						unset($_SESSION["cart_item"][$k]);				
					if(empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
			}
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
<!--<link href="style.css" type="text/css" rel="stylesheet" />-->
</HEAD>
<BODY>
<div id="shopping-cart">
<div class="txt-heading">Shopping Cart</div>

<a id="btnEmpty" href="index.php?action=empty">Empty Cart</a>
<?php
if(isset($_SESSION["cart_item"])){
    $total_quantity = 0;
    $total_price = 0;
?>	
<table class="tbl-cart" cellpadding="10" cellspacing="1">
<tbody>
<tr>
<th style="text-align:left;">Name</th>
<th style="text-align:left;">Code</th>
<th style="text-align:right;" width="5%">Quantity</th>
<th style="text-align:right;" width="10%">Unit Price</th>
<th style="text-align:right;" width="10%">Price</th>
<th style="text-align:center;" width="5%">Remove</th>
</tr>	
<?php		
    foreach ($_SESSION["cart_item"] as $item){
        $item_price = $item["itemQty"]*$item["itemPrice"];
		?>
				<tr>
				<td><?php //echo $item["itemName"]; ?></td>
				<td><?php echo $item["itemNo"]; ?></td>
				<td style="text-align:right;"><?php echo $item["itemQty"]; ?></td>
				<td  style="text-align:right;"><?php echo "$ ".$item["itemPrice"]; ?></td>
				<td  style="text-align:right;"><?php echo "$ ". number_format($item_price,2); ?></td>
				<td style="text-align:center;"><a href="index.php?action=remove&itemNo=<?php echo $item["itemNo"]; ?>" class="btnRemoveAction"><img src="icon-delete.png" alt="Remove Item" /></a></td>
				</tr>
				<?php
				$total_quantity += $item["itemQty"];
				$total_price += ($item["itemPrice"]*$item["itemQty"]);
		}
		?>

<tr>
<td colspan="2" align="right">Total:</td>
<td align="right"><?php echo $total_quantity; ?></td>
<td align="right" colspan="2"><strong><?php echo "$ ".number_format($total_price, 2); ?></strong></td>
<td></td>
</tr>
</tbody>
</table>		
  <?php
} else {
?>
<div class="no-records">Your Cart is Empty</div>
<?php 
}
?>
</div>

<div id="product-grid">
	<div class="txt-heading">Products</div>
	<?php
	$product_array = $db_handle->runQuery("SELECT * FROM items ORDER BY itemNo");
	if (!empty($product_array)) { 
		foreach($product_array as $key=>$value){
	?>
		<div class="product-item">
			<form method="post" action="index.php?action=add&itemNo=<?php echo $product_array[$key]["itemNo"]; ?>">
			<div class="product-title"><?php echo $product_array[$key]["itemName"]; ?></div>
			<div class="product-price"><?php echo "$".$product_array[$key]["itemPrice"]; ?></div>
			<div class="cart-action"><input type="text" class="product-quantity" name="itemQty" value="1" size="2" /><input type="submit" value="Add to Cart" class="btnAddAction" /></div>
			</div>
			</form>
		</div>
	<?php
		}
	}
	?>
</div>
</BODY>
</HTML>