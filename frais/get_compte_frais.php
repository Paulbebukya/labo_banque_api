<?php
// Autoriser l'accès depuis un domaine spécifique
header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

// Connexion à la base de données MySQL
require_once '../../Classes/Config.php';

// Préparer la requê    te d'insertion
$pdo = get_connection();

// Créer une connexion PDO
try {
    // Définir le mode de rapport d'erreurs PDO sur exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Préparer la requête SQL

    $pdo = get_connection();
    $response = [];

    $stmt = $pdo->prepare("SELECT frais.*, compte.id as id_compte,compte.matricul , compte_frais.*, client.*
    FROM frais
    JOIN compte_frais ON frais.id = compte_frais.id_frais
    JOIN compte ON compte.id = compte_frais.id_conpte
    JOIN client ON client.id = compte.id_client
    ");
    // Exécuter la requête
    $stmt->execute();

    // Récupérer les résultats de la requête
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($data) > 0) {

        echo json_encode($data);
    } else {
        $response['error'] = "aucune donnees";
    }
} catch (PDOException $e) {
    // En cas d'erreur de connexion ou d'exécution de la requête
    echo json_encode(array('error' => 'Erreur de connexion à la base de données: ' . $e->getMessage()));
}

// Fermer la connexion PDO
$conn = null;
