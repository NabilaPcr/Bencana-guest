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

    public function kejadian()
    {
        return $this->belongsTo(KejadianBencana::class, 'kejadian_id', 'kejadian_id');
    }

    public function media()
    {
        return $this->hasMany(\App\Models\Media::class, 'ref_id', 'donasi_id')
                    ->where('ref_table', 'donasi_bencana')
                    ->orderBy('sort_order');
    }

    // Helper untuk format nilai
    public function getNilaiFormattedAttribute()
    {
        if ($this->jenis == 'uang') {
            return 'Rp ' . number_format($this->nilai, 0, ',', '.');
        }
        return number_format($this->nilai, 0) . ' barang';
    }
}
