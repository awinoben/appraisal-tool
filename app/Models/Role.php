<?php

namespace App\Models;

use App\Events\SlugEvent;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
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
        'name',
        'slug',
        'description',
        'level',
    ];

    /**
     * trigger this to create a slug and level before
     * any save happens
     */
    protected $dispatchesEvents = [
        'saving' => SlugEvent::class,
        'creating' => SlugEvent::class,
        'updating' => SlugEvent::class
    ];

    /**
     * user
     * @return HasMany
     */
    public function user()
    {
        return $this->hasMany(User::class)->latest();
    }

    /**
     * key_performance_indicator
     * @return HasMany
     */
    public function key_performance_indicator()
    {
        return $this->hasMany(KeyPerformanceIndicator::class)->oldest('created_at');
    }
}
