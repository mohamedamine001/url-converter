<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Agent\Agent;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Log extends Model
{
    use HasFactory;

    protected $appends = ['browser'];

    protected $fillable = [
        'source',
         'ip',
         'country',
         'user_agent',
         'user_id',
    ];

    const UPDATED_AT = null;
    
    /**
     * Get the name of the browser used to access the resource.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function getBrowserAttribute()
    {
        $agent = new Agent();
        $agent->setUserAgent($this->user_agent);
        return $agent->browser();
    }

    /**
     * Get the user who creates the link.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
