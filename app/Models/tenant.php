<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class tenant extends Model
{
    use HasUuids;

    protected $fillable = ['name', 'slug', 'status'];

    // Esto hace que Route Model Binding use slug
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps()->withPivot(['status']);
    }
}
