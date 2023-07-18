<?php
namespace App\Http\Controllers\util;

class Util{
    static function checkAnnee(string $annee):int{
        if (!preg_match('/^\d{4}-\d{4}$/', $annee)) {
            return 0;
        }
        $annees = explode('-', $annee);
    
       
        if ($annees[1] - $annees[0] !== 1) {
            return 1;
        }
        return 2;
    }
}