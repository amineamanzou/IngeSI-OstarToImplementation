<html>
<head>
	<title>Création de produit</title>
</head>
<body>
<?php include("connexion.php"); ?>
	<?php 
		if(isset($_POST["libelle"]) && 
			isset($_POST["fournisseur"]) && 
			isset($_POST["seuil"]) && 
			isset($_POST["qtyStock"]) && 
			isset($_POST["qtyReapp"]) &&
			isset($_POST["codeBarre"])){

				$req="CALL new_product(?,?,?,?,?,?)";
				$co=connect();	
				$requete=$co->prepare($req);
				$requete->bindParam(1,$_POST["libelle"]);
				$requete->bindParam(2,$_POST["fournisseur"]);
				$requete->bindParam(3,$_POST["seuil"]);
				$requete->bindParam(4,$_POST["codeBarre"]);
				$requete->bindParam(5,$_POST["qtyStock"]);
				$requete->bindParam(6,$_POST["qtyReapp"]);
				$verif=$requete->execute();
				if($verif){
					echo"<h1>Produit ajouté !!</h1>";
				}else{
					echo"<h1>Produit non ajouté !!</h1>";
				}
		}else{ 
	?>	
	<h1 class="bg-info">Ajout d'un nouveau produit</h1>
	<form action="" method="POST">
		<table class="table table-condensed">
			<tr><td>Code barre</td>
				<td><input type="text" name="codeBarre"/></td>
			</tr>
			<tr><td>Libellé</td>
				<td><input type="text" name="libelle"/></td>
			</tr>
			<tr><td>Fournisseur</td>
				<td><input type="text" name="fournisseur"/></td>
			</tr>
			<tr><td>Seuil</td>
				<td><input type="text" name="seuil"/></td>
			</tr>
			<tr><td>Quantité en stock</td>
				<td><input type="text" name="qtyStock"/></td>
			</tr>
			<tr><td>Quantité de réapprovisionnement</td>
				<td><input type="text" name="qtyReapp"/></td>
			</tr>
			<tr><td>
				<td><input class="btn btn-primary" type="submit" value="Ajouter"/></td>
			</tr>
		</table>
	</form>	
	<?php } ?>
</body>
</html>