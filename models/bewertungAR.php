<!---
- Praktikum DBWT. Autoren:
- Linus, Palm, 3271087
- David, Rechkemmer, 3074595
--->
<?php
/**
 * Active Record für die Tabelle "bewertung"
 */
class bewertungAR extends \Illuminate\Database\Eloquent\Model {

    public $timestamps = false;
    protected $table = 'bewertung';
}