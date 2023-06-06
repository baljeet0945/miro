<?php require_once("config.php");

class BOARD extends dbconfig{  
	protected static $ACCESS_TOKEN = "eyJtaXJvLm9yaWdpbiI6ImV1MDEifQ__y6ere1YKLCgLTNnf2_DkRQjLPU"; 
	protected static $SCIM_TOKEN = "L7b6Q4uxf89cGJNupvv9C4j8eefzUV18YZDK9zRrWW10gra4oYn9NCTLBPrLTAx0"; 
	// onstrategy

    public static $data;

    function __construct() {
     	 parent::__construct();
    } 

	public static function createTeam($fullname){  
		try {  
			$resultSet = array();
		    $client = new \GuzzleHttp\Client();

		    $response = $client->request('POST', 'https://api.miro.com/v2/orgs/3458764526351866627/teams', [
				'body' => '{"name":"'.$fullname.' Team"}',
				'headers' => [
					'Accept' => 'application/json',					
					'Content-Type' => 'application/json',
					'Authorization' => 'Bearer '.self::$ACCESS_TOKEN
				],
			]);		  

		   $resultSet =  json_decode($response->getBody(), true);		
		   //pr($resultSet );	die;	
		   $data = array('status'=>'success', 'msg'=>"Team created successfully.", 'result'=>$resultSet);	
	   } catch (Exception $e) {
		   $data = array('status'=>'error', 'msg'=>$e->getMessage());
	   } finally {
		   return $data;
	   }  
   }

    public static function createBoard($boardName){  
     	try {  
     		$resultSet = array();
			$client = new \GuzzleHttp\Client();

			$response = $client->request('POST', 'https://api.miro.com/v2/boards', [
				'body' => '{"name":"'.$boardName.'","policy":{"permissionsPolicy":{"collaborationToolsStartAccess":"all_editors","copyAccess":"board_owner","sharingAccess":"owner_and_coowners"},"sharingPolicy":{"access":"private","inviteToAccountAndBoardLinkAccess":"no_access","organizationAccess":"private","teamAccess":"edit"}}}',  
			  
			  'headers' => [
			    'Accept' => 'application/json',
			    'Content-Type' => 'application/json',
			    'Authorization' => 'Bearer '.self::$ACCESS_TOKEN
			  ],
			]);

			$board =  json_decode($response->getBody(), true);	
			//pr($board);

			$card = self::createCardItem($board['id']);	
				//pr($card);
			if($card['status'] == 'error'){
				throw new exception("card not created");
			}
			$tag = self::createTag($board['id'], $card['result']['id']);
			//pr($tag);	
			if($tag['status'] == 'error'){
				throw new exception("tag not created");
			}
			$attachTag = self::attachTagToItem($board['id'], $card['result']['id'], $tag['result']['id']);
			//pr($attachTag);die;	
			if($attachTag['status'] == 'error'){
				throw new exception("tag not attach");
			}

			$resultSet = array('board_id'=>$board['id'], 'card_id'=>$card['result']['id'], 'link'=>$board['viewLink']);
			
			$data = array('status'=>'success', 'msg'=>"Signup & board created successfully.", 'result'=>$resultSet);	
		} catch (Exception $e) {
			$data = array('status'=>'error', 'msg'=>$e->getMessage());
		} finally {
			return $data;
		}  
    }

    public static function createCardItem($boardId){  
     	try {  
     		$resultSet = array();
			$client = new \GuzzleHttp\Client();
			$response = $client->request('POST', 'https://api.miro.com/v2/boards/'.$boardId.'/cards', [
			  'body' => '{"data":{"title":"Mission Statement"},"position":{"x":0,"y":0,"origin":"center"}}',
			  'headers' => [
			    'Accept' => 'application/json',
			    'Content-Type' => 'application/json',
			    'Authorization' => 'Bearer '.self::$ACCESS_TOKEN
			  ],
			]);

			$resultSet =  json_decode($response->getBody(), true);		
			//pr($resultSet );	die;	
			$data = array('status'=>'success', 'msg'=>"Card created successfully.", 'result'=>$resultSet);	
		} catch (Exception $e) {
			$data = array('status'=>'error', 'msg'=>$e->getMessage());
		} finally {
			return $data;
		}  
    }

