<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KejadianBencana extends Model
{
    use HasFactory;

    protected $table      = 'kejadian_bencana';
    protected $primaryKey = 'kejadian_id';

    protected $fillable = [
        'jenis_bencana',
        'tanggal',
        'lokasi_text',
        'rt',
        'rw',
        'dampak',
        'status_kejadian',
        'keterangan',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function posko()
    {
        return $this->hasMany(PoskoBencana::class, 'kejadian_id', 'kejadian_id');
    }

      public function donasi()
    {
        return $this->hasMany(DonasiBencana::class, 'kejadian_id', 'kejadian_id');
    }

    // Accessor untuk total donasi
    public function getTotalDonasiAttribute()
    {
        return $this->donasi()->sum('nilai');
    }

    // Accessor untuk jumlah donatur
    public function getJumlahDonaturAttribute()
    {
        return $this->donasi()->count();
    }

    public function media()
    {
        return $this->morphMany(Media::class, 'reference', 'ref_table', 'ref_id');
    }

    // public function fotos()
    // {
    //     return $this->media()->where('ref_table', 'kejadian_bencana');
    // }





}
