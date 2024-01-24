<?php
/**
 * Created by Vishnu
 * Date: 24.01.2024
 */
require_once("functions.php");
// Fetch data
$tableName = "customers";
$books = fetchData($tableName, "", "", "",""); 

// Filter data based on form submission
$customerName = isset($_POST['customerName']) ? $_POST['customerName'] : '';
$productName = isset($_POST['productName']) ? $_POST['productName'] : '';
$priceFilter = isset($_POST['priceFilter']) ? floatval($_POST['priceFilter']) : null;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['filter_data'])) {
  $books = fetchData($tableName, $customerName, $productName, $priceFilter);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_records'])) {
    deleteAllRecordsFromDatabase($tableName); //clearing all records from database
    header("Location: index.php");
} 

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Book Stall</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>

  .table-container {
      max-height: 400px; 
      overflow: auto;
  }
  table {
    border-collapse: collapse;
    width: 100%;
  }

  th, td {
    padding: 8px;
    text-align: center;
    border-bottom: 1px solid #ddd;
  }

  th {
      background-color: #f2f2f2;
  }
  </style>
</head>
<body>

<div class="jumbotron text-center">
  <h2>Sales Information</h2>
  <p>Please upload your Json File to import sales details</p> 
  <div class="col-sm-4">  </div>
  <div class="col-sm-4">
	    <form id="customers" name="customers" action="script.php" method="POST" enctype="multipart/form-data" >
        <div class="form-group">
          <input id="bookFile" name="bookFile" type="file" accept=".json" class="form-control" required="required"/> 
        </div>
        <div class="form-group">
          <input type="submit" name="submit" id="submit" class="btn btn-primary"/>
          <button type="button" class="btn btn-secondary" onclick="resetForm()">Reset</button>
        </div>
	    </form>
	</div>
  <div class="col-sm-4">  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <div class="row">
        <div class="col-sm-12" style="text-align: right;">  
          <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" autocomplete="off">
            <div class="form-group">
              <div class="col-sm-3">  
                <input type="text" id="customerName" name="customerName" placeholder="Enter customer name..." value = "<?php echo $customerName; ?>" class="form-control">
              </div>
              <div class="col-sm-3">  
                <input type="text" id="productName" name="productName" placeholder="Enter product name..."value = "<?php echo $productName; ?>" class="form-control">
              </div>
              <div class="col-sm-3">  
                <input type="text" id="priceFilter" name="priceFilter" placeholder="Enter price..." value = "<?php echo $priceFilter; ?>" class="form-control">
              </div>
              <div class="col-sm-1"> 
                <input type="submit" value="Filter" class="form-control btn btn-success" name="filter_data">
              </div>
              <div class="col-sm-2"> 
                <button type="submit" class="form-control btn btn-danger" name="delete_records">Delete All Records</button>
              </div> <br><br>
            </div>
          </form>
        </div>
      </div>
      <?php if (isset($successMessage)): ?>
        <div class="alert alert-success" role="alert">
          <?php echo $successMessage; ?>
        </div>
      <?php endif; ?>
      <div class="row">
        <div class="col-sm-12 table-container" >
          <table id="custTable">
            <thead>
                <tr>
                  <th> # </th>
                  <th>Customer Name</th>
                  <th>Email ID</th>
                  <th>Product Name</th>
                  <th>Date</th>
                  <th>Price</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $totalPrice = 0;
            if($books) {
              $slNo = 0;
              foreach($books as $customerRecord) {
                $slNo++;
                $totalPrice += $customerRecord['product_price'];
            ?>
            
            <tr>
              <td><?php echo $slNo; ?></td>
              <td><?php echo $customerRecord['customer_name']; ?></td>
              <td><?php echo $customerRecord['customer_mail']; ?></td>
              <td><?php echo $customerRecord['product_name']; ?></td>
              <td><?php echo date("d/m/y H:i:s", strtotime($customerRecord['sale_date'])); ?></td> 
              <td><?php echo $customerRecord['product_price']; ?> €</td>
            </tr>
            
            <?php
              }
            } else {
            ?>
            <tr>
              <td colspan='6'>No Record(s) found</td>
            </tr> 
            <?php
            }
            ?>
            </tbody>
            <tfoot>
                <tr id="totalPriceRow">
                    <td colspan="5"><b>Total Price:</b></td>
                    <td id="totalPrice"><b><?php echo $totalPrice; ?> €</b></td>
                    <td> </td>
                </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
    function resetForm() {
        // Reload the current page
        location.href = "index.php";
    }
</script>
</body>
</html>
