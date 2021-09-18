<?php

namespace App\Models;

use App\Utils;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favored extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'document',
        'email',
        'bank',
        'agency',
        'agencyDigit',
        'account',
        'accountDigit',
        'accountType',
        'valid'
    ];

    protected $casts = [
        'valid' => 'boolean'
    ];

    function setDocumentAttribute($value){
        $this->attributes['document'] = Utils::removeCaracter($value);
    }

}
