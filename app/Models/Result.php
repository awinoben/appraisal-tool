<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Result extends Model
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
        'project_id',
        'overall_rating',
        'rating',
        'narrative ',
        'report_url ',
        'is_accepted',
        'is_rejected'
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

    /**
     * Get reports
     * @return HasMany
     */
    public function report()
    {
        return $this->hasMany(Report::class)->latest();
    }

    /**
     * Get escalates
     * @return HasOne
     */
    public function escalate()
    {
        return $this->hasOne(Escalate::class)->latest('updated_at');
    }
}
