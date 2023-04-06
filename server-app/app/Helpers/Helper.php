<?php

namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Helper 
{
    public static function generateFileName($file): string
    {
        $name = request()->name ?? 'imagem';

        if($file) {
            return Str::slug($name) . '-' . time() . "." . $file->getClientOriginalExtension();
        }
    }

    public static function getURLImage(string $filename): string
    {
        return Storage::url('patients/photos') . "/" . $filename;
    }

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

    public static function dateFormatDMY(string $date): string
    {
        return Carbon::createFromFormat('Y-m-d', $date)->format('d/m/Y');
    }

    public static function dateFormatYMD(string $date): string
    {
        return Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');
    }
}