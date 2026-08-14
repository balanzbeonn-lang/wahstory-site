<?php

function executeQuery($sql)

	{ 

	global $conn;

	$result = mysqli_query($conn,$sql);

	if($result){

		return $result;

	}else{

		echo showError( mysqli_error($conn));

		//	echo  mysqli_error($conn);

		exit; 

	}

} 



function getSingleResult($sql)

	{

	$response = "";

	$result = executeQuery($sql);

	if ($line = mysqli_fetch_array($result)) {

		$response = $line[0];

	} 

	return $response;

} 



function ms_stripslashes($text)

	{

	if (is_array($text)) {

	$tmp_array = Array();

	foreach($text as $key => $value) {

	$tmp_array[$key] = ms_stripslashes($value);

	} 

	return $tmp_array;

	} else {

	return trim(stripslashes($text));

	} 

   } 



function Filter($string)

	{

	return trim(stripslashes($string));

	}





function ms_addslashes($text)

	{

	if (is_array($text)) {

	$tmp_array = Array();

	foreach($text as $key => $value) {

	$tmp_array[$key] = ms_addslashes($value);

	} 

	return $tmp_array;

	} else {

	return addslashes(stripslashes($text));

	} 

    } 







function dbOut($val) 

{

echo trim(ms_stripslashes($val));

}





function get_time_difference( $start, $end )



{



    $uts['start']      =    $start ;



    $uts['end']        =   $end ;



    if( $uts['start']!==-1 && $uts['end']!==-1 )



    {



        if( $uts['end'] >= $uts['start'] )



        {



            $diff    =    $uts['end'] - $uts['start'];



            if( $days=intval((floor($diff/86400))) )



                $diff = $diff % 86400;



            if( $hours=intval((floor($diff/3600))) )



                $diff = $diff % 3600;



            if( $minutes=intval((floor($diff/60))) )



                $diff = $diff % 60;



            $diff    =    intval( $diff );            



			$mktime = array('days'=>$days, 'hours'=>$hours, 'minutes'=>$minutes, 'seconds'=>$diff);

			if($mktime['days']<1){

				return $mktime['hours']." Hours ego";

			}elseif($mktime['days']>0 && $mktime['days']<365){

				return $mktime['days']>1?$mktime['days']." Days ego":"Yesterday"; 

			}

        }



        else



        {



            trigger_error( "Ending date/time is earlier than the start date/time", E_USER_WARNING );



        }



    }



    else



    {



        trigger_error( "Invalid date/time data detected", E_USER_WARNING );



    }



    return( false );



}

function dateDiff($dformat, $endDate, $beginDate)

{

$date_parts1=explode($dformat, $beginDate);

$date_parts2=explode($dformat, $endDate);

$start_date=gregoriantojd($date_parts1[0], $date_parts1[1], $date_parts1[2]);

$end_date=gregoriantojd($date_parts2[0], $date_parts2[1], $date_parts2[2]);

return $end_date - $start_date;

}





function linkButton($vars = array('url'=>'','name'=>'','title'=>'','value'=>'','class'=>'button_green','id'=>'','style'=>''))

	{

	 

	return "<input type='button' name='".$vars['name']."' value='".$vars['value']."' class='".$vars['class']."' title='".$vars['title']."' style='".$vars['style']."' onclick='location.href=\"$vars[url]\"'>";	

	}

	

function actionButtons($buttons,$blockname)

	{

	$butt='';

	foreach($buttons as $button=>$url)

		{

		$butt.="<a href='$url'><img src='images/$button.png' width='16' height='16' border='0' title='".ucfirst($button)." $blockname' style='padding-right:4px;'/></a>";

		}

	  return $butt;

	}	

	

function viewButtons($buttons,$blockname)

	{

	$butt='';

	foreach($buttons as $button=>$url)

		{

		$butt.="<a href='$url'><img src='images/$button.jpg' width='16' height='16' border='0' title='".ucfirst($button)." $blockname' style='padding-right:4px;'/></a>";

		}

	return $butt;

	}

	

function showTitle($name, $id)

{

	if($id=='')

	{

	   return "Add  ".$name;

	}

	else

	{

	   return "Edit  ".$name;

	}

}





	

function getAllResultSQL($tablename,$tbl_fields='')

	{

	$condition="1=1";

	if($tbl_fields!='')

	{

	foreach($tbl_fields as $key=>$value)

	{

	$condition.=" AND ".$key."=". $value;

	}	

	}

	$sql=executeQuery("SELECT * FROM  ".$tablename." WHERE ".$condition);

	

	return $sql; 

  }

  

  	

