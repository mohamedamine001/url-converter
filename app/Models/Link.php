<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;

class Link extends Model
{
    use HasFactory;

    use Prunable;

    protected $fillable = ['original', 'converted', 'user_id'];

    /**
     * Get the prunable model query.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function prunable()
    {
        return static::where('created_at', '<=', now()->subDay());
    }

    /**
     * Get the user who creates the link.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
