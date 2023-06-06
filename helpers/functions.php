<?php 
require_once('classes/boards.php'); 
require_once('classes/users.php');   
require_once('classes/admin.php'); 
require_once('classes/mails.php');   
require_once('classes/auth0.php'); 

$type = $_GET['type'];

if($type == "signup"){	
	sleep(1);	  
	$call = USER::signUp($_POST);
	if($call['status'] == 'error'){
		$show = array("msg" => 'error', 'notice'=>$call['msg'], 'name'=>'signup');  	
	}else{
		$lastId = $call['result'];		
		$call = BOARD::createBoard('Board '.time());		
		if($call['status'] == 'error'){
			$show = array("msg" => 'error', 'notice'=>$call['msg'], 'name'=>'signup');  	
		}else{
			$setAuthUser = AUTH::createUser($_POST, $lastId);
			$setMiroUser = BOARD::createScimUser($_POST);
			$call = USER::updateUser($lastId, $call['result']['board_id'], $call['result']['card_id'], $setAuthUser['result'], $setMiroUser['result']);
			if($call['status'] == 'error'){
				$show = array("msg" => 'error', 'notice'=>$call['msg'], 'name'=>'signup');  	
			}else{	
				$_SESSION['admin'] = $call;			
				$show = array("msg" => 'success', 'notice'=>'Your account is create. Please wait redirecting...', 'href'=>ADMIN_URL);
			}				
		}		
	}	
	echo json_encode($show);  
}	

else if($type == "login"){	
	sleep(1);	  
	$call = USER::login($_POST);	
	if($call['status'] == 'error'){
		$show = array("msg" => 'error', 'notice'=>$call['msg'], 'name'=>'login');  	
	}else{
		if($call['result']['user_type'] == 1){
			$_SESSION['admin'] = $call;
			$show = array("msg" => 'success', 'notice'=>$call['msg'], 'href'=>ADMIN_URL);
		}else{
			$_SESSION['user'] = $call;
			$show = array("msg" => 'success', 'notice'=>$call['msg'], 'href'=>SITE_URL.'user');
		}
	}	
	echo json_encode($show);   
}

else if($type == "auth0_login"){
	$call = AUTH::redirectToLogin(); 
	if($call['status'] == 'error'){
		FD_add_notices($call['msg'], 'error');
		header('Location:'.SITE_URL);  	
	}else{
		header('Location:'.$call['result']);
		FD_add_notices($call['msg'], 'success');	
	} 
}

else if($type == "callback"){	
	$call = AUTH::callback();	
	if($call['status'] == 'error'){
		FD_add_notices($call['msg'], 'error');
		header('Location:'.SITE_URL);  
		exit;	
	}
	$call = AUTH::getAuthUser();
	if($call['status'] == 'error'){
		FD_add_notices($call['msg'], 'error');
		header('Location:'.SITE_URL);  
		exit;	 
	}
	$call = USER::grantAccessToUser($call['result']['user_metadata']['user_account_id']);
	if($call['status'] == 'error'){
		FD_add_notices($call['msg'], 'error');
		header('Location:'.SITE_URL);  
		exit;	
	}
	
	FD_add_notices($call['msg'], 'success');
	if($call['result']['user_type'] == 1){
		$_SESSION['admin'] = $call;
		header('Location:'.ADMIN_URL); 
	}else{
		$_SESSION['user'] = $call;
		header('Location:'.SITE_URL.'user'); 
	}	
}

else if($type == 'logout'){	
	if($_GET['u'] == 1){
		unset($_SESSION['admin']);
	}else if($_GET['u'] == 2){
		unset($_SESSION['user']);
	}
	header("location:".SITE_URL);
}

else if($type == "set-password"){
	sleep(1);
	$call = USER::setPassword($_POST);	
	if($call['status'] == 'error'){
		$show = array("msg" => 'error', 'notice'=>$call['msg']);  	
	}else{
		$updateAuthUser = AUTH::updateUser($_POST, $call['result']['auth_id']);	  
		$show = array("msg" => 'success', 'notice'=>$call['msg'], 'href'=>SITE_URL.'?username='.$_POST['username']);
	}	
	echo json_encode($show);  
}

else if($type == "invitation-link"){			  
	$call = USER::invitationLink($_REQUEST['id']);	
	if($call['status'] == 'error'){
		$show = array("msg" => 'error', 'notice'=>$call['msg']);
		FD_add_notices($call['msg'], 'error');
		header('Location:'.SITE_URL);  	
	}else{
		$_SESSION['user'] = $call;
		header('Location:'.USER_URL);
		FD_add_notices($call['msg'], 'success');	
	}
}

else if($type == "add-user"){	
	sleep(1);	  
	$call = ADMIN::addUser($_POST, $_SESSION['admin']['result']['id']);		
	if($call['status'] == 'error'){
		$show = array("msg" => 'error', 'notice'=>$call['msg']);  	
	}else{
		if($call['result']['account_status'] == 'create'){
			$setAuthUser = AUTH::createUser($call['result'], $call['result']['id']);			
			$setMiroUser = BOARD::createScimUser($call['result']);
			$updateUser = ADMIN::updateUser($call['result']['id'], $setAuthUser['result'], $setMiroUser['result']);
			$emailSent = MAIL::userCreateEmail($call['result']);
		}else{
			$emailSent = MAIL::userInviteBoardEmail($call['result']);
		}
		$show = array("msg" => 'success', 'notice'=>$call['msg'], 'href'=>ADMIN_URL.'user/view');
	}	
	echo json_encode($show);  
}

else if($type == "get_users"){		  
	$call = ADMIN::fetchUsers($_SESSION['admin']['result']['id'], 'table');	
	if($call['status'] == 'error'){
		$show = array("msg" => 'error', 'notice'=>$call['msg']);  	
	}else{
		$show = array("msg" => 'success', 'notice'=>$call['msg'], 'result'=>$call['result']);
	}	
	echo json_encode($show);  
}

else if($type == "get-user-boards"){		  
	$call = USER::fetchBoardsByUser($_SESSION['user']['result']['id']);	
	if($call['status'] == 'error'){
		$show = array("msg" => 'error', 'notice'=>$call['msg']);  	
	}else{
		$show = array("msg" => 'success', 'notice'=>$call['msg'], 'result'=>$call['result']);
	}	
	echo json_encode($show);  
}

else if($type =='add_statement'){
	//pr($_POST);die;
	$call = BOARD::updateCardItem($_POST);	
	if($call['status'] == 'error'){
		$show = array("msg" => 'error', 'notice'=>$call['msg']);	  	
	}else{
		$show = array("msg" => 'success', 'notice'=>$call['msg'], 'result'=>$call['result']);
	}	
	echo json_encode($show);  
}

else if($type =='get_statement'){
	//pr($_POST);die;
	$call = BOARD::getCardItem($_POST);	
	if($call['status'] == 'error'){
		$show = array("msg" => 'error', 'notice'=>$call['msg']);	  	
	}else{
		$show = array("msg" => 'success', 'notice'=>$call['msg'], 'result'=>$call['result']);
	}	
	echo json_encode($show);  
}


else if($type =='send_invitation'){
	//pr($_POST);die;
	$call = BOARD::inviteAsGuest($_POST);	
	if($call['status'] == 'error'){
		$show = array("msg" => 'error', 'notice'=>$call['msg']);	  	
	}else{
		$show = array("msg" => 'success', 'notice'=>$call['msg'], 'result'=>$call['result']);
	}	
	echo json_encode($show);  
}
?>