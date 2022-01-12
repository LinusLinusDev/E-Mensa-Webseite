<!---
- Praktikum DBWT. Autoren:
- Linus, Palm, 3271087
- David, Rechkemmer, 3074595
--->
<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/benutzer.php');

/* Datei: controllers/HomeController.php */
class ProfileController {

    public function anmeldung(RequestData $request) {
        $msg = $_SESSION['login_result_message'] ?? null;
        return view('anmeldung',['msg' => $msg]);
    }

    public function anmeldung_verfizieren(RequestData $request) {
        $email = $request->query['email'] ?? false;
        $password = $request->query['password'] ?? false;

        $valid = db_benutzer_login($email,$password);

        $_SESSION['login_result_message'] = null;
        if($valid){
            $_SESSION['login_ok'] = true;
            $_SESSION['user_id'] = $valid;
            $_SESSION['user_email'] = $email;
            $target = $_SESSION['target'] ? $_SESSION['target'] : '';
            logger($email . " Login successful");
            header('Location: /'.$target);
        }
        else {
            $_SESSION['login_result_message'] = 'E-Mail oder Passwort ungültig.';
            logger($email . " Login failed", true);
            header('Location: /anmeldung');
        }
    }

    public function abmeldung() {
        $_SESSION['login_ok'] = null;
        $_SESSION['user_id'] = null;
        logger($_SESSION['user_email'] . " Logout successful");
        header('Location: /');
    }

    public function profil() {
        if(!isset($_SESSION['login_ok'])){
            $_SESSION['target'] = 'profil';
            header('Location: /anmeldung');
            return;
        }
        else {
            $userid = $_SESSION['user_id'];
            $data = db_get_data($userid);
            return view('profil',['data'=>$data[0]]);
        }
    }
}
