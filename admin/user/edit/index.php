<?php include($_SERVER["DOCUMENT_ROOT"].'/admin-panel/helpers/classes/users.php');
$title = 'User - Create | Sneat';
include('../../layouts/header.php');

$objUser = new USER();
$user = $objUser->fetchUserById($_GET['id']); 
?>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
        <?php include('../../layouts/sidemenu.php');?>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->
          <?php include('../../layouts/navbar.php');?>
          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Users/</span> Edit User</h4>

              <!-- Basic Layout -->
              <div class="row">
                <div class="col-md-12">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">Upadate User</h5>
                        <!-- <small class="text-muted float-end">
                          <button type="button" class="btn btn-primary">
                              <span class="tf-icons bx bx-pie-chart-alt"></span>&nbsp; Primary
                            </button>
                        </small> -->
                    </div>
                    <div class="card-body">
                    <form id="form-submit" class="mb-3" action="<?= HELPER_URL.base64_encode('update-user')?>" method="POST">
                      <div class="row">
                        <div class="mb-3 col-md-6">
                          <label class="form-label" for="basic-icon-default-first-name">First Name</label>
                          <div class="input-group input-group-merge">
                            <span id="basic-icon-default-first-name" class="input-group-text"
                              ><i class="bx bx-user"></i
                            ></span>
                            <input
                              type="text"
                              class="form-control"
                              id="basic-icon-default-first-name"
                              name="first_name"
                              placeholder="Enter first name"
                              aria-describedby="basic-icon-default-first-name"
                              value="<?= $user['result']['first_name']?>"
                            />
                          </div>
                        </div>
                        <div class="mb-3 col-md-6">
                          <label class="form-label" for="basic-icon-default-fullname">Last Name</label>
                          <div class="input-group input-group-merge">
                            <span id="basic-icon-default-last-name" class="input-group-text"
                              ><i class="bx bx-user"></i
                            ></span>
                            <input
                              type="text"
                              class="form-control"
                              id="basic-icon-default-last-name"
                              name="last_name"
                              placeholder="Enter last name"
                              aria-describedby="basic-icon-default-last-name"
                              value="<?= $user['result']['last_name']?>"
                            />
                          </div>
                        </div>
                        <div class="mb-3 col-md-6">
                          <label class="form-label" for="basic-icon-default-email">Email</label>
                          <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                            <input
                              type="email"
                              id="basic-icon-default-email"
                              class="form-control"
                              name="email"
                              placeholder="Enter email address"
                              aria-describedby="basic-icon-default-email2"
                              value="<?= $user['result']['email']?>"
                            />
                            <span id="basic-icon-default-email2" class="input-group-text">@example.com</span>
                          </div>
                        </div>
                        <div class="mb-3 col-md-6">
                          <label class="form-label" for="basic-icon-default-phone">Phone No</label>
                          <div class="input-group input-group-merge">
                            <span id="basic-icon-default-phone2" class="input-group-text"
                              ><i class="bx bx-phone"></i
                            ></span>
                            <input
                              type="text"
                              id="basic-icon-default-phone"
                              class="form-control phone-mask"
                              placeholder="Enter phone number"
                              name="phone"
                              aria-describedby="basic-icon-default-phone2"
                              value="<?= $user['result']['phone']?>"
                            />
                          </div>
                        </div>                    
                        </div>
                        <div class="mt-2">
                             <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                        <input type="hidden" name="edit_id" value="<?= $_GET['id']?>"/>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- / Content -->

            <!-- Footer -->
            <?php include('../../layouts/footer.php')?>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <?php include('../../script-tags/foot.php')?>
