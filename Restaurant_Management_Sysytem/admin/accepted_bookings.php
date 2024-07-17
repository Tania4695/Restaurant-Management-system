<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Accepted Booking</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">
   
   <style>
    .Accepted_bookings {
    font-family: Arial, sans-serif;
    font-size: 16px;
    color: #333;
    }
    
    .Accepted_bookings .heading {
    text-align: center;
    font-size: 24px;
    margin-bottom: 20px;
    }
    
    .Accepted_bookings table {
    border-collapse: collapse;
    width: 100%;
    margin-bottom: 20px;
    }
    
    .Accepted_bookings th, .Accepted_bookings td {
    text-align: left;
    padding: 8px;
    border: 1px solid #ddd;
    }
    
    .Accepted_bookings th {
    background-color: #f2f2f2;
    }
    
    .Accepted_bookings tr:nth-child(even) {
    background-color: #f2f2f2;
    }
    
    .Accepted_bookings tr:hover {
    background-color: #ddd;
    }
    

   </style>

</head>
<body>

<?php include '../components/admin_header.php' ?>
<section class="Accepted_bookings">
    <h1 class="heading">Accepted Bookings</h1>
    <h3>Bookings Details</h3>
    <table>
        <thead>
        <tr>
        <th>#</th>
        <th>Bookings No</th>
        <th>Name</th>
        <th>Email Id</th>
        <th>Mobile No</th>
        <th>No. Adults</th>
        <th>No of Childrens</th>
        <th>Boking Date/Time</th>
        <th>Posting Date</th>
        <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
            $show_acceptedBookings = $conn->prepare("SELECT * FROM `tblbookings` WHERE (boookingStatus='Accepted')");
            $show_acceptedBookings->execute();
            $cnt=1;
            while($fetch_acceptedBookings = $show_acceptedBookings->fetch(PDO::FETCH_ASSOC)){  
        ?>
        <tr>
            <td><?= $cnt;?></td>
            <td><?= $fetch_acceptedBookings['bookingNo']?></td>
            <td><?= $fetch_acceptedBookings['fullName']?></td>
            <td><?= $fetch_acceptedBookings['emailId']?></td>
            <td><?= $fetch_acceptedBookings['phoneNumber']?></td>
            <td><?= $fetch_acceptedBookings['noAdults']?></td>
            <td><?= $fetch_acceptedBookings['noChildrens']?></td>
            <td><?= $fetch_acceptedBookings['bookingDate']?>/<?= $fetch_acceptedBookings['bookingTime']?></td>
            <td><?= $fetch_acceptedBookings['postingDate']?></td>
            <th>
            <a href="booking_details.php?bid=<?= $fetch_acceptedBookings['id'];?>" title="View Details" class="btn btn-primary btn-xm"> View Details</a>
            </th>
        </tr>
         <?php $cnt++;} ?>
        </tbody>
        <tfoot>
        <tr>
        <th>#</th>
        <th>Bookings No</th>
        <th>Name</th>
        <th>Email Id</th>
        <th>Mobile No</th>
        <th>No. Adults</th>
        <th>No of Childrens</th>
        <th>Boking Date/Time</th>
            <th>Posting Date</th>
        <th>Action</th>
        </tr>
        </tfoot>
    </table>
</section>
<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>
