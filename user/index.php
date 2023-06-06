<?php include('../helpers/classes/admin.php');
include('elements/restricted.php');
include('elements/head.php');
?>
<!-- Custom styles for this page -->
    <link href="<?= ASSETS_URL?>vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

       <?php include('elements/sidebar.php');?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

            <?php include('elements/navbar.php');?>            
                <!-- Begin Page Content -->
                <div class="container-fluid">

                     <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                         <h1 class="h3 mb-4 text-gray-800">All Boards</h1>
                    </div>
                    <?= FD_print_notices() ?>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">                        
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Board</th>
                                            <th>Created At</th>
                                        </tr>
                                    </thead> 
                                </table>
                            </div>
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

<?php include('elements/footer.php');?>
  <!-- Page level plugins -->
    <script src="<?= ASSETS_URL?>vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= ASSETS_URL?>vendor/datatables/dataTables.bootstrap4.min.js"></script>
    

    <!-- Page level custom scripts -->
    <script type="text/javascript">
        // Call the dataTables jQuery plugin
    $(document).ready(function() {
      var viewuser = $('#dataTable').DataTable({
        "ordering": false, 
        "ajax": {
            "url": '../helpers/functions.php?type=get-user-boards',
            "method": "POST",
            "dataSrc": function(json) {
                // You can also modify `json.data` if required
                return json.result;
            }
        }
      });
    });


    </script>

</body>

</html>