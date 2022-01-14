<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CSVData extends Model
{
    use HasFactory, Uuids;

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
        'file',
        'data',
        'processed',
        'queued_at',
    ];

    /**
     * create casts
     */
    protected $casts = [
        'data' => 'array',
    ];
}
