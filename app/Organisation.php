<?php

declare(strict_types=1);

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Organisation
 *
 * @property int         id
 * @property string      name
 * @property int         owner_user_id
 * @property Carbon      trial_end
 * @property bool        subscribed
 * @property Carbon      created_at
 * @property Carbon      updated_at
 * @property Carbon|null deleted_at
 *
 * @package App
 */
class Organisation extends Model
{
    use SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = [
        'id', 
        'name', 
        'owner_user_id', 
        'subscribed', 
        'trial_end'
    ];

    /**
     * @var array
     */
    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
        'trial_end',
    ];

    /**
     * @return BelongsTo
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_user_id', 'id');
    }

    public function getTrialEndAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('dateformat.date_format')) : null;
    }

    public function setTtialDateAttribute($value)
    {
        $this->attributes['trail_date'] = $value ? Carbon::createFromFormat(config('dateformat.date_format'), $value)->format('Y-m-d') : null;
    }
}
