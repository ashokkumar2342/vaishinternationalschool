function PositionCursor()
{
	document.frmLogin.userId.focus();
}
function selectAllInIDField()
{
	document.getElementById("userId1").select();
}
function selectAllInPWField()
{
	document.getElementById("Password1").select();
}

function openinterface()
{
	var w=800;
	var h=600;
	if (parseInt(navigator.appVersion)>3) 
	{
		if (navigator.appName=="Netscape") 
		{
			w = window.innerWidth;
			h = window.innerHeight;
		}
		if (navigator.appName.indexOf("Microsoft")!=-1) 
		{
			w = screen.width;
			h = screen.height-60;
		}
	}
	window.open("interface.jsp","_parent","height="+h+" width="+w+" scrollbars=yes,resizable=no,menubar=yes,top=0,left=0" );
}
function closeWindow()
{
	window.opener="whocares";
	window.close();
}
function checkdata()
{
	document.getElementById("hdnFirstLoginOrPWDChange").value = "TEMP";
	if(document.logonForm.userId.value=="")
	{
		alert("Please enter User ID.");
		document.logonForm.userId.focus();
		return false;
	}
	else if(document.logonForm.password.value=="")
	{
		alert("Please enter Password.");
		document.logonForm.password.focus();
		return false;
	}
}
function positionCursor()
{
	document.logonForm.userId.focus();
}
function checkMaxLength(field,maxlength)
{
	if(field.value.length > maxlength)
	{
		field.value =  field.value.substring(0,maxlength);
		alert("More than "+maxlength +" Characters not allowed in this field");		
		field.focus();
	}
}
/*function loadHelpCaptcha()
{
	var w=800;
	var h=600;
	if (parseInt(navigator.appVersion)>3)
	{
		if (navigator.appName=="Netscape")
		{
			w = window.innerWidth;
			h = window.innerHeight;
		}
		if (navigator.appName.indexOf("Microsoft")!=-1)
		{
			w = screen.width;
			h = screen.height-60;
		}
	}
	
	var popw = w*2/3;
	var popl = (w-popw)/2;
	var poph= (h-600)/2;
	if(popw<800)
	popw=800;
	//alert(webContext);
	var url="../html/captchaHelp.html";
	//alert(url);
	window.open(url,"_blank","height=500 width=450 scrollbars=yes,resizable=no,menubar=no,top="+poph+",left="+popl+"" );
}*/

function changePasswordWithQuestion()
{
	document.getElementById("hdnFirstLoginOrPWDChange").value = "PWDCHNG";
	//logonForm.submit();
	//getXmlHttpRequest();
	var url="Login.kspl?";
	//var url="LoginMayo.kspl?";
	url = url+"txtcaptchaResponse="+encodeURIComponent(document.getElementById("txtcaptchaResponse").value);
	if(document.getElementById("userId1").value != null && document.getElementById("userId1").value != "")
	{
		url = url+"&userId="+encodeURIComponent(document.getElementById("userId1").value);
	}
	else
	{
		url = url+"&userId="+encodeURIComponent(gblUserId);
	}
	url = url+"&password="+encodeURIComponent(document.getElementById("Password1").value);
	url = url+"&hdnFirstLoginOrPWDChange="+encodeURIComponent(document.getElementById("hdnFirstLoginOrPWDChange").value);
	url = url+"&accReqrd="+encodeURIComponent(document.getElementById("accReqrdY").value);
	url = url+"&changePassword="+encodeURIComponent("Y");
	window.location=url;
}
function window_onload()
{
	window.moveTo(0,0);
	window.resizeTo(window.screen.availWidth,window.screen.availHeight);
		//DigiDate();
		
		//setClock();
	runSlideShow();
}
function RefreshImage(valImageId) 
{
	var objImage = document.images[valImageId];
	if (objImage == undefined) 
	{
		return;
	}
	var now = new Date();
	objImage.src = objImage.src.split('?')[0] + '?x=' + now.toUTCString();
}
function DigiClock(){

  var nd = new Date();
  var h, m;
  var s;
  var time = " ";
  h = nd.getHours();
  m = nd.getMinutes();
  s = nd.getSeconds();
  var ampm = "PM"
  if (h < 12){
	ampm = "AM"
	}
	if (h > 12){
	h -= 12
	}
	if (h < 10){
	h = " " + h
	}
	if (m < 10){
	m = "0" + m
	}
	if (s < 10){
	s = "0" + s
	}
  time += h + ":" + m + ":" + s; 
   var cell = document.getElementById('DigiClock'); 
   cell.innerHTML = time;
// document.logonForm.DigiClock.value = time;
  gizmo = setTimeout("DigiClock()", 1000);
 // alert(gizmo);
}
function showDate(){
	var date = new Date()
	var year = date.getYear()
	if(year < 1000){
	year += 1900
	}
	var monthArray = new Array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December")
	var cell1 = document.getElementById('DigiDate'); 
   	cell1.innerHTML = monthArray[date.getMonth()] + " " + date.getDate() + ", " + year;
	//DigiClock
	//alert( monthArray[date.getMonth()] + " " + date.getDate() + ", " + year)
}
//************Method added by Chitta*************

