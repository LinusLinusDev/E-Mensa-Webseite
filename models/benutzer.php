<!---
- Author: Linus Palm
- Date: 14.01.2022
--->
<?php
/**
 * Diese Datei enthält alle SQL Statements für die Tabelle "benutzer"
 */
function db_benutzer_login(String $email,String $password){
    $link = connectdb();

    if($email==''||$password=='')return false;

    $email = mysqli_real_escape_string($link,$email);
    $password = mysqli_real_escape_string($link,$password);

    $link->begin_transaction();

    $sql = "SELECT password,id,admin FROM benutzer WHERE email='$email'";
    $result = mysqli_query($link, $sql);

    $data = mysqli_fetch_all($result, MYSQLI_BOTH);

    if(isset($data[0]['password'])&&$data[0]['password']==sha1('Giraffe'.$password)){
        $id = $data[0]['id'];
        $_SESSION['admin']=$data[0]['admin'];
        $link->query("CALL valider_login($id)");
        $link->commit();
        mysqli_close($link);
        return $data[0]['id'];
    }
    else {
        $link->query("CALL invalider_login('$email')");
        $link->commit();
        mysqli_close($link);
        return false;
    }
}

function db_get_data(int $userid) {
    $link = connectdb();

    $sql = "SELECT email,admin,anzahlanmeldungen FROM benutzer WHERE id=$userid";
    $result = mysqli_query($link, $sql);

    $data = mysqli_fetch_all($result, MYSQLI_BOTH);

    return $data;
}