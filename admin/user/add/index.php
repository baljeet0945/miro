<?php include('../../../helpers/classes/admin.php');
include('../../elements/restricted.php');
include('../../elements/head.php');
?>
<!-- Custom styles for this page -->
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

       <?php include('../../elements/sidebar.php');?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

            <?php include('../../elements/navbar.php');?>
            
                <!-- Begin Page Content -->
                <div class="container-fluid">

                     <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Create Users</h1>     
                    </div>
                    <?= FD_print_notices() ?>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">                       
                        <!-- Card Body -->
                        <div class="card-body">
                        <form class="user" id="form-submit" action="<?= HELPER_URL ?>add-user" method="POST">
                            <div class="row">
                                <div class="col">
                                 <div class="form-group">
                                    <label for="fname">First Name:</label>
                                    <input type="text" class="form-control" name="first_name" id="fname">
                                  </div>
                                </div>
                                <div class="col">
                                 <div class="form-group">
                                    <label for="lname">Last Name:</label>
                                    <input type="text" class="form-control" name="last_name" id="lname">
                                  </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                 <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" class="form-control" name="email" id="email">
                                  </div>
                                </div> 

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="username">Username:</label>
                                        <div class="input-group">
                                            <input type="text" name="username" id="username" class="form-control" aria-describedby="basic-addon2">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">@miro.stageservices.xyz</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>                               
                            </div>
                            <input type="hidden" name="board_id" value="<?= $_SESSION['admin']['result']['board_id']?>"/>
                            <input type="hidden" name="card_id" value="<?= $_SESSION['admin']['result']['card_id']?>"/>
                            <div class="error-container"> </div>                       
                            <button type="submit" class="btn btn-primary  spinner-button" data-text="Add"> Add</button>  
                            </form> 
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->


<?php include('../../elements/footer.php');?>
</body>

</html>