<?php require_once("config.php");

use Auth0\SDK\Auth0;
use Auth0\SDK\Configuration\SdkConfiguration;

class AUTH extends dbconfig { 
   public static $data;
   protected static $CLIENT_ID = "t30BB8ZQheXk3rR7wImJIsBblLvFGtXM";
   protected static $CLIENT_SECRET = "wUp-p4xqFpW_4xmaGd_73ESWq69c3LPQ3JFbPO7TrfkEZZe960E28B7iOBAP6RnZ";
   protected static $AUDIENCE = "https://dev-b898rwcc.us.auth0.com/api/v2/";

   function __construct() {
     parent::__construct();
   }
   
    public static function getAccessToken(){      
			try {   
						$resultSet = array();  
			 			$curl = curl_init();
			 			$body = array("grant_type"=>"client_credentials", "client_id"=>self::$CLIENT_ID,"client_secret"=>self::$CLIENT_SECRET, "audience"=>self::$AUDIENCE);
			 			$jsonBody = json_encode($body);
						curl_setopt_array($curl, [
						  CURLOPT_URL => "https://dev-b898rwcc.us.auth0.com/oauth/token",
						  CURLOPT_RETURNTRANSFER => true,
						  CURLOPT_ENCODING => "",
						  CURLOPT_MAXREDIRS => 10,
						  CURLOPT_TIMEOUT => 30,
						  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
						  CURLOPT_CUSTOMREQUEST => "POST",
						  CURLOPT_POSTFIELDS => $jsonBody,
						  CURLOPT_HTTPHEADER => [
						    "content-type: application/json"
						  ],
						]);

						$response = curl_exec($curl);
						$err = curl_error($curl);

						curl_close($curl);
						if ($err) {						  
						  throw new exception("cURL Error #:" . $err);
						} 
						$resultSet = json_decode($response, true);						
				   $data = array('status'=>'success', 'msg'=>"", 'result'=>$resultSet);
			   } catch (Exception $e) {
				   $data = array('status'=>'error', 'msg'=>$e->getMessage());
			   } finally {
				   return $data;
			   }		
		}

		public static function createUser($req, $userId){      
			try {  
					$resultSet = array();  
					$accessToken = self::getAccessToken();
					if($accessToken['status'] == 'error'){
						throw new exception($accessToken['msg']);
					}
				
		 			$curl = curl_init();
		 			$expName = explode(' ', $req['name']);
		 			$body = array("email"=>$req['username'].'@'.DOMAIN_NAME, "name"=>$req['name'], "given_name"=>$expName[0],"family_name"=>$expName[1], "password"=> $req['password'], "connection"=>"Username-Password-Authentication", "user_metadata"=>array('user_account_id'=>$userId));
		 			$jsonBody = json_encode($body);
					curl_setopt_array($curl, [
					  CURLOPT_URL => self::$AUDIENCE."users",
					  CURLOPT_RETURNTRANSFER => true,
					  CURLOPT_ENCODING => "",
					  CURLOPT_MAXREDIRS => 10,
					  CURLOPT_TIMEOUT => 30,
					  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					  CURLOPT_CUSTOMREQUEST => "POST",
					  CURLOPT_POSTFIELDS => $jsonBody,
					  CURLOPT_HTTPHEADER => [
					    "content-type: application/json",
					    "authorization: Bearer ".$accessToken['result']['access_token']
					  ],
					]);

					$response = curl_exec($curl);	

					$err = curl_error($curl);
					curl_close($curl);
					if ($err) {	
					  throw new exception("cURL Error #:" . $err);
					}
					$resultSet = json_decode($response, true);	

			  	$data = array('status'=>'success', 'msg'=>"", 'result'=>$resultSet['user_id']);
		   } catch (Exception $e) {
			   $data = array('status'=>'error', 'msg'=>$e->getMessage());
		   } finally {
			   return $data;
		   }		
		}

		public static function updateUser($req, $userId){      
			try {  
					$resultSet = array();  
					$accessToken = self::getAccessToken();
					if($accessToken['status'] == 'error'){
						throw new exception($accessToken['msg']);
					}
				
		 			$curl = curl_init();
		 			
		 			$body = array("password"=> $req['password'], "connection"=>"Username-Password-Authentication");
		 			$jsonBody = json_encode($body);
					curl_setopt_array($curl, [
					  CURLOPT_URL => self::$AUDIENCE."users/".$userId,
					  CURLOPT_RETURNTRANSFER => true,
					  CURLOPT_ENCODING => "",
					  CURLOPT_MAXREDIRS => 10,
					  CURLOPT_TIMEOUT => 30,
					  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					  CURLOPT_CUSTOMREQUEST => "PATCH",
					  CURLOPT_POSTFIELDS => $jsonBody,
					  CURLOPT_HTTPHEADER => [
					    "content-type: application/json",
					    "authorization: Bearer ".$accessToken['result']['access_token']
					  ],
					]);

					$response = curl_exec($curl);						
					$err = curl_error($curl);
					curl_close($curl);
					if ($err) {	
					  throw new exception("cURL Error #:" . $err);
					}
			  	$data = array('status'=>'success', 'msg'=>"", 'result'=>'');
		   } catch (Exception $e) {
			   $data = array('status'=>'error', 'msg'=>$e->getMessage());
		   } finally {
			   return $data;
		   }		
		}

