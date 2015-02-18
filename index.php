<?php
    include("db_function.php");
    connectDb();
?>
<html>
	<head>
		<title><?php $title ?></title>
		<meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
	</head>
	<body>
		<?php
	   		include("header.php");
		?>
		<div class="jumbotron">
            <h1>Just4You</h1>
            <h2>O* to Database Implementation</h2>
            <p>A Miage project to study the conversion from O star modelisation to the implementation in a database with procedure and triggers with MySQL DB</p>
            <a href="https://github.com/amineamanzou/IngeSI-OstarToImplementation">--> Github</a>
        </div>
    </body>
</html>