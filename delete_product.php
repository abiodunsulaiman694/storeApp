<?php
require_once "config/connect_db.php";


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
    } else {
      header("Location: products.php");
      exit();
    }
  }
}


if($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($id) ) {
    $error = "Product is compulsory";
  } else {
    $sql = "DELETE FROM products WHERE id = ?";
    if ($stmt = mysqli_prepare($conn, $sql)) {
      //bind variables to statement
      mysqli_stmt_bind_param($stmt, "i", $id);
      if (mysqli_stmt_execute($stmt)) {
        //products deleted successfully
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
  <title>Store Manager| Delete Product</title>
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
        Delete Product
        <small>Delete Product</small>
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
          <h3 class="box-title">Delete Product</h3>

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
                  <input type="text" name="name" id="name" class="form-control" readonly="" value="<?php echo $name; ?>">
                </div>
            </div>

            <div class="row form-group col-md-12">
              <div class="col-md-4">
                <label for="price">Price</label>
              </div>
                <div class="col-md-8">
                  <input type="text" name="price" id="price" class="form-control" readonly="" value="<?php echo $price; ?>">
                </div>
            </div>

            <div class="row form-group col-md-12">
              <div class="col-md-4">
              <label for="picture">picture</label>
              </div>
                <div class="col-md-8">
                  <input type="file" name="picture" id="picture" class="form-control" readonly>
                </div>
            </div>

            <div class="row form-group col-md-12">
              <div class="col-md-4">
              <label for="description">Description</label>
              </div>
                <div class="col-md-8">
                  <textarea name="description" id="description" class="form-control" readonly><?php echo $description; ?></textarea>
                </div>
            </div>

            <div class="row form-group col-md-12">
              <div class="col-md-4">
              <label for="expiry_date">Expiry Date</label>
              </div>
                <div class="col-md-8">
                  <input type="date" name="expiry_date" id="expiry_date" class="form-control" readonly value="<?php echo $expiry_date ?>" />
                </div>
            </div>

            <div class="row form-group col-md-12">
              <div class="col-md-4">
              <button type="submit" class="btn btn-danger">Delete Product</button>
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