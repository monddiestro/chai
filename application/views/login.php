<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>CHHAI Web Application | Security Check</title>

  <!-- Custom fonts for this template-->
  <link href="<?php echo base_url('src/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?php echo base_url('src/css/sb-admin-2.min.css') ?>" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="<?php echo base_url('src/vendor/datatables/dataTables.bootstrap4.min.css') ?>" rel="stylesheet">

</head>
<body class="bg-gradient-primary">

    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-7 col-md-4">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <?php 
                                        // check flash session for notification
                                        $session = $this->session->flashdata('result');
                                        // if not empty add values from session
                                        if(!empty($session)) {
                                            $display = "show";
                                            $class = $session["class"];
                                            $message = $session["message"];
                                        } else {
                                            $display = $class = $message = "";
                                        }
                                    ?>
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Cerritos Heights Homeowners Association Inc.</h1>
                                    </div>
                                    <?php if($display != ""): ?>
                                        <div class="alert alert-<?php echo $class ?> alert-dismissible fade <?php echo $display ?>" role="alert">
                                            <?php echo $message; ?>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    <?php endif ?>
                                        <?php echo form_open(base_url('account/check_user/')) ?>
                                            <div class="form-group">
                                                <input type="text" name="username" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Username" required>
                                            </div>
                                            <div class="form-group">
                                                <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" required>
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox small">
                                                    <input type="checkbox" class="custom-control-input" id="customCheck">
                                                    <label class="custom-control-label" for="customCheck">Remember Me</label>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                                Login
                                            </button>
                                        <?php echo form_close() ?>
                                        <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
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
    <script src="<?php echo base_url("src/vendor/jquery/jquery.min.js") ?>"></script>
    <script src="<?php echo base_url("src/vendor/bootstrap/js/bootstrap.bundle.min.js") ?>"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php echo base_url("src/vendor/jquery-easing/jquery.easing.min.js") ?>"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php echo base_url("src/js/sb-admin-2.min.js") ?>"></script>

    <!-- Page level plugins -->
    <script src="<?php echo base_url('src/vendor/datatables/jquery.dataTables.min.js') ?>"></script>
    <script src="<?php echo base_url('src/vendor/datatables/dataTables.bootstrap4.min.js') ?>"></script>
  
    <!-- Page level custom scripts -->
    <script src="<?php echo base_url("src/js/demo/datatables-demo.js")?>"></script>
    <script src="<?php echo base_url('src/js/demo/image-preview.js') ?>"></script>
    <script src="<?php echo base_url('src/js/demo/custom-script.js') ?>"></script>

</body>

</html>