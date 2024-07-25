<?php 
    require_once 'config.php';

    // Check if the id parameter is set
    if(isset($_GET['id'])) {
        // Escape user inputs for security
        $id = mysqli_real_escape_string($connexion, $_GET['id']);

        // Delete admin user from database
        $query = "DELETE FROM admins WHERE id = $id";
        if(mysqli_query($connexion, $query)) {
            // Redirect to the index page after deletion
            header("Location: admins.php");
            exit();
        } else {
            echo "Erreur de suppression : " . mysqli_error($connexion);
        }
    }
?>
