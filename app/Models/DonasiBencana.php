<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonasiBencana extends Model
{
    use HasFactory;

    protected $table = 'donasi_bencana';
    protected $primaryKey = 'donasi_id';

    protected $fillable = [
        'kejadian_id',
        'donatur_nama',
        'jenis',
        'nilai'
    ];

    protected $casts = [
        'nilai' => 'decimal:2',
    ];

    // Relasi ke kejadian_bencana
    public function kejadian()
    {
        return $this->belongsTo(KejadianBencana::class, 'kejadian_id', 'kejadian_id');
    }

    // Accessor untuk format nilai
    public function getNilaiFormattedAttribute()
    {
        if ($this->jenis == 'uang') {
            return 'Rp ' . number_format($this->nilai, 0, ',', '.');
        }
        return number_format($this->nilai, 0) . ' barang';
    }

    public function media()
    {
        return $this->morphMany(Media::class, 'reference', 'ref_table', 'ref_id');
    }

    //  public function bukti_donasi()
    // {
    //     return $this->media()->where('ref_table', 'donasi_bencana');
    // }
}
