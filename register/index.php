<?php include('../helpers/classes/config.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Miro - Register</title>

    <!-- Custom fonts for this template-->
    <link href="<?= ASSETS_URL?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="<?= ASSETS_URL?>css/snackbar.min.css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="<?= ASSETS_URL?>css/sb-admin-2.min.css" rel="stylesheet">
    <!-- <script src="https://www.google.com/recaptcha/api.js" async defer></script>    -->
<style>
    .input-group-text{border-radius: 2rem;}
</style>
</head>

<body class="">

    <div class="container">

        <div class="card o-hidden border-0 my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">                    
                    <div class="col-lg-6 mx-auto">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>  
                            <form class="user" id="form-submit" action="<?= HELPER_URL ?>signup" method="POST">
                                <div class="form-group row">
                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                        <div class="input-group">
                                            <input 
                                            type="text" 
                                            name="username"
                                            class="form-control form-control-user" 
                                            id="exampleUserName"
                                            placeholder="Username"
                                            aria-describedby="basic-addon2"
                                            >                                           
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">@miro.stageservices.xyz</span>
                                            </div>
                                        </div>
                                    </div>                           
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input 
                                        type="text" 
                                        class="form-control form-control-user"
                                        name="name" 
                                        id="exampleFullName"
                                        placeholder="Full Name">
                                    </div>
                                    <div class="col-sm-6">
                                        <input 
                                        type="email" 
                                        name="email"
                                        class="form-control form-control-user" id="exampleInputEmail"
                                        placeholder="Email Address" 
                                        autocomplete="email">
                                    </div>  
                                </div>                                
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input 
                                        type="password"
                                        name="password" 
                                        class="form-control form-control-user"
                                        id="exampleInputPassword" 
                                        placeholder="Password" 
                                        autocomplete="new-password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
                                    </div>
                                    <div class="col-sm-6">
                                        <input 
                                        type="password"
                                        name="confirm_password" 
                                        class="form-control form-control-user"
                                        id="exampleRepeatPassword" 
                                        placeholder="Repeat Password">
                                    </div>
                                </div>
                                <!-- <div class="form-group row">
                                    <div class="col-sm-12">
                                        <div class="g-recaptcha" data-sitekey="6Lew2qwgAAAAAOYxacrpEnK8Jx4s5qFTX5fyEN2v"></div>
                                    </div>
                                </div> -->
                                <div class="error-container"> </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block spinner-button" data-text="Register Account">
                                    Register Account
                                </button>
                            </form>  
                            <hr>
                            <!-- <div class="text-center">
                                <a class="small" href="forgot-password.html">Forgot Password?</a>
                            </div> -->
                            <div class="text-center">
                                <a class="small" href="<?= SITE_URL?>">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    

    <!-- Bootstrap core JavaScript-->
    <script src="<?= ASSETS_URL?>vendor/jquery/jquery.min.js"></script>
    <script src="<?= ASSETS_URL?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= ASSETS_URL?>vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="<?= ASSETS_URL?>js/snackbar.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="<?= ASSETS_URL?>js/sb-admin-2.min.js"></script>
    <script src="https://malsup.github.io/jquery.form.js"></script>    
    <script src="<?= ASSETS_URL?>js/custom.js"></script>
</body>

</html>