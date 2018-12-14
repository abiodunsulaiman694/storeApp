<?php
require_once "config/connect_db.php";
//start session
session_start();
//check if user is already logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
  header("Location: index.php");
  exit();
}


if($_SERVER["REQUEST_METHOD"] == "POST") {
  //validate
  $input_email = trim($_POST['email']);
  $input_password = trim($_POST['password']);

  if (empty($input_email) || empty($input_password)) {
    $error = "Email and Password fields are compulsory";
  }
  else {
    $sql = "SELECT id, name, role, email, password FROM users WHERE email = ?";
    if ($stmt = mysqli_prepare($conn, $sql)) {
      //bind variables to statement
      mysqli_stmt_bind_param($stmt, "s", $input_email);
      //attempt to execute statement on database
      if (mysqli_stmt_execute($stmt)) {
        //store result
        mysqli_stmt_store_result($stmt);
        //check if email exists
        if (mysqli_stmt_num_rows($stmt) != 1) {
          $error = "Email does not exist on StoreManager";
        } else {
          mysqli_stmt_bind_result($stmt, $id, $name, $role, $email, $hashed_password);
          if (mysqli_stmt_fetch($stmt)) {
            if (!password_verify($input_password, $hashed_password)) {
              $error = "Password incorrect";
            } else {
              session_start();
              //save data in session variable
              $_SESSION['loggedin'] = true;
              $_SESSION['id'] = $id;
              $_SESSION['name'] = $name;
              $_SESSION['role'] = $role;
              $_SESSION['email'] = $email;

              header("Location: index.php");
              exit();
            }
          }
        }
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
  <title>Store Manager| Login</title>
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
        Login
        <small>Login</small>
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
          <h3 class="box-title">Login</h3>

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
              <button type="submit" class="btn btn-primary">Login</button>
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