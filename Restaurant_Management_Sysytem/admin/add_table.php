<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:admin_login.php');
};
if(isset($_POST['submit'])){

    $tno = $_POST['tableno'];
    $tno = filter_var($tno, FILTER_SANITIZE_STRING);
    $addedby = $_SESSION['admin_id'];

    $add_table = $conn->prepare("INSERT INTO `tblrestables`(tableNumber, AddedBy) VALUES(?,?)");
    $add_table->execute([$tno, $addedby]);

    $message[] = 'Table added successfully!';
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Add Table</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">
   <style>
    .add-tables form{
    margin:0 auto;
    max-width: 50rem;
    background-color: var(--white);
    border-radius: .5rem;
    box-shadow: var(--box-shadow);
    border:var(--border);
    padding:2rem;
    text-align: center;
    }

    .add-tables form h3{
    margin-bottom: 1rem;
    font-size: 2.5rem;
    color:var(--black);
    text-transform: capitalize;
    }

    .add-tables form .box{
    background-color: var(--light-bg);
    border:var(--border);
    width: 100%;
    padding:1.4rem;
    font-size: 1.8rem;
    color:var(--black);
    border-radius: .5rem;
    margin: 1rem 0;
    }

    </style>

</head>
<body>

<?php include '../components/admin_header.php' ?>

<!-- add table section starts  -->
<section class="add-tables">

    <form action="" method="POST" enctype="multipart/form-data">
        <h3>add Table</h3>
        <input type="text" required placeholder="Enter Table Number" id="tableno" name="tableno" class="box">
        <input type="submit" value="add table" name="submit" class="btn">
    </form>

</section>
<!-- add table section ends -->



<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>
