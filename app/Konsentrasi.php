<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Konsentrasi extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama'
    ];

    public function user()
    {
        return $this->hasMany('App\Peserta', 'konsentrasi_id');
    }
}
