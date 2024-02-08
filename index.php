<?php

$conn = new mysqli("localhost", "root", "", "newdb");

if($conn === false){
  die("ERROR: Could not connect. ".$mysqli->connect_error);
}

$query = "SELECT MAX(id) AS last_id FROM tbl_employees";

$result = $conn->query($query);

if ($result) {
  $row = $result->fetch_assoc();

  $last_id = $row['last_id'];
  
} else {
  echo "Error: " . $query . "<br>" . $mysqli->error;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Voucher Email</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
  <div class="container mt-4" style="padding-bottom: 50px;">
  <div class="row">
  <div class="col-md-6">
    <h2>Gift Voucher Form</h2>
    <form action="customer.php" method="get">
    <input type="number" name="id" value="<?php echo $last_id+1; ?>" hidden/>
	
		<div class="form-group">
        <label for="toField">Amount:</label>
        <input type="text" class="form-control" name="amount" id="amount" placeholder="Amount" required>
      </div>
      <!-- <div class="form-group">
        <label for="toField">To:</label>
        <input type="text" class="form-control" name="toField" id="toField" placeholder="Recipient's Name">
      </div> -->

      <!-- <div class="form-group">
        <label for="messageField">Personal Message:</label>
        <textarea class="form-control" id="messageField" name="messageField" rows="3" placeholder="Your personalized message"></textarea>
      </div> -->
<!-- 
      <div class="form-group">
        <label for="fromField">From:</label>
        <input type="text" class="form-control" name="fromField" id="fromField" placeholder="Your Name">
      </div> -->

      <div class="form-group">
        <label for="expiryDateField">Expiry Date:</label>
        <input type="date" class="form-control" name="expiryDateField" id="expiryDateField" required>
      </div>

      <div class="form-group">
        <label for="voucherCodeField">Voucher Code:</label>
        <input type="text" class="form-control" name="voucherCodeField" id="voucherCodeField" placeholder="Enter voucher code" required>
      </div>
		<div class="form-group">
        <label for="fromField">Email:</label>
        <input type="text" class="form-control" name="emailField" id="emailField" placeholder="To Email" required>
      </div>
      <button type="submit" class="btn btn-primary" name="sub">Send Customer</button>
    </form>
  </div>
  </div>
  </div>

  <!-- Bootstrap JS and Popper.js (optional, but needed for some Bootstrap features) -->
  <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> -->
</body>
</html>
