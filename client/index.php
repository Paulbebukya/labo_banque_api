<?php
// session_start();
// if ($_SESSION != null) {

require_once '../layauts/app.php';

?>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Les clients</h1>
            <a href="create.php" class="btn btn-sm btn-primary">Ajouter un client</a>
        </div>

        <div class="table-responsive overflow-auto" style="height: 76vh;">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Designation</th>
                        <th scope="col">Adresse</th>
                        <th scope="col">Téléphone</th>
                        <th>Numero de compte</th>
                        <th>Date Creation</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                
                </tbody>
            </table>
        </div>
    </main>

    <script src="../../assets/bootstrap/js/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function () {
            $.ajax({
                type: 'GET',
                url: 'http://api.local/client/get_client.php', // Assurez-vous de spécifier le chemin correct vers votre fichier PHP
                dataType: 'json',
                success: function (response) {
                    // Traiter la réponse ici
                    if (response.length > 0) {
                        var html = '';
                        $.each(response, function (index, data) {
                            html += '<tr>';
                            html += '<td>' + (index + 1) + '</td>';
                            html += '<td>' + data.nom + '</td>';
                            html += '<td>' + data.adresse + '</td>';
                            html += '<td>' + data.telephone + '</td>';
                            // Ajoutez ici d'autres colonnes en fonction de vos données
                            html += '<td>' + data.matricul + '</td>';
                            html += '<td>' +  data.date_creation + '</td>';
                            html += "<td style='width: 50px;'><a href='update.php?id="+ data.id+"&nom="+ data.nom+"&adresse="+ data.adresse+"&telephone="+ data.telephone+"' class='btn btn-sm btn-primary me-1'>Voir</a></td>";
                            html += '</tr>';
                        });
                        $('tbody').html(html); // Remplacez le contenu de tbody par les lignes créées
                    } else {
                        $('tbody').html('<tr><td colspan="7">Aucune donnée trouvée dans la base de données.</td></tr>');
                    }
                },
                error: function (xhr, status, error) {
                    // Gérer les erreurs ici
                    alert('Une erreur s\'est produite lors de la récupération des données de la base de données.');
                    console.error(error);
                }
            });
        });
    </script>
<?php require_once '../layauts/footer.php';
// } else
//     header('Location:../../index.php');
// exit();

?>