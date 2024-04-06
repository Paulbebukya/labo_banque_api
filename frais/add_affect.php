<?php
// Autoriser l'accès depuis un domaine spécifique
header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

// Récupérer les données envoyées en JSON
$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);

// Connexion à la base de données MySQL
require_once '../../Classes/Config.php';

// Préparer la requê    te d'insertion
$pdo = get_connection();
$response = [];
$id_compte = null;
$id_frais = null;


if (isset($data)) {

    $id_frais = $data['id_frais'];
    $id_compte =  $data['id_compte'];
    $query = $pdo->prepare("INSERT INTO compte_frais (id_conpte,`id_frais`) VALUES (?,?)");
    $query->execute([$id_compte, $id_frais]);
    if ($query) {
        $response = array(
            'status' => 'success',
            'message' => 'Compte affecté avec succès !',
        );
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Erreur lors de l\'affectation de compte'
        );
    }
} else {
    $response['message'] = "Aucune information envoyer";
}
echo json_encode($response);
