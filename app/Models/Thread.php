<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Thread extends Model
{
    use HasFactory;

   /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'title'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function posts()
    {
        return $this->hasOne(Post::class);
    }
}
