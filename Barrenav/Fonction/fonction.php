<?php
function incrementidfiche($Classepdo,$table,$colonnes){
    $selectClause = empty($colonnes) ? '*' : implode(', ', $colonnes);
    echo "Requête SQL : SELECT $selectClause FROM $table";
    $requete=$Classepdo->prepare("SELECT $selectClause FROM $table");
    $requete->execute();
    $result=$requete->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) {
        foreach ($colonnes as $colonne) {
            print($row[$colonne] . ' ');
        }
        echo "<br>";
    }
}

?>