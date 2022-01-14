<?php

namespace App\Models;

use App\Events\SlugEvent;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use World\Countries\Model\Country;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable, SoftDeletes, Uuids;

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
        'branch_id',
        'country_id',
        'role_id',
        'name',
        'slug',
        'email',
        'employee_number',
        'employee_designation',
        'password',
        'is_active',
        'is_evaluated',
        'is_self_evaluated',
        'joining_date',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'joining_date' => 'datetime',
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
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier(): mixed
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims(): array
    {
        return [];
    }

    /**
     * role
     * @return BelongsTo
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
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
        return $this->hasMany(AssignedProject::class)
            ->latest();
    }

    /**
     * get project
     * @return HasOne
     */
    public function project(): HasOne
    {
        return $this->hasOne(Project::class)
            ->latest();
    }

    /**
     * get branch
     * @return BelongsTo
     */
    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    /**
     * report
     * @return HasMany
     */
    public function report(): HasMany
    {
        return $this->hasMany(Report::class)
            ->oldest('created_at');
    }

    /**
     * results
     * @return HasOne
     */
    public function result(): HasOne
    {
        return $this->hasOne(Result::class)
            ->oldest('created_at');
    }

    /**
     * personal_development
     * @return HasMany
     */
    public function personal_development(): HasMany
    {
        return $this->hasMany(PersonalDevelopment::class)
            ->latest('updated_at');
    }

    /**
     * behavioral
     * @return HasMany
     */
    public function behavioral(): HasMany
    {
        return $this->hasMany(Behavioral::class)
            ->oldest('created_at');
    }

    /**
     * leader_ship
     * @return HasMany
     */
    public function leader_ship(): HasMany
    {
        return $this->hasMany(LeaderShip::class)
            ->oldest('created_at');
    }

    /**
     * Get escalates
     * @return HasMany
     */
    public function escalate(): HasMany
    {
        return $this->hasMany(Escalate::class)
            ->where('is_closed', false)
            ->latest('updated_at');
    }

    /**
     * get team
     * @return HasOne
     */
    public function team(): HasOne
    {
        return $this->hasOne(Team::class);
    }

    /**
     * get team user
     * @return HasOne
     */
    public function team_user(): HasOne
    {
        return $this->hasOne(TeamUser::class);
    }

    /**
     * get appraisal_reports
     * @return HasOne
     */
    public function appraisal_report(): HasOne
    {
        return $this->hasOne(AppraisalReport::class);
    }
}
