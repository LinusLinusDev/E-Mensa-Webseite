<!---
- Praktikum DBWT. Autoren:
- Linus, Palm, 3271087
- David, Rechkemmer, 3074595
--->
<?php
/**
 * Mapping of paths to controllers.
 * Note, that the path only supports one level of directory depth:
 *     /demo is ok,
 *     /demo/subpage will not work as expected
 */

return array(
    '/'             => 'HomeController@index',
    '/demo'         => 'DemoController@demo',
    '/dbconnect'    => 'DemoController@dbconnect',
    '/debug'        => 'HomeController@debug',
    '/m4_6a_queryparameter' => 'ExampleController@m4_6a_queryparameter',
    '/m4_6b_kategorie' => 'ExampleController@m4_6b_kategorie',
    '/m4_6c_gerichte' => 'ExampleController@m4_6c_gerichte',
    '/m4_6d_layout' => 'ExampleController@m4_6d_layout',
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