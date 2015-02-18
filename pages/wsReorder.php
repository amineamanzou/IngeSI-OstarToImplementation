<?php include("connexion.php") ?>
<?php
    if(isset($_GET["idReapp"])){
        $queryStr="CALL resupplying(?)";
        $stmt = connectDb();
        $query = $stmt->prepare($queryStr);
        $query->bindParam(1,$_GET["idReorder"]);
        $verif = $requete->execute();
        header("Location: reorderList.php");
    }
?>