<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') 
    $link = "https"; 
else
    $link = "http"; 
$link .= "://"; 
$link .= $_SERVER['HTTP_HOST']; 
$link .= $_SERVER['REQUEST_URI'];

$not_check = '';
$exp_1 = explode("?",$link);
if(count($exp_1) > 1){
	$exp_2 = explode("&",$exp_1[1]);
	if(count($exp_2) > 1){
		$not_check = $exp_2['0'];
	}
}

if($not_check == "page=transactions/print_details"){
	
}elseif($not_check == "page=quotations/print_details"){
	
}else{
	if(!isset($_SESSION['userdata']) && !strpos($link, 'login.php')){
		redirect('admin/login.php');
	}
	if(isset($_SESSION['userdata']) && strpos($link, 'login.php')){
		redirect('admin/index.php');
	}
	$module = array('','admin','faculty','student');
	if(isset($_SESSION['userdata']) && (strpos($link, 'index.php') || strpos($link, 'admin/')) && $_SESSION['userdata']['login_type'] !=  1){
		echo "<script>alert('Access Denied!');location.replace('".base_url.$module[$_SESSION['userdata']['login_type']]."');</script>";
		exit;
	}
}


