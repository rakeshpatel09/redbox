<?php
session_start();
error_reporting(0);

/********** Global Users Variable **********/
$user_name = $_SESSION['user_name'];
$user_id = $_SESSION['user_id'];
/****** Close ******/

include_once "../../config/config.php";

/******** Compress Image function ***************/
function compress_image($source_url, $destination_url, $quality) {

      $info = getimagesize($source_url);

          if ($info['mime'] == 'image/jpeg')
          $image = imagecreatefromjpeg($source_url);

          elseif ($info['mime'] == 'image/gif')
          $image = imagecreatefromgif($source_url);

          elseif ($info['mime'] == 'image/png')
          $image = imagecreatefrompng($source_url);

          // php inbuilt function for compressing image  
          imagejpeg($image, $destination_url, $quality);
          
          return $destination_url;
        }
  /*********************8 Close **************/

if(isset($_POST['check_sponsor_id'])) {
	
$s_id = $_POST["s_id"];

$check_sponsor = mysqli_query($conn,"SELECT user_id,user_name FROM users WHERE user_id = '$s_id' ");

if(!$check_sponsor){
	echo $conn->error;
	exit(); 
}

if($check_sponsor->num_rows > 0 ){
	 
$sponsor_info = mysqli_fetch_array($check_sponsor);




$arr  = array('status'=>"found",'message'=>"Sponsor Found",'sponsor_name'=>$sponsor_info["user_name"]);

//

}
else {
	$arr  = array('status'=>"not_found",'message'=>"Sponsor Not Found");

}

echo json_encode($arr);

}


if(isset($_POST['user_store_function'])) {

	$user_id = 0;
	$user_name = $_POST["user_name"];
	$user_password = md5($_POST["user_password"]);
	$father_name = $_POST["father_name"];
	$dob = $_POST["dob"];
	$gender = $_POST["gender"];
	$address = $_POST["address"];
	$city = $_POST["city"];
	$district = $_POST["district"];

	$state = $_POST["state"];
	$country = $_POST["country"];
	$pincode = $_POST["pincode"];
	$email_id = $_POST["email_id"];
	$phone_no = $_POST["phone_no"];
	$mobile_no = $_POST["mobile_no"];
	$occupation_name = $_POST["occupation_name"];

	$ifsc_code = $_POST["ifsc_code"];
	$voter_id = $_POST["voter_id"];
	$pan_no = $_POST["pan_no"];

	$pan_holder_name = $_POST["pan_holder_name"];
	$bank_name = $_POST["bank_name"];
	$branch_name = $_POST["branch_name"];
	$account_no = $_POST["account_no"];
	$account_type = $_POST["account_type"];
	$account_holder_name = $_POST["account_holder_name"];
	$mobile_no = $_POST["mobile_no"];
	$occupation_name = $_POST["occupation_name"];

	$check_user_id = mysqli_query($conn,"SELECT MAX(user_id) FROM users");
	if($check_user_id->num_rows > 0) {
		$fetch_user_id = mysqli_fetch_array($check_user_id);
		$user_id = $fetch_user_id[0] + 1;
	}
	else {

		$user_id = "1000000";
	}
	

	$profile_image = $_FILES["profile_image"]["name"];
	$pan_image = $_FILES["pan_image"]["name"];

/*********** Image uploads ********************/
	
	 
  $profile_url = "";
  $pan_url = "";

 if($profile_image !== NULL) {

  $photo_file_name = $_FILES['profile_image']['name'];
		$photo_file_size =$_FILES['profile_image']['size'];
		$photo_file_tmp =$_FILES['profile_image']['tmp_name'];

		$photo_path_parts = pathinfo($_FILES["profile_image"]["name"]);
        $photo_extension = $photo_path_parts['extension'];;

if ($_FILES["profile_image"]["size"] > 2000000) {
	echo("Size Error!!.. Please Select Iamge whose size less than 2MB");
	exit(); 
}
						   
	// Allow certain file formats
 if($photo_extension != "jpg" && $photo_extension != "JPG" && $photo_extension != "PNG" && $photo_extension != "jpeg" && $photo_extension != "png" && $photo_extension != "JPEG"
		&& $photo_extension != "GIF" && $photo_extension != "gif" ) {

		echo("File Type Error!!.. Please Select Proper Image"); exit();  }

		if($photo_file_name !== NULL) {
            $profile_url = "upload/".$user_name.rand(10,99999).".".$photo_extension;
            $filename = compress_image($photo_file_tmp, "../".$profile_url, 75);
          }
         }  else
            $profile_url = "none";
/*********** Close Image File url **********************8*/

if($pan_image !== NULL) {

  $pan_file_name = $_FILES['pan_image']['name'];
		$pan_file_size =$_FILES['pan_image']['size'];
		$pan_file_tmp =$_FILES['pan_image']['tmp_name'];

		$pan_path_parts = pathinfo($_FILES["pan_image"]["name"]);
        $pan_extension = $pan_path_parts['extension'];;

if ($_FILES["pan_image"]["size"] > 2000000) {
	echo("Size Error!!.. Please Select Iamge whose size less than 2MB");
	exit(); 
}
						   
	// Allow certain file formats
 if($pan_extension != "jpg" && $pan_extension != "JPG" && $pan_extension != "PNG" && $pan_extension != "jpeg" && $pan_extension != "png" && $pan_extension != "JPEG"
		&& $pan_extension != "GIF" && $pan_extension != "gif" ) {

		echo("File Type Error!!.. Please Select Proper Image"); exit();  }

		if($pan_file_name !== NULL) {
            $pan_url = "upload/".$user_name.rand(10,99999).".".$pan_extension;
            $filename = compress_image($pan_file_tmp,"../".$pan_url, 75);
          }
         }  else
            $pan_url = "none";
/*********** Close Image File url **********************8*/


	$user_stmt = $conn->prepare("INSERT INTO users (`user_id`,`user_name`, `father_name`, `dob`, `gender`, `address`, `city`, `district`, `state`, `country`, `pincode`, `email_id`, `phone_no`, `mobile_no`, `adhar_photo`,`pan_photo`, `created_date`, `modified_date`, `password`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,now(),now(),?) ");

	$user_stmt->bind_param("ssssssssssissssss",$user_id , $user_name , $father_name , $dob , $gender , $address , $city , $district ,$state , $country , $pincode , $email_id , $phone_no , $mobile_no ,$profile_url,$pan_url,$user_password);

	if($user_stmt->execute())
	{
		$u_id = $conn->insert_id;

		$o_stmt = $conn->prepare("INSERT INTO `occupation_info` (`user_id`, `o_name`, `bank_name`, `branch_name`, `account_no`, `account_type`, `account_name`, `ifsc_code`, `pan_no`, `pan_name`, `voter_id`, `created_date`, `modified_date`) VALUES (?,?,?,?,?,?,?,?,?,?,?,now(),now()) ");

	$o_stmt->bind_param("sssssssssss",$user_id , $occupation_name , $bank_name , $branch_name , $account_no , $account_type , $account_holder_name , $ifsc_code ,$pan_no , $pan_holder_name , $voter_id);

			if($o_stmt->execute()) {

				$sponsor_stmt = $conn->prepare("INSERT INTO `sponsor_relationship` (`user_id`, `sponsor_id`,`date`) VALUES (?,?,now()) ");

				$s_id = $_SESSION['user_id'];

				$sponsor_stmt->bind_param("ss",$user_id , $s_id);

				if($sponsor_stmt->execute()) {
					echo "success";
				}
				else {
					echo $conn->error;
				}
			}
			else {
				echo $conn->error;
			}

		}

	else {
		echo $conn->error;
	}

}

