<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    // Using AppServiceProvider : Model::unguard(); //
    // No Need => protected $fillable = ['title', 'company', 'website', 'location', 'tags', 'email', 'description'];

    public function scopeFilter($query, array $filter)
    {
        if ($filter['tag'] ?? false) {
            $query->where('tags', 'like', '%' . request('tag') . '%');
        }

        if ($filter['search'] ?? false) {
            $query->where('title', 'like', '%' . request('search') . '%')
                ->orWhere('description', 'like', '%' . request('search') . '%')
                ->orWhere('tags', 'like', '%' . request('search') . '%')
                ->orWhere('location', 'like', '%' . request('search') . '%');
        }
    }

    // Relationship To User
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
