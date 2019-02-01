$("#sponsor_id").on("blur" , function() {

var s_id = $(this).val();

$.ajax({
	url : "ajax/ajax_function.php",
	type : "POST",
	data :"s_id="+s_id+"&check_sponsor_id=check_sponsor_id",
	success : function(result) {
		
		var data = jQuery.parseJSON(result);

		if(data.status==="found") {

			$("#sponsor_id").css("border-color" , "green");
			$("#sponsor_name").val(data.sponsor_name);
		}
		else {
			$("#sponsor_id").css("border-color" , "red");
			$("#sponsor_name").val("");
			alert(data.message);
			
		}

	}

});


});
/*********** Check Sponsor Id Close *************/

$("#store_user").on("click" , function() {
	
/*$(".required").each(function() {

	if($(this).val()===""){
		$(this).css("border-color" , "red");
	}
	else{
		$(this).css("border-color" , "green");

	}

});
*/

var fd = new FormData();

var gender = $("input[type=radio][name=gender]:checked").val();
fd.append("user_password" , $("#user_password").val());
fd.append("sponsor_id" , $("#sponsor_id").val());
fd.append("user_name" , $("#user_name").val());
fd.append("father_name" , $("#father_name").val());
fd.append("dob" , $("#dob").val());
fd.append("gender" , gender);
fd.append("address" , $("#address").val());
fd.append("city" , $("#city").val());
fd.append("address" , $("#address").val());
fd.append("district" , $("#district").val());
fd.append("state" , $("#state").val());
fd.append("country" , $("#country").val());
fd.append("pincode" , $("#pincode").val());
fd.append("email_id" , $("#email_id").val());
fd.append("phone_no" , $("#phone_no").val());
fd.append("mobile_no" , $("#mobile_no").val());

fd.append("occupation_name" , $("#occupation_name").val());
fd.append("bank_name" , $("#bank_name").val());
fd.append("branch_name" , $("#branch_name").val());

fd.append("account_no" , $("#account_no").val());
fd.append("account_type" , $("#account_type").val());
fd.append("account_holder_name" , $("#account_holder_name").val());

fd.append("ifsc_code" , $("#ifsc_code").val());
fd.append("pan_no" , $("#pan_no").val());
fd.append("pan_holder_name" , $("#pan_holder_name").val());

fd.append("voter_id" , $("#voter_id").val());
fd.append("nominee_name" , $("#nominee_name").val());
fd.append("profile_photo" , $("#profile_photo").val());

fd.append("pan_photo" , $("#pan_photo").val());
fd.append("user_store_function" , $("#user_store_function").val());

 fd.append('profile_image', $('#profile_photo')[0].files[0]);
 fd.append('pan_image', $('#pan_photo')[0].files[0]);  


$.ajax({

	url : "ajax/ajax_function.php",
	type : "POST",
	data : fd,
	cache : false,
	processData : false,
	contentType : false,
	success : function(result) {
			if(result.trim() === "success"){
				alert("Registered Successfully");
				
			}
			else {
				alert(result);
			}
	}

});
});

/********* Payment Uplaod JS ******************/
$("#upload_payment_receipt").on("click" , function() {

/******* Validate payment receipt Upload **********/	
if($("#payment_receipt").val() == ''){
	alert("Select Receipt File");
	return false;
}
/************ Close **************/

var fd = new FormData();

fd.append('payment_receipt', $('#payment_receipt')[0].files[0]); 
fd.append('payment_upload_function', 'payment_upload_function'); 

$.ajax({

	url : "ajax/ajax_function.php",
	type : "POST",
	data : fd,
	cache : false,
	processData : false,
	contentType : false,
	success : function(result) {
			if(result.trim() === "success"){
				alert("Receipt Uploaded Successfully");	
				location.reload();			
			}
			else {
				alert(result);
			}
	}

});


});