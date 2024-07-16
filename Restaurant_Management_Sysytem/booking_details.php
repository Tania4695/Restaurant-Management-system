<?php
include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>details</title>
    <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

   <style>
   .booking-details {
    font-family: Arial, sans-serif;
    font-size: 16px;
    color: #333;
   }

   .booking-details table {
    border-collapse: collapse;
    width: 100%;
    margin-bottom: 20px;
   }

   .booking-details th, .booking-details td {
    text-align: left;
    padding: 8px;
    border: 1px solid #ddd;
   }

   .booking-details th {
    background-color: #f2f2f2;
   }
   .booking-details tr:hover {
    background-color: #ddd;
   }
  
    </style>
    
</head>
<body>
<!-- header section starts  -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->
<section class="booking-details">
<h3>Booking Details</h3>
<table>
   <tbody>
      <?php $bid = $_GET['bid'];
      $query=$conn->prepare("SELECT * from `tblbookings` where id='$bid'");
      $query->execute();
      $cnt=1;
      while($result= $query->fetch(PDO::FETCH_ASSOC)){
      ?>
      <tr>
      <th>Booking Number</th>
         <td colspan="3"><?php echo $result['bookingNo']?></td>
      </tr>

      <tr>
      <th> Name</th>
         <td><?=$result['fullName']?></td>
         <th>Email Id</th>
         <td> <?=$result['emailId']?></td>
      </tr>

      <tr>
         <th> Mobile No</th>
         <td><?=$result['phoneNumber']?></td>
         <th>No of Adults</th>
         <td><?=$result['noAdults']?></td>
      </tr>

      <tr>
         <th>No of Childs</th>
         <td><?= $result['noChildrens']?></td>
         <th>Booking Date / Time</th>
         <td><?=$date=$result['bookingDate']?>/<?=$btime=$result['bookingTime']?></td>
      </tr>

      <tr>
      <th>Posting Date</th>
         <td colspan="3"><?=$result['postingDate']?></td>
      </tr>

      <?php if($result['boookingStatus']!=''):?>
         <tr>
            <th>Booking  Status</th>
            <td><?= $result['boookingStatus']?></td>
            <th>Updation Date</th>
            <td><?= $result['updationDate']?></td>
         </tr>

         <tr>
            <th> Remark</th>
            <td colspan="3"><?= $result['adminremark']?></td>
         </tr>
      <?php endif;?>
      
      <?php $cnt++;} ?>

   </tbody>
</table>
</section>


<!-- custom js file link  -->
<script src="js/script.js"></script>
</body>
</html>
