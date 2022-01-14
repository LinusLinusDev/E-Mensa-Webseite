<!---
- Author: Linus Palm
- Date: 14.01.2022
--->
<?php
/**
 * Diese Datei enthält alle SQL Statements für die Tabelle "gerichte"
 */

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