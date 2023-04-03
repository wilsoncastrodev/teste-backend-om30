<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class Helper 
{
    public static function generateCNS(): string
    {
        try {
            do {
                $response = Http::get('https://geradorbrasileiro.com/api/faker/cns');
                $cns = $response->collect()['values'][0];
            } while (str_contains($cns, ','));
    
            return $cns;
        } catch (Exception $e) {
            return "";
        }
    }

    public static function dateFormatYMD(string $date): string
    {
        return Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');
    }
}