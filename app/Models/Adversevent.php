<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Adversevent extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_id',
        'misto',
        'datum_cas',
        'cas',
        'spec_druh',
        'jinydoplnek',
        'pracovnik',
        'svedek',
        'pacient',
        'datumnaroz',
        'chorobopis',
        'udalost',
        'reseni',
        'opatreni',
        'informovan',
        'pricina',
        'jina_pricina',
        'stav_pacienta',
        'lokalizace',
        'druh_zraneni',
        'preventivni_opatreni',
        'zhodnoceni_stavu',
        'datum',
        'jmeno_lekare',
        'vyvoj',
        'upresneni',
        'status',
        'resitel',
        'vyjadreni',
        'resitel1',
        'vyjadreni1',
        'resitel2',
        'vyjadreni2'
    ];

    public function department()
    {
        return $this->belongsTo(Department::class, 'id');
    }
}
