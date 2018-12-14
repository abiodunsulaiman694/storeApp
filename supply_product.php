<?php
require_once "config/connect_db.php";

session_start();

require_once "config/authchecker.php";

$id = trim($_GET['id']);
$sql = "SELECT * FROM products WHERE id = ?";
if ($stmt = mysqli_prepare($conn, $sql)) {
  mysqli_stmt_bind_param($stmt, "i", $id);
  if (mysqli_stmt_execute($stmt)) {
    $result = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($result) == 1) {
      $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
      $name = $row['name'];
      $price = $row['price'];
      $description = $row['description'];
      $expiry_date = $row['expiry_date'];
      $qty_left = $row['qty_left'];
    } else {
      header("Location: products.php");
      exit();
    }
  }
}


if($_SERVER["REQUEST_METHOD"] == "POST") {
  //validate
  $input_qty_left = trim($_POST['qty_received']);
  $input_supplier = trim($_POST['supplier']);
  $input_date_received = trim($_POST['date_received']);
  if (empty($input_qty_left) || empty($input_supplier) ) {
    $error = "Supplier and Quantity fields are compulsory";
  } else {
    $sql = "UPDATE products SET qty_left = ? WHERE id = ?";
    if ($stmt = mysqli_prepare($conn, $sql)) {
      //bind variables to statement
      $new_qty = $input_qty_left + $qty_left;
      mysqli_stmt_bind_param($stmt, "si", $new_qty, $id);
      if (mysqli_stmt_execute($stmt)) {
        //products updated successfully
        $sql_supply = "INSERT INTO supplies (product_id, supplier, quantity, date_supplied) VALUES (?, ?, ?, ?)";
        if($stmt_supply = mysqli_prepare($conn, $sql_supply)) {
          mysqli_stmt_bind_param($stmt_supply, "isss", $id, $input_supplier, $input_qty_left, $input_date_received);
          if (mysqli_stmt_execute($stmt_supply)) {
            //redirect to products page
            header("Location: products.php");
            exit();
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
  <title>Store Manager| Add new Supply</title>
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
        Add new Supply
        <small>Add new Supply</small>
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
          <h3 class="box-title">Add new Supply</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <!-- <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button> -->
          </div>
        </div>
        <div class="box-body">
          <form method="post" enctype="multipart/form-data">
            <div class="row form-group col-md-12">
              <div class="col-md-4">
                <label for="name">Name</label>
              </div>
                <div class="col-md-8">
                  <input type="text" name="name" id="name" class="form-control" required="" value="<?php echo $name; ?>" readonly>
                </div>
            </div>

            <div class="row form-group col-md-12">
              <div class="col-md-4">
                <label for="price">Price</label>
              </div>
                <div class="col-md-8">
                  <input type="text" name="price" id="price" class="form-control" required="" value="<?php echo $price; ?>" readonly>
                </div>
            </div>

            <div class="row form-group col-md-12">
              <div class="col-md-4">
              <label for="date_supplied">Date Supplied</label>
              </div>
                <div class="col-md-8">
                  <input type="date" name="date_supplied" id="date_supplied" class="form-control" required value="" />
                </div>
            </div>

            <div class="row form-group col-md-12">
              <div class="col-md-4">
              <label for="qty_received">Quantity Received</label>
              </div>
                <div class="col-md-8">
                  <input type="number" name="qty_received" id="qty_received" class="form-control" required value="" />
                </div>
            </div>

            <div class="row form-group col-md-12">
              <div class="col-md-4">
              <label for="supplier">Supplier</label>
              </div>
                <div class="col-md-8">
                  <input type="text" name="supplier" id="supplier" class="form-control" required value="" />
                </div>
            </div>

            <div class="row form-group col-md-12">
              <div class="col-md-4">
              <button type="submit" class="btn btn-primary">Add Supply</button>
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