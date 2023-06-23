<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie_Genre extends Model
{
  use HasFactory;
  public $timestamps = false;
  protected $table = 'movie_genre';
  // 1 thể loại chỉ thuộc 1 phim
  // public function movie_genre()
  // {
  //   return $this->belongsTo(Movie::class);
  // }
}
