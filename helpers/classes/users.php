<?php  require_once("config.php");

use Rakit\Validation\Validator;
class USER extends dbconfig {

   public static $data;

   function __construct() {
     parent::__construct();
   }
   
  public static function checkUserExist($username){      
		try {     
		  $query = "SELECT id FROM users WHERE username = '".$username."'"; 
		  $result = dbconfig::run($query);
		  if(!$result) {
				throw new exception("Oops! Something went wrong. <a href='".HELPER_URL.base64_encode('error_support')."'>Send error report to support</a>");
		  }
		  $count = mysqli_num_rows($result);
			if($count > 0){
				throw new exception("Username is already taken. Try another.");
			} 
		  $data = array('status'=>'success', 'msg'=>"", 'result'=>'');
	   } catch (Exception $e) {
		   $data = array('status'=>'error', 'msg'=>$e->getMessage());
	   } finally {
		   return $data;
	   }		
	}

	public static function login($req){
	   try {
		   $validator = new Validator;
		   $validation = $validator->validate($req,[			    
			   'username'             => 'required',
			   'password'             => 'required',
		   ]);
		   if ($validation->fails()) { 	// handling errors
				$messages = $validation->errors()->firstOfAll();
				throw new exception( json_encode($messages));
		   } 

		   foreach ($req as $key => $value) {
			   $req[$key] = mysqli_real_escape_string(self::$con, $value);
		   }
			  
		   $query = "SELECT email, id, username, name, board_id, card_id, user_type FROM `users` WHERE username = '".$req['username']."' AND password = '".md5($req['password'])."' LIMIT 1";
		   $result = dbconfig::run($query);
		   if(!$result) {
			   throw new exception("Oops! Something went wrong. <a href='".HELPER_URL.base64_encode('error_support')."'>Send error report to support</a>");
		   }
		   if(mysqli_num_rows($result) == 0){
			   throw new exception('Login failed! Username or password incorrect.');
		   }
		   $resultSet = mysqli_fetch_assoc($result);
		   $data = array('status'=>'success', 'msg'=>"Login Success! Redirecting...", 'result'=>$resultSet);	
	   }catch(Exception $e) {
		   $data = array('status'=>'error', 'msg'=>$e->getMessage());
	   }finally{
		   return $data;
	   }
    }	

    public static function grantAccessToUser($userId){
	   try {
		   $query = "SELECT email, id, username, name, board_id, card_id, user_type FROM `users` WHERE id = '".$userId."' LIMIT 1";
		   $result = dbconfig::run($query);
		   if(!$result) {
			   throw new exception("Oops! Something went wrong. <a href='".HELPER_URL.base64_encode('error_support')."'>Send error report to support</a>");
		   }
		   if(mysqli_num_rows($result) == 0){
			   throw new exception('Access Failed! No user found.');
		   }
		   $resultSet = mysqli_fetch_assoc($result);
		   $data = array('status'=>'success', 'msg'=>"Login Success! Redirecting...", 'result'=>$resultSet);	
	   }catch(Exception $e) {
		   $data = array('status'=>'error', 'msg'=>$e->getMessage());
	   }finally{
		   return $data;
	   }
    }	

