<html>
<head>
	<title>Liste des produits</title>
</head>
<body>
    <?php include("connexion.php") ?>
	<?php
		$req="SELECT * FROM produit";
		$co=connect();	
		$requete=$co->query($req);
		// $liste=$requete->fetch();
		echo'
		<h1 class="bg-info">Liste des produits</h1>
		<table class="table table-condensed">
			<tr>
				<th>Code Barre</th>
				<th>Libellé</th>
				<th>Fournisseur</th>
				<th>Seuil</th>
				<th>Quantité en stock</th>
				<th>Quantité de réapprovisionnement</th>
				<th>Commander</th>
			<tr>';
		while($liste = $requete->fetch()){
			echo'<tr>
				<td>'.$liste["codeBarre"].'</td>
				<td>'.$liste["libelle"].'</td>
				<td>'.$liste["fournisseur"].'</td>
				<td>'.$liste["seuil"].'</td>
				<td>'.$liste["quantiteStock"].'</td>	
				<td>'.$liste["quantiteReapprovisionnement"].'</td>	
				<td><a class="btn btn-primary" href="formulaire_commande.php?code='.$liste["codeBarre"].'&libelle='.$liste["libelle"].'&quantiteStock='.$liste["quantiteStock"].'">Commander</a></td>	
			</tr>';
		}	
		echo"		
		</table>	
		";
	?>
</body>
</html>