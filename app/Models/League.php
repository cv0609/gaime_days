<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class League extends Model
{
    protected $fillable = [
        'league_id',
        'name',
        'type',
        'logo',
        'country_name',
        'country_code',
        'country_flag',
        'start_date',
        'year',
        'end_date',
    ];

    use HasFactory;


    public function leagueMatches(){
        return $this->hasMany(Matche::class,'league_id','id');
    } 
}