    public static function updateCardItem($req){  
     	try {  
     		$resultSet = array();
			$client = new \GuzzleHttp\Client();			
			$response = $client->request('PATCH', 'https://api.miro.com/v2/boards/'.$req['board_id'].'/cards/'.$req['card_id'], [
			  'body' => '{"data":{"description":"'.$req['statement'].'"}}',
			  'headers' => [
			    'Accept' => 'application/json',
			    'Content-Type' => 'application/json',
			    'Authorization' => 'Bearer '.self::$ACCESS_TOKEN
			  ],
			]);

			$resultSet =  json_decode($response->getBody(), true);		
			//pr($resultSet );	die;	
			$data = array('status'=>'success', 'msg'=>"Card updated successfully.", 'result'=>$resultSet);	
		} catch (Exception $e) {
			$data = array('status'=>'error', 'msg'=>$e->getMessage());
		} finally {
			return $data;
		}  
    }


    public static function getCardItem($req){  
     	try {  
     		$resultSet = array();
     		$description = '';
			$client = new \GuzzleHttp\Client();			
			$response = $client->request('GET', 'https://api.miro.com/v2/boards/'.$req['board_id'].'/cards/'.$req['card_id'], [
			  'headers' => [
			    'Accept' => 'application/json',
			    'Content-Type' => 'application/json',
			    'Authorization' => 'Bearer '.self::$ACCESS_TOKEN
			  ],
			]);
			$resultSet =  json_decode($response->getBody(), true);		
			if(isset($resultSet['data']['description'])){
				$description = strip_tags($resultSet['data']['description']);
			}
			
			$data = array('status'=>'success', 'msg'=>"Card fetched successfully.", 'result'=>$description);	
		} catch (Exception $e) {
			$data = array('status'=>'error', 'msg'=>$e->getMessage());
		} finally {
			return $data;
		}  
    }
    

    public static function createTag($boardId, $cardId){  
     	try {  
     		$resultSet = array();
			$client = new \GuzzleHttp\Client();
			$response = $client->request('POST', 'https://api.miro.com/v2/boards/'.$boardId.'/tags', [
			  'body' => '{"fillColor":"red","title":"Mission"}',
			  'headers' => [
			    'Accept' => 'application/json',
			    'Authorization' => 'Bearer '.self::$ACCESS_TOKEN,
			    'Content-Type' => 'application/json'
			  ],
			]);
			$resultSet =  json_decode($response->getBody(), true);		
			//pr($resultSet );	die;	
			$data = array('status'=>'success', 'msg'=>"Tag created successfully.", 'result'=>$resultSet);	
		} catch (Exception $e) {
			$data = array('status'=>'error', 'msg'=>$e->getMessage());
		} finally {
			return $data;
		}  
    }

    public static function attachTagToItem($boardId, $cardId, $tagId){  
     	try {  
     		$resultSet = array();
			$client = new \GuzzleHttp\Client();

			$response = $client->request('POST', 'https://api.miro.com/v2/boards/'.$boardId.'/items/'.$cardId.'?tag_id='.$tagId, [
			  'headers' => [
			    'Accept' => 'application/json',
			    'Authorization' => 'Bearer '.self::$ACCESS_TOKEN,
			  ],
			]);			
			$resultSet =  json_decode($response->getBody(), true);				
			$data = array('status'=>'success', 'msg'=>"Tag attached successfully.", 'result'=>$resultSet);	
		} catch (Exception $e) {
			$data = array('status'=>'error', 'msg'=>$e->getMessage());
		} finally {
			return $data;
		}  
    }

