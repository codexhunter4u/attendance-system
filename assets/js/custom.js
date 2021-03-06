var checksum = false;
var isEmpty = false;

/**
 * @date : 28/12/2019
 * @Desc : On page load manage the manage Sign-In/ Up form
 */
$( "#registerEvent" ).click(function() {
  $(".formPasswordReset").hide();
 	$(".formLogin").hide();
 	$(".formRegister").show();
 	$(this).prop('disabled', true);
});


/**
 * @date : 28/12/2019
 * @Desc : Register users 
 */
$("#registerBtn").click(function() {	

   if(validateForm()){

   		if(checksum===false){
   			$("#user_confirmpassword").attr('placeholder',"Please confirm password").val('').css('border-color','red');
   			return false;
   		}
      
      var data = JSON.stringify($('#userRegister').serializeArray());
      
      $.ajax({
        url: BASEPATH+'Login/signUp',
        type: 'post',
        data: { formData : data },
        cache: false,
        success: function(res) {
          //console.log(res);return;
          var data = JSON.parse(res);
          data['responseCode']=='1' ? toastr.success(data['responseMessage']) : toastr.error(data['responseMessage']);
          $("#userRegister")[0].reset();
          $("#userRegister input").css('border-color','#ccc');
 		      $(".formRegister").hide();
 		      $(".formLogin").show();
 		      $("#registerEvent").prop('disabled', false);
        }
      });

   }else{
   		console.log('Sometinh is missing...!');
   }
   
});

/**
 * @author : Mohan Jadhav<mohan212jadhav@gmail.com>
 * @date : 28/12/2019
 * @Desc : Validate the confirm password and password on runtime.
 */
$("#user_confirmpassword").keyup(function(e) {
	if ($('#password').val() != '' && $(this).val() !== $("#password").val()) {
      $(this).css('border-color','red');
      checksum = false;
    }else{
      $(this).css('border-color','green');
      checksum = true;
    }

});

/**
 * @author : Mohan Jadhav<mohan212jadhav@gmail.com>
 * @date : 28/12/2019
 * @Desc : Validate sing-in/up form for empty value and email & date formate
 */
function validateForm(){

	var isEmpty;

	var userDOB = $("#date_of_birth").val();
	var useremail = $("#user_email").val();

	$("#userRegister input").each(function() {
	   var element = $(this);
	   if (element.val() == "") {
	       $(this).attr('placeholder',"This field is required").css('border-color','red');
	    	isEmpty = false;
	   }else{
	   		$(this).css('border-color','green');
	    	isEmpty = true;
	   }

	});

	if(!(validateDate(userDOB,'date_of_birth'))){
		isEmpty = false;
	}  
	if(!(validateEmail(useremail))){
		$("#user_email").attr('placeholder',"Please enter the valid email").val('').css('border-color','red');
		isEmpty = false;
	}

	return isEmpty;
}

/**
 * @author : Mohan Jadhav<mohan212jadhav@gmail.com>
 * @date : 28/12/2019
 * @Desc : Validate Email formate
 */
function validateEmail(email) {
  var emailReg = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);
  return emailReg.test(email);
}

/**
 * @author : Mohan Jadhav<mohan212jadhav@gmail.com>
 * @date : 28/12/2019
 * @Desc : Vlaidate Date formate
 */
function validateDate(date,field){
    
    var birthday = moment(date);
    var fieldName = field.split(".")[0];
    var preg = /^(?:(0[1-9]|[12][0-9]|3[01])[\- \/.](0[1-9]|1[012])[\- \/.](19|20)[0-9]{2})$/;
    
    if(date.match(preg)){
    	$("#"+fieldName).css('border-color','green');
        return true;    
    }else {
    	$("#"+fieldName).val('');
        $("#"+fieldName).attr('placeholder',"Please enter the valid DOB").css('border-color','red');
        return false;    
    }

}