/******** Payment Receipt Upload function *****************/
if(isset($_POST['payment_upload_function'])) {

	$payment_receipt = $_FILES["payment_receipt"]["name"];
	

/*********** Image uploads ********************/
	 
  $profile_url = "";
  $pan_url = "";

 if($payment_receipt !== NULL) {

  		$photo_file_name = $_FILES['payment_receipt']['name'];
		$photo_file_size =$_FILES['payment_receipt']['size'];
		$photo_file_tmp =$_FILES['payment_receipt']['tmp_name'];
		$photo_path_parts = pathinfo($_FILES["payment_receipt"]["name"]);
        $photo_extension = $photo_path_parts['extension'];;

if ($_FILES["payment_receipt"]["size"] > 2000000) {
	echo("Size Error!!.. Please Select Iamge whose size less than 2MB");
	exit(); 
}
						   
	// Allow certain file formats
 if($photo_extension != "jpg" && $photo_extension != "JPG" && $photo_extension != "PNG" && $photo_extension != "jpeg" && $photo_extension != "png" && $photo_extension != "JPEG"
		&& $photo_extension != "GIF" && $photo_extension != "gif" ) {

		echo("File Type Error!!.. Please Select Proper Image"); exit();  }

		if($photo_file_name !== NULL) {
			
            $profile_url = "upload/receipt/".$user_name.rand(10,99999)."_payment_receipt.".$photo_extension;
            $filename = compress_image($photo_file_tmp, "../".$profile_url, 75);
            
            $user_stmt = $conn->prepare("INSERT INTO user_activation (`a_user_id`, `payment_receipt`,  `created_date`) VALUES (?,?,now()) ");

			$user_stmt->bind_param("is",$user_id,$profile_url);

			if($user_stmt->execute())
			{
				$user_update_stmt = $conn->prepare("UPDATE users SET user_status=1 WHERE user_id=? ");
				
				/************ Update User Status ******************/
				$user_update_stmt->bind_param("i",$user_id);
				if($user_stmt->execute())
				{
	           		echo "success";
	           	}	
	        }
	        else {
	        	echo $conn->error;
	        }
    	}
    else {
    	echo "fail";
    }

/*********** Close Image File url **********************8*/
	}
}

?>