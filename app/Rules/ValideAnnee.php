<?php

namespace App\Rules;

use App\Http\Controllers\util\Util;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValideAnnee implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $tabNotificattion=[
            "format non respecter XXXX-YYYY avec X, Y numerique",
            "Le pas entre année doit etre de 1 année",
            "Année Valide"
        ];
        $valChecking=Util::checkAnnee($value);
        if ($valChecking!==2) {
            $fail(':attribute !'.$tabNotificattion[$valChecking]);
        }
    }
}
