<?php
    include("../db_function.php");
    $title = "New Order";
    $stmt = connectDb();
    $query = "SELECT * FROM product";
    $result = $stmt->query($query);
    $list = $result->fetchAll();
    //print_r($list);die();
?>
<html>
	<head>
		<title>Just4You - <?php $title ?></title>
		<meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"/>
	</head>
	<body>
		<?php
	   		include("../header.php");
		?>
		<div class="container">
            <div class="page-header">
		        <h1>New Order</h1>
            </div>
            <?php 
                if(isset($_GET["idProduct"]) && isset($_GET["name"]) && isset($_GET["quantitySupply"])):
            ?>	

            <div class="page-header">
                <h5><?php echo "Order of the product : ".$_GET["name"]." - ".$_GET["idProduct"] ?></h5>
                <h5><?php echo "Quantity in stock : ".$_GET["quantitySupply"]?></h5>
            </div>
            

            
            <form action="/pages/newClient.php" method="POST">
                <?php $idProduct = isset($_GET['idProduct']) ? $_GET['idProduct'] : ""; ?>
                <input type="hidden" name="idProduct" value="<?php echo $idProduct; ?>" /> 
                <table class="table">
                    <tr>
                        <td>Quantity to order</td>
                        <td><input type="text" name="quantity"/></td>
                        <td><input class="btn btn-success" type="submit" value="Order"/></td>
                    </tr>
                </table>
            </form>
            
                
            <?php endif; ?>
        </div>
    </body>
</html>