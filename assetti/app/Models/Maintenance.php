<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Maintenance extends Model
{
    use HasFactory;

    public const STATUS_OPEN = 'open';

    public const STATUS_IN_PROGRESS = 'in_progress';

    public const STATUS_COMPLETED = 'completed';

    public const STATUS_CANCELED = 'canceled';

    protected $fillable = [
        'equipment_id',
        'user_id',
        'maintenance_type',
        'problem_description',
        'solution_description',
        'maintenance_date',
        'estimated_cost',
        'status',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'maintenance_date' => 'date',
            'estimated_cost' => 'decimal:2',
        ];
    }

    /**
     * @return array<string, string>
     */
    public static function statuses(): array
    {
        return [
            self::STATUS_OPEN => 'Aberta',
            self::STATUS_IN_PROGRESS => 'Em andamento',
            self::STATUS_COMPLETED => 'Concluída',
            self::STATUS_CANCELED => 'Cancelada',
        ];
    }

    public function statusLabel(): string
    {
        return self::statuses()[$this->status] ?? $this->status;
    }

    public function equipment(): BelongsTo
    {
        return $this->belongsTo(Equipment::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
