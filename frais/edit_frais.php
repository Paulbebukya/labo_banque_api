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
$id_frais = null;
$designation = null;

if (isset($data)) {

    $id_frais = $data['id_frais'];
    $designation = $data['designation'];

    if (!empty($id_frais)) {
        $query = $pdo->prepare("UPDATE frais SET designation=? WHERE id=?");
        $query->execute([$designation,$id_frais]);
        if ($query) {
            if ($query) {
                $response = array(
                    'status' => 'success',
                    'message' => 'Données modifies avec succès!',
                    'data' => $data
                );
            } else {
                $response = array(
                    'status' => 'error',
                    'message' => 'Erreur lors de la modification'
                );
            }
        } else {
            $response['message'] = "Error pending ";
        }
    }else{
         $response['message'] = "Erreur lors de la modification";
    }
} else {
    $response['message'] = "Erreur lors de la modification";
}
echo json_encode($response);
