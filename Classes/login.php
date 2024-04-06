<?php
session_start();
require_once "Config.php";

class Login
{
    public static function login($nom_utilisateur, $mot_de_passe)
    {
        $pdo = get_connection();
        // Préparation de la requête SQL
        $stmt = $pdo->prepare("SELECT nom_utilisateur, `mot_de_passe` FROM `utilisateur` WHERE `nom_utilisateur` = ? and `mot_de_passe` = ?");

        // Exécution de la requête avec les valeurs fournies
        $stmt->execute([$nom_utilisateur, $mot_de_passe]);
    }
}
