<?php
session_start();

require_once "config/authchecker.php";
require_once "config/connect_db.php";

$start_date = date('Y-m')."-01";
$end_date = date('Y-m')."-31";
$sql = "SELECT SUM(line_total) AS total FROM sales WHERE date_created BETWEEN ? AND ? ";
$total = 0;
if ($stmt = mysqli_prepare($conn, $sql)) {
  mysqli_stmt_bind_param($stmt, "ss", $start_date, $end_date);
    //var_dump($stmt);
  if (mysqli_stmt_execute($stmt)) {
    $result = mysqli_stmt_get_result($stmt);
      $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
      $total = $row['total'];
  }
}

require_once "config/authchecker.php";
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Store Manager| Home Page</title>
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
        Dashboard
        <small>it all starts here</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Dashboard</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-4">
              <div class="info-box">
                <span class="info-box-icon bg-green">
                  <i class="ion ion-ios-cart-outline"></i>
                </span>
                <div class="info-box-content">
                  <span class="info-box-text">
                    Sales
                  </span>
                  <span class="info-box-number">
                    &#8358; 700
                  </span>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="info-box">
                <span class="info-box-icon bg-red">
                  <i class="ion ion-ios-cart-outline"></i>
                </span>
                <div class="info-box-content">
                  <span class="info-box-text">
                    Monthly Sales
                  </span>
                  <span class="info-box-number">
                    &#8358; <?php echo number_format($total, 2); ?>
                  </span>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="info-box">
                <span class="info-box-icon bg-aqua">
                  <i class="ion ion-ios-cart-outline"></i>
                </span>
                <div class="info-box-content">
                  <span class="info-box-text">
                    Sales
                  </span>
                  <span class="info-box-number">
                    &#8358; 0
                  </span>
                </div>
              </div>
            </div>
          </div>
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