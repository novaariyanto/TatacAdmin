<?php 

@ini_set('session.gc_maxlifetime',12*60*60);
@ini_set('session.cookie_lifetime',12*60*60);
//echo phpinfo();


@session_start();
// //API host link

//example url  http://domain.com/API/
$mainURL="http://172.16.2.181/apitic/";

//dont change any other thing
$baseurl = $mainURL."index.php?p=";
$base_URL = $mainURL;

$sound_baseurl = $mainURL."uploadSound/upload/";

$sound_baseurl_play = $mainURL."upload/audio/";

//example url  http://domain.com/portal/uploads/
$img_baseurl = "http://172.16.2.181/apitic/uploads/";
$app_name="Tatac";
$app_picture="https://lh3.googleusercontent.com/SYiDangD8zo_pyaO89XGzeXF1H0kZgZG-BvrILva3sTPnvtVW8zlYwSQ_n_qWWBO9Q=s180";

?>
    <style>
      
        .buttonColor
        {   
            background: #D4401D;  /* fallback for old browsers */
            color:white; 
            border:none; 
            cursor:pointer;
        }
        .textColor
        {
            color:#D4401D;
            position: relative; 
            margin:-37px 0 0 45px;
            font-size: 32px;
        }
        
        .login_leftsidebar li.active a {
            background: #D4401D;
            color:white; 
        }
        
        .login_leftsidebar li.active::after {
            border-left: 10px solid #D4401D;
        }
      
    
    </style>
<?php

if( isset($_GET['login']) ) { //log

	if( $_GET['login'] == "ok" ) { //login user

		 $email = htmlspecialchars($_POST['email'], ENT_QUOTES);
	     $password = htmlspecialchars($_POST['pass'], ENT_QUOTES);
	    //$returnlink=htmlspecialchars($_POST['returnlink'], ENT_QUOTES);
	    
	    if( !empty($email) && !empty($password) ) { 

			$headers = array(
				"Accept: application/json",
				"Content-Type: application/json",
				"Api-Key: V98IhPYJQmunYMplfBMb48wOxGvBzlVS"
			);

			$data = array(
				"email" => $email, 
				"password" => $password
			);

			$ch = curl_init( $baseurl.'Admin_Login' );

			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

			$return = curl_exec($ch);

			$json_data = json_decode($return, true);

			$curl_error = curl_error($ch);
			$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

			//echo $json_data['code'];
			//print_r($json_data['code']);
			//die();
			
			curl_close($ch);

			if($json_data['code'] == 201){
				echo "<script>window.location='index.php?action=error'</script>";
			} 
			else 
			{	
				$_SESSION['id'] = rand();
				$_SESSION['email'] = $email;

				echo "<script>window.location='dashboard.php?p=users'</script>";

			}

		} 
		else 
		{
			echo "<script>window.location='index.php?action=error'</script>";
		} 

	} //login user = end


	

} //log = end

if(@$_GET['log'] == "out" ) 
	{ //logout user

		@session_destroy();
		@header("Location: index.php");
   		echo "<script>window.location='index.php'</script>";

   	} //logout user = end


?>