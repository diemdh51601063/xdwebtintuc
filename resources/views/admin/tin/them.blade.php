@extends('admin.layout.index')

@section('content')



<div id="content">

<div id="content-header">
    <div id="breadcrumb"> <a title="" class="tip-bottom"><i class="icon-home"></i> Nhóm tin</a></div>
  </div>
<div class="container-fluid" >
  <hr>
  <div class="row-fluid">
    <div class="span14">

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
          <h5>Thêm tin</h5>
        </div>
        <div class="widget-content nopadding">




          <form action="admin/tin/them.html" method="POST" class="form-horizontal" enctype="multipart/form-data">

              <input type="hidden" name="_token" value="{{csrf_token()}}"/>

            
            <div class="control-group">
              <label class="control-label">Tiêu đề:</label>
              <div class="controls">
                <input type="text" class="span11" placeholder="" name="tieude" />
              </div>

            

              <label class="control-label">Hình đại diện</label>
              <div class="controls">
                <input type="file" id="file"  name="file" onchange="return fileValidation()" />
              </div>
              <div  id="imagePreview"></div>
         
            <label class="control-label">Nhóm tin:</label>
                <div class="controls">
                <select name="nhomtin" id="nhomtin" class="span8">
                  
                  @foreach($nhomtin as $nt)
                        <option  value="{{$nt->id}}"   >{{$nt->tennhomtin}}</option>

                  @endforeach


                  
                 
                </select>
              </div>
                 <label class="control-label">Loại tin</label>

              <div class="controls">
                <select name="loaitin" id="loaitin"  class="span8">
 
                  @foreach($loaitin as $lt)
                        <option value="{{$lt->id}}"   >{{$lt->tenloaitin}}</option>

                  @endforeach


                  
                 
                </select>




              </div>
             <label class="control-label">Tác giả</label>
              <div class="controls">
                <input type="text" class="span11" placeholder="" name="tacgia" />
              </div>
              <label class="control-label">Mô tả:</label>
              <div class="controls">
                <input type="text" class="span11" placeholder="" name="mota" />
              </div>

            
            </div>
           
              <label class="control-label">Nội dung:</label>
            <div class="controls">

              <textarea name="noidung" class="textarea_editor span10" rows="12" placeholder="Enter text ...">Nội dung
              </textarea>
            </div>


            
              
            </div>
         <br>
  
 
                   
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

@section('script')


<script src="admin_asset/js/wysihtml5-0.3.0.js"></script> 
<script src="admin_asset/js/jquery.peity.min.js"></script> 
<script src="admin_asset/js/bootstrap-wysihtml5.js"></script> 

<script>
  $('.textarea_editor').wysihtml5();
</script>
  <script>
function fileValidation(){
var fileInput = document.getElementById('file');
var filePath = fileInput.value;//lấy giá trị input theo id
var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;//các tập tin cho phép
//Kiểm tra định dạng
if(!allowedExtensions.exec(filePath)){
alert('Vui lòng upload các file có định dạng: .jpeg/.jpg/.png/.gif only.');
fileInput.value = '';
return false;
}else{
//Image preview
if (fileInput.files && fileInput.files[0]) {
var reader = new FileReader();
reader.onload = function(e) {
document.getElementById('imagePreview').innerHTML = '<img style="width:700px;height:400px;" src="'+e.target.result+'"/>';
};
reader.readAsDataURL(fileInput.files[0]);
}
}
}
</script>
<script >   
  $(document).ready(function(){
   
   $("#nhomtin").change(function(){
    var idnhomtin=$(this).val();

    $.get("admin/ajax/loaitin/"+idnhomtin,function(data){

     // alert(data);
        
           $("#loaitin").html(data);
    });
   });
  });






</script>


@endsection