 <aside id="sidebar" class="col-xs-12 col-sm-12 col-md-4">
   <div id="halim_tab_popular_videos-widget-7" class="widget halim_tab_popular_videos-widget">
     <div class="section-bar clearfix">
       <div class="section-title">
         <span>Phim Hot</span>
       </div>
     </div>
     <section class="tab-content">
       <div role="tabpanel" class="tab-pane active halim-ajax-popular-post">
         <div class="halim-ajax-popular-post-loading hidden"></div>
         <div id="halim-ajax-popular-post" class="popular-post">
           @foreach ($phimhot_sidebar as $mov)
           <div class="item post-37176">
             <a href="{{route('movie',$mov->slug)}}" title="{{$mov->title}}">
               <div class="item-link">
                 <img src="{{asset('uploads/movie/'.$mov->image)}}" class="lazy post-thumb" alt="{{$mov->title}}" title="{{$mov->title}}" />
                 <span class="is_trailer">
                   @if($mov->resolution==0)
                   HD
                   @elseif ($mov->resolution==1)
                   SD
                   @elseif ($mov->resolution==2)
                   HDCam
                   @elseif ($mov->resolution==3)
                   Cam
                   @elseif ($mov->resolution==4)
                   FullHD
                   @else
                   Trailer
                   @endif
                 </span>
               </div>
               <p class="title">{{$mov->title}}</p>
             </a>
             <div class="viewsCount" style="color: #9d9d9d;">
               @if($mov->count_views > 0)
               {{$mov->count_views}} lượt xem
               @endif
             </div>
             <div style="float: left;">
               <span class="user-rate-image post-large-rate stars-large-vang" style="display: block;/* width: 100%; */">
                 <span style="width: 0%"></span>
               </span>
             </div>
           </div>
           @endforeach
         </div>
       </div>
     </section>
     <div class="clearfix"></div>
   </div>
 </aside>
 <aside id="sidebar" class="col-xs-12 col-sm-12 col-md-4">
   <div id="halim_tab_popular_videos-widget-7" class="widget halim_tab_popular_videos-widget">
     <div class="section-bar clearfix">
       <div class="section-title">
         <span>Top Views</span>
       </div>
     </div>
     <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
       <li class="nav-item active">
         <a class="nav-link filter-sidebar" id="pills-home-tab" data-toggle="pill" href="#ngay" role="tab" aria-controls="pills-home" aria-selected="true">Ngày</a>
       </li>
       <li class="nav-item">
         <a class="nav-link filter-sidebar" id="pills-profile-tab" data-toggle="pill" href="#tuan" role="tab" aria-controls="pills-profile" aria-selected="false">Tuần</a>
       </li>
       <li class="nav-item">
         <a class="nav-link filter-sidebar" id="pills-contact-tab" data-toggle="pill" href="#thang" role="tab" aria-controls="pills-contact" aria-selected="false">Tháng</a>
       </li>
     </ul>
     <div class="tab-content" id="pills-tabContent">
       <div class="tab-pane fade show active" id="ngay" role="tabpanel" aria-labelledby="ngay-tab">
         <span id="show_data_default"></span>
         <div id="halim-ajax-popular-post" class="popular-post">
           <span id="show_data"></span>
         </div>
       </div>
       <!-- <div class="tab-pane fade" id="tuan" role="tabpanel" aria-labelledby="tuan-tab">
         <div id="halim-ajax-popular-post" class="popular-post">
           <span id="show1"></span>
         </div>

       </div>
       <div class="tab-pane fade" id="thang" role="tabpanel" aria-labelledby="thang-tab">
         <div id="halim-ajax-popular-post" class="popular-post">
           <span id="show2"></span>
         </div>

       </div> -->
     </div>
     <div class="clearfix"></div>
   </div>
 </aside>