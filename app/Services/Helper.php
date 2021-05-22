<?php


namespace App\Services;


use Carbon\Carbon;

class Helper
{
    public static function formatDateTime($value, $format = 'd/m/Y H:i:s')
    {
        return Carbon::parse($value)->format($format);
    }

}
