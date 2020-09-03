<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'peserta_id', 'tahap_id', 'agenda_id', 'jam_datang', 'jam_pulang', 'status'
    ];

    public function peserta()
    {
        return $this->belongsTo('App\Peserta', 'peserta_id');
    }

    public function tahap()
    {
        return $this->belongsTo('App\Tahap', 'tahap_id');
    }

    public function agenda()
    {
        return $this->belongsTo('App\Agenda', 'agenda_id');
    }
}
