<?php  require_once("config.php");
use Rakit\Validation\Validator;
class ADMIN extends dbconfig {

   public static $data;

   function __construct() {
     parent::__construct();
   }  


   public static function checkUsernameExist($username){      
	try {     
	   $query = "SELECT id FROM users WHERE username = '".$username."'"; 
	   $result = dbconfig::run($query);
	   if(!$result) {
		throw new exception("Oops! Something went wrong. <a href='".HELPER_URL.base64_encode('error_support')."'>Send error report to support</a>");
	   }
	   $count = mysqli_num_rows($result);
		   if($count > 0){
			 throw new exception("Username is already taken. Please click add button again .");
		   } 
		   $data = array('status'=>'success', 'msg'=>"", 'result'=>'');
	   } catch (Exception $e) {
		   $data = array('status'=>'error', 'msg'=>$e->getMessage());
	   } finally {
		   return $data;
	   }		
	}

	public static function checkInvite($email, $userId){      
		try {     
		   $query = "SELECT b.invited_user_id FROM users u INNER JOIN boards b ON(u.id = b.user_id AND b.invited_user_id = '".$userId."') WHERE u.email = '".$email."' AND u.user_type = 2"; 
		   $result = dbconfig::run($query);
		   if(!$result) {
			throw new exception("Oops! Something went wrong. <a href='".HELPER_URL.base64_encode('error_support')."'>Send error report to support</a>");
		   }
		   $count = mysqli_num_rows($result);
			if($count > 0){
				throw new exception("Invitation already sent to this email");
			}			
			$data = array('status'=>'success', 'msg'=>"Send invite", 'result'=>'');
		} catch (Exception $e) {
			$data = array('status'=>'error', 'msg'=>$e->getMessage());
		} finally {
			return $data;
		}		
	}

	public static function checkEmailExist($email){      
		try {     
		   $query = "SELECT id FROM users WHERE email = '".$email."' AND user_type = 2"; 
		   $result = dbconfig::run($query);
		   if(!$result) {
			throw new exception("Oops! Something went wrong. <a href='".HELPER_URL.base64_encode('error_support')."'>Send error report to support</a>");
		   }
		   $count = mysqli_num_rows($result);
			if($count > 0){
				$row =  mysqli_fetch_assoc($result);
				throw new exception($row['id']);
			}			
			$data = array('status'=>'success', 'msg'=>"create new account", 'result'=>'');
		} catch (Exception $e) {
			$data = array('status'=>'error', 'msg'=>$e->getMessage());
		} finally {
			return $data;
		}		
	}

	public static function fetchUsers($id) {  
		try {
			$resultSet = array();    
			$query =  "SELECT u.name, u.email, u.created_at FROM `users` u INNER JOIN boards b ON(u.id = b.user_id AND invited_user_id = '".$id."') WHERE u.user_type = 2 ORDER BY u.id DESC";
	    $result = dbconfig::run($query);
			if(!$result) {
				throw new exception("Oops! Something went wrong. <a href='".HELPER_URL.base64_encode('error_support')."'>Send error report to support</a>"); 
			}
			if(mysqli_num_rows($result) > 0) {	        	
			    while($row =  mysqli_fetch_assoc($result)) {
						$resultSet[] = array(ucwords($row['name']), $row['email'], $row['created_at']);
			    }			   			  
			}	
			$data = array('status'=>'success', 'msg'=>"Fetch users successfully", 'result'=>$resultSet);			
		} catch (Exception $e) {
			$data = array('status'=>'error', 'msg'=>$e->getMessage());
		} finally {
			return $data;
		}
	}

	public static function fetchBoards($userId) {  
		try {
			$resultSet = array();    
			$query =  "SELECT u.name, u.board_id, u.card_id FROM `boards` b INNER JOIN users u ON(u.id = b.user_id) WHERE b.invited_user_id = '".$userId."' ORDER BY b.id DESC";
	    $result = dbconfig::run($query);
			if(!$result) {
				throw new exception("Oops! Something went wrong. <a href='".HELPER_URL.base64_encode('error_support')."'>Send error report to support</a>"); 
			}
			if(mysqli_num_rows($result) > 0) {	        	
			    while($row =  mysqli_fetch_assoc($result)) {
						$resultSet[] = $row;
			    }			   			  
			}	
			$data = array('status'=>'success', 'msg'=>"Fetch Boards successfully", 'result'=>$resultSet);			
		} catch (Exception $e) {
			$data = array('status'=>'error', 'msg'=>$e->getMessage());
		} finally {
			return $data;
		}
	}

