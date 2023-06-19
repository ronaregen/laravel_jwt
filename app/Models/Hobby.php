<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Hobby extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $hidden = ['id', 'user_id', 'created_at', 'updated_at'];


    function Member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }
}
