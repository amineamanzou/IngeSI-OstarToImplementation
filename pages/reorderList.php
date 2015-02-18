<?php
    include("../db_function.php");
    $title = "Reorder List";
    $stmt = connectDb();
    $query = "SELECT idReorder, product.idProduct, name, reorder.quantityReorder, date, dateDelivery
              FROM reorder, product
              WHERE reorder.idProduct = product.idProduct";
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
                <h1>Reorder List</h1>
            </div>
		    <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>idProduct</th>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Date</th>
                        <th>Delivery Date</th>
                    <tr>  
                </thead>
                <tbody>
                    <?php foreach ($list as $v): ?>
                    <tr>
                        <td><?= $v["idReorder"] ?></td>
                        <td><?= $v["idProduct"] ?></td>
                        <td><?= $v["name"] ?></td>
                        <td><?= $v["quantityReorder"] ?></td>
                        <td><?= $v["date"] ?></td>
                        <td><?= $v["dateDelivery"] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
		</div>
    </body>
</html>