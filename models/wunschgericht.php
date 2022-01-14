<!---
- Author: Linus Palm
- Date: 14.01.2022
--->
<?php
/**
 * Diese Datei enthält alle SQL Statements für die Tabelle "wunschgericht"
 */
function db_wunschgericht_newEntry(RequestData $request){
    $foodname = isset($request->query['foodname']) ? trim($request->query['foodname']) : '';
    $descr = isset($request->query['descr']) ? trim($request->query['descr']) : '';
    $name = isset($request->query['name']) ? trim($request->query['name']) : '';
    $email = isset($request->query['email']) ? trim($request->query['email']) : '';

    $regex = "/(.*rcpt.at)|(.*damnthespam.at)|(.*wegwerfmail.de)|(.*trashmail.de)|(.*trashmail.com)/";
    $mailok = filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match($regex, $email);

    if($mailok){
        $link = connectdb();

        $foodname = mysqli_real_escape_string($link,$foodname);
        $descr = mysqli_real_escape_string($link,$descr);
        $name = mysqli_real_escape_string($link,$name);
        $email = mysqli_real_escape_string($link,$email);

        if ($name != '') $link->query("INSERT INTO erstellerin (email,name) VALUES ('$email','$name')");
        else $link->query("INSERT INTO erstellerin (email) VALUES ('$email')");

        $date = date('Y-m-d', time());
        $link->query("INSERT INTO wunschgericht (erstellungsdatum,beschreibung,name,erstelltVonEmail) VALUES ('$date','$descr','$foodname','$email')");

        mysqli_close($link);

        $_SESSION['message']='Dein Wunschgericht wurde gespeichtert.';
    }
    else {
        $_SESSION['warning']=true;
        $_SESSION['message']='E-Mail entspricht nicht den Vorgaben.';
    }
}