function getAllResultSqlLoop($tablename,$tbl_fields='')

	{

	$condition="1=1";

	if($tbl_fields!='')

	{

	foreach($tbl_fields as $key=>$value)

	{

	$condition.=" AND ".$key."=". $value;

	}	

	}

	$sql=executeQuery("SELECT * FROM  ".$tablename." WHERE ".$condition);

	while($row = mysqli_fetch_assoc($sql)){

	 $records[] = $row;

	}

	return $records; 

  }

  

  /********** Checking the mail formate is corect or not ************/

function isValidEmail($email) {

  if(preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/",$email)){

    list($username,$domain)=explode('@',$email);

    return true;

  }

  return false;

}





/******** Showing the next order of currunt content ********/

function getMaxDisOrder($table,$disorderfield)

{

$maxdisorder=getSingleResult("SELECT MAX(".$disorderfield.") FROM ".$table." WHERE 1=1");

return $maxdisorder+1;

}





function getMonthName($monthvalue)

{

if($monthvalue==1)$month="January";

if($monthvalue==2)$month="February";

if($monthvalue==3)$month="March";

if($monthvalue==4)$month="April";

if($monthvalue==5)$month="May";

if($monthvalue==6)$month="June";

if($monthvalue==7)$month="July";

if($monthvalue==8)$month="August";

if($monthvalue==9)$month="September";

if($monthvalue==10)$month="October";

if($monthvalue==11)$month="November";

if($monthvalue==12)$month="December";

return $month;

}



function addZero($val)

{

	if($val<10)

	{

	return "0".$val;

	}

	else

	{

	return $val;

	}

}





##################  CREATE THUMNAIL OF IMAGE ####################

