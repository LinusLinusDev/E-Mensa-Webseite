<!---
- Author: Linus Palm
- Date: 14.01.2022
--->
<?php
/**
 * Active Record für die Tabelle "bewertung"
 */
class bewertungAR extends \Illuminate\Database\Eloquent\Model {

    public $timestamps = false;
    protected $table = 'bewertung';
}