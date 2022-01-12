<!---
- Praktikum DBWT. Autoren:
- Linus, Palm, 3271087
- David, Rechkemmer, 3074595
--->
<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/kategorie.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../models/gericht.php');

class ExampleController
{
    public function m4_6a_queryparameter(RequestData $rd) {
        return view('examples.m4_6a_queryparameter', [
            'name'=>$rd->query['name'],
            'url' => 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}"
        ]);
    }

    public function m4_6b_kategorie() {
        $data = db_kategorie_select_names_sorted();
        return view('examples.m4_6b_kategorie', ['names' => $data]);
    }

    public function m4_6c_gerichte() {
        $data = db_gericht_select_names_prices_over2_ordered();
        return view('examples.m4_6c_gerichte', ['gerichte' => $data]);
    }

    public function m4_6d_layout(RequestData $rd) {
        if($rd->query['no']==1) return view('examples.m4_6d_page_1', []);
        if($rd->query['no']==2)return view('examples.m4_6d_page_2', []);
    }
}