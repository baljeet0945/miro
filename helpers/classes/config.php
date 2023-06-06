<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);  
error_reporting(E_ALL);

@ob_start();
session_start();

require_once($_SERVER["DOCUMENT_ROOT"].'/vendor/autoload.php');

date_default_timezone_set("Asia/Kolkata");
define('ASSETS_URL','http://miro.stageservices.xyz/assets/');
define('SITE_URL','http://miro.stageservices.xyz/');
define('USER_URL','http://miro.stageservices.xyz/user/');
define('ADMIN_URL','http://miro.stageservices.xyz/admin/');
define('HELPER_URL','http://miro.stageservices.xyz/helpers/functions.php?type=');
define('BOARD_LINK','https://miro.com/app/board/');
define('DOMAIN_NAME',$_SERVER['HTTP_HOST']);

define('DB_HOST','localhost');
define('DB_USERNAME','u742355347_miro');
define('DB_PASSWORD','Arona1@1@1');
define('DB_NAME','u742355347_miro');

$data['DateFormat'] = 'm/d/Y h:i:s A';  
$data['OnlyDate']   = 'm/d/Y';
$data['NoRecord']   = '<i class="fa fa-exclamation-triangle"></i> No record found';
$data['SuccessIcon']   = '<i class="fa fa-check"></i>';
$data['ErrorIcon']   = '<i class="fa fa-exclamation-triangle"></i>';
$data['ExclamationIcon'] = '<i class="fa fa-exclamation-circle"></i>';

class dbconfig {
  // database hostname
  protected static $host = DB_HOST;
  // database username
  protected static $username = DB_USERNAME;
  // database password
 
  protected static $password = DB_PASSWORD;

  //database name
  protected static $dbname = DB_NAME;   

  static $con;

  function __construct() {
    self::$con = self::connect();
  }

  // open connection
  protected static function connect() {
     try {
       $link = mysqli_connect(self::$host, self::$username, self::$password, self::$dbname); 
        if(!$link) {
          throw new exception(mysqli_error($link));
        }
        return $link;
     } catch (Exception $e) {
       echo "Error: ".$e->getMessage();
     }
  }

 // close connection
  public static function close() {
     mysqli_close(self::$con);
  }

// run query
  public static function run($query) {
    try {
      if(empty($query) && !isset($query)) {
        throw new exception("Query string is not set.");
      }
      $result = mysqli_query(self::$con, $query);
     
     return $result;
    } catch (Exception $e) {
      echo "Error: ".$e->getMessage();
    }

  }
// insert_run
public static function insertrun($query) {
    try {
      if(empty($query) && !isset($query)) {
        throw new exception("Query string is not set.");
      }

      $result = mysqli_query(self::$con, $query);
      $insert_id = mysqli_insert_id(self::$con);
      
     return $insert_id;
    } catch (Exception $e) {
      echo "Error: ".$e->getMessage();
    }
  }
}

$config = new DBCONFIG();

function FD_add_notices($message, $notice_type="error", $key=""){
  
  $notices = array(); 
  $notices = get_session( 'ef_notices' ); 
  if(!empty($key)){
    $notices[$notice_type][$key] = $message;
  }
  else{
    $notices[$notice_type][] = $message;  
  }
  set_session('FD_notices',  $notices);
}

function FD_print_notices(){
  global $data;
  
  $all_notices  = array();
  $all_notices  = get_session( 'FD_notices' );
  
  if(empty($all_notices)) return;

  foreach ($all_notices as $key=>$notice_type ) {   
    if($key=='error' && count($notice_type) > 0) {     
      echo '<div class="alert alert-warning alert-dismissible mb-2" role="alert">';
        foreach ( $notice_type as $message ) {
          echo $data['ErrorIcon'].' '.$message;
        }
        echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>';
    }
    if($key=='success'  && count($notice_type) > 0) {
         echo '<div class="alert alert-success alert-dismissible mb-2" role="alert">';
        foreach ( $notice_type as $message ) {
          echo $data['SuccessIcon'].' '.$message;
        }
        echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>';
    }    
  }   
  FD_clear_notices(); 
}
function get_session($key){
  if(isset($_SESSION[$key])){
    return $_SESSION[$key];   
    } 
}
function FD_clear_notices(){
  clear_session('FD_notices');    
}
function clear_session($key){
    unset($_SESSION[$key]); 
}
function set_session($key, $val){
    $_SESSION[$key] = $val;
}
function pr($array) {
  echo "<pre>";
  print_r($array);
  echo "</pre>";
}
function random_gen($length)
{
  $random= "";
  srand((double)microtime()*1000000);
  $char_list = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
  $char_list .= "abcdefghijklmnopqrstuvwxyz";
  $char_list .= "1234567890";
  // Add the special characters to $char_list if needed
  for($i = 0; $i < $length; $i++)
  {
    $random .= substr($char_list,(rand()%(strlen($char_list))), 1);  
  }
  return $random;
}
?>