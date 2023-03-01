<html>
<head>
  <script src="{{asset('vms/logincdn/js/common.js')}}"></script>
  <script src="{{asset('vms/logincdn/js/login.js')}}"></script>
</script>
<script type="text/javascript">



  var onloadCallback = function() {
    grecaptcha.render('captcha', {
      'sitekey' : document.getElementById('siteKey').value
    });
  };

  var recaptcha_response = '';
  function checkCaptcha() {
    if(recaptcha_response.length == 0) {
      alert('Please verify that you are a Human');
      document.getElementById('txtcaptchaResponse').value='';
      return false;
    }
    document.getElementById('txtcaptchaResponse').value=recaptcha_response;

    return true;
  }

  function verifyCaptcha(token) {
    recaptcha_response = token;

  }

  function captchaExpired(){
    recaptcha_response='';
    document.getElementById('txtcaptchaResponse').value='';
    alert('Captcha expired');
    return false;
  }

</script>

<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<meta name="GENERATOR" content="Microsoft FrontPage 4.0">
<meta name="ProgId" content="FrontPage.Editor.Document">
<link rel="stylesheet" href="{{asset('vms/logincdn/css/frontPageMayo.css')}}">
<link rel="stylesheet" href="{{asset('vms/logincdn/mdl/material.min.css')}}">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<link href="{{asset('vms/logincdn/font_icon_css/font-awesome.min.css')}}" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<title>Login Page</title>

<style type="text/css">
.verticalcenter {
  display: table-cell;
  height: 300px;
  text-align: center;
  width: 300px;
  vertical-align: middle;
}

.material-icons.red600 {
  color: #d50000;
}

.material-icons.blue600 {
  color: #3f51b5;
}

.mdl-button--outlined {
  border: solid;
  border-color: #3f51b5;
  border-width: 2px;
  background-color: #FFFFFF;
  border-radius: 8px;
  width: 280px;
  color: #3f51b5;
  font-weight: bold;
}

.mdl-button--fgt {
  border: 0;
  border-color: #3f51b5;
  border-width: 2px;
  background-color:;
  border-radius: 8px;
  width: 280px;
  color: #3f51b5;
  font-weight: bold;
  cursor: pointer;
}

.captureimg {

}

.captureimg:hover {
  transform: scale(1.2);
  /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
}

/* #captcha div {
float: left;
} */
#captcha iframe {

  border: .1px solid black;
  border-collapse: collapse;
  border-radius: 4px;
}

.headerBox {
  width: 90%;
  height: 10%;
  background: #012643;
  color: #fff;
  margin-top: 1%;
  /* display: flex; */
  justify-content: center;
  align-items: center;
  text-align: center;
  position: absolute;
  left: 5%;
  border-radius: 20px;
  font-size: 20px;
  font-weight: bold;
  text-transform: capitalize;
}

