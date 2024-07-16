<?php
include 'components/connect.php';
session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};
if(isset($_POST['submit'])){

$fname=$_POST['name'];
$fname = filter_var($fname, FILTER_SANITIZE_STRING);
$emailid=$_POST['email'];
$emailid = filter_var($emailid, FILTER_SANITIZE_STRING);
$phonenumber=$_POST['phonenumber'];
$phonenumber = filter_var($phonenumber, FILTER_SANITIZE_STRING);
$bookingdate=$_POST['bookingdate'];
$bookingtime=$_POST['bookingtime'];
$noadults=$_POST['noadults'];
$noadults = filter_var($noadults, FILTER_SANITIZE_STRING);
$nochildrens=$_POST['nochildrens'];
$nochildrens = filter_var($nochildrens, FILTER_SANITIZE_STRING);
$bno=mt_rand(100000000,9999999999);

$query=$conn->prepare("INSERT into `tblbookings` (bookingNo,fullName,emailId,phoneNumber,bookingDate,bookingTime,noAdults,noChildrens) values('$bno','$fname','$emailid','$phonenumber','$bookingdate','$bookingtime','$noadults','$nochildrens')");
$query->execute();

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Status</title>
    <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
    <style>
    .checkout form .box{
        margin:.7rem 0;
        font-size: 1.8rem;
        color: #222;
        border:.2rem #222 ;
        padding:1.4rem;
        width: 100%;
    } 
    </style>
    
</head>
<body>

<!-- header section starts  -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->

<div class="heading">
   <h3>Search Booking Status</h3>
   <p><a href="home.php">home</a> <span><a href="reservation.php"> / reservation</a></span><span>/Check Status</span></p>
</div>

<section class="checkout">
    <form action="search_result.php" method="post">
        <h3>Check Booking Status</h3>
        <input type="text" class="box" name="searchdata" placeholder="Search by booking no or contact no" required=""><br>
        <input type="submit" value="Search" name="submit" class="btn">
        <p style="font-size: 18px; padding:35px">Check Booking <a href="check_status.php" target="_blank">Status</a></p>
    </form>
</section>

<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->

<!-- custom js file link  -->
<script src="js/script.js"></script>
<

</body>
</html>
