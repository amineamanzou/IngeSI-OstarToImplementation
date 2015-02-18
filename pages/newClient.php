<?php
    include("../db_function.php");
    $title = "New Client";
    if(!empty($_POST["quantity"]) && 
			!empty($_POST["idProduct"]) && 
			!empty($_POST["firstname"]) && 
			!empty($_POST["lastname"]) && 
			!empty($_POST["address"])){
            
            $queryStr = "CALL newOrder(?,?,?,?,?)";
            $stmt = connectDb();	
            $query = $stmt->prepare($queryStr);
            $query->bindParam(1,$_POST["quantity"],PDO::PARAM_INT);
            $query->bindParam(2,$_POST["idProduct"],PDO::PARAM_INT);
            $query->bindParam(3,$_POST["firstname"],PDO::PARAM_STR);
            $query->bindParam(4,$_POST["address"],PDO::PARAM_STR);
            $query->bindParam(5,$_POST["lastname"],PDO::PARAM_STR);
            $result = $query->execute();
    }
    elseif(isset($_POST["quantity"]) && 
			isset($_POST["idProduct"]) && 
			isset($_POST["firstname"]) && 
			isset($_POST["address"]) &&
			isset($_POST["lastname"])){
        $result = False;
    }
    $idProduct = isset($_POST['idProduct']) ? $_POST['idProduct'] : "";
    $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : "";
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
		        <h1>Create new client</h1>
            </div>
            <?php if(isset($result) && $result === True): ?>
                <div class="alert alert-success">Client and order added.</div>
            <?php elseif(isset($result) && $result === False): ?>
                <div class="alert alert-danger">Failed to create the client and the order.</div>
            <?php endif; ?>

           <form action="/pages/newClient.php" method="POST">
                <input type="hidden" name="idProduct" value="<?php echo $idProduct; ?>" /> 
		        <input type="hidden" name="quantity" value="<?php echo $quantity; ?>" /> 
                <div class="form-group">
                    <label for="firstname">Firstname</label>
                    <input class="form-control" name="firstname" placeholder="Enter your name">
                </div>
                <div class="form-group">
                    <label for="lastname">Lastname</label>
                    <input class="form-control" name="lastname" placeholder="Enter your name">
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input class="form-control" name="address" placeholder="Enter your address">
                </div>
                <button type="submit" class="btn btn-success">Add</button>
            </form>	
            
        </div>
    </body>
</html>