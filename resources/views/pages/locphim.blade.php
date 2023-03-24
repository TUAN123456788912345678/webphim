@extends('layout')
@section('content')
<div class="row container" id="wrapper">
    <div class="halim-panel-filter">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-6">
                    <div class="yoast_breadcrumb hidden-xs"><span><span><a href="">Lọc phim</a> » <span class="breadcrumb_last" aria-current="page">2023</span></span></span></div>
                </div>
            </div>
        </div>
        <div id="ajax-filter" class="panel-collapse collapse" aria-expanded="true" role="menu">
            <div class="ajax"></div>
        </div>
    </div>
    <main id="main-contents" class="col-xs-12 col-sm-12 col-md-8">
        <section>
            <div class="section-bar clearfix">
                <h1 class="section-title"><span>Lọc phim</span></h1>
            </div>
            <div class="section-bar clearfix">
                <div class="row">
                    <form action="{{route('locphim')}}" method="GET">
                        <div class="col-md-3">
                            <div class="form-group">
                                <select class="form-control" name="order" id="exampleFormControlSelect1">
                                    <option value="">--Sắp xếp--</option>
                                    <option value="date">Ngày Đăng </option>
                                    <option value="year_release">Năm sản xuất</option>
                                    <option value="name_a_z">Tên phim</option>
                                    <option value="watch_views">Lượt xem</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <select class="form-control" name="genre" id="exampleFormControlSelect1">
                                    <option value="">--Thể loại--</option>
                                    @foreach($genre as $key => $gen_filter)
                                        <option value="{{$gen_filter->id}}">{{$gen_filter->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <select class="form-control" name="country" id="exampleFormControlSelect1">
                                    <option value="">--Quốc gia--</option>
                                    @foreach($country as $key => $cou_filter)
                                        <option value="{{$cou_filter->id}}">{{$cou_filter->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                {!!Form::selectYear('year_get',2000,2023,null,['class'=>'form-control','placeholder'=> '--Năm phim--'])!!}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <input  type="submit" name="locphim"  class="btn btn-sm btn-default" value="Lọc phim">
                        </div>
                    </form>
                </div>
            </div>
                  <div class="halim_box">
                     @foreach($movie as $key => $mov)
                     <article class="col-md-3 col-sm-3 col-xs-6 thumb grid-item post-37606">
                        <div class="halim-item">
                           <a class="halim-thumb" href="{{route('movie',$mov->slug)}}">
                              <figure><img class="lazy img-responsive" src="{{asset('uploads/movie/'.$mov->image)}}" alt="BẠN CÙNG PHÒNG CỦA TÔI LÀ GUMIHO" title="{{$mov->title}}"></figure>
                              <span class="status">
                                @if($mov->resolution==0)
                                          HD
                                      @elseif($mov->resolution==1)
                                          SD
                                      @elseif($mov->resolution==2)
                                          HDCam
                                      @elseif($mov->resolution==3)
                                          Cam
                                      @elseif($mov->resolution==4)
                                          FullHD
                                      @else
                                          Trailer
                                      @endif
                              </span><span class="episode"><i class="fa fa-play" aria-hidden="true"></i>
                                    @if($mov->phude==0)
                                       Phụ đề
                                        @if($mov->season!=0)
                                          - Seanson {{$mov->season}}
                                       @endif
                                @else
                                       Thuyết minh
                                       @if($mov->season!=0)
                                          - Seanson {{$mov->season}}
                                       @endif
                                   @endif
                              </span> 
                              <div class="icon_overlay"></div>
                              <div class="halim-post-title-box">
                                 <div class="halim-post-title ">
                                    <p class="entry-title">{{$mov->title}}</p>
                                    <p class="original_title">{{$mov->name_eng}}</p>
                                 </div>
                              </div>
                           </a>
                        </div>
                     </article>
                     @endforeach
                  </div>
                  <div class="clearfix"></div>
                  <div class="text-center">
                     <!-- <ul class='page-numbers'>
                        <li><span aria-current="page" class="page-numbers current">1</span></li>
                        <li><a class="page-numbers" href="">2</a></li>
                        <li><a class="page-numbers" href="">3</a></li>
                        <li><span class="page-numbers dots">&hellip;</span></li>
                        <li><a class="page-numbers" href="">55</a></li>
                        <li><a class="next page-numbers" href=""><i class="hl-down-open rotate-right"></i></a></li>
                     </ul> -->
                     {!! $movie->links("pagination::bootstrap-4") !!}
                  </div>
               </section>
            </main>
           @include('pages.include.sidebar')
         </div>
@endsection