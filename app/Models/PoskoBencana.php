<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PoskoBencana extends Model
{
    use HasFactory;

    protected $table = 'posko_bencana';
    protected $primaryKey = 'posko_id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'posko_id',
        'kejadian_id',
        'nama',
        'alamat',
        'foto',
        'kontak',
        'penanggung_jawab',
        'media'
    ];

    public function kejadianBencana()
    {
        return $this->belongsTo(KejadianBencana::class, 'kejadian_id', 'kejadian_id');
    }
}
