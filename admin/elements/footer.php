  <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="<?= HELPER_URL?>logout&u=1">Logout</a>
                </div>
            </div>
        </div>
    </div>

    
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog delete_info" role="document">
          
        </div>
    </div>   

    <!-- Bootstrap core JavaScript-->
    <script src="<?= ASSETS_URL?>vendor/jquery/jquery.min.js"></script>
    <script src="<?= ASSETS_URL?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= ASSETS_URL?>vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="<?= ASSETS_URL?>js/jquery.loadingModal.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="<?= ASSETS_URL?>js/sb-admin-2.min.js"></script>
    <script src="<?= ASSETS_URL?>js/snackbar.min.js"></script>
    <script src="https://malsup.github.io/jquery.form.js"></script>
    <script src="<?= ASSETS_URL?>js/custom.js"></script>
    

