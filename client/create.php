<?php
session_start();
// if ($_SESSION != null) {

    require_once '../layauts/app.php';
?>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Ajouter un client</h1>
            <a href="index.php" class="btn btn-sm btn-primary">Fermer</a>
        </div>

        <div class="container">
            <div class="row border">
                <div class="col-md-12 col-sm-6 ">
                    <div class="p-3">
                        <h4>Information du client</h4>
                        <form id="clientForm">
                            <div class="group-form mb-2">
                                <label for="nom">Designation</label>
                                <input type="text" class="form-control mt-2" name="nom" id="nom" placeholder="Entrer designation du client">
                            </div>

                            <div class="group-form mb-2">
                                <label for="adresse">Adresse </label>
                                <input type="text" class="form-control mt-2" name="adresse" id="adresse" placeholder="Entrer l'addresse du client">
                            </div>

                            <div class="group-form mb-2">
                                <label for="telephone">Numero de telephone</label>
                                <input type="number" class="form-control mt-2" id="telephone" placeholder="numbero de telephone">
                            </div>

                    </div>

                </div>

                <div class="px-4 py-3">
                    <button type="submit" name="save" class="btn w-100 btn-sm btn-success">Enregister</button>
                </div>

                </form>
            </div>
        </div>


    </main>

    <script src="../../assets/bootstrap/js/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#clientForm').submit(function(e) {
                e.preventDefault(); // Annuler l'événement de soumission par défaut du formulaire

                // Récupérer les données du formulaire et les formater en JSON
                var formData = {
                    nom: $('#nom').val(),
                    adresse: $('#adresse').val(),
                    telephone: $('#telephone').val()
                };
                var jsonData = JSON.stringify(formData);

                // Faire appel au script PHP via AJAX
                $.ajax({
                    type: 'POST',
                    url: 'http://api.local/client/add_client.php', // Adresse du serveur sur le réseau local
                    contentType: 'application/json', // Indiquer que les données sont en JSON
                    data: jsonData,
                    success: function(response) {
                        // Traiter la réponse ici
                        alert(response.message); // Afficher le message de succès
                        window.location.href = "index.php";
                    },
                    error: function(xhr, status, error) {
                        // Gérer les erreurs ici
                        console.log(xhr.status);
                    }
                });
            });
        });
    </script>

<?php require_once '../layauts/footer.php';
// } else
//     header('Location:../../index.php');
// exit();

?>