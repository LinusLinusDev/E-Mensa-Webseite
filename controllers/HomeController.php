<!---
- Author: Linus Palm
- Date: 14.01.2022
--->
<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/gericht.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/allergen.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/newsletter.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/wunschgericht.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/visitors.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/benutzer.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/bewertung.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/gerichtAR.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/bewertungAR.php');

/* Datei: controllers/HomeController.php */
class HomeController
{
    public function index(RequestData $request)
    {
        logger("/index.php");

        $visitors = get_visitors_and_update();
        $mealstotal = count(gerichtAR::all());
        if (isset($request->query['viewAll']) && $request->query['viewAll'] == true) $meals = db_gericht_select($mealstotal);
        else $meals = db_gericht_select(5);
        $allergene = db_allergen_select_all();
        $newsletterCount = db_get_newsletterCount()[0]['count'];
        $bewertungen = db_bewertungen_get_important();

        $message = $_SESSION['message'] ?? '';
        $_SESSION['message'] = '';
        $warning = $_SESSION['warning'] ?? false;
        $_SESSION['warning'] = false;
        $deleted = $_SESSION['deleted'] ?? false;
        $_SESSION['deleted'] = false;

        return view('hauptseite', ['meals' => $meals, 'mealstotal' => $mealstotal, 'allergene' => $allergene, 'newsletterCount' => $newsletterCount, 'visitors' => $visitors, 'message' => $message, 'warning' => $warning, 'deleted' => $deleted, 'bewertungen' => $bewertungen]);
    }

    public function wunschgericht()
    {
        return view('wunschgericht', []);
    }

    public function neues_wunschgericht(RequestData $request)
    {
        db_wunschgericht_newEntry($request);
        header('Location: /');
    }

    public function impressum()
    {
        return view('impressum', []);
    }

    public function newsletteranmeldungen(RequestData $request)
    {
        $data = db_get_newsletter_sorted($request);
        return view('newsletteranmeldungen', ['entrys' => $data]);
    }

    public function neue_newsletteranmeldung(RequestData $request)
    {
        db_newsletter_newEntry($request);
        header('Location: /');
    }

    public function bewertung(RequestData $request)
    {
        $gerichtid = $request->query['gerichtid'] ?? 1;
        $gericht = gerichtAR::find($gerichtid);
        if ($gericht == null) $gericht = gerichtAR::find(1);
        if (!isset($_SESSION['login_ok'])) {
            $_SESSION['target'] = "bewertung?gerichtid=$gerichtid";
            header('Location: /anmeldung');
            return;
        } else {
            $userid = $_SESSION['user_id'];
            return view('bewertung', ['gerichtid' => $gerichtid, 'userid' => $userid, 'bildname' => $gericht->bildname, 'name' => $gericht->name]);
        }
    }

    public function bewertung_speichern(RequestData $request)
    {
        db_bewertung_new_entry($request);
        header('Location: /');
    }

    public function bewertungen()
    {
        $data = db_bewertungen_get_all();
        $admin = $_SESSION['admin'] ?? 0;
        return view('bewertungen', ['bewertungen' => $data, 'admin' => $admin]);
    }

    public function meinebewertungen()
    {
        if (!isset($_SESSION['login_ok'])) {
            $_SESSION['target'] = "meinebewertungen";
            header('Location: /anmeldung');
            return;
        } else {
            $userid = $_SESSION['user_id'];
            $data = db_bewertungen_get_all_of_user($userid);
            return view('meinebewertungen', ['bewertungen' => $data]);
        }
    }

    public function bewertung_loeschen(RequestData $request)
    {
        bewertungAR::destroy($request->query['bewertungsid']);
        header('Location: /');
    }

    public function bewertung_hervorheben(RequestData $request)
    {
        $bewertung = bewertungAR::find($request->query['bewertungsid']);
        $bewertung->hervorheben = 1;
        $bewertung->save();
        header('Location: /');
    }

    public function bewertung_hervorheben_abwaehlen(RequestData $request)
    {
        $bewertung = bewertungAR::find($request->query['bewertungsid']);
        $bewertung->hervorheben = 0;
        $bewertung->save();
        header('Location: /');
    }
}