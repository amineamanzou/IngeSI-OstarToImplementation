<?php
    include("../db_function.php");
    $title = "Product List";
    $stmt = connectDb();
    $query = "SELECT * FROM product";
    $result = $stmt->query($query);
    $list = $result->fetchAll();
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
		        <h1>Product List</h1>
            </div>
            <table class="table table-striped">
               <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Customer</th>
                    <th>Limit</th>
                    <th>Quantity in Stock</th>
                    <th>Quantity To Order</th>
                    <th>Action</th>
                <tr>  
               </thead>
               <tbody>
                   <?php foreach ($list as $v): ?>
                    <tr>
                        <td><?= $v["idProduct"] ?></td>
                        <td><?= $v["name"] ?></td>
                        <td><?= $v["customer"] ?></td>
                        <td><?= $v["limit"] ?></td>
                        <td><?= $v["quantitySupply"] ?></td>
                        <td><?= $v["quantityToReorder"] ?></td>
                        <td>
                            <a class="btn btn-success" 
                            href="newOrder.php?idProduct=<?= $v["idProduct"] ?>&name=<?= $v["name"] ?>&quantitySupply=<?=$v["quantitySupply"]?>"
                            >
                            Order
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
               </tbody>
            </table>
		</div>
    </body>
</html>