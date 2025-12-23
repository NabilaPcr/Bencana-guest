<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistribusiLogistik extends Model
{
    use HasFactory;

    protected $table = 'distribusi_logistik';
    protected $primaryKey = 'distribusi_id';

    protected $fillable = [
        'logistik_id',
        'posko_id',
        'tanggal',
        'jumlah',
        'penerima',
        'lokasi',
        'keterangan',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'jumlah' => 'integer',
    ];

    /**
     * Relasi ke logistik bencana
     */
    public function logistik()
    {
        return $this->belongsTo(LogistikBencana::class, 'logistik_id', 'logistik_id');
    }

    /**
    
     */
    public function posko()
    {
        return $this->belongsTo(PoskoBencana::class, 'posko_id', 'posko_id');
    }

    /**

     */
    public function getMediaFiles()
    {
        return \DB::table('media')
            ->where('ref_table', 'distribusi_logistik')
            ->where('ref_id', $this->distribusi_id)
            ->orderBy('sort_order')
            ->get();
    }

    /**
     * Cek apakah file adalah placeholder
     */
    public function isPlaceholder($fileName)
    {
        $placeholderNames = [
            'placeholder.jpg',
            'placeholder.png',
            'no-image.jpg',
            'no-image.png',
            'default.jpg',
        ];

        return in_array($fileName, $placeholderNames) ||
               str_contains($fileName, 'placeholder') ||
               str_contains($fileName, 'no-image') ||
               str_contains($fileName, 'default');
    }

    /**
     * Get image URL dengan fallback ke placeholder
     */
    public function getImageUrl($fileName = null)
    {
        // Default placeholder
        $placeholder = asset('assets/images/placeholder.png');

        // Jika ada nama file spesifik
        if ($fileName) {
            if ($this->isPlaceholder($fileName)) {
                return $placeholder;
            }

            // Cek apakah file asli ada di storage
            $path = 'storage/uploads/distribusi_logistik/' . $fileName;
            if (file_exists(public_path($path))) {
                return asset($path);
            }

            return $placeholder;
        }

        return $placeholder;
    }

    /**
     * Get all images URLs untuk bukti distribusi
     */
    public function getBuktiDistribusiUrls()
    {
        $files = $this->getMediaFiles();
        $images = [];

        if ($files->isEmpty()) {
            // Jika tidak ada gambar, berikan 1 placeholder
            return [$this->getImageUrl()];
        }

        foreach ($files as $file) {
            $images[] = $this->getImageUrl($file->file_name);
        }

        return $images;
    }

    /**
     * Check if has real images (bukan placeholder)
     */
    public function hasRealBuktiDistribusi()
    {
        $files = $this->getMediaFiles();

        if ($files->isEmpty()) {
            return false;
        }

        foreach ($files as $file) {
            if (!$this->isPlaceholder($file->file_name)) {
                $path = 'storage/uploads/distribusi_logistik/' . $file->file_name;
                if (file_exists(public_path($path))) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Accessor untuk mendapatkan data media di view
     */
    public function getMediaAttribute()
    {
        return $this->getMediaFiles();
    }

    /**
     * Accessor untuk cek apakah ada gambar bukti real
     */
    public function getHasRealBuktiAttribute()
    {
        return $this->hasRealBuktiDistribusi();
    }

    /**
     * Format tanggal untuk display
     */
    public function getTanggalFormattedAttribute()
    {
        return $this->tanggal->format('d F Y');
    }
}
