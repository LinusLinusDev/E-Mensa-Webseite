<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/gericht.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/kategorie.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/bewertungAR.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/gerichtAR.php');

class DemoController
{
    public function dbconnect() {
        $data = db_gericht_select_all();

        return view('demo.dbdata', ['data' => $data]);
    }

    public function demo(RequestData $rd) {
        $gericht = gerichtAR::find(1);

        $gericht->vegetarisch='   n  E         in  ';
        $gericht->save();
    }

}