/**
 * @author : Mohan Jadhav<mohan212jadhav@gmail.com>
 * @date : 28/12/2019
 * @Desc : Sign-In in system
 */
$("#signIn").click(function() {

   if( ($("#username").val() != '') && ($("#userpassword").val() != '') ){

   	  $('#frmLogin input').css('border-color','green');

      var data = JSON.stringify($('#frmLogin').serializeArray());
      var flag = $('.rememberMe').is(":checked") ? '1' : '0'; 
      $.ajax({
        url: BASEPATH+'Login/login',
        type: 'post',
        data: { formData : data, rememberMe : flag },
        cache: false,
        success: function(res) {
          //console.log(res);return;
          var data = JSON.parse(res);
          if(data['responseCode']!='1'){
            toastr.error(data['responseMessage']);
            return false;
          }else{
            window.location.href = BASEPATH+''+data['redirect_url'];
          }
        }
      });
   }else{

   		if($('#username').val()!='')
   			$('#username').css('border-color','green');
   		else
   			$('#username').attr('placeholder',"This field is required").css('border-color','red');

   		if($('#userpassword').val()!='')
   			$('#userpassword').css('border-color','green');
   		else
   			$('#userpassword').attr('placeholder',"This field is required").css('border-color','red');

   }
   
});


/**
 * @author : Mohan Jadhav<mohan212jadhav@gmail.com>
 * @date : 28/12/2019
 * @Desc : manage the pages on click Password reset.
 */
$( "#resetPassBtn" ).click(function() {
   $(".lead").text('Reset your account password');
   $(".formLogin").hide();
   $(".formPasswordReset").show();
});

/**
 * @author : Mohan Jadhav<mohan212jadhav@gmail.com>
 * @date : 28/12/2019
 * @Desc : Reset user password
 */
$("#resetPass").click(function() {  
    
   if(formEmptyValidator('frmPassReset')){
      
      var data = JSON.stringify($('#frmPassReset').serializeArray());
      $.ajax({
        url: BASEPATH+'Login/resetPassword',
        type: 'post',
        data: { resetPassformData : data },
        cache: false,
        success: function(res) {
          // console.log(res);return;
          var data = JSON.parse(res);
          data['responseCode']=='1' ? toastr.success(data['responseMessage']) : toastr.error(data['responseMessage']);
          $("#frmPassReset")[0].reset();
          $("#frmPassReset input").css('border-color','#ccc');
          $(".lead").text('Login to your account');
          $(".formPasswordReset").hide();
          $(".formLogin").show();
        }
      });

   }else{
      console.log('Sometinh is missing...!');
   }
   
});

/**
 * @author : Mohan Jadhav<mohan212jadhav@gmail.com>
 * @date : 28/12/2019
 * @Desc : Form validate while password reset.
 */
function formEmptyValidator(formName){

  var isEmpty = false;
  $("#"+formName+ " input").each(function() {
     var element = $(this);
     if (element.val() == "") {
         $(this).attr('placeholder',"This field is required").css('border-color','red');
        isEmpty = false;
     }else{
        $(this).css('border-color','green');
        isEmpty = true;
     }

  });

  return isEmpty;

}

/**
 * @author : Mohan Jadhav<mohan212jadhav@gmail.com>
 * @date : 28/12/2019
 * @Desc : Auto logout from system is the screen Idle for 1 min.
 */
var idleTime = 0;
$(document).ready(function () {
    //Increment the idle time counter every minute.
    setInterval(timerIncrement, 60000); // 1 minute
    //Zero the idle timer on mouse movement.
    $(this).mousemove(function (e) {
        idleTime = 0;
    });
    $(this).keypress(function (e) {
        idleTime = 0;
    });
    
});

function timerIncrement() {
    idleTime = idleTime + 1;
    if (idleTime > 10) { // 10 minutes
        window.location.reload();
        window.location.href = BASEPATH+'login/logout';
    }
}