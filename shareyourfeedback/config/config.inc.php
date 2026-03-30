<?php
################################################################
## File: Website Main Configuration file                     ###
## Develoepr By : Rajput Pavan.                            ###
## PHP Core Module                                           ###
## These codes are not perfact. Please Contribute your skill ###
## to make it more strong and reusable.                      ###
## Thanks                                                    ###
################################################################ 


################# Database Details  ################
define('WEBSITE_DATABASE',"wahstory");        //EDIT THIS
define('WEBSITE_HOST',"localhost");         //EDIT THIS
define('WEBSITE_USER',"wahstory");              //EDIT THIS
define('WEBSITE_PASS',"NSL-TSu8Fb2v"); //EDIT THISplssankorsdo!
 
####################################################
define('ERROR_REPORTING','on');             //EDIT THIS
####################################################
########## CONSTANT VARIABLES  #####################
####################################################

define("ADMIN","admin");    
define("URL",'');     //EDIT THIS
define("ROOT_DIR",dirname(dirname(__FILE__))."/"); //EDIT THIS
define("ADMIN_URL",URL.ADMIN."/");          //EDIT THIS
define("ADMIN_PATH",ROOT_DIR.ADMIN."/");
####################################################
####################################################

function generateNumericOTP($n) { 
	$generator = "1357902468"; 
	$result = ""; 
	for ($i = 1; $i <= $n; $i++) { 
		$result .= substr($generator, (rand()%(strlen($generator))), 1); 
	}
	return $result; 
} 

/*function sendSMS($recipient_no, $message){
     // Merge API url and parameters
    $apiUrl = "http://sms.jayinegroup.com/api_v2/message/send";
  
  
  $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $apiUrl,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "sender_id=BLKSMS&message=".$message."&mobile_no=".$recipient_no,
  CURLOPT_HTTPHEADER => array(
    "authorization: Bearer ".SMS_API_KEY,
    "cache-control: no-cache",
    "content-type: application/x-www-form-urlencoded"
  ),
));
	$response = curl_exec($curl);
	$err = curl_error($curl);
	curl_close($curl);
	if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
		  return $response;
	}
} */

// Live url :  https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction

//FOR SEO URL TYPE "SEO"
####################################################
#############  DONT EDIT BELOW THIS   ##############
####################################################

@session_start();
$sess_id=session_id();
@extract($_ENV);
@extract($_SESSION);
@extract($_GET);
@extract($_POST);
@extract($_FILES);
@extract($_COOKIE);
@extract($_SERVER);
@ob_start();



###################################################
// Setting Server Default Timezone
date_default_timezone_set('Asia/Calcutta');
// Setting Error Notification Mode
if(ERROR_REPORTING=='on'){
	error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
}else{
	error_reporting(0);
}
###################################################
function showError($msg){
	$message = '<div class="alert alert-new alert-danger alert-dismissible fade show" role="alert"><strong>Error!</strong>&nbsp;&nbsp;&nbsp;&nbsp;'.$msg.'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
	return $message;
}

function showSuccess($msg){
	$message = '<div class="alert alert-new alert-success alert-dismissible fade show" role="alert"><strong>Success!</strong>&nbsp;&nbsp;&nbsp;&nbsp;'.$msg.'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
	return $message;
}

global $conn;
$conn = mysqli_connect(WEBSITE_HOST, WEBSITE_USER, WEBSITE_PASS,WEBSITE_DATABASE);
if (!$conn) {
  die("<center><strong style=' color: #dc1c1c; font-size: 18px;
    background: #e6a6a6c9;  padding: 10px 15px; border-radius: 5px;'>ERROR: Database Connection error. (Error Type: " . mysqli_connect_error().")</stonrg></center>");
}

mysqli_set_charset($conn, 'utf8');

mysqli_query($conn,'SET character_set_results=utf8');
mysqli_query($conn,'SET names=utf8');
mysqli_query($conn,'SET character_set_client=utf8');
mysqli_query($conn,'SET character_set_connection=utf8');
mysqli_query($conn,'SET character_set_results=utf8');
mysqli_query($conn,'SET collation_connection=utf8_general_ci');

function getAdminHeadBlock(){
$code = '';
$code = '<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">';
return $code;
}

function getAdminFootBlock(){
$code = '';
return $code;
}

function sanitize($data) {
		global $conn;
        $data = trim($data);
        $data = htmlspecialchars($data);
        $data = mysqli_real_escape_string($conn,$data);
        return $data;
}
function redirect($path,$array=array()){
	if(empty($array)){
		echo "<script>document.location.href='".$path."'</script>";
		header("Location:".$path);
		exit;
	}else{
		$args = '?arg=true';
		foreach($array as $k=>$v){
			$args .= "&".$k."=".$v;
		}
		echo "<script>document.location.href='".$path.$args."'</script>";
		header("Location:".$path.$args);
		exit;
	}
}


function mkLink($path,$array=array(),$addArgs=array()){
	if(empty($array)){
		$link = $path;
	}else{
		if($addArgs[0]==''){
			$args = '?arg=true';
		}else{
			foreach($addArgs as $k1=>$v1){
				$args = "?".$k."=".$v;
			}
		}
		foreach($array as $k=>$v){
			$args .= "&".$k."=".$v;
		}
		$link = $path.$args;
	}
	return $link;
}




?>