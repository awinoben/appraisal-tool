<?php

namespace App\Models;

use App\Events\TrickTimeStampEvent;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PersonalDevelopment extends Model
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
        'project_id',
        'user_id',
        'type',
        'personal_development',
        'what_to_do',
        'achievement',
        'actions',
        'manager_comments',
        'on_track',
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
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
