<!---
- Praktikum DBWT. Autoren:
- Linus, Palm, 3271087
- David, Rechkemmer, 3074595
--->
<?php
/**
 * Diese Datei enthält alle SQL Statements für die Tabelle "newsletter"
 */
function db_get_newsletterCount() {
    $link = connectdb();

    $sql = "SELECT count(name) as count FROM newsletter";
    $result = mysqli_query($link, $sql);

    $data = mysqli_fetch_all($result, MYSQLI_BOTH);

    mysqli_close($link);
    return $data;
}

function db_get_newsletter_sorted(RequestData $request) {
    $link = connectdb();

    $sort = isset($request->query['sort']) ? $request->query['sort'] : '';
    $filter = isset($request->query['filter']) ? $request->query['filter'] : '';

    $sort = mysqli_real_escape_string($link,$sort);
    $filter = mysqli_real_escape_string($link,$filter);

    $sql = "SELECT * FROM newsletter";
    if($filter != '') $sql = $sql." WHERE name LIKE '%".$filter."%' or familyname LIKE '%".$filter."%'";
    if($sort != '') $sql = $sql." ORDER BY ".$sort;
    $result = mysqli_query($link, $sql);

    $data = mysqli_fetch_all($result, MYSQLI_BOTH);

    mysqli_close($link);
    return $data;
}

function db_newsletter_newEntry(RequestData $request) {
    $name = isset($request->query['name']) ? trim($request->query['name']) : '';
    $familyname = isset($request->query['familyname']) ? trim($request->query['familyname']) : '';
    $email = isset($request->query['email']) ? trim($request->query['email']) : '';
    $language = $request->query['language'] ?? '';

    $regex = "/(.*rcpt.at)|(.*damnthespam.at)|(.*wegwerfmail.de)|(.*trashmail.de)|(.*trashmail.com)/";
    $mailok = filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match($regex, $email);

    if ($name != "" && $familyname != "" && $mailok) {
        $link = connectdb();

        $name = mysqli_real_escape_string($link,$name);
        $familyname = mysqli_real_escape_string($link,$familyname);
        $email = mysqli_real_escape_string($link,$email);
        $link->query("INSERT INTO newsletter (email,name,familyname,lang) VALUES ('$email','$name','$familyname','$language')");

        $_SESSION['message']='Sie wurden zum Newsletter angemeldet.';
    }
    else
    {
    if(($name == "" || $familyname == "") && !$mailok)$_SESSION['message']='E-Mail und Vor- bzw. Nachname entsprechen nicht den Vorgaben.';
    else if($name == "" || $familyname == "")$_SESSION['message']='Vor- bzw. Nachname entsprechen nicht den Vorgaben.';
    else if(!$mailok)$_SESSION['message']='E-Mail entspricht nicht den Vorgaben.';
        $_SESSION['warning']=true;
    }
}
