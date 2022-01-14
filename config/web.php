<!---
- Author: Linus Palm
- Date: 14.01.2022
--->
<?php
/**
 * Mapping of paths to controllers.
 */

return array(
    '/'             => 'HomeController@index',
    '/dbconnect'    => 'DemoController@dbconnect',
    '/wunschgericht' => 'HomeController@wunschgericht',
    '/impressum' => 'HomeController@impressum',
    '/newsletteranmeldungen' => 'HomeController@newsletteranmeldungen',
    '/anmeldung' => 'ProfileController@anmeldung',
    '/anmeldung_verfizieren' => 'ProfileController@anmeldung_verfizieren',
    '/logout' => 'ProfileController@abmeldung',
    '/profil' => 'ProfileController@profil',
    '/bewertung' => 'HomeController@bewertung',
    '/bewertung_speichern' => 'HomeController@bewertung_speichern',
    '/bewertungen' => 'HomeController@bewertungen',
    '/meinebewertungen' => 'HomeController@meinebewertungen',
    '/bewertung_loeschen' => 'HomeController@bewertung_loeschen',
    '/neue_newsletteranmeldung' => 'HomeController@neue_newsletteranmeldung',
    '/neues_wunschgericht' => 'HomeController@neues_wunschgericht',
    '/bewertung_hervorheben' => 'HomeController@bewertung_hervorheben',
    '/bewertung_hervorheben_abwaehlen' => 'HomeController@bewertung_hervorheben_abwaehlen'
);