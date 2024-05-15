<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class VideoGame extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'release',
        'cover',
        'box_art',
        'genres',
        'rating',
        'platform',
    ];


    public function comments()
    {

        return $this->belongsToMany(User::class, 'comments');

    }

    public function favorites()
    {

        return $this->belongsToMany('user', 'favorites' );

    }



}
