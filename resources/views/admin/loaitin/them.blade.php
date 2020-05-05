@extends('admin.layout.index')

@section('content')


<div id="content">

<div id="content-header">
    <div id="breadcrumb"> <a title="" class="tip-bottom"><i class="icon-home"></i> Loại tin</a></div>
  </div>
<div class="container-fluid" >
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


      <div class="widget-box" >
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i></span>
          <h5>Thêm loại tin</h5>
        </div>
        <div class="widget-content nopadding">




          <form action="admin/loaitin/them.html" method="POST" class="form-horizontal">

              <input type="hidden" name="_token" value="{{csrf_token()}}"/>
        
            <div class="control-group">
              
              <label class="control-label">Tên loại tin:</label>
              <div class="controls">
                <input type="text" class="span11" placeholder="" name="ten" />
              </div>
            </div>


                 <div class="control-group">
              <label class="control-label">Nhóm tin</label>
              <div class="controls">
               <select name="nhomtin">
                
       @foreach($nhomtin as $nt)
                        <option value="{{$nt->id}}"   >{{$nt->tennhomtin}}</option>

                  @endforeach
                  
                 
                </select>
              </div>
            </div>    
            <div class="form-actions">
              <button type="submit" class="btn btn-success">Xác nhận</button>
              
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
  </div>
@endsection