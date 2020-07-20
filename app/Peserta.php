<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'noreg', 'nama', 'konsentrasi_id'
    ];

    public function konsentrasi()
    {
        return $this->belongsTo('App\Konsentrasi', 'konsentrasi_id');
    }

    public function absensi()
    {
        return $this->hasMany('App\Absensi', 'peserta_id');
    }
}
