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