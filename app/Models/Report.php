<?php

namespace App\Models;

use App\Events\TrickTimeStampEvent;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends Model
{
    use HasFactory, Uuids, SoftDeletes;

    // stop autoincrement
    public $incrementing = false;

    /**
     * type of auto-increment
     *
     * @string
     */
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'result_id',
        'project_id',
        'key_result_area_id',
        'self_rating',
        'self_remarks',
        'appraiser_rating',
        'appraiser_remarks',
        'overall_rating',
        'reject_comments',
        'is_rated',
        'is_accepted',
        'is_rejected'
    ];

    /**
     * trigger this to set new timestamp
     * any save happens
     */
    protected $dispatchesEvents = [
        'saving' => TrickTimeStampEvent::class,
        'creating' => TrickTimeStampEvent::class,
        'updating' => TrickTimeStampEvent::class
    ];

    /**
     * Get user
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get project
     * @return BelongsTo
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Get key_result_area
     * @return BelongsTo
     */
    public function key_result_area(): BelongsTo
    {
        return $this->belongsTo(KeyResultArea::class);
    }

    /**
     * Get result
     * @return BelongsTo
     */
    public function result(): BelongsTo
    {
        return $this->belongsTo(Result::class);
    }
}
