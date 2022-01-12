<!---
- Praktikum DBWT. Autoren:
- Linus, Palm, 3271087
- David, Rechkemmer, 3074595
--->
<?php
/**
 * Diese Datei enthält alle SQL Statements für die Tabelle "kategorie"
 */
function db_kategorie_select_all() {
    $link = connectdb();

    $sql = "SELECT * FROM kategorie";
    $result = mysqli_query($link, $sql);

    $data = mysqli_fetch_all($result, MYSQLI_BOTH);

    mysqli_close($link);
    return $data;
}

function db_kategorie_select_names_sorted() {
    $link = connectdb();

    $sql = "SELECT name FROM kategorie ORDER BY name ASC";
    $result = mysqli_query($link, $sql);

    $data = mysqli_fetch_all($result, MYSQLI_BOTH);

    mysqli_close($link);
    return $data;
}