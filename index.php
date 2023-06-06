<?php include('helpers/classes/config.php');
//$objAuth0= new AUTH0;
// $user = $objAuth0->createUser();  
// pr($user);die;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Miro - Login</title>

    <!-- Custom fonts for this template-->
    <link href="<?= ASSETS_URL?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="<?= ASSETS_URL?>css/snackbar.min.css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="<?= ASSETS_URL?>css/sb-admin-2.min.css" rel="stylesheet">
   <script src="https://cdn.auth0.com/js/auth0/9.11/auth0.min.js"></script>
<style>
    .input-group-text{border-radius: 2rem;}
</style>
</head>

<body class="">

    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 mx-auto">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                        <?= FD_print_notices() ?>
                                    </div>
                                    <form class="user" id="form-submit" action="<?= HELPER_URL ?>login" method="POST">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input 
                                                type="text" 
                                                name="username"
                                                class="form-control form-control-user" 
                                                id="exampleUserName"
                                                placeholder="Enter Username"
                                                aria-describedby="basic-addon2"
                                                value="<?= $_GET['username'] ?? ""?>"
                                                >                                           
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="basic-addon2">@miro.stageservices.xyz</span>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="form-group">
                                            <input 
                                            autocomplete="new-password"
                                            type="password" 
                                            class="form-control form-control-user"
                                            name="password"
                                            id="exampleInputPassword"
                                            placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <div class="error-container"> </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block spinner-button" data-text="Login">Login</button>
                                        <a href="<?= HELPER_URL?>auth0_login" class="btn btn-primary btn-user btn-block">Sign in with Auth0</a>                         
                                    </form>
                                    <hr>  
                                    <!-- <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div> -->
                                    <div class="text-center">
                                        <a class="small" href="<?= SITE_URL?>register">Create an Account!</a>
                                    </div>
                                </div>
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