<?php require_once '../config/connect_db.php'; ?>
<?php 
session_start();
require_once "../config/authchecker.php";
//select query
$sql = "SELECT * FROM products";
if ($result = mysqli_query($conn, $sql)) {
  $total_products = mysqli_num_rows($result);
} else {
  $error_msg = "Error fetching products from database";
}

$rowId = trim($_GET['id']);

?>


<table class="table table-striped">
	<thead>
	  <tr>
	    <th>Name</th>
	    <th>Price</th>
	    <th>Qty Left</th>
	    <th>Expiry Date</th>
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
	      echo "<td>
	              <button class='btn btn-info btn-sm' data-dismiss='modal' onclick='pick_product(\"".$product['id']."\", \"".$product['name']."\", \"".$product['price']."\", \"".$rowId."\")'
	              >Select</button>
	            </td>";

	    echo "</tr>";
	  } ?>
	</tbody>
	</table>




