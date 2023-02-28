@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Quản Lý Thể Loại</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(!isset($genre))
                        {!! Form::open(['route'=>'genre.store','method'=>'POST']) !!}
                    @else
                        {!! Form::open(['route'=>['genre.update',$genre->id],'method'=>'PUT']) !!}
                    @endif
                        <div class="form-group">
                            {!! Form::label('title', 'Tên thể loại', []) !!}
                            {!! Form::text('title', isset($genre) ? $genre->title : '', ['class'=>'form-control','placeholder'=>'...','id'=>'slug','onkeyup'=>'ChangeToSlug()']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('slug', 'Đường dẫn', []) !!}
                            {!! Form::text('slug', isset($genre) ? $genre->slug : '', ['class'=>'form-control','placeholder'=>'...','id'=>'convert_slug']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('description', 'Mô tả thể loại', []) !!}
                            {!! Form::textarea('description', isset($genre) ? $genre->description : '', ['style'=>'resize:none', 'class'=>'form-control','placeholder'=>'...','id'=>'description']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('status', 'Trạng thái', []) !!}
                            {!! Form::select('status', ['1'=>'Hiển thị','0'=>'Không hiển thị'], isset($genre) ? $genre->status : '', ['class'=>'form-control']) !!}
                        </div>
                        @if(!isset($genre))
                            {!! Form::submit('Thêm Thể Loại', ['class'=>'btn btn-success']) !!}
                        @else
                            {!! Form::submit('Cập Nhật Thể Loại', ['class'=>'btn btn-success']) !!}
                        @endif
                    {!! Form::close() !!}
                </div>
            </div>
            <table class="table" id="tablephim">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Tên thể loại</th>
                  <th scope="col">Mô tả</th>
                  <th scope="col">Đường dẫn</th>
                  <th scope="col">Trạng thái</th>
                  <th scope="col">Quản lý</th>
                </tr>
              </thead>
              <tbody>
                @foreach($list as $key => $cate)
                <tr>
                  <th scope="row">{{$key}}</th>
                  <td>{{$cate->title}}</td>
                  <td>{{$cate->description}}</td>
                  <td>{{$cate->slug}}</td>
                  <td>
                    @if($cate->status)
                        Hiển thị
                    @else
                        Không hiển thị
                    @endif
                  </td>
                  <td>
                      {!! Form::open(['method'=>'DELETE','route'=>['genre.destroy',$cate->id],'onsubmit'=>'return confirm("Bạn có chắc muốn xóa?")']) !!}
                        {!! Form::submit('Xóa', ['class'=>'btn btn-danger']) !!}
                      {!! Form::close() !!}
                      <a href="{{route('genre.edit',$cate->id)}}" class="btn btn-warning">Sửa</a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
