<?php

$conn = new mysqli("localhost", "root", "", "newdb");

if($_SERVER["REQUEST_METHOD"] === "GET"){
  $id = $_GET['id'];
  $expiryDate = $_GET['expiryDateField'];
	$voucherCode = $_GET['voucherCodeField'];
	$email = $_GET['emailField'];
	$amount = $_GET['amount'];

  if($conn === false){
    die("ERROR: Could not connect. ".$mysqli->connect_error);
  }

  $sql = "INSERT INTO tbl_employees( id, amount, expiry, code, address) VALUES( '$id','$amount', '$expiryDate', '$voucherCode', '$email')";
  if ($conn->query($sql) === TRUE) {
    echo '<script language="javascript">';
    echo 'alert("Voucher successfully sent")';
    echo '</script>';
  } else {
      echo "Error creating database: " . $conn->error;
  }
}
if($_SERVER["REQUEST_METHOD"] === "POST"){
  $messageField = $_POST['messageField'];
  $last_id = $_POST['last_id'];
  $to = $_POST['toField'];
  $from = $_POST['fromField'];

  	$message = '
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Template</title>
    <style>
      body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
      }
      
      h1 {
        color: #fff;
      }
      p {
        color: #555555;
      }
      .logo {
        margin-bottom: 20px;
      }
      .button {
        display: inline-block;
        padding: 10px 20px;
        text-decoration: none;
        background-color: #3498db;
        color: #ffffff;
        border-radius: 5px;
      }
      .content-container {
        background: #0f1247;
        padding: 20px 20px;
      }
      .left-content {
        text-align: left;
      }
      .left-content p {
        color: #fff;
        margin-bottom: 0px;
        margin-top: 9px;
      }
      .center-content {
        margin-top: 40px;
      }
      .center-content p {
        color: #fff;
        margin-bottom: 0px;
        margin-top: 9px;
      }
    </style>
  </head>
  <body>
    <table class="container" style="width: 550px; margin: 0 auto; padding: 22px 40px; background-color: #4d2269; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); text-align: center;">
      <tr>
        <td>
          <table width="100%" cellspacing="0" cellpadding="0">
            <tr>
              <td class="logo">
                <img src="https://tjmedia.co.uk/gift/logo.png" alt="Logo" width="250" style="margin-bottom: 30px;">
              </td>
            </tr>
            <tr>
              <td class="content-container" >
  				<img src="https://tjmedia.co.uk/gift/gift.png" alt="Logo" width="150" style="margin-bottom: 0px;">
                <h1 style="margin-top: 0;">£'.$amount.'</h1>
                <table width="100%" class="left-content">
                  <tr>
                    <td>
                      <p><b>TO: '.$to.'</b></p>
                      <p><b>'.$messageField.'</b></p>
                      <br>
                      <br>
                      <p><b>FROM: '.$from.'</b></p>
                      <p><b>Expiry Date: '.$expiryDate.'</b></p>
                      <p><b>Voucher Code: '.$voucherCode.'</b></p>
                    </td>
                  </tr>
                </table>
                <table width="100%" class="center-content">
                  <tr>
                    <td>
                      <p><b>Use Online at</b></p>
                      <p><b>www.boulevardnewcastle.co.uk</b></p>
                      <p><b>or call the box office on</b></p>
                      <p><b>0191 250 7068</b></p>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </body>
  </html>
  ';
  	$to=$email;
  $headers = "MIME-Version: 1.0\r\n";
  $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
  $headers .= 'From: Boulevard Newcastle <noreply@boulevardnewcastle.co.uk>'. "\r\n";
  $headers .= 'To: '.$to . "\r\n";
  $subject = 'Here Is Your Voucher | Boulevard Newcastle | ';

  $query = "DELETE FROM tbl_employees WHERE id='$last_id'";

  $ff = mail($to,$subject,$message,$headers);
  if($ff && $conn->query($query)=== TRUE){
      $amount="";
      $expiryDate= "";
      $voucherCode = "";
  		echo '<script language="javascript">';
  		echo 'alert("Voucher successfully sent")';
  		echo '</script>';
  }

}

$conn->close();

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Voucher Email</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
  <div class="container mt-4" style="padding-bottom: 50px;">
  <div class="row">
  <div class="col-md-6">
    <h2>Gift Voucher Form</h2>
    <form action="customer.php" method="post">
    <input type="number" name="last_id" value="<?php echo $id; ?>" hidden/>
	
		<div class="form-group">
        <label for="toField">Amount:</label>
        <input type="text" class="form-control" name="amount" id="amount" placeholder="Amount" value="<?php if($amount){echo $amount;}else{echo '';} ?>" disabled>
      </div>
      <div class="form-group">
        <label for="toField">To:</label>
        <input type="text" class="form-control" name="toField" id="toField" placeholder="Recipient's Name">
      </div>

      <div class="form-group">
        <label for="messageField">Personal Message:</label>
        <textarea class="form-control" id="messageField" name="messageField" rows="3" placeholder="Your personalized message"></textarea>
      </div>

      <div class="form-group">
        <label for="fromField">From:</label>
        <input type="text" class="form-control" name="fromField" id="fromField" placeholder="Your Name">
      </div>

      <div class="form-group">
        <label for="expiryDateField">Expiry Date:</label>
        <input type="date" class="form-control" name="expiryDateField" id="expiryDateField" value="<?php if($expiryDate){echo $expiryDate;}else{echo '';} ?>" disabled>
      </div>

      <div class="form-group">
        <label for="voucherCodeField">Voucher Code:</label>
        <input type="text" class="form-control" name="voucherCodeField" id="voucherCodeField" placeholder="Enter voucher code" value="<?php if($voucherCode){echo $voucherCode;}else{echo '';} ?>" disabled>
      </div>
		<div class="form-group">
        <label for="fromField">Email:</label>
        <input type="text" class="form-control" name="emailField" id="emailField" placeholder="To Email">
      </div>
      <button type="submit" class="btn btn-primary" name="submit">Send Voucher</button>
    </form>
  </div>
  </div>
  </div>
  <!-- Bootstrap JS and Popper.js (optional, but needed for some Bootstrap features) -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
