<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Report extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'ticket_code',
        'user_id',
        'title',
        'category',
        'location',
        'description',
        'photo_path',
        'status',
        'admin_response',
        'responded_by',
        'responded_at',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'responded_at' => 'datetime',
        ];
    }

    /**
     * Categories list.
     */
    public const CATEGORIES = [
        'Infrastruktur & Jalan',
        'Kebersihan & Sampah',
        'Lampu & Kelistrikan',
        'Keamanan & Ketertiban',
        'Saluran Air & Banjir',
        'Lainnya',
    ];

    /**
     * Statuses list.
     */
    public const STATUSES = [
        'pending' => 'Menunggu Verifikasi',
        'diproses' => 'Sedang Diproses',
        'selesai' => 'Selesai Ditangani',
        'ditolak' => 'Laporan Ditolak',
    ];

    /**
     * The citizen who created the report.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The admin who responded to the report.
     */
    public function responder(): BelongsTo
    {
        return $this->belongsTo(User::class, 'responded_by');
    }

    /**
     * Helper to get public photo url.
     */
    public function getPhotoUrlAttribute(): ?string
    {
        if (!$this->photo_path) {
            return null;
        }

        return Storage::url($this->photo_path);
    }

    /**
     * Generate sequential ticket code: ERP-YYYY-XXXX
     */
    public static function generateTicketCode(): string
    {
        $year = date('Y');
        $prefix = "ERP-{$year}-";

        $latestReport = static::where('ticket_code', 'LIKE', "{$prefix}%")
            ->orderBy('id', 'desc')
            ->first();

        if ($latestReport) {
            $lastNumber = (int) substr($latestReport->ticket_code, -4);
            $nextNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $nextNumber = '0001';
        }

        return $prefix . $nextNumber;
    }
}
