<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class Comment extends Model
    {
        protected $fillable = [
            'text', 'rating', 'user_id', 'video_game_id',
        ];

        public function user()
        {
            return $this->belongsTo(User::class);
        }


        public function videoGame()
        {
            return $this->belongsTo(VideoGame::class, 'video_game_id');
        }





    }
