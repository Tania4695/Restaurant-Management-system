<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:admin_login.php');
}
else{
if(isset($_GET['delete'])){
   
    $tid = $_GET['tid'];

    $delete_table = $conn->prepare("DELETE FROM `tblrestables` WHERE id = ?");
    $delete_table->execute([$tid]);

    header('location:manage_tables.php');
 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Manage Tables</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">
   <style>
    .Manage-Tables {
    font-family: Arial, sans-serif;
    font-size: 16px;
    color: #333;
    }
    
    .Manage-Tables .heading {
    text-align: center;
    font-size: 24px;
    margin-bottom: 20px;
    }
    
    .Manage-Tables table {
    border-collapse: collapse;
    width: 100%;
    margin-bottom: 20px;
    }
    
    .Manage-Tables th, .Manage-Tables td {
    text-align: left;
    padding: 8px;
    border: 1px solid #ddd;
    }
    
    .Manage-Tables th {
    background-color: #f2f2f2;
    }
    
    .Manage-Tables tr:nth-child(even) {
    background-color: #f2f2f2;
    }
    
    .Manage-Tables tr:hover {
    background-color: #ddd;
    }
    
    .Manage-Tables a {
    color: red;
    }

</style>

</head>
<body>

<?php include '../components/admin_header.php' ?>

<section class="Manage-Tables">
    <h1 class="heading">Manage Tables</h1>
    <h3>Table Details</h3> 
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Table No</th>
                <th>Added By</th>
                <th>Creation Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php 
        $show_tables=$conn->prepare("SELECT name,tblrestables.id as tid,tblrestables.tableNumber,tblrestables.creationDate from `tblrestables`
        left join `admin` on admin.id=tblrestables.AddedBy");
        $show_tables->execute();
        $cnt=1;
        while($fetch_tables = $show_tables->fetch(PDO::FETCH_ASSOC)){
        ?>

        <tr>
            <td><?= $cnt;?></td>
            <td><?= $fetch_tables['tableNumber']?></td>
            <td><?= $fetch_tables['name']?></td>
            <td><?= $fetch_tables['creationDate']?></td>
            <th> 
            <a href="manage_tables.php?delete&&tid=<?= $fetch_tables['tid']; ?>" style="color:red;" title="Delete this record" onclick="return confirm('Do you really want to delete this record?');"><i class="fa fa-trash" aria-hidden="true"></i></a>
            </th>
        </tr>
        <?php $cnt++;} ?>
        </tbody>
        <tfoot>
            <tr>
                <th>#</th>
                <th>Table No</th>
                <th>Added By</th>
                <th>Creation Date</th>
                <th>Action</th>
            </tr>
        </tfoot>
    </table>
</section>

<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>
<?php } ?>
