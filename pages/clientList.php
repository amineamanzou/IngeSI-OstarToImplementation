<?php
    include("../db_function.php");
    $title = "Client List";
    $stmt = connectDb();
    $query = "SELECT * FROM client";
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
                <h1>Client List</h1>
            </div>
		    <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Adress</th>
                    <tr>  
                </thead>
                <tbody>
                    <?php foreach ($list as $v): ?>
                    <tr>
                        <td><?= $v["idClient"] ?></td>
                        <td><?= $v["firstname"] ?></td>
                        <td><?= $v["lastname"] ?></td>
                        <td><?= $v["address"] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
		</div>
    </body>
</html>