/*function showPassPhrage()
{
	if(document.getElementById("tdShowPassCodeChangeDetail").style.display == "none")
	{
		document.getElementById("tdShowPassCodeChangeDetail").style.display = "";
	}
	else
	{
		document.getElementById("tdShowPassCodeChangeDetail").style.display = "none";
	}
}*/
function showPassPhrage()
{
	var url = "getVerificationCodeByEmail.jsp?userId="+encodeURIComponent(document.getElementById("userId1").value);
	window.location=url;
}

function checkLoginData()
{
	document.getElementById("hdnFirstLoginOrPWDChange").value = "TEMP";
	
	if(document.pressed == 'btnForgetPwd')  
	{
		document.logonForm.action ="getVerificationCodeByEmail.jsp";
	}
	else
	{
		// action="Login.kspl"
		document.logonForm.action ="Login.kspl";
		if(document.logonForm.userId.value=="")
		{
			alert("Please enter User ID.");
			document.logonForm.userId.focus();
			return false;
		}
		else if(document.logonForm.password.value=="")
		{
			alert("Please enter Password.");
			document.logonForm.password.focus();
			return false;
		}
	}
	return true;
}

function showPassCodeChangeDetail()
{
	document.getElementById("tdGetPassCode").style.display = "";
	//-
	document.getElementById("trCanAccess").style.display = "none";
	document.getElementById("tdShowPassCodeChangeDetail").style.display = "none";
	document.getElementById("trLogin").style.display = "none";
}

