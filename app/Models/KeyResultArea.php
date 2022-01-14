<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class KeyResultArea extends Model
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
        'slug'
    ];

    /**
     * trigger this to create a slug before
     * any save happens
     */
//    protected $dispatchesEvents = [
//        'saving' => SlugEvent::class,
//        'creating' => SlugEvent::class,
//        'updating' => SlugEvent::class,
//    ];

    /**
     * key_performance_indicator
     * @return HasMany
     */
    public function key_performance_indicator(): HasMany
    {
        return $this->hasMany(KeyPerformanceIndicator::class)->oldest();
    }

    /**
     * report
     * @return HasMany
     */
    public function report(): HasMany
    {
        return $this->hasMany(Report::class)->latest();
    }

    /**
     * results
     * @return HasMany
     */
    public function result(): HasMany
    {
        return $this->hasMany(Result::class)->latest();
    }
}