function createthumb($name, $newname, $new_w, $new_h, $by_small=true, $border=false, $transparency=true, $base64=false) {

    if(file_exists($newname))

        @unlink($newname);

    if(!file_exists($name))

        return false;

    $arr = explode("\.",$name);

    $ext = $arr[count($arr)-1];



    if(preg_match('/jpeg/i', $ext)){

        $img = @imagecreatefromjpeg($name);

    }elseif (preg_match('/jpg/i', $ext)){

        $img = @imagecreatefromjpeg($name);

    } elseif(preg_match('/png/i', $ext)){

        $img = @imagecreatefrompng($name);

    } elseif(preg_match('/gif/i', $ext)) {

        $img = @imagecreatefromgif($name);

    }

    if(!$img)

        return false;

    $old_x = imageSX($img);

    $old_y = imageSY($img);

    if($old_x < $new_w && $old_y < $new_h) {

        $thumb_w = $old_x;

        $thumb_h = $old_y;

    } elseif ($old_x < $old_y) {

        if ($by_small) {

                $thumb_w = $new_w;

                $thumb_h = floor(($old_y*($new_h/$old_x)));

        }else{

                $thumb_w = floor($old_x*($new_w/$old_y));

                $thumb_h = $new_h;

        }

    } elseif ($old_x > $old_y) {

        if ($by_small) {

                $thumb_w = floor($old_x*($new_w/$old_y));

                $thumb_h = $new_h;

        }

    } elseif ($old_x == $old_y) {

        $thumb_w = $new_w;

        $thumb_h = $new_h;

    }

    $thumb_w = ($thumb_w<1) ? 1 : $thumb_w;

    $thumb_h = ($thumb_h<1) ? 1 : $thumb_h;

    $new_img = ImageCreateTrueColor($thumb_w, $thumb_h);



    if($transparency) {

        if(preg_match('/png/i', $ext)) {

            imagealphablending($new_img, false);

            $colorTransparent = imagecolorallocatealpha($new_img, 0, 0, 0, 127);

            imagefill($new_img, 0, 0, $colorTransparent);

            imagesavealpha($new_img, true);

        } elseif(preg_match('/gif/i', $ext)) {

            $trnprt_indx = imagecolortransparent($img);

            if ($trnprt_indx >= 0) {

                //its transparent

                $trnprt_color = imagecolorsforindex($img, $trnprt_indx);

                $trnprt_indx = imagecolorallocate($new_img, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue']);

                imagefill($new_img, 0, 0, $trnprt_indx);

                imagecolortransparent($new_img, $trnprt_indx);

            }

        }

    } else {

        Imagefill($new_img, 0, 0, imagecolorallocate($new_img, 255, 255, 255));

    }



    imagecopyresampled($new_img, $img, 0,0,0,0, $thumb_w, $thumb_h, $old_x, $old_y);

    if($border) {

        $black = imagecolorallocate($new_img, 0, 0, 0);

        imagerectangle($new_img,0,0, $thumb_w, $thumb_h, $black);

    }

    if($base64) {

        ob_start();

        imagepng($new_img);

        $img = ob_get_contents();

        ob_end_clean();

        $return = base64_encode($img);

    } else {

        if(preg_match('/jpeg/i', $ext)) {

                imagejpeg($new_img, $newname);

            $return = true;

        } elseif( preg_match('/jpg/i', $ext)){

            imagejpeg($new_img, $newname);

            $return = true;

        } elseif(preg_match('/png/i', $ext)){

            imagepng($new_img, $newname);

            $return = true;

        } elseif(preg_match('/gif/i', $ext)) {

            imagegif($new_img, $newname);

            $return = true;

        }

    }

    imagedestroy($new_img);

    imagedestroy($img);

    return $return;

}





function showStatus($status,$pid){

	 

	if($status==1){

	echo "<img src='".ADMIN."/images/active.png' />";

	} 

	else{

	echo "<img src='".ADMIN."/images/inactive.png' />";

	}



}


function get_expire_status($id){

if(is_expire($id)){

	return "<span style='color:red'>Expired</span>";

	}	

	else

	{ 

		return "<span style='color:green'>Valid</span>";

	}

}




function get_IP_address()

{

    foreach (array('HTTP_CLIENT_IP',

                   'HTTP_X_FORWARDED_FOR',

                   'HTTP_X_FORWARDED',

                   'HTTP_X_CLUSTER_CLIENT_IP',

                   'HTTP_FORWARDED_FOR',

                   'HTTP_FORWARDED',

                   'REMOTE_ADDR') as $key){

        if (array_key_exists($key, $_SERVER) === true){

            foreach (explode(',', $_SERVER[$key]) as $IPaddress){

                $IPaddress = trim($IPaddress); // Just to be safe



                if (filter_var($IPaddress,

                               FILTER_VALIDATE_IP,

                               FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)

                    !== false) {



                    return $IPaddress;

                }

            }

        }

    }

}







   //Do not call this function directly...use db_input

    function db_real_escape($val, $quote=false) {

	global $conn;

        //Magic quotes crap is taken care of in main.inc.php

        $val=mysqli_real_escape_string($conn,$val);



        return ($quote)?"'$val'":$val;

    }



    function db_input($var, $quote=true) {



        if(is_array($var))

            return array_map('db_input', $var, array_fill(0, count($var), $quote));

        elseif($var && preg_match("/^\d+(\.\d+)?$/", $var))

            return $var;



        return db_real_escape($var, $quote);

    }



	function db_error() {

		global $conn;

   	    return mysqli_error($conn);

	}

	

	function db_insert_id(){

		global $conn;

		return mysqli_insert_id($conn);

	}

	

function countRecord($table,$sts=''){

	if($sts==''){

		$res = 	getSingleResult("SELECT count(*) FROM `".$table."` where 1=1 ");

	}elseif($sts!=''){

		$res = 	getSingleResult("SELECT count(*) FROM `".$table."` where 1=1 and status = '".$sts."'");

	}

	return $res;

}



function encodeUser($user){

	$user  = 	base64_encode($user);

	return  $user;

}



function decodeUser($user){

	 $user = base64_decode($user);

	return $user;

}





function encodePassword($pass){

	$password  = 	base64_encode(md5($pass)."_".$pass);

	return  $password;

}



function decodePassword($pass){

	 $pass1 = base64_decode($pass);

	$pass2 = explode('_',$pass1);

	$password = $pass2[1];

	return $password;

}



function showAlphabetSearch($module){

$azRange = range('A', 'Z');

$rang = "<a href='".$module.".php'>All</a>&nbsp;|&nbsp;";

foreach ($azRange as $letter)

{

  $rang .= "<a href='".$module.".php?letter=".$letter."'>".$letter."</a>&nbsp;|&nbsp;";

}

return $rang;

}





function deleteRecord($table,$id){

	if(executeQuery("DELETE FROM `".$table."` WHERE `id` = '".$id."' ")){

		return true;

	}else{

		return false;

	}

}



function get_time_ago($time_stamp)

{

    $time_difference = strtotime('now') - $time_stamp;



    if ($time_difference >= 60 * 60 * 24 * 365.242199)

    {

        return get_time_ago_string($time_stamp, 60 * 60 * 24 * 365.242199, 'year');

    }

    elseif ($time_difference >= 60 * 60 * 24 * 30.4368499)

    {

        return get_time_ago_string($time_stamp, 60 * 60 * 24 * 30.4368499, 'month');

    }

    elseif ($time_difference >= 60 * 60 * 24 * 7)

    {

        return get_time_ago_string($time_stamp, 60 * 60 * 24 * 7, 'week');

    }

    elseif ($time_difference >= 60 * 60 * 24)

    {

        return get_time_ago_string($time_stamp, 60 * 60 * 24, 'day');

    }

    elseif ($time_difference >= 60 * 60)

    {

        return get_time_ago_string($time_stamp, 60 * 60, 'hour');

    }

    else

    {

        return get_time_ago_string($time_stamp, 60, 'minute');

    }

}



function get_time_ago_string($time_stamp, $divisor, $time_unit)

{

    $time_difference = strtotime("now") - $time_stamp;

    $time_units      = floor($time_difference / $divisor);



    settype($time_units, 'string');



    if ($time_units === '0')

    {

        return 'less than 1 ' . $time_unit . ' ago';

    }

    elseif ($time_units === '1')

    {

        return '1 ' . $time_unit . ' ago';

    }

    else

    {

        return $time_units . ' ' . $time_unit . 's ago';

    }

}



function seo_friendly_url($string){

    $string = str_replace(array('[\', \']'), '', $string);

    $string = preg_replace('/\[.*\]/U', '', $string);

    $string = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '-', $string);

    $string = htmlentities($string, ENT_COMPAT, 'utf-8');

    $string = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $string );

    $string = preg_replace(array('/[^a-z0-9]/i', '/[-]+/') , '-', $string);

    return strtolower(trim($string, '-'));

}