function showPasswordChangeDetail()
{
	document.getElementById("tdChangePassword").style.display = "";
	//-
	document.getElementById("trCanAccess").style.display = "none";
	document.getElementById("tdShowPassCodeChangeDetail").style.display = "none";
	document.getElementById("trLogin").style.display = "none";
}
function backToTheMessage()
{
	document.getElementById("tdGetPassCode").style.display = "none";
	document.getElementById("tdChangePassword").style.display = "none";
	//-
	document.getElementById("trCanAccess").style.display = "";
	document.getElementById("tdShowPassCodeChangeDetail").style.display = "";
	document.getElementById("trLogin").style.display = "";
	errageMessage();
	document.getElementById('imgCaptch').src ='loadCaptch.kspl?'+ Math.random();
	//document.getElementById('imgCaptch').src ='loadCaptchMayo.kspl?'+ Math.random(); 
	return false;
}
function sendPassCodeToEmail()
{
	getXmlHttpRequest();
	var url = "sendPassCodeToEmail.kspl?userId="+encodeURIComponent(document.getElementById("userId1").value);
	url = url+"&txtcaptchaResponse="+encodeURIComponent(document.getElementById("txtcaptchaResponse").value);
	url = url+"&txtEmailForPassCode="+encodeURIComponent(document.getElementById("txtEmailForPassCode").value);
	url = url+"&txtMobileForPassCode="+encodeURIComponent(document.getElementById("txtMobileForPassCode").value);
	request.open("GET",url, true);
	document.getElementById("message").innerHTML = "<font face='Verdana' size='1' color='red'><b><center>Please wait while passcode is generated...</center></b></font>";
	request.onreadystatechange = common_CallBack;
	request.send(null);
}
function common_CallBack()
{
	document.getElementById("message").innerHTML = "<font face='Verdana' size='1' color='red'><b><center>Please wait while passcode is generated...</center></b></font>";
	if(request.readyState==4)
	{
		document.getElementById("message").innerHTML = request.responseText;
		document.getElementById("userId1").value = "";
		document.getElementById("txtcaptchaResponse").value = "";
		document.getElementById("txtPassCodeForChangePassword").value = "";
		document.getElementById("txtNewPassword").value = "";
		document.getElementById("txtConfirmPassword").value = "";
		document.getElementById('imgCaptch').src ='loadCaptch.kspl?'+ Math.random();
		//document.getElementById('imgCaptch').src ='loadCaptchMayo.kspl?'+ Math.random();
		
		return false;
	}
}
var gblUserId = "";
function errageMessage()
{
	document.getElementById("message").innerHTML = "";
}
function sendVerifyPassCodeAndChangePassword()
{
	getXmlHttpRequest();
	gblUserId = document.getElementById("userId1").value;
	var url = "changeForgottenPassword.kspl?userId="+encodeURIComponent(document.getElementById("userId1").value);
	url = url+"&txtcaptchaResponse="+encodeURIComponent(document.getElementById("txtcaptchaResponse").value);
	if(document.getElementById("hdnQuesUsedForPwdChng").value != "Y")
	{
		url = url+"&txtNewPassword="+encodeURIComponent(document.getElementById("txtNewPassword").value);
		url = url+"&txtConfirmPassword="+encodeURIComponent(document.getElementById("txtConfirmPassword").value);
	}
	url = url+"&txtPassCodeForChangePassword="+encodeURIComponent(document.getElementById("txtPassCodeForChangePassword").value);
	request.open("GET",url, true);
	if(document.getElementById("hdnQuesUsedForPwdChng").value != "Y")
	{
		document.getElementById("message").innerHTML = "<font face='Verdana' size='1' color='red'><b><center>Please wait while password is generated...</center></b></font>";
	}
	else
	{
		document.getElementById("message").innerHTML = "<font face='Verdana' size='1' color='red'><b><center>Please wait while forwarded to questions to password change...</center></b></font>";
	}
	request.onreadystatechange = sendVerifyPassCodeAndChangePassword_CallBack;
	request.send(null);
}
function sendVerifyPassCodeAndChangePassword_CallBack()
{
	if(document.getElementById("hdnQuesUsedForPwdChng").value != "Y")
	{
		document.getElementById("message").innerHTML = "<font face='Verdana' size='1' color='red'><b><center>Please wait while password is generated...</center></b></font>";
	}
	else
	{
		document.getElementById("message").innerHTML = "<font face='Verdana' size='1' color='red'><b><center>Please wait while forwarded to questions to password change...</center></b></font>";
	}
	if(request.readyState==4)
	{
		document.getElementById("message").innerHTML = request.responseText;		
		document.getElementById("userId1").value = "";
		document.getElementById("txtcaptchaResponse").value = "";
		document.getElementById("txtPassCodeForChangePassword").value = "";
		if(document.getElementById("hdnQuesUsedForPwdChng").value != "Y")
		{
			document.getElementById("txtNewPassword").value = "";
			document.getElementById("txtConfirmPassword").value = "";
		}
		document.getElementById('imgCaptch').src ='loadCaptch.kspl?'+ Math.random();
		//document.getElementById('imgCaptch').src ='loadCaptchMayo.kspl?'+ Math.random();
		if(document.getElementById("hdnQuesUsedForPwdChng").value == "Y" && document.getElementById("hdnIsSucc").value == "true")
		{
			changePasswordWithQuestion();
		}
		else
		{
			return false;
		}
	}
}
/* check added for password specification */
function countContain(strPassword, strCheck)
{
	var nCount = 0;
	for (i = 0; i < strPassword.value.length; i++)
	{
		if (strCheck.indexOf(strPassword.value.charAt(i)) > -1)
		{
			nCount++;
		}
	}
	return nCount;
}
function checkentry()
{
	var strUpperCase = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	var strLowerCase = "abcdefghijklmnopqrstuvwxyz";
	var strNumber = "0123456789";
	var strCharacters = "!@#$%^&*?_~-";
	/*if(document.getElementById("txtNewPassword").value == '')
	{
		if(document.getElementById("txtNewPassword").value.length == 0)
		{
			password.focus();
			alert("Please enter your old password.");
			return false;
		}
	}*/
	if(document.getElementById("txtNewPassword").value.length == 0)
	{
		document.getElementById("txtNewPassword").focus();
		alert("Please enter the new password.");
		return false;
	}
	//if password smaller than 6 or greater than 32
	if (document.getElementById("txtNewPassword").value.length < 6 || document.getElementById("txtNewPassword").value.length > 32)
	{
		//newPassword.focus();
		alert("Password cannot be less than 6 characters and more than 32 characters.");
		document.getElementById("txtNewPassword").value = "";
		return false;
	}
	var nLowerCount = countContain(document.getElementById("txtNewPassword"), strLowerCase);
	if (nLowerCount == 0) 
	{
		//newPassword.focus();
		alert("Password should contain atleast one small letter.");
		document.getElementById("txtNewPassword").value = "";
		return false;
	}
	var nUpperCount = countContain(document.getElementById("txtNewPassword"), strUpperCase);
	if (nUpperCount == 0) 
	{
		//newPassword.focus();
		alert("Password should contain atleast one capital letter.");
		document.getElementById("txtNewPassword").value = "";
		return false;
	}
	var nNumberCount = countContain(document.getElementById("txtNewPassword"), strNumber);
	if (nNumberCount == 0) 
	{
		//newPassword.focus();
		alert("Password should contain atleast one number.");
		document.getElementById("txtNewPassword").value = "";
		return false;
	}
	var nCharacterCount = countContain(document.getElementById("txtNewPassword"), strCharacters);
	if (nCharacterCount == 0) 
	{
		//newPassword.focus();
		alert("Password should contain atleast one special character.");
		document.getElementById("txtNewPassword").value = "";
		return false;
	}
}

