<html>
    <header><title>Liste des commandes</title></header>
    <body>
        <?php include("connexion.php") ?>
        <?php
            if(isset($_GET["id"])){
                $req="CALL payment_order(?)";
                $co=connect();
                $requete=$co->prepare($req);
                $requete->bindParam(1,$_GET["id"]);
                $verif=$requete->execute();
                unset($update);
                header('Location: liste_commande.php');
            }

            $req="SELECT idCommande, nom, prenom, adresse, libelle, quantiteCommande, dateCommande, estPayee
                  FROM commande, client, produit
                  WHERE commande.codeBarre = produit.codeBarre
                  AND commande.idClient = client.idClient";

            $co=connect();
            $requete=$co->query($req);
        echo'
        <h1 class="bg-info">Liste des commandes</h1>
		<table class="table table-condensed">
			<tr>
				<th>Nom</th>
				<th>Prénom</th>
				<th>Adresse</th>
				<th>Libellé</th>
				<th>Quantité commandée</th>
				<th>Date</th>
                <th>Est payée</th>
				<th>Payer</th>
			<tr>';
        while($liste = $requete->fetch()){
            echo'<tr>
				<td>'.$liste["nom"].'</td>
				<td>'.$liste["prenom"].'</td>
				<td>'.$liste["adresse"].'</td>
				<td>'.$liste["libelle"].'</td>
				<td>'.$liste["quantiteCommande"].'</td>
				<td>'.$liste["dateCommande"].'</td>';
                $estPayee = intval($liste["estPayee"]);
            if($estPayee === 0){
                $idCommande = $liste["idCommande"];
                echo '<td>Non payée</td><td><a class="btn btn-primary" role="button" role="button" href="liste_commande.php?id='.$idCommande.'">Payer</a></td></tr>';
            }else{
                echo '<td>Payée</td><td><a class="btn btn-primary disabled" role="button" href="liste_commande.php">Payer</a></td></tr>';
            }
        }
        echo"
		</table>
		";
        ?>
    </body>
</html>