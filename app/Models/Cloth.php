<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cloth extends Model {
    use HasFactory;

    // Include 'user_id' in fillable if you plan to mass assign it
    protected $fillable = ['name', 'category', 'isFavorite', 'image_url', 'user_id'];

    /**
     * Each cloth belongs to a single user.
     */
    public function user() {
         return $this->belongsTo(User::class);
    }
}
