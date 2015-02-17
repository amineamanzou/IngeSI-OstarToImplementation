<html>
<head>
	<title>Commande de produit</title>
</head>
<body>

    <?php include("connexion.php"); ?>

	<?php 
		if(isset($_GET["code"]) && isset($_GET["libelle"]) && isset($_GET["quantiteStock"])){
	?>	

	<h1 class="bg-info"><?php echo "Commande du produit : ".$_GET["libelle"]." - ".$_GET["code"] ?></h1>
	<h2><?php echo "Quantité en stock : ".$_GET["quantiteStock"]?></h3>

	<?php $codeBarre = isset($_GET['code']) ? $_GET['code'] : ""; ?>
	
	<form action="formulaire_client.php" method="POST">
		<input type="hidden" name="codeBarre" value="<?php echo $codeBarre; ?>" /> 
		<table class="table table-condensed">
			<tr><td>Quantité à commander</td>
				<td><input type="text" name="quantiteCommande"/></td>
			<td><input class="btn btn-primary" type="submit" value="Commander"/></td>
			</tr>
		</table>
	</form>

	<?php
/*	}else if(isset($_POST["quantiteCommande"])){

			$req="INSERT INTO commande(quantiteCommande)
					VALUES (:quantiteCommande)";

			$connect = connect();
			$requete=$connect -> prepare($req);
			$verif=$requete -> execute(array(
				"quantiteCommande"=>$_POST["quantiteCommande"]));

			if($verif) {
				echo "<h1>Commande ajouté !!</h1>";
			} else {
				echo "<h1> Erreur : commande non ajouté !! </h1>";
			}
*/		
	
	}else{ ?>	
		
	<form action="formulaire_client.php" method="POST">
		<table class="table table-condensed">
			<tr><td>Quantité à commander</td>
				<td><input type="text" name="quantiteCommande"/></td>
			<td><input class="btn btn-primary" type="submit" value="Commander"/></td>
			</tr>
		</table>
	</form>	
	<?php } ?>
</body>
</html>