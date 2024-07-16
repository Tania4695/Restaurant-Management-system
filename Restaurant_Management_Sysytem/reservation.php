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
    // $emailid = filter_var($emailid, FILTER_SANITIZE_STRING);
    $bookingtime=$_POST['bookingtime'];
    // $emailid = filter_var($emailid, FILTER_SANITIZE_STRING);
    $noadults=$_POST['noadults'];
    $noadults = filter_var($noadults, FILTER_SANITIZE_STRING);
    $nochildrens=$_POST['nochildrens'];
    $nochildrens = filter_var($nochildrens, FILTER_SANITIZE_STRING);
    $bno=mt_rand(100000000,9999999999);
    //Code for Insertion
    $insert_message = $conn->prepare("INSERT INTO `tblbookings`(bookingNo, fullName, emailId, phoneNumber, bookingDate,bookingTime,noAdults,noChildrens) VALUES(?,?,?,?,?,?,?,?)");
    $insert_message->execute([$bno, $fname, $emailid, $phonenumber, $bookingdate, $bookingtime, $noadults, $nochildrens]);

    $message[] ='Your order sent successfully. Booking number is ' . $bno;
    // $query=mysqli_query($con,"insert into tblbookings(bookingNo,fullName,emailId,phoneNumber,bookingDate,bookingTime,noAdults,noChildrens) values('$bno','$fname','$emailid','$phonenumber','$bookingdate','$bookingtime','$noadults','$nochildrens')");
    // if($query){
    // echo '<script>alert("Your order sent successfully. Booking number is "+"'.$bno.'")</script>';
    // echo "<script type='text/javascript'> document.location = 'reservation.php'; </script>";
    // } else {
    // echo "<script>alert('Something went wrong. Please try again.');</script>";
    // }
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table Reservation</title>
    <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
    
</head>
<body>
<!-- header section starts  -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->

<div class="heading">
   <h3>Table Reservation</h3>
   <p><a href="home.php">home</a> <span> / reservation</span></p>
</div>

<!-- reservation section starts  -->
<section class="appointment-w3">

    <div class="row">

        <div class="image">
            <img src="images/reservation-img.svg" alt="">
        </div>

        <form action="#" method="post">
            <h3>Table Booking Form</h3>
            <input type="text" class="box" name="name" placeholder="Name" required=""><br>
            <input type="email" class="box" name="email" placeholder="Email" required=""><br>
            <input type="number" class="box" name="phonenumber" placeholder="Phone Number" required="" min="0" max="99999999999" maxlength="11"><br>
            <input type="text" class="box" id="datepicker" name="bookingdate" placeholder="Booking date" required="" onfocus="this.type='date'" onblur="this.type='text'"><br>
            <input type="text" class="box" id="timepicker" name="bookingtime" placeholder="Time" required="" onkeypress="return false;" onfocus="this.type='time'" onblur="this.type='text'">

            <div class="form-left-w3l">
                <select class="form-control" name="noadults" required>
                    <option value="">Number of Adults</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                </select>
            </div>
            <div class="form-right-w3ls">
                <select class="form-control" name="nochildrens" required>
                    <option value="">Number of Children</option>
                    <option value="1">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                </select>
            </div>
            
            <input type="submit" value="Reserve a Table" name="submit" class="btn">
            
            <p style="font-size: 18px; padding:35px">Already Booked? Check Booking <a href="check_status.php" target="_blank">Status</a></p>
        
        </form>
        
    </div>
</section>

<!-- reservation section ends -->
    
<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->


<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