	public static function addUser($req, $userId) {  
		try {	
			$resultSet = array();				
			$validator = new Validator;
			$validation = $validator->validate($req,[			    
			  'first_name'  	=> 'required',
				'last_name'  		=> 'required',
			  'email'     		=> 'required|email',				
				'board_id'    	=> 'required',
    		'card_id'       => 'required'
			]);
			if ($validation->fails()) { 	// handling errors
				$messages = $validation->errors()->firstOfAll();
				throw new exception( json_encode($messages));
			}

			$checkInvite = self::checkInvite($req['email'], $userId);
			if($checkInvite['status'] == 'error') {
				throw new exception($checkInvite['msg']);
			}

			$checkEmail = self::checkEmailExist($req['email']);
			if($checkEmail['status'] == 'success') { // create new account
				$username = $req['username'];

				$check = self::checkUsernameExist($username);
				if($check['status'] == 'error') {
				  throw new exception($check['msg']);
				}
	
				foreach ($req as $key => $value) {
					$req[$key] = mysqli_real_escape_string(self::$con, $value);
				}

				$password = random_gen(10);
	
				$req['created_at'] = date('Y-m-d h:iA');
				$req['updated_at'] = date('Y-m-d h:iA');
				
				$query = "INSERT INTO `users` (name, username, email, password, raw_password, board_id, card_id, user_type, created_at, updated_at) VALUES ('".$req['first_name']." ".$req['last_name']."', '".$username."', '".$req['email']."', '".md5($password)."', '".$password."', '".$req['board_id']."', '".$req['card_id']."', 2, '".$req['created_at']."', '".$req['updated_at']."')";
				$lastId = dbconfig::insertrun($query);
				if(!$lastId) {
					throw new exception("Oops! Something went wrong. <a href='".HELPER_URL.base64_encode('error_support')."'>Send error report to support</a>"); 
				}
				$query = "INSERT INTO `boards` (user_id, invited_user_id) VALUES ('".$lastId."', '".$userId."')";
				$result = dbconfig::run($query);
				if(!$result) {
					throw new exception("Oops! Something went wrong. <a href='".HELPER_URL.base64_encode('error_support')."'>Send error report to support</a>"); 
				}
				$resultSet['id'] = $lastId;
				$resultSet['username'] = $username;
				$resultSet['email'] = $req['email'];
				$resultSet['account_status'] = 'create';
				$resultSet['name'] = $req['first_name']." ".$req['last_name'];
				$resultSet['password'] = $password;
			}else{ // already an account				
				$query = "INSERT INTO `boards` (user_id, invited_user_id) VALUES ('".$checkEmail['msg']."', '".$userId."')";
				$result = dbconfig::run($query);
				if(!$result) {
					throw new exception("Oops! Something went wrong. <a href='".HELPER_URL.base64_encode('error_support')."'>Send error report to support</a>"); 
				}
				$resultSet['id'] = $checkEmail['msg'];
				$resultSet['email'] = $req['email'];
				$resultSet['account_status'] = 'update';
			}
			$data = array('status'=>'success', 'msg'=>"User invitation sent successfully", 'result'=>$resultSet);				
		} catch (Exception $e) {
			$data = array('status'=>'error', 'msg'=>$e->getMessage());
		} finally {
			return $data;
		}
	}

	public static function updateUser($userId, $authId, $scimId) {  
		try {				
			$updated_at = date('Y-m-d h:iA');				
			$query = "UPDATE users SET auth_id = '".$authId."', scim_id = '".$scimId."', updated_at = '".$updated_at."' WHERE id = '".$userId."'"; 
		  $result = dbconfig::run($query);
		  if(!$result) {
			 throw new exception("Oops! Something went wrong. <a href='".HELPER_URL.base64_encode('error_support')."'>Send error report to support</a>");
		  }		
			$data = array('status'=>'success', 'msg'=>"User invitation sent successfully", 'result'=>'');				
		} catch (Exception $e) {
			$data = array('status'=>'error', 'msg'=>$e->getMessage());
		} finally {
			return $data;
		}
	}

	public static function userAnalysis(){
		try {	
			$resultSet = array();			
			$query = "SELECT COUNT(id) total_user FROM users WHERE user_type = 2";
			$result = dbconfig::run($query);	
			if(!$result) {
			 	throw new exception("Oops! Something went wrong. <a href='".HELPER_URL.base64_encode('error_support')."'>Send error report to support</a>");
			}
			if(mysqli_num_rows($result) > 0) {	        	
			   $row =  mysqli_fetch_assoc($result);
			   $resultSet['user'] = $row['total_user'];
			}
			$query = "SELECT COUNT(id) total_entry FROM user_entries";
			$result = dbconfig::run($query);	
			if(!$result) {
			 	throw new exception("Oops! Something went wrong. <a href='".HELPER_URL.base64_encode('error_support')."'>Send error report to support</a>");
			} 
			if(mysqli_num_rows($result) > 0) {	        	
				$row =  mysqli_fetch_assoc($result);
				$resultSet['entry'] = $row['total_entry'];
			 }				
			$data = array('status'=>'success', 'msg'=>"User analysis successfully.", 'result'=>$resultSet);
		}catch(Exception $e) {
			$data = array('status'=>'error', 'msg'=>$e->getMessage());
		}finally{
			return $data;
		}
	}

}
