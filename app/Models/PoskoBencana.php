<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PoskoBencana extends Model
{
    protected $table = 'posko_bencana';
    protected $primaryKey = 'posko_id';

    protected $fillable = [
        'kejadian_id',
        'nama',
        'alamat',
        'foto',
        'kontak',
        'penanggung_jawab',
        'media',
    ];

    // Relasi ke tabel kejadian_bencana
    public function kejadian()
    {
        return $this->belongsTo(KejadianBencana::class, 'kejadian_id', 'kejadian_id');
    }
}
