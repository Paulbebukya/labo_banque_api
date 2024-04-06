<?php
// Autoriser l'accès depuis un domaine spécifique
header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

// Récupérer les données envoyées en JSON
$jsonData = file_get_contents('php://input');
$nom_utilisateur = null;
$mot_de_passe = null;

$data = json_decode($jsonData, true);



if (isset($data)) {
    $nom_utilisateur = $data['nom_utilisateur'];
    $mot_de_passe = $data['mot_de_passe'];

    if (!empty($nom_utilisateur) && !empty($mot_de_passe)) {
        require_once '../../Classes/Login.php'; // Correction du chemin vers le fichier de la classe Login
        $login = new Login();
        $result = $login->login($nom_utilisateur, $mot_de_passe);

        $response = array(
            'status' => 'success',
            'message' => 'connecter!',
        );
        echo json_encode($response);
    } else {

        $response = array(
            'status' => 'error',
            'message' => 'completez tous les champs!',
        );
        echo json_encode($response);
    }
}
