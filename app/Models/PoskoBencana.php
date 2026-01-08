<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PoskoBencana extends Model
{
    protected $table      = 'posko_bencana';
    protected $primaryKey = 'posko_id';

    // Jika posko_id adalah auto increment, jangan masukkan ke fillable
    protected $fillable = [
        'kejadian_id',
        'nama',
        'alamat',
        'kontak',
        'penanggung_jawab',
    ];

    // Relasi ke tabel kejadian_bencana
    public function kejadian()
    {
        return $this->belongsTo(KejadianBencana::class, 'kejadian_id', 'kejadian_id');
    }

    /**
     * Helper untuk ambil data dari tabel media (tanpa relasi Eloquent)
     */
    public function getMediaFiles()
    {
        return \DB::table('media')
            ->where('ref_table', 'posko_bencana')
            ->where('ref_id', $this->posko_id)
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
            $path = 'storage/uploads/posko_bencana/' . $fileName;
            if (file_exists(public_path($path))) {
                return asset($path);
            }

            return $placeholder;
        }

        return $placeholder;
    }

    /**
     * Get all images URLs
     */
    public function getImagesUrls()
    {
        $files  = $this->getMediaFiles();
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
    public function hasRealImages()
    {
        $files = $this->getMediaFiles();

        if ($files->isEmpty()) {
            return false;
        }

        foreach ($files as $file) {
            if (! $this->isPlaceholder($file->file_name)) {
                $path = 'storage/uploads/posko_bencana/' . $file->file_name;
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
     * Accessor untuk cek apakah ada gambar real
     */
    public function getHasRealImagesAttribute()
    {
        return $this->hasRealImages();
    }

    // Di model PoskoBencana.php
    public function scopeAvailable($query)
    {
        return $query->whereNull('kejadian_id')
            ->orWhere('kejadian_id', '');
    }


}
