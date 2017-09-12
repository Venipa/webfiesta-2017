<?php
class currency {
    public static function fiesta($money = null) {
        $length = strlen($money);
        $copper = retOKnumber($length-3) ? substr($money, $length-3, 3) : 0;
        $silver = retOKnumber($length-6) ? substr($money, $length-6, 3) : 0;
        $gold = retOKnumber($length-8) ? substr($money, $length-8, 2) : 0;
        $gem = retOKnumber($length-10) ? substr($money, $length-10, 3): 0;
    
        $copper = printf("%03d", $copper);
        $silver = printf("%03d", $silver);
        $gold = printf("%02d", $gold);
        $gem = printf("%03d", $gem);
    
    return "<div class='currency_display'>
    <span>$gem</span>
    <span>$gold</span>
    <span>$silver</span>
    <span>$copper</span>
    </div>";
    }
static function retOKnumber($n, $retOK = false) {
    if($retOK) {
        if($n >= 0) {
            return $n;
        } else {
            return 0;
        }
    } else {
        if($n >= -1) {
            return true;
        } else {
            return false;
        }
    }
}
}