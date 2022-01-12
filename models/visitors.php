<!---
- Praktikum DBWT. Autoren:
- Linus, Palm, 3271087
- David, Rechkemmer, 3074595
--->
<?php
/**
 * Diese Datei enthält alle SQL Statements für die Tabelle "benutzer"
 */
function get_visitors_and_update(){
    $link = connectdb();

    $link->query("UPDATE visitors SET count = count + 1");
    $sql = "SELECT count FROM visitors";
    $result = mysqli_query($link, $sql);

    $data = mysqli_fetch_all($result, MYSQLI_BOTH);

    mysqli_close($link);

    return $data[0]['count'];
}