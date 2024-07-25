<?php
// Récupérer les paramètres du site à partir de la base de données
$query = "SELECT * FROM settings";
$result = mysqli_query($connexion, $query);
$setting = mysqli_fetch_assoc($result);

?>
<div class="footer">
    <?php include 'footer-content.php'; ?>
</div>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery-3.7.1.min.js"></script>

</body>
</html>