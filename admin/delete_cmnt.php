<?php
require_once 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Requête SQL pour supprimer l'utilisateur
    $delete_query = "DELETE FROM contact_us WHERE id = ?";
    if ($stmt = mysqli_prepare($connexion, $delete_query)) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
    // Rediriger vers la page principale après la suppression
    header("Location: services.php");
    exit();
} else {
    // Rediriger si aucun ID n'est fourni
    header("Location: services.php");
    exit();
}
?>
