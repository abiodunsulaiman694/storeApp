<?php



require_once "config/connect_db.php";
$name = ""; $price = ""; $picture = "";
$description = ""; $expiry_date = ""; $supplier = ""; $date_supplied; $qty = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
  //validate
  $input_name = trim($_POST['name']);
  $input_price = trim($_POST['price']);
  $input_description = trim($_POST['description']);
  $input_expiry_date = trim($_POST['expiry_date']);
  $input_date_supplied = trim($_POST['date_supplied']);
  $input_supplier = trim($_POST['supplier']);
  $input_qty_left = trim($_POST['qty_left']);

  if (empty($input_name) || empty($input_price) || empty($input_qty_left)) {
    $error = "Name, Price and Quantity fields are compulsory";
  } else {
    $sql = "INSERT INTO products (name, price, description, qty_left, expiry_date) VALUES (?, ?, ?, ?, ?)";
    if ($stmt = mysqli_prepare($conn, $sql)) {
      //bind variables to statement
      mysqli_stmt_bind_param($stmt, "sssss", $param_name, $param_price, $param_description, $param_qty_left, $param_expiry_date);
      $param_name = $input_name;
      $param_price = $input_price;
      $param_description = $input_description;
      $param_expiry_date = $input_expiry_date;
      $param_qty_left = $input_qty_left;
      //attempt to execute statement on database
      if (mysqli_stmt_execute($stmt)) {
        //products created successfully
        //redirect to products page
        header("Location: products.php");
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
  <title>Store Manager| Create new Product</title>
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
        Create new Product
        <small>Create new Product</small>
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
          <h3 class="box-title">Create new Product</h3>

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
                  <input type="text" name="name" id="name" class="form-control" required="">
                </div>
            </div>

            <div class="row form-group col-md-12">
              <div class="col-md-4">
                <label for="price">Price</label>
              </div>
                <div class="col-md-8">
                  <input type="text" name="price" id="price" class="form-control" required="">
                </div>
            </div>

            <div class="row form-group col-md-12">
              <div class="col-md-4">
              <label for="picture">picture</label>
              </div>
                <div class="col-md-8">
                  <input type="file" name="picture" id="picture" class="form-control" required="">
                </div>
            </div>

            <div class="row form-group col-md-12">
              <div class="col-md-4">
              <label for="description">description</label>
              </div>
                <div class="col-md-8">
                  <textarea name="description" id="description" class="form-control" required></textarea>
                </div>
            </div>

            <div class="row form-group col-md-12">
              <div class="col-md-4">
              <label for="expiry_date">Expiry Date</label>
              </div>
                <div class="col-md-8">
                  <input type="date" name="expiry_date" id="expiry_date" class="form-control" required />
                </div>
            </div>

            <div class="row form-group col-md-12">
              <div class="col-md-4">
              <label for="supplier">Supplier</label>
              </div>
                <div class="col-md-8">
                  <input type="text" name="supplier" id="supplier" class="form-control" required />
                </div>
            </div>

            <div class="row form-group col-md-12">
              <div class="col-md-4">
              <label for="date_supplied">Date Supplied</label>
              </div>
                <div class="col-md-8">
                  <input type="date" name="date_supplied" id="date_supplied" class="form-control" required />
                </div>
            </div>

            <div class="row form-group col-md-12">
              <div class="col-md-4">
              <label for="qty_left">Qty Received</label>
              </div>
                <div class="col-md-8">
                  <input type="number" name="qty_left" id="qty_left" class="form-control" required />
                </div>
            </div>

            <div class="row form-group col-md-12">
              <div class="col-md-4">
              <button type="submit" class="btn btn-primary">Save new Product</button>
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