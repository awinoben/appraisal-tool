<?php

namespace App\Models;

use App\Events\GlobalEvent;
use App\Events\SlugEvent;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Team extends Model
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
        'name',
        'slug',
    ];

    /**
     * trigger this to create a slug before
     * any save happens
     */
    protected $dispatchesEvents = [
        'saving' => SlugEvent::class,
        'creating' => SlugEvent::class,
        'updating' => SlugEvent::class
    ];

    /**
     * Get user
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get team user
     * @return HasMany
     */
    public function team_user(): HasMany
    {
        return $this->hasMany(TeamUser::class)->latest();
    }
}
