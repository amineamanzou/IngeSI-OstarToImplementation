<html>
    <header><title>Liste des produits à réapprovisionner</title></header>
    <body>
        <?php include("connexion.php") ?>
        <?php
        $req="SELECT idReapp, produit.codeBarre, libelle, reapprovisionnement.quantiteReapprovisionnement, date, dateLivraison
              FROM reapprovisionnement, produit
              WHERE reapprovisionnement.codeBarre = produit.codeBarre";

        $co=connect();
        $requete=$co->query($req);

        echo'
        <h1 class="bg-info">Liste des réapprovisionnements</h1>
		<table class="table table-condensed">
			<tr>
				<th>Code Barre</th>
				<th>Libellé</th>
				<th>Quantité de réapprovisionnement</th>
				<th>Date de création</th>
				<th>Date de livraison</th>
                <th>Réapprovisionnement</th>
			<tr>';

        $datetime1 = new DateTime("0000-00-00 00:00:00");

        while($liste = $requete->fetch()){
            echo'<tr>
				<td>'.$liste["codeBarre"].'</td>
				<td>'.$liste["libelle"].'</td>
				<td>'.$liste["quantiteReapprovisionnement"].'</td>
				<td>'.$liste["date"].'</td>';

                $datetime2 = new DateTime($liste["dateLivraison"]);

                if($datetime1 == $datetime2){
                    echo '<td>Non livré</td><td><a class="btn btn-primary" role="button" href="reapprovisionnement.php?idReapp='.$liste["idReapp"].'">Réapprovisionner</a></td></tr>';
                }else{
                    echo '<td>'.$liste["dateLivraison"].'</td><td><a class="btn btn-primary disabled" role="button" href="reapprovisionnement.php?idReapp='.$liste["idReapp"].'">Réapprovisionner</a></td></tr>';
                }
        }
        echo"
		</table>
		";
        ?>
    </body>
</html>