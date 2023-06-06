<?php 
require_once($_SERVER["DOCUMENT_ROOT"].'/helpers/classes/config.php');

function resetPasswordEmail($req){
	$template = '<!doctype html>
		<html lang="en-US">

		<head>
		    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
		    <title>Reset Password Email Template</title>
		    <meta name="description" content="Reset Password Email Template.">
		    <style type="text/css">
		        a:hover {text-decoration: underline !important;}
		    </style>
		</head>

		<body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #f2f3f8;" leftmargin="0">
		    <!--100% body table-->
		    <table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8"
		        style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: "Open Sans", sans-serif;">
		        <tr>
		            <td>
		                <table style="background-color: #f2f3f8; max-width:670px;  margin:0 auto;" width="100%" border="0"
		                    align="center" cellpadding="0" cellspacing="0">
		                    <tr>
		                        <td style="height:80px;">&nbsp;</td>
		                    </tr>
		                    <tr>
		                        <td style="text-align:center;">
		                          <a href="https://rakeshmandal.com" title="logo" target="_blank">
		                            <img width="60" src="https://i.ibb.co/hL4XZp2/android-chrome-192x192.png" title="logo" alt="logo">
		                          </a>
		                        </td>
		                    </tr>
		                    <tr>
		                        <td style="height:20px;">&nbsp;</td>
		                    </tr>
		                    <tr>
		                        <td>
		                            <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"
		                                style="max-width:670px;background:#fff; border-radius:3px; text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);">
		                                <tr>
		                                    <td style="height:40px;">&nbsp;</td>
		                                </tr>
		                                <tr>
		                                    <td style="padding:0 35px;">
		                                        <h1 style="color:#1e1e2d; font-weight:500; margin:0;font-size:32px;font-family:"Rubik",sans-serif;">You have
		                                            requested to reset your password</h1>
		                                        <span
		                                            style="display:inline-block; vertical-align:middle; margin:29px 0 26px; border-bottom:1px solid #cecece; width:100px;"></span>
		                                        <p style="color:#455056; font-size:15px;line-height:24px; margin:0;">
		                                            We cannot simply send you your old password. A unique link to reset your
		                                            password has been generated for you. To reset your password, click the
		                                            following link and follow the instructions.
		                                        </p>
		                                        <a href="'.HELPER_URL.base64_encode('reset-password-link').'&id='.base64_encode($req['id']).'"
		                                            style="background:#20e277;text-decoration:none !important; font-weight:500; margin-top:35px; color:#fff;text-transform:uppercase; font-size:14px;padding:10px 24px;display:inline-block;border-radius:50px;">Reset
		                                            Password</a>
		                                    </td>
		                                </tr>
		                                <tr>
		                                    <td style="height:40px;">&nbsp;</td>
		                                </tr>
		                            </table>
		                        </td>
		                    <tr>
		                        <td style="height:20px;">&nbsp;</td>
		                    </tr>
		                    <tr>
		                        <td style="text-align:center;">
		                            <p style="font-size:14px; color:rgba(69, 80, 86, 0.7411764705882353); line-height:18px; margin:0 0 0;">&copy; <!-- <strong>www.rakeshmandal.com</strong></p> -->
		                        </td>
		                    </tr>
		                    <tr>
		                        <td style="height:80px;">&nbsp;</td>
		                    </tr>
		                </table>
		            </td>
		        </tr>
		    </table>
		    <!--/100% body table-->
		</body>

		</html>';
		return $template;
}

