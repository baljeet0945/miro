<?php  
if(!isset($_SESSION['admin']) || empty($_SESSION['admin'])){	
	$_SESSION['redirect_msg']  = array("msg" => 0, 'session_out_msg'=>'Your session has expired. Please log in again', 'error_msg'=>''); 
	header('location:'.SITE_URL);
	exit;
}
?>