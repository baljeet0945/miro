<?php require_once($_SERVER["DOCUMENT_ROOT"].'/helpers/classes/templates.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class MAIL {     
	protected static $HOST = "smtp-relay.sendinblue.com";		 
	protected static $USERNAME = "phpdevgmicro@gmail.com";
	protected static $PASSWORD = "N2DFZECX67YGBHRO";	
    public static $data;
   function __construct() {     

   }


	public static function forgotPasswordEmail($req){      
		try{ 
			$mail = new PHPMailer();
			$mail->IsSMTP();
			$mail->Mailer = "smtp";

			$mail->SMTPDebug  = 0;  
			$mail->SMTPAuth   = TRUE;
			$mail->SMTPSecure = "tls";
			$mail->Port       = 587;
			$mail->Host       = self::$HOST;
			$mail->Username   = self::$USERNAME;
			$mail->Password   = self::$PASSWORD;

			$mail->IsHTML(true);
			$mail->AddAddress($req['email']);
		
			$mail->Subject = "Edit on board in miro";
			$mail->setFrom('phpdevgmicro@gmail.com', 'Miro Board');
			$mail->MsgHTML(createUserEmail($req)); 
			if(!$mail->Send()) {
				throw new exception("Error while sending Email.");
			} else {
				$data = array('status'=>'success', 'msg'=>"Alert email sent.", 'result'=>'');
			}
		}catch(Exception $e){
		$data = array('status'=>'error', 'msg'=>$e->getMessage());
		}finally{
			return $data;
		}
	}

	public static function userCreateEmail($req){      
		try{ 
			$mail = new PHPMailer();
			$mail->IsSMTP();
			$mail->Mailer = "smtp";
	
			$mail->SMTPDebug  = 0;  
			$mail->SMTPAuth   = TRUE;
			$mail->SMTPSecure = "tls";
			$mail->Port       = 587;
			$mail->Host       = self::$HOST;
			$mail->Username   = self::$USERNAME;
			$mail->Password   = self::$PASSWORD;
	
			$mail->IsHTML(true);
			$mail->AddAddress($req['email']);
		
			$mail->Subject = "Invite on board in miro";
			$mail->setFrom('phpdevgmicro@gmail.com', 'Miro Board');
			$mail->MsgHTML(createUserEmail($req));
			if(!$mail->Send()) {
			  throw new exception("Error while sending Email.");
			} else {
			  $data = array('status'=>'success', 'msg'=>"Alert email sent.", 'result'=>'');
			}
		}catch(Exception $e){
		   $data = array('status'=>'error', 'msg'=>$e->getMessage());
		}finally{
			return $data;
		}
	}

	public static function userInviteBoardEmail($req){      
		try{ 
			$mail = new PHPMailer();
			$mail->IsSMTP();
			$mail->Mailer = "smtp";
	
			$mail->SMTPDebug  = 0;  
			$mail->SMTPAuth   = TRUE;
			$mail->SMTPSecure = "tls";
			$mail->Port       = 587;
			$mail->Host       = self::$HOST;
			$mail->Username   = self::$USERNAME;
			$mail->Password   = self::$PASSWORD;
	
			$mail->IsHTML(true);
			$mail->AddAddress($req['email']);
		
			$mail->Subject = "Invite on board in miro";
			$mail->setFrom('phpdevgmicro@gmail.com', 'Miro Board');
			$mail->MsgHTML(inviteUserEmail($req));
			if(!$mail->Send()) {
			  throw new exception("Error while sending Email.");
			} else {
			  $data = array('status'=>'success', 'msg'=>"Alert email sent.", 'result'=>'');
			}
		}catch(Exception $e){
		   $data = array('status'=>'error', 'msg'=>$e->getMessage());
		}finally{
			return $data;
		}
	}

}

?>