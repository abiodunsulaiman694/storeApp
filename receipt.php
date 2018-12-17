<?php require_once 'config/connect_db.php'; ?>
<?php 
session_start();

require_once "config/authchecker.php";
$batch_code = htmlentities(trim($_GET['batch_code']));
//select query
$sql = "SELECT * FROM products WHERE batch_code = ".$batch_code;
if ($result = mysqli_query($conn, $sql)) {
  $total_sales = mysqli_num_rows($result);
} else {
  header("Location: sales.php");
  exit();
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Store Manager| Receipt</title>
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
        Products
        <a href="create_product.php" class="btn btn-info">
          <i class="fa fa-plus"></i>
        Create new Product
      </a>
        <small>All products in StoreManager</small>
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
          <h3 class="box-title">Receipt</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <!-- <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button> -->
          </div>
        </div>
        <div class="box-body">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Total</th>
                <th>Date Sold</th>
              </tr>
            </thead>
            <tbody>
              <?php while ($sale = mysqli_fetch_array($result)) {
                echo "<tr>";
                  echo "<td>" . $sale['product_name'] .   "</td>";
                  echo "<td>" . $sale['unit_price'] . "</td>";
                  echo "<td>" . $sale['quantity'] . "</td>";
                  echo "<td>" . $sale['line_total'] . "</td>";
                  echo "<td>" . $sale['date_created'] . "</td>";

                echo "</tr>";
              } ?>
            </tbody>
          </table>
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