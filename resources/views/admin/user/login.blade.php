<!DOCTYPE html>
<html lang="en">
    
<head>
    <base href="{{asset('')}}">
        <title>Matrix Admin</title><meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        
        <link rel="stylesheet" href="admin_asset/css/bootstrap.min.css" />
        <link rel="stylesheet" href="admin_asset/css/bootstrap-responsive.min.css" />
        <link rel="stylesheet" href="admin_asset/css/matrix-login.css" />
        <link href="admin_asset/font-awesome/css/font-awesome.css" rel="stylesheet" />
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
</head>
    <body>
        <div id="loginbox">            
            <form id="loginform" class="form-vertical" action="admin/login.html" method="POST">
                   <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                 <div class="control-group normal_text"> <h3><img src="admin_asset/img/logo.png" alt="Logo" /></h3></div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_lg"><i class="icon-user"> </i></span><input type="text" id="tentaikhoan" name="tentaikhoan" placeholder="@gmail" />
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_ly"><i class="icon-lock"></i></span><input type="password" name="matkhau" placeholder="Password" />
                        </div>
                    </div>
                </div>
               
                    
                    <span class="pull-right"><button type="submit"  class="btn btn-success" /> Login</button></span>
                
            </form>
            <form id="recoverform" action="#" class="form-vertical">
                <p class="normal_text">Enter your e-mail address below and we will send you instructions how to recover a password.</p>
                
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_lo"><i class="icon-envelope"></i></span><input type="text" placeholder="E-mail address" />
                        </div>
                    </div>
               
                <div class="form-actions">
                    <span class="pull-left"><a href="#" class="flip-link btn btn-success" id="to-login">&laquo; Back to login</a></span>
                    <span class="pull-right"><a class="btn btn-info"/>Reecover</a></span>
                </div>
            </form>

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

        </div>
        
        <script src="admin_asset/js/jquery.min.js"></script>  
        <script src="admin_asset/js/matrix.login.js"></script> 

         <script language="javascript">
/*
            if(localStorage)
            {
                document.getElementById('tentaikhoan').innerHTML=localStorage.tentaikhoan;
                document.getElementById('checkbox').checked;
            }


            document.getElementById('checkbox').onclick = function(e){
               if (typeof(Storage) !== 'undefined') {

                 if (this.checked){
                    localStorage.setItem('tentaikhoan',document.getElementById('tentaikhoan').value);
                     document.getElementById('checkbox').checked;
                //    localStorage.setItem('checkbox',document.getElementById('checkbox').value);
                }
                else{
                //  localStorage.clear();
                }
    //Nếu có hỗ trợ
    //Thực hiện thao tác với Storage
    //alert('Trình duyệt của bạn hỗ trợ Storage');
} else {
    //Nếu không hỗ trợ
    alert('Trình duyệt của bạn không hỗ trợ Storage');
}
            };

            document.getElementById('tentaikhoan').onchange=function(e){
                    if(document.getElementById('checkbox').checked)
                            localStorage.setItem('tentaikhoan',document.getElementById('tentaikhoan').value);           
            };


         */

window.onload = function()
{// localStorage.setItem('ta','xcxcxc');
    document.getElementById('tentaikhoan').value=localStorage.getItem("taikhoan");
  //  if(localStorage.taikhoan)
 // document.getElementById("tentaikhoan").innerHTML = localStorage.getItem("taikhoan");
};

            document.getElementById('tentaikhoan').onchange=function(){
                localStorage.setItem("taikhoan", document.getElementById('tentaikhoan').value);

            }
            
        </script>
    </body>

</html>