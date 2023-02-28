@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <a href="{{route('movie.create')}}" class="btn btn-primary">Thêm Phim</a>
            <table class="table" id="tablephim">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Tên phim</th>
                  <th scope="col">Tags</th>
                  <th scope="col">Thời lượng  phim</th>
                  <th scope="col">Hình ảnh</th>
                  <th scope="col">Phim hot</th>
                  <th scope="col">Định dạng</th>
                  <th scope="col">Phụ đề</th>
                  <!-- <th scope="col">Mô tả</th> -->
                  <th scope="col">Đường dẫn</th>
                  <th scope="col">Trạng thái</th>
                  <th scope="col">Danh mục</th>
                  <th scope="col">Thể loại</th>
                  <th scope="col">Quốc gia</th>
                  <th scope="col">Ngày tạo</th>
                  <th scope="col">Ngày cập nhật</th>
                  <th scope="col">Năm phim</th>
                  <th scope="col">Top views</th>
                  <th scope="col">Quản lý</th>
                </tr>
              </thead>
              <tbody>
                @foreach($list as $key => $cate)
                <tr>
                  <th scope="row">{{$key}}</th>
                  <td>{{$cate->title}}</td>
                  <td>{{$cate->tags}}</td>
                  <td>{{$cate->thoiluong}}</td>
                  <td><img width="100" src="{{asset('uploads/movie/'.$cate->image)}}"></td>
                  <td>
                    @if($cate->phim_hot==0)
                        Không
                    @else
                        Có
                    @endif
                  </td>
                    <td>
                    @if($cate->resolution==0)
                        HD
                    @elseif($cate->resolution==1)
                        SD
                    @elseif($cate->resolution==2)
                        HDCam
                    @elseif($cate->resolution==3)
                        Cam
                    @else
                        FullHD
                    @endif
                  </td>
                   <td>
                    @if($cate->phude==0)
                        Phụ đề
                    @else
                        Thuyết minh
                    @endif
                  </td>
                  <!-- <td>{{$cate->description}}</td> -->
                  <td>{{$cate->slug}}</td>
                  <td>
                    @if($cate->status)
                        Hiển thị
                    @else
                        Không hiển thị
                    @endif
                  </td>
                  <td>{{$cate->category->title}}</td>
                  <td>{{$cate->genre->title}}</td>
                  <td>{{$cate->country->title}}</td>
                  <td>{{$cate->ngaytao}}</td>
                  <td>{{$cate->ngaycapnhat}}</td>
                  <td>
                    {!!Form::selectYear('year',2000,2023, isset($cate->year) ? $cate->year :'' ,['class'=>'select-year','id'=>$cate->id])!!}
                  </td>
                  <td>
                    {!! Form::select('topview', ['0'=>'Ngày','1'=>'Tuần','2'=>'Tháng'], isset($topview) ? $movie->topviews : '', ['class'=>'select-topview','id'=>$cate->id]) !!}
                  </td>
                  <td>
                      {!! Form::open(['method'=>'DELETE','route'=>['movie.destroy',$cate->id],'onsubmit'=>'return confirm("Bạn có chắc muốn xóa?")']) !!}
                        {!! Form::submit('Xóa', ['class'=>'btn btn-danger']) !!}
                      {!! Form::close() !!}
                      <a href="{{route('movie.edit',$cate->id)}}" class="btn btn-warning">Sửa</a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
