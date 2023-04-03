<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Patient extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * 
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'mother_name',
        'birth_date',
        'cpf',
        'cns',
        'photo'
    ];

    protected function birthDate(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => Helper::dateFormatYMD($value),
        );
    }

    public function address(): HasOne
    {
        return $this->hasOne(Address::class);
    }
}
