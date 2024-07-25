<?php include('includes/header.php') ?>    
<?php 
require_once 'config.php';
if ($connexion->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  // Fetch data from the database
  $id = $_GET["id"];
  $sql = "SELECT * FROM admins WHERE id=$id";
  $result = $connexion->query($sql);
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {

  // Display data in a readable format
echo"
    <div class='row'>
    <div class='col-md-12'>
    <div class='card'>
    <div class='card-header'>
    <h4>
      show admin  **". $row["nom"]."**
    <a href='admins.php' class='btn btn-danger float-end'>back</a>
    </h4>
    </div>
    <div class='card-body'>
    <style>
    .profile-img {
      width: 150px;
      height: 150px;
      object-fit: cover;
      border-radius: 50%;
      margin: 0 auto;
      display: block;
    }
  </style>
<div class='container'>
  <div class='card'>
    <ul class='list-group list-group-flush'>
      <li class='list-group-item'>ID : ". $row["id"]."</li>
      <li class='list-group-item'>Nom: ". $row["nom"]."</li>
      <li class='list-group-item'>Prenom : ". $row["prenom"]."</li>
      <li class='list-group-item'>Eamil : ". $row["email"]."</li>
    <ul>
      ";
  }
}
?>
<?php include('includes/footer.php') ?>