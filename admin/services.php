<?php include('includes/header.php') ?> 
<style>
    .short-message {
        white-space: nowrap; 
        overflow: hidden; 
        text-overflow: ellipsis; 
        display: inline-block; 
        max-width: 150px; 
    }

    .full-message {
        white-space: pre-line; 
        display: none;
    }
</style>

<?php 
    require_once 'config.php';
    // Nombre d'utilisateurs à afficher par page
    $utilisateurs_par_page = 4;
    // Page actuelle, par défaut 1 si aucun paramètre n'est spécifié dans l'URL
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    // Requête SQL pour compter le nombre total d'utilisateurs
    $total_utilisateurs_query = "SELECT COUNT(*) AS total FROM contact_us";
    $total_utilisateurs_result = mysqli_query($connexion, $total_utilisateurs_query);
    $total_utilisateurs_row = mysqli_fetch_assoc($total_utilisateurs_result);
    $total_utilisateurs = $total_utilisateurs_row['total'];
    // Calculer le nombre total de pages
    $total_pages = ceil($total_utilisateurs / $utilisateurs_par_page);
    // Si la page est -1, aller à la dernière page
    if ($page == -1) {
        $page = $total_pages;
    }
    // Assurer que la page est dans la plage valide
    if ($page < 1) {
        $page = 1;
    } elseif ($page > $total_pages) {
        $page = $total_pages;
    }

    // Calculer le décalage pour la requête SQL
    $offset = ($page - 1) * $utilisateurs_par_page;

    // Requête SQL pour récupérer les utilisateurs pour la page actuelle
    $query = "SELECT * FROM contact_us LIMIT $offset, $utilisateurs_par_page";
    $result = mysqli_query($connexion, $query);
?>
<style>
    .short-message {
        display: inline;
    }
    .full-message {
        display: none;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>
                    Liste d'utilisateurs
                </h4>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Id :</th>
                            <th>Nom :</th>
                            <th>Email</th>
                            <th>Message :</th>
                            <th>Action :</th> <!-- Nouvelle colonne pour l'action -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td><?= $row['id'] ?></td>
                                <td><?= $row['nom'] ?></td>
                                <td><?= $row['email'] ?></td>
                                <td>
                                    <span class="short-message"><?= htmlspecialchars(substr($row['message'], 0, 10)) ?>...</span>
                                    <span class="full-message"><?= htmlspecialchars($row['message']) ?></span>
                                    <?php if (strlen($row['message']) > 10) { ?>
                                        <a href="#" class="toggle-message btn btn-link">savoir plus</a>
                                    <?php } ?>
                                </td>
                                <td>
                                    <a href="mailto:<?= $row['email'] ?>" class="btn btn-primary">Répondre</a>
                                    <a href="delete_cmnt.php?id=<?= $row['id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this message?');">Supprimer</a>
                                </td> <!-- Bouton pour répondre et supprimer -->
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <?php
                // Afficher les boutons Suivant et Précédent
                if ($total_utilisateurs > $utilisateurs_par_page) {
                ?>
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">

                        <!-- Bouton Précédent -->
                        <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                            <a class="btn" href="?page=<?= ($page - 1 == 0) ? -1 : ($page - 1) ?>" tabindex="-1" aria-disabled="true">Précédent</a>
                        </li>

                        <!-- Boutons de navigation -->
                        <?php
                        // Déterminer les pages à afficher
                        $start = max(1, $page - 2);
                        $end = min($total_pages, $page + 2);

                        // Afficher les boutons des pages
                        for ($i = $start; $i <= $end; $i++) { ?>
                            <li class="page-item <?= ($page == $i) ? 'active' : '' ?>">
                                <a class="page-link btn" href="?page=<?= $i ?>"><?= $i ?></a>
                            </li>
                        <?php } ?>

                        <!-- Bouton Suivant -->
                        <li class="page-item <?= ($page >= $total_pages) ? 'disabled' : '' ?>">
                            <a class="btn" href="?page=<?= ($page + 1) ?>" aria-disabled="false">Suivant</a>
                        </li>
                    </ul>
                </nav>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.toggle-message').forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                var shortMessage = this.previousElementSibling.previousElementSibling;
                var fullMessage = this.previousElementSibling;
                if (fullMessage.style.display === 'none') {
                    fullMessage.style.display = 'inline';
                    shortMessage.style.display = 'none';
                    this.textContent = 'voir moins';
                } else {
                    fullMessage.style.display = 'none';
                    shortMessage.style.display = 'inline';
                    this.textContent = 'savoir plus';
                }
            });
        });
    });
</script>

<?php include('includes/footer.php') ?>