function checkInnerData()
{
	if(document.getElementById("txtNewPassword"))
	{
		if(document.getElementById("txtNewPassword").value.length == 0)
		{
			document.getElementById("txtNewPassword").focus();
			alert("Please enter the new password.");

			return false;
		}
	}
	//if password smaller than 6 or greater than 32
	if(document.getElementById("txtNewPassword"))
	{
		if (document.getElementById("txtNewPassword").length < 6 || document.getElementById("txtNewPassword").length > 32)
		{
			document.getElementById("txtNewPassword").focus();
			alert("Password cannot be less than 6 characters and more than 32 characters.");
			document.getElementById("txtNewPassword").value = "";
			return false;
		}
	}
	if(document.getElementById("txtConfirmPassword"))
	{
		if(document.getElementById("txtConfirmPassword").value.length == 0)
		{
			document.getElementById("txtConfirmPassword").focus();
			alert("Please enter the confirm password.");
			return false;
		}
	}
	if(document.getElementById("txtConfirmPassword") && document.getElementById("txtNewPassword"))
	{
		if(document.getElementById("txtNewPassword").value != document.getElementById("txtConfirmPassword").value)
		{	
			document.getElementById("txtConfirmPassword").focus();		
			alert("Confirm password does not match with new password.");
			document.getElementById("txtConfirmPassword").value = "";
			return false;
		}
	}
	sendVerifyPassCodeAndChangePassword();
}

function showPassword() 
{
	var x = document.getElementById("Password1");
	if (x.type === "password") {
		x.type = "text";
	} else {
		x.type = "password";
	}
}
function ShowHidePassword(ID) {
if (document.getElementById($("#" + ID).prev().attr('id')).type == "password") {
	$("#" + ID).attr("data-hint", "Hide");
	$("#" + ID).find("i").removeClass("icon-eye").addClass("icon-eye-slash");
	document.getElementById($("#" + ID).prev().attr('id')).type = "text";
}
else {
	$("#" + ID).attr("data-hint", "Show");
	$("#" + ID).find("i").removeClass("icon-eye-slash").addClass("icon-eye");
	document.getElementById($("#" + ID).prev().attr('id')).type = "password";
}
}
function ShowHideConPassword(ID)
{
if (document.getElementById($("#" + ID).prev().attr('id')).type == "password") {
	$("#" + ID).attr("data-hint", "Hide");
	$("#" + ID).find("i").removeClass("icon-eye").addClass("icon-eye-slash");
	document.getElementById($("#" + ID).prev().attr('id')).type = "text";
}
else {
	$("#" + ID).attr("data-hint", "Show");
	$("#" + ID).find("i").removeClass("icon-eye-slash").addClass("icon-eye");
	document.getElementById($("#" + ID).prev().attr('id')).type = "password";
}
}