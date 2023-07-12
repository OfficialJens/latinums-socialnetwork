<?php

namespace App\Models;

#use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Overtrue\LaravelLike\Traits\Likeable;

class Post extends Model
{
    use SoftDeletes, Likeable;

    protected $dates = ['deleted_at'];
    protected $fillable = ['body', 'author'];

    public function comments()
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id');
    }

    public function postAuthor()
    {
        return $this->belongsTo(User::class, 'author', 'id');
    }
}
