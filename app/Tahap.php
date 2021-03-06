<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tahap extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama'
    ];

    public function absensi()
    {
        return $this->hasMany('App\Absensi', 'tahap_id');
    }
}
