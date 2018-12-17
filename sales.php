<?php
session_start();

require_once "config/authchecker.php";
require_once "config/connect_db.php";

if($_SERVER["REQUEST_METHOD"] == "POST") {
  //validate
  //$original = "   bryta hub   ";
  $input_id = $_POST['id'];
  $input_name = $_POST['name'];
  $input_qty = $_POST['qty'];
  $input_price = $_POST['price'];
  $input_line_total = $_POST['line_total'];
  $batch_code = "SALES".time();

  // var_dump($input_id[1]);
  // exit();

  for ($i=0; $i < sizeof($input_id); $i++) { 
    $id = $input_id[$i];
    $name = $input_name[$i];
    $qty = $input_qty[$i];
    $price = $input_price[$i];
    $line_total = $input_line_total[$i];

    $sql = "INSERT INTO sales (product_id, quantity, unit_price, line_total, created_by, product_name, batch_code, user_name) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    if ($stmt = mysqli_prepare($conn, $sql)) {
      mysqli_stmt_bind_param($stmt, "isssssss", $id, $qty, $price, $line_total, $_SESSION['id'], $name, $batch_code, $_SESSION['name']);
      if (mysqli_stmt_execute($stmt)) {
        //yay!
        $sql_fetch = "SELECT qty_left FROM products WHERE id = ?";
        if ($stmt_fetch = mysqli_prepare($conn, $sql_fetch)) {
          mysqli_stmt_bind_param($stmt_fetch, "i", $id);
          if (mysqli_stmt_execute($stmt_fetch)) {
            $result_fetch = mysqli_stmt_get_result($stmt_fetch);
            if (mysqli_num_rows($result_fetch) == 1) {
              $row = mysqli_fetch_array($result_fetch, MYSQLI_ASSOC);
              $original_qty = $row['qty_left'];
            }
          }
        }

        $remaining_qty = $original_qty - $qty;
        $sql_u = "UPDATE products SET qty_left = ? WHERE id = ?";
        if ($stmt_u = mysqli_prepare($conn, $sql_u)) {
          //bind variables to statement
          mysqli_stmt_bind_param($stmt_u, "ii", $remaining_qty, $id);
          if (mysqli_stmt_execute($stmt_u)) {
            //products updated successfully
            //redirect to products page
            if ( $i === (sizeof($input_id)-1) ) {
            header("Location: receipt.php?batch_code=".$batch_code);
            exit();
            }
          }
        }
    } else {
        $error = "Unable to save";
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
          <form method="post">
            <table id="sales" class="table table-bordered">
              <thead>
                <tr>
                  <th>Product</th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th>Total</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <tr id="sales1">
                  <td colspan="5">
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#salesModal" onclick="selectProduct('1')">
                      Select Product
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>

            <div class="pull-right">
              <button type="button" class="btn btn-info btn-sm" onclick="addProduct()">
                <i class="fa fa-plus"></i>
                Add Product
              </button>
            </div>
            <h3>
              Grand Total:
              &#8358; <span id="grand_total">0</span>
            </h3>

            <div style="clear: both;"></div>
            <div class="pull-right">
              <button type="submit" class="btn btn-primary btn-lg">
                <i class="fa fa-save"></i>
                Record Sales
              </button>
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
  <?php include('partials/modal.php') ?>
</div>
<!-- ./wrapper -->

<?php include('partials/scripts.php') ?>
<script>
  COUNTER = 1;

  function selectProduct(rowId) {
    //alert("you");
    var pModal = document.getElementById('productsModal');
    pModal.innerHTML = '<div class="text-info text-center">Loading... Just a moment</div>';
    $('#productsModal').load('http://localhost/storemanager/partials/productsModal.php?id='+rowId);
  }
  function addProduct() {
    COUNTER++;
    var sales = document.getElementById('sales');
    var row = sales.insertRow(-1);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    cell1.colSpan = 4;
    cell1.innerHTML = `<button type="button" class="btn btn-info" data-toggle="modal" data-target="#salesModal" onclick="selectProduct(${COUNTER})">
                    Select Product
                  </button>`;
    row.id = "sales"+COUNTER;
    cell2.innerHTML = `<button type="button" class="btn btn-danger btn-xs" onclick="delete_product(this)">
        <i class="fa fa-trash"></i>
    </button>`;
  }
  function delete_product(el) {
    var rowId = el.parentNode.parentNode.rowIndex;
    document.getElementById('sales').deleteRow(rowId);
    grand_total();
  }
  function pick_product(id, name, price, rowId) {
    var row = document.getElementById('sales'+rowId);
    row.innerHTML = `
        <td style="display: flex; justify-content: space-between">
        <div>
        <strong>${name}</strong>
        </div>
        <div>
        <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#salesModal" onclick="selectProduct(${rowId})">
                    <i class="fa fa-edit"></i>
                  </button>
        <input type="hidden" name="id[]" value="${id}" />
        <input type="hidden" name="name[]" value="${name}" />
        </div>
        </td>
        <td>${price.toLocaleString()}</td>
        <td>
          <input type="number" class ="form-control" value="1" name="qty[]" id="qty${rowId}" onkeyup="line_total('${rowId}')" />
        </td>
        <td>
          <input type="hidden" name="price[]" value="${price}" id="price${rowId}" />
          <input type="hidden" name="line_total[]" value="${price}" id="line_total_hd${rowId}" class="line_total" />
          <strong><span id="line_total${rowId}">${price.toLocaleString()}</span></strong>
        </td>
        <td>
        <button type="button" class="btn btn-danger btn-xs" onclick="delete_product(this)">
        <i class="fa fa-trash"></i>
    </button>
        </td>
                    `;
    grand_total();
  }
  function line_total(rowId)
  {
    var qty = document.getElementById('qty'+rowId);
    var price = document.getElementById('price'+rowId);
    var line_total = document.getElementById('line_total'+rowId);
    var line_total_hd = document.getElementById('line_total_hd'+rowId);

    var qty_value = qty.value;
    var price_value = price.value;

    if (qty_value < 1 || isNaN(qty_value)) {
      qty_value = 1;
      qty.value = 1;
    }

    var result = qty_value*price_value;

    line_total_hd.value = result;
    line_total.innerHTML = result.toLocaleString();

    grand_total();

  }
  function grand_total()
  {
    var line_totals =document.getElementsByClassName('line_total');
    var grand_total = document.getElementById('grand_total');
    //console.log(line_totals.length);
    var sum = 0;
    for (var i = 0; i < line_totals.length; i++) {
      sum = sum + parseFloat(line_totals[i].value);
      //sum += line_totals[i].value;
    }
    grand_total.innerHTML = sum.toLocaleString();
  }
</script>












</body>
</html>