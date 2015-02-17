<html>
<head>
	<title>Création de client</title>
</head>
<body>
    <?php
        include("connexion.php");
    ?>
	<?php if(isset($_POST["quantiteCommande"]) && 
			isset($_POST["codeBarre"]) && 
			isset($_POST["nom"]) && 
			isset($_POST["prenom"]) && 
			isset($_POST["adresse"])){

//			$req="INSERT INTO client(nom, prenom, adresse)
//					VALUES (:nom, :prenom, :adresse)";
			$req="CALL new_order(?,?,?,?,?)";

			$connect = connect();
			$requete=$connect -> prepare($req);
			$requete -> bindParam(1,$_POST["quantiteCommande"]);
			$requete -> bindParam(2,$_POST["codeBarre"]);
			$requete -> bindParam(3,$_POST["nom"]);
			$requete -> bindParam(4,$_POST["adresse"]);
			$requete -> bindParam(5,$_POST["prenom"]);
			$verif=$requete -> execute();

			if($verif) {
				echo "<h1> Commande effectuée !! </h1>";
			} else {
				echo "<h1> Erreur : Commande non effectuée !! </h1>";
			}
		
	}else{ 

		$codeBarre = isset($_POST['codeBarre']) ? $_POST['codeBarre'] : "";
		$quantiteCommande = isset($_POST['quantiteCommande']) ? $_POST['quantiteCommande'] : "";

		?>	

	<h1 class="bg-info">Ajout d'un nouveau client</h1>
	<form action="" method="POST">
		<input type="hidden" name="codeBarre" value="<?php echo $codeBarre; ?>" /> 
		<input type="hidden" name="quantiteCommande" value="<?php echo $quantiteCommande; ?>" /> 
		<table class="table table-condensed">
			<tr><td>Nom</td>
				<td><input type="text" name="nom"/></td>
			</tr>
			<tr><td>Prénom</td>
				<td><input type="text" name="prenom"/></td>
			</tr>
			<tr><td>Adresse</td>
				<td><input type="text" name="adresse"/></td>
			</tr>
			<tr><td></td><td><input class="btn btn-primary" type="submit" value="Créer"/></td></tr>
		</table>
	</form>	
	<?php } ?>
</body>
</html>