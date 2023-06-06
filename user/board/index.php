<?php include('../../helpers/classes/users.php');
include('../elements/restricted.php');
include('../elements/head.php');
$objUser = new USER;
$board = $objUser->fetchBoardById($_GET['id']);
?>
<!-- Custom styles for this page -->
    <link href="<?= ASSETS_URL?>vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

       <?php include('../elements/sidebar.php');?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

            <?php include('../elements/navbar.php');?>
            
                <!-- Begin Page Content -->
                <div class="container-fluid">

                     <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Miro Board</h1>
                    </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4"> 
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Mission Statement</h6>                                   
                        </div>                       
                        <div class="card-body">
                        <iframe id="frame" src="https://miro.com/app/live-embed/<?= $board['result']['board_id']?>/?moveToWidget=<?= $board['result']['card_id']?>&embedAutoplay=true" frameBorder="0" scrolling="no" allowFullScreen width="100%" height="400px"></iframe>
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
 
<?php include('../elements/footer.php');?>
</body>

</html>