    public static function inviteAsOwner($boardId, $email){  
     	try {  
     		$resultSet = array();
			$client = new \GuzzleHttp\Client();
			$response = $client->request('POST', 'https://api.miro.com/v2/boards/'.$boardId.'/members', [
			  'body' => '{"emails":["'.$email.'"],"role":"guest","message":"Miro owner account"}',
			  'headers' => [
			    'Accept' => 'application/json',
			    'Authorization' => 'Bearer '.self::$ACCESS_TOKEN,
			    'Content-Type' => 'application/json',
			  ],
			]);

			$resultSet =  json_decode($response->getBody(), true);		
			//pr($resultSet );	die;	
			$data = array('status'=>'success', 'msg'=>"Card created successfully.", 'result'=>$resultSet);	
		} catch (Exception $e) {
			$data = array('status'=>'error', 'msg'=>$e->getMessage());
		} finally {
			return $data;
		}  
    }

    public static function inviteAsGuest($req){  
     	try {  
     		//pr($req);die;
     		$resultSet = array();
			$client = new \GuzzleHttp\Client();
			$response = $client->request('POST', 'https://api.miro.com/v2/boards/'.$req['board_id'].'/members', [
			  'body' => '{"emails":["'.$req['email'].'"],"role":"editor","message":"Miro guest account"}',
			  'headers' => [
			    'Accept' => 'application/json',
			    'Authorization' => 'Bearer '.self::$ACCESS_TOKEN,
			    'Content-Type' => 'application/json',
			  ],
			]);

			$resultSet =  json_decode($response->getBody(), true);		
			//pr($resultSet );	die;	
			$data = array('status'=>'success', 'msg'=>"Guest account invitation sent successfully.", 'result'=>'');	
		} catch (Exception $e) {
			$data = array('status'=>'error', 'msg'=>$e->getMessage());
		} finally {
			return $data;
		}  
    }

    public static function oneStepLogin(){  
     	try {  
     		//pr($req);die;
     		$resultSet = array();
			$client = new \GuzzleHttp\Client();
			$response = $client->request('GET', 'https://miro.com/api/v1/scim/Users', [
			  'headers' => [
			    'Accept' => 'application/json',
			    'Authorization' => 'Bearer '.self::$SCIM_TOKEN,
			    'Content-Type' => 'application/json',
			  ],
			]);

			$resultSet =  json_decode($response->getBody(), true);	

			//pr($resultSet );	die;	
			$data = array('status'=>'success', 'msg'=>"Guest account invitation sent successfully.", 'result'=>$resultSet);	
		} catch (Exception $e) {
			$data = array('status'=>'error', 'msg'=>$e->getMessage());
		} finally {
			return $data;
		}  
    }

    public static function createScimUser($req){  
     	try {  
     		//pr($req);die;
     		$email =$req['username'].'@'.DOMAIN_NAME;
     		$expName = explode(' ', $req['name']);
     		$resultSet = array();
			$client = new \GuzzleHttp\Client();
			$response = $client->request('POST', 'https://miro.com/api/v1/scim/Users', [
			  'body' => '{
				    "schemas":["urn:ietf:params:scim:schemas:core:2.0:User"],
				    "userName":"'.$email.'",
				    "name":{
				        "familyName":"'.$expName[1].'",
				        "givenName":"'.$expName[0].'"     
				    },
				    "displayName": "'.$req['name'].'",
				    "active": true,
            		"userType": "Full"			    
				}',	
			  'headers' => [
			    'Accept' => 'application/json',
			    'Authorization' => 'Bearer '.self::$SCIM_TOKEN,
			    'Content-Type' => 'application/json',
			  ],
			]);

			$resultSet =  json_decode($response->getBody(), true);				
			$data = array('status'=>'success', 'msg'=>"Guest account invitation sent successfully.", 'result'=>$resultSet['id']);	
		} catch (Exception $e) {
			$data = array('status'=>'error', 'msg'=>$e->getMessage());
		} finally {
			return $data;
		}  
    }








}