		public static function getUser($userId){      
			try {    
						$resultSet = array();    
						$accessToken = self::getAccessToken();
						if($accessToken['status'] == 'error'){
							throw new exception($accessToken['msg']);
						}
					
			 			$curl = curl_init();
						curl_setopt_array($curl, [
						  CURLOPT_URL => self::$AUDIENCE."users/".$userId,
						  CURLOPT_RETURNTRANSFER => true,
						  CURLOPT_ENCODING => "",
						  CURLOPT_MAXREDIRS => 10,
						  CURLOPT_TIMEOUT => 30,
						  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
						  CURLOPT_CUSTOMREQUEST => "GET",
						  CURLOPT_HTTPHEADER => [
						    "content-type: application/json",
						    "authorization: Bearer ".$accessToken['result']['access_token']
						  ],
						]);

						$response = curl_exec($curl);
						$err = curl_error($curl);
						curl_close($curl);
						if ($err) {	
						  throw new exception("cURL Error #:" . $err);
						}
						$resultSet = json_decode($response, true);	
				  	$data = array('status'=>'success', 'msg'=>"", 'result'=>$resultSet);
			   } catch (Exception $e) {
				   $data = array('status'=>'error', 'msg'=>$e->getMessage());
			   } finally {
				   return $data;
			   }		
		}
  
		public static function redirectToLogin(){      
			try {    
						$configuration = new SdkConfiguration(
						  domain: 'dev-b898rwcc.us.auth0.com',
						  clientId: 'SH1zm0MK15kLFd9YLnm5EGTAmsWulxft',
						  clientSecret: 'AhKiHHZyG9JaoYNYom5ZVrq6YNQOO3OgKhBHa-Qb1J5Zs2IXW3VCASvxfXpnn5Hh',
						  redirectUri: 'http://miro.stageservices.xyz/helpers/functions.php?type=callback&', 
						  cookieSecret: '4f60eb5de6b5904ad4b8e31d9193e7ea4a3013b476ddb5c259ee9077c05e1457'
						);

						$sdk = new Auth0($configuration);
				  	$data = array('status'=>'success', 'msg'=>"", 'result'=>$sdk->login());
			   } catch (Exception $e) {
				   $data = array('status'=>'error', 'msg'=>$e->getMessage());
			   } finally {
				   return $data;
			   }		
		}

		public static function callback(){      
			try {    
						$configuration = new SdkConfiguration(
					    domain: 'dev-b898rwcc.us.auth0.com',
					    clientId: 'SH1zm0MK15kLFd9YLnm5EGTAmsWulxft',
					    clientSecret: 'AhKiHHZyG9JaoYNYom5ZVrq6YNQOO3OgKhBHa-Qb1J5Zs2IXW3VCASvxfXpnn5Hh',
					    redirectUri: 'http://miro.stageservices.xyz/helpers/functions.php?type=callback&',
					    cookieSecret: '4f60eb5de6b5904ad4b8e31d9193e7ea4a3013b476ddb5c259ee9077c05e1457'
					  );

					  $sdk = new Auth0($configuration);

					  $hasAuthenticated = isset($_GET['state']) && isset($_GET['code']);
					  $hasAuthenticationFailure = isset($_GET['error']);

					  // The end user will be returned with ?state and ?code values in their request, when successful.
					  if (!$hasAuthenticated) {
					  		throw new exception("Oops! Something went wrong. <a href='".HELPER_URL.base64_encode('error_support')."'>'Unable to complete authentication: %s' Error</a>");
					  } 
				
					  if ($hasAuthenticationFailure) {
					  	throw new exception("Oops! Something went wrong. <a href='".HELPER_URL.base64_encode('error_support')."'>Authentication failure: Error</a>");
					  }
					  $sdk->exchange();
				  	$data = array('status'=>'success', 'msg'=>"", 'result'=>$sdk->login());
			  } catch (Exception $e) {
				   $data = array('status'=>'error', 'msg'=>$e->getMessage());
			  } finally {
				   return $data;
			  }		
		}		

		public static function getAuthUser(){      
			try {    
						 $configuration = new SdkConfiguration(
						    domain: 'dev-b898rwcc.us.auth0.com',
						    clientId: 'SH1zm0MK15kLFd9YLnm5EGTAmsWulxft',
						    clientSecret: 'AhKiHHZyG9JaoYNYom5ZVrq6YNQOO3OgKhBHa-Qb1J5Zs2IXW3VCASvxfXpnn5Hh',
						    redirectUri: 'http://miro.stageservices.xyz/helpers/functions.php?type=callback&',
						    cookieSecret: '4f60eb5de6b5904ad4b8e31d9193e7ea4a3013b476ddb5c259ee9077c05e1457'
						  );
						  $sdk = new Auth0($configuration);
						  $authUser = $sdk->getCredentials();
						  if(empty($authUser)){
						  	throw new exception("Oops! Something went wrong. <a href='".HELPER_URL.base64_encode('error_support')."'>Authentication failure: Error</a>");
						  }

						$getUser = self::getUser($authUser->user['sub']);
						if($getUser['status'] == 'error'){
							throw new exception($getUser['msg']);
						}

				  	$data = array('status'=>'success', 'msg'=>"", 'result'=>$getUser['result']);
			   } catch (Exception $e) {
				   $data = array('status'=>'error', 'msg'=>$e->getMessage());
			   } finally {
				   return $data;
			   }		
		}



}