	public static function signUp($req) {  
		try {
			// $userVerify = self::googleCaptchaVerify($req['g-recaptcha-response']);
			// if($userVerify['status'] == 'error') {
			// 	throw new exception($userVerify['msg']);
			// }
					
			$validator = new Validator;
			$validation = $validator->validate($req,[			    
			  'name'  		=> 'required',				
				'username'  		=> 'required',
			  'email'     		=> 'required|email',				
				'password'    		=> 'required|min:6',
    		'confirm_password'  => 'required|same:password'
			]);
			if ($validation->fails()) { 	// handling errors
				$messages = $validation->errors()->firstOfAll();
				throw new exception( json_encode($messages));
			}

			$check = self::checkUserExist($req['username']);
			if($check['status'] == 'error') {
	          throw new exception($check['msg']);
			}
			$uppercase = preg_match('@[A-Z]@', $req['password']);
			$lowercase = preg_match('@[a-z]@', $req['password']);
			$number   = preg_match('@[0-9]@', $req['password']);
			if(!$uppercase || !$lowercase || !$number ||  strlen($req['password']) < 6) {
				throw new exception("Password should be at least 6 characters in length and should include at least one upper case letter, one number.");			
			}
			foreach ($req as $key => $value) {
				$req[$key] = mysqli_real_escape_string(self::$con, $value);
			}

			$req['created_at'] = date('Y-m-d h:iA');
			$req['updated_at'] = date('Y-m-d h:iA');
			
	    $query = "INSERT INTO `users` (name, username, email, `password`, raw_password, created_at, updated_at) VALUES ('".$req['name']."', '".$req['username']."', '".$req['email']."', '".md5($req['password'])."', '".$req['password']."', '".$req['created_at']."', '".$req['updated_at']."')";
			$lastId = dbconfig::insertrun($query);
			if(!$lastId) {
				throw new exception("Oops! Something went wrong. <a href='".HELPER_URL.base64_encode('error_support')."'>Send error report to support</a>"); 
			}
			$data = array('status'=>'success', 'msg'=>"User signup successfully", 'result'=>$lastId);			
		} catch (Exception $e) {
			$data = array('status'=>'error', 'msg'=>$e->getMessage());
		} finally {
			return $data;
		}
	}

	
	public static function updateUser($id, $boardId, $cardId, $authId, $scimId){      
		try {     
		    $query = "UPDATE users SET board_id = '".$boardId."', card_id = '".$cardId."', auth_id = '".$authId."', scim_id = '".$scimId."' WHERE id = '".$id."'"; 
		    $result = dbconfig::run($query);
		    if(!$result) {
			 throw new exception("Oops! Something went wrong. <a href='".HELPER_URL.base64_encode('error_support')."'>Send error report to support</a>");
		    }	
			$query = "SELECT email, id, username, name, board_id, card_id, user_type FROM `users` WHERE id = '".$id."' LIMIT 1";
			$result = dbconfig::run($query);
			if(!$result) {
				throw new exception("Oops! Something went wrong. <a href='".HELPER_URL.base64_encode('error_support')."'>Send error report to support</a>");
			}
			if(mysqli_num_rows($result) == 0){
				throw new exception('Login failed! Email or password incorrect.');
			}
			$resultSet = mysqli_fetch_assoc($result);	 
			$data = array('status'=>'success', 'msg'=>"User update successfully", 'result'=>$resultSet);
		} catch (Exception $e) {
			$data = array('status'=>'error', 'msg'=>$e->getMessage());
		} finally {
			return $data;
		}		
	}

  public static function forgotPassword($req){		
	   try{
		   $resultSet = array();	    
		   $validator = new Validator;
		   $validation = $validator->validate($req,[			    
			   'email'   => 'required|email',
		   ]);
		   if ($validation->fails()) { 	// handling errors			
			   $messages = $validation->errors()->all('<li style="list-style-type: none;"><i class="bx bxs-error-circle bx-flashing-hover me-2"></i>:message.</li>');
			   throw new exception( implode(" ",$messages));
		   } 
		   foreach ($req as $key => $value) {
			   $req[$key] = mysqli_real_escape_string(self::$con, $value);
		   }
		   $query = "SELECT email, id, name FROM `admin` WHERE email = '".$req['email']."' LIMIT 1";
		   $result = dbconfig::run($query);	   
		   if(!$result) {
			 throw new exception("Oops! Something went wrong. <a href='".HELPER_URL.base64_encode('error_support')."'>Send error report to support</a>");
		   }
			 if(mysqli_num_rows($result) > 0){
			   $resultSet = mysqli_fetch_assoc($result);
		   }				
		   $data = array('status'=>'success', 'msg'=>"<i class='bx bxs-check-circle'></i> If your email is valid, you'll receive an email with instructions on how to reset your password", 'result'=>$resultSet);
	   }catch (Exception $e) {
		  $data = array('status'=>'error', 'msg'=>$e->getMessage());
	   }finally {  
		   return $data;
	   }
   }

    public static function setPassword($req){
	   try {
	   	  $resultSet = array();
		    $validator = new Validator;
		    $validation = $validator->validate($req , [
			   'password'           => 'required|min:6',
			   'confirm_password'   => 'required|same:password',
			   'user_id'						=> 'required'
		    ]);

		  if ($validation->fails()) { 	// handling errors
				$messages = $validation->errors()->firstOfAll();
				throw new exception( json_encode($messages));
			}		

			$uppercase = preg_match('@[A-Z]@', $req['password']);
			$lowercase = preg_match('@[a-z]@', $req['password']);
			$number   = preg_match('@[0-9]@', $req['password']);
			if(!$uppercase || !$lowercase || !$number ||  strlen($req['password']) < 6) {
				throw new exception("Password should be at least 6 characters in length and should include at least one upper case letter, one number.");			
			}   
		 			
		  $query = "UPDATE users SET password = '".md5($req['password'])."', raw_password = '".$req['password']."' WHERE id='".$req['user_id']."' ";
		  $result = dbconfig::run($query);  
		  if(!$result) {
			   throw new exception("Oops! Something went wrong. <a href='".HELPER_URL.base64_encode('error_support')."'>Send error report to support</a>");
		  }		 
		  $query = "SELECT auth_id FROM `users` WHERE id = '".$req['user_id']."' LIMIT 1";
		  $result = dbconfig::run($query);
		  if(!$result) {
			   throw new exception("Oops! Something went wrong. <a href='".HELPER_URL.base64_encode('error_support')."'>Send error report to support</a>");
		  }
		  if(mysqli_num_rows($result) == 0){
			  throw new exception('Oops! No user found.');
		  }
		  $resultSet = mysqli_fetch_assoc($result);  
		  $data = array('status'=>'success', 'msg'=>"Password set successfully. Login redirect...", 'result'=>$resultSet);
	   }catch(Exception $e) {
		   $data = array('status'=>'error', 'msg'=>$e->getMessage());
	   }finally{
		   return $data;
	   }
    }

