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
    <title>Search</title>
    <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
    <style>
    .search-results {
    font-family: Arial, sans-serif;
    font-size: 16px;
    color: #333;
    }
    
    .search-results table {
    border-collapse: collapse;
    width: 100%;
    margin-bottom: 20px;
    }
    
    .search-results th, .search-results td {
    text-align: left;
    padding: 8px;
    border: 1px solid #ddd;
    }
    
    .search-results th {
    background-color: #f2f2f2;
    }
    
    .search-results tr:nth-child(even) {
    background-color: #f2f2f2;
    }
    
    .search-results tr:hover {
    background-color: #ddd;
    }
    

   </style>

</head>
<body>
<!-- header section starts  -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->

<section class="search-results">
<h3>search Results against '<?=$_POST['searchdata'];?>'</h3>
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
    $sdata=$_POST['searchdata'];
    $query=$conn->prepare("SELECT * from `tblbookings` where bookingNo like '%$sdata%' || phoneNumber like '%$sdata%'");
    $query->execute();
    $cnt=1;
    while($result= $query->fetch(PDO::FETCH_ASSOC)){
?>

    <tr>
        <td><?=$cnt;?></td>
        <td><?=$result['bookingNo']?></td>
        <td><?=$result['fullName']?></td>
        <td><?=$result['emailId']?></td>
        <td><?=$result['phoneNumber']?></td>
        <td><?=$result['noAdults']?></td>
        <td><?=$result['noChildrens']?></td>
        <td><?=$result['bookingDate']?>/<?=$result['bookingTime']?></td>
        <td><?=$result['postingDate']?></td>
        <th>
        <a href="booking_details.php?bid=<?=$result['id'];?>" title="View Details" class="btn btn-primary btn-xm" > View Details</a> 
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
<script src="js/script.js"></script>


</body>
</html>
