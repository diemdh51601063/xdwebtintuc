@extends('admin.layout.index')

@section('content')

<div id="content">

<div id="content-header">
    <div id="breadcrumb"> <a title="" class="tip-bottom"><i class="icon-home"></i>Bình luận</a></div>
  </div>
<div class="container-fluid">
  <hr>
  <div class="row-fluid">
    <div class="span6">
       @if(count($errors)>0)
            <div class="alert"> 
              @foreach($errors->all() as $err)
                  {{$err}}<br>
                  @endforeach
            </div>
          @endif



          @if(session('thongbao'))
          <div class="alert">
            
            {{session('thongbao')}}
          </div>
          @endif
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i></span>
          <h5>Bình luận</h5>
        </div>


<div class="control-group">
              <label class="control-label">ID loại tin:</label>
              <div class="controls">
                <input type="text" placeholder="" disabled="" name="id" class="span11" value="{{$binhluan->id_binhluan}}" />
              </div>
              <label class="control-label">ID loại tin:</label>
              <div class="controls">
                <input type="text" placeholder="" disabled="" name="id" class="span11" value="{{$binhluan->email}}" />
              </div>
              <label class="control-label">ID loại tin:</label>
              <div class="controls">
                <input type="text" placeholder="" disabled="" name="id" class="span11" value="{{$binhluan->thoigian}}" />
              </div>
              <label class="control-label">ID loại tin:</label>
              <div class="controls">
                <input type="text" placeholder="" disabled="" name="id" class="span11" value="{{$binhluan->noidung}}" />
              </div>
              <label class="control-label">ID loại tin:</label>
              <div class="controls">
                <input type="text" placeholder="" disabled="" name="id" class="span11" value="{{$binhluan->noidung}}" />
              </div>
            </div>




      </div>
    </div>
  </div>
</div>
  </div>

    @endsection