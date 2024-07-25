<?php include('includes/header.php') ?>    
<?php 
    require_once 'config.php';
    // Nombre d'utilisateurs à afficher par page
    $utilisateurs_par_page = 4;
    // Page actuelle, par défaut 1 si aucun paramètre n'est spécifié dans l'URL
    $page = isset($_GET['page']) ? $_GET['page'] : 1;

    // Requête SQL pour compter le nombre total d'utilisateurs
    $total_utilisateurs_query = "SELECT COUNT(*) AS total FROM user_form";
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
    $query = "SELECT * FROM user_form LIMIT $offset, $utilisateurs_par_page";
    $result = mysqli_query($connexion, $query);
?>

<style>
    .aa {
        font-size: 3px;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>
                    Liste d'utilisateurs
                    <a href="users-create.php" class="btn btn-primary float-end">Ajouter un utilisateur</a>
                </h4>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Id :</th>
                            <th>Nom :</th>
                            <th>Prénom</th>
                            <th>Email :</th>
                            <th>Image :</th>
                            <th>Aceess level</th>
                            <th>Aceess level Option</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td><?= $row['id'] ?></td>
                                <td><?= $row['nom'] ?></td>
                                <td><?= $row['prenom'] ?></td>
                                <td><?= $row['email'] ?></td>
                                <td><img src='uploads/<?= $row['nom'] ?>.<?= $row['prenom'] ?>/<?= $row['image'] ?>' width='100px' height='100px' style='border-radius:5%;object-fit:cover;'></td>
                                <td><?= $row['accessLevel'] ?></td>
                                <td><?= $row['accessLevelOption'] ?></td>
                                <td>
                                    <a href='show-user.php?id=<?= $row['id'] ?>'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 576 512'><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d='M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z'/></svg></a>
                                    <a href='edit-user.php?id=<?= $row['id'] ?>'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 512 512'><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d='M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z'/></svg></a>
                                    <a href='delete-user.php?id=<?= $row['id'] ?>' onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet user ?')"><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 448 512'><path d='M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z'/></svg></a>
                                </td>
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

<?php include('includes/footer.php') ?>
