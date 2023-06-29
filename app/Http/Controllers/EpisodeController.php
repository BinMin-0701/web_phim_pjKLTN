<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use App\Models\LinkMovie;
use App\Models\Movie;
use Illuminate\Http\Request;
use Carbon\Carbon; //Quan ly ngay thang

class EpisodeController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $list_episode = Episode::with('movie')->orderBy('id', 'DESC')->get();
    return view('admincp.espisode.index', compact('list_episode'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $list_movie = Movie::orderBy('id', 'DESC')->pluck('title', 'id');
    return view('admincp.espisode.form', compact('list_movie'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $data = $request->validate(
      [
        'movie_id' => 'required|unique:episodes',
        'link' => 'required',
        'episode' => 'required',
        'linkserver' => 'required',
      ],
      [
        'episode.unique' => 'Tập phim này đã tồn tại!',
        'slug.required' => 'Slug trống',
        'link.required' => 'Link phim không được để trống',
      ]
    );
    $episode = new Episode();
    $episode->movie_id = $data['movie_id'];
    $episode->linkphim = $data['link'];
    $episode->server = $data['linkserver'];
    $episode->episode = $data['episode'];
    $episode->created_at = Carbon::now('Asia/Ho_Chi_Minh');
    $episode->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
    $episode->save();
    toastr()->success('Thêm thành công.', 'Thành công');
    return redirect()->to('add-episode/'.$episode->movie_id);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $linkmovie = LinkMovie::orderBy('id', 'DESC')->pluck('title', 'id');
    $list_movie = Movie::orderBy('id', 'DESC')->pluck('title', 'id');
    $episode = Episode::find($id);
    return view('admincp.espisode.form', compact('episode', 'list_movie', 'linkmovie'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $data = $request->all();
    $episode = Episode::find($id);
    $episode->movie_id = $data['movie_id'];
    $episode->linkphim = $data['link'];
    $episode->server = $data['linkserver'];
    $episode->episode = $data['episode'];
    $episode->created_at = Carbon::now('Asia/Ho_Chi_Minh');
    $episode->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
    $episode->save();
    toastr()->success('Cập nhật thành công.', 'Thành công');
    return redirect()->to('add-episode/'.$episode->movie_id);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $episode = Episode::find($id)->delete();
    toastr()->success('Xóa thành công.', 'Thành công');
    return redirect()->to('episode');

  }

  public function select_movie()
  {
    $id = $_GET['id'];
    $movie = Movie::find($id);
    $output = '<option value="">--Chọn tập phim--</option>';
    if ($movie->thuocphim=='phimbo') {
      for ($i = 1; $i <= $movie->sotap; $i++) {
        $output .= '<option value="'.$i.'">'.$i.'</option>';
      } 
    }else{
      $output .= '<option value="FullHD">FullHD</option><option value="HD">HD</option>';
    }
    echo $output;
  }

  public function add_episode($id) {
    $linkmovie = LinkMovie::orderBy('id','DESC')->pluck('title','id');
    $link_server = LinkMovie::orderBy('id','DESC')->get();
    $movie = Movie::find($id);
    $list_episode = Episode::with('movie')->where('movie_id',$id)->orderBy('episode', 'DESC')->get();
    return view('admincp.espisode.add_episode', compact('linkmovie','list_episode', 'movie', 'link_server'));
  }
}
