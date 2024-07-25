<?php 
$pageTitle="Admin";
include('includes/header.php'); 

?>
    <?php
    // Connexion à la base de données
    include 'config.php';
    // Requête pour compter le nombre d'utilisateurs
    $sql_users = mysqli_query($connexion, "SELECT COUNT(*) AS total_users FROM user_form");
    $row_users = mysqli_fetch_assoc($sql_users);
    $total_users = $row_users['total_users'];

    // Requête pour compter le nombre d'administrateurs
    $sql_admins = mysqli_query($connexion, "SELECT COUNT(*) AS total_admins FROM admins");
    $row_admins = mysqli_fetch_assoc($sql_admins);
    $total_admins = $row_admins['total_admins'];

    // Requête pour compter le nombre de concours
    $sql_concours = mysqli_query($connexion, "SELECT COUNT(*) AS total_concours FROM concours");
    $row_concours = mysqli_fetch_assoc($sql_concours);
    $total_concours = $row_concours['total_concours'];

?>

<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card card-body p-3">
            <p class="text-sm mb-0 text-capitalize font-weight-bold">Nombre d'utilisateurs</p>
            <h5 class="font-weight-bolder mb-0">
                <?php echo $total_users; ?>
            </h5>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card card-body p-3">
            <p class="text-sm mb-0 text-capitalize font-weight-bold">Nombre d'administrateurs</p>
            <h5 class="font-weight-bolder mb-0">
                <?php echo $total_admins; ?>
            </h5>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card card-body p-3">
            <p class="text-sm mb-0 text-capitalize font-weight-bold">Nombre de condidat</p>
            <h5 class="font-weight-bolder mb-0">
                <?php echo $total_concours; ?>
            </h5>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>