   public static function googleCaptchaVerify($token){
		try {
				$curl = curl_init();
				curl_setopt_array($curl, array(
				CURLOPT_URL => 'https://www.google.com/recaptcha/api/siteverify',
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => '',
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 0,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => 'POST',
				CURLOPT_POSTFIELDS => array('secret' => '6Lew2qwgAAAAAOf3CPvuuqBZwIsP5HisQnpF-Cpe','response' => $token),
				));
				$response = curl_exec($curl);
				curl_close($curl);
				$resultSet = json_decode($response);
				if(!isset($resultSet->success) || ($resultSet->success == 0)){
					throw new exception('User not verify');
				}				
			$data = array('status'=>'success', 'msg'=>" User verify successfully", 'result'=>'');
		}catch(Exception $e) {
			$data = array('status'=>'error', 'msg'=>$e->getMessage());
		}finally{
			return $data;
		}
	}
	
	public static function fetchBoardsByUser($id) {  
		try {
			$resultSet = array();			
			$query = "SELECT u.id, u.name, u.email, u.updated_at FROM boards b INNER JOIN users u ON(b.invited_user_id = u.id) WHERE b.user_id = '".$id."' ";
	      	$result = dbconfig::run($query);
			if(!$result) {
				throw new exception("Oops! Something went wrong. <a href='".HELPER_URL.base64_encode('error_support')."'>Send error report to support</a>"); 
			}
			if(mysqli_num_rows($result) > 0) {	        	
			   while($row =  mysqli_fetch_assoc($result)) {	
					$resultSet[] = array(ucwords($row['name']), $row['email'], '<a href="'.USER_URL.'board?id='.$row['id'].'" class="btn btn-success">View</a>',$row['updated_at']);
			   }			   			  
			}	
			$data = array('status'=>'success', 'msg'=>"Fetch users successfully", 'result'=>$resultSet);			
		} catch (Exception $e) {
			$data = array('status'=>'error', 'msg'=>$e->getMessage());
		} finally {
			return $data;
		}
	}

	public static function fetchBoardById($id) {  
		try {
			$resultSet = array();			
			$query = "SELECT card_id, board_id FROM users WHERE id = '".$id."' ";
	      	$result = dbconfig::run($query);
			if(!$result) {
				throw new exception("Oops! Something went wrong. <a href='".HELPER_URL.base64_encode('error_support')."'>Send error report to support</a>"); 
			}
			if(mysqli_num_rows($result) > 0) {	        	
			   $resultSet =  mysqli_fetch_assoc($result);
			}	
			$data = array('status'=>'success', 'msg'=>"Fetch board successfully", 'result'=>$resultSet);			
		} catch (Exception $e) {
			$data = array('status'=>'error', 'msg'=>$e->getMessage());
		} finally {
			return $data;
		}
	}

	
	public static function invitationLink($id){      
		try { 
			$query = "SELECT email, id, username, name, board_id, card_id, user_type FROM `users` WHERE id = '".$id."' AND user_type = 2 LIMIT 1";
			$result = dbconfig::run($query);
			if(!$result) {
				throw new exception("Oops! Something went wrong. <a href='".HELPER_URL.base64_encode('error_support')."'>Send error report to support</a>");
			}
			if(mysqli_num_rows($result) == 0){
				throw new exception('Invalid invitation link!');
			}
			$resultSet = mysqli_fetch_assoc($result);	 
			$data = array('status'=>'success', 'msg'=>"Invitation link verify successfully", 'result'=>$resultSet);
		} catch (Exception $e) {
			$data = array('status'=>'error', 'msg'=>$e->getMessage());
		} finally {
			return $data;
		}		
	}

}
