<?php 
include 'config.php';
session_start();
$admin_id = isset($_SESSION['admin_id']) ? $_SESSION['admin_id'] : null;

if(!$admin_id){
    header('location:../login.php');
    exit;
}

$fetch = null;
$select = mysqli_query($connexion, "SELECT * FROM `admins` WHERE id = '$admin_id'") or die('query failed');
if(mysqli_num_rows($select) > 0){
    $fetch = mysqli_fetch_assoc($select);
}
?>

<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="index.php">
       <h4><?php echo $fetch['nom'],' ', $fetch['prenom']; ?></h4>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link  active" href="index.php">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fa fa-home text-white text-lg"></i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>        

        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">gérer les services</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link  " href="services.php">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fa fa-cogs text-dark text-lg"></i>
            </div>
            <span class="nav-link-text ms-1">Services</span>
          </a>
        </li>

        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">administration du site</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link  " href="users.php">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fa fa-user-plus text-dark text-lg"></i>
            </div>
            <span class="nav-link-text ms-1">users</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link  " href="admins.php">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa fa-light fa-user-tie text-dark text-lg"></i>
            </div>
            <span class="nav-link-text ms-1">Admins</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link  " href="concours.php">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fa fa-user text-dark text-lg"></i>
            </div>
            <span class="nav-link-text ms-1">concours</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link  " href="settings.php">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fa fa-globe text-dark text-lg"></i>
            </div>
            <span class="nav-link-text ms-1">paramètre</span>
          </a>
        </li>


      </ul>
    </div>
    <div class="sidenav-footer mx-3 ">
      <a class="btn bg-gradient-primary mt-3 w-100" href="logout.php">logout</a>
    </div>
  </aside>