function createUserEmail($req){
	$template = '<!doctype html>
		<html lang="en-US">

		<head>
		    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
		    <title>New Account</title>
		    <meta name="description" content="New Account">
		    <style type="text/css">
		        a:hover {text-decoration: underline !important;}
		    </style>
		</head>

		<body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #f2f3f8;" leftmargin="0">
		    <!--100% body table-->
		    <table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8"
		        style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: "Open Sans", sans-serif;">
		        <tr>
		            <td>
		                <table style="background-color: #f2f3f8; max-width:670px;  margin:0 auto;" width="100%" border="0"
		                    align="center" cellpadding="0" cellspacing="0">
		                    <tr>
		                        <td style="height:80px;">&nbsp;</td>
		                    </tr>
		                    <tr>
		                        <td style="text-align:center;">
		                          <a href="#" title="logo">
		                            <img width="60" src="'.ASSETS_URL.'img/miro-logo.png" title="logo" alt="logo">
		                          </a>
		                        </td>
		                    </tr>
		                    <tr>
		                        <td style="height:20px;">&nbsp;</td>
		                    </tr>
		                    <tr>
		                        <td>
		                            <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"
		                                style="max-width:670px;background:#fff; border-radius:3px; text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);">
		                                <tr>
		                                    <td style="height:40px;">&nbsp;</td>
		                                </tr>
		                                <tr>
		                                    <td style="padding:0 35px;">
		                                        <h1 style="color:#1e1e2d; font-weight:500; margin:0;font-size:32px;font-family:"Rubik",sans-serif;">New Account</h1>
		                                        <span
		                                            style="display:inline-block; vertical-align:middle; margin:29px 0 26px; border-bottom:1px solid #cecece; width:100px;"></span>
													<p style="color:#455056; font-size:15px;line-height:24px; margin:0;">
														You has invited on board in miro .
													</p>
													<p style="color:#455056; font-size:15px;line-height:24px; margin:0;">
														<b>Username</b>: '.$req['username'].'
													</p>
												<a href="'.SITE_URL.'set-password?id='.$req['id'].'&username='.$req['username'].'">Go To Board</a>
		                                    </td>
		                                </tr>
		                                <tr>
		                                    <td style="height:40px;">&nbsp;</td>
		                                </tr>
		                            </table>
		                        </td>
		                    <tr>
		                        <td style="height:20px;">&nbsp;</td>
		                    </tr>
		                    <tr>
		                        <td style="text-align:center;">
		                            <p style="font-size:14px; color:rgba(69, 80, 86, 0.7411764705882353); line-height:18px; margin:0 0 0;">&copy; 
		                        </td>
		                    </tr>
		                    <tr>
		                        <td style="height:80px;">&nbsp;</td>
		                    </tr>
		                </table>
		            </td>
		        </tr>
		    </table>
		    <!--/100% body table-->
		</body>

		</html>';
		return $template;
}

function inviteUserEmail($req){
	$template = '<!doctype html>
		<html lang="en-US">

		<head>
		    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
		    <title>Reset Password Email Template</title>
		    <meta name="description" content="Reset Password Email Template.">
		    <style type="text/css">
		        a:hover {text-decoration: underline !important;}
		    </style>
		</head>

		<body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #f2f3f8;" leftmargin="0">
		    <!--100% body table-->
		    <table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8"
		        style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: "Open Sans", sans-serif;">
		        <tr>
		            <td>
		                <table style="background-color: #f2f3f8; max-width:670px;  margin:0 auto;" width="100%" border="0"
		                    align="center" cellpadding="0" cellspacing="0">
		                    <tr>
		                        <td style="height:80px;">&nbsp;</td>
		                    </tr>
		                    <tr>
		                        <td style="text-align:center;">
		                          <a href="#" title="logo">
		                            <img width="60" src="'.ASSETS_URL.'img/miro-logo.png" title="logo" alt="logo">
		                          </a>
		                        </td>
		                    </tr>
		                    <tr>
		                        <td style="height:20px;">&nbsp;</td>
		                    </tr>
		                    <tr>
		                        <td>
		                            <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"
		                                style="max-width:670px;background:#fff; border-radius:3px; text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);">
		                                <tr>
		                                    <td style="height:40px;">&nbsp;</td>
		                                </tr>
		                                <tr>
		                                    <td style="padding:0 35px;">
		                                        <h1 style="color:#1e1e2d; font-weight:500; margin:0;font-size:32px;font-family:"Rubik",sans-serif;">Invite Board</h1>
		                                        <span
		                                            style="display:inline-block; vertical-align:middle; margin:29px 0 26px; border-bottom:1px solid #cecece; width:100px;"></span>
													<p style="color:#455056; font-size:15px;line-height:24px; margin:0;">
														You has invited on board in miro .
													</p>
												<a href="'.HELPER_URL.'invitation-link&id='.$req['id'].'">Go To Board</a>
		                                    </td>
		                                </tr>
		                                <tr>
		                                    <td style="height:40px;">&nbsp;</td>
		                                </tr>
		                            </table>
		                        </td>
		                    <tr>
		                        <td style="height:20px;">&nbsp;</td>
		                    </tr>
		                    <tr>
		                        <td style="text-align:center;">
		                            <p style="font-size:14px; color:rgba(69, 80, 86, 0.7411764705882353); line-height:18px; margin:0 0 0;">&copy; 
		                        </td>
		                    </tr>
		                    <tr>
		                        <td style="height:80px;">&nbsp;</td>
		                    </tr>
		                </table>
		            </td>
		        </tr>
		    </table>
		    <!--/100% body table-->
		</body>

		</html>';
		return $template;
}
?>