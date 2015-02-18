<?php
    include("../db_function.php");
    $title = "New Product";
    if(!empty($_POST["name"]) && 
			!empty($_POST["customer"]) && 
			!empty($_POST["limit"]) && 
			!empty($_POST["quantitySupply"]) && 
			!empty($_POST["quantityToReorder"]) &&
			!empty($_POST["idProduct"])){
            
            $queryStr = "CALL newProduct(?,?,?,?,?,?)";
            $stmt = connectDb();	
            $query = $stmt->prepare($queryStr);
            $query->bindParam(1,$_POST["name"],PDO::PARAM_STR);
            $query->bindParam(2,$_POST["customer"],PDO::PARAM_STR);
            $query->bindParam(3,$_POST["limit"],PDO::PARAM_INT);
            $query->bindParam(4,$_POST["idProduct"],PDO::PARAM_INT);
            $query->bindParam(5,$_POST["quantitySupply"],PDO::PARAM_INT);
            $query->bindParam(6,$_POST["quantityToReorder"],PDO::PARAM_INT);
            $result = $query->execute();
    }
    elseif(isset($_POST["name"]) && 
			isset($_POST["customer"]) && 
			isset($_POST["limit"]) && 
			isset($_POST["quantitySupply"]) && 
			isset($_POST["quantityToReorder"]) &&
			isset($_POST["idProduct"])){
        $result = False;
    }
    //print_r($list);die();
?>
<html>
	<head>
		<title>Just4You - <?= $title ?></title>
		<meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"/>
	</head>
	<body>
		<?php
	   		include("../header.php");
		?>
		<div class="container">
            <div class="page-header">
		        <h1>Add a new Product</h1>
            </div>
            <?php if(isset($result) && $result === True): ?>
                <div class="alert alert-success">Product added.</div>
            <?php elseif(isset($result) && $result === False): ?>
                <div class="alert alert-danger">Failed to add product.</div>
            <?php endif; ?>

           <form action="/pages/newProduct.php" method="POST">
                <div class="form-group">
                    <label for="idProduct">idProduct</label>
                    <input class="form-control" name="idProduct" placeholder="Enter a numeric identifiant">
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input class="form-control" name="name" placeholder="Enter a name">
                </div>
                <div class="form-group">
                    <label for="customer">Customer</label>
                    <input class="form-control" name="customer" placeholder="Enter the name of the customer">
                </div>
                <div class="form-group">
                    <label for="limit">Limit</label>
                    <input class="form-control" name="limit" placeholder="Enter a stock limit to launch Reorder">
                </div>
                <div class="form-group">
                    <label for="quantitySupply">Supply Quantity</label>
                    <input class="form-control" name="quantitySupply" placeholder="Enter a numeric value">
                </div>
                <div class="form-group">
                    <label for="quantityToReorder">Quantity to reorder</label>
                    <input class="form-control" name="quantityToReorder" placeholder="Enter a numeric value">
                </div>
                <button type="submit" class="btn btn-success">Add</button>
            </form>	
            
        </div>
    </body>
</html>