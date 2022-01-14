<!---
- Author: Linus Palm
- Date: 14.01.2022
--->
<?php
/**
 * Diese Datei enthält alle SQL Statements für die Tabelle "bewertung"
 */
function db_bewertung_new_entry(RequestData $request) {
    $gerichtid = $request->query['gerichtid'];
    $userid = $request->query['userid'];
    $sternebewertung = $request->query['sternebewertung'];
    $bemerkung = trim($request->query['bemerkung']);
    if($bemerkung==''){
        $_SESSION['message']='Die Bemerkung muss aus mindestens 5 nicht leeren Zeichen bestehen.';
        $_SESSION['warning']=true;
    }
    else {
        $link = connectdb();

        $bemerkung = mysqli_real_escape_string($link,$bemerkung);

        $link->query("INSERT INTO bewertung (sternebewertung,bemerkung,erstellerId,bewertungszeitpunkt) VALUES ('$sternebewertung','$bemerkung','$userid',CURRENT_TIMESTAMP)");
        $link->query("INSERT INTO bewertung_bewertet_gericht(gerichtid,bewertungsid) VALUES ('$gerichtid',LAST_INSERT_ID())");

        mysqli_close($link);

        $_SESSION['message']='Deine Bewertung wurde gespeichert.';
    }
}

function db_bewertungen_get_all() {
    $link = connectdb();

    $sql = "SELECT bewertung.id,hervorheben,bewertungszeitpunkt,sternebewertung,bemerkung,gericht.name FROM bewertung left join bewertung_bewertet_gericht on bewertung.id = bewertungsid left JOIN gericht on gerichtid = gericht.id ORDER BY bewertungszeitpunkt DESC LIMIT 30";
    $result = mysqli_query($link, $sql);

    $data = mysqli_fetch_all($result, MYSQLI_BOTH);

    mysqli_close($link);

    return $data;
}

function db_bewertungen_get_all_of_user(int $userid) {
    $link = connectdb();

    $sql = "SELECT bewertung.id,bewertungszeitpunkt,sternebewertung,bemerkung,gericht.name FROM bewertung left join bewertung_bewertet_gericht on bewertung.id = bewertungsid left JOIN gericht on gerichtid = gericht.id WHERE erstellerId = $userid ORDER BY bewertungszeitpunkt DESC";
    $result = mysqli_query($link, $sql);

    $data = mysqli_fetch_all($result, MYSQLI_BOTH);

    mysqli_close($link);

    return $data;
}

function db_bewertungen_get_important() {
    $link = connectdb();

    $sql = "SELECT sternebewertung,bemerkung,gericht.name FROM bewertung left join bewertung_bewertet_gericht on bewertung.id = bewertungsid left JOIN gericht on gerichtid = gericht.id WHERE hervorheben = 1 ORDER BY bewertungszeitpunkt DESC";
    $result = mysqli_query($link, $sql);

    $data = mysqli_fetch_all($result, MYSQLI_BOTH);

    mysqli_close($link);

    return $data;
}

function db_bewertung_delete_one (int $bewertungsid) {
    $link = connectdb();
    $link->query("DELETE FROM bewertung WHERE id=$bewertungsid");
    mysqli_close($link);
    $_SESSION['message']='Ihre Bewertung wurde gelöscht.';
    $_SESSION['deleted']=true;
}

function db_bewertung_hervorheben(int $bewertungsid) {
    $link = connectdb();
    $link->query("UPDATE bewertung SET hervorheben = 1 WHERE id=$bewertungsid");
    mysqli_close($link);
    $_SESSION['message']='Ihre Bewertung wird nun hervorgehoben.';
}

function db_bewertung_hervorheben_abwaehlen (int $bewertungsid) {
    $link = connectdb();
    $link->query("UPDATE bewertung SET hervorheben = 0 WHERE id=$bewertungsid");
    mysqli_close($link);
    $_SESSION['message']='Ihre Bewertung wird nun nicht mehr hervorgehoben.';
}