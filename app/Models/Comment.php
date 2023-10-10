<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    // User relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $fillable = [
        'comment_id',
        'stock_book_id',
        'user_id',
        'comment',
        'recommend'
    ];
}