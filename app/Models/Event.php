<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'local',
        'obrigatorio',
    ];

    protected $guarded = [];

    protected $dates = ['date'];

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }

    public function usersWhoFavorited()
    {
        return $this->belongsToMany(User::class, 'event_user_favorites');
    }

}
