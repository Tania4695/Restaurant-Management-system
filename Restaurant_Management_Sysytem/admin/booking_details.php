<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}
else{

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Booking Details</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

   <style>
    .Booking_details {
    font-family: Arial, sans-serif;
    font-size: 16px;
    color: #333;
    }

    .Booking_details .heading {
    text-align: center;
    font-size: 24px;
    margin-bottom: 20px;
    }

    .Booking_details table {
    border-collapse: collapse;
    width: 100%;
    margin-bottom: 20px;
    }

    .Booking_details th, .Booking_details td {
    text-align: left;
    padding: 8px;
    border: 1px solid #ddd;
    }

    .Booking_details th {
    background-color: #f2f2f2;
    }

    .Booking_details tr:nth-child(even) {
    background-color: #f2f2f2;
    }

    .Booking_details tr:hover {
    background-color: #ddd;
    }

    .btn {
        width: 200px;
    }


    </style>

</head>

<body>

<?php include '../components/admin_header.php' ?>

<section class="Booking_details">

<h1 class="heading">Booking Details</h1>
<h3 >Booking Details</h3>
<table>
    <tbody>
    <?php 
        $bid = $_GET['bid'];
        $show_bookingdetails=$conn->prepare("SELECT * from `tblbookings` where (id='$bid')");
        $show_bookingdetails->execute();
        $cnt=1;
        while($fetch_bookingdetails = $show_bookingdetails->fetch(PDO::FETCH_ASSOC)){
    ?>
        <tr>
        <th>Booking Number</th>
        <td colspan="3"><?= $fetch_bookingdetails['bookingNo']?></td>
        </tr>

        <tr>
        <th> Name</th>
        <td><?= $fetch_bookingdetails['fullName']?></td>
        <th>Email Id</th>
        <td> <?= $fetch_bookingdetails['emailId']?></td>
        </tr>

        <tr>
        <th> Mobile No</th>
        <td><?= $fetch_bookingdetails['phoneNumber']?></td>
        <th>No of Adults</th>
        <td><?= $fetch_bookingdetails['noAdults']?></td>
        </tr>

        <tr>
        <th>No of Childs</th>
        <td><?= $fetch_bookingdetails['noChildrens']?></td>
        <th>Booking Date / Time</th>
        <td><?= $date= $fetch_bookingdetails['bookingDate']?>/<?= $btime= $fetch_bookingdetails['bookingTime']?></td>
        </tr>

        <tr>
        <th>Posting Date</th>
        <td colspan="3"p><?= $fetch_bookingdetails['postingDate']?></td>
        </tr>
    <?php if($fetch_bookingdetails['boookingStatus']!=''):?>
        <tr>
        <th>Booking  Status</th>
        <td><?=$fetch_bookingdetails['boookingStatus']?></td>
        <th>Updation Date</th>
        <td><?= $fetch_bookingdetails['updationDate']?></td>
        </tr>

        <tr>
        <th> Remark</th>
        <td colspan="3"><?= $fetch_bookingdetails['adminremark']?></td>
        </tr>

    <?php endif;?>
    <?php if($fetch_bookingdetails['boookingStatus']==''):?>
        <tr>
        <td colspan="4" style="text-align:center;">
        <a href="update_bookingStatus.php?bid=<?= $bid; ?>" title="Update Status" class="btn btn-primary btn-xm"> Take Action</a>
        <!-- <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Take Action</button> -->
        </td>
    <?php endif;?>

    <?php $cnt++;} ?>

    </tbody>
</table>

</section>


<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>


</body>
</html>
<?php } ?>
