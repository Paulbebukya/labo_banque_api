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
$designation = null;

if (isset($data)) {

    $designation = $data['designation'];
    $date=date('Y-m-d H:i:s');
    
    if (!empty($designation)) {

        $query = $pdo->prepare("SELECT `designation` from frais where  designation= ?");
        $query->execute([$designation]);
        $data = $query->fetch(PDO::FETCH_ASSOC);
        if ($query->rowCount() == 0) {
            $query = $pdo->prepare("INSERT INTO frais (`designation`,date_creation) VALUES (?,?)");
            $query->execute([$designation,$date]);
            if ($query) {
                $response = array(
                    'status' => 'success',
                    'message' => 'Données insérées avec succès dans la base de données!',
                    'data' => $data
                );
            } else {
                $response = array(
                    'status' => 'error',
                    'message' => 'Erreur lors de l\'insertion des données dans la base de données!'
                );
            }
        } else {
            $response['message'] = "Le nom de frais est deja prit ";
        }
    }
} else {
    $response['message'] = "completez le champs de la designation";
}
echo json_encode($response);
