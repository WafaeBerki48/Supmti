
<?php  require 'admin/config.php';
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title><?php if(isset($pageTitle)){echo $pageTitle;}else{echo'Supmti';}?></title>

</head>
<body>
    <?php include('navbar.php')?>