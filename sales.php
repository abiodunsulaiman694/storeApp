<?php
session_start();


require_once "config/authchecker.php";
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Store Manager| Sales</title>
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
        Sales
        <small>All sales in StoreManager</small>
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
          <h3 class="box-title">Sales</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <!-- <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button> -->
          </div>
        </div>
        <div class="box-body">
          
          <table id="sales" class="table table-bordered">
            <thead>
              <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody>
              <tr id="sales1">
                <td colspan="4">
                  <button class="btn btn-info" data-toggle="modal" data-target="#salesModal" onclick="selectProduct()">
                    Select Product
                  </button>
                </td>
              </tr>
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
  <?php include('partials/modal.php') ?>
</div>
<!-- ./wrapper -->

<?php include('partials/scripts.php') ?>
<script>
  function selectProduct() {
    //alert("you");
  }
</script>












</body>
</html>