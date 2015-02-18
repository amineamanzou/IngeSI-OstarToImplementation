<?php
    include("../db_function.php");
    $title = "Order List";
    $stmt = connectDb();
    $query = "SELECT * FROM orders";
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
                <h1>Order List</h1>
            </div>
		    <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>idClient</th>
                        <th>idProduct</th>
                        <th>Quantity</th>
                        <th>dateOrder</th>
                        <th>payed</th>
                    <tr>  
                </thead>
                <tbody>
                    <?php foreach ($list as $v): ?>
                    <tr>
                        <td><?= $v["idOrder"] ?></td>
                        <td><?= $v["idClient"] ?></td>
                        <td><?= $v["idProduct"] ?></td>
                        <td><?= $v["quantity"] ?></td>
                        <td><?= $v["dateOrder"] ?></td>
                        <td><?= $v["payed"] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
		</div>
    </body>
</html>