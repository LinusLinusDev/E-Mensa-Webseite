<!---
- Praktikum DBWT. Autoren:
- Linus, Palm, 3271087
- David, Rechkemmer, 3074595
--->
<?php
/**
 * Diese Datei enthält alle SQL Statements für die Tabelle "gerichte"
 */
function db_gericht_select_all() {
    try {
        $link = connectdb();

        $sql = "SELECT id, name, beschreibung FROM gericht ORDER BY name";
        $result = mysqli_query($link, $sql);

        $data = mysqli_fetch_all($result, MYSQLI_BOTH);

        mysqli_close($link);
    }
    catch (Exception $ex) {
        $data = array(
            'id'=>'-1',
            'name' => 'Datenbankfehler '.$ex->getCode(),
            'beschreibung' => $ex->getMessage());
    }
    finally {
        return $data;
    }

}

function db_gericht_select_names_prices_over2_ordered() {
    $link = connectdb();

    $sql = "SELECT name, preis_intern FROM gericht WHERE preis_intern > 2 ORDER BY name DESC";
    $result = mysqli_query($link, $sql);

    $data = mysqli_fetch_all($result, MYSQLI_BOTH);

    mysqli_close($link);

    return $data;
}

function db_gericht_select(int $total) {
    $link = connectdb();

    if($total<0) $total = 0;

    $sql = "SELECT * FROM 
              (SELECT name,GROUP_CONCAT(code) as allergene,preis_intern,preis_extern,bildname,id
               FROM gericht LEFT JOIN emensawerbeseite.gericht_hat_allergen gha on gericht.id = gha.gericht_id
               GROUP BY name ORDER BY RAND() LIMIT $total) as prev 
            ORDER BY name ASC";
    $result = mysqli_query($link, $sql);

    $data = mysqli_fetch_all($result, MYSQLI_BOTH);

    mysqli_close($link);

    return $data;
}