<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    protected $table = 'pesertas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'noreg', 'nama', 'konsentrasi_id', 'menginap'
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
