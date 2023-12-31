<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\User;
use Symfony\Polyfill\Intl\Idn\Info;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   *
   * @return void
   */
  public function register()
  {
    //
  }

  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot()
  {
    // $phimhot_sidebar = Movie::where('phimhot',1)->where('status',1)->orderBy('ngaycapnhat','DESC')->take(30)->get();
    // $phimhot_trailer = Movie::where('resolution',1)->where('status',1)->orderBy('ngaycapnhat','DESC')->take(10)->get();
    // $category = Category::orderBy('id','DESC')->get();
    // $genre = Genre::orderBy('id','DESC')->get();
    // $country = Country::orderBy('id', 'DESC')->get();

    // Total Admin
    $category_total = Category::all()->count();
    $genre_total = Genre::all()->count();
    $country_total = Country::all()->count();
    $movie_total = Movie::all()->count();
    $account_total = User::all()->count();

    // $info = Info::find(1);

    View::share([
      // 'info'=>$info,
      // 'phimhot'=>$info,
      // 'phimhot_sidebar'=>$phimhot_sidebar,
      // 'phimhot_trailer'=>$phimhot_trailer,
      // 'category_home'=>$category,
      // 'genre_home'=>$genre,
      // 'country_home'=>$country,

      'category_total' => $category_total,
      'genre_total' => $genre_total,
      'country_total' => $country_total,
      'movie_total' => $movie_total,
      'account_total' => $account_total,
    ]);
  }
}
