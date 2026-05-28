<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Equipment extends Model
{
    use HasFactory;

    protected $table = 'equipments';

    public const STATUS_AVAILABLE = 'available';

    public const STATUS_IN_USE = 'in_use';

    public const STATUS_MAINTENANCE = 'maintenance';

    public const STATUS_RESERVED = 'reserved';

    public const STATUS_RETIRED = 'retired';

    protected $fillable = [
        'name',
        'asset_number',
        'serial_number',
        'description',
        'category_id',
        'brand_id',
        'sector_id',
        'status',
        'acquisition_date',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'acquisition_date' => 'date',
        ];
    }

    /**
     * @return array<string, string>
     */
    public static function statuses(): array
    {
        return [
            self::STATUS_AVAILABLE => 'Disponível',
            self::STATUS_IN_USE => 'Em uso',
            self::STATUS_MAINTENANCE => 'Em manutenção',
            self::STATUS_RESERVED => 'Reservado',
            self::STATUS_RETIRED => 'Baixado',
        ];
    }

    public function statusLabel(): string
    {
        return self::statuses()[$this->status] ?? $this->status;
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function sector(): BelongsTo
    {
        return $this->belongsTo(Sector::class);
    }

    public function maintenances(): HasMany
    {
        return $this->hasMany(Maintenance::class);
    }
}
