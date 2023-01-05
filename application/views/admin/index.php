<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $title; ?></title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/vendors/feather/feather.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/vendors/typicons/typicons.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->

    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="<?= base_url(); ?>assets/images/favicon.png" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
</head>

<body>
    <!-- swall -->
    <div class="flash-success" data-flashdata="<?= $this->session->flashdata('flash-success'); ?>"></div>
    <div class="flash-error" data-flashdata="<?= $this->session->flashdata('flash-error'); ?>"></div>
    <!-- endswall -->
    <div class="container-scroller">
        <div class="row p-0 m-0 proBanner" id="proBanner">
            <div class="col-md-12 p-0 m-0">
                <div class="card-body card-body-padding d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center justify-content-between">
                        <a href="https://www.bootstrapdash.com/product/star-admin-pro/"><i class="mdi mdi-home me-3 text-white"></i></a>
                        <button id="bannerClose" class="btn border-0 p-0">
                            <i class="mdi mdi-close text-white me-0"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
                <div class="me-3">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
                        <span class="icon-menu"></span>
                    </button>
                </div>
                <div>
                    <a class="navbar-brand brand-logo" href="index.html">
                        <h4>SISMOSAP</h4>
                    </a>
                    <a class="navbar-brand brand-logo-mini" href="index.html">
                        <img src="<?= base_url(); ?>assets/images/logo-mini.svg" alt="logo" />
                    </a>
                </div>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-top">
                <ul class="navbar-nav">
                    <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
                        <h1 class="welcome-text">Hello <?= $this->d_admin->nama; ?></h1>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown d-none d-lg-block user-dropdown">
                        <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            <img class="img-xs rounded-circle" src="<?= base_url('uploads/' . $this->d_admin->foto); ?>" alt="Profile image"> </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                            <div class="dropdown-header text-center">
                                <img class="img-md rounded-circle" src="<?= base_url('assets/images/faces/profile/profile.jpg'); ?>" alt="Profile image">
                                <p class="mb-1 mt-3 font-weight-semibold">user</p>
                            </div>
                            <a href="<?= base_url('profile'); ?>" class="dropdown-item"><i class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> My Profile <span class="badge badge-pill badge-danger">1</span></a>
                            <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                <i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Sign Out
                            </button>
                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>

        <!-- modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">LOGOUT</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah anda yakin ingin keluar dari halaman ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <a href="<?= base_url('auth/logout'); ?>" class="btn btn-danger">Sign Out</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item <?= ($this->uri->segment(1) === 'admin') ? 'active' : '' ?>">
                        <a class="nav-link" href="<?= base_url('admin'); ?>">
                            <i class="mdi mdi-grid-large menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-item nav-category">Data</li>
                    <li class="nav-item <?= ($this->uri->segment(1) === 'rekap') ? 'active' : '' ?>">
                        <a class="nav-link" href="<?= base_url('rekap'); ?>">
                            <i class="menu-icon mdi mdi-account-circle-outline"></i>
                            <span class="menu-title">Rekap</span>
                        </a>
                    </li>
                    <li class="nav-item <?= ($this->uri->segment(1) === 'gambar') ? 'active' : '' ?>">
                        <a class="nav-link" href="<?= base_url('gambar'); ?>">
                            <i class="menu-icon mdi mdi-file-image"></i>
                            <span class="menu-title">Gambar</span>
                        </a>
                    </li>
                    <li class="nav-item nav-category">Admin</li>
                    <li class="nav-item <?= ($this->uri->segment(1) === 'user') ? 'active' : '' ?>">
                        <a class="nav-link" href="<?= base_url('user'); ?>">
                            <i class="menu-icon mdi mdi-account-circle-outline"></i>
                            <span class="menu-title">Admin</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('auth/logout'); ?>">
                            <i class="menu-icon mdi mdi-account-circle-outline"></i>
                            <span class="menu-title">Logout</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">

                    <!-- load view -->
                    <?php $this->load->view($page); ?>
                </div>

                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Copyright &copy;
                    </div>
                </footer>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <!-- plugins:js -->
    <script src="<?= base_url(); ?>assets/vendors/js/vendor.bundle.base.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="<?= base_url(); ?>assets/vendors/chart.js/Chart.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendors/progressbar.js/progressbar.min.js"></script>

    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="<?= base_url(); ?>assets/js/off-canvas.js"></script>
    <script src="<?= base_url(); ?>assets/js/hoverable-collapse.js"></script>
    <script src="<?= base_url(); ?>assets/js/template.js"></script>
    <script src="<?= base_url(); ?>assets/js/settings.js"></script>
    <script src="<?= base_url(); ?>assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="<?= base_url(); ?>assets/js/jquery.cookie.js" type="text/javascript"></script>
    <script src="<?= base_url(); ?>assets/js/dashboard.js"></script>
    <script src="<?= base_url(); ?>assets/js/Chart.roundedBarCharts.js"></script>
    <!-- Sweet Alert -->
    <script src="<?= base_url('assets/sweetalert/sweetalert2.js'); ?> "></script>
    <script src="<?= base_url('assets/sweetalert/script.js'); ?> "></script>
    <!-- End custom js for this page-->
    <script>
        $(document).ready(function() {
            $('#table_id').DataTable();
        });
    </script>
</body>

</html>