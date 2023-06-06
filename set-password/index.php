<?php include('../helpers/classes/config.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Miro - Set Password</title>

    <!-- Custom fonts for this template-->
    <link href="<?= ASSETS_URL?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="<?= ASSETS_URL?>css/snackbar.min.css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="<?= ASSETS_URL?>css/sb-admin-2.min.css" rel="stylesheet">
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
                                        <h1 class="h4 text-gray-900 mb-4">Set Password</h1>
                                    </div>
                                    <form class="user" id="form-submit" action="<?= HELPER_URL ?>set-password" method="POST">
                                        <div class="form-group">
                                            <input 
                                            type="password" 
                                            class="form-control form-control-user"
                                            name="password"
                                            id="exampleInputEmail" 
                                            aria-describedby="emailHelp"
                                            placeholder="Enter Password">
                                        </div>
                                        <div class="form-group">
                                            <input 
                                            type="password" 
                                            class="form-control form-control-user"
                                            name="confirm_password"
                                            id="exampleInputPassword" 
                                            placeholder="Confirm Password">
                                        </div>                                       
                                        <div class="error-container"> </div>
                                        <input type="hidden" name="user_id" value="<?= $_GET['id']?>"/>
                                        <input type="hidden" name="username" value="<?= $_GET['username']?>"/>
                                        <button type="submit" class="btn btn-primary btn-user btn-block spinner-button" data-text="Login">Set Password</button>                                       
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="<?= SITE_URL?>">Login</a>
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