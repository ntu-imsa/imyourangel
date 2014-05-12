<?php
// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook(array(
  'appId'  => '1434732186749087',
  'secret' => 'cde5c80e82a3d84ca9473527be95db77',
));
// Get User ID
$user = $facebook->getUser();

// We may or may not have this data based on whether the user is logged in.
//
// If we have a $user id here, it means we know the user is logged into
// Facebook, but we don't know if the access token is valid. An access
// token is invalid if the user logged out of Facebook.

if ($user) {
  try {
    // Proceed knowing you have a logged in user who's authenticated.
    $user_profile = $facebook->api('/me');
  } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }
}

// Login or logout url will be needed depending on current user state.
if ($user) {
  $loginUrl = 'logout.php';
  $loginText = '登出';
} else {
//  $statusUrl = $facebook->getLoginStatusUrl();
  $loginUrl = $facebook->getLoginUrl();
  $loginText = '登入';
}

// This call will always work since we are fetching public data.
// $naitik = $facebook->api('/naitik');

function qMysql($str){
   $link = mysql_connect("localhost", "imyourangel", "");
   if (!$link) {
		die('Could not connect: ' . mysql_error());
   }
   mysql_select_db("imyourangel_2013", $link) or die(mysql_error());
   mysql_query("SET NAMES 'utf8'"); 
   mysql_query("SET CHARACTER_SET_CLIENT=utf8"); 
   mysql_query("SET CHARACTER_SET_RESULTS=utf8"); 
   $result = mysql_query($str, $link) or die(mysql_error());
   mysql_close($link);
   return $result;
}

function filterString($str){
return preg_replace("/[^a-zA-z0-9_\-]/", "", $str);
}

function isAdmin($uid){
  if($uid==737861445||$uid==100002099511931){
    return 1;
  }else{
    return 0;
  }
}

function gender_trans($str){
  switch($str){
    case 'male':
      return '男';
      break;
    case 'female':
      return '女';
      break;
  }
}
?>
