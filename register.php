<?php
require_once "config/connect_db.php";

require_once "config/authchecker.php";
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST") {
  //validate
  //$original = "   bryta hub   ";
  //trim($original) = "bryta hub";
  $input_name = trim($_POST['name']);
  $input_phoneno = trim($_POST['phoneno']);
  $input_email = trim($_POST['email']);
  $input_password = trim($_POST['password']);
  $input_confirm_password = trim($_POST['confirm_password']);

  if (empty($input_name) || empty($input_email) || empty($input_password) || empty($input_confirm_password)) {
    $error = "Name, Email and Password fields are compulsory";
  } elseif($input_password !== $input_confirm_password) {
    $error = "Passwords not the same";
  }
  else {
    $sql = "INSERT INTO users (name, email, password, phoneno) VALUES (?, ?, ?, ?)";
    if ($stmt = mysqli_prepare($conn, $sql)) {
      //bind variables to statement
      $hashed_password = password_hash($input_password, PASSWORD_DEFAULT);

      mysqli_stmt_bind_param($stmt, "ssss", $input_name, $input_email, $hashed_password, $input_phoneno);

      //attempt to execute statement on database
      if (mysqli_stmt_execute($stmt)) {
      //var_dump($hashed_password);
        //user created successfully
        //redirect to products page
        header("Location: login.php");
        exit();
      }
    }
  }
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Store Manager| Register</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <?php include('partials/styles.php') ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <?php include('partials/header.php'); ?>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <?php include('partials/aside.php'); ?>
  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Register
        <small>Register</small>
      </h1>
      <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Blank page</li>
      </ol> -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Register</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <!-- <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button> -->
          </div>
        </div>
        <div class="box-body">
          <?php
          //$a = 3; $b = "3";
          // if($a == $b) //true !=
          // if($a === $b) //false !==
          if (isset($error) && $error != "") {
          echo '<div class="text-danger text-center">'.$error.'</div>';
          }
          ?>
          <form method="post">
            <div class="row form-group col-md-12">
              <div class="col-md-4">
                <label for="name">Name</label>
              </div>
                <div class="col-md-8">
                  <input type="text" name="name" id="name" class="form-control" required="">
                </div>
            </div>

            <div class="row form-group col-md-12">
              <div class="col-md-4">
              <label for="phoneno">Phone no</label>
              </div>
                <div class="col-md-8">
                  <input type="text" name="phoneno" id="phoneno" class="form-control" required />
                </div>
            </div>

            <div class="row form-group col-md-12">
              <div class="col-md-4">
                <label for="email">Email</label>
              </div>
                <div class="col-md-8">
                  <input type="email" name="email" id="email" class="form-control" required="">
                </div>
            </div>

            <div class="row form-group col-md-12">
              <div class="col-md-4">
              <label for="password">Password</label>
              </div>
                <div class="col-md-8">
                  <input type="password" name="password" id="password" class="form-control" required />
                </div>
            </div>

            <div class="row form-group col-md-12">
              <div class="col-md-4">
              <label for="confirm_password">Confirm Password</label>
              </div>
                <div class="col-md-8">
                  <input type="password" name="confirm_password" id="confirm_password" class="form-control" required />
                </div>
            </div>
            <div class="row form-group col-md-12">
              <div class="col-md-4">
              <button type="submit" class="btn btn-primary">Register</button>
              </div>
            </div>
          </form>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          Footer
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php include('partials/footer.php'); ?>
</div>
<!-- ./wrapper -->

<?php include('partials/scripts.php') ?>
</body>
</html>