function cleanMe($input) {

   global $conn;

   $input = mysqli_real_escape_string($input,$conn);

   $input = htmlspecialchars($input, ENT_IGNORE, 'utf-8');

   $input = strip_tags($input);

   $input = stripslashes($input);

   return $input;

}



function DBSafe($InputVal) {

  if (is_numeric($InputVal)) {

    return $InputVal;

  } else {

    $InputVal=(!$InputVal?'NULL':"'$InputVal'");

    return $InputVal;

  }

}

function logout($path = 'index.php'){

 unset($_SESSION['ADMIN_ID']);

 unset($_SESSION['USER_ID']);

 session_destroy(); 

 redirect($path);

}




function isLanguageAllowedToUser($uid,$lid=''){

    $userLangs = getUserFldById("languages",$uid);

    $array_langs = explode(",",$userLangs);

    if($lid==''){

        $currentLangs = $_SESSION['LANG'];

    }else{

        $currentLangs = $lid;

    }

    if(in_array($currentLangs,$array_langs)){

		return true;

	}else{

		return false;

	}

}



  

function qry_str($arr, $skip = '')

	{

	$s = "?";

	$i = 0;

	foreach($arr as $key => $value) {

	if ($key != $skip) {

	if ($i == 0) {

	$s .= "$key=$value";

	$i = 1;

	} else {

	$s .= "&$key=$value";

	} 

	} 

	} 

	return $s;

    } 




 function getCurrentURL(){

      $pageURL = 'http';

         if ($_SERVER["HTTPS"] == "on"){$pageURL .= "s";}

         $pageURL .= "://";

         if ($_SERVER["SERVER_PORT"] != "80") {

             $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];

         }else {

             $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];

         }

         return $pageURL;

}







function cleanfileName($string){

    $string = str_replace(array('[\', \']'), '', $string);

    $string = preg_replace('/\[.*\]/U', '', $string);

    $string = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '-', $string);

    $string = htmlentities($string, ENT_COMPAT, 'utf-8');

    $string = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $string );

    $string = preg_replace(array('/[^a-z0-9]/i', '/[-]+/') , '-', $string);

    return strtolower(trim($string, '-'));

}




function get_product_link($id,$custom=''){

	if($custom==''){

		echo URL."product.php?pid=".$id;

	}else{

		echo URL.$custom;

	}

}



function get_category_link($id,$custom=''){

	

	if($custom==''){

		echo URL."category.php?catId=".$id;

	}else{

		echo URL.$custom;

	}

}

function get_page_link($id,$custom=''){

	

	if($custom==''){

		echo URL."cms.php?pid=".$id;

	}else{

		echo URL.$custom;

	}

}

if(!function_exists('is_logged_in')){
    function is_logged_in(){
        if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == TRUE){
            return true;
    }
       return false;
    }
}

?>