video{
  object-fit: initial;
}
</style>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" style="background:url('{{asset('images/institute_glimpse.jpg')}}');background-repeat: no-repeat;background-size: cover;background-position: center;">

  <div class="headerBox">
    <img border="0" src="{{asset('logo/logo.jpg')}}" height="80%" width="5%" style="float:left;margin: 0;position: absolute;top: 50%; -ms-transform: translateY(-50%);transform: translateY(-50%);left: 2%;">
    <center style="height: 100%;display: flex; justify-content: center; align-items: center;color: #e33510;">Vaish Model Sr. Sec. School Bhiwani</center>
  </div>

  <div class="PhotoBox"style="height: 60vh;width: 40vw;max-height: 700px;border-top-left-radius: 50px;border-bottom-right-radius: 50px;border-width:7px;border-color:#B7C9D7;top:15%;background-color:#012643;display: flex; align-items: center; justify-content: center;" id="PhotoBodId" style="progid:DXImageTransform.Microsoft.MotionBlur(strength=50, direction=310) rogid:DXImageTransform.Microsoft.Blur(pixelradius=5) progid:DXImageTransform.Microsoft.Wheel(duration=300);">

  <video  autoplay muted loop style="height: 80%;width: 90%;">
    <source src="{{asset('video/institute_glimpse.mp4')}}" type="video/mp4">
      Your borwser does not support the video tag.
    </video>
  </div>

  <div class="LoginBox" style="max-height: 700px;height: 60vh;width: 40vw;border-width:7px;border-color:#012643;border-top-right-radius: 50px;border-bottom-left-radius: 50px;background:#EBF6FA;left: 55%;top:15%">
    <div style="background:#EBF6FA;">
      <div class="LoginTop" style="background: #EBF6FA;display: flex;justify-content: center; text-align: center;align-items: center;">
        <center style="color: #085898;letter-spacing: 1px; font-size:large">
          <img border="0" src="{{asset('logo/logo.jpg')}}" height="22px"
          width="40px"><strong style="color: #0A588E;margin-left:5px" >Vaish Model Sr.Sec.School</strong>
        </center>
      </div>
      <div class="LoginTopClient" style="background: #EBF6FA;" style="margin-top: -10px;">
        <center>
          <FONT SIZE="+1"  face="Calibri" style="font-size:14px"
          >OTP Verification <span style="color:red">{{ $errors->first() }}</span></FONT>
          <p>{{-- {{ $errors->first('mobile_otp') }} --}}</p>
        </center>
      </div>

      <form  action="{{route('student.resitration.otp.verify')}}" method="post">
      {{csrf_field()}}
        <div class="LoginBottom" style="background: #EBF6FA;top:25%">
          <table border="0" cellpadding="2" align="center" cellspacing="2" height="50%" width="100%" style="border-collapse: collapse; vertical-align: top;">
            <input type="hidden" name="user_id" value="{{@$user_id}}">
            @if (@$mobile_rs[0]->otp_verified !=1)
            <tr>
              <td colspan="2" style="vertical-align: middle" align="center" height="25">
                <input type="text" name="mobile_otp" style="font-size: 12px border:1px; background-color: #F3F3F3; width: 304px; height: 30;color: #990000;border:1px solid black;"  placeholder="Enter Mobile OTP"  maxlength="50" required>
                  <p class="text-danger" style="color:red">{{ $errors->first('mobile_otp') }}</p>
                  <a href="{{ route('student.resitration.resend.otp',[@$user_id,1]) }}" title="">Resend OTP</a>
              </td>

            </tr>
            @endif
            @if (@$email_rs[0]->otp_verified !=1)
            <tr>
              <td colspan="2" style="vertical-align: middle" align="center" height="25">
                <input type="text" name="email_otp" style="font-size: 12px border:1px; background-color: #F3F3F3; width: 304px; height: 30;color: #990000;border:1px solid black;" placeholder="Enter Email OTP"  maxlength="50">
                <p class="text-danger" style="color:red">{{ $errors->first('email') }}</p>
                <a href="{{ route('student.resitration.resend.otp',[@$user_id,2]) }}" title="">Resend OTP</a>
              </td>
            </tr>
            @endif

            <tr>
              <td width="70%" align="center" height="25">
                <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--outlined mdl-button--colored:hover"
                style="width: 304px; background-color: #6395EC; color: #F0FFFF;border-radius:2px">
                <i class="material-icons blue600">assignment_ind</i>&nbsp;&nbsp;Verify</button>
              </td>
            </tr>
          </table>
        </div>
      </form>
    </div>
  </div>



<div class="BBox">
<table border="0" width="98%" height="100%" cellspacing="1"
  style="color: #006699; font-size: 10px;">
  <tr>
    <td valign="middle" align="left" width="25%">&nbsp;&nbsp;&nbsp;&nbsp;Copyright © {{date('Y')}} Eageskool</td>
    <td valign="middle" align="center" width="50%"><a
      target="_self"
      href="{{asset('vms/logincdn/jsps/onlineLogin.jsp')}}"
      style="font-size: 11px;"><font color="#003399" face="Arial"><b>Online
      Testing</b></a></td>
      <td valign="middle" align="right" width="25%">&nbsp;<b>Powered
      By :&nbsp;</b> <a target="_blank" href="http://www.kalingasoft.com"
      style="font-size: 11px;"><font color="#003399" face="Arial"><b>Eage</b></font><font
      face="Arial" color="#3399FF"><b>Skool&nbsp;</b></font></a>
    </td>
  </tr>
</table>
</div>
</body>
</html>
@include('admin.include.message');
<script src="{{ asset('admin_asset/dist/js/toastr.min.js') }}"></script>
<script type="text/javascript">

$('#refresh').click(function(){
  $.ajax({
     type:'GET',
     url:'{{ route('vms.refresh.captcha') }}',
     success:function(data){
        $(".captcha span").html(data);
     }
  });
});
</script>