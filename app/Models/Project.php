<?php

namespace App\Models;

use App\Events\SlugEvent;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use World\Countries\Model\Country;

class Project extends Model
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
        'country_id',
        'user_id',
        'name',
        'slug',
        'supervisor_emails',
        'description',
        'is_closed',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'supervisor_emails' => 'array',
    ];

    /**
     * trigger this to create a slug before
     * any save happens
     */
    protected $dispatchesEvents = [
        'saving' => SlugEvent::class,
        'creating' => SlugEvent::class,
        'updating' => SlugEvent::class,
    ];

    /**
     * user
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * country
     * @return BelongsTo
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * assigned_projects
     * @return HasMany
     */
    public function assigned_project(): HasMany
    {
        return $this->hasMany(AssignedProject::class)->whereNotIn('user_id', [request()->user()->id])->latest();
    }

    /**
     * assigned_projects
     * @return HasMany
     */
    public function assigned_projects(): HasMany
    {
        return $this->hasMany(AssignedProject::class)->latest();
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

    /**
     * personal_developments
     * @return HasMany
     */
    public function personal_development(): HasMany
    {
        return $this->hasMany(PersonalDevelopment::class)->latest();
    }

    /**
     * behavioral
     * @return HasMany
     */
    public function behavioral(): HasMany
    {
        return $this->hasMany(Behavioral::class)->latest();
    }

    /**
     * leader_ship
     * @return HasMany
     */
    public function leader_ship(): HasMany
    {
        return $this->hasMany(LeaderShip::class)
            ->oldest();
    }
}
