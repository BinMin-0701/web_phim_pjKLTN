@extends('layout')
@section('content')
<div class="row container" id="wrapper">
  <div class="halim-panel-filter">
    <div class="panel-heading">
      <div class="row">
        <div class="col-xs-6">
          <div class="yoast_breadcrumb hidden-xs"><span>
              <span>
                <a href="{{route('category',[$movie->category->slug])}}">{{$movie->category->title}}</a> »
                <span>
                  <a href="{{route('country',[$movie->country->slug])}}">{{$movie->country->title}}</a> »

                  <span class="breadcrumb_last" aria-current="page">
                    {{$movie->title}}
                  </span>
                </span>
              </span>
            </span>
          </div>
        </div>
      </div>
    </div>
    <div id="ajax-filter" class="panel-collapse collapse" aria-expanded="true" role="menu">
      <div class="ajax"></div>
    </div>
  </div>
  <main id="main-contents" class="col-xs-12 col-sm-12 col-md-8">
    <section id="content" class="test">
      <div class="clearfix wrap-content">

        <div class="halim-movie-wrapper">
          <div class="title-block">
            <!-- <div id="bookmark" class="bookmark-img-animation primary_ribbon" data-id="38424">
              <div class="halim-pulse-ring"></div>
            </div>
            <div class="title-wrapper" style="font-weight: bold;">
              Bookmark
            </div> -->
          </div>
          <div class="movie_info col-xs-12">
            <div class="movie-poster col-md-3">
              <img class="movie-thumb" src="{{asset('uploads/movie/'.$movie->image)}}" alt="{{$movie->title}}">
              <!-- Nếu mà có tập phim->chiếu tập phim mới nhất -->
              <!-- Chiếu phim -->
              @if ($movie->resolution!='5')
                @if ($episode_current_list_count>0)
                <div class="bwa-content">
                  <div class="loader"></div>
                  <a href="{{url('xem-phim/'.$movie->slug.'/tap-'.$episode_tapdau->episode)}}" class="bwac-btn">
                    <i class="fa fa-play"></i>
                  </a>
                </div>
                @endif
              @if(isset($episode->movie))
              @endif
              <!-- Không có link phim/tập phim->xem trailer -->
              @else
              <a href="#watch_trailer" style="display: block;" class="btn btn-primary watch_trailer">
                Xem Trailer
              </a>
              @endif
            </div>
            <div class="film-poster col-md-9">
              <h1 class="movie-title title-1" style="display:block;line-height:35px;margin-bottom: -14px;color: #ffed4d;text-transform: uppercase;font-size: 18px;">{{$movie->title}}</h1>
              <h2 class="movie-title title-2" style="font-size: 12px;">{{$movie->name_eng}}</h2>
              <ul class="list-info-group">
                <li class="list-info-group-item"><span>Trạng Thái</span> : <span class="quality">
                    @if($movie->resolution==0)
                    HD
                    @elseif ($movie->resolution==1)
                    SD
                    @elseif ($movie->resolution==2)
                    HDCam
                    @elseif ($movie->resolution==3)
                    Cam
                    @elseif ($movie->resolution==4)
                    FullHD
                    @else
                    Trailer
                    @endif
                  </span><span class="episode">
                    @if($movie->phude==0)
                    VietSub
                    @else
                    Thuyết Minh
                    @endif
                  </span></li>

                @if ($movie->season!=0)
                <li class="list-info-group-item"><span>Season</span> : {{$movie->season}}</li>
                @endif
                <li class="list-info-group-item"><span>Thời lượng</span> : {{$movie->thoiluong}}</li>
                <li class="list-info-group-item">
                  <span>Tập phim</span> :
                  @if ($movie->thuocphim=='phimbo')
                  {{$episode_current_list_count}}/{{$movie->sotap}} @if($episode_current_list_count==$movie->sotap) - Hoàn thành @else - Đang cập nhật @endif
                  @else
                  Phim lẻ
                  @endif
                </li>
                <li class="list-info-group-item"><span>Thể loại</span> :
                  @foreach ($movie->movie_genre as $gen)
                  <a href="{{route('genre',$gen->slug)}}" rel="category tag">{{$gen->title}}</a>,

                  @endforeach
                </li>
                <li class="list-info-group-item"><span>Danh mục</span> :
                  <a href="{{route('category',$movie->category->slug)}}" rel="category tag">{{$movie->category->title}}</a>
                </li>
                <li class="list-info-group-item"><span>Quốc gia</span> :
                  <a href="{{route('country',$movie->country->slug)}}" rel="tag">{{$movie->country->title}}</a>
                </li>
                <li class="list-info-group-item"><span>Tập phim mới nhất</span> :
                  <!-- nếu là phim bộ->hiển thị tập phim -->

                  @if ($episode_current_list_count>0)
                  @if ($movie->thuocphim=='phimbo')
                  @foreach ($episode as $ep)
                  <a href="{{url('xem-phim/'.$ep->movie->slug.'/tap-'.$ep->episode)}}" rel="{{$ep->spisode}}">Tập {{$ep->episode}}</a>
                  @endforeach
                  @else
                  <a href="" rel="">FullHD</a>
                  <a href="" rel="">HD</a>
                  @endif
                  @else
                  Đang cập nhật
                  @endif
                </li>
                <li class="list-info-group-item"><span>Lượt xem: </span> 
                  @if($movie->count_views > 0)
                    {{$movie->count_views}} lượt xem
                  @endif
                </li>
                
              </ul>
              </li>
              </ul>
              <div class="movie-trailer hidden"></div>
            </div>
          </div>
        </div>
        <div class="clearfix"></div>
        <div id="halim_trailer"></div>
        <div class="clearfix"></div>
        <div class="section-bar clearfix">
          <h2 class="section-title"><span style="color:#ffed4d">Nội dung phim</span></h2>
        </div>
        <div class="entry-content htmlwrap clearfix">
          <div class="video-item halim-entry-box">
            <article id="post-38424" class="item-content"> Phim <a href="/phim/{{$movie->slug}}">{{$movie->title}}</a> - {{$movie->country->title}}: {!!$movie->description!!} </article>
          </div>
        </div>

        <!-- Tags Phim -->
        @if ($movie->tags)
        <div class="section-bar clearfix">
          <h2 class="section-title"><span style="color:#ffed4d">Tags phim</span></h2>
        </div>
        <div class="entry-content htmlwrap clearfix">
          <div class="video-item halim-entry-box">
            <article id="post-38424" class="item-content">
              @if ($movie->tags!=NULL)
              @php
              $tags = array();
              $tags = explode(',', $movie->tags);
              @endphp
              @foreach ($tags as $tag)
              <a href="{{url('tag/'.$tag)}}">{{$tag}}</a>
              @endforeach
              @endif
            </article>
          </div>
        </div>
        @endif

        <!-- Trailer Phim -->
        @if ($movie->trailer)
        <div class="section-bar clearfix">
          <h2 class="section-title"><span style="color:#ffed4d">Trailer phim</span></h2>
        </div>
        <div class="entry-content htmlwrap clearfix">
          <div class="video-item halim-entry-box">
            <article id="post-38424" class="item-content">
              <iframe width="100%" height="500px" src="https://www.youtube.com/embed/{{$movie->trailer}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
            </article>
          </div>
        </div>
        @endif

        <div class="section-bar clearfix">
          <h2 class="section-title"><span style="color:#ffed4d">Bình luận</span></h2>
        </div>
        <div class="entry-content htmlwrap clearfix">
          <div class="video-item halim-entry-box">
            <!-- current lấy đường dẫn hiện tại -->
            @php
            $current_url = Request::url();
            @endphp
            <div class="fb-comments" style="background: #fff;" data-href="{{$current_url}}" data-width="100%" data-numposts="10"></div>

          </div>
        </div>


      </div>
    </section>
    <section class="related-movies">
      <div id="halim_related_movies-2xx" class="wrap-slider">
        <div class="section-bar clearfix">
          <h3 class="section-title"><span>CÓ THỂ BẠN MUỐN XEM</span></h3>
        </div>
        <div id="halim_related_movies-2" class="owl-carousel owl-theme related-film">
          @foreach($related as $key => $related)
          <article class="thumb grid-item post-38498">
            <div class="halim-item">
              <a class="halim-thumb" href="{{route('movie',$related->slug)}}" title="{{$related->title}}">
                <figure><img class="lazy img-responsive" src="{{asset('uploads/movie/'.$related->image)}}" alt="{{$related->title}}" title="Đại Thánh Vô Song"></figure>
                <span class="status">
                  @if($related->resolution==0)
                  HD
                  @elseif ($related->resolution==1)
                  SD
                  @elseif ($related->resolution==2)
                  HDCam
                  @elseif ($related->resolution==3)
                  Cam
                  @elseif ($related->resolution==4)
                  FullHD
                  @else
                  Trailer
                  @endif
                </span><span class="episode"><i class="fa fa-play" aria-hidden="true"></i>
                  @if($related->phude==0)
                  VietSub
                  @if ($movie->season!=0)
                  - Season {{$movie->season}}
                  @endif
                  @else
                  Thuyết Minh
                  @if ($movie->season!=0)
                  - Season {{$movie->season}}
                  @endif
                  @endif</span>
                <div class="icon_overlay"></div>
                <div class="halim-post-title-box">
                  <div class="halim-post-title ">
                    <p class="entry-title">{{$related->title}}</p>
                    <p class="original_title">{{$related->name_eng}}</p>
                  </div>
                </div>
              </a>
            </div>
          </article>
          @endforeach

        </div>
        <script>
          $(document).ready(function($) {
            var owl = $('#halim_related_movies-2');
            owl.owlCarousel({
              loop: true,
              margin: 4,
              autoplay: true,
              autoplayTimeout: 4000,
              autoplayHoverPause: true,
              nav: true,
              navText: ['<i class="hl-down-open rotate-left"></i>', '<i class="hl-down-open rotate-right"></i>'],
              responsiveClass: true,
              responsive: {
                0: {
                  items: 2
                },
                480: {
                  items: 3
                },
                600: {
                  items: 4
                },
                1000: {
                  items: 4
                }
              }
            })
          });
        </script>
      </div>
    </section>
  </main>
  <!-- Siderbar -->
  @include('pages.include.siderbar')
</div>
@endsection