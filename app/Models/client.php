<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use App\Models\Concerns\BelongsToTenant;

class Client extends Model
{
    use HasUuids, BelongsToTenant;

    protected $fillable = ['name', 'email', 'phone', 'tags', 'notes'];

    protected $casts = [
        'tags' => 'array',
    ];
}
