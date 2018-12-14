<?php require_once 'config/connect_db.php'; ?>
<?php 
session_start();

require_once "config/authchecker.php";
//select query
$sql = "SELECT * FROM products";
if ($result = mysqli_query($conn, $sql)) {
  $total_products = mysqli_num_rows($result);
} else {
  $error_msg = "Error fetching products from database";
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Store Manager| Products</title>
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
          <h3 class="box-title">Products</h3>

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
                <th>Name</th>
                <th>Price</th>
                <th>Qty Left</th>
                <th>Expiry Date</th>
                <th>Date Created</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php while ($product = mysqli_fetch_array($result)) {
                echo "<tr>";
                  echo "<td>" . $product['name'] .   "</td>";
                  echo "<td>" . $product['price'] . "</td>";
                  echo "<td>" . $product['qty_left'] . "</td>";
                  echo "<td>" . $product['expiry_date'] . "</td>";
                  echo "<td>" . $product['date_created'] . "</td>";
                  echo "<td>
                          <a class='btn btn-info' href='edit_product.php?id=".$product['id']."'>Edit</a>
                          <a class='btn btn-danger' href='delete_product.php?id=".$product['id']."'>Delete</a>
                          <a class='btn btn-warning' href='supply_product.php?id=".$product['id']."'>Add Supply</a>
                        </td>";

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