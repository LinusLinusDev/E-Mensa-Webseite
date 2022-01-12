<!---
- Praktikum DBWT. Autoren:
- Linus, Palm, 3271087
- David, Rechkemmer, 3074595
--->
<?php
/**
 * Active Record für die Tabelle "gericht"
 */
class gerichtAR extends \Illuminate\Database\Eloquent\Model {

    public $timestamps = false;
    protected $table = 'gericht';

    function getPreisinternAttribute($value){
        return number_format($value,2,',').' €';
    }

    function getPreisexternAttribute($value){
        return number_format($value,2,',').' €';
    }

    function setVegetarischAttribute($value){
        $value=strtolower(str_replace(' ', '', $value));
        if($value=='yes'||$value=='ja')$this->attributes['vegetarisch']=1;
        if($value=='no'||$value=='nein')$this->attributes['vegetarisch']=0;
    }

    function setVeganAttribute($value){
        $value=strtolower(str_replace(' ', '', $value));
        if($value=='yes'||$value=='ja')$this->attributes['vegetarisch']=1;
        if($value=='no'||$value=='nein')$this->attributes['vegetarisch']=0;
    }
}